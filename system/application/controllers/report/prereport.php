<?php
class Prereport extends Controller {

		function Prereport()
		{
			parent::Controller();
			$this->Session_Model->is_user_logged(true);
			$this->template->add_js('js/report/staticreport.js');	
			$this->template->add_js('js/report/reportjs.js');	
			$this->load->library('HTML2PDF');
			$this->load->model('report/prereport_model');
			$this->template->write_view('menu', 'menu', '');
		}
		

		function list_school()
		{
			if($this->Session_Model->check_user_permission(27)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$sub_dist_array					=	$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('rev_district_code' => $this->session->userdata('DISTRICT')),'','sub_district_code');
			 $sub_dist_array['All']			=	'All Subdistricts';
			$this->Contents['sub_dist_array']		=	$sub_dist_array;
			$this->Contents['retdat']= $this->prereport_model->festval_details();
			$this->template->write_view('content', 'report/prereport/list_school', $this->Contents);
			
			$this->template->load();
		}
		
		function list_participants()
		{
			if($this->Session_Model->check_user_permission(30)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','All Festival','fest_id');
			$this->Contents['pfest']		=	$fest;
			
			$sub_dist_array					=	$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('rev_district_code' => $this->session->userdata('DISTRICT')),'','sub_district_code');
			$this->Contents['sub_dist_array']		=	$sub_dist_array;
			$this->template->write_view('content', 'report/prereport/list_participants', $this->Contents);
			
			
			
			  $this->Contents				=	array();
			   //$fest['ALL']='All Festival';
			   $this->Contents['fest']		=	$fest;
			  
			  $this->template->write_view('content', 'report/prereport/team_manager_all', $this->Contents);
			  
			$this->template->load();
		}
		 function four_reports()
   {
          $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		  $this->Contents				=	array();
		  $this->Contents['fest']		=	$fest;
		  $this->template->write_view('content','report/prereport/four_reports',$this->Contents);
		  $this->template->load();
     
   }
		
		function team_manager_all()
		{
			  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			  $this->Contents				=	array();
			   $last=array('ALL'=>'All Festival');
			   $fest=array_merge($fest,$last);
			   $this->Contents['fest']		=	$fest;
			  
			  $this->template->write_view('content', 'report/prereport/team_manager_all', $this->Contents);
			  $this->template->load();
		}
		
		
		function feedetails()
		{
			if($this->Session_Model->check_user_permission(32)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$this->template->write_view('content', 'report/prereport/feedetails', $this->Contents);
			$this->template->load();
		}
		
		
		
	function callsheet_first()
		{
			if($this->Session_Model->check_user_permission(34)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			
			$this->Contents['fest']		=	$fest;
			$this->template->write_view('content','report/prereport/callsheet_first',$this->Contents);
			$this->Contents=array();
			$this->template->write('title', '');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			//print_r($fest);
			$this->template->write_view('content', 'report/prereport/callsheet_all', $this->Contents);
			$stage							=	$this->General_Model->prepare_select_box_data('stage_master','stage_id,stage_name','','','stage_id');
		$this->Contents					=	array();
         $stage['All']			=	'All Stages';
		$this->Contents['stage']		=	$stage;
		$date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/call_date_stage',$this->Contents);
			$this->template->load(); 
		}
		
		function callsheet_all()
		{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  //print_r($fest);
		$this->template->write_view('content', 'report/prereport/callsheet_all', $this->Contents);
		$this->template->load();
		}
		
		
		function participant_cardindex()
		{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$sub_dist_array					=	$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('rev_district_code' => $this->session->userdata('DISTRICT')),'','sub_district_code');
			$this->Contents['sub_dist_array']		=	$sub_dist_array;
			$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$this->template->write_view('content', 'report/prereport/participant_cardindex_school', $this->Contents);
			$this->template->write_view('content', 'report/prereport/participant_cardindex', $this->Contents);
			
			$this->template->write_view('content', 'report/prereport/participant_regno', $this->Contents);
			
			$this->template->load();
		}
		
		
		function participant_cardindex2()
		{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$sub_dist_array					=	$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('rev_district_code' => $this->session->userdata('DISTRICT')),'','sub_district_code');
			$this->Contents['sub_dist_array']		=	$sub_dist_array;
			$this->template->write_view('content', 'report/prereport/participant_cardindex_school_photo_middle', $this->Contents);
			$this->template->write_view('content', 'report/prereport/participant_cardindex_photo_middle', $this->Contents);
			$this->template->write_view('content', 'report/prereport/participant_regno_photo_middle', $this->Contents);
				
			$this->template->load();
		}
		
		
		function participant_cardindex_photo()
		{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$sub_dist_array					=	$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('rev_district_code' => $this->session->userdata('DISTRICT')),'','sub_district_code');
			$this->Contents['sub_dist_array']		=	$sub_dist_array;
			$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$this->template->write_view('content', 'report/prereport/participant_cardindex_school_photo', $this->Contents);
			$this->template->write_view('content', 'report/prereport/participant_cardindex_photo', $this->Contents);
			
