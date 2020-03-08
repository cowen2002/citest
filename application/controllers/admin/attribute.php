<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台商品品牌控制器*/
class Attribute extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('attribute_model');
		$this->load->model('goods_type_model');
	}

	public function index($goods_type_id=0){
		$data['goods_types'] = $this->goods_type_model->goods_type_list();
		switch($goods_type_id){
			case 0:
				$data['attributes'] = $this->attribute_model->attribute_list();
				break;
			default:
				$data['attributes'] = $this->attribute_model->attribute_list_by_goods_type_id($goods_type_id);
		};
		$this->load->view('attribute_list.html', $data);
	}

	public function add(){
		#获取所有商品类型
		$data['goods_types'] = $this->goods_type_model->goods_type_list();
		$this->load->view('attribute_add.html', $data);
	}

	public function edit(){
		$this->load->view('attribute_edit.html');
	}

	#添加商品属性
	public function attribute_add(){
		$this->form_validation->set_rules('attr_name', '商品属性名称','trim|required');
		$this->form_validation->set_rules('goods_type_id', '所属商品类型','required');		
		if($this->form_validation->run()==false){
			#未通过验证
			$data['message'] = validation_errors();
			$data['url'] = base_url('admin/attribute/add');
			$data['wait'] = 5;
			$this->load->view('message.html', $data);
		}else{
			#通过验证
			$arr = array(
						'attr_name' => $this->input->post('attr_name',true),
						'goods_type_id' => $this->input->post('goods_type_id',true),
						'attr_type' => $this->input->post('attr_type',true),
						'attr_input_type' => $this->input->post('attr_input_type',true),
						'attr_value' => $this->input->post('attr_value',true)
					);
			if($this->attribute_model->attribute_add($arr)){
				$data = array(
					'url' => base_url('admin/attribute/index'),
					'message' => '添加商品属性成功',
					'wait' => 1
				);
				$this->load->view('message.html', $data);
				}else{
					$data = array(
						'url' => base_url('admin/attribute/add'),
						'message' => '添加商品属性失败',
						'wait' => 3
					);
					$this->load->view('message.html', $data);
				}
		}

	}







}