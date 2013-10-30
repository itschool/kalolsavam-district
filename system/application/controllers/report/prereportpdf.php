<?php
class Prereportpdf extends Controller {

		function Prereportpdf()
		{
			parent::Controller();
			$this->Session_Model->is_user_logged(true);
			$this->template->add_js('js/report/staticreport.js');	
			$this->template->add_js('js/report/reportjs.js');	
			$this->load->library('HTML2PDF');
			$this->load->model('report/prereport_model');
			$this->load->model('photos/Photos_Model');	
		}
		
		function list_school()
		{
			if($this->Session_Model->check_user_permission(27)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			$this->load->model('report/prereport_model');
			if($this->input->post('txtfestFrom')!=''){
				 $school_fest			=	$this->prereport_model->participate_school_details();
				 $part_details			=	$this->prereport_model->participate_item_details($this->input->post('txtfestFrom'),$this->input->post('cboSubDistCode'));
				// print_r( $part_details);
				 $festdetails           =   $this->prereport_model->itempart_details();
				 $subdistrict           =   $this->prereport_model->find_subdistrict();
				//print_r( $subdistrict);
		
				 $this->Content['school_fest']		= 	$school_fest;
				 $this->Content['festtype']	 		=   $part_details;	
				 $this->Content['festmaster']	 	=   $festdetails;
				  $festdata                         =   $this->input->post('txtfestFrom');	
				 $this->Content['fest']             =   $festdata;
				 $this->Content['subdistrict']      =   $this->input->post('cboSubDistCode'); 
				 $this->Content['subdist']          =   $subdistrict;
				 //var_dump($this->Content['subdistrict']);
				 $content	=	$this->load->view('report/prereportpdf/list_school',$this->Content,true);
				 
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('Participatingschools.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			
			}
		}
		function list_subdistricts()
		{
		$this->Contents                     =    array();
			$this->Contents['sub_list']   =    $this->prereport_model->list_subdistricts();
			$content=$this->load->view('report/prereportpdf/list_subdistricts',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('list_subdistricts.pdf', 'I');
		}
		function list_of_participants_in_group()
		{
		$this->Contents                     =    array();
		$reg_no                              =   $this->input->post('regno');
		$item_code                           =   $this->input->post('cbo_item');
			$partdata   =    $this->prereport_model->list_of_participants_in_group_final($reg_no,$item_code);
			$this->Contents['partdata']=$partdata;
			if(count($partdata)>0){
			$content=$this->load->view('report/prereportpdf/list_of_participants_in_group_final',$this->Contents,true);
            $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('list_of_participants_in_group.pdf', 'I');
            }
			else {
					redirect('test/nodata');
				}
			
		}
		function list_of_participants_in_group_school()
		{
		$this->Contents                     =    array();
		$school                              =   $this->input->post('txtSchoolCode');
		//$item_code                           =   $this->input->post('cbo_item');
			$partdata   =    $this->prereport_model->list_of_participants_in_group_school($school);
			$this->Contents['partdata']=$partdata;
			if(count($partdata)>0){
			$content=$this->load->view('report/prereportpdf/list_of_participants_in_group_school',$this->Contents,true);
            $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('list_of_participants_in_group.pdf', 'I');
            }
			else {
					redirect('test/nodata');
				}
			
		}
		
		
		function team_list()
		{
			$this->Contents     =    array();
			$cap	            =   $this->input->post('cbo_cap');
			$item_code          =   $this->input->post('cbo_item');
			$partdata   		=    $this->prereport_model->team_list_in_group_final($cap,$item_code);
			$this->Contents['partdata']=$partdata;
			if(count($partdata)>0){
			$content=$this->load->view('report/prereportpdf/team_list_in_group_final',$this->Contents,true);
            $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('list_of_participants_in_group.pdf', 'I');
            }
			else {
					redirect('test/nodata');
				}
			
		}
		
		function schoolfestall()
		{
			$this->Contents                     =    array();
			$this->Contents['school_details']   =    $this->prereport_model->schoolalldetails();
			$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
			$content=$this->load->view('report/prereportpdf/schoolfestall',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Allparticipatingschools.pdf', 'I');
		}
		
		function list_participants()
		{
		 
			if($this->Session_Model->check_user_permission(30)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content=array();
			$sub_dist_code			=		$this->input->post('cboSubDistCode');
			$festpart_school		=		$this->input->post('Festpart');
			// echo  $festpart_school;
			
			
			
			//if(count($item_details)>0)
			{
				$part_details			=	$this->prereport_model->part_item_details($sub_dist_code,$festpart_school);
				
				$this->Content['part_details']		= 	$part_details;	
				// print_r($part_details);
				if(count($part_details)>0){
				
					$content	=	             $this->load->view('report/prereportpdf/team_manager_all',$this->Content,true);
					
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('Listofparticipantforteam_manager.pdf', 'I');
				}
				else {
					redirect('test/nodata');
				}
			}
			/*else {
				redirect('test/nodata');
			}*/
		
	}
	
	function team_manager_all()
	{
	 
		$this->Contents=array();
		$part_details			=	$this->prereport_model->part_item_details_allschool($this->input->post('cmbFestType'));
		$this->Contents['part_details']		= 	$part_details;	
		$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
		if(count($part_details)>0){
		
			$content	=	             $this->load->view('report/prereportpdf/team_manager_all',$this->Contents,true);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('AllListofparticipantforteam_manager.pdf', 'I');
		}
		else {
			redirect('test/nodata');
		}
	}
	
		function feedetails()
		{
			if($this->Session_Model->check_user_permission(32)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			$getschool=array();
			$getschool=$this->prereport_model->get_fee_school_single($this->input->post('txtSchoolCode'));
			//print_r($getschool);
			if(count($getschool)>0){
			$fees_details		            =	$this->prereport_model->get_fees_details($this->input->post('txtSchoolCode'));
			
			
			$this->Content['fees_details']  =	$fees_details;
			//if(($fees_details['up_fee']['afliation']!=0)&&($fees_details['hs_fee']['afliation']!=0))
			if(($fees_details['up_fee']['afliation']!=0) || ($fees_details['hs_fee']['afliation']!=0) || ($fees_details['hss_fee']['afliation']!=0) || ($fees_details['vhss_fee']['afliation']!=0))
			{
		//	print_r($fees_details);
			 $content	                    =	   $this->load->view('report/prereportpdf/feedetails',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('feedetails.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			}
			}
			else {
				redirect('test/nodata');
			}
		}
	
		function all_feedet_report_all()
		{
		$this->Content = array();
		$fees_details		            =	$this->prereport_model->get_fees_details_all();
		//print_r($fees_details);
		$this->Content['fees_details']  =	$fees_details;
		$this->Content['subdistrict']     	=   $this->prereport_model->find_subdistrict();
		
		 $content	                    =	             $this->load->view('report/prereportpdf/feedetailsviewall',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Feedetailsall.pdf', 'I');
		
		}
		
		function callsheet_report()
		{
			if($this->Session_Model->check_user_permission(34)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			if($this->input->post('cbo_item')!='ALL'){
				$fees_details		            =	$this->prereport_model->get_callsheet_details($this->input->post('cbo_item'));
				$this->Content['fees_details']  =	$fees_details;
				$this->Content['subdistrict']     	=   $this->prereport_model->find_subdistrict();
				//print_r($fees_details);
				if(count($fees_details)>0){
				 $content	                    =	             $this->load->view('report/prereportpdf/callsheet_report',$this->Content,true);
				 
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('Callsheet.pdf', 'I');
				} 
				else {
					redirect('test/nodata');
				}
			}
			else{
				$this->Content = array();
				
				$fees_details		            =	$this->prereport_model->all_callsheet_details($this->input->post('cmbFestType'));
				$this->Content['fees_details']  =	$fees_details;
				//echo $this->input->post('cmbFestType');
				//print_r($fees_details);
				$this->Content['subdistrict']     	=   $this->prereport_model->find_subdistrict();
				if(count($fees_details)>0){
				 $content	                    =	             $this->load->view('report/prereportpdf/callsheet_all',$this->Content,true);
				 
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('Callsheetall.pdf', 'I');
				} 
				else {
					redirect('test/nodata');
				}
			
			}

	}
	
	
		function callsheet_all()
		{
		$this->Content = array();
		$date=$_POST['txtDate'];	
		
		$fees_details		            =	$this->prereport_model->all_callsheet_details($this->input->post('cmbFestType1'),$date);
		$this->Content['fees_details']  =	$fees_details;
		//echo $this->input->post('cmbFestType');
		//print_r($fees_details);
		$this->Content['subdistrict']     	=   $this->prereport_model->find_subdistrict();
		if(count($fees_details)>0){
		 $content	                    =	             $this->load->view('report/prereportpdf/callsheet_all',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Callsheetall.pdf', 'I');
		} 
		else {
			redirect('test/nodata');
		}
	}
		
		function participant_cardindex()		
		{
			$no_of_cards				=	$_POST['cboNoofcards'];
			if($no_of_cards=='N')
			{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
		//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
			//$participant_details		=	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'));
			$participant_details		=	$this->prereport_model->get_participant_details_sub_dist($this->input->post('cboSubDistCode'));
			
			$this->Content['participant_details']  =	$participant_details;
			//print_r($fees_details);
			
			
			if(count($participant_details)>0){
			
			 $content	                    =	             $this->load->view('report/prereportpdf/pt4',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantcard.pdf', 'I');
			} 
			else {
				redirect('test/nodata');
			}
			}		
            else
			{
			 if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
		//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
			//$participant_details		=	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'));
			$participant_details		=	$this->prereport_model->get_participant_details_sub_dist($this->input->post('cboSubDistCode'));
			
			$this->Content['participant_details']  =	$participant_details;
			//print_r($fees_details);
			
			
			if(count($participant_details)>0){
			
			 $content	                    =	             $this->load->view('report/prereportpdf/pt',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('L','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantcard.pdf', 'I');
			} 
			else {
				redirect('test/nodata');
			}
			}			
		}
		
		function participant_cardindex_photo()		
		{
			$no_of_cards				=	$_POST['cboNoofcards'];
			if($no_of_cards=='N')
			{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
		//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
			//$participant_details		=	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'));
			$participant_details		=	$this->prereport_model->get_participant_details_sub_dist($this->input->post('cboSubDistCode'));
			//var_dump($participant_details);
			$this->Content['participant_details']  =	$participant_details;
			//print_r($fees_details);
			$DataReturn1['participant_det']  =	$participant_details;
			//print_r($this->Content['participant_details']);
			
			
			if(count($participant_details)>0){
			
			$this->Content['Photo']			=	$this->Photos_Model->get_subdistwise_Photo($DataReturn1);
			 $content	                    =	             $this->load->view('report/prereportpdf/pt4_photo',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantcard.pdf', 'I');
			} 
			else {
				redirect('test/nodata');
			}
			}		
            else
			{
			 if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
		//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
			//$participant_details		=	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'));
			$participant_details		=	$this->prereport_model->get_participant_details_sub_dist($this->input->post('cboSubDistCode'));
			
			$this->Content['participant_details']  =	$participant_details;
			//print_r($fees_details);
			$DataReturn1['participant_det']  =	$participant_details;
			
			
			if(count($participant_details)>0){
			$this->Content['Photo']			=	$this->Photos_Model->get_subdistwise_Photo($DataReturn1);
			
			 $content	                    =	             $this->load->view('report/prereportpdf/pt_photo',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('L','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantcard.pdf', 'I');
			} 
			else {
				redirect('test/nodata');
			}
			}			
		}
		
		function participant_cardindex_school()
		{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
		//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
			$participant_details		=	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'));
			$this->Content['participant_details']  =	$participant_details;
			//print_r($fees_details);
			
			if(count($participant_details)>0){
			
			 $content	                    =	             $this->load->view('report/prereportpdf/pt',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('L','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantcard.pdf', 'I');
			} 
			else {
				redirect('test/nodata');
			}
			
		}
		
		
		function participant_cardindex_school_photo()
		{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			
		//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
			$participant_details		=	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'));
			$school_code	=	$this->input->post('txtSchoolCode');
			$this->Content['participant_details']  =	$participant_details;
			$DataReturn1['participant_det']  =	$participant_details;
			//print_r($this->Content['participant_details']);
			$this->Content['Photo']			=	$this->Photos_Model->get_schoolwise_Photo($DataReturn1,$school_code);
			//var_dump($this->Content['Photo']);
			if(count($participant_details)>0){
			
			 $content	  =	  $this->load->view('report/prereportpdf/pt_photo',$this->Content,true);
			 //$this->template->load();
			$html2pdf = new CI_HTML2PDF('L','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantcard.pdf', 'I');
			} 
			else {
				redirect('test/nodata');
			}
			
		}
		
		
		function participant_cardindex_school_all()
		{
			
			$this->Content = array();
		//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
			$participant_details		=	$this->prereport_model->get_participant_details_all();
			$this->Content['participant_details']  =	$participant_details;
			//print_r($fees_details);
			
			if(count($participant_details)>0){
			
			 $content	                    =	             $this->load->view('report/prereportpdf/pt_all',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('L','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantcard.pdf', 'I');
			} 
			else {
				redirect('test/nodata');
			}
			
		}
	function participant_regno()
	{
	   
		$this->Content = array();
		$partcard		            =	$this->prereport_model->get_participant_regno($this->input->post('regno'));
		$partcard1		            =	$this->prereport_model->get_participant_regno($this->input->post('regno1'));
		$partcard2		            =	$this->prereport_model->get_participant_regno($this->input->post('regno2'));
		
		$this->Content['partcard']  =	$partcard;
		$this->Content['partcard1']  =	$partcard1;
		$this->Content['partcard2']  =	$partcard2;
		//print_r($fees_details);
		
		if(count($partcard)>0){
		
		 $content	                    =	  $this->load->view('report/prereportpdf/participant_regno',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('L','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('participantcard.pdf', 'I');
		} 
		else {
			redirect('test/nodata');
		}
	}
	
	function participant_regno_photo()
	{
	   
		$this->Content = array();
		$partcard		            =	$this->prereport_model->get_participant_regno($this->input->post('regno'));
		$partcard1		            =	$this->prereport_model->get_participant_regno($this->input->post('regno1'));
		$partcard2		            =	$this->prereport_model->get_participant_regno($this->input->post('regno2'));
		
		$this->Content['partcard']  =	$partcard;
		$this->Content['partcard1']  =	$partcard1;
		$this->Content['partcard2']  =	$partcard2;
		//print_r($fees_details);
		//echo "<br /><br />-->".var_dump($this->Content);
		
		if(count($partcard)>0){
		
		 $this->Content['Photo']			=	$this->Photos_Model->get_participant_regno_Photo($this->Content);
		 $content	                    =	  $this->load->view('report/prereportpdf/participant_regno_photo',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('L','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('participantcard.pdf', 'I');
		} 
		else {
			redirect('test/nodata');
		}
	}
	
		function participant_more_item()
		{
			if($this->Session_Model->check_user_permission(40)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			$fees_details		            =	$this->prereport_model->list_participant_more($this->input->post('cmbFestType'));
			$this->Content['fees_details']  =	$fees_details;
			
			if(count($fees_details)>0){
			$content	                    =	             $this->load->view('report/prereportpdf/participant_more_item',$this->Content,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantmorethanoneitem.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			}
			
			}
			
			function more_limit_partlist()
			{
			$this->Content = array();
			if($this->input->post('cmbFestType')){
			$fees_details		            =	$this->prereport_model->list_more_limitpart($this->input->post('cmbFestType'),$this->input->post('txtLimitcode'));
			$this->Content['fees_details']  =	$fees_details;
			$this->Content['subdistrict']     	=   $this->prereport_model->find_subdistrict();
			$this->Content['item_names']     	=   $this->prereport_model->item_names();
			//print_r($fees_details);
			if(count($fees_details)>0){
			$content	                    =	             $this->load->view('report/prereportpdf/participant_limit_item_more',$this->Content,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('partmorethanoneitem.pdf', 'I');
			}
			}
			else {
				redirect('test/nodata');
			}
		}
		
		function eligible_school()
		{
			if($this->Session_Model->check_user_permission(42)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			$school_details		            =	$this->prereport_model->list_eligible_schools();
			$this->Content['school_details']  =	$school_details	;
			//print_r($school_details);
	
			if(count($school_details)>0){
			 $content	                    =	             $this->load->view('report/prereportpdf/list_eligible_school',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Eligible_schools.pdf', 'I');
		}
		}
		
		function clusterreport_report()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents				= array();
			// echo $this->input->post('cbo_item');
			if($this->input->post('cbo_item')!='ALL'){
			
			$retdata                = $this->prereport_model->cluster_reportreport(($this->input->post('cmbFestType')),($this->input->post('cbo_item')));
			
			$this->Contents['retdata']		=	$retdata;
			//print_r($retdata);
			if(count($retdata)>0){
			$content	                    =	     $this->load->view('report/prereportpdf/clustor_report',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('cluster.pdf', 'I');
			
			}
			else {
				redirect('test/nodata');
			}
			}
			else{
			$this->Contents				= array();
			$retdata                      = $this->prereport_model->cluster_report_all(($this->input->post('cmbFestType')));
			$this->Contents['retdata']		=	$retdata;
			$this->Contents['subdistrict'] =   $this->prereport_model->find_subdistrict();
			
			if(count($retdata)>0){
			$content	                    =	             $this->load->view('report/prereportpdf/clustor_report_all',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('cluster.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			}
			
			}
			
		}
		function cluster_report_date()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			
			$this->Contents				= array();
			if($this->input->post('cmbFestType')=='All')
			{
				$retdata                = $this->prereport_model->cluster_report_date_all(($this->input->post('txtDate')));
			}
			else
			{
			$retdata                = $this->prereport_model->cluster_report_date(($this->input->post('cmbFestType')),($this->input->post('txtDate')));
			}
			$this->Contents['retdata']		=	$retdata;
			//print_r($retdata);
			if(count($retdata)>0){
			$content	                    =	     $this->load->view('report/prereportpdf/cluster_report_date',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('cluster.pdf', 'I');
			
			}
			else {
				redirect('test/nodata');
			}
			}
			
			function cluster_date_stage()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			
			$this->Contents				= array();
			$retdata                = $this->prereport_model->cluster_date_stage(($this->input->post('txtDate')),($this->input->post('cmbstage')));
			$this->Contents['retdata']		=	$retdata;
			if(count($retdata)>0){
			$content	                    =	     $this->load->view('report/prereportpdf/cluster_report_date',$this->Contents,True);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('cluster.pdf', 'I');
			
			}
			else {
				redirect('test/nodata');
			}
			}
			function cluster_report_stage()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents				= array();
			if($this->input->post('cmbFestType')=='All')
			{
				$retdata                = $this->prereport_model->cluster_report_stage_all(($this->input->post('cmbstage')));
			}
			else
			{
				$retdata                = $this->prereport_model->cluster_report_stage(($this->input->post('cmbFestType')),($this->input->post('cmbstage')));
			}
			
			$this->Contents['retdata']		=	$retdata;
			//print_r($retdata);
			if(count($retdata)>0){
			$content	                    =	     $this->load->view('report/prereportpdf/cluster_report_date',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('cluster.pdf', 'I');
			
			}
			else {
				redirect('test/nodata');
			}
			}

		
		
		function cluster_report_all()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents				= array();
			$retdata                      = $this->prereport_model->cluster_report_all(($this->input->post('cmbFestType1')));
			$this->Contents['retdata']		=	$retdata;
			$this->Contents['subdistrict'] =   $this->prereport_model->find_subdistrict();
			
			if(count($retdata)>0){
			$content	                    =	             $this->load->view('report/prereportpdf/clustor_report_all',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('clusterall.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			}
		}
		
		function cluster_report_all_doc()
		{
			$this->Contents				= array();
			$retdata                      = $this->prereport_model->cluster_report_all(($this->input->post('cmbFestType1')));
			$this->Contents['retdata']		=	$retdata;
			$this->Contents['subdistrict'] =   $this->prereport_model->find_subdistrict();
			if(count($retdata)>0){
				header("Content-type: application/vnd.txt");
				header("Content-Disposition: attachment; filename=cluster_report.txt");
				$this->load->view('report/prereportpdf/clustor_report_all_doc',$this->Contents);
			}
			else {
				redirect('test/nodata');
			}
		}
		
		function rpt_item_with_item_code()//vipin
		 {
	 	$this->Contents				=	array();
		$festdata                      =   $this->prereport_model->item_list();
		$this->Contents['festdata']    =   $festdata ;
		//print_r($festdata);
		 $content=$this->load->view('report/prereportpdf/rpt_list_of_items',$this->Contents,true);
	      $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		  $html2pdf->pdf->SetDisplayMode('fullpage');
		  $html2pdf->WriteHTML($content,'');
		  $html2pdf->Output('itemwise_participant.pdf', 'I');
	
		}
		
		 function print_score_sheet()//vipin
	     {       
			if($this->Session_Model->check_user_permission(35)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$ItemCode=$_POST['cbo_item'];	
			$date= $this->prereport_model->fetch_item_name2($ItemCode);	
			if(count($date>0)){
			$this->Contents	=	array();	 	 
			
			$this->Contents['itemcode']	=	$ItemCode; 
			$this->Contents['start_time']	=	$date;		
			
			$content=$this->load->view('report/prereportpdf/rpt_scoresheet',$this->Contents,true);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content,'');
			$html2pdf->Output('scoresheet.pdf','I');
			}
			else{
			 
				redirect('test/nodata');
			
			}    
		  }
		  
		  
		 function fest_details()
		{   
	     $festival_id=$_POST['txtfestFrom'];
		 $this->Content = array();
		 $fest_details=	$this->prereport_model->fetch_fest_name($festival_id);		
		 $this->Content['festdata']=  $fest_details;		
		 $content	=	$this->load->view('report/prereportpdf/fest_details',$this->Content,true);		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('festdetails.pdf', 'I');
	}
	

 			function fest_scoresheet_details()//vipin
	    	 {   	
		 		 $fest_id=$_POST['txtfestFrom'];	
				  $date=$_POST['txtDate'];
   				   $this->Contents	         =	array();
				   $fest_details             =	$this->prereport_model->fetch_fest_scoresheet($fest_id,$date);
				  	
		          // print_r ($fest_details);				 
				  if(count($fest_details)>0){
				   $this->Contents['fest_details']=  $fest_details;	
				  $content=$this->load->view('report/prereportpdf/rpt_fest_scoresheet',$this->Contents,true);
		          $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		          $html2pdf->pdf->SetDisplayMode('fullpage');
		          $html2pdf->WriteHTML($content,'');
		          $html2pdf->Output('festscoresheet.pdf','I');
		          }
		         else{
				 		
				     redirect('test/nodata');
				 
				  }
		  }
		  
		  
		function timesheet()
		{
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('cbo_item');
	  	$festival						=	$this->input->post('cmbFestType');
		$this->Contents['itemtime']= $this->prereport_model->timesheet($itemcode);
		
		$this->Contents['item_count']= $this->General_Model->get_record_count('participant_item_details',"item_code = '$itemcode' AND is_captain = 'Y'");
		
		$this->Contents['festname']= $this->prereport_model->Festname($festival);
		$content	=	$this->load->view('report/prereportpdf/timesheet',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Timesheet.pdf', 'I');
		}
	
	function datewisepart()
	{
		
		if($this->Session_Model->check_user_permission(28)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents=array();
		$this->template->write('title', '');
	//	$itemcode						=	$this->input->post('cbo_item');
	  	//$festival						=	$this->input->post('cmbFestType');
		$date							=	$this->input->post('txtDate');
		//$this->Contents['date']			=	$date;
		if($date!='All'){
		
		//$this->Contents['partdata']= $this->prereport_model->datewise_participants($date);
		//$this->Contents['itemdet']= $this->prereport_model->Eventname($itemcode);
		/*$lp=$this->prereport_model->lpstudents_date($date);
		$up=$this->prereport_model->upstudents_date($date);
		$hs=$this->prereport_model->hsstudents_date($date);
		$hss=$this->prereport_model->hssstudents_date($date);*/
		
		$up=$this->prereport_model->subupstudents_date($date);
		$hs=$this->prereport_model->subhsstudents_date($date);
		$hss=$this->prereport_model->subhssstudents_date($date);
		$retval  =$this->prereport_model->consolidated_total();
		$retboys_total  =$this->prereport_model->consolidated_boys_total();
		$retgirls_total =$this->prereport_model->consolidated_girls_total();
		
		//$school=$this->prereport_model->school_lpdetails();
		$sub_dist=$this->prereport_model->sub_dist_lpdetails();
		
		//print_r($lp);
		//$this->Contents['lp']  =$lp;
		$this->Contents['up']  =$up;
		$this->Contents['hs']  =$hs;
		$this->Contents['hss']  =$hss;
		$this->Contents['sub_dist']  =$sub_dist;
		$this->Contents['date']=$date;
		$this->Contents['retval']  =$retval;
		$this->Contents['retboys_total']  =$retboys_total;
		$this->Contents['retgirls_total']  =$retgirls_total;
		
		$content	=	$this->load->view('report/prereportpdf/datewisepart',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('datewise_participant.pdf', 'I');
		}
		else {
		
		//$this->Contents['partdata']= $this->prereport_model->datewise_participants($date);
		//$this->Contents['itemdet']= $this->prereport_model->Eventname($itemcode);
		/*$lp=$this->prereport_model->lpstudents();
		$up=$this->prereport_model->upstudents();
		$hs=$this->prereport_model->hsstudents();
		$hss=$this->prereport_model->hssstudents();*/
		
		$up=$this->prereport_model->subupstudents();
		$hs=$this->prereport_model->subhsstudents();
		$hss=$this->prereport_model->subhssstudents();
		$retval  =$this->prereport_model->consolidated_total();
		$retboys_total  =$this->prereport_model->consolidated_boys_total();
		$retgirls_total =$this->prereport_model->consolidated_girls_total();
		
		
		//$school=$this->prereport_model->school_lpdetails();
		$sub_dist=$this->prereport_model->sub_dist_lpdetails();
		
		//$this->Contents['lp']  =$lp;
		$this->Contents['up']  =$up;
		$this->Contents['hs']  =$hs;
		$this->Contents['hss']  =$hss;
		$this->Contents['sub_dist']  =$sub_dist;
		$this->Contents['date']="";
		$this->Contents['retval']  =$retval;
		$this->Contents['retboys_total']  =$retboys_total;
		$this->Contents['retgirls_total']  =$retgirls_total;
		
		
		$content	=	$this->load->view('report/prereportpdf/datewisepart',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('datewise_participant.pdf', 'I');
		}
	}
	
		function stagereportdate()//ratheesh
		{
			if($this->Session_Model->check_user_permission(39)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$stageid						=	$this->input->post('cmbstage');	  	
			$date							=	$this->input->post('txtDate');
			if($date=='ALL'){
			
					$this->Contents['date']			=	"All Date";
					$this->Contents['stageid']		=	$stageid;
					$this->Contents['stagedata']	= 	$this->prereport_model->alldate_stagereport($stageid);
					$this->Contents['stagename']	= 	$this->prereport_model->Stagename($stageid);		
					$content	=	$this->load->view('report/prereportpdf/allstage',$this->Contents,true);
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('Stagereport_date.pdf', 'I');
			
			}
			else{
					$this->Contents['date']			=	$date;
					$this->Contents['stageid']		=	$stageid;
					$this->Contents['stagedata']	= 	$this->prereport_model->datewise_stagealtreport($date,$stageid);//datewise_stagereport($date);
					$this->Contents['stagename']	= 	$this->prereport_model->Stagename($stageid);		
					$content	=	$this->load->view('report/prereportpdf/stagereportdate',$this->Contents,true);
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('Stagereport_date.pdf', 'I');
			}
		 }
		 function stagereport_all()
		 {
		 
		 $this->Contents=array();
		 $this->template->write('title', '');
		 $stageid						=	$this->input->post('cmbFestType');	
		 $retdata                        =   $this->prereport_model->stagereport_all();
		// print_r($retdata);
		 $this->Contents['retdata']        =   $retdata;
		  $this->Contents['subdistrict'] =   $this->prereport_model->find_subdistrict();
		// print_r($retdata);
		 $content	=	$this->load->view('report/prereportpdf/stagereport_all',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('stagereport_all.pdf', 'I');
		 
		 }
		 function rpt_itemwiseparticipants()//ratheesh
		{
		$this->load->model('staticreport/Itemreports_Model');
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('cbo_item');
	  	$festival						=	$this->input->post('cmbFestType');
		
		if($itemcode=='ALL'){
		
				$itempart              =        $this->prereport_model->itemwise_allfestival($festival);
				$this->Contents['itempart']  =  $itempart;
				$content	=	$this->load->view('report/prereportpdf/rptallitemwise',$this->Contents,true);
				//print_r($itempart  );
			}
		else{
		
			$this->Contents['partdata']= $this->Itemreports_Model->itemwise_participants($itemcode);
			$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($itemcode);
			$this->Contents['festdet']= $this->Itemreports_Model->Festname($festival);
			$content	=	$this->load->view('report/prereportpdf/rpt_itemwiseparticipants',$this->Contents,true);
		}
		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('itemwiseparticipants.pdf', 'I');
		//$this->template->load();
		
		}
		 function rpt_datewiseparticipants()
		{
		$this->load->model('staticreport/Itemreports_Model');
		$this->Contents=array();
		$this->template->write('title', '');
		$fest						=	$this->input->post('cmbFestType');
	  	$date						=	$this->input->post('txtDate');
		
		if($date=='ALL'){
		
				$itempart              =        $this->prereport_model->datewise_allfestival($fest);
				$this->Contents['itempart']  =  $itempart;
				$content	=	$this->load->view('report/prereportpdf/rptalldatewise',$this->Contents,true);
				//print_r($itempart  );
			}
		else{
		
			$this->Contents['partdata']= $this->Itemreports_Model->datewise_participants($itemcode);
			$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($date);
			$this->Contents['festdet']= $this->Itemreports_Model->Festname($fest);
			$content	=	$this->load->view('report/prereportpdf/rpt_datewiseparticipants',$this->Contents,true);
		}
		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Datewiseparticipants.pdf', 'I');
		//$this->template->load();
		
		}
		function stageallot_duration()
		{
			if($this->Session_Model->check_user_permission(31)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
		
		$this->Contents=array();
		$this->template->write('title', '');
		$festcode			=	$this->input->post('cmbFestType');
		if($festcode!='ALL'){
		
			$allot              =   $this->prereport_model->stageallot_duration($festcode);
			//print_r($allot);
			$this->Contents['allot']            = $allot;
			$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
			$this->Contents['groups']           =   $this->prereport_model->groupallotduration();
			if(count($allot)>0){
			 $content=$this->load->view('report/prereportpdf/stageallot_duration',$this->Contents,true);
		
			 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			 $html2pdf->pdf->SetDisplayMode('fullpage');
			 $html2pdf->WriteHTML($content,'');
			 $html2pdf->Output('Stageallot_duration.pdf', 'I');
			 }
			else{
				redirect('test/nodata');
				}
			}
		 else {
			 $allot              =   $this->prereport_model->stageallot_duration_all();
			//print_r($allot);
			$this->Contents['allot']            = $allot;
			$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
			$this->Contents['groups']           =   $this->prereport_model->groupallotduration();
			if(count($allot)>0){
			 $content=$this->load->view('report/prereportpdf/stageallot_all',$this->Contents,true);
		
			 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			 $html2pdf->pdf->SetDisplayMode('fullpage');
			 $html2pdf->WriteHTML($content,'');
			 $html2pdf->Output('Stageallot_duration.pdf', 'I');
		 
			 }
			 else{
				redirect('test/nodata');
				}
			 }
		
		}
		
      function clashes_details()
	  {
	    //echo "huuuuu";
		 $this->load->model('report/prereport_model');
		 $this->Contents=array();
		 $festival						=	$this->input->post('cmbFestType');
		 $date                          =   $this->input->post('txtDate');
			$this->Contents['retdata']= $this->prereport_model->clash_info1($festival,$date);
			$this->Contents['date']=$date;

	          if($festival!='all')
			  {
			    
			   //$this->Contents['retdata']=$clash;
			 $content=$this->load->view('report/prereportpdf/rpt_clashes_report',$this->Contents,true);
		  
			 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			 $html2pdf->pdf->SetDisplayMode('fullpage');
			 $html2pdf->WriteHTML($content,'');
			 $html2pdf->Output('Clashes_details.pdf', 'I');
	         }
			
			 
			else{
				$content=$this->load->view('report/prereport/rpt_clashes_report_all',$this->Contents,true);
		  
			 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			 $html2pdf->pdf->SetDisplayMode('fullpage');
			 $html2pdf->WriteHTML($content,'');
			 $html2pdf->Output('Clashes_details.pdf', 'I');
				} 
			 
			 
		}
		  function testing()
	  {
	    $que="update item_master set max_time=20 where item_code=664";
		$que1="update item_master set max_time=20 where item_code=995";

        $clash_detail		=$this->db->query($que);
		$clash_detail1		=$this->db->query($que1);

		
		
	  }
    	function appealed_part()
		{
			if($this->Session_Model->check_user_permission(43)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$festcode			=	$this->input->post('cmbFestType');
			$appeal              =   $this->prereport_model->appealed_part($festcode);
			//print_r($allot);
			$this->Contents['appeal']            = $appeal;
			$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
			//print_r($appeal);
			if(count($appeal)>0){
			$content=$this->load->view('report/prereportpdf/appealed_part',$this->Contents,true);
			
			 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			 $html2pdf->pdf->SetDisplayMode('fullpage');
			 $html2pdf->WriteHTML($content,'');
			 $html2pdf->Output('Appealed_participant.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			}
		}
	function appeal_courtorder()
	{
	
		$this->Contents=array();
		$this->template->write('title', '');
		$festcode			=	$this->input->post('cmbFestType');
		$appeal              =   $this->prereport_model->appeal_courtorder($festcode);
		//print_r($allot);
		$this->Contents['appeal']            = $appeal;
		$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
		//print_r($appeal);
		
		if(count($appeal)>0){
		$content=$this->load->view('report/prereportpdf/appeal_courtorder',$this->Contents,true);
	
	 	 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		 $html2pdf->pdf->SetDisplayMode('fullpage');
		 $html2pdf->WriteHTML($content,'');
		 $html2pdf->Output('Appeal_courtorder.pdf', 'I');
	}
	else{
		redirect('test/nodata');
	}
	}
	function no_value()
	{
		$this->load->view('report/prereportpdf/no_value');
	}
	
	function stagereport_abstract()
	{
			if($this->Session_Model->check_user_permission(31)==false){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				$this->Contents=array();
				$abstract            =   $this->prereport_model->stageallot_abstract();
			//	print_r($abstract);
			
				if(count($abstract)>0){
				
						 $this->Contents['abstract']            = $abstract;
						 $content=$this->load->view('report/prereportpdf/stageallot_abstract',$this->Contents,true);
						 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
						 $html2pdf->pdf->SetDisplayMode('fullpage');
						 $html2pdf->WriteHTML($content,'');
						 $html2pdf->Output('StageallotAbstract.pdf', 'I');
				 }	
	}
	function timesheet_date()
	{
	$this->Contents=array();
		$this->template->write('title', '');
		$date						=	$this->input->post('txtDate');
	  	$festival						=	$this->input->post('cmbFestType');
		$this->Contents['itemtime']= $this->prereport_model->timesheet_date($festival,$date);
		//$this->Contents['date']=$date;
		//$this->Contents['item_count']= $this->General_Model->get_record_count('participant_item_details',"item_code = '$itemcode' AND is_captain = 'Y'");
		
		$this->Contents['festname']= $this->prereport_model->Festname($festival);
		$content	=	$this->load->view('report/prereportpdf/timesheet_date',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Timesheet_date.pdf', 'I');
	}
	function list_school_with_team()
		{
			if($this->Session_Model->check_user_permission(27)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			$this->load->model('report/prereport_model');
			$school_details			=	$this->prereport_model->list_all_school_details();
			
			$this->Content['school_details']		= 	$school_details;
			
			$content	=	$this->load->view('report/prereportpdf/list_school_with_team',$this->Content,true);
			
			$html2pdf = new CI_HTML2PDF('L','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Participatingschools.pdf', 'I');
			
		}
		function datewisepart_school()
	{
		$this->Contents=array();
		$this->template->write('title', '');
	//	$itemcode						=	$this->input->post('cbo_item');
	  	//$festival						=	$this->input->post('cmbFestType');
		$date							=	$this->input->post('txtDate');
		//$this->Contents['date']			=	$date;
		if($date!='All'){
		
		$this->Contents['partdata']= $this->prereport_model->datewise_participants($date);
		//$this->Contents['itemdet']= $this->prereport_model->Eventname($itemcode);
		$lp=$this->prereport_model->lpstudents_date($date);
		$up=$this->prereport_model->upstudents_date($date);
		$hs=$this->prereport_model->hsstudents_date($date);
		$hss=$this->prereport_model->hssstudents_date($date);
		$school=$this->prereport_model->school_lpdetails();
		//print_r($lp);
		$this->Contents['lp']  =$lp;
		$this->Contents['up']  =$up;
		$this->Contents['hs']  =$hs;
		$this->Contents['hss']  =$hss;
		$this->Contents['school']  =$school;
		$this->Contents['date']=$date;
		
		$content	=	$this->load->view('report/prereportpdf/datewisepart_school',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('datewise_participant.pdf', 'I');
		}
		else {
		
		$this->Contents['partdata']= $this->prereport_model->datewise_participants($date);
		//$this->Contents['itemdet']= $this->prereport_model->Eventname($itemcode);
		$lp=$this->prereport_model->lpstudents();
		$up=$this->prereport_model->upstudents();
		$hs=$this->prereport_model->hsstudents();
		$hss=$this->prereport_model->hssstudents();
		$school=$this->prereport_model->school_lpdetails();
		$this->Contents['lp']  =$lp;
		$this->Contents['up']  =$up;
		$this->Contents['hs']  =$hs;
		$this->Contents['hss']  =$hss;
		$this->Contents['school']  =$school;
		$this->Contents['date']="";
		
		$content	=	$this->load->view('report/prereportpdf/datewisepart_school',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('datewise_participant.pdf', 'I');
		}
	}
	function eligible_result()
		{
			if($this->Session_Model->check_user_permission(8)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$fest=$this->input->post('cmbFestType');
			$item=$this->input->post('cbo_item');
			$retvalue  =$this->prereport_model->higherlevel_result($fest,$item);
			
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('report/prereportpdf/higherlevel_pdf',$this->Contents,true);
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
		function eligible_result_subdistrict()
		{
		
			$this->Contents=array();
			$Sub_dist=$this->input->post('cboSubDistCode');
			$retvalue  =$this->prereport_model->higherlevel_result_subdistrict($Sub_dist);
			
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('report/prereportpdf/higherlevel_subdistrict_pdf',$this->Contents,true);
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
		function consolidated_resultall()
		{
			$this->Contents=array();
			$retvalue  =$this->prereport_model->consolidated_resultall();
			$retdata  =$this->prereport_model->consolidated_result_boys();
			$retgirls  =$this->prereport_model->consolidated_result_girls();
			$retval  =$this->prereport_model->consolidated_total();
			$retboys_total  =$this->prereport_model->consolidated_boys_total();
			$retgirls_total =$this->prereport_model->consolidated_girls_total();
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			$this->Contents['retdata']=$retdata;
			$this->Contents['retval']=$retval;
			$this->Contents['retgirls']=$retgirls;
			$this->Contents['retboys_total']=$retboys_total;
			$this->Contents['retgirls_total']=$retgirls_total;
			
			$content	=	$this->load->view('report/prereportpdf/consolidated_resultall',$this->Contents,true);
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
			
			$retvalue  =$this->prereport_model->schoolhigher_result($school_code);
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('report/prereportpdf/schoolhigher_result',$this->Contents,true);
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
			$retvalue  =$this->prereport_model->schoolhigher_resultall();
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('report/prereportpdf/schoolhigher_result',$this->Contents,true);
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
    function four_reports()
	    	 {
			$this->Contents=array();
			$item_code=$this->input->post('item');
			$sql=mysql_query("select fest_id from item_master where item_code=$item_code");
			$fest=mysql_fetch_row($sql);
			//echo $fest[0];
			$call=$this->input->post('call');
			$time=$this->input->post('time');
			$tabulation=$this->input->post('tabulation');
			$score=$this->input->post('score');
			$participants=$this->input->post('participants');
			//echo $tabulation;
			//echo $time;
			if($call=='Call Sheet')
			{
			$fees_details		            =	$this->prereport_model->get_callsheet_details($item_code);
				$this->Content['fees_details']  =	$fees_details;
				$this->Content['subdistrict']     	=   $this->prereport_model->find_subdistrict();
				//print_r($fees_details);
				if(count($fees_details)>0){
				 $content	                    =	             $this->load->view('report/prereportpdf/callsheet_report',$this->Content,true);
				 
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('Callsheet.pdf', 'I');
			}
			}
			if($time=='Time Sheet')
			{
			$this->Contents=array();
				$this->template->write('title', '');
				//$itemcode						=	$this->input->post('cbo_item');
				//$festival						=	$this->input->post('cmbFestType');
				$this->Contents['itemtime']= $this->prereport_model->timesheet($item_code);
				
				$this->Contents['item_count']= $this->General_Model->get_record_count('participant_item_details',"item_code = '$item_code' AND is_captain = 'Y'");
				
				$this->Contents['festname']= $this->prereport_model->Festname($fest[0]);
				$content	=	$this->load->view('report/prereportpdf/timesheet',$this->Contents,true);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('Timesheet.pdf', 'I');
			}
			if($tabulation=='Tabulation Sheet')
			{
			$this->Contents=array();
			$this->template->write('title', '');
			//$itemcode						=	$this->input->post('item_code');
			//$festival						=	$this->input->post('$fest[0]');
			//$this->Contents['num']		    =	$this->input->post('txtParticipantNum');
			$retdata= $this->prereport_model->tabulation_details($item_code);
			$retdata1= $this->prereport_model->tabulation_fest_details($fest[0]);
			$this->Contents['retdata']=$retdata;
			$this->Contents['retdata1']=$retdata1;
			if(count($retdata)>0)
			{
					//$this->template->write_view('content', 'report/prereport/rpt_tabulation_sheet', $this->Contents);
			//$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($itemcode);
			$content	=	$this->load->view('report/prereport/rpt_tabulation_sheet_item',$this->Contents,true);
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Tabulation_sheet.pdf', 'I');
			$this->template->load();
			}
			}
			if($score=='Score Sheet')
			{
			$date= $this->prereport_model->fetch_item_name2($item_code);	
			if(count($date>0)){
			$this->Contents	=	array();	 	 
			
			$this->Contents['itemcode']	=	$item_code; 
			$this->Contents['start_time']	=	$date;		
			
			$content=$this->load->view('report/prereportpdf/rpt_scoresheet',$this->Contents,true);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content,'');
			$html2pdf->Output('scoresheet.pdf','I');
			}
			}
			if($participants=='Participant List')
			{
			$this->load->model('staticreport/Itemreports_Model');
		$this->Contents=array();
		$this->template->write('title', '');
	    $this->Contents['partdata']= $this->Itemreports_Model->itemwise_participants($item_code);
			$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($item_code);
			$this->Contents['festdet']= $this->Itemreports_Model->Festname($fest[0]);
			$content	=	$this->load->view('report/prereportpdf/rpt_itemwiseparticipants',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('itemwiseparticipants.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			
			}
			}
	    function list_participants_datewise()
		{
		$this->Content = array();
		$date=$_POST['txtDate'];
		//echo $date;	
		
		$partdata		            =	$this->prereport_model->list_participants_datewise($this->input->post('cmbFestType1'),$date);
		$this->Content['partdata']  =	$partdata;
		$this->Content['date']  =	$date;
		//echo $this->input->post('cmbFestType');
		//print_r($fees_details);
		$this->Content['subdistrict']     	=   $this->prereport_model->find_subdistrict();
		if(count($partdata)>0){
		 $content	                    =	             $this->load->view('report/prereportpdf/list_participants_datewise',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('List_of_Participants.pdf', 'I');
		} 
		else {
			redirect('test/nodata');
		}
	}
	function list_participants_stagewise()
		{
		$this->Content = array();
		$stage=$_POST['cmbstage'];
		//echo $date;	
		
		$partdata		            =	$this->prereport_model->list_participants_stagewise($this->input->post('txtDate'),$stage);
		$this->Content['partdata']  =	$partdata;
		$this->Content['stage']  =	$stage;
		//echo $this->input->post('cmbFestType');
		//print_r($fees_details);
		$this->Content['subdistrict']     	=   $this->prereport_model->find_subdistrict();
		if(count($partdata)>0){
		 $content	                    =	             $this->load->view('report/prereportpdf/list_participants_stagewise',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('List_of_Participants.pdf', 'I');
		} 
		else {
			redirect('test/nodata');
		}
	}
	function call_date_stage()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			
			$this->Contents				= array();
			$fees_details                = $this->prereport_model->call_date_stage(($this->input->post('txtDate')),($this->input->post('cmbstage')));
			$this->Contents['fees_details']		=	$fees_details;
			if(count($fees_details)>0){
			$content	                    =	     $this->load->view('report/prereportpdf/call_date_stage',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Call_sheet.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			}
			}
			function time_date_stage()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			
			$this->Contents				= array();
			$itemtime                = $this->prereport_model->time_date_stage(($this->input->post('txtDate')),($this->input->post('cmbstage')));
			$this->Contents['itemtime']		=	$itemtime;
			if(count($itemtime)>0){
			$content	                    =	     $this->load->view('report/prereportpdf/time_date_stage',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Time_sheet.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			}
			}
			 function score_date_stage()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			
			$this->Contents				= array();
			$fest_details                = $this->prereport_model->score_date_stage(($this->input->post('txtDate')),($this->input->post('cmbstage')));
			$this->Contents['fest_details']		=	$fest_details;
			if(count($fest_details)>0){
			$content	                    =	     $this->load->view('report/prereportpdf/rpt_fest_scoresheet',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('score_sheet.pdf', 'I');
			
			}
			else {
				redirect('test/nodata');
			}
			}
			  function tabulation_date_stage()
		{
		 	if($this->Session_Model->check_user_permission(38)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			
			$this->Contents				= array();
			$retvalue                = $this->prereport_model->tabulation_date_stage(($this->input->post('txtDate')),($this->input->post('cmbstage')));
			$this->Contents['retvalue']		=	$retvalue;
			if(count($retvalue)>0){
			$content	                    =	     $this->load->view('report/prereportpdf/tabulation_date_stage',$this->Contents,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('tabulation.pdf', 'I');
			
			}
			else {
				redirect('test/nodata');
			}
			}
			
			function participant_cardindex_school2()
			{
				if($this->Session_Model->check_user_permission(33)==false){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				$this->Content = array();
				//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
				$participant_details		=	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'));
				$this->Content['participant_details']  =	$participant_details;
				//print_r($fees_details);
					
				if(count($participant_details)>0){
						
					$content	                    =	             $this->load->view('report/prereportpdf/participation_cardstate_single_withoutphoto_middle',$this->Content,true);
			
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('participantcard.pdf', 'I');
				}
				else {
					redirect('test/nodata');
				}
					
			}

			function participant_regnowithphoto()
			{
			
				$this->Content = array();
				$partcard		            =	$this->prereport_model->get_participant_regno($this->input->post('regno'));
				$this->Content['partcard']  =	$partcard;
				if(count($partcard)>0){
			
					$content	                    =	  $this->load->view('report/prereportpdf/participant_state_regno_middle',$this->Content,true);
						
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('participantcard.pdf', 'I');
				}
				else {
					redirect('test/nodata');
				}
			}
			
			function participant_cardindex_photo_middle()
			{
			
					if($this->Session_Model->check_user_permission(33)==false){
						$this->template->write('error', permission_warning());
						$this->template->load();
						return;
					}
					$this->Content = array();
					//	$partcard		            =	$this->prereport_model->get_participant_card($this->input->post('txtSchoolCode'));
					//$participant_details		=	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'));
					$participant_details		=	$this->prereport_model->get_participant_details_sub_dist($this->input->post('cboSubDistCode'));
					//var_dump($participant_details);
					$this->Content['participant_details']  =	$participant_details;
					//print_r($fees_details);
					$DataReturn1['participant_det']  =	$participant_details;
					//print_r($this->Content['participant_details']);
						
						
					if(count($participant_details)>0){
							
						$this->Content['Photo']			=	$this->Photos_Model->get_subdistwise_Photo($DataReturn1);
						$content	                    =	             $this->load->view('report/prereportpdf/participant_sub_middle',$this->Content,true);
			
						$html2pdf = new CI_HTML2PDF('P','A4', 'en');
						$html2pdf->pdf->SetDisplayMode('fullpage');
						$html2pdf->WriteHTML($content, '');
						$html2pdf->Output('participantcard.pdf', 'I');
					}
					else {
						redirect('test/nodata');
					}
				
				
			}
}
 ?>