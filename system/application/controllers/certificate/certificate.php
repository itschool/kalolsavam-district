<?php
class Certificate extends Controller {

	function Certificate()
	{
		parent::Controller();
		$this->Session_Model->is_user_logged(true);
		$this->template->write_view('menu', 'menu', '');
		$this->load->model('certificate/Certificate_model');
		$this->load->model('photos/Photos_model');
		$this->template->add_js('js/certificate.js');
		$this->template->add_js('js/common.js');
		$this->Contents = array();
		//$this->template->write_view('left_panel', 'menu_left', '');
	}

	function index()
	{
		if($this->Session_Model->check_user_permission(47)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}


		$certificate_type_array	=	$this->General_Model->prepare_select_box_data('certificate_type','ct_id,type','','','ct_id');

		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');

		$font_array				=	$this->Certificate_model->get_font_array();
		$font_size_array		=	$this->Certificate_model->get_font_size_array();
		$line_height_array		=	$this->Certificate_model->get_line_height_array();

		$certificate_template	=	$this->Certificate_model->get_certificate_details($dist_code,$sub_dist_code);

		$this->Contents['certificate_type_array']	=	$certificate_type_array;
		$this->Contents['font_array']				=	$font_array;
		$this->Contents['font_size_array']			=	$font_size_array;
		$this->Contents['line_height_array']		=	$line_height_array;

		$this->Contents['certificate_template']		=	$certificate_template;
		$this->template->write_view('content', 'certificate/certificate_template', $this->Contents);
		$this->template->load();

	}

