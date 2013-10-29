<?php
class User_Cluster extends Controller {

	function User_Cluster()
	{
		parent::Controller(); 
		$this->template->add_js('js/user/user_cluster.js');	
		$this->load->model('user/User_Cluster_Model');
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->template->write_view('menu', 'menu', '');
		$this->Session_Model->is_user_logged();
		$this->Session_Model->check_user_permission('1');
	}
	function index()
	{
		
		
		$this->Content['schools']			=	$this->User_Cluster_Model->get_Schools();
		$this->Content['entered_school']	=	$this->User_Cluster_Model->get_entered_school();
		$this->template->write_view('content', 'user/user_cluster', $this->Content);
		$this->Content['retvalue']	=	$this->User_Cluster_Model->existing_cluster_details();
		if(count($this->Content['retvalue'])>0){
			$this->template->write_view('content', 'user/list_user_cluster',$this->Content);
		}
		$this->template->load();
	}
	
	function save_user_cluster()
	{
		if(!($this->Session_Model->check_user_permission(1) || $this->Session_Model->check_user_permission(13))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if($this->User_Cluster_Model->check_username_exists('', $this->input->post('txtNewUserName')))
		{
			$this->template->write('error', 'User name already exists');
			$this->index();
			return ;
		}
		
		$this->User_Cluster_Model->save_cluster_users();
		$this->template->write('message', 'User details saved successfully');
		$this->index();
	}
	
	function edit_user_cluster()
	{
		if(!($this->Session_Model->check_user_permission(1) || $this->Session_Model->check_user_permission(13))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['selected_cluster']			=	$this->User_Cluster_Model->select_cluster_user_details();
		$this->Content['selected_cluster_schools']	=	$this->User_Cluster_Model->get_selected_Schools();
		$this->index();
	}
	
	function update_user_cluster()
	{
		if(!($this->Session_Model->check_user_permission(1) || $this->Session_Model->check_user_permission(13))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$userId	=	$this->input->post('hidUserId');
		if($this->User_Cluster_Model->check_username_exists($userId, $this->input->post('txtNewUserName')))
		{
			$this->template->write('error', 'User name already exists');
			$this->index();
			return;
		}
		$this->User_Cluster_Model->update_user_cluster_details();
		$this->template->write('message', 'User details updated successfully');
		$this->index();
	}
	
	/*function delete_user_cluster()
	{
		if(!($this->Session_Model->check_user_permission(1) || $this->Session_Model->check_user_permission(13))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->User_Cluster_Model->delete_cluster_user_details();
		$this->index();
	}*/
	
	
	
}
	?>