<?php
	class Landing extends CI_Controller{
		public function __construct() {
			parent::__construct();
		}
		public function index(){
			$data['mobile'] = get_mobile_type();

			$url = current_url();
			$array = explode("/",$url);
			$result = array_pop($array);

			$city_name = $this->input->get('city_name');
			if($city_name == "")
				$city_name = "Aveiro";
			$data["city_name"] = $city_name;
			$data["city_id"] = "1";

			$data['slider'] = array(
				0 => array(
					"img_link" => "assets/images/slider/home/01.jpg",
					"tooltip" => ""
					),
				1 => array(
					"img_link" => "assets/images/slider/home/02.jpg",
					"tooltip" => ""
					),
				2 => array(
					"img_link" => "assets/images/slider/home/03.jpg",
					"tooltip" => ""
					),
				3 => array(
					"img_link" => "assets/images/slider/home/04.jpg",
					"tooltip" => ""
					)
				);
			$data['menu_list'] = array(
				0 => array(
					"img_link" => "assets/images/restaurants.png",
					"name" => $this->lang->line('category_restaurant'),
					"icon" => "catalog-ico catalog-ico-restaurant",
					"target" => ""
					),
				1 => array(
					"img_link" => "assets/images/sushi.png",
					"name" => $this->lang->line('category_sushi'),
					"icon" => "catalog-ico catalog-ico-sushi",
					"target" => "?filter=sushi"
					),
				2 => array(
					"img_link" => "assets/images/pizza.png",
					"name" => $this->lang->line('category_pizza'),
					"icon" => "catalog-ico catalog-ico-pizza",
					"target" => "?filter=pizza"
					),
				3 => array(
					"img_link" => "assets/images/shashlik.png",
					"name" => $this->lang->line('category_espetadas'),
					"icon" => "catalog-ico catalog-ico-shashlik",
					"target" => "?filter=shashlik"
					),
				4 => array(
					"img_link" => "assets/images/desert.png",
					"name" => $this->lang->line('category_sobremesa'),
					"icon" => "catalog-ico catalog-ico-desert",
					"target" => "?filter=desert"
					),
				5 => array(
					"img_link" => "assets/images/burger.png",
					"name" => $this->lang->line('category_hamburgueres'),
					"icon" => "catalog-ico catalog-ico-burger",
					"target" => "?filter=burger"
					)
			);

			if($this->session->userdata('logged_in')){
				$data['favorite'] = getFavoriteList($this);
			}

			$data['source'] = "landing";
			
			if($data['mobile']){
				$this->addAssetsMobile();
				$this->load->template_mobile('mobile/landing/index', $data);
			}
			else{
				$this->addAssets();
				$this->load->template('landing/index', $data);
			}

		}

		public function getFavoriteList(){
			//$this->load->model("RestaurantModel");
			//$data['restaurant_info'] = $this->RestaurantModel->getRestaurant($restaurant_name);
			return "getFavoriteList";
		}

		public function addAssets(){
			$url_css = "assets/stylesheets/landing/";

			$my_css = array(
				$url_css."slider.css",
				"assets/stylesheets/style.css"
				);
			$my_js = array(
				"assets/javascripts/slider/jssor.slider.mini.js",
				"assets/javascripts/slider/config.js",
				"assets/javascripts/landing/application.js"
				);

			add_css($my_css);
			add_js($my_js);
		}

		public function addAssetsMobile(){
			$url_css = "assets/stylesheets/landing/";

			$my_css = array(
				//"assets/stylesheets/style-mobile.css"
				);
			$my_js = array(
				//"assets/javascripts/slider/jssor.slider.mini.js",
				//"assets/javascripts/slider/config.js",
				"assets/javascripts/landing/application.js"
				);

			add_mobile_css($my_css);
			add_mobile_js($my_js);
		}

		public function search(){
			$city = $this->input->get('city');
			$search = $this->input->get('search');
			echo $city;
			echo $search;
			echo "search";
		}
	}


?>