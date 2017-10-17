<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| BREADCRUMB CONFIG
| -------------------------------------------------------------------
| This file will contain some breadcrumbs' settings.
|
| $config['crumb_divider']		The string used to divide the crumbs
| $config['tag_open'] 			The opening tag for breadcrumb's holder.
| $config['tag_close'] 			The closing tag for breadcrumb's holder.
| $config['crumb_open'] 		The opening tag for breadcrumb's holder.
| $config['crumb_close'] 		The closing tag for breadcrumb's holder.
|
| Defaults provided for twitter bootstrap 2.0
*/

//$config['crumb_divider'] = '<span class="divider">/</span>';
//$config['tag_open'] = '<ul class="breadcrumb">';
//$config['tag_close'] = '</ul>';
//$config['crumb_open'] = '<li>';
//$config['crumb_last_open'] = '<li class="active">';
//$config['crumb_close'] = '</li>';
$config['crumb_divider'] = '&nbsp;/&nbsp;';
$config['tag_open'] = '<div class="breadcrumbs-org row"><div class="col s-7">';
$config['tag_close'] = '</div><div class="col s-5 text-right before-closing" data-closing="" data-type="restaurants"></div></div>';
$config['crumb_open'] = '';
$config['crumb_last_open'] = '<span>';
$config['crumb_last_close'] = '</span>';
$config['crumb_close'] = '';

$config['restaurants_crumb_divider'] = '&nbsp;/&nbsp;';
$config['restaurants_tag_open'] = '<div class="col s-7"><div class="breadcrumbs">';
$config['restaurants_tag_close'] = '</div></div>';
$config['restaurants_crumb_open'] = '';
$config['restaurants_crumb_last_open'] = '<div><span>';
$config['restaurants_crumb_last_close'] = '</span><i class="breadcrumbs_arrow sprite sprite-ico-breadcrumbs-end"></i></div>';
$config['restaurants_crumb_close'] = '';



/* End of file breadcrumbs.php */
/* Location: ./application/config/breadcrumbs.php */