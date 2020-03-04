<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model{
	public function signin($username, $password){
		return $this->db->query('select * from admin where name="'.$username.'"  and password="'.$password.'"')->num_rows();
	}
}