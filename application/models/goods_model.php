<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Goods_model extends CI_Model{

	public function add($arr){
		return $this->db->insert('ci_goods', $arr);
	}





}