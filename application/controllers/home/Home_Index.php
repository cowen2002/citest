<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_Index extends Home_Controller{
	public function index(){
		$this->load->view('index');
	}
}