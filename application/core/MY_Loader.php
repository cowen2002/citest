<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Loader extends CI_Loader{

	protected $_theme = 'default/';
	public function switch_theme_on(){
		$this->_ci_view_paths = array(FCPATH . THEMES_DIR . $this->_theme => true);
	}

	public function switch_theme_off(){
		//nothing need to do
	}
}