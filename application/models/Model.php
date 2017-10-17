<?php

class Model extends CI_Model {

	public function getProducts($url){
		$query = $this->db->query('SELECT p.id, p.visible, pn.name as prod_name, pn.description, pn.lang, i.src, p.price, p.type, cn.name as cat_name, c.id as cat_id FROM product as p join categoria as c on p.refCat = c.id inner join restaurante as r on c.refRest = r.id inner join cat_name as cn on cn.refCat = c.id inner join prod_name as pn on pn.refProd = p.id left join prod_image as pi on p.id = pi.refProd left join imagep as i on pi.refImage = i.id where r.url_name=? order by p.type desc, p.id asc', array($url));
		//$query = $this->db->get();
		return $query->result();
	}
	public function getCategorias($url){
		$query = $this->db->query('SELECT c.id, cn.name, cn.lang, i.src, c.type, c.sub, c.visible FROM categoria as c inner join restaurante as r on r.id = c.refRest inner join cat_name as cn on cn.refCat = c.id left join cat_image as ci on c.id = ci.refCat left join imagec as i on ci.refImage = i.id where r.url_name=? order by type desc, c.id asc', array($url));
		return $query->result();
	}
	public function getRestaurante($url){
		$query = $this->db->query('SELECT * FROM restaurante where url_name=?', array($url));
		return $query->result();
	}
	
	public function getRestauranteList(){
		$query = $this->db->query('SELECT * FROM restaurante');
		return $query->result();
	}

	public function getUserRestaurantes($user_id){
		$query = $this->db->query('SELECT r.name, r.url_name FROM user as u inner join user_rest as ur on ur.refUser = u.id inner join restaurante r on r.id = ur.refRest where u.id=?', array($user_id));
		return $query->result();
	}

	public function update_rest_db(){
		$data = array(
			'id'=>$_POST['id'],
			'name'=>$_POST['name'],
			'url_name'=>$_POST['url_name'],
			'address'=>$_POST['address'],
			'tel'=>$_POST['tel'],
			'gps'=>$_POST['gps'],
			'type'=>$_POST['type'],
			'horario'=>$_POST['horario'],
			'feriados'=>$_POST['feriados'],
			'email'=>$_POST['email'],
			'website'=>$_POST['website'],
			'facebook'=>$_POST['facebook'],
			'tripadvisor'=>$_POST['tripadvisor'],
			'twitter'=>$_POST['twitter'],
			'gplus'=>$_POST['gplus'],
			'foursquere'=>$_POST['foursquere'],
			'logo'=>$_POST['logo'],
			'usercounter'=>$_POST['usercounter'],
			'startdate'=>$_POST['startdate'],
			'enddate'=>$_POST['enddate'],
			'renewdate'=>$_POST['renewdate'],
			'contract_type'=>$_POST['contract_type'],
			'public'=>$_POST['public'],
			'refCidade'=>$_POST['refCidade']
		);
		$this->db->where('id', $_POST['id']);
		$this->db->update('restaurante', $data);
	}

	public function insert_to_db()
	{
		$id=$_POST['id'];
		$name=$_POST['name'];
		$type=$_POST['type'];
		$sub=$_POST['sub'];
		$visible=$_POST['visible'];
		$id_rest=$_POST['id_rest'];
		$lang=$_POST['lang'];
		$count = count($_POST['name']);

		for($i=0; $i<$count; $i++) {
			if($id[$i] != "new"){
				//Update category info
				$show = 0;
				if(array_key_exists($i, $visible))
					$show = 1;
				$data = array(
			           'type' => $type[$i],
			           'sub' => $sub[$i],
			           'visible' => $show
			           );
				$this->db->where('id', $id[$i]);
				$this->db->update('categoria', $data);

				if($name[$i] != ""){
					$query = $this->db->query('SELECT * FROM cat_name where refCat=? and lang=?', array($id[$i], $lang));
					$countResult = count($query->result());
					if($countResult == 0){
						//new translate
						$data = array(
					           'name' => $name[$i],
					           'lang' => $lang,
					           'refCat' => $id[$i]
					           );
						$this->db->insert('cat_name', $data);
					}
					else{
						//update exists name
						$data = array(
					           'name' => $name[$i]
					           );
						$this->db->where('refCat', $id[$i]);
						$this->db->where('lang', $lang);
						$this->db->update('cat_name', $data);
					}
				}
			}
			else{
				//New category
				if($name[$i] != ""){
					$data = array( 
				           'type' => $type[$i]
				           );
					$this->db->insert('categoria', $data);
					$newId = $this->db->insert_id();
					$data = array(
				           'name' => $name[$i], 
				           'refCat' => $newId,
				           'lang' => $lang
				           );
					$this->db->insert('cat_name', $data);
				}
			}
		}
	}

	public function insert_image($id, $image){
		$query = $this->db->query('SELECT refImage FROM cat_image where refCat=?', $id);
		$countResult = count($query->result());
		if($countResult == 0){
			//New image
			$data = array(
		           'src' => $image
		           );
			$this->db->insert('imagec', $data);
			$refImage = $this->db->insert_id();
			$data = array(
		           'refCat' => $id,
		           'refImage' => $refImage
		           );
			$this->db->insert('cat_image', $data);

		}
		else{
			//Exist image
			$refImage = $query->result()[0]->refImage;
			$data = array(
				'src' => $image
				);
			$this->db->where('id', $refImage);
			$this->db->update('imagec', $data); 
		}

	}

	public function remove_from_db($id){
		$this->db->delete('categoria', array('id' => $id)); 
	}

}
?>