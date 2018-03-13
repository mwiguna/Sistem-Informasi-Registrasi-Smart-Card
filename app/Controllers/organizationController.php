<?php

class organizationController extends Controller {


  // ------------- Registration User
  

  public function registration(){
  	return $this->view('organization/daftar');
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
            "email" => $_POST['email'],
          ])->execute();

    if($organization) $this->view('organization/success_registration');
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }


  // ----------- Show Organization and Registration


  public function showOrganization($id){
    $this->middleware();
    if(!Security::valid($id)) $this->redirect('lihat_organisasi/'.Security::encrypt($this->user()->id));
    
    $id = Security::decrypt($id);
    if(empty($id) && $id != $this->user()->id && $this->user()->role != 1) $this->redirect('lihat_organisasi/'.Security::encrypt($this->user()->id));
    
    $organization  = $this->model('Organization')->select()->where('id', $id)->execute();
    $registrations = $this->model('Registration')->select()->where('id_organization', $id)->get();

  	return $this->view('organization/organization', ['registrations' => $registrations, 'organization' => $organization]);
  }


  public function showRegistration($id){
    $this->middleware();
    if(!Security::valid($id)) $this->redirect('lihat_registrasi/'.$_SESSION['key']);

    $id = Security::decrypt($id);
    $registration = $this->model('Registration')->select()->where('id', $id)->execute();
    if($registration->id_organization != $this->user()->id && $this->user()->role != 1) $this->redirect('lihat_organisasi/'.Security::encrypt($this->user()->id));
    
    $members = $this->getDataMembers($registration->id);

    $_SESSION['privacy'] = ($registration->privacy == 1) ? true : false;
    $_SESSION['key']     = Security::encrypt($registration->id);
  	return $this->view('organization/registration', ['registration' => $registration, 'members' => $members]);
  }


  public function memberDetail($nim){    
    $nim = Security::decrypt($nim);
    
    if($this->user()->role == 1){
      $_SESSION['privacy'] = true;
      $member = $this->model('Member')->select()->where('nim', $nim)->execute();
    } else {
      $id_registration = Security::decrypt($_SESSION['key']);
      $member = $this->model('Member')->select()->where('nim', $nim)
                                                ->where('id_registration', $id_registration)->execute();
      if(empty($member)) $this->redirect('lihat_registrasi/'.$id_registration);
    }

    $data_member = json_decode(file_get_contents($GLOBALS['siakad_url']."api/getStudent/".Security::encrypt($nim)));
    return $this->view('organization/member_detail', ['member' => $data_member]);
  }


  // -------- Add Registration


  public function addRegistration(){
    $this->middleware();
    return $this->view('organization/add_registration');    
  }

  public function processAddRegistration(){
    $id_organization = $this->user()->id;

    $registration = $this->model('Registration')->insert([
            "title"           => $_POST['title'],
            "id_organization" => $id_organization,
            "description" => $_POST['description'],
            "privacy"     => (isset($_POST['privacy'])) ? 1 : 0,
          ])->execute();

    if($registration) $this->redirect("lihat_organisasi/".Security::encrypt($this->user()->id));
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }


  // ------------ Delete


  public function deleteRegistration($id){
    $this->middleware();
    $registration = $this->model('Registration')->delete()->where('id', Security::decrypt($id))->execute();

    if($registration) $this->redirect("lihat_organisasi/".Security::encrypt($this->user()->id));
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }

  public function deleteMember($nim){
    $this->middleware();
    $member = $this->model('Member')->delete()->where('nim', Security::decrypt($nim))->execute();

    if($member) $this->redirect("lihat_registrasi/".$_SESSION['key']);
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }


  // ----------- Others


  public function downloadCSV(){
    $registration = $this->model('Registration')->select()
                         ->where('id', Security::decrypt($_SESSION['key']))->execute();

    $members = $this->getDataMembers($registration->id);

    $this->view('organization/print', ['members' => $members, 'registration' => $registration]);
  }

  public function apiDocumentation(){
    $this->middleware();
    $registration = $this->model('Registration')->select()
                         ->where('id', Security::decrypt($_SESSION['key']))->execute();

    return $this->view('organization/api', ['registration' => $registration]);
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

      $members = json_decode(file_get_contents($GLOBALS['siakad_url']."api/getMembers/".Security::encrypt($nim_members)));

      if(is_array($members)){
        return $members;
      } else {
        $new_members[0] = $members;
        return $new_members;
      }
      
    }
  }

  public function middleware(){
    if(!isset($this->userId)) $this->redirect('');
  }

}