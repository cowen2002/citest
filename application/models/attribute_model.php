<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attribute_model extends CI_Model{

	public function attribute_add($arr){
		return $this->db->insert('ci_attribute', $arr);
	}

	public function attribute_list(){
		$query =  $this->db->get('ci_attribute');
		return $query->result_array();
	}

	
	public function attribute_list_by_goods_type_id($goods_type_id){
		$this->db->where('goods_type_id', $goods_type_id);
		$query =  $this->db->get('ci_attribute');
		return $query->result_array();
	}

}