<?php
	class Profile extends CI_Controller{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model("ProfileModel");
	    }

		public function index(){
			if($this->session->userdata('logged_in')){
				$data['user_info'] = $this->ProfileModel->getUserInfoByEmail($this->session->userdata('logged_in')['email']);
				$data['phone_info'] = $this->ProfileModel->getPhoneById($data['user_info']['id']);
				$data['address_info'] = $this->ProfileModel->getAddressById($data['user_info']['id']);
				
				$order_list = $this->ProfileModel->getOrderList($data['user_info']['id']);
				$data['order_list'] = $order_list;

				$this->addAssets();

				$data['mobile'] = false;

				$data['favorite'] = getFavoriteList($this);
				
				$this->load->template('profile/index', $data);
			}else
				redirect("/");
		}


		public function addAssets(){
			$url_css = "assets/stylesheets/profile/";

			$my_css = array(
				//$url_css."application.css"
				);
			$my_js = array(
				"assets/javascripts/profile/application.js",
				"assets/javascripts/landing/application.js"
				);

			add_css($my_css);
			add_js($my_js);
		}

		public function save_profile(){
			if($this->session->userdata('logged_in')){
				$data['name']  = $this->input->post('name');
				$data['password']  = $this->input->post('password');
				$data['passconf']  = $this->input->post('passconf');
				$data['phone']  = $this->input->post('phone');
				$data['street']  = $this->input->post('street');
				$data['city']  = $this->input->post('city');
				$data['cod_postal']  = $this->input->post('cod_postal');
				$data['notice_news']  = $this->input->post('notice_news');
				$data['user_id']  = $this->input->post('user_id');
				if($data['name'] == "" || $data['phone'] == "" || $data['street'] == "" || $data['cod_postal'] == "")
					echo "required_fields";
				else{
					$user_result = $this->ProfileModel->updateUserInfo($data);
					echo $user_result;
				}
			}else
				echo "error";
		}

		public function repeat_order(){
			if($this->session->userdata('logged_in')){
				$order_id  = $this->input->post('order_id');
				$order_repeat_result = $this->ProfileModel->getOrderById($order_id);

				print_r(json_encode($order_repeat_result));
			}else
				echo "error";
		}
		
	}

?>