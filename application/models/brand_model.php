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

	public function get_brand_by_id($id){
		$sql = 'select * from ci_brand where brand_id='.$id;
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function brand_update($arr){
		$this->db->where('brand_id', $arr['brand_id']);
		return $this->db->update('ci_brand', $arr);
	}


}