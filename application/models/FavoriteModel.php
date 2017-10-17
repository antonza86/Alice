<?php
class FavoriteModel extends CI_Model {	
	public function getFavoriteList($user_id){
		$query = $this->db->query('SELECT r.id as rest_id, f.id, r.name, r.url_name, r.logo, (select GROUP_CONCAT(ct.name SEPARATOR ", ") from cuisine_type as ct inner join rest_cuisine_type as rct on rct.refCuisine = ct.id where rct.refRest = r.id) as cuisine FROM favorite as f inner join restaurant as r on f.refRest = r.id where f.refUser = ?', $user_id);
		return $query->result_array();
	}

	public function addFavorite($rest_id){
		$data = array(
	        'refUser' => $this->session->userdata('logged_in')['id'],
	        'refRest' => $rest_id
		);

		return $this->db->insert('favorite', $data);
	}

	public function removeFavorite($fav_id){
		return $this->db->delete('favorite', array('id' => $fav_id, 'refUser' => $this->session->userdata('logged_in')['id']));
	}

	public function removeFavoriteByRestId($rest_id){
		return $this->db->delete('favorite', array('refRest' => $rest_id, 'refUser' => $this->session->userdata('logged_in')['id']));
	}
}
?>