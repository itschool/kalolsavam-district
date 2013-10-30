<?php
class Export extends Controller {

	function Export()
	{
		parent::Controller();
		$this->Session_Model->is_user_logged(true);
		$this->template->add_js('js/admin/admin.js');
		$this->template->write_view('menu', 'menu', '');
		$this->load->model('export_model');
		$this->load->helper('csv/csv');
		$this->Contents = array();
		//$this->template->write_view('left_panel', 'menu_left', '');
	}
	
	function index()
	{
		$this->export_sub_district_data();
	}

	function export_sub_district_data()
	{
		if($this->Session_Model->check_user_permission(8)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		
		if ($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE')==3)
		{
			$confirm_data_entry	= $this->General_Model->get_data('sub_district_master', 'confirm_data_entry', array('sub_district_code' => $this->session->userdata('SUB_DISTRICT')));
			if(is_array($confirm_data_entry) && count($confirm_data_entry) > 0 && 'Y' == @$confirm_data_entry[0]['confirm_data_entry'])
			{
				$name_csv			=	"kalolsavam_sub_dist_data_".$sub_dist_code;
				$export_array		= $this->export_model->get_sub_dist_school_export_data();
				array_to_csv($export_array,$name_csv.'.csv');
			}
			else
			{
				redirect('welcome/cluster_details');
			}
		}
		else redirect ('welcome');
	}
	function export_district_data ()
	{
		if($this->Session_Model->check_user_permission(8)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		
		if ($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE')==3)
		{
			if('' != $this->input->post('hidExport') && 'TRUE' == $this->input->post('hidExport'))
			{
				$name_csv			=	$dist_code."_kalolsavam_dist_data_sub_dist_".$sub_dist_code;
				
				$export_array		= $this->export_model->get_district_export_data();
				array_to_csv($export_array,$name_csv.'.csv');
			}
			else
			{
				$this->template->write_view('content', 'export/district_data', $this->Contents);
				$this->template->load();
			}
		}
		else redirect ('welcome');
	}
	
	function export_state_data ()
	{
		if($this->Session_Model->check_user_permission(8)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		
		if ($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE')==2)
		{
			if('' != $this->input->post('hidExport') && 'TRUE' == $this->input->post('hidExport'))
			{
				$name_csv			=	"kalolsavam_state_data_dist_".$dist_code;
				
				$export_array		= $this->export_model->get_state_export_data();
				array_to_csv($export_array,$name_csv.'.csv');
			}
			else
			{
				$this->template->write_view('content', 'export/state_data', $this->Contents);
				$this->template->load();
			}
		}
		else redirect ('welcome');
	}
}
?>