<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->switch_theme_on();
	}
}

class Admin_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->switch_theme_off();

		#权限验证
		if (!$this->session->userdata('admin')){
			redirect('http://www.citest.com/admin/privilege/login');
		}
	}
}