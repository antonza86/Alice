<?php
if(!function_exists('get_checkbox_filter_list')){
  function get_checkbox_filter_list()
  {
		return array(
			array(
				"name" => "Entrega gratuita",
				"value" => "delivery"
			),array(
				"name" => "Pagamento online",
				"value" => "online"
			),array(
				"name" => "Pagamento multibanco",
				"value" => "card"
			),array(
				"name" => "Aberto agora",
				"value" => "work"
			)
		);
	}
}

if(!function_exists('get_cuisine_list')){
  function get_cuisine_list()
  {
		return array(
			1 => array(
				"name" => "Sushi",
				"value" => "sushi"
			),
			2 => array(
				"name" => "Pizza",
				"value" => "pizza"
			),
			3 => array(
				"name" => "Espetadas",
				"value" => "shashlik"
			),
			4 => array(
				"name" => "Bolos",
				"value" => "desert"
			),
			5 => array(
				"name" => "Hamburgeres",
				"value" => "burger"
			)
		);
	}
}

if(!function_exists('get_cuisine_alt_list')){
  function get_cuisine_alt_list()
  {
		return array(
			6 => array(
				"name" => "Americana",
				"value" => "usa"
			),
			7 => array(
				"name" => "Europea",
				"value" => "cuisine-europe"
			),
			8 => array(
				"name" => "Italiana",
				"value" => "italy"
			),
			9 => array(
				"name" => "Chinesa",
				"value" => "cuisine-chinese"
			),
			10 => array(
				"name" => "Mexicana",
				"value" => "mexico"
			),
			11 => array(
				"name" => "Exotica",
				"value" => "ecsotic"
			),
			12 => array(
				"name" => "Japonesa",
				"value" => "cuisine-japan"
			)
		);
	}
}