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

	}





}