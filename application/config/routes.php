<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'landing';
$route['profile'] = 'profile';
$route['restaurants'] = 'restaurants';
$route['landing/search'] = 'landing/search';
$route['usercontroller/validate'] = 'usercontroller/validate';
$route['usercontroller/logout'] = 'usercontroller/logout';
$route['usercontroller/register'] = 'usercontroller/register';
$route['usercontroller/complete'] = 'usercontroller/complete';
$route['usercontroller/forgot'] = 'usercontroller/forgot';
$route['usercontroller/reset_password'] = 'usercontroller/reset_password';
$route['profile/save_profile'] = 'profile/save_profile';
$route['profile/repeat_order'] = 'profile/repeat_order';
$route['fblogin'] = 'fblogin/login';
$route['fblogin/finish_login'] = 'fblogin/finish_login';
$route['cart'] = 'cart';
$route['admin'] = 'admin';
$route['admin/do_upload'] = 'admin/do_upload';
$route['cart/finish_cart'] = 'cart/finish_cart';
$route['favorite/add_favorite'] = 'favorite/add_favorite';
$route['favorite/remove_favorite'] = 'favorite/remove_favorite';
$route['favorite/remove_favorite_by_restid'] = 'favorite/remove_favorite_by_restid';
$route['ajax'] = 'ajax/get_html';
$route['(:any)/(:any)/(:any)/ajax'] = 'ajax/get_html';

$route['(?i)aveiro']			 = 'restaurants';
$route['(?i)lisboa']			 = 'restaurants';
$route['(?i)porto']				 = 'restaurants';
$route['(?i)maia']				 = 'restaurants';
$route['(?i)cascais']			 = 'restaurants';
$route['(?i)seixal']			 = 'restaurants';
$route['(?i)almada']			 = 'restaurants';
$route['(?i)figueira_da_foz']	 = 'restaurants';
$route['(?i)oeiras']		 	 = 'restaurants';
$route['(?i)linda_a_velha']		 = 'restaurants';
$route['(?i)sintra']		 	 = 'restaurants';
$route['(?i)odivelas']			 = 'restaurants';

$route['(:any)'] = 'restaurant';
$route['restaurants/get_more_data'] = 'restaurants/get_more_data';
$route['restaurants/filter'] = 'restaurants/filter';
$route['restaurants/(:any)'] = 'restaurant';
$route['restaurants/(:any)/get_more_product'] = 'restaurant/get_more_product';
$route['restaurants/(:any)/category/(:any)/(:any)'] = "restaurant/get_products_by_category";
$route['(:any)/category_mobile/(:any)/(:any)'] = "restaurant/get_products_by_category_mobile";
$route['restaurants/(:any)/get_extras'] = 'restaurant/get_extras';
$route['teste'] = 'homecontroller';
//$route['login'] = 'login';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
