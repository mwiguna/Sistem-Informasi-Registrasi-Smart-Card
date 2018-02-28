<?php

$route = new Route();

//---------------- Route --------------- //

$route->url("/",      "home");
$route->url("login",  "home", "login");
$route->url("logout", "home", "logout");
$route->url("realtime/:nim/:registrasi", "home", "realtime");
$route->url("error/:type", "home", "error");

$route->url("home", "admin", "home");
$route->url("persetujuan_data",         "admin", "dataApproval");
$route->url("persetujuan_organisasi",   "admin", "organizationApproval");
$route->url("detail_organisasi/:id",    "admin", "organizationDetail");
$route->url("detail_persetujuan/:id",   "admin", "approvalDetail");
$route->url("approve_data/:id", 		"admin", "approveData");
$route->url("hapus_organisasi/:id", 	"admin", "deleteOrganization");

$route->url("daftar",  		"organization", "registration");
$route->url("register", 	"organization", "register");
$route->url("cek_username", "organization", "checkUsername");
$route->url("lihat_organisasi/:id", "organization", "showOrganization");
$route->url("lihat_registrasi/:id", "organization", "showRegistration");
$route->url("lihat_anggota/:nim", 	"organization", "memberDetail");
$route->url("tambah_registrasi", 	"organization", "addRegistration");
$route->url("dokumentasi_api", 	    "organization", "apiDocumentation");
$route->url("tambah_url", 			"organization", "addURL");
$route->url("hapus_registrasi/:id", "organization", "deleteRegistration");
$route->url("hapus_anggota/:nim",   "organization", "deleteMember");
$route->url("download_csv", 		"organization", "downloadCSV");
$route->url("proses_tambah_registrasi", "organization", "processAddRegistration");

//--------------- Restful -----------------//

$route->url("tangkapPost",  "api",  "tangkapPost");
$route->url("get_webhook",  "home", "getWebhook");
$route->url("read_webhook", "home", "readWebhook");

$route->url("verifikasi_registrasi", "api", "verifyRegistration");
$route->url("verifikasi_key", "api", "verifyKey");
$route->url("new_member",     "api", "newMember");
$route->url("new_member_bc",  "api", "newMemberBC");
$route->url("api/get/:key",   "api", "getMembers");
$route->url("api/delete",	  "api", "deleteMember");