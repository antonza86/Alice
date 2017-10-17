<?php
	class Cart extends CI_Controller{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model("CartModel");
	    }

		public function index(){
			if($this->session->userdata('logged_in')){
				$this->addAssets();

				$data['mobile'] = false;
				$data['favorite'] = getFavoriteList($this);

				$array_rest = [];
				$array_prod = [];
				$array_extras = [];
				if(isset($_COOKIE["cart"])) {
					$cart = json_decode($_COOKIE["cart"], true);
					foreach ($cart as $key_city => $value_city){
						foreach ($value_city as $key => $value){
							array_push($array_rest, $key);
							foreach ($value["products"] as $key2 => $value2){
								foreach ($value2 as $key3 => $value3){
									if($key3 == "id"){
										array_push($array_prod, $value3);
									}else if($key3 == "extra"){
										$array_extras = array_merge($array_extras, $value3);
									}
								}
							}
						}
					}

					$data['cart'] = $value_city;
					$data['city_id'] = $key_city;

					
					$restaurants = 		$this->CartModel->getRestaurants(array_unique($array_rest));
					$cityZone = 		$this->CartModel->getCityZone($data['city_id']);
					$zonas = 			$this->CartModel->getZonas(array_unique($array_rest));
					$products = 		$this->CartModel->getProducts(array_unique($array_prod));
					$userDetails = 		$this->CartModel->getUser($this->session->userdata('logged_in')['id']);

					$data['userDetails'] = $userDetails;

					if(count($array_extras) != 0 )
						$product_extras = 	$this->CartModel->getExtras(array_unique($array_extras));
					else
						$product_extras = array();

					///////////// Clean values -> {id: Name} /////////////////
					$clean_restaurants = array();
					foreach ($restaurants as $key => $value){
						$clean_restaurants[$value['id']] = array(	"name" => $value['name'], 
																	"url_name" => $value['url_name']);
					}
					$data['clean_restaurants'] = $clean_restaurants;
					///////////////////////////////////////////////////////////
					$clean_city_zone = array();
					foreach ($cityZone as $key => $value){
						$clean_city_zone[$value['id']] = $value['name'];
					}
					$data['clean_city_zone'] = $clean_city_zone;
					///////////////////////////////////////////////////////////
					$data['clean_zonas'] = $this->create_clean_zonas($zonas);
					///////////////////////////////////////////////////////////
					$data['clean_products'] = $this->create_clean_product($products);
					///////////////////////////////////////////////////////////
					$data['clean_product_extras'] = $this->create_clean_product_extras($product_extras);
					///////////////////////////////////////////////////////////
					$data['city_name'] = get_city_key($key_city);

					
					$data['mobile'] = get_mobile_type();
					
					if($data['mobile']){
						$this->addAssetsMobile();
						$data['restaurant'] = true;
						$this->load->template_mobile('mobile/cart/index', $data);
					}
					else{
						$this->addAssets();
						$this->load->template('cart/index', $data);
					}
				}else{
					$this->load->template('restaurants/index', $data);
				}
			}else{
				redirect("/");
			}
		}

		public function create_clean_zonas($zonas){
			$clean_zonas = array();
			foreach ($zonas as $key => $value){
				if(array_key_exists($value['refRest'], $clean_zonas)) {
					$clean_zonas[$value['refRest']][$value['refZona']] = array(
																"price" 	=> $value['price'],
																"bonus" 	=> $value['bonus'],
																"discount" 	=> $value['discount']
																	);
				}else{
					$clean_zonas[$value['refRest']] = array($value['refZona'] => 
															array(
																"price" 	=> $value['price'],
																"bonus" 	=> $value['bonus'],
																"discount" 	=> $value['discount']
																));
				}
			}
			return $clean_zonas;
		}

		public function create_clean_product($products){
			$clean_products = array();
			foreach ($products as $key => $value){
				$clean_products[$value['id']] = array(	"name" => $value['name'], 
														"url" => $value['url'],
														"price" => $value['price']);
			}
			return $clean_products;
		}

		public function create_clean_product_extras($product_extras){
			$clean_product_extras = array();
			foreach ($product_extras as $key => $value){
				$clean_product_extras[$value['id']] = array(	"name" => $value['name'], 
																"price" => $value['price']);
			}
			return $clean_product_extras;
		}

		public function addBreadcrumbs($city_url, $city_name, $restaurant_name){
			// load Breadcrumbs
			$this->load->library('breadcrumbs');

			// add breadcrumbs
			$this->breadcrumbs->push('Rabbeat', '/?city_name='.$city_url);
			$this->breadcrumbs->push($city_name, '/'.$city_url);
			$this->breadcrumbs->push($restaurant_name, '/'.$restaurant_name);
		}

		public function addAssets(){
			$url_css = "assets/stylesheets/restaurant/";

			$my_css = array(
				//$url_css."application.css"
				);
			$my_js = array(
				"assets/javascripts/cart/application.js",
				"assets/javascripts/landing/application.js"
				);

			add_css($my_css);
			add_js($my_js);
		}

		public function addAssetsMobile(){
			//$url_css = "assets/stylesheets/restaurant/";

			//$my_css = array(
				//$url_css."application.css"
			//	);
			$my_js = array(
				"assets/javascripts/cart/application.js",
				"assets/javascripts/landing/application.js"
				);

			//add_css($my_css);
			add_mobile_js($my_js);
		}

		public function finish_cart(){
			if($this->session->userdata('logged_in')){
				$data['name']  = $this->input->post('name');
				$data['phone']  = $this->input->post('phone');
				$data['zone']  = $this->input->post('zone');
				$data['address']  = $this->input->post('street');
				$data['city']  = $this->input->post('city');
				$data['comment']  = $this->input->post('comment');
				$data['payment_type']  = $this->input->post('payment_type');
				if($data['name'] == "" || $data['phone'] == "" || $data['address'] == "" || $data['zone'] == "" || $data['city'] == "")
					echo "required_fields";
				else{
					if(isset($_COOKIE["cart"])) {
						$cart = json_decode($_COOKIE["cart"], true);
						$this->cart_processing($cart, $data);
					}else{
						redirect("/");
					}
				}
			}else{
				redirect("/");
			}
		}

		public function cart_processing($cart, $data){
			$array_prod = [];
			$array_extras = [];
			$rest = array_keys(current($cart))[0];
			$data["rest"] = $rest;
			$product_list = current(current($cart))['products'];
			$product_list_count = count($product_list);
			
			foreach ($product_list as $key2 => $value2){
				foreach ($value2 as $key3 => $value3){
					if($key3 == "id"){
						array_push($array_prod, $value3);
					}else if($key3 == "extra"){
						$array_extras = array_merge($array_extras, $value3);
					}
				}
			}
			
			$zonas = 			$this->CartModel->getZona($data['zone']);
			$products = 		$this->CartModel->getProducts(array_unique($array_prod));

			if(count($array_extras) != 0 )
				$product_extras = 	$this->CartModel->getExtras(array_unique($array_extras));
			else
				$product_extras = array();
			$clean_products = $this->create_clean_product($products);
			$clean_product_extras = $this->create_clean_product_extras($product_extras);

			$total_price = 0;
			foreach ($product_list as $key2 => $value2){
				$product_extras_price = 0;
				if(count($value2['extra']) != 0 ){
					foreach ($value2['extra'] as $index => $extra_id) {
						$product_extras_price += $clean_product_extras[$extra_id]['price'];
					}
				}
				$total_price += ($clean_products[$value2['id']]['price'] + $product_extras_price) * $value2['qnt'];
			}
			$delivery_price = 0;
			if($total_price > $zonas['bonus'])
				$delivery_price = $zonas['price'] - $zonas['price'] * $zonas['discount']/100;
			else
				$delivery_price = $zonas['price'];

			$data['total_price'] = $total_price;
			$data['delivery_price'] = $delivery_price;

			$this->addOrderToDB($cart, $data, $product_list_count);
		}

		public function addOrderToDB($cart, $data, $product_list_count){
			$order_id = $this->CartModel->addOrder($data);

			$product_list = current(current($cart))['products'];
			$order_prod_result = $this->CartModel->addOrderProd($product_list, $order_id);
			if($order_prod_result == $product_list_count)
				echo "success";
			else
				echo "error";
		}

	}

?>