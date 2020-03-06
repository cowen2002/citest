<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Goods_type_model extends CI_Model{

	public function add($arr){
		return $this->db->insert('ci_goods_type', $arr);
	}

	public function goods_type_list(){
		$query = $this->db->get('ci_goods_type');
		return $query->result_array();
	}
}