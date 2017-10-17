<?php
class ProfileModel extends CI_Model {	
	public function getUserInfoByEmail($email){
		$query = $this->db->query('SELECT id, name, email, last_login, creation_date, status, points, notifications FROM user where email = ?', $email);
		return $query->row_array();
	}
	public function getPhoneById($id){
		$query = $this->db->query('SELECT id, number, default_phone FROM user_phone where refUser = ?', $id);
		return $query->result_array();
	}
	public function getAddressById($id){
		$query = $this->db->query('SELECT id, address, id_zone, default_address, city FROM user_address where refUser = ?', $id);
		return $query->result_array();
	}

	public function getRestInfo($array){
		$query = $this->db->query('SELECT distinct id, url_name, name FROM restaurant where id IN ?', array($array));
		$rest_list = $query->result_array();
		$clean_rest_list = array();
		foreach ($rest_list as $key){
			$clean_rest_list[$key['id']] = array(		"name" => $key['name'],
														"url_name" => $key['url_name']
													);
		}
		return $clean_rest_list;
	}

	public function getExtraList($array){
		$query = $this->db->query('SELECT distinct ep.id, ep.price, epn.name FROM extra_product as ep inner join extra_product_name as epn on ep.id = epn.refExtraProd where ep.id IN ?', array($array));
		$extra_list = $query->result_array();
		$clean_product_extras = array();
		foreach ($extra_list as $key){
			$clean_product_extras[$key['id']] = array(	"name" => $key['name'],
														"price" => $key['price']
													);
		}
		return $clean_product_extras;
	}

	public function getOrderList($id){
		$query = $this->db->query('SELECT o.id, pn.name, pi.url, up.price as single_price, o.price as price, o.date_time, o.delivery_price, o.rest, op.qnt, op.extras FROM `order` as o inner join order_prod as op on op.refOrder = o.id inner join product as p on p.id = op.refProd inner join prod_image as pi on pi.refProd = p.id inner join prod_name as pn on pn.refProd = p.id inner join user_prod as up on up.refProd = p.id where o.refUser = ? order by o.id, p.id', $id);
		$order_list = $query->result_array();
		$order_id = 0;
		$clean_order_list = array();
		$extra_string = "";
		$extra_list = array();
		$rest_list = array();
		foreach ($order_list as $key){
			if($key['extras'] != ""){
				$extra_string .= $key['extras'];
			}
			array_push($rest_list, $key['rest']);
		}
		$extra_list = explode(",",$extra_string);
		$clean_extra_list = $this->getExtraList($extra_list);
		$rest_info_list = $this->getRestInfo($rest_list);
		foreach ($order_list as $key){
			if($order_id != $key["id"]){
				$order_id = $key["id"];
				$clean_order_list[$order_id] = array(
													"price" => $key['price'],
													"delivery_price" => $key['delivery_price'],
													"total_price" => ($key['price'] + $key['delivery_price']),
													"rest_name" => $rest_info_list[$key["rest"]]['name'],
													"rest_url" => $rest_info_list[$key["rest"]]['url_name'],
													"order_date" => $key['date_time'],
													"order_id" => $key['id'],
													"product_list" => array()
												);
				$add_data = array(	"name" => $key['name'], 
									"url" => $key['url'],
									"single_price" => $key['single_price'],
									"qnt" => $key['qnt'],
									"extras" => array()
								);
				if($key['extras'] != ""){
					$extra = explode(",",$key['extras']);
					foreach ($extra as $key) {
						if($key != "")
							array_push($add_data['extras'], array(
																"name" => $clean_extra_list[$key]["name"],
																"price" => $clean_extra_list[$key]["price"]
																)
									);
					}
				}
				array_push($clean_order_list[$order_id]['product_list'], $add_data); 
			}else{
				$add_data = array(	"name" => $key['name'], 
									"url" => $key['url'],
									"single_price" => $key['single_price'],
									"qnt" => $key['qnt'],
									"extras" => array()
								);
				if($key['extras'] != ""){
					$extra = explode(",",$key['extras']);
					foreach ($extra as $key) {
						if($key != "")
							array_push($add_data['extras'], array(
																"name" => $clean_extra_list[$key]["name"],
																"price" => $clean_extra_list[$key]["price"]
																)
									);
					}
				}
				array_push($clean_order_list[$order_id]['product_list'], $add_data); 

			}
		}
		return $clean_order_list;
	}

