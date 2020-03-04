<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category_model extends CI_Model{
	public function list_cate($pid){
		$qurey = $this->db->get('ci_category');
		$cates = $qurey->result_array();
		return $this->_tree($cates);
	}

	public function _tree($arr, $pid=0, $level=0){
		static $re = array();
		foreach($arr as $v){
			if($v['parent_id'] == $pid){
				$v['level'] = $level;
				$re[] = $v;
				$this->_tree($arr, $v['cat_id'], $level+1);
			}
		}
		return $re;
	}

	public function category_add($arr){
		return $this->db->insert('ci_category', $arr);
	}

	public function get_category_by_id($id){
		$sql = 'select * from ci_category where cat_id='.$id;
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function category_update($arr){
		$this->db->where('cat_id', $arr['cat_id']);
		return $this->db->update('ci_category', $arr);
	}

}//end for class category_model