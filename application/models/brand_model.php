<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Brand_model extends CI_Model{

	public function brand_add($arr){
		return $this->db->insert('ci_brand', $arr);
	}

	public function brand_list(){
		$query = $this->db->get('ci_brand');
		return $query->result_array();
	}

	public function delete_brand_by_id($id){
		$this->db->delete('ci_brand', array('brand_id'=>$id));
	}

	public function brand_get_logo_by_id($id){
		$query = $this->db->get('ci_brand');
		foreach($query->result() as $row){
			if($row->brand_id == $id)
				return $row->logo;
		}
		return NULL;
	}  
}