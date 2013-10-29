<?php
class Timefestreport extends Controller {

		function Timefestreport()
		{
		parent::Controller();
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/result.js');
		$this->load->library('HTML2PDF');
		$this->load->model('report/prereport_model');
		$this->template->write_view('menu', 'menu', '');
		$this->load->model('report/timefest_model');
		}
		

		function timefest_result()
		{ 	 
	  $this->template->add_js('js/popcalendar.js');
	  $this->template->add_css('style/calendar.css');
	 	  
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $this->Contents[]				=	array();
	 
	// $last=array('ALL'=>'All Festival');
	// $fest=array_merge($fest,$last);
	 
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','report/timeof_fest_report/timefest_result',$this->Contents);
	  $this->template->load();	  
	}
	
	function timefest_result_confidential()
		 
	{ 	 
	  $this->template->add_js('js/popcalendar.js');
	  $this->template->add_css('style/calendar.css');
	  $resultFest=$this->input->post('resultFest');
	   
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
	  $this->Contents[]				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','report/timeof_fest_report/timeoffest',$this->Contents);
		   if($resultFest){
		   		$this->Contents	             = array();
				$resultdet                   = $this->timefest_model->timefestconfidential($resultFest);
		   		$this->Contents['resultdet'] =  $resultdet;
				$this->Contents['fest']      =  $resultFest;
				
				if(count($resultdet)>0){
		   	 $this->template->write_view('content','report/timeof_fest_report/timeoffestview',$this->Contents);
		   }
		   }
	  $this->template->load();
	 
	}
	
	
	function timefest_result_common()
		 
	{ 	 
	  $this->template->add_js('js/popcalendar.js');
	  $this->template->add_css('style/calendar.css');
	  $resultFest=$this->input->post('resultFest');
	   
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
	  $this->Contents[]				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','report/timeof_fest_report/resultcommon',$this->Contents);
		   if($resultFest){
		   		$this->Contents	             = array();
				$resultdet                   = $this->timefest_model->timefestconfidential($resultFest);
		   		$this->Contents['resultdet'] =  $resultdet;
				$this->Contents['fest']      =  $resultFest;
				
				if(count($resultdet)>0){
		   	 $this->template->write_view('content','report/timeof_fest_report/timeoffestviewcommon',$this->Contents);
		   }
		   }
	  $this->template->load();
	 
	}
	
	
	
	
	
	
	/*
	function timefest_result_confidential()
		 
	{ 	 
	  $this->template->add_js('js/popcalendar.js');
	  $this->template->add_css('style/calendar.css');
	 	  
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $this->Contents[]				=	array();
	 
	// $last=array('ALL'=>'All Festival');
	// $fest=array_merge($fest,$last);
	 
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','report/timeof_fest_report/timefest_result_confidential',$this->Contents);
	  $this->template->load();	  
	}
	*/
	
	
	}
	
?>