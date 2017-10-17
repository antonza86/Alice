<?php
class RestaurantModel extends CI_Model {	
	public function getRestaurant($restaurant){
		$cuisine_select = "(select GROUP_CONCAT(ct2.name SEPARATOR ', ') from cuisine_type as ct2 inner join rest_cuisine_type as rct2 on rct2.refCuisine = ct2.id where rct2.refRest = r.id)";
		$select_part = "SELECT r.*, c.id as city_id, c.url_name as url_name_city, c.name as original_name_city, ".$cuisine_select." cuisine FROM";
		$join_part = " restaurant as r inner join city as c on c.id = r.refCity";
		$where_part = " where r.url_name = '".$restaurant."'";

		$groupby_part = " group by r.id";

		$structure_query = $select_part.$join_part.$where_part.$groupby_part;

		$query = $this->db->query($structure_query);
		return $query->row_array();
	}

	public function getCategories($restaurant){
		$query = $this->db->query('SELECT cn.*, c.cat, c.sub_cat FROM cat_name as cn inner join category as c on c.id = cn.refCat inner join restaurant as r on r.id = c.refRest where r.url_name = ? order by c.cat, c.sub_cat', $restaurant);
		return $query->result_array();
	}

	public function getCategories_ids($restaurant){
		$query = $this->db->query('SELECT c.id, c.cat, c.sub_cat FROM category as c inner join restaurant as r on r.id = c.refRest where r.url_name = ? and c.sub_cat != 0 order by c.id', $restaurant);
		return $query->result_array();
	}

	public function getCategory_by_id($restaurant, $cat_id, $sub_cat_id){
		$query = $this->db->query('SELECT cn.name, c.id FROM cat_name as cn inner join category as c on c.id = cn.refCat inner join restaurant as r on r.id = c.refRest where r.url_name = ? and ((c.cat = ? and c.sub_cat = 0) or (c.cat = ? and c.sub_cat = ?))', array($restaurant, $cat_id, $cat_id, $sub_cat_id));
		return $query->result_array();
	}

	public function getAllProducts($restaurant, $offset, $limit){
		$query = $this->db->query('SELECT pn.*, pi.url, c.cat, c.sub_cat, p.id as prod_id, p.extra, up.price as prod_price FROM prod_name as pn inner join product as p on p.id = pn.refProd inner join prod_image as pi on pi.refProd = p.id inner join category as c on c.id = p.refCat inner join restaurant as r on r.id = c.refRest inner join user_prod as up on up.refProd = p.id where r.url_name = ? limit ? offset ?', array($restaurant, $limit, $offset));
		return $query->result_array();
		//inner join extra_product as e on e.refProd = p.id inner join extra_product_name as en on en.refExtraProd = e.id
	}

	public function getProducts($restaurant, $cat_id, $sub_cat_id){
		if($sub_cat_id > 0){
			$query = $this->db->query('SELECT pn.*, pi.url, c.cat, c.sub_cat, p.id as prod_id, p.extra, up.price as prod_price FROM prod_name as pn inner join product as p on p.id = pn.refProd inner join prod_image as pi on pi.refProd = p.id inner join category as c on c.id = p.refCat inner join user_prod as up on up.refProd = p.id inner join restaurant as r on r.id = c.refRest where r.url_name = ? and c.cat = ? and c.sub_cat = ?', array($restaurant, $cat_id, $sub_cat_id));
			return $query->result_array();
		}else{
			$query = $this->db->query('SELECT pn.*, pi.url, c.cat, c.sub_cat, p.id as prod_id, p.extra, up.price as prod_price FROM prod_name as pn inner join product as p on p.id = pn.refProd inner join prod_image as pi on pi.refProd = p.id inner join category as c on c.id = p.refCat inner join user_prod as up on up.refProd = p.id inner join restaurant as r on r.id = c.refRest where r.url_name = ? and c.cat = ?', array($restaurant, $cat_id));
			return $query->result_array();
		}
	}

	public function getProductExtras($product_id){
		$query = $this->db->query('SELECT en.name, en.description, e.price as extra_price, e.id as extra_id, up.price as prod_price FROM extra_product as e inner join extra_product_name as en on e.id = en.refExtraProd inner join product as p on p.id = e.refProd inner join user_prod as up on up.refProd = p.id where p.id = ?', $product_id);
		return $query->result_array();
	}

}
?>