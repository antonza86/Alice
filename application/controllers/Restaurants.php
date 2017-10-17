<?php
	class Restaurants extends CI_Controller{
		public function index(){
			$data['mobile'] = get_mobile_type();

			$url = current_url();
			$array = explode("/",$url);
			$city_name = array_pop($array);
			$data['city_name'] = $city_name;
			$search = $this->input->get('search');

		  $this->load->model("RestaurantsModel");
			$data['restaurant_list'] = $this->RestaurantsModel->getRestaurantList($city_name, $search, 0, 2, []);
			$data['products'] = $this->RestaurantsModel->getAllProducts(0,6);
			$original_name_city = $this->RestaurantsModel->getCityInfo($city_name)['name'];
			$data['city_id'] = $this->RestaurantsModel->getCityInfo($city_name)['id'];

			$this->addBreadcrumbs($city_name, $original_name_city);

			if($this->session->userdata('logged_in')){
				$data['favorite'] = getFavoriteList($this);
			}
			
			if($data['mobile']){
				$this->addAssetsMobile();
				$this->load->template_mobile('mobile/restaurants/index', $data);
			}
			else{
				$this->addAssets();
				$this->load->template('restaurants/index', $data);
			}
			
		}

		public function addBreadcrumbs($city_url, $city_name){
			// load Breadcrumbs
			$this->load->library('breadcrumbs');

			// add breadcrumbs
			$this->breadcrumbs->push('Rabbeat', '/?city_name='.$city_url);
			$this->breadcrumbs->push($city_name, '/'.$city_url);
		}

		public function addAssets(){
			$my_css = array(
				);
			$my_js = array(
				"assets/javascripts/restaurants/application.js",
				"assets/javascripts/landing/application.js"
				);

			add_css($my_css);
			add_js($my_js);
		}

		public function addAssetsMobile(){
			$my_js = array(
				"assets/javascripts/restaurants/application.js",
				"assets/javascripts/landing/application.js"
				);

			add_mobile_js($my_js);
		}
		
		public function get_more_data(){
			$orderby = $this->input->get('orderby');
			$offset = $this->input->get('offset');
			$limit = $this->input->get('limit');
			$filter_cuisine = $this->input->get('filter_cuisine');
			$checkbox_filter = $this->input->get('checkbox_filter');
			$city_name = $this->input->get('city_name');
			$search = $this->input->get('search');
			$type = $this->input->get('type');

			$this->load->model("RestaurantsModel");
			$data['restaurant_list'] = $this->RestaurantsModel->getRestaurantList($city_name, $search, intval($offset),intval($limit), $orderby, $filter_cuisine, $checkbox_filter);

			if($type == 'desktop')
				echo json_encode ($this->load->view('restaurants/restaurant', $data));
			else
				echo json_encode ($this->load->view('mobile/restaurants/list_content', $data));
		}

		public function filter(){
			$orderby = $this->input->get('orderby');
			$offset = $this->input->get('offset');
			$limit = $this->input->get('limit');
			$filter_cuisine = $this->input->get('filter_cuisine');
			$checkbox_filter = $this->input->get('checkbox_filter');
			$city_name = $this->input->get('city_name');
			$search = $this->input->get('search');
			$type = $this->input->get('type');

			$this->load->model("RestaurantsModel");
			$data['restaurant_list'] = $this->RestaurantsModel->getRestaurantList($city_name, $search, intval($offset), intval($limit), $orderby, $filter_cuisine, $checkbox_filter);
			$response = "";
			if(count($data['restaurant_list']) == 0){
				$response = json_encode ($this->load->view('restaurants/no_results'));
				$data['restaurant_list'] = $this->RestaurantsModel->getRestaurantList($city_name, $search, intval($offset), intval($limit), $orderby, [], []);
				$this->output->set_status_header('201');
			}

			if($type == 'desktop')
				$response .= json_encode ($this->load->view('restaurants/restaurant', $data));
			else
				$response .= json_encode ($this->load->view('mobile/restaurants/list_content', $data));

			$this->data['message'] = $response;
			echo $response;
		}
	}

?>
