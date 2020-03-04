<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 后台登入登出控制器*/
class Privilege extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('admin_model');
	}

	public function login(){
		$this->load->view('login.html');
	}

    #生成验证码
	public function code(){
		#调用函数生成验证码
		$vals = array(
			'word_length' => 4
		);
		$code = create_captcha($vals);
		#将验证码字符串保存到session中
		$this->session->set_userdata('code',$code['word']);
	}

	#处理登陆
	public function signin(){
		#设置验证规则
		$this->form_validation->set_rules('username', '用户名', 'required');
		$this->form_validation->set_rules('password', '密码', 'required');
		#获取表单数据
		$captcha = strtolower($this->input->post('captcha'));
		$code = strtolower($this->session->userdata('code'));
		if($captcha == $code){
			if($this->form_validation->run() == false)
			{
				$data = array(
				'url' => base_url('admin/privilege/login'),
				'message' => validation_errors(),
				'wait' => 5
				);
				$this->load->view('message.html',$data);
			}else{
				$userName = $this->input->post('username', true);
				$password = $this->input->post('password', true);
				if($this->admin_model->signin($userName, $password)){
					$this->session->set_userdata('admin', $userName);
					redirect(base_url('admin/Admin_main/index'));
				}else{
						$data = array(
						'url' => base_url('admin/privilege/login'),
						'message' => '用户名密码错误',
						'wait' => 3
						);
						$this->load->view('message.html',$data);
				};				
			}
		}else{
			#验证码不正确，给出提示页面，然后返回
			$data = array(
				'url' => base_url('admin/privilege/login'),
				'message' => '验证码错误，请重新填写',
				'wait' => 3
			);
			$this->load->view('message.html',$data);
		};
	}

	public function logout(){
		$this->session->unset_userdata('admin');
		$this->session->sess_destroy();
		redirect(base_url('admin/privilege/login'));
	}
}
