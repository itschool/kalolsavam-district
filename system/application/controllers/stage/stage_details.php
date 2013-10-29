<?php
class Stage_Details extends Controller {

	function Stage_Details()
	{
		parent::Controller(); 
		$this->template->add_js('js/stages.js');	
		$this->load->model('stages/Stage_Model');
		$this->template->write_view('menu', 'menu', '');
		$this->Session_Model->is_user_logged();
		$this->Session_Model->check_user_permission('1');
	}
	function index()
	{
		if(!@$this->Content)
			$this->Content	=	array();
		$this->Content['stage_array']		=	$this->Stage_Model->get_stage_name_array();
		$this->template->write_view('content', 'stage/add_stage', $this->Content);
		$this->Content['stages']	=	$this->Stage_Model->get_stages();
		if(count($this->Content['stages'])>0){
			$this->template->write_view('content', 'stage/stages',$this->Content);
		}
		$this->template->load();
	}
	
	function add_stage()
	{
		if($this->Session_Model->check_user_permission(19)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->form_validation->set_rules('txtStageName', 'Stage Name', 'required');
		$this->form_validation->set_rules('txtStageName', 'Stage Description', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->template->write('error', validation_errors().'<br>');
			$this->index();
			return;
		}else{
			if($this->Stage_Model->check_stagename_exists('', $this->input->post('txtStageName')))
			{
				$this->template->write('error', 'Stage name already exists');
				$this->index();
				return ;
			}
			
			$this->Stage_Model->save_stage_details();
			$this->template->write('message', 'Stage details saved successfully');
			$this->index();
		}
	}
	
	function edit_stage_detials()
	{
		if($this->Session_Model->check_user_permission(19)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['selected_stage']	=	$this->Stage_Model->select_stage_details();
		$this->index();
	}
	
	function update_stage_detials()
	{
		if($this->Session_Model->check_user_permission(19)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->form_validation->set_rules('txtStageName', 'Stage Name', 'required');
		$this->form_validation->set_rules('txtStageName', 'Stage Description', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->template->write('error', validation_errors().'<br>');
			return;
		}else{
			$stageId	=	$this->input->post('hidStId');
			if($this->Stage_Model->check_stagename_exists($stageId, $this->input->post('txtStageName')))
			{
				$this->template->write('error', 'Stage name already exists');
				$this->index();
				return;
			}
			$this->Stage_Model->update_stage_details();
			$this->template->write('message', 'Stage details updated successfully');
			$this->index();
		}
	}
	
	function delete_stage_detials()
	{
		if($this->Session_Model->check_user_permission(19)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Stage_Model->delete_stage_details();
		$this->index();
	}
	
}
	?>