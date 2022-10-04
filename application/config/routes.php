<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'not_found';
$route['translate_uri_dashes'] = FALSE;

// route admin
$route['admin'] = 'admin/dashboard';
// route distribusi
$route['distribusi'] = 'distribusi/dashboard';
// route supplier
$route['supplier'] = 'supplier/dashboard';
// route home
$route['tentang']     = 'home/tentang';
$route['kontak']      = 'home/kontak';
$route['distributor'] = 'home/distributor';