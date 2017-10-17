<?php
if(!function_exists('getFavoriteList')){
    function getFavoriteList($this_from_controller)
    {
		$this_from_controller->load->model("FavoriteModel");
		return $this_from_controller->FavoriteModel->getFavoriteList($this_from_controller->session->userdata('logged_in')['id']);
    }
}