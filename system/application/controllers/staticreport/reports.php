<?php
class Reports extends Controller {

	function Reports()
	{
		parent::Controller();
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
		$this->load->model('staticreport/participants_with_more_items_model');
		$this->load->model('staticreport/tabulation_model');
		
	}
	function get_report()
		{
		 $this->Contents=array();
		
		 $this->Contents['retdata']= $this->participants_with_more_items_model->participant_details();
		 $content=$this->load->view('staticreport/rpt_list_participants_with_more_no_items',$this->Contents,true);
	    $this->template->write_view('content', 'staticreport/rpt_list_participants_with_more_no_items', $this->Contents);
		$this->template->load();
	     $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		 $html2pdf->pdf->SetDisplayMode('fullpage');
		 $html2pdf->WriteHTML($content,'');
		 $html2pdf->Output('project_urls.pdf', 'I');
	
	   }

	

		function index()
		{
		
		
	}
	    function rpt_tabulation_sheet()
		{
		
		$this->load->model('staticreport/Tabulation_model');
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('cbo_item');
	  	$festival						=	$this->input->post('cmbFestType');
		$this->Contents['retdata']= $this->Tabulation_model->tabulation_details($itemcode);
		$this->Contents['retdata1']= $this->Tabulation_model->tabulation_fest_details($festival);
				$this->template->write_view('content', 'staticreport/rpt_tabulation_sheet', $this->Contents);
		//$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($itemcode);
		$content	=	$this->load->view('staticreport/rpt_tabulation_sheet',$this->Contents,true);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
		$this->template->load();
	    
	}
	function tabulation_report_interface()
	{
	  $this->load->model('staticreport/tabulation_model');
	 
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','staticreport/tabulation_report_interface',$this->Contents);
	  $this->template->load();
	 // $itemcode						=	$this->input->post('cbo_item');
	  //$this->Tabulation_model->tabulation_details($itemcode);
	}
}	


/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>