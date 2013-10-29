<?php
class Item_Participant extends Controller {

	function Item_Participant()
	{
		parent::Controller(); 
		$this->template->add_js('js/stages.js');	
		$this->load->model('stages/Participant_Model');
		$this->load->model('stages/Allotment_Model');
		$this->template->write_view('menu', 'menu', '');
		$this->Session_Model->is_user_logged();
		$this->Session_Model->check_user_permission('1');
	}
	function participant_nodetails($message = '')
	{
		 $this->Contents				=	array();
		 $fest= $this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
				 
		  $this->Contents['fest']		=	$fest;
		  
		  $fest_id	=	($this->input->post('cmbFestType')) ?  $this->input->post('cmbFestType') : (($this->input->post('txtFestId')) ? $this->input->post('txtFestId') : '') ;
		  $this->Contents['fest_id']         =     $fest_id;
		  $this->template->write_view('content', 'stage/participant_nodetails', $this->Contents);	
			if($fest_id){
				
				$this->Contents	= array();
				 $this->Contents['fest']		=	$this->General_Model->get_data('festival_master','fest_name',array('fest_id' => $fest_id));
				 $itempart			=	$this->Participant_Model->get_item_participant($fest_id);
				 $single            =   $this->Participant_Model->get_item_participant_single($fest_id);
				
				 $this->Contents['itempart']		= 	 $itempart;
				 $this->Contents['single']          =     $single;
				 

			 
					 if(count($itempart)>0 or count($single)>0){
					 	$this->Contents['date_array']		=	$this->General_Model->get_fest_date_array();
						$this->Contents['hour_array']		=	$this->General_Model->get_hour_array(false);
						$this->Contents['min_array']		=	$this->General_Model->get_min_array(false);
						$this->Contents['stages']			=	$this->Allotment_Model->get_stages();
						$this->Contents['no_of_clusters']	=	$this->General_Model->get_settings(1);
						$this->Contents['interval_bw_items']	=	$this->General_Model->get_settings(2);
						$this->Contents['no_of_judges']		=	$this->General_Model->get_settings(3);
						$this->template->write_view('content','stage/item_allot_details',$this->Contents);
						//$this->template->write_view('content','stage/participant_details',$this->Contents);
			 		 }
			 	 }
			$this->template->load();
		}
		
	function stage_allot_fest_all()
	{
		$this->load->model('stages/Allotmentfest_Model');
		$fest_id		=	$this->input->post('txtFestId');
		
		if ($fest_id)
		{
			$this->Allotmentfest_Model->update_allotment($fest_id);
		}
		$this->participant_nodetails();
	}
}