<?php
class LanguageLoader
{
  function initialize() {
    $ci =& get_instance();
    $ci->load->helper('language');
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $default_lang = $ci->config->item("language");
    $langs = $ci->config->item("languages");
    if(in_array($lang, $langs))
  	  $ci->lang->load('landing', $lang);
  	else
	    $ci->lang->load('landing', $default_lang);
  }
}