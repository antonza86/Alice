<?php
class CartModel extends CI_Model {	
	public function getRestaurants($array){
		$query = $this->db->query('SELECT distinct r.id, r.url_name, r.name FROM restaurant as r where r.id IN ?', array($array));
		return $query->result_array();
	}

	public function getCityZone($city_id){
		$query = $this->db->query('SELECT * FROM zona as z where z.refCity = ?', $city_id);
		return $query->result_array();
	}

	public function getZonas($array){
		$query = $this->db->query('SELECT dp.price, dp.bonus, dp.discount, dp.id, dp.refZona, dp.refRest FROM delivery_price as dp where dp.refRest IN ?', array($array));
		return $query->result_array();
	}

	public function getZona($id){
		$query = $this->db->query('SELECT dp.price, dp.bonus, dp.discount, dp.id, dp.refZona, dp.refRest FROM delivery_price as dp where dp.refZona = ?', $id);
		return $query->row_array();
	}

	public function getProducts($array){
		$query = $this->db->query('SELECT distinct p.id, pn.name, up.price, pi.url FROM product as p inner join prod_name as pn on p.id = pn.refProd inner join prod_image as pi on p.id = pi.refProd inner join user_prod as up on p.id = up.refProd where p.id IN ?', array($array));
		return $query->result_array();
	}

	public function getExtras($array){
		$query = $this->db->query('SELECT distinct ep.id, ep.price, epn.name FROM extra_product as ep inner join extra_product_name as epn on ep.id = epn.refExtraProd where ep.id IN ?', array($array));
		return $query->result_array();
	}

	public function getUser($id){
		$query = $this->db->query('SELECT u.name, up.number, ua.id_zone, ua.address FROM user as u left join user_address as ua on u.id = ua.refUser left join user_phone as up on u.id = up.refUser where u.id = ?', $id);
		return $query->row_array();
	}

	public function addOrder($data){
		$data_to_insert = array(
			'price' => $data['total_price'],
			'delivery_price' => $data['delivery_price'],
			'rest' => $data['rest'],
			'discount' => 0,
			'date_time' => date('Y/m/d - H:i'),
			'name' => $data['name'],
			'phone' => $data['phone'],
			'zone' => $data['zone'],
			'address' => $data['address'],
			'comment' => $data['comment'],
			'payment_method' => $data['payment_type'],
			'refUser' => $this->session->userdata('logged_in')['id']
		);

		$this->db->insert('order', $data_to_insert); 
		return $this->db->insert_id();
	}

	public function addOrderProd($product_list, $order_id){
		$data = array();
		foreach ($product_list as $key2 => $value2){
			$insert_extras = "";
			if(count($value2['extra']) != 0 ){
				foreach ($value2['extra'] as $index => $extra_id) {
					$insert_extras .= $extra_id.",";
				}
			}
			
			array_push($data, 
				array(
				      'refOrder' => $order_id,
				      'refProd' => $value2['id'],
				      'qnt' => $value2['qnt'],
				      'extras' => $insert_extras
				   )
			);
		}
		$result = $this->db->insert_batch('order_prod', $data);
		return $result;
	}

}
?>
