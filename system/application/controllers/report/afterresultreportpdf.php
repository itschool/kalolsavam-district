<?php
class Afterresultreportpdf extends Controller {

		function Afterresultreportpdf()
		{
			parent::Controller();
			$this->template->add_js('js/report/staticreport.js');	
			$this->template->add_js('js/report/reportjs.js');	
			$this->load->library('HTML2PDF');
			$this->load->model('report/afterresult_model');
			$this->template->write_view('menu', 'menu', '');
		}
		
		function school_wise_result()
		{
			$this->load->model('report/afterresult_model');
		  $this->Contents=array();
		  $this->template->write('title', '');
			  	$school						=	$this->input->post('txtSchoolCode');
				if($school){
				$this->Contents['retvalue']= $this->afterresult_model->school_wise_result($school);
				$this->template->write_view('content', 'result/afterresult_report/rpt_school_wise_point', $this->Contents);
				$content	=	$this->load->view('result/afterresult_report/rpt_school_wise_point',$this->Contents,true);
				//print_r($retvalue);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		        $html2pdf->pdf->SetDisplayMode('fullpage');
		        $html2pdf->WriteHTML($content, '');
		        $html2pdf->Output('school_wise_result.pdf', 'I');
		        $this->template->load();
				}
				else{
				redirect('test/nodata');
				
				}
				
		}
		function school_wise_result_all()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			
			$this->Contents['retvalue']= $this->afterresult_model->school_wise_result_all();
			$this->Contents['itemcomp']= $this->afterresult_model->itemcomplete_schoolpoint();
			$this->Contents['grade']   = $this->afterresult_model->school_wise_gradedetails();
			$this->Contents['completed']   = $this->afterresult_model->count_of_items();
			
			$this->Contents['totalitems']   = $this->afterresult_model->count_of_items_total();
			if(count($this->Contents['retvalue'])>0)
			{
			
			$content	=	$this->load->view('result/afterresult_report/rpt_all_school_point',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('allschoolwisepoint.pdf', 'I');
			}
			else
			{
				redirect('test/nodata');
				
				}
		}
		
		
		
		
		function status_of_kalolsvam()
		{
			$this->load->model('report/timefest_model');
			
			$this->Contents=array();
			$this->template->write('title', '');
			$itemcode						=	$this->input->post('cbo_item');
			$festival						=	$this->input->post('cmbFestType');
			$date							=	$this->input->post('txtDate');
			//echo $itemcode;
			
			
			
				
					
			$this->Contents['itemcode']		=	$itemcode;
			$festname= $this->timefest_model->fetch_festname($festival);
			$retdat= $this->timefest_model->timeoffest_result($itemcode);
		
			$participated= $this->timefest_model->timeoffest_count($itemcode);
			
			if(count($retdat)>0)
			{
			$this->Contents['festname']=$festname;
			$this->Contents['retdat']=$retdat;
			$this->Contents['participated']=$participated;		
			$content	=	$this->load->view('report/timeof_fest_reportpdf/timeoffest_result',$this->Contents,true);
		
			//print_r($retdat);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('status_of_kalolsvam.pdf', 'I');
			}
			 else
			 {
			
			 redirect('test/nodata');
			 
			 }
			 
		   
		
		}
	
	
			
		function datewisepart()
		{
			$this->load->model('report/timefest_model');
			
			$this->Contents=array();
			$this->template->write('title', '');
			$itemcode						=	$this->input->post('cbo_item');
			$festival						=	$this->input->post('cmbFestType');
			$date							=	$this->input->post('txtDate');
		/*	     
				if($itemcode=='ALL'){
					   $fest_all_rest= $this->timefest_model->fetch_fest_all_result($festival);
			
			
							if(count($fest_all_rest)>0)
							{ 
						 $this->Contents['fest_all_rest']=$fest_all_rest;		
						 content	=	$this->load->view('report/timeof_fest_reportpdf/timeoffest_result',$this->Contents,true);
						 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
						 $html2pdf->pdf->SetDisplayMode('fullpage');
						 $html2pdf->WriteHTML($content, '');
						 $html2pdf->Output('project_urls.pdf', 'I');
							}
						  else
						  {
			
							   redirect('test/nodata');
			 
						   }
			
			
			
			
						  }
			
		*/		//echo $festival.'</br>'.$itemcode;
				//echo $itemcode;	
					
			
			$festname= $this->timefest_model->fetch_festname($festival);
			$retdat= $this->timefest_model->timeoffest_result($itemcode);
			$participated= $this->timefest_model->timeoffest_count($itemcode);
			
		   
			if(count($retdat)>0)
			{ 
			$this->Contents['itemcode']		=	$itemcode;
			$this->Contents['festname']=$festname;
			$this->Contents['retdat']=$retdat;
			$this->Contents['participated']=$participated;		
			$content	=	$this->load->view('report/timeof_fest_reportpdf/timeoffest_result',$this->Contents,true);
		
			//
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('datewiseparticipant.pdf', 'I');
			}
			 else
			 {
			
			 redirect('test/nodata');
			 
			 }
			 
		   
		
		}    
	
