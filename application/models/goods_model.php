<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Goods_model extends CI_Model{

	public function add($arr){
		$query = $this->db->insert('ci_goods', $arr);
		return $query? this->db->insert_id():false;
			}





}