<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台商品类别控制器*/
class Category extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('category_model');
		$this->load->library('form_validation');
	}

	#显示分类信息
	public function index(){
		$data['cates'] = $this->category_model->list_cate(0);
		$this->load->view('cat_list.html', $data);
	}

	#显示添加表单
	public function add(){
		$data['cates'] = $this->category_model->list_cate(0);
		$this->load->view('cat_add.html', $data);
	}

	#显示编辑表单
	public function edit($cat_id){
		$data['edit_cate'] = $this->category_model->get_category_by_id($cat_id);
		$data['cates'] = $this->category_model->list_cate(0);
		$this->load->view('cat_edit.html', $data);
	}

	#添加分类
	public function add_cate(){
		#设置验证规则
		$this->form_validation->set_rules('cat_name', '分类名称', 'trim|required');
		if($this->form_validation->run() == false){
			$data = array(
				'url' => base_url('admin/category/add'),
				'message' => validation_errors(),
				'wait' => 5
			);
			$this->load->view('message.html', $data);
		}else{
			$data['cat_name'] = $this->input->post('cat_name',true);
			$data['parent_id'] = $this->input->post('parent_id');
			$data['unit'] = $this->input->post('measure_unit',true);
			$data['sort_order'] = $this->input->post('sort_order', true);
			$data['is_show'] = $this->input->post('is_show');
			$data['cat_desc'] = $this->input->post('cat_desc', true);
			if($this->category_model->category_add($data)){
				$data = array(
				'url' => base_url('admin/category/add'),
				'message' => '添加商品类别成功',
				'wait' => 2
			);
			$this->load->view('message.html', $data);
			}else{
				$data = array(
				'url' => base_url('admin/category/add'),
				'message' => '添加商品类别失败',
				'wait' => 3
			);
			$this->load->view('message.html', $data);
			}
		}
	}

	public function update(){
		$this->form_validation->set_rules('cat_name', '分类名称', 'trim|required');
		if($this->form_validation->run()==false){
			$data = array(
				'url' => base_url('admin/category/index'),
				'message' => validation_errors(),
				'wait' => 3
			);
			$this->load->view('message.html', $data);
		}else{
			$data['cat_id'] = $this->input->post('cat_id');
			$data['cat_name'] = $this->input->post('cat_name',true);
			$data['parent_id'] = $this->input->post('parent_id');
			$data['unit'] = $this->input->post('measure_unit',true);
			$data['sort_order'] = $this->input->post('sort_order', true);
			$data['is_show'] = $this->input->post('is_show');
			$data['cat_desc'] = $this->input->post('cat_desc', true);
			if($this->category_model->category_update($data)){
				$data = array(
				'url' => base_url('admin/category/index'),
				'message' => '修改商品类别成功',
				'wait' => 2
			);
			$this->load->view('message.html', $data);
			}else{
				$data = array(
				'url' => base_url('admin/category/index'),
				'message' => '修改商品类别失败',
				'wait' => 3
				);
			$this->load->view('message.html', $data);
			}
		}

	}//end for function update



}//end for class category