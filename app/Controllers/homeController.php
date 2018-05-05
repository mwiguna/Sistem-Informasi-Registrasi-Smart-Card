<?php

class homeController extends Controller {
  
  public function index(){
    if(isset($this->userId)) $this->redirect('home'); 

    return $this->view('page/login');
  }

  public function error($type){
    if(isset($this->userId)) $this->redirect('home'); 

    if ($type == 'login') return $this->view('page/login', ['msg' => 'Username atau password tidak cocok']);
    else if($type == 'verify') return $this->view('page/login', ['msg' => 'Silahkan scan kartu identitas sesuai NIP / NIM penanggung jawab sebelum menggunakan akun']);
    else if($type == 'berkas') return $this->view('page/login', ['msg' => 'Harap menunggu berkas disetujui oleh admin sebelum menggunakan akun.']);
  }

  public function login(){
  	$organization = $this->model('Organization')->select()->where('username', $_POST['username'])->execute();

  	if(!empty($organization)){
  		if($this->verify($_POST['password'], $organization->password)){
        if($organization->verify == 2){
          $_SESSION['id'] = $organization->id;

          if($organization->role == 1) $this->redirect('home');
          else $this->redirect('lihat_organisasi/'.Security::encrypt($organization->id));
        } 
        else if($organization->verify == 1) $this->redirect('error/berkas');
        else $this->redirect('error/verify');
      } else $this->redirect('error/login');
  	} else $this->redirect('error/login');
  }

  public function logout(){
  	session_destroy();
    $this->redirect('');
  }

  public function events(){
    $events = $this->model()->raw("SELECT *, registrations.id AS id FROM registrations JOIN organizations WHERE organizations.id = registrations.id_organization AND ((registrations.privacy = 1 AND registrations.verify = 1) OR registrations.privacy = 0) ORDER BY registrations.start_date DESC")->get();

    return $this->view('page/events', ['events' => $events]);
  }

  public function registerEvent($key){
    if(!Security::valid($key)) $this->redirect('daftar_event');

    $id = Security::decrypt($key);
    $event = $this->model()->raw("SELECT *, registrations.id AS id FROM registrations JOIN organizations WHERE organizations.id = registrations.id_organization AND registrations.id = $id")->execute();

    require_once $this->root('lib/phpqrcode/qrlib.php');
    QRcode::png($key, $this->root('resource/assets/qrcode/'.$key.'.png'), 'L', 4, 2);
    return $this->view('page/register_event', ['event' => $event, 'key' => $key]);
  }

  public function realtime($nim, $registrasi, $webhook = 0){
    echo $this->view('page/realtime', ['nim' => $nim, 'registrasi' => $registrasi, 'webhook' => $webhook]);
  }
  
  /* --------- WebHook Checker -------- */

  public function getWebhook(){
   var_dump($_POST);
  }

  public function readWebHook(){
    return $this->view('page/read_webhook');
  }
}