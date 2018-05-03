<?php

class organizationController extends Controller {


  // ------------- Registration User
  

  public function registration(){
  	return $this->view('organization/daftar');
  }

  public function checkName(){
    $user = $this->model('Organization')->select()->where('name', $_POST['name'])->execute();
    if(!empty($user)) echo 1;
    else echo 0; 
  }

  public function checkUsername(){
    $user = $this->model('Organization')->select()->where('username', $_POST['username'])->execute();
    if(!empty($user)) echo 1;
    else echo 0; 
  }

  public function register(){
    $organization = $this->model('Organization')->insert([
            "username" => $_POST['username'],
            "password" => $this->bcrypt($_POST['password']),
            "name"  => $_POST['name'],
            "nim"   => $_POST['nim'],
            "phone" => $_POST['phone'],
            "email" => $_POST['email']
          ])->lastId()->execute();

    $dir = __DIR__."/../../resource/assets/file/";
    if(is_uploaded_file($_FILES['berkas']['tmp_name'])) {
      if($_FILES['berkas']['type'] != "application/pdf"){
        $organization = $this->model('Organization')->delete()->where('id', $organization)->execute();
        die('Berkas yang di upload harus berformat pdf');
      } else if($_FILES['berkas']['size'] >= 2097152){
        $organization = $this->model('Organization')->delete()->where('id', $organization)->execute();
        die('Ukuran berkas yang di upload harus kurang dari 2 MB');
      } else {
        $result = move_uploaded_file($_FILES['berkas']['tmp_name'], $dir.Security::encrypt($organization).".pdf");
        if ($result != 1) die('Terjadi Kesalahan dalam mengupload, Mohon ulangi beberapa saat lagi');
      }
    }

    if($organization) $this->view('organization/success_registration');
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }


  // ----------- Show Organization and Registration


  public function showOrganization($id){
    $this->middleware($id);
    $id = Security::decrypt($id);

    if(empty($id) && $id != $this->user()->id && $this->user()->role != 1) $this->redirect('lihat_organisasi/'.Security::encrypt($this->user()->id));
    
    $organization  = $this->model('Organization')->select()->where('id', $id)->execute();
    $registrations = $this->model('Registration')->select()->where('id_organization', $id)->get();

  	return $this->view('organization/organization', ['registrations' => $registrations, 'organization' => $organization]);
  }


  public function showRegistration($id){
    $this->middleware($id);
    $id = Security::decrypt($id);

    $registration = $this->model('Registration')->select()->where('id', $id)->execute();
    if($registration->id_organization != $this->user()->id && $this->user()->role != 1) $this->redirect('lihat_organisasi/'.Security::encrypt($this->user()->id));
  
    $members = $this->getDataMembers($registration->id);

    $_SESSION['privacy'] = ($registration->privacy == 1) ? true : false;
    $_SESSION['key']     = Security::encrypt($registration->id);

    require_once $this->root('lib/phpqrcode/qrlib.php');
    QRcode::png($_SESSION['key'], $this->root('resource/assets/qrcode/'.$_SESSION['key'].'.png'), 'L', 4, 2);
  	return $this->view('organization/registration', ['registration' => $registration, 'members' => $members]);
  }


  public function memberDetail($nim){
    $this->middleware($nim);   
    $nim = Security::decrypt($nim);
    $privacy = 1;

    $dataAdditional = [];
    if(isset($_SESSION['key'])){
      $id_registration = Security::decrypt($_SESSION['key']);
      $registration = $this->model('Registration')->select()->where('id', $id_registration)->execute();

      $additionals  = $this->model()
                           ->raw("SELECT * FROM additional_member AS member JOIN additional_registration AS registration WHERE member.id_additional = registration.id AND member.nim = '$nim' AND registration.id_registration = '$registration->id'")->get();

      foreach($additionals as $additional){
        if($additional->nim == $nim) $dataAdditional []= (object) array("desc" => $additional->description, "val" => $additional->value);
      }
    }

    if($this->user()->role == 1){
      $_SESSION['privacy'] = true;
      $member = $this->model('Member')->select()->where('nim', $nim)->execute();
    } else {
      $member = $this->model('Member')->select()->where('nim', $nim)
                                              ->where('id_registration', $id_registration)->execute();

      if(empty($member)) $this->redirect('lihat_registrasi/'.$id_registration);
      $privacy = $registration->privacy;
    }

    $data_member  = json_decode(file_get_contents($GLOBALS['siakad_url']."api/getStudent/".Security::encrypt($nim)."/".$privacy));

    return $this->view('organization/member_detail', ['member' => $data_member, 'data' => $member, 'dataAdditional' => $dataAdditional]);
  }


