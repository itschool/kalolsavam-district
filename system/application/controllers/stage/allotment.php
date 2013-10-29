<?php
class Allotment extends Controller {

	function Allotment()
	{
		parent::Controller(); 
		$this->template->add_js('js/popcalendar.js');	
		$this->template->add_css('style/calendar.css');	
		$this->template->add_js('js/stages.js');	
		$this->load->model('stages/Allotment_Model');
		$this->template->write_view('menu', 'menu', '');
		$this->Session_Model->is_user_logged();
		$this->Session_Model->check_user_permission('1');
	}
	function index($item_code = '')
	{
		if($this->Session_Model->check_user_permission(3)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$item_code                          =   $this->input->post('txtItemCode');
		$this->Content['no_of_clusters']	=	$this->General_Model->get_settings(1);
		$this->Content['interval_bw_items']	=	$this->General_Model->get_settings(2);
		$this->Content['no_of_judges']		=	$this->General_Model->get_settings(3);
		$this->Content['alloted_records']	=	$this->Allotment_Model->get_alloted_item_details();
		$this->Content['stages']			=	$this->Allotment_Model->get_stages();
		$this->Content['is_edit']			=	'yes';
		if ($item_code)
		{
			$this->Content['selected_item']		=	$this->Allotment_Model->get_item_details($item_code);
			$this->Content['alloted_records']	=	$this->Allotment_Model->get_alloted_item_details($item_code);
			$this->Content['cluster_master_details']	=	$this->Allotment_Model->get_cluster_master_details($item_code);
		}
		$this->Content['date_array']		=	$this->General_Model->get_fest_date_array();
		$this->Content['hour_array']		=	$this->General_Model->get_hour_array();
		$this->Content['min_array']			=	$this->General_Model->get_min_array();
		$this->template->write_view('content', 'stage/allotment', $this->Content);
		$this->template->load();
	}
	
	function get_item_details()
	{
		$this->Content['selected_item']		=	$this->Allotment_Model->get_item_details();
		$this->Content['no_of_clusters']	=	$this->General_Model->get_settings(1);
		$this->Content['interval_bw_items']	=	$this->General_Model->get_settings(2);
		$this->Content['no_of_judges']		=	$this->General_Model->get_settings(3);
		$this->Content['is_edit']			=	'yes';
		$this->Content['stages']			=	$this->Allotment_Model->get_stages();
		$this->Content['alloted_records']	=	$this->Allotment_Model->get_alloted_item_details();
		
		$this->Content['date_array']		=	$this->General_Model->get_fest_date_array();
		$this->Content['hour_array']		=	$this->General_Model->get_hour_array();
		$this->Content['min_array']			=	$this->General_Model->get_min_array();
		
		$this->Content['cluster_master_details']	=	$this->Allotment_Model->get_cluster_master_details();
		$this->load->view('stage/allotment', $this->Content);
	}
	
	function save_allotment () 
	{
		if($this->Session_Model->check_user_permission(3)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->form_validation->set_rules('cmbStage', 'Select Stage', 'required');
		$this->form_validation->set_rules('txtDate', 'Select Date', 'required');
		$this->form_validation->set_rules('txtHour', 'Enter Hour', 'required');
		$this->form_validation->set_rules('txtMin', 'Enter Minute', 'required');
		$this->form_validation->set_rules('cmbNoOfCluster', 'Select Number of clusters', 'required');
		$this->form_validation->set_rules('cmbNoOfJudges', 'Select Number of judges', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->template->write('error', validation_errors().'<br>');
			$this->index();
			return;
		}else{
			$this->Allotment_Model->save_allotment ();
			$this->index($this->input->post('hidItemId'));
		}
	}
	
	function update_allotment ()
	{
		if($this->Session_Model->check_user_permission(3)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->form_validation->set_rules('cmbStage', 'Select Stage', 'required');
		$this->form_validation->set_rules('txtDate', 'Select Date', 'required');
		$this->form_validation->set_rules('txtHour', 'Enter Hour', 'required');
		$this->form_validation->set_rules('txtMin', 'Enter Minute', 'required');
		$this->form_validation->set_rules('cmbNoOfCluster', 'Select Number of clusters', 'required');
		$this->form_validation->set_rules('cmbNoOfJudges', 'Select Number of judges', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->template->write('error', validation_errors().'<br>');
			$this->index();
			return;
		}else{
			$this->Allotment_Model->update_allotment ();
			$this->index($this->input->post('hidItemId'));
		}
	}
	
	function update_cluster_participant ()
	{
		if($this->Session_Model->check_user_permission(3)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$item_code		=	$this->input->post('hidClusterItemCode');
		$this->Allotment_Model->update_cluster_participant($item_code);
		$this->index($item_code);
	}
}
?>