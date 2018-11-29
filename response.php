<?php
	include('includes/config.php');
	$params = $_REQUEST;
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$gameCls = new Games();


	switch($action) {
		default:
		$gameCls->getGames($params);
		return;
	}



	class Games{
		
		protected $data = array();	
		
		public function getGames($params) {
			$user_obj = new Cl_User();    
			$this->data = $user_obj->latest_gamesServerSidePaging($params); 
			echo json_encode($this->data);
		}
	}
		
	
  ?>