<?php

class adminController extends Controller {

  public function home(){
    $this->middleware();
    $organizations = $this->model('Organization')->select()->where('role', 0)->get();
    return $this->view('admin/home', ['organizations' => $organizations]);
  }


  public function organizationDetail($id){
    $this->middleware();
    if(!Security::valid($id)) $this->redirect('home');
    $id = Security::decrypt($id);

    $organization = $this->model('Organization')->select()->where('id', $id)->execute();
    $user = $this->model('Siakad')->select()->where('nim', $organization->nim)->execute();
  	return $this->view('admin/organization_detail', ['organization' => $organization, 'user' => $user]);
  }


  public function dataApproval(){
    $this->middleware();
    $registrations = $this->model('Registration')->select()->where('privacy', 1)->where('verify', 0)->get(); 
    return $this->view('admin/data_approval', ['registrations' => $registrations]);
  }


  public function approvalDetail($id){
    $this->middleware();
    if(!Security::valid($id)) $this->redirect('home');
    $id = Security::decrypt($id);
    
    $registration = $this->model('Registration')->select()->where('id', $id)->execute();
    $organization = $this->model('Organization')->select()->where('id', $registration->id_organization)->execute(); 
    return $this->view('admin/approval_detail', ['registration' => $registration, 'organization' => $organization]);
  }


  public function approveData($id){
    $this->middleware();

    $registration = $this->model('Registration')->update([
            "verify" => 1,
          ])->where('id', $id)->execute();

    if($registration) $this->redirect("persetujuan_data");
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }


  public function deleteOrganization($id){
    $this->middleware();
    $organization = $this->model('Organization')->delete()->where('id', $id)->execute();
    if($organization) $this->redirect('home');
    else die('Terjadi kesalahan. Mohon ulangi beberapa saat lagi');
  }
  

  public function middleware(){
    if($this->user()->role != 1) $this->redirect('lihat_organisasi/'.Security::encrypt($this->user()->id));
  }

}