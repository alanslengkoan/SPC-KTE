<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'auth/login';
$route['404_override']         = 'not_found';
$route['translate_uri_dashes'] = FALSE;

// route admin
$route['admin'] = 'admin/dashboard';

// route api
$route['api/konsultasi']                = 'api/konsultasi';
$route['api/konsultasi/detail/{id}']    = 'api/konsultasi/detail';
$route['api/konsultasi/save']           = 'api/konsultasi/save';
$route['api/konsultasi/result/{id}']    = 'api/konsultasi/result';
$route['api/konsultasi/img_one/{id}']   = 'api/konsultasi/img_one';
$route['api/konsultasi/img_two/{id}']   = 'api/konsultasi/img_two';
$route['api/konsultasi/img_three/{id}'] = 'api/konsultasi/img_three';
$route['api/konsultasi/img_four/{id}']  = 'api/konsultasi/img_four';