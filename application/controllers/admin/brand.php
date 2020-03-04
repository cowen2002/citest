<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台商品品牌控制器*/
class Brand extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}
	
	#显示品牌信息
	public function index(){
		$this->load->view('brand_list.html');
	}

	#显示添加品牌页面
	public function add(){
		$this->load->view('brand_add.html');
	}

	#显示编辑品牌页面
	public function edit(){
		$this->load->view('brand_edit.html');
	}

	#添加品牌
	public function brand_add(){
		$this->form_validation->set_rules('brand_name', '品牌名称','trim|required');
		if($this->form_validation->run()==false){
			#未通过验证
			$data['message'] = validation_errors();
			$data['url'] = base_url('admin/brand/add');
			$data['wait'] = 5;
			$this->load->view('message.html', $data);
		}
		else{
			#通过验证
			
			
		}

	}
}