<?php
class Resultindex extends Controller{

	function Resultindex()
	{
		parent::Controller();
		$this->Session_Model->is_user_logged(true);
		$this->template->write_view('menu', 'menu', '');
		$this->template->add_js('js/stages.js');	
		$this->template->add_js('js/report/staticreport.js');
		$this->load->model('report/resultindex_model');
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
	}
	function resultview()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->get_data('festival_master','fest_id,fest_name','','fest_id');
		$this->Contents['fest']         =    $fest;
		$this->template->write_view('content', 'publishresult/resultview', $this->Contents);
		$this->template->load();
		
	}
	function result_declared()
	{
		$fesid           = 	$this->input->post('hidfestId');
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->result_rank($fesid);
	//	print_r($details);
	
		$this->Contents['details']   =  $details;
		$this->load->view('publishresult/result_declared', $this->Contents);
		
	}
	function schoolpoints()
	{
		$festid=$this->input->post('hidfestId');
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->schoolpoints($festid);
		//print_r($details);
	
		$this->Contents['details']   =  $details;
		$this->load->view('publishresult/schoolpoints', $this->Contents);
	}
	
    function allresults()
	{
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->allresults();
	//print_r($details);
		
		$this->Contents['details']   =  $details;
		$this->load->view('publishresult/allresults', $this->Contents);
		
	}
	
	function festval_status()
	{
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details1         = 	$this->resultindex_model->festval_status1();
		$details2         = 	$this->resultindex_model->festival_status2();
		//print_r($details);
		$this->Contents['details1']   =  $details1;
		$this->Contents['details2']   =  $details2;
		$this->template->write_view('content', 'publishresult/festival_status', $this->Contents);
		$this->template->load();
	}
	
	function festival_allitem()
	{
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$totitem         = 	$this->resultindex_model->festval_allitems($fest);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('publishresult/festival_allitem', $this->Contents);
	}
	function finished_item()
	{
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$totitem         = 	$this->resultindex_model->finished_allitems($fest);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('publishresult/finished_allitem', $this->Contents);
	}
	function incomplete_item()
	{
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$totitem         = 	$this->resultindex_model->incomplete_allitems($fest);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('publishresult/incomplete_item', $this->Contents);
	}
	function gradewise_interface()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$this->template->write_view('content', 'report/publishresult/gradewise', $this->Contents);
		$this->template->load();
	}
	function gradewise_report()
	{
		$this->Contents  =  array();
		$schoolcode      =	$this->input->post('txtSchoolCode');
		if($schoolcode==""){
		$grade           =  $this->resultindex_model->gradewise_report($schoolcode);  
		
		}
		else{
		$grade           =  $this->resultindex_model->gradewise_report($schoolcode);  
		}
		$this->Contents['grade']  =  $grade;
			if(count($grade)>0){
			$content   =   $this->load->view('report/publishresult/gradewisereport',$this->Contents,true);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('project_urls.pdf', 'I');
				}
			else{
				redirect('test/nodata');
			
			}
			
	}
	function itemwise_result()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		$this->Contents				=	array();
		$this->Contents['fest']		=	$fest;
		$this->template->write_view('content', 'report/publishresult/itemwise', $this->Contents);
		$this->template->load();
	}
	function itemwise_report()
	{
		$this->Contents  =  array();
		$festId    		 =	$this->input->post('cmbFestType');
		$itemCode    	 =	$this->input->post('cbo_item');
		$itemwise        =  $this->resultindex_model->itemwise_report($festId,$itemCode); 
		$this->Contents['itemwise']  =  $itemwise;
		//print_r($itemwise);
		
		$content   =   $this->load->view('report/publishresult/itemwise_report',$this->Contents,true);
				
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('project_urls.pdf', 'I');
			
	}
	function rankwise_result()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		$this->Contents				=	array();
		$this->Contents['fest']		=	$fest;
		$date_array					=	$this->General_Model->get_fest_date_array();
	    $date_array['All']			=	'All Dates';
	    $this->Contents['date_array']		=	$date_array;
		$this->template->write_view('content', 'report/publishresult/rankwise', $this->Contents);
		$this->template->load();
	}
	
	function rankwise_report()
	{
		 $this->Contents     		  =	 	 array();
		 $festId    				  =		$this->input->post('cmbFestType');
		 $item    				      =		$this->input->post('cbo_item');
		 $rank   	    	 		  =		$this->input->post('rank');
		 $date   	    	 		  =		$this->input->post('txtDate');
		 $rankwise           		  =  	$this->resultindex_model->rankwise_report($festId,$item,$rank,$date); 
		 $this->Contents['rankwise']  =  $rankwise;
		 $this->Contents['rank']      =  $rank ; 
		 
			if(count($rankwise)>0){
				$content   =   $this->load->view('report/publishresult/rankwise_report',$this->Contents,true);
				$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('project_urls.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			}
	}
	
	function gradewise_result()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		$this->Contents				=	array();
		$fest['ALL']='All Festival';
		$this->Contents['fest']		=	$fest;
		$this->template->write_view('content', 'report/publishresult/gradewiseresult', $this->Contents);
		$this->template->load();
	}
	function grade_report()
	{
		 $this->Contents     		  =	 	 array();
		 $festId    				  =		$this->input->post('cmbFestType');
		 $item                        =     $this->input->post('cbo_item');
		 $grade 	    	 		  =		$this->input->post('grade');
		 $gradewise           		  =  	$this->resultindex_model->gradewiseparticip_report($festId,$item,$grade); 
		 $this->Contents['gradewise']  =   $gradewise ;
		 $this->Contents['grade']      =  $grade ; 
		// print_r($gradewise);
	 		if(count($gradewise)>0){
			$content   =   $this->load->view('report/publishresult/gradewise_report',$this->Contents,true);
			$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('project_urls.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			}
	}
	
	function allfestschools()
	{
		//$festid=$this->input->post('hidfestId');
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->allfestschoolpoints();
		//print_r($details);
	
		$this->Contents['details']   =  $details;
		$this->load->view('report/publishresult/schoolpoints', $this->Contents);
	
	}
	
	function report_press_timewise()
	{
			$this->Contents=array();
			$this->template->write('title', '');
			//$this->Contents['retdat']= $this->prereport_model->list_school_details();
			//$sub_dist_array					=	$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('rev_district_code' => $this->session->userdata('DISTRICT')),'','sub_district_code');
			//$this->Contents['sub_dist_array']		=	$sub_dist_array;
			//$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$this->Contents['date_array']		=	$this->General_Model->get_result_date_array();
			//$this->Contents['date_array']		=	$this->General_Model->get_result_time_array();
			//echo "<br /><br />array----".var_dump($this->Contents['date_array']);
			$this->template->write_view('content', 'report/publishresult/timewise_report_index', $this->Contents);
			$this->template->write_view('content', 'report/publishresult/numwise_timereport_index', $this->Contents);
			
			$this->template->load();
	
	
	}
	
}

?>