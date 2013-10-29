<?php
class Onstagereport1 extends Controller {

	function Onstagereport1()
	{
		parent::Controller();
		$this->template->add_js('js/popcalendar.js');
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
		$this->load->model('staticreport/stage_report_model');
		$this->load->model('staticreport/itemreports_model');
		$this->template->add_css('style/calendar.css');	
		$this->template->add_js('js/stages.js');
	}
	

		function index()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$this->Contents['retdat']= $this->itemreports_model->timesheet();
		$this->template->write_view('content', 'staticreport/rpt_timesheet', $this->Contents);
		$this->template->load();
		
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
	
	function rpt_timesheet()
	{
		$this->load->model('staticreport/Itemreports_Model');
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('cbo_item');
	  	$festival						=	$this->input->post('cmbFestType');
		$this->Contents['itemtime']= $this->Itemreports_Model->timesheet($itemcode);
		//$this->template->write_view('content', 'staticreport/rpt_itemwiseparticipants', $this->Contents);
		$this->Contents['festname']= $this->Itemreports_Model->Festname($festival);
		$content	=	$this->load->view('staticreport/rpt_timesheet',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		//$this->template->load();
	}
	
	function timesheetinterface()//ratheesh
	{
	  $this->load->model('staticreport/Itemreports_Model');
	 
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','staticreport/timesheetinterface',$this->Contents);
	  $this->template->load();	  
	}
	
	function rpt_datewiseparticipants()//ratheesh
		{
		$this->load->model('staticreport/Itemreports_Model');
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('cbo_item');
	  	$festival						=	$this->input->post('cmbFestType');
		$date							=	$this->input->post('txtDate');
		$this->Contents['date']			=	$date;
		$this->Contents['partdata']= $this->Itemreports_Model->datewise_participants($date);
		
		//$this->template->write_view('content', 'staticreport/rpt_itemwiseparticipants', $this->Contents);
		$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($itemcode);
		$content	=	$this->load->view('staticreport/rpt_datewiseparticipants',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		//$this->template->load();
	    
	}
	
	function datewiseparticipantsinterface()//ratheesh
	{
	  $this->load->model('staticreport/Itemreports_Model');
	 
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','staticreport/datewiseparticipantsinterface',$this->Contents);
	  $this->template->load();	  
	}
	//Stage Report Interface
	function stagereportinterface()//ratheesh
	{
	  $this->load->model('staticreport/Itemreports_Model');
	 
	  $stage						=	$this->General_Model->prepare_select_box_data('stage_master','stage_id,stage_name','','Select Stage');
	  $this->Contents				=	array();
	  $this->Contents['stage']		=	$stage;
	  $this->template->write_view('content','staticreport/stagereportinterface',$this->Contents);
	  $this->template->load();	  
	}
	//function to stage report
	
		function rpt_stagereport()//ratheesh
		{
		$this->load->model('staticreport/Itemreports_Model');
		$this->Contents=array();
		$this->template->write('title', '');
		$stageid						=	$this->input->post('cmbstage');	  	
		$date							=	$this->input->post('txtDate');
		$this->Contents['date']			=	$date;
		$this->Contents['stageid']		=	$stageid;
		$this->Contents['stagedata']	= 	$this->Itemreports_Model->datewise_stagereport($date);
		
		//$this->template->write_view('content', 'staticreport/rpt_itemwiseparticipants', $this->Contents);
		$this->Contents['stagename']	= 	$this->Itemreports_Model->Stagename($stageid);		
		$content	=	$this->load->view('staticreport/rpt_stagereport',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
	    
	 }
}
?>