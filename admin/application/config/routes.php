<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'welcome';

$route['sign-in'] = 'Welcome/index';
$route['authentication'] = 'C_connexions/authentication';
$route['se_deconnecter'] = 'C_connexions/se_deconnecter';

$route['dashboard'] = 'C_connexions/home';


