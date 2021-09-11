<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';

/* peserta */
$route['terms-and-conditions'] = 'Home/terms_condition';
$route['home'] = 'Home/home';
$route['register'] = 'Peserta/submit_register';
$route['register-personal-info/(:any)'] = 'Peserta/personal_info/$1';
$route['personal-info'] = 'Peserta/submit_personal_info';
$route['confirm-phone/(:any)'] = 'Peserta/confirm_phone/$1';
$route['confirm-success/(:any)'] = 'Peserta/verification_success/$1';
$route['nilai-raport/(:any)'] = 'Peserta/input_nilai_raport/$1';
$route['raport-submit'] = 'Peserta/submit_nilai_raport';
$route['prestasi/(:any)'] = 'Peserta/input_prestasi/$1';
$route['prestasi-submit'] = 'Peserta/submit_input_prestasi';
$route['prodi/(:any)'] = 'Peserta/input_program_studi/$1';
$route['prodi-submit'] = 'Peserta/submit_input_program_studi';
/* end peserta */

/* perhitungan hasil */
$route['result/(:any)'] = 'Core/submit_result/$1';
/* end perhitungan hasil */

/* click grandsbmptn */
$route['click-grandsbmptn/(:any)'] = 'Core/click_grandsbmptn/$1';
/* end click grandsbmptn */

/* admin */
$route['admin'] = 'admin/Home';
$route['admin/access'] = 'admin/Home/access_admin';
$route['admin/download/excel/data-peserta/(:num)'] = 'admin/Home/download_excel/$1';
$route['admin/login'] = 'admin/Login/login';
$route['admin/submit-login'] = 'admin/Login/submit_login';
$route['admin/logout'] = 'admin/Home/logout';
$route['admin/master/provinsi'] = 'admin/Data_master/provinsi';
$route['admin/master/add-provinsi'] = 'admin/Data_master/add_provinsi';
$route['admin/master/update-provinsi/(:num)'] = 'admin/Data_master/update_provinsi/$1';
$route['admin/master/delete-provinsi/(:num)'] = 'admin/Data_master/delete_provinsi/$1';
$route['admin/master/active-provinsi/(:num)'] = 'admin/Data_master/active_provinsi/$1';
$route['admin/master/kota-kab'] = 'admin/Data_master/kota_kab';
$route['admin/master/add-kota-kab'] = 'admin/Data_master/add_kota_kab';
$route['admin/master/update-kota-kab/(:num)'] = 'admin/Data_master/update_kota_kab/$1';
$route['admin/master/delete-kota-kab/(:num)'] = 'admin/Data_master/delete_kota_kab/$1';
$route['admin/master/active-kota-kab/(:num)'] = 'admin/Data_master/active_kota_kab/$1';
$route['admin/master/jurusan-sekolah'] = 'admin/Data_master/jurusan_sekolah';
$route['admin/master/add-jurusan-sekolah'] = 'admin/Data_master/add_jurusan_sekolah';
$route['admin/master/update-jurusan-sekolah/(:num)'] = 'admin/Data_master/update_jurusan_sekolah/$1';
$route['admin/master/delete-jurusan-sekolah/(:num)'] = 'admin/Data_master/delete_jurusan_sekolah/$1';
$route['admin/master/active-jurusan-sekolah/(:num)'] = 'admin/Data_master/active_jurusan_sekolah/$1';
$route['admin/master/sekolah'] = 'admin/Data_master/sekolah';
$route['admin/master/sekolah/all'] = 'admin/Data_master/sekolah_all';
$route['admin/master/add-sekolah'] = 'admin/Data_master/add_sekolah';
$route['admin/master/update-sekolah/(:num)'] = 'admin/Data_master/update_sekolah/$1';
$route['admin/master/delete-sekolah/(:num)'] = 'admin/Data_master/delete_sekolah/$1';
$route['admin/master/active-sekolah/(:num)'] = 'admin/Data_master/active_sekolah/$1';
$route['admin/master/prodi'] = 'admin/Data_master/jurusan_universitas';
$route['admin/master/prodi/all'] = 'admin/Data_master/jurusan_universitas_all';
$route['admin/master/add-prodi'] = 'admin/Data_master/add_jurusan_universitas';
$route['admin/master/update-prodi/(:num)'] = 'admin/Data_master/update_jurusan_universitas/$1';
$route['admin/master/delete-prodi/(:num)'] = 'admin/Data_master/delete_jurusan_universitas/$1';
$route['admin/master/active-prodi/(:num)'] = 'admin/Data_master/active_jurusan_universitas/$1';
$route['admin/master/universitas'] = 'admin/Data_master/universitas';
$route['admin/master/add-universitas'] = 'admin/Data_master/add_universitas';
$route['admin/master/update-universitas/(:num)'] = 'admin/Data_master/update_universitas/$1';
$route['admin/master/delete-universitas/(:num)'] = 'admin/Data_master/delete_universitas/$1';
$route['admin/master/active-universitas/(:num)'] = 'admin/Data_master/active_universitas/$1';
$route['admin/peserta'] = 'admin/Peserta/peserta';
$route['admin/peserta/all'] = 'admin/Peserta/peserta_all';
$route['admin/peserta/download-excel'] = 'admin/Peserta/peserta_excel';
$route['admin/nilai-semester'] = 'admin/Peserta/nilai_semester';
$route['admin/nilai-semester/all'] = 'admin/Peserta/nilai_semester_all';
$route['admin/nilai-semester/download-excel'] = 'admin/Peserta/nilai_semester_excel';
$route['admin/prestasi'] = 'admin/Peserta/prestasi';
$route['admin/prestasi/all'] = 'admin/Peserta/prestasi_all';
$route['admin/prestasi/download-excel'] = 'admin/Peserta/prestasi_excel';
$route['admin/prodi'] = 'admin/Peserta/program_studi';
$route['admin/prodi/all'] = 'admin/Peserta/program_studi_all';
$route['admin/prodi/download-excel'] = 'admin/Peserta/program_studi_excel';
$route['admin/hasil-rasionalisasi'] = 'admin/Peserta/hasil_rasionalisasi';
$route['admin/hasil-rasionalisasi/all'] = 'admin/Peserta/hasil_rasionalisasi_all';
$route['admin/hasil-rasionalisasi/download-excel'] = 'admin/Peserta/hasil_rasionalisasi_excel';
/* end admin */

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
