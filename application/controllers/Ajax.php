<?php
	class Ajax extends CI_Controller{
		function __construct()
	    {
	        parent::__construct();
	    }

		public function get_html(){
			$idx = $this->input->get('idx');
			if($idx == "login")
				echo json_encode ($this->load->view('mobile/landing/login'));
			else if($idx == "registration")
				echo json_encode ($this->load->view('mobile/landing/registration'));
			else if($idx == "forgot")
				echo json_encode ($this->load->view('mobile/landing/forgot'));
			else if($idx == "extras"){
				$product_id = $this->input->get('product_id');
				$data['prod_id'] = $product_id;

				$this->load->model("RestaurantModel");
				$data['extras'] = $this->RestaurantModel->getProductExtras(intval($product_id));
				echo json_encode ($this->load->view('mobile/restaurant/extras', $data));
			}
		}
	}

?>