  // -------- Add Registration


  public function addRegistration(){
    $this->middleware();
    return $this->view('organization/add_registration');    

  }

  public function processAddRegistration(){
    $id_organization = $this->user()->id;
    $this->checkDate(false);

    $registration = $this->model('Registration')->insert([
            "title"           => $_POST['title'],
            "id_organization" => $id_organization,
            "max_peserta" => $_POST['max'],
            "start_date"  => $_POST['start'],
            "end_date"    => $_POST['end'],
            "description" => $_POST['description'],
            "privacy"     => (isset($_POST['privacy'])) ? 1 : 0,
          ])->execute();

    if($registration) $this->redirect("lihat_organisasi/".Security::encrypt($this->user()->id));
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }

  public function editRegistration(){
    $this->middleware($this->checkKeyExist());

    $id = Security::decrypt($_SESSION['key']);
    $registration = $this->Model('Registration')->select()->where('id', $id)->execute();

    return $this->view('organization/edit_registration', ['registration' => $registration]);
  }

  public function processEditRegistration(){
    $this->middleware($this->checkKeyExist());
    $this->checkDate(true);

    $id = Security::decrypt($_SESSION['key']);
    $registration = $this->model('Registration')->update([
            "title"       => $_POST['title'],
            "max_peserta" => $_POST['max'],
            "start_date"  => $_POST['start'],
            "end_date"    => $_POST['end'],
            "description" => $_POST['description'],
            "privacy"     => (isset($_POST['privacy'])) ? 1 : 0,
          ])->where('id', $id)->execute();

    $this->redirect("lihat_registrasi/".$_SESSION['key']);
  }

  public function checkDate($edit){
    $now   = new DateTime(date('Y-m-d'));
    $start = new DateTime($_POST['start']);
    $end   = new DateTime($_POST['end']);

    $diffLeft  = $start->diff($end);
    $diffStart = $now->diff($start);

    $diffStart = (integer) $diffStart->format( "%R%a");
    $diffLeft  = (integer) $diffLeft->format( "%R%a");

    if(!$edit) if($diffStart < 0) die("Tanggal mulai pendaftaran sudah lewat");
    if($diffLeft < 0) die("Event tidak dapat ditutup sebelum dimulai"); 
  } 


  // ------------ Delete


  public function deleteRegistration($id){
    $this->middleware($id);
    $registration = $this->model('Registration')->delete()->where('id', Security::decrypt($id))->execute();

    if($registration){
      if($this->user()->role = 1) $this->redirect("");
      $this->redirect("lihat_organisasi/".Security::encrypt($this->user()->id));
    } 
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }

  public function deleteMember($nim){
    $this->middleware($nim);
    $member = $this->model('Member')->delete()->where('nim', Security::decrypt($nim))
                                              ->where('id_registration', Security::decrypt($_SESSION['key']))
                                              ->execute();

    if($member) $this->redirect("lihat_registrasi/".$_SESSION['key']);
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }



  // ----------- Additional Data


  public function additionalData($id){
    $this->middleware($id);
    $_SESSION['key'] = $id; 
    return $this->view("organization/additional_data", ['additionals' => $this->getAdditionals()]);
  }

  public function additionalDataMember($id){
    $this->middleware($id);
    $_SESSION['key'] = $id;
    $id = Security::decrypt($id);

    $additionals = $this->model('AdditionalRegistration')->select()->where("id_registration", $id)->get();
    return $this->view("organization/additional_data_member", ["additionals" => $additionals]);
  }

  public function addAdditional(){
    $id     = Security::decrypt($_SESSION['key']);
    $insert = $this->model('AdditionalRegistration')
                   ->insert([
                      "id_registration" => $id,
                      "description"     => $_POST['data']
                   ])->execute();

    if($insert) $this->redirect("data_tambahan/".$_SESSION['key']);
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }


