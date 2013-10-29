<?php
class Registration_Report_Model extends Model{
	function Registration_Report_Model(){
		parent::Model();
	}
	
	function get_school_details($school_code)
	{
		$this->db->where('SM.school_code',$school_code);
		$this->db->from('school_master AS SM');
		$this->db->join('sub_district_master AS SB','SB.sub_district_code = SM.sub_district_code');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code','LEFT');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function get_participant_details($school_code)
	{
		$this->db->where('PD.school_code',$school_code);
		$this->db->from('participant_details AS PD');
		$this->db->join('participant_item_details AS PI','PD.school_code = PI.school_code AND PD.admn_no = PI.admn_no','LEFT');
		$this->db->select('PI.*,PD.participant_name,PD.admn_no,PD.gender,PD.class');
		$participant_details		=	$this->db->get();
		$participant_array			=	array();
		$count						=	-1;
		$prev_admn_no				=	'';
		foreach($participant_details->result_array() as $details)
		{
			if ($prev_admn_no != $details['admn_no'])
			{			
				$count++;
				$prev_admn_no = $details['admn_no'];
				$participant_array[$count]['admn_no']			=	$details['admn_no'];
				$participant_array[$count]['participant_name']	=	$details['participant_name'];
				$participant_array[$count]['class']				=	$details['class'];
				$participant_array[$count]['gender']			=	$details['gender'];
			}
			if ($details['item_type'] == 'G' and $details['is_captain'] == 'Y')
			{
				$details['item_code']	.=	'(C)';
			}
			else if ($details['item_type'] == 'P')
			{
				$details['item_code']	.=	'(P)';
			}
			$participant_array[$count]['item_code'][]			=	$details['item_code'];	
		}
		return $participant_array;
	}
	
	function get_fees_details($school_code)
	{
		$this->db->where('school_code',$school_code);
		$school_details		=	$this->db->get('school_details');
		$up_fee				=	0;
		$hs_fee				=	0;
		$hss_fee			=	0;
		$vhss_fee			=	0;
		if ($school_details->num_rows() > 0)
		{
			$school				=	$school_details->row();
			if ($school->class_end > 5)
			{
				if ((int)$school->strength_up > 0)
				{
					$this->db->where('school_code',$school_code);
					$this->db->where('class >= 5');
					$this->db->where('class <= 7');					
					$cnt_participants		=	$this->db->count_all_results('participant_details');
					
					
					$up_fee					=	$this->get_fee_div('UP',(int)$school->strength_up,(int)$cnt_participants);
				}
				if ((int)$school->strength_hs > 0)
				{
					$this->db->where('school_code',$school_code);
					$this->db->where('class >= 8');
					$this->db->where('class <= 10');					
					$cnt_participants		=	$this->db->count_all_results('participant_details');
					
					$hs_fee				=	$this->get_fee_div('HS',(int)$school->strength_hs,(int)$cnt_participants);
				}
				if ((int)$school->strength_hss > 0)
				{
					$hss_fee				=	$this->get_fee_div('HSS',(int)$school->strength_hss,(int)$school->strength_hss);
				}
				if ((int)$school->strength_vhss > 0)
				{
					$vhss_fee				=	$this->get_fee_div('VHSS',(int)$school->strength_vhss,(int)$school->strength_vhss);
				}
				
			}
		}
		//print_r($hs_fee);
				
		$return_array['up_fee']		=	$up_fee;
		$return_array['hs_fee']		=	$hs_fee;
	 	$return_array['hss_fee']	=	$hss_fee;
		$return_array['vhss_fee']	=	$vhss_fee;
		return $return_array;
	}
	
	function get_fee_div($div,$no_studts,$no_participant)
	{
		$this->db->where('fee_class',$div);
		$this->db->where('min_students < ',$no_studts);
		$this->db->where('max_students >=',$no_studts);
		$fees_master		=	$this->db->get('fees_master');
		$fee_struct		=	$fees_master->result_array();
		$fee['afliation']				=	$fee_struct[0]['fees'];
		$fee['participant']				=	($no_participant * 5);
		return $fee;
	}
	
	function set_school_details_take_report($school_code)
	{
		$this->db->where('school_code',$school_code);
		$data						=	array();
		$data['is_create_report']	=	'Y';
		$this->db->update('school_details',$data);
		
		$data					=	array();
		$data['school_code']	=	$school_code;
		$data['status']			=	'R';
		$data['ip']				=	$this->input->ip_address();
		$data['user_id']		=	$this->session->userdata('USERID');
		$this->db->insert('z_school_confirm_log',$data);
	}
	
}

?>