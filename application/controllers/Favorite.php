<?php
	class Favorite extends CI_Controller{
		public function add_favorite(){
			$rest_id = $this->input->get('rest_id');

			$this->load->model("FavoriteModel");
			$result = $this->FavoriteModel->addFavorite($rest_id);
			echo $result;
		}

		public function remove_favorite(){
			$fav_id = $this->input->get('fav_id');
			
			$this->load->model("FavoriteModel");
			$result = $this->FavoriteModel->removeFavorite($fav_id);
			echo $result;
		}

		public function remove_favorite_by_restid(){
			$rest_id = $this->input->get('rest_id');
			
			$this->load->model("FavoriteModel");
			$result = $this->FavoriteModel->removeFavoriteByRestId($rest_id);
			echo $result;
		}
	}

?>