  public function addAdditionalMember(){
    $this->middleware($_POST['nim']);
    $nim = Security::decrypt($_POST['nim']);
    unset($_POST['nim']);
    
    foreach ($_POST as $data => $value) {
      $insert = $this->model('AdditionalMember')
                     ->insert([
                        "id_additional" => Security::decrypt($data), 
                        "nim"   => $nim,
                        "value" => $value
                      ])->execute();
      if(!$insert) die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
    }

    $this->redirect("halaman_pendaftar/".$_SESSION['key']);
  }


  public function deleteAdditional($data){
    $this->middleware($data);
    $id            = Security::decrypt($_SESSION['key']);
    $id_additional = Security::decrypt($data);

    $additional    = $this->Model("AdditionalRegistration")->delete()->where("id", $id_additional)->execute();

    if($additional) $this->redirect("data_tambahan/".$_SESSION['key']);
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }


  public function getAdditionals(){
    $additionals = $this->model('AdditionalRegistration')->select()
                        ->where('id_registration', Security::decrypt($_SESSION['key']))
                        ->get();

    return $additionals;
  }


  // ----------- Others


  public function downloadCSV(){
    error_reporting(0); 
    $registration = $this->model('Registration')->select()
                         ->where('id', Security::decrypt($_SESSION['key']))->execute();

    $members = $this->getDataMembers($registration->id);
    $datas = $this->model('Member')->select()->where('id_registration', $registration->id)->get();
    
    $additionals  = $this->model()
                           ->raw("SELECT * FROM additional_member AS member JOIN additional_registration AS registration WHERE member.id_additional = registration.id AND registration.id_registration = '$registration->id'")->get();

    $additionalTypes = $this->model('AdditionalRegistration')
                            ->select(['description'])
                            ->where('id_registration', $registration->id)->get();

      $i = 0; foreach($members as $member){
        $j = 0; foreach($additionals as $additional){
          if($additional->nim == $member->nim){
            $members[$i]->additionals[$j]->desc = $additional->description;
            $members[$i]->additionals[$j]->val  = $additional->value;
          } $j++;
        } $i++;
      }

    $this->view('organization/print', ['members' => $members, 'additionalTypes' => $additionalTypes, 'registration' => $registration]);
  }

  public function apiDocumentation(){
    $this->middleware();
    $registration = $this->model('Registration')->select()
                         ->where('id', Security::decrypt($_SESSION['key']))->execute();

    $token = Security::encrypt(json_encode(array(0 => $registration->id_organization, 1 => $registration->id)));
    return $this->view('organization/api', ['registration' => $registration, 'token' => $token]);
  }

  public function addURL(){
    $registration = $this->model('Registration')->update([
            "url" => Security::encrypt($_POST['url']),
          ])->where('id', Security::decrypt($_SESSION['key']))->execute();

    if($registration) echo "Berhasil memperbarui URL";
    else echo "Terjadi Kesalahan. Harap coba beberapa saat lagi";
  }


  // ---------- Get Data Members


  public function getDataMembers($id){
    $members = $this->model('Member')->select(['nim'])->where('id_registration', $id)->get();
    
    if(!empty($members)){
      foreach ($members as $member) {
        $nim_members[] = "'".$member->nim."'";
      }
      
      $nim_members  = join(', ', $nim_members);


      $registration = $this->model('Registration')->select()->where('id', $id)->execute();
      $members = json_decode(file_get_contents($GLOBALS['siakad_url']."api/getMembers/".Security::encrypt($nim_members)."/".$registration->privacy));

      if(is_array($members)){
        return $members;
      } else {
        $new_members[0] = $members;
        return $new_members;
      }
      
    }
  }

  public function checkKeyExist(){
    return (isset($_SESSION['key'])) ? $_SESSION['key'] : 'invalid';
  }

  public function middleware($key = null){
    if(!isset($this->userId)) $this->redirect('');
    if(!empty($key)){
      if(!Security::valid($key)) $this->redirect('lihat_organisasi/'.Security::encrypt($this->user()->id));
    }
  }

}