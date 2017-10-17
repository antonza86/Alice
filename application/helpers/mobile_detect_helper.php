<?php
//Dynamically add Javascript files to header page
if(!function_exists('get_mobile_type')){
  function get_mobile_type()
  {
		require_once APPPATH.'vendor\Mobile-Detect\namespaced\Detection\MobileDetect.php';
		$detect = new Mobile_Detect;

		// Any mobile device (phones or tablets).
		if( $detect->isMobile() )
			$mobile = true;
		else
			$mobile = false;
		 
		// Any tablet device.
		if( $detect->isTablet() ){
		}
		 
		// Exclude tablets.
		if( $detect->isMobile() && !$detect->isTablet() ){
		}
		 
		// Check for a specific platform with the help of the magic methods:
		if( $detect->isiOS() ){
		}
		 
		if( $detect->isAndroidOS() ){
		}

		return $mobile;
	}
}