	function save_certificate_template()
	{
		if($this->Session_Model->check_user_permission(47)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		$this->Certificate_model->save_certificate_details($dist_code,$sub_dist_code);

		$this->index();
	}

	function test_certificate()
	{
		if($this->Session_Model->check_user_permission(47)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');

		$certificate_template	=	$this->Certificate_model->get_certificate_details($dist_code,$sub_dist_code);

		$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
		$line_height			=	($certificate_template[0]['line_height']) ? $certificate_template[0]['line_height'] : '1';
		$top_margin				=	($certificate_template[0]['top_margin']) ? $certificate_template[0]['top_margin'] : '1';
		$left_margin			=	($certificate_template[0]['left_margin']) ? $certificate_template[0]['left_margin'] : '1';
		$right_margin			=	($certificate_template[0]['right_margin']) ? $certificate_template[0]['right_margin'] : '1';

		$label_print			=	($certificate_template[0]['label_print']) ? $certificate_template[0]['label_print'] : 'N';

		$this->load->library('_fpdf/fpdf');

		$this->fpdf->Open();

		/*$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','B',14);
		$this->fpdf->SetY(30);
		$this->fpdf->Cell(40,10,'Hello World!');
		$this->fpdf->Output('certificate.pdf','D');*/
		$this->fpdf->FPDF($page_style,'mm','A4');

		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','B',14);

		$this->fpdf->SetMargins($left_margin,$top_margin,$right_margin);



		if ($certificate_template[0]['name_x'] and $certificate_template[0]['name_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['name_font'],'B',$certificate_template[0]['name_size']);
			$this->fpdf->SetXY($certificate_template[0]['name_x'],$certificate_template[0]['name_y']);
			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Name : '.'ANU KRISHNAN SYAM DASS SUNDAR DAS CHANDRAN');
			}
			else
			{
				$this->fpdf->Write($line_height,'ANU KRISHNAN SYAM DASS SUNDAR DAS CHANDRAN');
			}


		}
		if ($certificate_template[0]['item_x'] and $certificate_template[0]['item_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['item_font'],'B',$certificate_template[0]['item_size']);
			$this->fpdf->SetXY($certificate_template[0]['item_x'],$certificate_template[0]['item_y']);
			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Item : '.'Desabhakthiganam');
			}
			else
			{
				$this->fpdf->Write($line_height,'Desabhakthiganam');
			}

		}
		if ($certificate_template[0]['category_x'] and $certificate_template[0]['category_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['category_font'],'B',$certificate_template[0]['category_size']);
			$this->fpdf->SetXY($certificate_template[0]['category_x'],$certificate_template[0]['category_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Category : '.'UP General');
			}
			else
			{
				$this->fpdf->Write($line_height,'UP General');
			}
		}
		if ($certificate_template[0]['grade_x'] and $certificate_template[0]['grade_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['grade_font'],'B',$certificate_template[0]['grade_size']);
			$this->fpdf->SetXY($certificate_template[0]['grade_x'],$certificate_template[0]['grade_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Grade : '.'A');
			}
			else
			{
				$this->fpdf->Write($line_height,'A');
			}
		}
		if ($certificate_template[0]['class_x'] and $certificate_template[0]['class_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['class_font'],'B',$certificate_template[0]['class_size']);
			$this->fpdf->SetXY($certificate_template[0]['class_x'],$certificate_template[0]['class_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Class : '.'5');
			}
			else
			{
				$this->fpdf->Write($line_height,'5');
			}
		}
		if ($certificate_template[0]['school_x'] and $certificate_template[0]['school_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['school_font'],'B',$certificate_template[0]['school_size']);
			$this->fpdf->SetXY($certificate_template[0]['school_x'],$certificate_template[0]['school_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'School : '."St Xavier's Chevoor");
			}
			else
			{
				$this->fpdf->Write($line_height,"St Xavier's Chevoor");
			}
		}
		if ($certificate_template[0]['sub_dist_x'] and $certificate_template[0]['sub_dist_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['sub_dist_font'],'B',$certificate_template[0]['sub_dist_size']);
			$this->fpdf->SetXY($certificate_template[0]['sub_dist_x'],$certificate_template[0]['sub_dist_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Subdistrict : '.'Cherpu');
			}
			else
			{
				$this->fpdf->Write($line_height,'Cherpu');
			}
		}
		if ($certificate_template[0]['dist_x'] and $certificate_template[0]['dist_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['dist_font'],'B',$certificate_template[0]['dist_size']);
			$this->fpdf->SetXY($certificate_template[0]['dist_x'],$certificate_template[0]['dist_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'District : '.'Thrissur');
			}
			else
			{
				$this->fpdf->Write($line_height,'Thrissur');
			}
		}
		if ($certificate_template[0]['date_x'] and $certificate_template[0]['date_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['date_font'],'B',$certificate_template[0]['date_size']);
			$this->fpdf->SetXY($certificate_template[0]['date_x'],$certificate_template[0]['date_y']);

			$this->fpdf->Write($line_height,'Date : '.'06 Nov 2013');
		}
		if ($certificate_template[0]['place_x'] and $certificate_template[0]['place_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['place_font'],'B',$certificate_template[0]['place_size']);
			$this->fpdf->SetXY($certificate_template[0]['place_x'],$certificate_template[0]['place_y']);

			$this->fpdf->Write($line_height,'Place : '.'Cherpu');
		}

		if($page_style	==	'L')
		{
		$this->fpdf->Line(5,5,5,200);
		$this->fpdf->Line(5,5,255,5);
		$this->fpdf->Line(255,5,255,30);
		$this->fpdf->SetXY(10,10);
		$this->fpdf->SetFont('Arial','B',10);
		$this->fpdf->Write(0,"(From Left , From Top)");
		for($i = 5 ; $i < 260; $i = $i+25)
		{
			for($j = 30 ; $j < 200; $j = $j+25)
			{
				$this->fpdf->SetXY($i,$j-2);
				$this->fpdf->SetFont('Arial','B',8);
				$this->fpdf->Write(0,"(".$i.", ".$j.")");
				$this->fpdf->Line($i,$j,$i,200);
				$this->fpdf->Line($i,$j,200,$j);
			}
		}
		$this->fpdf->Line(5,200,255,200);

		}//End if($page_style	==	'L')
		else{
				$this->fpdf->Line(5,5,5,180);
				$this->fpdf->Line(5,5,180,5);
				$this->fpdf->Line(180,5,180,30);
				$this->fpdf->SetXY(10,10);
				$this->fpdf->SetFont('Arial','B',10);
				$this->fpdf->Write(0,"(From Left , From Top)");
			for($i = 5 ; $i < 200; $i = $i+25)
			{
				for($j = 30 ; $j < 250; $j = $j+25)
				{
				$this->fpdf->SetXY($i,$j-2);
				$this->fpdf->SetFont('Arial','B',8);
				$this->fpdf->Write(0,"(".$i.", ".$j.")");
				$this->fpdf->Line($i,$j,$i,180);
				$this->fpdf->Line($i,$j,180,$j);
				}
			}
			$this->fpdf->Line(5,230,180,230);

		}//End else($page_style	==	'L')

		$this->fpdf->Output('certificate.pdf','D');
	}

	function test_certificare_withoutgraph()
	{

		if($this->Session_Model->check_user_permission(47)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');

		$certificate_template	=	$this->Certificate_model->get_certificate_details($dist_code,$sub_dist_code);

		$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
		$line_height			=	($certificate_template[0]['line_height']) ? $certificate_template[0]['line_height'] : '1';
		$top_margin				=	($certificate_template[0]['top_margin']) ? $certificate_template[0]['top_margin'] : '1';
		$left_margin			=	($certificate_template[0]['left_margin']) ? $certificate_template[0]['left_margin'] : '1';
		$right_margin			=	($certificate_template[0]['right_margin']) ? $certificate_template[0]['right_margin'] : '1';

		$label_print			=	($certificate_template[0]['label_print']) ? $certificate_template[0]['label_print'] : 'N';


		$this->load->library('_fpdf/fpdf');

		$this->fpdf->Open();

		/*$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','B',14);
		$this->fpdf->SetY(30);
		$this->fpdf->Cell(40,10,'Hello World!');
		$this->fpdf->Output('certificate.pdf','D');*/
		$this->fpdf->FPDF($page_style,'mm','A4');

		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','B',14);

		$this->fpdf->SetMargins($left_margin,$top_margin,$right_margin);



		if ($certificate_template[0]['name_x'] and $certificate_template[0]['name_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['name_font'],'B',$certificate_template[0]['name_size']);
			$this->fpdf->SetXY($certificate_template[0]['name_x'],$certificate_template[0]['name_y']);
			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Name : '.'ANU KRISHNAN SYAM DASS SUNDAR DAS CHANDRAN');
			}
			else
			{
				$this->fpdf->Write($line_height,'ANU KRISHNAN SYAM DASS SUNDAR DAS CHANDRAN');
			}


		}
		if ($certificate_template[0]['item_x'] and $certificate_template[0]['item_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['item_font'],'B',$certificate_template[0]['item_size']);
			$this->fpdf->SetXY($certificate_template[0]['item_x'],$certificate_template[0]['item_y']);
			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Item : '.'Desabhakthiganam');
			}
			else
			{
				$this->fpdf->Write($line_height,'Desabhakthiganam');
			}

		}
		if ($certificate_template[0]['category_x'] and $certificate_template[0]['category_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['category_font'],'B',$certificate_template[0]['category_size']);
			$this->fpdf->SetXY($certificate_template[0]['category_x'],$certificate_template[0]['category_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Category : '.'UP General');
			}
			else
			{
				$this->fpdf->Write($line_height,'UP General');
			}
		}
		if ($certificate_template[0]['grade_x'] and $certificate_template[0]['grade_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['grade_font'],'B',$certificate_template[0]['grade_size']);
			$this->fpdf->SetXY($certificate_template[0]['grade_x'],$certificate_template[0]['grade_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Grade : '.'A');
			}
			else
			{
				$this->fpdf->Write($line_height,'A');
			}
		}
		if ($certificate_template[0]['class_x'] and $certificate_template[0]['class_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['class_font'],'B',$certificate_template[0]['class_size']);
			$this->fpdf->SetXY($certificate_template[0]['class_x'],$certificate_template[0]['class_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Class : '.'5');
			}
			else
			{
				$this->fpdf->Write($line_height,'5');
			}
		}
		if ($certificate_template[0]['school_x'] and $certificate_template[0]['school_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['school_font'],'B',$certificate_template[0]['school_size']);
			$this->fpdf->SetXY($certificate_template[0]['school_x'],$certificate_template[0]['school_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'School : '."St Xavier's Chevoor");
			}
			else
			{
				$this->fpdf->Write($line_height,"St Xavier's Chevoor");
			}
		}
		if ($certificate_template[0]['sub_dist_x'] and $certificate_template[0]['sub_dist_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['sub_dist_font'],'B',$certificate_template[0]['sub_dist_size']);
			$this->fpdf->SetXY($certificate_template[0]['sub_dist_x'],$certificate_template[0]['sub_dist_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Subdistrict : '.'Cherpu');
			}
			else
			{
				$this->fpdf->Write($line_height,'Cherpu');
			}
		}
		if ($certificate_template[0]['dist_x'] and $certificate_template[0]['dist_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['dist_font'],'B',$certificate_template[0]['dist_size']);
			$this->fpdf->SetXY($certificate_template[0]['dist_x'],$certificate_template[0]['dist_y']);
			$this->fpdf->Write($line_height,'District');
			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'District : '.'Thrissur');
			}
			else
			{
				$this->fpdf->Write($line_height,'Thrissur');
			}
		}

		if ($certificate_template[0]['date_x'] and $certificate_template[0]['date_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['date_font'],'B',$certificate_template[0]['date_size']);
			$this->fpdf->SetXY($certificate_template[0]['date_x'],$certificate_template[0]['date_y']);

			$this->fpdf->Write($line_height,'Date : '.'06 Nov 2013');
		}
		if ($certificate_template[0]['place_x'] and $certificate_template[0]['place_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['place_font'],'B',$certificate_template[0]['place_size']);
			$this->fpdf->SetXY($certificate_template[0]['place_x'],$certificate_template[0]['place_y']);

			$this->fpdf->Write($line_height,'Place : '.'Cherpu');
		}

		$this->fpdf->Output('certificate.pdf','D');

	}

	function list_item_wise ()
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents				=	array();
		$fest= $this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
		$this->Contents['fest']		=	$fest;
		$this->template->write_view('content', 'certificate/festival_type_list', $this->Contents);
		$fest_id	= $this->input->post('cmbFestType');
		if($fest_id)
		{
			$this->Contents	= array();
			$this->Contents['fest']		=	$this->General_Model->get_data('festival_master', 'fest_name', array('fest_id' => $fest_id));
			$itempart					=	$this->Certificate_model->get_item_certificate($this->input->post('cmbFestType'));
			//$single            			=   $this->Certificate_Model->get_item_certificate_single($this->input->post('cmbFestType'));
			$this->Contents['itempart']	= 	$itempart;
			//$this->Contents['single']   =   $single;
			if(count($itempart)>0)
			{
				$this->template->write_view('content','certificate/item_certificate_details',$this->Contents);
			}
		}
		$this->template->load();
	}

	function get_certificate_itemwise ()
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidItemId'))
		{
		    $sql=mysql_query("update result_master set is_certificate_printed=1 where item_code=".$this->input->post('hidItemId'));
			$this->Contents['javascript_code']	= '';
			$this->Contents['item_type'] =	$this->Certificate_model->is_group_item($this->input->post('hidItemId'));
			if('G' == $this->Contents['item_type'])
			{
				$this->Contents['javascript_code']	= ' onchange="javascript:getPinnaniParticipant(this.value);"';
				$this->Contents['dropdown_title']	= 'Group Captain';
			}
			else if('S' == $this->Contents['item_type'])
			{
				$this->Contents['dropdown_title']	= 'Participants';
			}
			$this->Contents['captain_detail']	= $this->Certificate_model->get_captains_details($this->input->post('hidItemId'));
			$this->template->write_view('content', 'certificate/certificate_itemwise', $this->Contents);
			$this->template->load();
		}
		else
		{
			redirect('certificate/certificate/list_item_wise');
		}
	}
	function get_certificate_pdf ()
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidItemId') && '' != $this->input->post('captain_id') && '' != $this->input->post('hidItemType'))
		{
			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			$dist_code				=	$this->session->userdata('DISTRICT');
			$certificate_template	=	$this->Certificate_model->get_certificate_details($dist_code,$sub_dist_code);
			$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';

			$this->load->library('_fpdf/fpdf');
			$this->fpdf->Open();
			$this->fpdf->FPDF($page_style,'mm','A4');

			if ($this->input->post('captain_id') == 0)
			{
				$participant_array	= $this->Certificate_model->get_participant_details($this->input->post('hidItemId'), 'all', $this->input->post('hidItemType'));
				if (is_array($participant_array) && count($participant_array))
				{
					foreach ($participant_array as $participant_array)
						$this->create_certificate($participant_array, $certificate_template);
				}
			}
			else
			{
				if($this->input->post('participant_id') != '' && 0 != $this->input->post('participant_id'))
				{
					$participant_id		=  $this->input->post('participant_id');
				}
				else if (0 == $this->input->post('participant_id'))
				{
					$participant_id		=  '';
				}
				$participant_array	= $this->Certificate_model->get_participant_details($this->input->post('hidItemId'),
										$this->input->post('captain_id'), $this->input->post('hidItemType'), $participant_id);

				if (is_array($participant_array) && count($participant_array))
				{
					foreach ($participant_array as $participant_array)
					{
						$this->create_certificate($participant_array, $certificate_template);
					}
				}
			}
			$this->fpdf->Output('certificate.pdf','D');

		}
		else
		{
			redirect('certificate/certificate/list_item_wise');
		}
	}

	function create_certificate ($participant_array, $certificate_template)
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
		$line_height			=	($certificate_template[0]['line_height']) ? $certificate_template[0]['line_height'] : '1';
		$top_margin				=	($certificate_template[0]['top_margin']) ? $certificate_template[0]['top_margin'] : '1';
		$left_margin			=	($certificate_template[0]['left_margin']) ? $certificate_template[0]['left_margin'] : '1';
		$right_margin			=	($certificate_template[0]['right_margin']) ? $certificate_template[0]['right_margin'] : '1';

		$label_print			=	($certificate_template[0]['label_print']) ? $certificate_template[0]['label_print'] : 'N';
		$Xincrementforlabel		=	30;
		$Xincrementforlabelitem	=	35;

		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','B',14);

		$this->fpdf->SetMargins($left_margin,$top_margin,$right_margin);

		if ($certificate_template[0]['name_x'] and $certificate_template[0]['name_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['name_font'],'B',$certificate_template[0]['name_size']);
			$this->fpdf->SetXY($certificate_template[0]['name_x'],$certificate_template[0]['name_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Name');
				$this->fpdf->SetXY($certificate_template[0]['name_x']+$Xincrementforlabel,$certificate_template[0]['name_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['name_x']+$Xincrementforlabelitem,$certificate_template[0]['name_y']);
				$this->fpdf->Write($line_height,$participant_array['participant_name']);
			}
			else
			{
				$this->fpdf->Write($line_height,$participant_array['participant_name']);
			}

		}
		if ($certificate_template[0]['item_x'] and $certificate_template[0]['item_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['item_font'],'B',$certificate_template[0]['item_size']);
			$this->fpdf->SetXY($certificate_template[0]['item_x'],$certificate_template[0]['item_y']);

			if ($label_print == 'Y')
			{
				$this->fpdf->Write($line_height,'Item');
				$this->fpdf->SetXY($certificate_template[0]['item_x']+$Xincrementforlabel,$certificate_template[0]['item_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['item_x']+$Xincrementforlabelitem,$certificate_template[0]['item_y']);
				$this->fpdf->Write($line_height,$participant_array['item_name']);
			}
			else
			{
				$this->fpdf->Write($line_height, $participant_array['item_name']);
			}
		}
		if ($certificate_template[0]['category_x'] and $certificate_template[0]['category_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['category_font'],'B',$certificate_template[0]['category_size']);
			$this->fpdf->SetXY($certificate_template[0]['category_x'],$certificate_template[0]['category_y']);

			if ($label_print == 'Y')
			{

				$this->fpdf->Write($line_height,'Category');
				$this->fpdf->SetXY($certificate_template[0]['category_x']+$Xincrementforlabel,$certificate_template[0]['category_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['category_x']+$Xincrementforlabelitem,$certificate_template[0]['category_y']);
				$this->fpdf->Write($line_height,$participant_array['fest_name']);

			}
			else
			{
				$this->fpdf->Write($line_height,$participant_array['fest_name']);
			}
		}
		if ($certificate_template[0]['grade_x'] and $certificate_template[0]['grade_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['grade_font'],'B',$certificate_template[0]['grade_size']);
			$this->fpdf->SetXY($certificate_template[0]['grade_x'],$certificate_template[0]['grade_y']);

			if ($label_print == 'Y')
			{

				$this->fpdf->Write($line_height,'Grade');
				$this->fpdf->SetXY($certificate_template[0]['grade_x']+$Xincrementforlabel,$certificate_template[0]['grade_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['grade_x']+$Xincrementforlabelitem,$certificate_template[0]['grade_y']);
				$this->fpdf->Write($line_height,$participant_array['grade']);

			}
			else
			{
				$this->fpdf->Write($line_height, $participant_array['grade']);
			}
		}
		if ($certificate_template[0]['class_x'] and $certificate_template[0]['class_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['class_font'],'B',$certificate_template[0]['class_size']);
			$this->fpdf->SetXY($certificate_template[0]['class_x'],$certificate_template[0]['class_y']);

			if ($label_print == 'Y')
			{

				$this->fpdf->Write($line_height,'Class');
				$this->fpdf->SetXY($certificate_template[0]['class_x']+$Xincrementforlabel,$certificate_template[0]['class_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['class_x']+$Xincrementforlabelitem,$certificate_template[0]['class_y']);
				$this->fpdf->Write($line_height,$participant_array['class']);

			}
			else
			{
				$this->fpdf->Write($line_height,$participant_array['class']);
			}
		}
		if ($certificate_template[0]['school_x'] and $certificate_template[0]['school_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['school_font'],'B',$certificate_template[0]['school_size']);
			$this->fpdf->SetXY($certificate_template[0]['school_x'],$certificate_template[0]['school_y']);

			if ($label_print == 'Y')
			{

				$this->fpdf->Write($line_height,'School');
				$this->fpdf->SetXY($certificate_template[0]['school_x']+$Xincrementforlabel,$certificate_template[0]['school_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['school_x']+$Xincrementforlabelitem,$certificate_template[0]['school_y']);
				$this->fpdf->Write($line_height,$participant_array['school_name']);
			}
			else
			{
				$this->fpdf->Write($line_height, $participant_array['school_name']);
			}
		}
		if ($certificate_template[0]['sub_dist_x'] and $certificate_template[0]['sub_dist_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['sub_dist_font'],'B',$certificate_template[0]['sub_dist_size']);
			$this->fpdf->SetXY($certificate_template[0]['sub_dist_x'],$certificate_template[0]['sub_dist_y']);
			if ($label_print == 'Y')
			{

				$this->fpdf->Write($line_height,'Subdistrict');
				$this->fpdf->SetXY($certificate_template[0]['sub_dist_x']+$Xincrementforlabel,$certificate_template[0]['sub_dist_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['sub_dist_x']+$Xincrementforlabelitem,$certificate_template[0]['sub_dist_y']);
				$this->fpdf->Write($line_height,$participant_array['sub_district_name']);

			}
			else
			{
				$this->fpdf->Write($line_height, $participant_array['sub_district_name']);
			}

			//$this->fpdf->Write($line_height,'Subdistrict');
		}

		if ($certificate_template[0]['photoX'] and $certificate_template[0]['photoY'])
		{

			@$pic_pathName	=	$participant_array['school_code']."_".$participant_array['admn_no'];

			@$pic_path	=	$this->Photos_model->get_Photo($pic_pathName);

			if($pic_path){
			$this->fpdf->Image($pic_path,$certificate_template[0]['photoX'],$certificate_template[0]['photoY'],$certificate_template[0]['photoWidth'],$certificate_template[0]['photoHight']);
			}

			//$this->fpdf->Write($line_height,'Subdistrict');
		}

		if ($certificate_template[0]['ehs_X'] and $certificate_template[0]['ehs_Y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['ehs_font'],'B',$certificate_template[0]['ehs_size']);
			$this->fpdf->SetXY($certificate_template[0]['ehs_X'],$certificate_template[0]['ehs_Y']);
		    if($participant_array['grade']=='A' && $participant_array['rank']==1 && $participant_array['item_code'] > 520)
			{
			   $this->fpdf->Write($line_height, 'Eligible For Higher Level');
			}
		}
		/*if ($certificate_template[0]['dist_x'] and $certificate_template[0]['dist_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['dist_font'],'B',$certificate_template[0]['dist_size']);
			$this->fpdf->SetXY($certificate_template[0]['dist_x'],$certificate_template[0]['dist_y']);
			$this->fpdf->Write($line_height,'District');
		}*/

		if ($certificate_template[0]['date_x'] and $certificate_template[0]['date_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['date_font'],'B',$certificate_template[0]['date_size']);
			$this->fpdf->SetXY($certificate_template[0]['date_x'],$certificate_template[0]['date_y']);

			$end_date		=	end($this->General_Model->get_fest_date_array());
			if ($label_print == 'Y'){
				//$this->fpdf->Write($line_height,'Date               :  '.$end_date);

				$this->fpdf->Write($line_height,'Date');
				$this->fpdf->SetXY($certificate_template[0]['date_x']+$Xincrementforlabel,$certificate_template[0]['date_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['date_x']+$Xincrementforlabelitem,$certificate_template[0]['date_y']);
				$this->fpdf->Write($line_height,$end_date);
			}
			else
				$this->fpdf->Write($line_height,$end_date);
		}
		if ($certificate_template[0]['place_x'] and $certificate_template[0]['place_y'])
		{
			$this->fpdf->SetFont($certificate_template[0]['place_font'],'B',$certificate_template[0]['place_size']);
			$this->fpdf->SetXY($certificate_template[0]['place_x'],$certificate_template[0]['place_y']);
			$fest_master_details	=	$this->General_Model->get_fest_master_details();
			if (count($fest_master_details) > 0)
			{
				$venue		=	wordwrap(@$fest_master_details[0]['venue'],30,'<br/>');
			}
			if ($label_print == 'Y'){
				//$this->fpdf->Write($line_height,'Place             :  '.$venue);
				$this->fpdf->Write($line_height,'Place');
				$this->fpdf->SetXY($certificate_template[0]['place_x']+$Xincrementforlabel,$certificate_template[0]['place_y']);
				$this->fpdf->Write($line_height,':');
				$this->fpdf->SetXY($certificate_template[0]['place_x']+$Xincrementforlabelitem,$certificate_template[0]['place_y']);
				$this->fpdf->Write($line_height,$venue);

			}
			else
				$this->fpdf->Write($line_height,$venue);
		}

	}

	function list_school_wise ()
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents						=	array();
		$this->Contents['school_details']	=	$this->Certificate_model->school_details_certificate_wise();
		$this->template->write_view('content','certificate/certificate_details_school_wise',$this->Contents);
		$this->template->load();
	}

	function get_certificate_school_wise ()
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidSchoolCode'))
		{
			$school_code						= $this->input->post('hidSchoolCode');
			$this->Contents['fest']				=	$this->Certificate_model->get_school_festival_details($school_code);
			$school_code	= $this->input->post('hidSchoolCode');
			$this->Contents['school_details']	= 	$this->General_Model->get_data('school_master', 'school_code, school_name', array('school_code' => $school_code));
			/*$itempart							=	$this->Certificate_model->get_item_certificate('', $school_code);
			$this->Contents['itempart']			= 	$itempart;
			if(count($itempart)>0)
			{*/
				$this->template->write_view('content','certificate/school_item_certificate_details',$this->Contents);
		/*}*/
			$this->template->load();
		}
		else
		{
			redirect('certificate/certificate/list_school_wise');
		}
	}

	function get_certificate_pdf_school_wise ()
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidSchoolCode'))
		{
			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			$dist_code				=	$this->session->userdata('DISTRICT');
			$certificate_template	=	$this->Certificate_model->get_certificate_details($dist_code,$sub_dist_code);
			$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';

			$this->load->library('_fpdf/fpdf');
			$this->fpdf->Open();
			$this->fpdf->FPDF($page_style,'mm','A4');

			$school_code		= $this->input->post('hidSchoolCode');
			$festival			= $this->input->post('cmbFestType');
			$item_code			= $this->input->post('item_code');
			$captain_id			= $this->input->post('captain_id');
			$participant_id		= $this->input->post('participant_id');
			$participant_array	= $this->Certificate_model->get_school_participant_details($school_code, $festival, $item_code, $captain_id, $participant_id);

			if (is_array($participant_array) && count($participant_array))
			{
				foreach ($participant_array as $participant_array)
				{
					$this->create_certificate($participant_array, $certificate_template);
				}
			}

			$this->fpdf->Output('certificate.pdf','D');

		}
		else
		{
			redirect('certificate/certificate/list_item_wise');
		}
	}

	function list_reg_no_wise ()
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		//$this->Contents['school_details']	= 	$this->General_Model->get_data('school_master', 'school_code, school_name', array('school_code' => $school_code));
		$this->template->write_view('content','certificate/participant_certificate_details',$this->Contents);
		$this->template->load();
	}

	function get_certificate_pdf_participant_wise ()
	{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('txtParticipantId') && '' != $this->input->post('item_code'))
		{
			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			$dist_code				=	$this->session->userdata('DISTRICT');
			$certificate_template	=	$this->Certificate_model->get_certificate_details($dist_code,$sub_dist_code);
			$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';

			$this->load->library('_fpdf/fpdf');
			$this->fpdf->Open();
			$this->fpdf->FPDF($page_style,'mm','A4');

			$festival			= '';
			$school_code		= '';
			$captain_id			= '';
			$item_code			= $this->input->post('item_code');
			$participant_id		= $this->input->post('txtParticipantId');

			$participant_array	= $this->Certificate_model->get_school_participant_details($school_code, $festival, $item_code, $captain_id, $participant_id);
			if (is_array($participant_array) && count($participant_array))
			{
				foreach ($participant_array as $participant_array)
				{
					$this->create_certificate($participant_array, $certificate_template);
				}
			}

			$this->fpdf->Output('certificate.pdf','D');

		}
		else
		{
			redirect('certificate/certificate/list_reg_no_wise');
		}
	}
}
?>
