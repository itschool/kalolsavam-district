<?php
class Registration_Report extends Controller {

	function Registration_Report()
	{
		parent::Controller();
		$this->Session_Model->is_user_logged(true);
		$this->load->library('HTML2PDF');
		
	}
	
	function index()
	{
		if(!($this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(18) ||  $this->Session_Model->check_user_permission(25))){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content = array();
		
		$this->load->model('schools/registration_report_model');
		
		$this->registration_report_model->set_school_details_take_report($this->input->post('hidSchoolId'));
		
		$school_details			=	$this->registration_report_model->get_school_details($this->input->post('hidSchoolId'));
		$participant_details	=	$this->registration_report_model->get_participant_details($this->input->post('hidSchoolId'));
		$fees_details			=	$this->registration_report_model->get_fees_details($this->input->post('hidSchoolId'));
		
		//print_r($fees_details);
		$this->Content['school_details']		=	$school_details;
		$this->Content['participant_details']	=	$participant_details;
		$this->Content['fees_details']			=	$fees_details;
		
		$content	=	$this->load->view('schools/registration_report',$this->Content,true);
		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('report.pdf', 'I');
	}
	function pdf_report()
	{
		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */