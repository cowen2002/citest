<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台商品品牌控制器*/
class Goods extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('goods_model');
		$this->load->model('goods_type_model');
		$this->load->model('attribute_model');
		$this->load->library('pagination');
		// $this->load->library('upload');#加载upload库，配置在applicaion/config/upload.php中
	}

	public function index(){
		$this->load->view('goods_list.html');
	}

	public function add(){
		$data['goods_types'] = $this->goods_type_model->goods_type_list();
		$this->load->view('goods_add.html', $data);
	}

	public function get_attribute_by_goods_type_id(){
		$goods_type_id = $this->input->get('goods_type_id');
		$attrs = $this->attribute_model->attribute_list_by_goods_type_id($goods_type_id);
		var_dump($attrs);
		//echo $attrs;


		

	}








}