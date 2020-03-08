<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台商品品牌控制器*/
class Goods_type extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('goods_type_model');
		$this->load->library('pagination');
		// $this->load->library('upload');#加载upload库，配置在applicaion/config/upload.php中
	}

	public function index($offset=''){

		// #---分页显示begin---
		// #配置分页信息
		// $config['base_url'] = base_url('admin/goods_type/index');
		// $config['total_rows'] = $this->goods_type_model->goods_type_count();
		// $config['per_page'] = 2;
		// $config['uri_segment'] = 4;
		// $config['last_link'] = ' 最末页';
		// $config['first_link'] = '第一页 ';
		// $config['prev_link'] = '上一页 ';
		// $config['next_link'] = ' 下一页';
		// #初始化分页类
		// $this->pagination->initialize($config);
		// #生成分页信息
		// $data['pageinfo'] = $this->pagination->create_links();
		// #获取分页信息
		// $data['goods_types'] = $this->goods_type_model->goods_type_list_page($config['per_page'], $offset);
		// #---分页显示end---
		
		#显示品牌信息
		$data['goods_types'] = $this->goods_type_model->goods_type_list();#不分页，全显示
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
		$this->form_validation->set_rules('goods_type_name', '商品类型名称','trim|required');
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
					'message' => '添加商品类型成功',
					'wait' => 2
				);
				$this->load->view('message.html', $data);
				}else{
					$data = array(
						'url' => base_url('admin/goods_type/add'),
						'message' => '添加商品类型失败',
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