<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台商品品牌控制器*/
class Goods_type extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('goods_type_model');
		// $this->load->library('upload');#加载upload库，配置在applicaion/config/upload.php中
	}

	public function index(){
		#获取品牌信息
		$data['goods_types'] = $this->goods_type_model->goods_type_list();
		$this->load->view('goods_type_list.html', $data);
	}

	public function add(){
		$this->load->view('goods_type_add.html');
	}

	public function edit($goods_type_id){
		$data['goods_type_info'] = $this->goods_type_model->get_goods_type_by_id($goods_type_id);
		$this->load->view('goods_type_edit.html', $data);
	}

	public function goods_type_add(){
		$this->form_validation->set_rules('goods_type_name', '商品类别名称','trim|required');
		if($this->form_validation->run()==false){
			#未通过验证
			$data['message'] = validation_errors();
			$data['url'] = base_url('admin/goods_type/add');
			$data['wait'] = 5;
			$this->load->view('message.html', $data);
		}else{
			#通过验证
			$arr = array(
						'goods_type_name' => $this->input->post('goods_type_name',true)
					);
			if($this->goods_type_model->add($arr)){
				$data = array(
					'url' => base_url('admin/goods_type/index'),
					'message' => '添加品牌成功',
					'wait' => 2
				);
				$this->load->view('message.html', $data);
				}else{
					$data = array(
						'url' => base_url('admin/goods_type/add'),
						'message' => '添加品牌失败',
						'wait' => 3
					);
					$this->load->view('message.html', $data);
				}
		}
	}

	public function goods_type_update(){
			$this->form_validation->set_rules('goods_type_name', '商品类型名称','trim|required');
			if($this->form_validation->run()==false){
				#未通过验证
				$data['message'] = validation_errors();
				$data['url'] = base_url('admin/goods_type/index');
				$data['wait'] = 5;
				$this->load->view('message.html', $data);
			}else{
					#通过验证
					$arr = array(
								'goods_type_id' => $this->input->post('goods_type_id',true),
								'goods_type_name' => $this->input->post('goods_type_name',true)
							);
					if($this->goods_type_model->goods_type_update($arr)){
					$data = array(
						'url' => base_url('admin/goods_type/index'),
						'message' => '修改商品类型成功',
						'wait' => 2
					);
					$this->load->view('message.html', $data);
				}else{
					$data = array(
						'url' => base_url('admin/goods_type/index'),
						'message' => '修改商品类型失败',
						'wait' => 3
					);
					$this->load->view('message.html', $data);
				}

			}
		}

	public function goods_type_delete($id){
		$this->goods_type_model->delete_goods_type_by_id($id);
		$this->index();
	}



}