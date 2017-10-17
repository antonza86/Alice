<?php
	class Restaurant extends CI_Controller{
		public function __construct() {
	        parent::__construct();
	    }

		public function index(){
			$url = current_url();
			$array = explode("/",$url);
			$restaurant_name = array_pop($array);
			$data['restaurant_name'] = $restaurant_name;


			$this->load->model("RestaurantModel");
			$data['restaurant_info'] = $this->RestaurantModel->getRestaurant($restaurant_name);
			$data['categories'] = $this->RestaurantModel->getCategories($restaurant_name);
			$data['products'] = $this->RestaurantModel->getAllProducts($restaurant_name,0,6);

			$data['city_name'] = $data['restaurant_info']['url_name_city'];
			$data['city_id'] = $data['restaurant_info']['city_id'];
			
			$this->addBreadcrumbs($data['city_name'], $data['restaurant_info']['original_name_city'], $data['restaurant_info']['name']);

			//Caso nao exista resultados, volta para a lista de restaurantes
			if(count($data['restaurant_info']) == 0)
				redirect('/restaurants');

			$data['mobile'] = get_mobile_type();
			
			if($this->session->userdata('logged_in')){
				$data['favorite'] = getFavoriteList($this);
			}
			
			if($data['mobile']){
				$this->addAssetsMobile();
				$data['restaurant'] = true;
				$this->load->template_mobile('mobile/restaurant/index', $data);
			}
			else{
				$this->addAssets();
				$this->load->template('restaurant/index', $data);
			}

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
				"assets/javascripts/restaurant/application.js",
				"assets/javascripts/landing/application.js"
				);

			add_css($my_css);
			add_js($my_js);
		}

		public function addAssetsMobile(){
			$my_js = array(
				"assets/javascripts/restaurant/application.js",
				"assets/javascripts/landing/application.js"
				);

			add_mobile_js($my_js);
		}

		public function get_products_by_category(){
			$url = current_url();
			$array = explode("/",$url);
			$sub_cat = array_pop($array);
			$cat = array_pop($array);
			$category = array_pop($array);
			$restaurant_name = array_pop($array);

			$data['restaurant_name'] = $restaurant_name;

			$this->load->model("RestaurantModel");
			if($cat == 0 && $sub_cat == 0)
				$data['products'] = $this->RestaurantModel->getAllProducts($restaurant_name,0,6);
			else
				$data['products'] = $this->RestaurantModel->getProducts($restaurant_name, $cat, $sub_cat);
			echo json_encode ($this->load->view('restaurant/product_list', $data));
		}

		public function get_products_by_category_mobile(){
			$url = current_url();
			$array = explode("/",$url);
			$sub_cat = array_pop($array);
			$cat = array_pop($array);
			$category = array_pop($array);
			$restaurant_name = array_pop($array);

			$data['restaurant_name'] = $restaurant_name;

			$this->load->model("RestaurantModel");
			$data['products'] = $this->RestaurantModel->getProducts($restaurant_name, $cat, $sub_cat);
			$all_categories = $this->RestaurantModel->getCategories_ids($restaurant_name);
			$data['category'] = $this->RestaurantModel->getCategory_by_id($restaurant_name, $cat, $sub_cat);

			$data['restaurant_info'] = $this->RestaurantModel->getRestaurant($restaurant_name);
			$data['city_name'] = $data['restaurant_info']['url_name_city'];
			$data['city_id'] = $data['restaurant_info']['city_id'];

			if(count($data['category']) != 1){
				$category_to_compare = $data['category'][1]['id'];
			}else{
				$category_to_compare = $data['category'][0]['id'];
			}
			$next = array();
			$prev = array();
			foreach ($all_categories as $index => $value){
				if($category_to_compare == $value['id']){
					if($index == 0){
						$prev['cat'] = $all_categories[count($all_categories) -1]['cat'];
						$prev['sub_cat'] = $all_categories[count($all_categories) -1]['sub_cat'];
						$next['cat'] = $all_categories[$index + 1]['cat'];
						$next['sub_cat'] = $all_categories[$index + 1]['sub_cat'];
					}else if($index == count($all_categories) - 1){
						$prev['cat'] = $all_categories[$index - 1]['cat'];
						$prev['sub_cat'] = $all_categories[$index - 1]['sub_cat'];
						$next['cat'] = $all_categories[0]['cat'];
						$next['sub_cat'] = $all_categories[0]['sub_cat'];
					}else{
						$prev['cat'] = $all_categories[$index - 1]['cat'];
						$prev['sub_cat'] = $all_categories[$index - 1]['sub_cat'];
						$next['cat'] = $all_categories[$index + 1]['cat'];
						$next['sub_cat'] = $all_categories[$index + 1]['sub_cat'];
					}
				}
			}
			$data['prev'] = $prev;
			$data['next'] = $next;

			$this->addAssetsMobile();
			$data['restaurant'] = false;
			$this->load->template_mobile('mobile/restaurant/index', $data);
		}

		public function get_more_product(){
			$url = current_url();
			$array = explode("/",$url);
			$function_name = array_pop($array);
			$restaurant_name = array_pop($array);
			$offset = $this->input->get('offset');
			$limit = $this->input->get('limit');

			$data['restaurant_name'] = $restaurant_name;

			$this->load->model("RestaurantModel");
			$data['products'] = $this->RestaurantModel->getAllProducts($restaurant_name,intval($offset),intval($limit));
			echo json_encode ($this->load->view('restaurant/product_list', $data));
		}

		public function get_extras(){
			$product_id = $this->input->get('product_id');
			$data['prod_id'] = $product_id;

			$this->load->model("RestaurantModel");
			$data['extras'] = $this->RestaurantModel->getProductExtras(intval($product_id));
			echo json_encode ($this->load->view('restaurant/extras', $data));
		}
	}

?>