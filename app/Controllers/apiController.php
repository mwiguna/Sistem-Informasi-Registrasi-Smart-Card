<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *'); 
header('Content-Type: application/json');

class apiController extends Controller {

  public function tangkapPost(){
    var_dump($_POST);
  }
  

  /* ---------- Realtime --------- */
  

  public function newMemberBC(){
    if(Security::valid($_POST['nim']) && Security::valid($_POST['id_registration'])){
      $registration = $this->model('Registration')
                           ->select(['url'])
                           ->where('id', Security::decrypt($_POST['id_registration']))
                           ->execute();

      $member = $this->model('Siakad')->select()->where('nim', Security::decrypt($_POST['nim']))->execute();

      if($registration->url != "") $this->sendingWebHook(Security::decrypt($registration->url), $member);
      
      $member = json_encode($member);
      echo $member;
    } else echo 404;
  }


  public function sendingWebHook($url, $data){
    $ch = curl_init($url);

    $postString = http_build_query($data, '', '&');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
    var_dump(curl_exec($ch));
    curl_close($ch);
  }


  /* ------------- Process ------------- */


  public function verifyRegistration(){
    $nim = Security::decrypt($_POST['token']);

    $organization = $this->model('Organization')
                         ->select(['id'])
                         ->where('nim', $nim)
                         ->where('verify', 0)
                         ->execute();

    if(empty($organization)) $this->response(404);
    else 
    {
      $organization = $this->model('Organization')
                   ->update(["verify" => 1])
                   ->where('id', $organization->id)
                   ->execute();
      
      if($organization) $this->response(1);
      else $this->response(0);
    }
  }


  public function verifyKey(){
    $id = Security::decrypt($_POST['key']);

    $registration = $this->model('Registration')->select()->where('id', $id)->execute();
    if(empty($registration)) $this->response(404);
    else echo json_encode(array("msg" => 1, "title" => $registration->title));
  }


  public function newMember(){
    if(Security::valid($_POST['nim']) && Security::valid($_POST['key'])){
    
      $nim             = Security::decrypt($_POST['nim']);
      $id_registration = Security::decrypt($_POST['key']);

      $check_member = $this->Model('Member')->select()
                           ->where('id_registration', $id_registration)
                           ->where('nim', $nim)->execute();

      $registration = $this->Model('Registration')->select()
                           ->where('id', $id_registration)->execute();

      if(!empty($registration)){
        if(empty($check_member)){
          $insert = $this->model('Member')->insert([
                "nim" => $nim,
                "id_registration" => $id_registration,
              ])->execute();

          if($insert) $this->response(1);
          else $this->response(0);
        } else $this->response(2);
      } else $this->response(404);
    } else $this->response(404);
  }


  public function getMembers($key){
    $id_registration = Security::decrypt($key);
    $members = $this->model('Member')->select(['nim'])->where('id_registration', $id_registration)->get();
    
    if(!empty($members)){
      foreach ($members as $member) {
        $nim_members[] = "'".$member->nim."'";
      }
      
      $nim_members  = join(', ', $nim_members);

      $members = $this->model('Siakad')->raw("SELECT * FROM mahasiswa_siakad WHERE nim IN ({$nim_members})"); 
      echo json_encode($members);
    } else echo json_encode(array());
  }


  public function deleteMember(){
    $id_registration = Security::decrypt($_POST['key']);
    $member = $this->model('Member')->delete()->where('nim', strtoupper($_POST['nim']))
                                              ->where('id_registration', $id_registration)->execute();

    if($member) $this->response(1);
    else $this->response(0);
  }

  
  /* ------------------------ */


  public function response($status){
    echo json_encode(array("msg" => $status));
  } 

}