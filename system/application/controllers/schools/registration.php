<?php
class Registration extends Controller {
	function Registration()
	{
		parent::Controller();
		$this->Session_Model->is_user_logged(true);
		$this->template->write_view('menu', 'menu', '');
		$this->load->model('schools/Registration_Model');
		//$this->template->write_view('left_panel', 'menu_left', '');
		$this->Content['is_edit']	=	'yes';
	}
	
	function index($message = array())
	{
		if(!($this->Session_Model->check_user_permission(14) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if (count(@$message['error_array']) > 0)
		{
			$error_msg		=	'';
			foreach(@$message['error_array'] as $error)
			{
				$this->template->write('error',$error.'<br>');
				$error_msg		.=	$error.'\n';	
			}
			$this->Content['error_msg']	=	$error_msg;
		}
		$schoolCode	=	'';
		if($this->input->post('hidSchoolId')){
			$schoolCode	=	$this->input->post('hidSchoolId');
		}
		if(trim($this->session->userdata('SCHOOL_CODE')) != 0){
			$schoolCode	=	trim($this->session->userdata('SCHOOL_CODE'));
		}
		
		if($schoolCode){
			
			$school_details						=	$this->Registration_Model->get_school_details($schoolCode);
			$this->Content['school_details']	=	$school_details;	
			if ((int)@$school_details[0]['sd_id'] > 0)
			{
				$this->Content['school_show']	=	'show';
			}
			else
			{
				$this->Content['school_show']	=	'';
			}
			$this->Content['participant_details']	= $this->Registration_Model->get_participant_details($schoolCode);
			$this->Content['group_details']	= $this->Registration_Model->get_group_details($schoolCode);
			
			$this->Content['participant_item_list']	= $this->Registration_Model->get_participant_item_list($schoolCode);
			
			$this->Content['is_edit']	=	$this->Registration_Model->is_editable_school($schoolCode);
			
		} else {
			$this->Content = array();
		}
		$this->template->write_view('content', 'schools/school_entry', $this->Content);
		$this->template->load();
			
	}
	function update()
	{
		if(!($this->Session_Model->check_user_permission(14) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$message		=	$this->Registration_Model->save_school_details();
		$this->index($message);
	}
	 
	function get_school_details(){
	
		$school_details						=	 $this->Registration_Model->get_school_details($this->input->post('code'));
		/*if(count($school_details) == 0){
			$this->template->write('error', 'Invalid School Code');
			$this->load->view('schools/school_entry', $this->Content);
			return;
		}*/
		$this->Content['participant_details']	= $this->Registration_Model->get_participant_details($this->input->post('code'));
		$this->Content['school_details']	=	$school_details;
		$this->Content['group_details']	= $this->Registration_Model->get_group_details($this->input->post('code'));
		
		$this->Content['participant_item_list']	= $this->Registration_Model->get_participant_item_list($this->input->post('code'));
		
		$this->Content['is_edit']	=	$this->Registration_Model->is_editable_school($this->input->post('code'));
		if ((int)@$school_details[0]['sd_id'] > 0)
		{
			$this->Content['school_show']	=	'show';
		}
		else
		{
			$this->Content['school_show']	=	'';
		}
		$this->load->view('schools/school_entry', $this->Content);
	}
	function edit_school_details () {
		if(!($this->Session_Model->check_user_permission(14) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if($this->input->post('hidSchoolId')){
			$this->Content['school_show']	=	'edit';
			$this->Content['school_details']	= $this->Registration_Model->get_school_details($this->input->post('hidSchoolId'));
			$this->Content['participant_details']	= $this->Registration_Model->get_participant_details($this->input->post('hidSchoolId'));
		}else{
			$this->Content = array();
		}
		$this->template->write_view('content', 'schools/school_entry', $this->Content);
		$this->template->load();
	}
	
	function save_participant () {
		if(!($this->Session_Model->check_user_permission(14) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$save_participant		=	$this->Registration_Model->save_participant_details();
		$this->index($save_participant);
	}
	 
	function edit_participant_detials() {
		if(!($this->Session_Model->check_user_permission(14) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['selected_participant']	=	$this->General_Model->get_data('participant_details', '*', 'school_code = "'.$this->input->post('hidSchoolId').'" AND admn_no = "'.$this->input->post('hidADNO').'"');
		$this->index();
	}
	
	function update_participant_detials() {
		if(!($this->Session_Model->check_user_permission(14) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$update_participant		=	$this->Registration_Model->update_participant_details();
		$this->index($update_participant);
	}
	
	function update_group_captain()
	{
		if(!($this->Session_Model->check_user_permission(14) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$update_group_captains		=	$this->Registration_Model->update_group_captains();
		$this->index();
	}
	
	function finalize_data()
	{
		if(!($this->Session_Model->check_user_permission(14) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$school_code			=	$this->input->post('hidSchoolId');
		$get_message			=	$this->Registration_Model->finalize_school_details($school_code);
		$this->index($get_message);
		
	}
	
	function create_csv_generation()
	{
		if(!($this->Session_Model->check_user_permission(19) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->load->helper('csv_helper/csv');
		
		$school_code			=	$this->input->post('hidSchoolId');
		//$this->Registration_Model->create_csv_generation($school_code);
		$get_message			=	$this->Registration_Model->create_csv_generation($school_code);
		//return;
		$this->index($get_message);
	}
	
	function delete_participant_detials() {
		$school_code		=	@$this->input->post('hidSchoolId');
		$admn_no			=	@$this->input->post('hidADNO');
		
		$delete_message		=	$this->Registration_Model->delete_participant_details($school_code,$admn_no);
		$this->index($delete_message);
	}
	
}
?>