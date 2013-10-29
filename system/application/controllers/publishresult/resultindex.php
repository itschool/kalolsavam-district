<?php
class Resultindex extends Controller{

	function Resultindex()
	{
		parent::Controller();
		//$this->Session_Model->is_user_logged(true);
		if($this->Session_Model->check_user_permission(45)==true){
			$this->template->write_view('menu', 'menu', '');
		}else{
			$this->template->write_view('header', 'header', '');
		}		
		$this->template->add_js('js/stages.js');	
		$this->load->model('publishresult/resultindex_model');
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
		$this->load->model('photos/Photos_Model');
	}
	function resultview()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->get_data('festival_master','fest_id,fest_name','','fest_id');
		$this->Contents['fest']         =    $fest;
		$this->template->write_view('content', 'report/publishresult/resultview', $this->Contents);
		$this->template->load();
		
	}
	function result_declared()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$fesid           = 	$this->input->post('hidfestId');
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->result_rank($fesid);
	//	print_r($details);
	
		$this->Contents['details']   =  $details;
		$this->Contents['Photo']	 =	$this->Photos_Model->get_rank_Photo($this->Contents);
		$this->load->view('report/publishresult/result_declared', $this->Contents);
		
	}
	function schoolpoints()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$festid=$this->input->post('hidfestId');
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->schoolpoints($festid);
		//print_r($details);
	
		$this->Contents['details']   =  $details;
		$this->load->view('report/publishresult/schoolpoints', $this->Contents);
	}
	function subdistrictpoints()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$festid=$this->input->post('hidfestId');
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->subdistpoints($festid);
		//print_r($details);
	
		$this->Contents['details']   =  $details;
		$this->load->view('report/publishresult/subdistpoints', $this->Contents);
	}
    function allresults()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->allresults();
	//print_r($details);
		
		$this->Contents['details']   =  $details;
		$this->Contents['Photo']	 =	$this->Photos_Model->get_rank_Photo($this->Contents);		
		$this->load->view('report/publishresult/allresults', $this->Contents);
		
	}
	
	function festval_status()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details1         = 	$this->resultindex_model->festval_status1();
		$details2         = 	$this->resultindex_model->festival_status2();
		//print_r($details);
		$this->Contents['details1']   =  $details1;
		$this->Contents['details2']   =  $details2;
		$this->template->write_view('content', 'report/publishresult/festival_status', $this->Contents);
		$this->template->load();
	}
	
	function festival_allitem()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$totitem         = 	$this->resultindex_model->festval_allitems($fest);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('report/publishresult/festival_allitem', $this->Contents);
	}
	function finished_item()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$totitem         = 	$this->resultindex_model->finished_allitems($fest);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('report/publishresult/finished_allitem', $this->Contents);
	}
	function incomplete_item()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$totitem         = 	$this->resultindex_model->incomplete_allitems($fest);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('report/publishresult/incomplete_item', $this->Contents);
	}
	function gradewise_interface()
	{
		/*if($this->Session_Model->check_user_permission(44)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents=array();
		$this->template->write('title', '');
		$this->template->write_view('content', 'report/publishresult/gradewise', $this->Contents);
		$this->template->load();
	}
	function gradewise_report()
	{
		/*if($this->Session_Model->check_user_permission(44)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
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
			redirect('report/publishresult/Resultindex/gradewise_interface');
			
			}
			
	}
	function itemwise_result()
	{
		/*if($this->Session_Model->check_user_permission(44)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
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
		/*if($this->Session_Model->check_user_permission(44)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
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
		/*if($this->Session_Model->check_user_permission(44)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		$this->Contents				=	array();
		$this->Contents['fest']		=	$fest;
		$this->template->write_view('content', 'report/publishresult/rankwise', $this->Contents);
		$this->template->load();
	}
	
	function rankwise_report()
	{
		 /*if($this->Session_Model->check_user_permission(44)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		 $this->Contents     		  =	 	 array();
		 $festId    				  =		$this->input->post('cmbFestType');
		 $rank   	    	 		  =		$this->input->post('rank');
		 $rankwise           		  =  	$this->resultindex_model->rankwise_report($festId,$rank); 
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
			redirect('report/publishresult/Resultindex/rankwise_result');
			}
	}
	
	function gradewise_result()
	{
		/*if($this->Session_Model->check_user_permission(44)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
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
		 /*if($this->Session_Model->check_user_permission(44)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		 $this->Contents     		  =	 	 array();
		 $festId    				  =		$this->input->post('cmbFestType');
		 $grade 	    	 		  =		$this->input->post('grade');
		 $gradewise           		  =  	$this->resultindex_model->gradewiseparticip_report($festId,$grade); 
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
			redirect('report/publishresult/Resultindex/gradewise_result');
			}
	}
	
	function allfestschools()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		//$festid=$this->input->post('hidfestId');
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->allfestschoolpoints();
		//print_r($details);
	
		$this->Contents['details']   =  $details;
		$this->load->view('report/publishresult/schoolpoints', $this->Contents);
	
	}
	
	function allfestsubdistrict()
	{
		/*if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		//$festid=$this->input->post('hidfestId');
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$details         = 	$this->resultindex_model->allfestsubdistpoints();
		//print_r($details);
	
		$this->Contents['details']   =  $details;
		$this->load->view('report/publishresult/subdistpoints', $this->Contents);
	
	}
	
	
	
}

?>