<?php
class User_Registration extends Controller {

	function User_Registration()
	{
		parent::Controller(); 
		$this->template->add_js('js/user/loginval.js');	
		$this->load->model('user/User_Registration_Model');
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->template->write_view('menu', 'menu', '');
		$this->Session_Model->is_user_logged();
		$this->Session_Model->check_user_permission('1');
	}
	function index()
	{
		
		$this->Content['user_rights']	=	$this->User_Registration_Model->get_user_rights();
		$this->template->write_view('content', 'user/user_registration', $this->Content);
		$this->Content['retvalue']	=	$this->User_Registration_Model->exist_user_details();
		if(count($this->Content['retvalue'])>0){
			$this->template->write_view('content', 'user/user_exist_reg',$this->Content);
		}
		$this->template->load();
	}
	
	function userinsert()
	{
		if(!($this->Session_Model->check_user_permission(1) || $this->Session_Model->check_user_permission(13))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if($this->User_Registration_Model->check_username_exists('', $this->input->post('txtNewUserName')))
		{
			$this->template->write('error', 'User name already exists');
			$this->index();
			return ;
		}
		
		$this->User_Registration_Model->save_user_details();
		$this->template->write('message', 'User details saved successfully');
		$this->index();
	}
	
	function edit_user_detials()
	{
		if(!($this->Session_Model->check_user_permission(1) || $this->Session_Model->check_user_permission(13))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['selected_user']	=	$this->User_Registration_Model->select_user_details();
		$this->Content['selected_user_rights']	=	$this->General_Model->get_single_column_value('user_rights','rf_id','user_id = "'.$this->input->post('UserIdty').'"');
		$this->index();
	}
	
	function update_user_detials()
	{
		if(!($this->Session_Model->check_user_permission(1) || $this->Session_Model->check_user_permission(13))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$userId	=	$this->input->post('hidUserId');
		if($this->User_Registration_Model->check_username_exists($userId, $this->input->post('txtNewUserName')))
		{
			$this->template->write('error', 'User name already exists');
			$this->index();
			return;
		}
		$this->User_Registration_Model->update_user_details();
		$this->template->write('message', 'User details updated successfully');
		$this->index();
	}
	
	function delete_user_detials()
	{
		if(!($this->Session_Model->check_user_permission(1) || $this->Session_Model->check_user_permission(13))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->User_Registration_Model->delete_user_details();
		$this->index();
	}
	
}
	?>