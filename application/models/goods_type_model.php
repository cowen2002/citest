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

	public function get_goods_type_by_id($id){
		$sql = 'select * from ci_goods_type where goods_type_id='.$id;
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function goods_type_update($arr){
		$this->db->where('goods_type_id', $arr['goods_type_id']);
		return $this->db->update('ci_goods_type', $arr);
	}

	public function delete_goods_type_by_id($id){
		$this->db->delete('ci_goods_type', array('goods_type_id'=>$id));
	}




}