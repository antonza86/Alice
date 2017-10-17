<?php
//Dynamically add Javascript files to header page
if(!function_exists('get_city')){
    function get_city($city_id)
    {
    	return get_all_city()[$city_id][key(get_all_city()[$city_id])];
	}
}

if(!function_exists('get_city_key')){
    function get_city_key($city_id)
    {
    	return key(get_all_city()[$city_id]);
	}
}

if(!function_exists('get_all_city')){
    function get_all_city()
    {
	    $city = array(
			1 => array(
					"aveiro" => "Aveiro"
				),
			2 => array(
					"lisboa" => "Lisboa"
				),
			3 => array(
					"porto" => "Porto"
				),
			4 => array(
					"maia" => "Maia"
				),
			5 => array(
					"cascais" => "Cascais"
				),
			6 => array(
					"seixal" => "Seixal"
				),
			7 => array(
					"almada" => "Almada"
				),
			8 => array(
					"figueira_da_foz" => "Figueira da Foz"
				),
			9 => array(
					"oeiras" => "Oeiras"
				),
			10 => array(
					"linda_a_velha" => "Linda-a-Velha"
				),
			11 => array(
					"sintra" => "Sintra"
				),
			12 => array(
					"odivelas" => "Odivelas"
				)
		);

		return $city;
	}
}
