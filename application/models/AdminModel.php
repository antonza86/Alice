<?php
	class AdminModel extends CI_Model {	
		public function addNewData($cells_rest, $numCols_rest, $cells_prod, $numCols_prod){

			$this->db->trans_start();
			$rest_id = $this->save_rest_sheet($cells_rest, $numCols_rest);
			$this->save_rest_sheet($cells_rest, $numCols_rest, $rest_id);

			$this->save_prod_sheet($cells_prod, $numCols_prod, $rest_id);

			//$this->db->query('INSERT INTO city(name, url_name) VALUES ("penza", "penza")');

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				echo "MALLLL<br>";
			}
			else{
				$this->db->trans_complete();
				echo "BEMMMM<br>";
			}
			
			/*
			else
				$this->db->trans_commit();
			*/
		}

		public function get_rest_by_url_name($url_name){
			$this->db->select('id');
			$rest = $this->db->get_where('restaurant', array('url_name' => $url_name));
			return $rest->row_array()['id'];
		}

		public function insert_restaurant($data){
			$this->db->insert('restaurant', $data);
			$rest = $this->db->insert_id();
			return $rest;
		}

		public function insert_restaurant_type($data){
			$this->db->insert_batch('rest_cuisine_type', $data);
		}

		public function insert_delivery_price($data){
			$this->db->insert('delivery_price', $data);
		}

		public function save_rest_sheet($cells, $numCols){
			//get url_name do restaurant
			$rest_id = $this->get_rest_by_url_name($cells[2][3]);
			
			if(!$rest_id){
				foreach ($cells as $key => $value){
					if($key == 2){
						for ($x = 1; $x <= $numCols; $x++) {
							if($x == 1)
								$data["name"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 2)
								$data["title"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 3)
								$data["url_name"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 4)
								$data["description"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 5)
								$data["min_price"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 6)
								$data["delivery_time"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 7)
								$data["card_payment"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 8)
								$data["address"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 9)
								$data["tel"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 10)
								$data["gps"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 11)
								$data["schedule"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 12)
								$data["holiday"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 13)
								$data["logo"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 14)
								$data["public"] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 15)
								$data["refCity"] = array_key_exists($x, $value) ? $value[$x] : "";
						}
						$rest_id = $this->insert_restaurant($data);
					}else if($key == 5){
						$data_types = array();
						for ($x = 1; $x <= $numCols; $x++) {
							if(array_key_exists($x, $value)){
								$data_type["refRest"] = $rest_id;
								$data_type["refCuisine"] = intval($value[$x]);
							}
							else
								break;
							array_push($data_types, $data_type);
						}
						$this->insert_restaurant_type($data_types);

					}else if($key > 7){
						for ($x = 1; $x <= $numCols; $x++) {
							if($x == 1)
								$data_delivery_price['price'] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 2)
								$data_delivery_price['bonus'] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 3)
								$data_delivery_price['discount'] = array_key_exists($x, $value) ? $value[$x] : "";
							else if($x == 4)
								$data_delivery_price['refZona'] = array_key_exists($x, $value) ? $value[$x] : "";
						}
						$data_delivery_price['refRest'] = $rest_id;
						$this->insert_delivery_price($data_delivery_price);
					}
				}
				echo "<br>";
			}

			return $rest_id;
		}

		public function insert_category($data_cat){
			$this->db->insert('category', $data_cat);
			$cat_id = $this->db->insert_id();
			return $cat_id;
		}
		
		public function insert_category_name($data_cat_name){
			$this->db->insert('cat_name', $data_cat_name);
		}

		public function insert_product($data){
			$this->db->insert('product', $data);
			$prod_id = $this->db->insert_id();
			return $prod_id;
		}
		
		public function insert_product_name($data){
			$this->db->insert('prod_name', $data);
		}
		
		public function insert_product_image($data){
			$this->db->insert('prod_image', $data);
		}
		
		public function insert_product_user($data){
			$this->db->insert('user_prod', $data);
		}

		public function save_prod_sheet($cells, $numCols, $rest_id){
			$main_category = 1;
			$categories = array();
			foreach ($cells as $key => $value){
				if($key == 1){
					print_r("START");
					echo "<br>";
				}else{
					$insert_product_data = false;
					$new_product = true;
					for ($x = 1; $x <= $numCols; $x++) {
						if($x == 1){
							if(array_key_exists($x, $value)){
								$insert = true;
					    	if(array_key_exists($x, $value) && array_key_exists($x+2, $value)){
					    		if(array_key_exists($value[$x], $categories)){
						    		$data_category['cat'] = $categories[$value[$x]]['cat'];
						    		$data_category['sub_cat'] = $categories[$value[$x]]['sub_cat'] + 1;
						    		$insert = false;
						    	}else{
						    		$data_category['cat'] = $main_category;
						    		$main_category += 1;
						    		$data_category['sub_cat'] = 0;
						    	}
					    	}
					    	else{
					    		$data_category['cat'] = $main_category;
					    		$main_category += 1;
					    		$data_category['sub_cat'] = -1;
					    	}
					    	$data_category['public'] = 1;
					    	$data_category['refRest'] = $rest_id;
					    	$data_category['image'] = "";

					    	if($insert){
					    		$cat_id = $this->insert_category($data_category);
						    	$data_category_name['refCat'] = $cat_id;
						    	$data_category_name['lang'] = 'pt';
						    	$data_category_name['name'] = array_key_exists($x, $value) ? $value[$x] : "";
						    	$data_category_name['description'] = array_key_exists($x + 1, $value) ? $value[$x + 1] : "";

						    	$this->insert_category_name($data_category_name);
						    }
					    	else{
					    		$insert = true;
					    		$cat_id = $categories[$value[$x]]['cat_id'];
					    	}
					    	$cat_to_prod = $cat_id;
					    	$category['cat_id'] = $cat_id;
					    	$category['cat'] = $data_category['cat'];
					    	$category['sub_cat'] = $data_category['sub_cat'];
					    	$categories[$value[$x]] = $category;

					    	$inserted_cat = $data_category['cat'];
					    	$inserted_sub_cat = $data_category['sub_cat'];

					    	if(array_key_exists($x + 2, $value)){
					    		$data_category['cat'] = $inserted_cat;
					    		$data_category['sub_cat'] = $inserted_sub_cat + 1;
					    		$data_category['public'] = 1;
						    	$data_category['refRest'] = $rest_id;
						    	$data_category['image'] = "";

						    	$cat_id = $this->insert_category($data_category);

						    	$data_category_name['refCat'] = $cat_id;
						    	$data_category_name['lang'] = 'pt';
						    	$data_category_name['name'] = array_key_exists($x + 2, $value) ? $value[$x + 2] : "";
						    	$data_category_name['description'] = array_key_exists($x + 3, $value) ? $value[$x + 3] : "";;

						    	$this->insert_category_name($data_category_name);

						    	$cat_to_prod = $cat_id;
					    	}
								break;
							}
						}
						else{
							$insert_product_data = true;
							if($new_product){
								$product["refCat"] = $cat_to_prod;
								$product["extra"] = 0;
								$product["public"] = 1;
								$prod_id = $this->insert_product($product);
								$new_product = false;
							}
							if($x == 2){
						    $data_prod_name['refProd'] = $prod_id;
						    $data_prod_name['name'] = array_key_exists($x, $value) ? $value[$x] : "";
						    $data_prod_name['lang'] = "pt";
							}
			    		else if($x == 3){
						    $data_prod_name['description'] = array_key_exists($x, $value) ? $value[$x] : "";
			    		}
			    		else if($x == 4){
						    $data_prod_price['price'] = array_key_exists($x, $value) ? $value[$x] : "";
						    $data_prod_price['refProd'] = $prod_id;
						    $data_prod_price['refUser'] = 1;
						    $data_prod_price['public'] = 1;
			    		}
			    		else if($x == 5){
						    $data_prod_image['refProd'] = $prod_id;
						    $data_prod_image['url'] = array_key_exists($x, $value) ? $value[$x] : "no_image.png";
						    $new_product = true;
			    		}
						}
					} 
					if($insert_product_data){
						$this->insert_product_name($data_prod_name);
						$this->insert_product_image($data_prod_image);
						$this->insert_product_user($data_prod_price);
						$insert_product_data = false;
					}
				}
			}
		}

	}
?>