	    function status_of_kalolsavam1()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			$fest						=	$this->input->post('cmbFestType');
			$festdate					=	$this->input->post('festdate');
			$this->Contents['retvalue']= $this->afterresult_model->status_of_kalolsavam($fest,$festdate);
			$this->Contents['retvalue1']= $this->afterresult_model->status_of_kalolsavam1($fest,$festdate);
			$this->Contents['ddt']		= $festdate;
			
			if($fest!='All')
			{
			$this->template->write_view('content', 'result/afterresult_report/rpt_status_of_kalolsavam', $this->Contents);
			$content	=	$this->load->view('result/afterresult_report/rpt_status_of_kalolsavam',$this->Contents,true);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('status_of_kalolsavam.pdf', 'I');
			}
			else
			{
			$this->template->write_view('content', 'result/afterresult_report/rpt_status_of_kalolsavam1', $this->Contents);
			$content	=	$this->load->view('result/afterresult_report/rpt_status_of_kalolsavam1',$this->Contents,true);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('status_of_kalolsavam.pdf', 'I');
			}
		}
		
		function total_points()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			
			$this->Contents['retvalue']= $this->afterresult_model->total_points();
			if(count($this->Contents['retvalue'])>0)
			{
			$content	=	$this->load->view('result/afterresult_report/rpt_total_points',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('total_points.pdf', 'I');
			}
			else
			{	
			 redirect('test/nodata');
			 
			 }
		}
		function report_press()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			
			$this->Contents['retvalue']= $this->afterresult_model->report_press();
			if(count($this->Contents['retvalue'])>0)
			{
			$content	=	$this->load->view('result/afterresult_report/rpt_report_press',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('report_press.pdf', 'I');
			}
			else
			{	
			 redirect('test/nodata');
			 
			 }
		}
		
		function allschool_points_result()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			
			$retvalue= $this->afterresult_model->all_school_wise_result();
			$this->Contents['retvalue']=$retvalue;
			if(count($retvalue)>0){
			//	$this->template->write_view('content', 'result/afterresult_report/rpt_school_wise_point', $this->Contents);
			$content	=	$this->load->view('result/afterresult_report/rpt_school_wise_point_all',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Allschool_points_result.pdf', 'I');
			}
			
			
		}
		
		function higherlevel_result()
		{
			if($this->Session_Model->check_user_permission(8)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$fest=$this->input->post('cmbFestType');
			$item=$this->input->post('cbo_item');
			$retvalue  =$this->afterresult_model->higherlevel_result($fest,$item);
			
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/higherlevel_pdf',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Higherlevel_result.pdf', 'I');
			}
			else {
				redirect('test/nodata');			
			}
		
		}
		function higherlevel_result_subdistrict()
		{
		
			$this->Contents=array();
			$Sub_dist=$this->input->post('cboSubDistCode');
			$retvalue  =$this->afterresult_model->higherlevel_result_subdistrict($Sub_dist);
			
			if(count($retvalue)>0){
			  
			   if($Sub_dist!='All')
			     {
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/higherlevel_subdistrict_pdf',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Higherlevel_result.pdf', 'I');
			}
			   else
			   {
			   $this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/higherlevel_subdistrict_pdf_all',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Higherlevel_result.pdf', 'I');
			   }
			   
			}
			else {
				redirect('test/nodata');			
			}
		
		}
		function consolidated_resultall()
		{
			$this->Contents=array();
			$retvalue  =$this->afterresult_model->consolidated_resultall();
			$retdata  =$this->afterresult_model->consolidated_result_boys();
			$retval  =$this->afterresult_model->consolidated_total();
			$retgirls  =$this->afterresult_model->consolidated_result_girls();
			$retboys_total  =$this->afterresult_model->consolidated_boys_total();
			$retgirls_total =$this->afterresult_model->consolidated_girls_total();
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			$this->Contents['retdata']=$retdata;
			$this->Contents['retval']=$retval;
			$this->Contents['retgirls']=$retgirls;
			$this->Contents['retboys_total']=$retboys_total;
			$this->Contents['retgirls_total']=$retgirls_total;
			
			$content	=	$this->load->view('result/afterresult_report/consolidated_resultall',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('consolidated_resultall.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			
			}
		}
		
	  function schoolhigher_result()
	  {
			$this->Contents=array();
			$school_code=$this->input->post('txtSchoolCode');
			
			$retvalue  =$this->afterresult_model->schoolhigher_result($school_code);
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/schoolhigher_result',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Schoolhigher_result.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			
			}
	  }
	  
	    function schoolhigher_resultall()
		{
			$this->Contents=array();
			$retvalue  =$this->afterresult_model->schoolhigher_resultall();
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/schoolhigher_result',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Schoolhigher_resultall.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			
			}
		}
		
	function subdistrict_wise_result_all()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			
			$this->Contents['retvalue']= $this->afterresult_model->subdistrict_wise_result();
			$this->Contents['itemcomp']= $this->afterresult_model->itemcomplete_schoolpoint();
			$this->Contents['grade']   = $this->afterresult_model->subdistrict_gradedetails();
			$this->Contents['completed']   = $this->afterresult_model->sub_count_of_items();
			
			$this->Contents['totalitems']   = $this->afterresult_model->sub_count_of_items_total();
			if(count($this->Contents['retvalue'])>0)
			{
			
			$content	=	$this->load->view('result/afterresult_report/rpt_all_subdistrict_point',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('allsubdistrict_wisepoint.pdf', 'I');
			}
			else
			{
				redirect('test/nodata');
				
				}
		}
	function subdistrict_wise_result()
	{
	$this->Contents=array();
			$sub_code=$this->input->post('cboSubDistCode');
			
			$retvalue  =$this->afterresult_model->subdistrict_wise_result_itemwise($sub_code);
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/subdistrict_wise_result',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Subdist_point.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			
			}
	   
	}
	function topscorer()
		{
		$this->Contents=array();
			$retvalue  =$this->afterresult_model->topscorer();
			
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/topscorer',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Topscorer.pdf', 'I');
		}
		
 function item_code_reports()
		{
		 $this->load->model('report/resultindex_model');
		 $this->Contents     		  =	 	 array();
		 //$festId    				  =		$this->input->post('cmbFestType');
		 $item    				      =		$this->input->post('item');
		 //$rank   	    	 		  =		$this->input->post('rank');
		 //$date   	    	 		  =		$this->input->post('txtDate');
		 $rankwise           		  =  	$this->resultindex_model->itemcode_report($item); 
		 $this->Contents['rankwise']  =  $rankwise;
		// $this->Contents['rank']      =  $rank ; 
		 
			if(count($rankwise)>0){
				$content   =   $this->load->view('report/publishresult/itemcode_report',$this->Contents,true);
				$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('project_urls.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			}
		}
		
		
		 
   function time_wise_result_report()
   {
   		$this->load->model('report/resultindex_model');
   		$this->Contents     		  =	  array();		 		
		$timewise           		  =  $this->resultindex_model->timewise_result_report(); 
		$this->Contents['timewise']  =  $timewise;
		//echo "<br /><br /><br />---->".var_dump($this->Contents['timewise']);	 
		if($timewise['parti_count']>0){
				$content   =   $this->load->view('report/timeof_fest_reportpdf/timewise_result',$this->Contents,true);
				$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('time_wise_report.pdf', 'I');
			}
		else{
				redirect('test/nodata');
			}   
   }
   
   function numwise_timeresult_report()
   {
   		$this->load->model('report/resultindex_model');
   		$this->Contents     	  =	  array();		 		
		$numwise           		  =  $this->resultindex_model->numwise_timeresult_report(); 
		$this->Contents['result_numwise']  =  $numwise;
		//echo "<br /><br /><br />---->".var_dump($numwise);	 
		if(count($numwise[0])>0){
				$content   =   $this->load->view('report/timeof_fest_reportpdf/result_numwise_report',$this->Contents,true);
				$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('time_wise_report.pdf', 'I');
			}
		else{
				redirect('test/nodata');
			}   
   
   
   }
   
		
}
?>