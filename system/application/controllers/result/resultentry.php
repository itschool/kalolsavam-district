<?php
class Resultentry extends Controller {

	function Resultentry()
	{
		parent::Controller();
		$this->Session_Model->is_user_logged(true);
		$this->template->write_view('menu', 'menu', '');
		$this->template->add_js('js/result.js');
		$this->template->add_js('js/common.js');
		$this->load->library('HTML2PDF');
		//$this->template->write_view('left_panel', 'menu_left', '');
		$this->load->model('result/Result_Model');
	}
	
	function index($message=array(), $item_code = '')
	{
		if($this->Session_Model->check_user_permission(12)==false){
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
		$item_code		= (empty($item_code))? $this->input->post('hidItemId'):$item_code;
		if($item_code)
		{
			$this->Content['selected_item']			=	$this->Result_Model->get_item_details_result($item_code);
			$this->Content['selected_item_list']	=	$this->Result_Model->get_item_result_list($item_code);
			
			$this->Content['selected_item_list']	=	$this->Result_Model->get_item_result_list($item_code);
			if(is_array($this->Content['selected_item_list'])  && count($this->Content['selected_item_list']) > 0)
			{
				$this->Content['show_conirm_button']	=	($this->Result_Model->check_confirm_item($item_code))?'yes':'no';
			}
			else 
			{
				$this->Content['show_conirm_button']	=	'yes';
			}
			$this->Content['absentee_list']		= $this->Result_Model->get_absentee_list($item_code);
			$this->Content['add_edit']			= ($this->Content['show_conirm_button'] == 'no')? 'no': 'yes';
		}
		if(!isset($this->Content))
			$this->Content	= array();
		$this->template->write_view('content', 'result/resultentry', $this->Content);
		$this->template->load();
	}
	
	function get_item_details_result()
	{
		
		$item_id		= $this->input->post('code');
		$this->Content['selected_item']			=	$this->Result_Model->get_item_details_result($item_id);
		$this->Content['selected_item_list']	=	$this->Result_Model->get_item_result_list($item_id);
		if(is_array($this->Content['selected_item_list'])  && count($this->Content['selected_item_list']) > 0)
		{
			$this->Content['show_conirm_button']	=	($this->Result_Model->check_confirm_item($item_id))?'yes':'no';
		}
		else 
		{
			$this->Content['show_conirm_button']	=	'yes';
		}
		$this->Content['absentee_list']		= $this->Result_Model->get_absentee_list($item_id);
		$this->Content['add_edit']	= ($this->Content['show_conirm_button'] == 'no')? 'no': 'yes';
		$this->load->view('result/resultentry', $this->Content);
	}
	
	function save_result_entry()
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['show_conirm_button'] = 'yes';
		$this->Content['add_edit']	= 'yes';
		$message	=	$this->Result_Model->save_result_details();
		$this->index($message);
	}
	
	function edit_result_entry () {
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['show_conirm_button'] = 'yes';
		$this->Content['add_edit']	= 'yes';
		$this->Content['selected_result']	=	$this->Result_Model->get_selected_result_details();
		$this->index();
	}
	
	function delete_result_entry () {
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['show_conirm_button'] = 'yes';
		$this->Content['add_edit']	= 'yes';
		$this->Result_Model->delete_result();
		$this->index();
	}
	
	function confirm_result_entry ()
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidItemId'))
		{
			if($this->Result_Model->set_confirm_result($this->input->post('hidItemId')))
			{
				$this->Content['show_conirm_button']	= 'yes';
				$this->Content['add_edit']				= 'yes';
				$this->Content['absentee_list']			= $this->Result_Model->get_absentee_list($this->input->post('hidItemId'));
				$findFirstrank	=	$this->Result_Model->findTwoFirstRank($this->input->post('hidItemId'));
				if($findFirstrank[0]['firstRanks'] > 1){
					$reset 	=	$this->Result_Model->reset_result_confirmation_status ($this->input->post('hidItemId'));
				    $this->template->write('error', 'There are '.$findFirstrank[0]['firstRanks'].' first ranks , Only one First rank is allowed');
				}
				else
					$this->template->write('message', 'Result details confirmed successfully');
				
			}
			else
			{
				$this->Content['show_conirm_button'] = 'no';
				$this->Content['add_edit']	= 'no';
				$this->template->write('error', 'Failed to confirm Result details');
			}
			$this->index(array(), $this->input->post('hidItemId'));
		}
		else redirect('result/resultentry');
	}
	function printConfidentialReport ()
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidItemId'))
		{
			
				$this->load->model('report/timefest_model');		
				$this->Contents=array();
				$this->template->write('title', '');
				$itemcode						=	$this->input->post('hidItemId');
				$festival						=	$this->input->post('hidFestcode');
				$date							=	$this->input->post('txtDate');
				$festname= $this->timefest_model->fetch_festname($festival);
				$retdat= $this->timefest_model->timeoffest_result($itemcode);
				$participated= $this->timefest_model->timeoffest_count($itemcode);
				$absentee_list= $this->timefest_model->timeoffest_result_absentee($itemcode);
				// print_r($absentee_list);
				 $absentee	= explode(',', $absentee_list);
					   
				if(count($retdat)>0)
				{
				$this->Contents['judjes_count']	= $retdat[0]['no_of_judges'];
				$this->Contents['itemcode']		=$itemcode;
				$this->Contents['festname']     =$festname;
				$this->Contents['retdat']       =$retdat;
				$this->Contents['participated'] =$participated;
				$this->Contents['absentee']     =$absentee;		
				$content	=	$this->load->view('report/timeof_fest_reportpdf/timefest_result_confidential',$this->Contents,true);
			
				//
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('Confidential_Report.pdf', 'I');
	    }
			
			$this->index(array(), $this->input->post('hidItemId'));
		}
		else redirect('result/resultentry');
	}
	
	function item_result_list ()
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents				=	array();
		$fest= $this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
		$this->Contents['fest']		=	$fest;
		$this->template->write_view('content', 'result/festival_type_list', $this->Contents);
		$fest_id	= $this->input->post('cmbFestType');
		if($fest_id)
		{
			$this->Contents	= array();
			$this->Contents['fest']		=	$this->General_Model->get_data('festival_master', 'fest_name', array('fest_id' => $fest_id));
			$itempart					=	$this->Result_Model->get_item_result($this->input->post('cmbFestType'));
			$single            			=   $this->Result_Model->get_item_result_single($this->input->post('cmbFestType'));
			$this->Contents['itempart']	= 	$itempart;
			$this->Contents['single']   =   $single;
			
			if(count($itempart)>0 or count($single)>0 )
			{
				$this->template->write_view('content','result/item_result_details',$this->Contents);
			}
		}
		$this->template->load();

	}
}

?>
