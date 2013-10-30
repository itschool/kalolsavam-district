<?php
class Masterreport extends Controller {

	function Masterreport()
	{
		parent::Controller();
		$this->load->model('Session_Model');
		//$this->load->model('General_Model');
		$this->Session_Model->is_user_logged(true);
		$this->load->model('staticreport/stage_report_model');
		$this->load->model('report/Masterreport_Model');
		$this->load->library('HTML2PDF');
		$this->template->write_view('menu', 'menu', '');
		//$this->template->write_view('left_panel', 'menu_left', '');
	}
	
	function item_code()
	{
		$this->Contents	= array();
		$this->Contents['retdat']= $this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
		$this->template->write_view('content', 'report/masterreport/itemcode', $this->Contents);
		
		$fest_id		=	$this->input->post('txtfestFrom');
		if ($fest_id)
		{
			$this->Contents	= array();
			$this->Contents['fest_details']		=	$this->General_Model->get_data('festival_master','fest_name',array('fest_id' => $fest_id));
			$this->Contents['item_details']		=	$this->Masterreport_Model->get_item_details($fest_id);
			$this->template->write_view('content', 'report/masterreport/itemcoderpt', $this->Contents);
		}
		
		$this->template->load();
	}
	function item_code_pdf()
	{
		$this->Contents	= array();
		$this->Contents['retdat']= $this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
		if (!$this->input->post('txtfestFrom'))
		{
			$this->template->write_view('content', 'report/masterreport/itemcode', $this->Contents);
			$this->template->load();
		}
		else
		{
			$fest_id		=	$this->input->post('txtfestFrom');
			$fest_id		=	'';
			if ($this->input->post('txtfestFrom'))
			{
				$this->Contents	= array();
				$this->Contents['fest_details']		=	$this->General_Model->get_data('festival_master','fest_name',array('fest_id' => $fest_id));
				$this->Contents['item_details']		=	$this->Masterreport_Model->get_item_details($fest_id);
				//$this->template->write_view('content', 'report/masterreport/itemcoderpt', $this->Contents);
				$content = $this->load->view('report/masterreport/itemcodepdf', $this->Contents,true);
			}
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Datewiseparticipant.pdf', 'I');
		}
		//$this->template->load();
	}
	
}
?>