<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台商品品牌控制器*/
class Goods extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('goods_model');
		$this->load->library('pagination');
		// $this->load->library('upload');#加载upload库，配置在applicaion/config/upload.php中
	}

	public function index(){
		$this->load->view('goods_list.html');
	}

	public function add(){
		$this->load->view('goods_add.html');
	}

	public function get_attribute_by_goods_type_id(){
		echo 'htmls...';

	}








}