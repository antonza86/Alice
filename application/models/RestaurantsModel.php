<?php
class RestaurantsModel extends CI_Model {	
	public function getCityInfo($city_name){
		$structure_query = "Select * from city where url_name = '".$city_name."'";
		$query = $this->db->query($structure_query);
		return $query->row_array();
	}

	public function getRestaurantList($city_name, $search, $offset, $limit, $order, $filter_cuisine = [], $checkbox_filter = []){
		if($order == "")
			$orderby = "r.id";
		else if($order == "abc")
			$orderby = "r.name";
		else if($order == "min_price")
			$orderby = "r.min_price * 1";
		else if($order == "min_time")
			$orderby = "r.delivery_time * 1";
		else
			$orderby = "r.id";

		$where = "";
		if(count($checkbox_filter) != 0){
			$first_enable = false;
			$where .= " and (";
			foreach ($checkbox_filter as $key => $value){
				if($value == "delivery"){
					if($first_enable)
						$where .= " and r.delivery_price = '0'";
					else
						$where .= "r.delivery_price = '0'";
					$first_enable = true;
				}
				else if($value == "online"){
					if($first_enable)
						$where .= " and r.card_payment = '1'";
					else
						$where .= "r.card_payment = '1'";
					$first_enable = true;
				}
				else if($value == "card"){
					if($first_enable)
						$where .= " and r.card_payment = '1'";
					else
						$where .= "r.card_payment = '1'";
					$first_enable = true;
				}
				else if($value == "work"){
					if($first_enable)
						$where .= " and r.delivery_price = '0'";
					else
						$where .= "r.delivery_price = '0'";
					$first_enable = true;
				}
			}
			$where .= ")";
		}

		if(count($filter_cuisine) != 0){
			$where .= " and (";
			foreach ($filter_cuisine as $key => $value){
				if($key == 0)
					$where .= "rct.refCuisine = ".$value;
				else
					$where .= " or rct.refCuisine = ".$value;
			}
			$where .= ")";
		}

		if ($search != "") {
			$where .= " and (";
			$where .= "r.name like '%".$search."%'";
			$where .= ")";
		}

		$cuisine_select = "(select GROUP_CONCAT(ct2.name SEPARATOR ', ') from cuisine_type as ct2 inner join rest_cuisine_type as rct2 on rct2.refCuisine = ct2.id where rct2.refRest = r.id)";
		$select_part = "SELECT r.*, c.name as original_name_city, ".$cuisine_select." cuisine FROM";
		$join_part = " restaurant as r inner join city as c on r.refCity = c.id inner join rest_cuisine_type as rct on rct.refRest = r.id inner join cuisine_type as ct on ct.id = rct.refCuisine";
		$where_part = " where c.url_name = '".strtolower($city_name)."'";
		$where_part .= $where;
		$order_part = " order by ".$orderby;
		$limit_part = " limit ".$limit;
		$offset_part = " offset ".$offset;

		$groupby_part = " group by r.id";

		$structure_query = $select_part.$join_part.$where_part.$groupby_part.$order_part.$limit_part.$offset_part;
		//echo $structure_query;
		$query = $this->db->query($structure_query);
		return $query->result_array();
	}

	public function getAllProducts($offset, $limit){
		$query = $this->db->query('SELECT pn.*, pi.url, c.cat, c.sub_cat, p.id as prod_id, p.extra, up.price as prod_price, r.url_name FROM prod_name as pn inner join product as p on p.id = pn.refProd inner join prod_image as pi on pi.refProd = p.id inner join category as c on c.id = p.refCat inner join restaurant as r on r.id = c.refRest inner join user_prod as up on up.refProd = p.id limit ? offset ?', array($limit, $offset));
		return $query->result_array();
		//inner join extra_product as e on e.refProd = p.id inner join extra_product_name as en on en.refExtraProd = e.id
	}

}
?>