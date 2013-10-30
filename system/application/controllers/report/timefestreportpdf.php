<?php
class Timefestreportpdf extends Controller {

		function Timefestreportpdf()
		{
		parent::Controller();
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
		$this->load->model('report/prereport_model');
		$this->load->model('report/timefest_model');
		
		}
		
	function datewisepart()
	{
	    $this->load->model('report/timefest_model');
		
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('cbo_item');
	  	$festival						=	$this->input->post('cmbFestType');
		$date							=	$this->input->post('txtDate');
	    $festname= $this->timefest_model->fetch_festname($festival);
		$retdat= $this->timefest_model->timeoffest_result($itemcode);
		$absentee= $this->timefest_model->timeoffest_result_absentee($itemcode);
	    $participated= $this->timefest_model->timeoffest_count($itemcode);
	    
	                   if($itemcode=='ALL'){
					              $absenteeall= $this->timefest_model->timeoffest_result_absentee_all($festival);
					             $festresult= $this->timefest_model->fetch_fest_all_result($festival);
					            // $festcount= $this->timefest_model->fetch_fest_all_result_count($festival);  
					                  
									  
									  if(count($festresult)>0){
								  	  $this->Contents['festresult']		=	$festresult;						                                      $this->Contents['absenteeall']	=	$absenteeall;
								      $content	=	$this->load->view('report/timeof_fest_reportpdf/timefestall',$this->Contents,true);                                $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		                              $html2pdf->pdf->SetDisplayMode('fullpage');
		                              $html2pdf->WriteHTML($content, '');
		                              $html2pdf->Output('Datewiseparticipant.pdf', 'I');
										
										 }
					   
					                }
					   
		if(count($retdat)>0)
		{
		$this->Contents['absentee']     =$absentee;		
		$this->Contents['judjes_count']	= $retdat[0]['no_of_judges'];
		$this->Contents['itemcode']		=	$itemcode;
		$this->Contents['festname']     =$festname;
		$this->Contents['retdat']       =$retdat;
		$this->Contents['participated']=$participated;		
       	$content	=	$this->load->view('report/timeof_fest_reportpdf/timeoffest_result',$this->Contents,true);
	
		//
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Datewiseparticipant.pdf', 'I');
	    }
	     else
		 {
		
		 	redirect('test/nodata');
		 
		 }
		 
	   
	
	}



function common_report()
	{
	    $this->load->model('report/timefest_model');
		
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('hiditemcode');
	  	$festival						=	$this->input->post('hidFestcode');
		$date							=	$this->input->post('txtDate');
	    $festname= $this->timefest_model->fetch_festname($festival);
		$retdat= $this->timefest_model->timeoffest_result($itemcode);
	    $participated= $this->timefest_model->timeoffest_count($itemcode);
	    $absentee= $this->timefest_model->timeoffest_result_absentee($itemcode);
	   
		 
		               if($itemcode=='ALL'){
					             $absenteeall= $this->timefest_model->timeoffest_result_absentee_all($festival);
					             $festresult= $this->timefest_model->fetch_fest_all_result($festival);
					            // $festcount= $this->timefest_model->fetch_fest_all_result_count($festival);  
					                  
									  
									  
									  
									  if(count($festresult)>0){
								  	  $this->Contents['festresult']		=	$festresult;
									    $this->Contents['absenteeall']	=	$absenteeall;						  
								      $content	=	$this->load->view('report/timeof_fest_reportpdf/timefestall',$this->Contents,true);                                $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		                              $html2pdf->pdf->SetDisplayMode('fullpage');
		                              $html2pdf->WriteHTML($content, '');
		                              $html2pdf->Output('Common_report.pdf', 'I');
										
										 }
					   
					                }
					   
		if(count($retdat)>0)
		{
		$this->Contents['judjes_count']	= $retdat[0]['no_of_judges'];
		$this->Contents['itemcode']		=$itemcode;
		$this->Contents['festname']     =$festname;
		$this->Contents['retdat']       =$retdat;
		$this->Contents['participated'] =$participated;
		$this->Contents['absentee']     =$absentee;		
       	$content	=	$this->load->view('report/timeof_fest_reportpdf/timeoffest_result',$this->Contents,true);
	
		//
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Common_report.pdf', 'I');
	    }
	     else
		 {
		
		 	redirect('test/nodata');
		 
		 }
		 
	   
	
	}





	
	function confidential()
	{
	    $this->load->model('report/timefest_model');
		
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('hiditemcode');
	  	$festival						=	$this->input->post('hidFestcode');
		$date							=	$this->input->post('txtDate');
	    $festname= $this->timefest_model->fetch_festname($festival);
		$retdat= $this->timefest_model->timeoffest_result($itemcode);
	    $participated= $this->timefest_model->timeoffest_count($itemcode);
	    $absentee_list= $this->timefest_model->timeoffest_result_absentee($itemcode);
	    // print_r($absentee_list);
		 $absentee	= explode(',', $absentee_list);
		 
		 
		 //print_r($absentee);
		 
		               if($itemcode=='ALL'){
					             $absenteeall= $this->timefest_model->timeoffest_result_absentee_all($festival);
					             $festresult= $this->timefest_model->fetch_fest_all_result($festival);
					            // $festcount= $this->timefest_model->fetch_fest_all_result_count($festival);  
					                  
									  
									  
									  
									  if(count($festresult)>0){
								  	  $this->Contents['festresult']		=	$festresult;
									    $this->Contents['absenteeall']	=	$absenteeall;						  
								      $content	=	$this->load->view('report/timeof_fest_reportpdf/timefest_result_confidential_all',$this->Contents,true);                                $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		                              $html2pdf->pdf->SetDisplayMode('fullpage');
		                              $html2pdf->WriteHTML($content, '');
		                              $html2pdf->Output('Confidential_Report_All.pdf', 'I');
										
										 }
					   
					                }
					   
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
	     else
		 {
		
		 	redirect('test/nodata');
		 
		 }
		 
	   
	
	}
	
	function confidential1()
	{
	    $this->load->model('report/timefest_model');
		
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('txtItemCode');
	  	$festival						=	$this->input->post('hidFestcode');
		$date							=	$this->input->post('txtDate');
	    $festname= $this->timefest_model->fetch_festname($festival);
		$retdat= $this->timefest_model->timeoffest_result($itemcode);
	    $participated= $this->timefest_model->timeoffest_count($itemcode);
	    $absentee_list= $this->timefest_model->timeoffest_result_absentee($itemcode);
	    // print_r($absentee_list);
		 $absentee	= explode(',', $absentee_list);
		 
		 
		 //print_r($absentee);
		 
		               if($itemcode=='ALL'){
					             $absenteeall= $this->timefest_model->timeoffest_result_absentee_all($festival);
					             $festresult= $this->timefest_model->fetch_fest_all_result($festival);
					            // $festcount= $this->timefest_model->fetch_fest_all_result_count($festival);  
					                  
									  
									  
									  
									  if(count($festresult)>0){
								  	  $this->Contents['festresult']		=	$festresult;
									    $this->Contents['absenteeall']	=	$absenteeall;						  
								      $content	=	$this->load->view('report/timeof_fest_reportpdf/timefest_result_confidential_all',$this->Contents,true);                                $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		                              $html2pdf->pdf->SetDisplayMode('fullpage');
		                              $html2pdf->WriteHTML($content, '');
		                              $html2pdf->Output('Confidential_Report_All.pdf', 'I');
										
										 }
					   
					                }
					   
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
	     else
		 {
		
		 	redirect('test/nodata');
		 
		 }
		 
	   
	
	}

	}
 ?>