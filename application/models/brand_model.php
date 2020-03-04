<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Brand_model extends CI_Model{

	public function brand_add($arr){
		return $this->db->insert('ci_brand', $arr);
	}

}