<?php
	class Admin extends CI_Controller{
		function __construct()
	    {
	        parent::__construct();
	        $this->load->model("AdminModel");
	    }

		public function index(){
			if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['email'] == "antonza86@gmail.com"){
				$this->addAssets();

				$data['city_id'] = 1;
				$data['favorite'] = getFavoriteList($this);
				$data['city_name'] = get_city_key(1);
				$data['result'] = $this->do_upload();
				$this->load->template('admin/index', $data);

			}else{
				redirect("/");
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
				"assets/javascripts/admin/application.js",
				"assets/javascripts/landing/application.js"
				);

			add_css($my_css);
			add_js($my_js);
		}

		public function do_upload(){
			// Load the spreadsheet reader library
			$this->load->library('excel_reader');

			// Read the spreadsheet via a relative path to the document
			// for example $this->excel_reader->read('./uploads/file.xls');
			$this->excel_reader->read('uploads/registos.xls');

			// Get the contents of the first worksheet
			$worksheet_rest = $this->excel_reader->sheets[0];
			$worksheet_prod = $this->excel_reader->sheets[1];

			//$numRows = $worksheet['numRows']; // ex: 14
			$numCols_rest = $worksheet_rest['numCols']; // ex: 4
			$numCols_prod = $worksheet_prod['numCols']; // ex: 4
			$cells_rest = $worksheet_rest['cells']; // the 1st row are usually the field's name
			$cells_prod = $worksheet_prod['cells']; // the 1st row are usually the field's name

			//$this->print_rest_sheet($cells_rest, $numCols_rest);
			//$this->print_prod_sheet($cells_prod, $numCols_prod);
			$this->AdminModel->addNewData($cells_rest, $numCols_rest, $cells_prod, $numCols_prod);
		}

		public function print_rest_sheet($cells, $numCols){
			foreach ($cells as $key => $value){
				if($key == 1){
					print_r("=================<br>");
				}else if($key == 2){
					for ($x = 1; $x <= $numCols; $x++) {
						if($x == 1)
							echo "name: ";
						else if($x == 2)
							echo "title: ";
						else if($x == 3)
							echo "url_name: ";
						else if($x == 4)
							echo "description: ";
						else if($x == 5)
							echo "min_price: ";
						else if($x == 6)
							echo "delivery_time: ";
						else if($x == 7)
							echo "card_payment: ";
						else if($x == 8)
							echo "address: ";
						else if($x == 9)
							echo "tel: ";
						else if($x == 10)
							echo "gps: ";
						else if($x == 11)
							echo "schedule: ";
						else if($x == 12)
							echo "holiday: ";
						else if($x == 13)
							echo "logo: ";
						else if($x == 14)
							echo "public: ";
						else if($x == 15)
							echo "refCity: ";
						if(array_key_exists($x, $value))
							echo $value[$x];
						else
							echo "''";
						echo "<br>";
					}
				}else if($key == 5){
					print_r("===<br>");
					echo "tipo: ";
					for ($x = 1; $x <= $numCols; $x++) {
						if(array_key_exists($x, $value))
							echo $value[$x]."|";
						else
							break;
					}
					print_r("<br>===<br>");
				}else if($key > 7){
					echo "tipo: ";
					for ($x = 1; $x <= $numCols; $x++) {
						if($x == 1)
							echo "price: ";
						else if($x == 2)
							echo "bonus: ";
						else if($x == 3)
							echo "discount: ";
						else if($x == 4)
							echo "zona: ";

						if(array_key_exists($x, $value))
							echo $value[$x]."|";
						else
							break;
					}
					echo "<br>";
				}
			}
			echo "<br>";
		}

		public function print_prod_sheet($cells, $numCols){
			foreach ($cells as $key => $value){
				if($key == 1){
					print_r("=================");
				}else{
					for ($x = 1; $x <= $numCols; $x++) {
						if($x == 1){
							if(array_key_exists($x, $value)){
								print_r("<br>");
					    	echo "Nova cat -> ".$value[$x];
					    	if(array_key_exists($x + 1, $value))
					    		echo " / ".$value[$x + 1];
					    	if(array_key_exists($x + 2, $value))
					    		echo " / ".$value[$x + 2];
					    	if(array_key_exists($x + 3, $value))
					    		echo " / ".$value[$x + 3];
								break;
							}
						}
						else{
							if($x == 2)
			    			echo "Nome: ";
			    		else if($x == 3)
			    			echo "Description: ";
			    		else if($x == 4)
			    			echo "Price: ";
							if(array_key_exists($x, $value)){
				    		echo $value[$x]." | ";
							}
				    	else{
				    		echo "'' | ";
				    	}
						}
					} 
					echo "<br>";

				}
			}
		}

	}

?>