<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pages/view';
$route['posts'] = 'posts/index';
$route['tasks'] = 'tasks/all_tasks';
$route['404_override'] = '';
// $route['(:any)'] = 'pages/view/$1';
$route['translate_uri_dashes'] = FALSE;
