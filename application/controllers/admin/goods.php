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
		$this->load->library('upload');#加载upload库，配置在applicaion/config/upload.php中
		date_default_timezone_set("PRC");//设置时区
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
		$html = "<tbody>";
		foreach($attrs as $v){
			$html .= "<tr>";
			$html .= "<td class='label'>".$v['attr_name']."</td>";
			$html .= "<td>";
			$html .= "<input type='hidden' name='attr_id_list[]' value='".$v['attr_id']."'>";
			switch($v['attr_input_type']){
				case 0:
					#文本框
					$html .= "<input name='attr_value_list[]' type='text' size='40'>";
					break;

				case 1:
					#下拉菜单
					$arr = explode(PHP_EOL, $v['attr_value']);
					$html .=  "<select name='attr_value_list[]'>";
					$html .=  "<option value=''>请选择...</option>";
					foreach($arr as $a){
						$html .=  "<option value='".$a."'>".$a."</option>";
					}
					$html .=  "</select>";				
					break;
				
				case 2:
					#文本域
					$html .= "<textarea name='attr_value_list[]' cols='30' rows='5' ></textarea>";
					break;
				
				default:
					break;
					
			};
			$html .= "<input type='hidden' name='attr_price_list[]' >";
			$html .= "</td>";
			$html .= "</tr>";
		};

		$html .= "</tbody>";
		echo $html;
	}


	public function goods_insert(){
		$data['goods_name'] = $this->input->post('goods_name');
		$data['goods_sn'] = $this->input->post('goods_sn');
		$data['cat_id'] = $this->input->post('cat_id');
		$data['brand_id'] = $this->input->post('brand_id');
		$data['goods_brief'] = $this->input->post('goods_brief');
		$data['goods_desc'] = $this->input->post('goods_desc');
		$data['market_price'] = $this->input->post('market_price');
		$data['shop_price'] = $this->input->post('shop_price');
		$data['promote_price'] = $this->input->post('promote_price');
		$data['promote_start_time'] = strtotime($this->input->post('promote_start_time'));
		$data['promote_end_time'] = strtotime($this->input->post('promote_end_time'));
		$data['goods_thumb'] = $this->input->post('goods_thumb');
		$data['goods_number'] = $this->input->post('goods_number');
		$data['click_count'] = $this->input->post('click_count');
		$data['type_id'] = $this->input->post('type_id');
		$data['is_promote'] = $this->input->post('is_promote');
		$data['is_best'] = $this->input->post('is_best');
		$data['is_new'] = $this->input->post('is_new');
		$data['is_hot'] = $this->input->post('is_hot');
		$data['is_onsale'] = $this->input->post('is_onsale');
		if ($this->upload->do_upload('goods_img')) {
			#上传图片成功，做缩略处理
			$res = $this->upload->data();
			$data['goods_img'] = $res['file_name'];
			$config_img['image_library'] ='gd2';
			$config_img['source_image'] = "./public/uploads/" . $res['file_name'];
			$config_img['create_thumb'] = true;
			$config_img['maintain_ratio'] = true;
			$config_img['width'] = 160;
			$config_img['height'] = 160;
			$this->load->library('image_lib', $config_img);
			if ($this->image_lib->resize()) {
				# 缩略成功
				$data['goods_thumb'] = $res['raw_name'].$this->image_lib->thumb_marker.$res['file_ext'];
				if($this->goods_model->add($data)){
					$arr = array(
							'url' => base_url('admin/goods/add'),
							'message' => '插入商品成功',
							'wait' => 1
							);
					$this->load->view('message.html', $arr);	
				} else {
					$arr = array(
							'url' => base_url('admin/goods/add'),
							'message' => '插入商品失败',
							'wait' => 3
							);
					$this->load->view('message.html', $arr);	
				}


			} else {
				# 缩略失败
				$arr = array(
							'url' => base_url('admin/goods/add'),
							'message' => $this->image_lib->display_errors(),
							'wait' => 3
							);
				$this->load->view('message.html', $arr);	
			}
			


		} else {
			#上传图片失败，提示出错信息
			$arr = array(
						'url' => base_url('admin/goods/add'),
						'message' => $this->upload->display_errors(),
						'wait' => 3
						);
			$this->load->view('message.html', $arr);
		}
		




	}





}