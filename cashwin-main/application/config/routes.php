<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//user routes
$route['users/register'] = 'users/register';
$route['users/dashboard'] = 'users/dashboard';
$route['comments/create/(:any)'] = 'comments/create/$1';
$route['categories'] = 'category/index';
$route['categories/create'] = 'category/create';
$route['categories/posts/(:any)'] = 'category/posts/$1';
$route['categories/delete/(:any)'] = 'category/delete/$1';
$route['posts/index'] = 'posts/index';
$route['posts/update'] = 'posts/update';
$route['posts/delete/(:any)'] = 'posts/delete/$1';
$route['posts/create'] = 'posts/create';
$route['posts/(:any)'] = 'posts/view/$1';
$route['posts'] = 'posts/index';
$route['default_controller'] = 'pages/index';
$route['chart'] = 'pages/chart';
$route['charts'] = 'pages/charts';
$route['starline_chart'] = 'pages/starline_chart';
$route['game_rates'] = 'pages/game_rates';
$route['web_chart'] = 'pages/web_chart';
$route['web_jodi_chart'] = 'pages/web_jodi_chart';

//admin routs
//$route['admin'] = 'administrator/view';
// $route['admin'] = 'administrator/view';


$route['admin'] = 'login/index';
$route['admin/login'] = 'login/index';
//$route['admin1/logout'] = 'login/logout';
$route['admin/home'] = 'admin/home';
$route['admin/index'] = 'admin/index';
$route['admin/forget-password'] = 'admin/forget_password';

$route['admin/dashboard'] = 'admin/dashboard';

$route['admin/change-password'] = 'admin/get_admin_data';
$route['admin/update-profile'] = 'admin/update_admin_profile';

$route['admin/users/add-user'] = 'admin/add_user';
$route['admin/users'] = 'admin/users';
$route['admin/users/update-user/(:any)'] = 'admin/update_user/$1';

$route['admin/sliders/create'] = 'admin/create_slider';
$route['admin/sliders'] = 'admin/get_sliders';
$route['admin/sliders/update/(:any)'] = 'admin/update_slider/$1';

$route['admin/matka/add'] = 'admin/add_matka';
$route['admin/matka/list'] = 'admin/list_matka';
$route['admin/dmatka/list'] = 'admin/list_matka/0/dmatka';
$route['admin/matka/update/(:any)'] = 'admin/update_matka/(:any)';

$route['admin/matka/member_list'] = 'admin/member_list_team';


// $route['admin1'] = 'login/index';
// $route['admin1/login'] = 'login/index';
// //$route['admin1/logout'] = 'login/logout';
// $route['admin1/home'] = 'admin1/home';
// $route['admin1/index'] = 'admin1/index';
// $route['admin1/forget-password'] = 'admin1/forget_password';

// $route['admin1/dashboard'] = 'admin1/dashboard';

// $route['admin1/change-password'] = 'admin1/get_admin_data';
// $route['admin1/update-profile'] = 'admin1/update_admin_profile';

// $route['admin1/users/add-user'] = 'admin1/add_user';
// $route['admin1/users'] = 'admin1/users';
// $route['admin1/users/update-user/(:any)'] = 'admin1/update_user/$1';

// $route['admin1/sliders/create'] = 'admin1/create_slider';
// $route['admin1/sliders'] = 'admin1/get_sliders';
// $route['admin1/sliders/update/(:any)'] = 'admin1/update_slider/$1';

// $route['admin1/matka/add'] = 'admin1/add_matka';
// $route['admin1/matka/list'] = 'admin1/list_matka';
// $route['admin1/matka/update/(:any)'] = 'admin1/update_matka/(:any)';

// $route['admin1/matka/member_list'] = 'admin1/member_list_team';

$route['UserDashboard/(:any)'] = 'UserDashboard/dashboard/$1';
$route['UserDashboard/total_bids/(:any)'] = 'UserDashboard/total_bids_by_id/$1';
$route['UserDashboard/debit_credit_details/(:any)'] = 'UserDashboard/debit_credit_details_by_id/$1';

$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;