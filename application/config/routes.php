<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'c_presensi';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'c_admin';
$route['admin/create-barcode'] = 'c_admin/create_barcode';
$route['admin/barcode'] = 'c_admin/management_barcode';

// database
$route['admin/insert-barcode'] = 'c_admin/insert_barcode';



$route['tes'] = 'c_admin/tes';
