<?php
class User_Right extends Controller {

	function User_Right()
	{
		parent::Controller();
		//$this->load->model('Session_Model');
		//$this->load->model('General_Model');
		//$this->Session_Model->is_user_logged(true);
		$this->template->write_view('menu', 'menu', '');
		//$this->template->write_view('left_panel', 'menu_left', '');
	}
	
	function index()
	{
		
		//$this->template->write_view('content', '', $this->Content);
		$this->template->load();
		
	}
	
}

?>