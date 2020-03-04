<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台商品品牌控制器*/
class Brand extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('brand_model');
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
			$arr = array(
				'brand_name' => $this->input->post('brand_name',true),
				'brand_desc' => $this->input->post('brand_desc',true),
				'url' => $this->input->post('url',true),
				'sort_order' => $this->input->post('sort_order',true),
				'is_show' => $this->input->post('is_show')
			);
			if($this->brand_model->brand_add($arr)){
				$data = array(
				'url' => base_url('admin/brand/index'),
				'message' => '添加品牌成功',
				'wait' => 2
			);
			$this->load->view('message.html', $data);
			}else{
				$data = array(
				'url' => base_url('admin/brand/add'),
				'message' => '添加品牌失败',
				'wait' => 3
				);
			$this->load->view('message.html', $data);
			}
			
		}

	}
}