			$this->template->write_view('content', 'report/prereport/participant_regno_photo', $this->Contents);
			
			$this->template->load();
		}
		
		function list_of_participants_in_group()
		{
		    $this->Contents=array();
			$this->template->write('title', '');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$date_array					=	$this->General_Model->get_fest_date_array();
			//$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$this->template->write_view('content', 'report/prereport/list_of_participants_in_group', $this->Contents);
			//$this->template->write_view('content', 'report/prereport/list_of_participants_in_group_school', $this->Contents);
			
			$this->template->load();
		
		}
		function participant_regno()
		{
				$this->Contents=array();
				$this->template->write('title', '');
				$this->Contents['retdat']= $this->prereport_model->list_school_details();
				$this->template->write_view('content', 'report/prereport/participant_regno', $this->Contents);
				$this->template->load();
		}
		
		
		function participant_more_item()
		{
			$this->Contents= array();
			$this->template->write('title', '');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
		  	$this->Contents				=	array();
		  	$this->Contents['fest']		=	$fest;
			//$this->Contents['retdat']= $this->stage_report_model->list_school_details();
			$this->template->write_view('content', 'report/prereport/participant_more_item', $this->Contents);
			$this->template->load();
		}
		
		function participant_limit_item_more()
		{
			if($this->Session_Model->check_user_permission(40)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$no_array		=	array();
			for($i = 2; $i <= 10; $i++)
			{
			$no_array[$i]	=	$i;
			}
			$this->Contents['no_array']		=	$no_array;
			$this->template->write_view('content', 'report/prereport/participant_limit_item_more', $this->Contents);
			$this->template->load();
		}
		
		function clustor_report()
		{
			if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			//$this->Contents['retdat']= $this->stage_report_model->list_school_details();
			$this->template->write_view('content', 'report/prereport/clustor_report', $this->Contents);
			$this->Contents=array();
			$this->template->write('title', '');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			//print_r($fest);
			$this->template->write_view('content', 'report/prereport/cluster_report_all', $this->Contents); 
			$date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/cluster_report_date',$this->Contents);
			
		$stage							=	$this->General_Model->prepare_select_box_data('stage_master','stage_id,stage_name','','','stage_id');
		$this->Contents					=	array();

		$this->Contents['stage']		=	$stage;
		$this->template->write_view('content','report/prereport/cluster_report_stage',$this->Contents);
		$this->template->write_view('content','report/prereport/cluster_date_stage',$this->Contents);
			
			$this->template->load();
		}
		
		function clustor_report_all()
		{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  //print_r($fest);
		$this->template->write_view('content', 'report/prereport/cluster_report_all', $this->Contents);
		$this->template->load();
		
		}
		
		   function score_sheet_interfaces()
	     {    
		 	 if($this->Session_Model->check_user_permission(35)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents['fest']		=	$fest;
			$date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/score_sheet_interface',$this->Contents);
			
			
			$this->Contents=array();
			$this->template->write('title','');
			$this->Contents['retdat']= $this->prereport_model->festval_details();
			$this->template->write_view('content', 'report/prereport/scoresheet_fest', $this->Contents);
			
			
			$stage							=	$this->General_Model->prepare_select_box_data('stage_master','stage_id,stage_name','','','stage_id');
		    $this->Contents					=	array();
            $stage['All']			=	'All Stages';
		    $this->Contents['stage']		=	$stage;
		    $date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/score_date_stage',$this->Contents);
			
			
			$this->template->load(); 
		 }
		
		function fest_details()
		{   
		$this->Contents=array();
		$this->template->write('title', '');
		$this->Contents['retdat']= $this->prereport_model->festval_details();
		$this->template->write_view('content', 'report/prereport/fest_details', $this->Contents);
		$this->template->load();
		}
		
		 function tabulation_report_interface()
		 {
		  
		   if($this->Session_Model->check_user_permission(36)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Contents['fest']		=	$fest;
			 $date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/tabulation_report_interface1',$this->Contents);
			// $this->template->load();
			
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			
			$this->template->write_view('content','report/prereport/tabulation_report_interface',$this->Contents);
			$stage							=	$this->General_Model->prepare_select_box_data('stage_master','stage_id,stage_name','','','stage_id');
		     $this->Contents					=	array();
            $stage['All']			=	'All Stages';
		    $this->Contents['stage']		=	$stage;
		    $date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/tabulation_date_stage',$this->Contents);
			$this->template->load();
		  
		}
		 function rpt_tabulation_sheet()
			{
			//$this->load->model('staticreport/Tabulation_model');
			$this->Contents=array();
			$this->template->write('title', '');
			$itemcode						=	$this->input->post('cbo_item');
			$festival						=	$this->input->post('cmbFestType');
			$this->Contents['num']		    =	$this->input->post('txtParticipantNum');
			$retdata= $this->prereport_model->tabulation_details($itemcode);
			$retdata1= $this->prereport_model->tabulation_fest_details($festival);
			$this->Contents['retdata']=$retdata;
			$this->Contents['retdata1']=$retdata1;
			if(count($retdata)>0)
			{
					$this->template->write_view('content', 'report/prereport/rpt_tabulation_sheet', $this->Contents);
			//$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($itemcode);
			$content	=	$this->load->view('report/prereport/rpt_tabulation_sheet',$this->Contents,true);
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Tabulation_sheet.pdf', 'I');
			$this->template->load();
		}
		
	    
	}
  function  tabulation_report_interface1()
	  {
	   $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','report/prereport/tabulation_report_interface1',$this->Contents);
	  $this->template->load();
	}
	 function rpt_tabulation_sheet1()
		{
		$this->load->model('report/Prereport_Model');
		$this->Contents=array();
		$this->template->write('title', '');
			  	$festival						=	$this->input->post('cmbFestType');
				$date						=	$this->input->post('txtDate');
				$this->Contents['retvalue']= $this->Prereport_Model->tabulation_info($festival,$date);
				$this->template->write_view('content', 'report/prereport/rpt_tabulation_sheet1', $this->Contents);
				$content	=	$this->load->view('report/prereport/rpt_tabulation_sheet1',$this->Contents,true);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		        $html2pdf->pdf->SetDisplayMode('fullpage');
		        $html2pdf->WriteHTML($content, '');
		        $html2pdf->Output('Tabulation_sheet.pdf', 'I');
		        $this->template->load();
	    
	} 
		function timesheetinterface()//ratheesh
		{
			if($this->Session_Model->check_user_permission(41)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->load->model('staticreport/Itemreports_Model');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->template->write_view('content','report/prereport/timesheet',$this->Contents);
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/timesheet_date',$this->Contents);
			$stage							=	$this->General_Model->prepare_select_box_data('stage_master','stage_id,stage_name','','','stage_id');
		$this->Contents					=	array();
         $stage['All']			=	'All Stages';
		$this->Contents['stage']		=	$stage;
		$date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/time_date_stage',$this->Contents);
			$this->template->load();  
	}
	
	function datewisepart()//ratheesh
	{
	  if($this->Session_Model->check_user_permission(28)==false){
		$this->template->write('error', permission_warning());
		$this->template->load();
		return;
	  }
	  $this->template->add_js('js/popcalendar.js');
	  $this->template->add_css('style/calendar.css');
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  
	  $date_array					=	$this->General_Model->get_fest_date_array();
	  $date_array['All']			=	'All Dates';
	  $this->Contents['date_array']		=	$date_array;
	  
	  $this->template->write_view('content','report/prereport/datewisepart',$this->Contents);
	  $date_array					=	$this->General_Model->get_fest_date_array();
	  $date_array['All']			=	'All Dates';
	  $this->Contents['date_array']		=	$date_array;
	  
	  $this->template->write_view('content','report/prereport/datewisepart_school',$this->Contents);
	  $this->template->load();	  
	}
	//Stage Report Interface
	
	function stagereportdate()//ratheesh
	{
		if($this->Session_Model->check_user_permission(39)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->template->add_js('js/popcalendar.js');
		$this->template->add_css('style/calendar.css');
		
		$stage							=	$this->General_Model->prepare_select_box_data('stage_master','stage_id,stage_name','','');
		$this->Contents					=	array();

		$this->Contents['stage']		=	$stage;
		$date_array						=	$this->General_Model->get_fest_date_array();
		$date_array['ALL']				=	'All Date';
		$this->Contents['date_array']	=	$date_array	;
		
		$this->template->write_view('content','report/prereport/stagereportdate',$this->Contents);
		
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
		$this->Contents				=	array();
		$this->Contents['fest']		=	$fest;
		//print_r($fest);
		$this->template->write_view('content', 'report/prereport/stagereport_all', $this->Contents);
		
		$this->template->load();	  
	}
	
	function stagereport_all()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
		$this->Contents				=	array();
		$this->Contents['fest']		=	$fest;
		//print_r($fest);
		$this->template->write_view('content', 'report/prereport/stagereport_all', $this->Contents);
		$this->template->load();
	}
	function score_sheet_fest()
		{   
		$this->Contents=array();
		$this->template->write('title','');
		$this->Contents['retdat']= $this->prereport_model->festval_details();
		$this->template->write_view('content', 'report/prereport/scoresheet_fest', $this->Contents);
		$this->template->load();
		}
		function itemwise_report_interface()//ratheesh
		{
		  if($this->Session_Model->check_user_permission(29)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		  }
		  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		  $this->Contents				=	array();
		  $this->Contents['fest']		=	$fest;
		  
		  $this->template->write_view('content','report/prereport/itemwise_report_interface',$this->Contents);
		 $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
		   $this->Contents				=	array();
		   $this->Contents['fest']		=	$fest;
		   $date_array					=	$this->General_Model->get_fest_date_array();
	       $date_array['All']			=	'All Dates';
	       $this->Contents['date_array']		=	$date_array;
			//print_r($fest);
		  $this->template->write_view('content', 'report/prereport/list_participants_datewise', $this->Contents);
		  $stage							=	$this->General_Model->prepare_select_box_data('stage_master','stage_id,stage_name','','','stage_id');
		$this->Contents					=	array();
         $stage['All']			=	'All Stages';
		$this->Contents['stage']		=	$stage;
		$this->template->write_view('content','report/prereport/list_participants_stagewise',$this->Contents);
		  $this->template->load();
		}
		function stageallot_duration()
		{
		  	if($this->Session_Model->check_user_permission(31)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			
			$fest['ALL']               ='All Festival';
			
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->template->write_view('content','report/prereport/stageallot_duration',$this->Contents);
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$no_array		=	array();
			for($i = 2; $i <= 10; $i++)
			{
			$no_array[$i]	=	$i;
			}
			$this->Contents['no_array']		=	$no_array;
			$this->template->write_view('content', 'report/prereport/participant_limit_item_more', $this->Contents);
			$this->template->load();
		  
		}
		 
		function appealed_part()
		{
			if($this->Session_Model->check_user_permission(43)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->template->write_view('content','report/prereport/appealed_part',$this->Contents);
			$this->template->load();
		}
		 function appeal_courtorder()
		 {
		  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
		  $this->Contents				=	array();
		  $this->Contents['fest']		=	$fest;
		  $this->template->write_view('content','report/prereport/appeal_courtorder',$this->Contents);
		  $this->template->load();
		}
		
		function clashes_details_interface()
		{
			if($this->Session_Model->check_user_permission(37)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$fest['all']                         =   "All festivals";
			$this->Contents['fest']		=	$fest;
			$this->Contents['date_array']		=	$this->General_Model->get_fest_date_array();
			$this->template->write_view('content','report/prereport/clashes_report_interface',$this->Contents);
			$this->template->load();
	}
	function eligible_participants()
	{
	 	if($this->Session_Model->check_user_permission(8)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
	    $this->Contents					=	array();
		//$fest= Array_Remove($fest, 8, 2);

	    $fest['All']                    =   "All festivals";
	    $this->Contents['fest']			=	$fest;
	    $this->template->write_view('content','result/afterresult_report/eligible_result',$this->Contents);
		$sub_dist_array					=	$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('rev_district_code' => $this->session->userdata('DISTRICT')),'','sub_district_code');
			$this->Contents['sub_dist_array']		=	$sub_dist_array;
			$this->template->write_view('content','result/afterresult_report/eligible_result_subdistrict',$this->Contents);
	        $this->template->load();
	
	}
	
	function team_list()
		{
		    $this->Contents=array();
			$this->template->write('title', '');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$date_array					=	$this->General_Model->get_fest_date_array();
			//$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$this->template->write_view('content', 'report/prereport/team_list', $this->Contents);
			//$this->template->write_view('content', 'report/prereport/list_of_participants_in_group_school', $this->Contents);
			
			$this->template->load();
		
		}
	
	
}
	
?>