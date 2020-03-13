<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Goods_model extends CI_Model{
	CONST TBL_GOODS = 'ci_goods';
	public function add($arr){
		$query = $this->db->insert(self::TBL_GOODS, $arr);
		return $query ? $this->db->insert_id():false;
	}






}