	public function updateUserInfo($post)
    {
        $data_user = array(
               'name' => $post['name'],
               'notifications' => $post['notice_news']
            );
        $this->db->where('id', $post['user_id']);
        $success = $this->db->update('user', $data_user); 
        
        if(!$success){
            error_log('Unable to updateUserInfo('.$post['user_id'].')');
            return "false_user";
        }else{
        	if($this->phoneExist($post['user_id'])){
	        	$data_phone = array(
	               'number' => $post['phone']
	            );
		        $this->db->where('refUser', $post['user_id']);
		        $success = $this->db->update('user_phone', $data_phone); 
		        if(!$success)
		            return "false_phone_if";
		    }else{
		    	$string = array(
		            'refUser' => $post['user_id'],
		            'number' => $post['phone'],
		            'default_phone' => true
		        );
		        $q      = $this->db->insert_string('user_phone', $string);
		        $success = $this->db->query($q);
		        if(!$success)
		            return "false_phone_else";
		    } 

		    if($this->addressExist($post['user_id'])){
	        	$data_address = array(
	               'address' => $post['street'],
	               'cod_postal' => $post['cod_postal'],
	               'default_address' => true,
	               'city' => $post['city']
	            );
		        $this->db->where('refUser', $post['user_id']);
		        $success = $this->db->update('user_address', $data_address); 
		        if(!$success)
		            return "false_address_if";
		    }else{
		    	$string = array(
		            'refUser' => $post['user_id'],
		            'address' => $post['street'],
	                'cod_postal' => $post['cod_postal'],
	                'default_address' => true,
	                'city' => $post['city']
		        );
		        $q      = $this->db->insert_string('user_address', $string);
		        $success = $this->db->query($q);
		        if(!$success)
		            return "false_address_else";
		    } 
        }
        
        return "success"; 
    }

    public function phoneExist($id)
    {
        $this->db->get_where('user_phone', array(
            'refUser' => $id
        ), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    public function addressExist($id)
    {
        $this->db->get_where('user_address', array(
            'refUser' => $id
        ), 1);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    public function getOrderById($order_id)
    {
  		$query = $this->db->query('SELECT up.price as single_price, o.rest, op.qnt, op.extras, p.id FROM `order` as o inner join order_prod as op on op.refOrder = o.id inner join product as p on p.id = op.refProd inner join user_prod as up on up.refProd = p.id where o.id = ? and p.public = 1 order by o.id, p.id', $order_id);
			$order_list = $query->result_array();
			$rest_id = $order_list[0]["rest"];
			$city_id = $this->getCityByRestId($rest_id);

			$products = array();
			$qnt = 0;
			$price = 0;

			$extra_string = "";
			foreach ($order_list as $key) {
				if($key['extras'] != ""){
						$extra_string .= $key['extras'];
					}
			}
			$extra_list = explode(",",$extra_string);
			$clean_extra_list = $this->getExtraList($extra_list);

			foreach ($order_list as $key => $value) {
					$qnt += $value["qnt"];
					$product_price = $value["single_price"];
					$extras = array();
					if($value['extras'] != ""){
						$extras = explode(",",$value['extras']);
						if (end($extras) == "") { 
							array_pop($extras); 
						}
						foreach ($extras as $key_extras) {
							$extras_price = $clean_extra_list[$key_extras]['price'];
							$product_price += $extras_price;
						}
					}
					$price += $product_price * $value["qnt"];
					$products[$key] = array(
																"qnt" => $value["qnt"],
																"index" => $key,
																"id" => $value["id"],
																"extra" => $extras
															);
			}

			$result_order = array(
									$city_id => array(
													$rest_id => array(
																	"qnt" => $qnt,
																	"price" => $price,
																	"products" => $products
																)
													)
								);
			return $result_order;

	    }

	    public function getCityByRestId($rest_id){
	  		$query = $this->db->query('SELECT r.refCity FROM restaurant as r where r.id = ?', $rest_id);
			return $query->row_array()["refCity"];
    }

}
?>