<?php
class Onstagereport extends Controller {

	function Onstagereport()
	{
		parent::Controller();
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
		$this->load->model('staticreport/stage_report_model');
		$this->load->model('staticreport/itemreports_model');
	}
	

		function index()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$this->Contents['retdat']= $this->stage_report_model->festval_details();
		$this->template->write_view('content', 'staticreport/school_partipt', $this->Contents);
		$this->template->load();
		
	}
	
		function rpt_participatingschools()
	{
		 $this->Content = array();
		 $this->load->model('staticreport/stage_report_model');
		 $school_fest			=	$this->stage_report_model->participate_school_details();
		 $part_details			=	$this->stage_report_model->participate_item_details($this->input->post('txtfestFrom'));
		 $festdetails           =   $this->stage_report_model->itempart_details();
		//print_r($part_details);
		 $this->Content['school_fest']		= 	$school_fest;
		 $this->Content['festtype']	 		=   $part_details;	
		 $this->Content['festmaster']	 	=   $festdetails;	
		 $this->Content['fest']             =   $this->input->post('txtfestFrom');
		 //$final_out             =$this->stage_report_model->final_fetdata($this->Content);
		 $content	=	$this->load->view('staticreport/rpt_participatingschools',$this->Content,true);
		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
	}
	
	function rpt_schoolsdetailsall()
	{
		$this->Contents                     =    array();
		$this->Contents['school_details']   =    $this->stage_report_model->schoolalldetails();
		$content=$this->load->view('staticreport/schoolfestall',$this->Contents,true);
		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
	//print_r($this->Contents['school_details'])
	}
	
	function list_participants()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$this->Contents['retdat']= $this->stage_report_model->list_school_details();
		$this->template->write_view('content', 'staticreport/school_details_part', $this->Contents);
		$this->template->load();
	}
	function get_school_details_single()
	{
		$this->Contents=array();
		$this->Contents['retdat']= $this->stage_report_model->get_school_single();
		if ((int)@$retdat[0]['school_code'] > 0)
		{
			$this->Content['flag']	=	1;
		}
		else
		{
			$this->Content['flag']	=	0;
		}
		echo "ajith";
		$this->template->write_view('content', 'staticreport/school_details_part', $this->Content);
	}
	
	function list_participant_report()
	{
		 
		 $this->Contents=array();
		 $fest_id		=		$this->input->post('txtSchoolCode');
		 $where='school_code='.$fest_id;
		 $item_details	=		$this->General_Model->fetch_data('school_details',		'school_code',$where);
		if(count($item_details)>0)
		{
		 $school_det			=	$this->stage_report_model->get_school_single($this->input->post('txtSchoolCode'));
		 $part_details			=	$this->stage_report_model->part_item_details($this->input->post('txtSchoolCode'));
		 $this->Content['school_det']		= 	$school_det;
		 $this->Content['part_details']		= 	$part_details;	
		 
		 $content	=	             $this->load->view('staticreport/rpt_list_participants_team_manager',$this->Content,true);
		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		
		}
		else {
		redirect('staticreport/onstagereport/list_participants');
		}
	}
	
	function list_participant_allreport()
	{
		 
		 $this->Contents=array();
		 $part_details			=	$this->stage_report_model->part_item_details_allschool();
		 $this->Contents['part_details']		= 	$part_details;	
		 if(count($part_details)>0){
		 
		 $content	=	             $this->load->view('staticreport/rpt_list__team_manager_all',$this->Contents,true);
		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		
		}
		else {
		redirect('staticreport/onstagereport/list_participants');
		}
	}
	function feedetails()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$this->Contents['retdat']= $this->stage_report_model->list_school_details();
		$this->template->write_view('content', 'staticreport/feedetview', $this->Contents);
		$this->template->load();
	
	}
	function feedet_report()
	{
		$this->Content = array();
		$getschool=array();
		$getschool=$this->stage_report_model->get_fee_school_single($this->input->post('txtSchoolCode'));
		if(count($getschool)>0){
		$fees_details		            =	$this->stage_report_model->get_fees_details($this->input->post('txtSchoolCode'));
		$this->Content['fees_details']  =	$fees_details;
		//print_r($fees_details);
		
		if(($fees_details['up_fee']['afliation']!=0)&&($fees_details['hs_fee']['afliation']!=0))
		{
		 $content	                    =	             $this->load->view('staticreport/feedetailsview',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		}
		else {
		redirect('staticreport/onstagereport/feedetails');
		}
		}
		else {
		redirect('staticreport/onstagereport/feedetails');
		}

	}
	function all_feedet_report_all()
	{
		$this->Content = array();
		$fees_details		            =	$this->stage_report_model->get_fees_details_all();
		$this->Content['fees_details']  =	$fees_details;
		
		 $content	                    =	             $this->load->view('staticreport/feedetailsviewall',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		
	}
	function callsheet_first()
	{
		 $this->load->model('staticreport/Itemreports_Model');
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','staticreport/callinterface',$this->Contents);
	  $this->template->load();
	
	}
	function callsheet_report()
	{
		$this->Content = array();
		//echo $this->input->post('cbo_item');
		
		$fees_details		            =	$this->stage_report_model->get_callsheet_details($this->input->post('cbo_item'));
		$this->Content['fees_details']  =	$fees_details;
		//print_r($fees_details);
		if(count($fees_details)>0){
		
		 $content	                    =	             $this->load->view('staticreport/rpt_callsheet',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		} 
		else {
		redirect('staticreport/onstagereport/callsheet_first');
		}
	}
	
	function participant_cardindex()
	{
		
		$this->Contents=array();
		$this->template->write('title', '');
		$this->Contents['retdat']= $this->stage_report_model->list_school_details();
		$this->template->write_view('content', 'staticreport/parip_card', $this->Contents);
		$this->template->load();
	}
	function participant_card_report()
	{
	
	$this->Content = array();
	$fees_details		            =	$this->stage_report_model->get_participant_card($this->input->post('txtSchoolCode'));
		$this->Content['fees_details']  =	$fees_details;
		//print_r($fees_details);
		
		if(count($fees_details)>0){
		
		 $content	                    =	             $this->load->view('staticreport/rpt_participant_card',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		} 
		else {
		redirect('staticreport/onstagereport/participant_cardindex');
		}
		
	}
		
		function participant_more_item()
		{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
		//$this->Contents['retdat']= $this->stage_report_model->list_school_details();
		$this->template->write_view('content', 'staticreport/partc_more_item', $this->Contents);
		$this->template->load();
		}
		
		function more_part_list()
		{
		$this->Content = array();
	$fees_details		            =	$this->stage_report_model->list_participant_more($this->input->post('cmbFestType'));
		$this->Content['fees_details']  =	$fees_details;
		
		if(count($fees_details)>0){
		 $content	                    =	             $this->load->view('staticreport/more_participant_report',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		}
		else {
		redirect('staticreport/onstagereport/participant_more_item');
		}
		
		}
		
		function participant_limit_item_more()
		{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
		//$this->Contents['retdat']= $this->stage_report_model->list_school_details();
		$this->template->write_view('content', 'staticreport/participant_more_item', $this->Contents);
		$this->template->load();
		}
		
		function more_limit_partlist()
		{
		$this->Content = array();
		if(($this->input->post('cmbFestType')))
		{
	$fees_details		            =	$this->stage_report_model->list_more_limitpart($this->input->post('cmbFestType'),$this->input->post('txtLimitcode'));
		$this->Content['fees_details']  =	$fees_details;
	//	print_r($fees_details);

		if(count($fees_details)>0){
		 $content	                    =	             $this->load->view('staticreport/more_participant_report',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		}
		}
		else {
		redirect('staticreport/onstagereport/participant_limit_item_more');
		}
		}
		
		function eligible_school()
		{
		$this->Content = array();
		$school_details		            =	$this->stage_report_model->list_eligible_schools();
		$this->Content['school_details']  =	$school_details	;
		//print_r($school_details);

		if(count($school_details)>0){
		 $content	                    =	             $this->load->view('staticreport/list_eligible_school',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		}
		}
		
		function timesheet_report()
		{
	    $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	   $this->Contents				=	array();
	   $this->Contents['fest']		=	$fest;
	   $this->template->write_view('content','staticreport/timesheet',$this->Contents);
	   $this->template->load();
		}
		function timeshhet_re_det()
		{
		 $this->Contents				= array();
		 $this->Contents['retdata']                      = $this->stage_report_model->timesheet_details(($this->input->post('cmbFestType')),($this->input->post('cbo_item')));
				
		//print_r($retdata);
		//$content=$this->template->write_view('content','staticreport/timesheetreport',$this->Contents);
		
	  	 $content	                    =	             $this->load->view('staticreport/timesheetreport',$this->Contents,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		}
		
		function clustor_report()
		{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
		//$this->Contents['retdat']= $this->stage_report_model->list_school_details();
		$this->template->write_view('content', 'staticreport/cluster_report', $this->Contents);
		$this->template->load();
		}
		
		function clusterreport_report()
		{
		 $this->Contents				= array();
		  $retdata                = $this->stage_report_model->cluster_reportreport(($this->input->post('cmbFestType')),($this->input->post('cbo_item')));
		 $this->Contents['retdata']		=	$retdata;
		
		 if(count($retdata)>0){
	  	 $content	                    =	             $this->load->view('staticreport/clust_report',$this->Contents,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		
		}
		else {
		redirect('staticreport/onstagereport/clustor_report');
		}
		
		}
		
		function rpt_itemwiseparticipants()//ratheesh
		{
		$this->load->model('staticreport/Itemreports_Model');
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('cbo_item');
	  	$festival						=	$this->input->post('cmbFestType');
		$this->Contents['partdata']= $this->Itemreports_Model->itemwise_participants($itemcode);
		//$this->template->write_view('content', 'staticreport/rpt_itemwiseparticipants', $this->Contents);
		$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($itemcode);
		$content	=	$this->load->view('staticreport/rpt_itemwiseparticipants',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		//$this->template->load();
	    
	}
	
	function pdf_report()
	{
		$this->Content = array();
		$content	=	$this->load->view('',$this->Content,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
	}
	
	function itemwise_report_interface()//ratheesh
	{
	  //$this->load->model('staticreport/Itemreports_Model');
	 
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','staticreport/itemwise_report_interface',$this->Contents);
	  $this->template->load();
	  //$itemcode						=	$this->input->post('cbo_item');
	  //$this->Itemreports_Model->itemwise_participants($itemcode);
	}
	function clashes_details()
	{
	$this->load->model('staticreport/stage_report_model');
	$this->Contents=array();
		 $this->Contents['retdata'] = $this->stage_report_model->clash_info1();
		 $content=$this->load->view('staticreport/rpt_clashes_report',$this->Contents,true);
	   // $this->template->write_view('content', 'staticreport/rpt_clashes_report', $this->Contents);
		//$this->template->load();
	     
		
	  $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		 $html2pdf->pdf->SetDisplayMode('fullpage');
		 $html2pdf->WriteHTML($content,'');
		 $html2pdf->Output('project_urls.pdf', 'I');
	
	
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */