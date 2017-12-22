<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'c_presensi';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'c_admin';
$route['admin/create-barcode'] = 'c_admin/create_barcode';
$route['admin/barcode'] = 'c_admin/management_barcode';

$route['delete-barcode'] = 'c_admin/delete_barcode';

// database
$route['admin/insert-barcode'] = 'c_admin/insert_barcode';
$route['get-dosen'] = 'c_admin/get_dosen';
$route['get-report'] = 'c_admin/get_report';

$route['insert-log'] = 'c_presensi/insert_log';
$route['cek-status/(:any)'] = 'c_presensi/cek_status/$1';
$route['cek-lecturer/(:any)'] = 'c_presensi/cek_lecturer/$1';

$route['logging'] = 'c_presensi/logging';

$route['logging/today'] = 'c_presensi';
$route['logging/all'] = 'c_presensi/table_all_logging';

$route['logging/presensi'] = 'c_presensi/presensi';

$route['user-log'] = 'c_presensi/get_user_log';


$route['data-barcode'] = 'c_presensi/get_barcode';

$route['logging/belum-kembali'] = 'c_presensi/get_all_ambil';

$route['set-session'] = 'c_presensi/set_session';
$route['log-out'] = 'c_presensi/log_out';








$route['tes'] = 'c_admin/tes';
