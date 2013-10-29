<?php
class Export_Model extends Model
{
	function Export_Model(){
		parent::Model();
	}
	function get_sub_dist_school_export_data ()
	{
		
		$data_data_array				=	array();
		$curr_date						=	time();
		$encr_date						=	get_encr_password($curr_date);
		$date_data_array[0]['date']		=	$curr_date;
		$date_data_array[0]['encr_date']=	$encr_date;
		
		// total rows count leaving the titles
		$total_row_count				=	0;
		
		$sub_district_code				=	$this->session->userdata('SUB_DISTRICT');
		$this->db->where('sub_district_code',$sub_district_code);
		$school_master					=	$this->db->get('school_master');
		$school_master					=	$school_master->result_array();
		$school_master_data				= array ();
		$i								= 0;		
		$school_master_data[$i]['title']=	'SM_DETAILS';		
		
		if (isset($school_master) && count($school_master) > 0)
		{
			foreach ($school_master as $key => $school_master)
			{
				$i++;
				$school_master_data[$i]['school_code']				= trim($school_master['school_code']);
				$school_master_data[$i]['sub_district_code']		= trim($school_master['sub_district_code']);
				$school_master_data[$i]['edu_district_code']		= trim($school_master['edu_district_code']);
				$school_master_data[$i]['rev_district_code']		= trim($school_master['rev_district_code']);
				$school_master_data[$i]['school_name']				= str_replace(',',' ',trim($school_master['school_name']));
				$school_master_data[$i]['school_type']				= trim($school_master['school_type']);
				$school_master_data[$i]['master_confirm']			= trim($school_master['master_confirm']);
				$school_master_data[$i]['school_status']			= trim($school_master['school_status']);
				$school_master_data[$i]['school_master_encr_code']	= get_encr_password(trim($school_master['school_code']).
																			trim($school_master['sub_district_code']).
																			trim($school_master['rev_district_code']).
																			trim($school_master['school_type']));
				$total_row_count++;
			}
		}
	
		$this->db->where('SM.sub_district_code',$sub_district_code);
		$this->db->join('school_master AS SM','SD.school_code = SM.school_code');
		$school_details						= $this->db->get('school_details AS SD');
		$school_details						= $school_details->result_array();
		$school_details_data				= array ();
		$i									= 0;
		$school_details_data[$i]['title']	= 'SD_DETAILS';
		
		if (isset($school_details) && count($school_details) > 0)
		{
			foreach ($school_details as $key => $school_details)
			{
				$i++;
				$school_details_data[$i]['school_code']					= trim($school_details['school_code']);
				$school_details_data[$i]['class_start']					= trim($school_details['class_start']);
				$school_details_data[$i]['class_end']					= trim($school_details['class_end']);
				$school_details_data[$i]['school_phone']				= trim($school_details['school_phone']);
				$school_details_data[$i]['school_email']				= trim($school_details['school_email']);
				$school_details_data[$i]['hm_name']						= str_replace(',',' ',trim($school_details['hm_name']));
				$school_details_data[$i]['hm_phone']					= trim($school_details['hm_phone']);
				$school_details_data[$i]['principal_name']				= str_replace(',',' ',trim($school_details['principal_name']));
				$school_details_data[$i]['principal_phone']				= trim($school_details['principal_phone']);
				$school_details_data[$i]['teachers']					= str_replace(',',' ',trim($school_details['teachers']));
				$school_details_data[$i]['strength_lp']					= trim($school_details['strength_lp']);
				$school_details_data[$i]['strength_up']					= trim($school_details['strength_up']);
				$school_details_data[$i]['strength_hs']					= trim($school_details['strength_hs']);
				$school_details_data[$i]['strength_hss']				= trim($school_details['strength_hss']);
				$school_details_data[$i]['strength_vhss']				= trim($school_details['strength_vhss']);
				$school_details_data[$i]['total_strength']				= trim($school_details['total_strength']);
				$school_details_data[$i]['is_create_report']			= trim($school_details['is_create_report']);
				$school_details_data[$i]['is_finalize']					= trim($school_details['is_finalize']);
				$school_details_data[$i]['school_details_encr_code']	= get_encr_password(trim($school_details['school_code']).
																				trim($school_details['class_start']).
																				trim($school_details['class_end']).
																				trim($school_details['total_strength']));
				$total_row_count++;																
					
			}
		}
		
		$this->db->where('sub_district_code',$sub_district_code);
		$participant_details					= $this->db->get('participant_details');
		$participant_details					= $participant_details->result_array();
		$participant_details_data				= array ();
		$i										= 0;
		$participant_details_data[$i]['title']	= 'PD_DETAILS';
		
		if (isset($participant_details) && count($participant_details) > 0)
		{
			foreach ($participant_details as $key => $participant_details)
			{
				$i++;
				$participant_details_data[$i]['participant_id']					= trim($participant_details['participant_id']);
				$participant_details_data[$i]['school_code']					= trim($participant_details['school_code']);
				$participant_details_data[$i]['sub_district_code']				= trim($participant_details['sub_district_code']);
				$participant_details_data[$i]['admn_no']						= str_replace(' ','',trim($participant_details['admn_no']));
				$participant_details_data[$i]['participant_name']				= str_replace(',',' ',trim($participant_details['participant_name']));
				$participant_details_data[$i]['class']							= trim($participant_details['class']);
				$participant_details_data[$i]['gender']							= trim($participant_details['gender']);
				$participant_details_data[$i]['participant_details_encr_code']	= get_encr_password(trim($participant_details['participant_id']).
																						trim($participant_details['school_code']).
																						trim($participant_details['sub_district_code']).
																						str_replace(' ','',trim($participant_details['admn_no'])).
																						trim($participant_details['class']).
																						trim($participant_details['gender']));
				$total_row_count++;
			}
		}
		
		$this->db->where('PM.sub_district_code',$sub_district_code);
		$this->db->join('participant_details AS PM','PM.school_code = PD.school_code AND PM.admn_no = PD.admn_no');
		$this->db->select('PD.*');
		$participant_item_details					= $this->db->get('participant_item_details AS PD');
		$participant_item_details					= $participant_item_details->result_array();
		$participant_item_details_data				= array ();
		$i											= 0;
		$participant_item_details_data[$i]['title']	= 'PID_DETAILS';
		
		if (isset($participant_item_details) && count($participant_item_details) > 0)
		{
			foreach ($participant_item_details as $key => $participant_item_details)
			{
				$i++;
				$participant_item_details_data[$i]['participant_id']				= trim($participant_item_details['participant_id']);
				$participant_item_details_data[$i]['school_code']					= trim($participant_item_details['school_code']);
				$participant_item_details_data[$i]['admn_no']						= str_replace(' ','',trim($participant_item_details['admn_no']));
				$participant_item_details_data[$i]['parent_admn_no']				= str_replace(' ','',trim($participant_item_details['parent_admn_no']));
				$participant_item_details_data[$i]['item_code']						= trim($participant_item_details['item_code']);
				$participant_item_details_data[$i]['item_type']						= trim($participant_item_details['item_type']);
				$participant_item_details_data[$i]['spo_id']						= trim($participant_item_details['spo_id']);
				$participant_item_details_data[$i]['spo_remarks']					= trim($participant_item_details['spo_remarks']);
				$participant_item_details_data[$i]['is_captain']					= trim($participant_item_details['is_captain']);
				$participant_item_details_data[$i]['participant_item_encr_code']	= get_encr_password(trim($participant_item_details['participant_id']).
																							trim($participant_item_details['school_code']).
																							str_replace(' ','',trim($participant_item_details['admn_no'])).
																							str_replace(' ','',trim($participant_item_details['parent_admn_no'])).
																							trim($participant_item_details['item_code']).
																							trim($participant_item_details['spo_id']).
																							trim($participant_item_details['is_captain']));
				$total_row_count++;
			}
			
		}
		
		$sub_district_data	= array(0 => array('sub_district_code' => $this->session->userdata('SUB_DISTRICT'),
												'total_row_count' => $total_row_count,
												'encr_sub_district_data' => get_encr_password(trim($this->session->userdata('SUB_DISTRICT')).$total_row_count)
												) );
		
		$export_array		=	array();
		$export_array		=	array_merge($export_array, $sub_district_data, $date_data_array, $school_master_data, $school_details_data, $participant_details_data, $participant_item_details_data);
		return $export_array;
	}
	
	function get_district_export_data()
	{
		$data_data_array				=	array();
		$curr_date						=	time();
		$encr_date						=	get_encr_password($curr_date);
		$date_data_array[0]['date']		=	$curr_date;
		$date_data_array[0]['encr_date']=	$encr_date;
		
		// total rows count leaving the titles
		$total_row_count				=	0;
		
		$sub_district_code				=	$this->session->userdata('SUB_DISTRICT');
		$i								= 0;	

		$this->db->select('pd.*, pid.*, rp.is_withheld');
		$this->db->from('result_publish rp');
		$this->db->join('result_master rm', 'rm.participant_id=rp.participant_id AND rp.item_code=rm.item_code');
		$this->db->join('participant_item_details pid', 'pid.parent_admn_no=rm.admn_no AND pid.school_code=rm.school_code AND rp.item_code=pid.item_code');		
		$this->db->join('participant_details pd', 'pid.participant_id=pd.participant_id');
		$this->db->where('pd.sub_district_code', $sub_district_code);
		$this->db->order_by('pid.participant_id', 'ASC');
		$this->db->where('rp.grade', 'A');
		$this->db->where('rp.is_withheld', 'N');
		$this->db->where('pd.class >', 4);
		
		$participant_all_details			= $this->db->get();
		$participant_all_details			= $participant_all_details->result_array();
		
		$participant_details_data			= array();
		$participant_item_details_data		= array();
		if (is_array($participant_all_details) && count($participant_all_details) > 0)
		{
			$j = 0;
			$participant_item_details_data[$j]['title']	= 'PID_DETAILS';
			$check_participant							= array();
			$k = 0;
			$participant_details_data[$k]['title'] 		= 'PD_DETAILS';
			foreach ($participant_all_details as $key => $participant_all_details)
			{
				$j++;
				
				if (!in_array($participant_all_details['participant_id'],$check_participant))
				{
					$k++;
					//$participant_details_data[$k]['participant_id']		= $participant_all_details['participant_id'];
					$participant_details_data[$k]['school_code']		= trim($participant_all_details['school_code']);
					$participant_details_data[$k]['sub_district_code']	= trim($participant_all_details['sub_district_code']);
					$participant_details_data[$k]['admn_no']			= str_replace(' ','',trim($participant_all_details['admn_no']));
					$participant_details_data[$k]['participant_name']	= str_replace(',',' ',trim($participant_all_details['participant_name']));
					$participant_details_data[$k]['class']				= trim($participant_all_details['class']);
					$participant_details_data[$k]['gender']				= trim($participant_all_details['gender']);
					$participant_details_data[$k]['encr_code']			= get_encr_password(
																					trim($participant_all_details['school_code']).
																					trim($participant_all_details['sub_district_code']).
																					str_replace(' ','',trim($participant_all_details['admn_no'])).																					
																					trim($participant_all_details['class']).
																					trim($participant_all_details['gender']));
					$check_participant[]								= $participant_all_details['participant_id'];
				}
				
				//$participant_item_details_data[$j]['participant_id']					= $participant_all_details['participant_id'];
				$participant_item_details_data[$j]['school_code']						= trim($participant_all_details['school_code']);
				$participant_item_details_data[$j]['admn_no']							= str_replace(' ','',trim($participant_all_details['admn_no']));
				$participant_item_details_data[$j]['parent_admn_no']					= str_replace(' ','',trim($participant_all_details['parent_admn_no']));
				$participant_item_details_data[$j]['item_code']							= trim($participant_all_details['item_code']);
				$participant_item_details_data[$j]['item_type']							= trim($participant_all_details['item_type']);
				$participant_item_details_data[$j]['is_captain']						= trim($participant_all_details['is_captain']);
				$participant_item_details_data[$j]['encr']= get_encr_password(
																				trim($participant_all_details['school_code']).
																				str_replace(' ','',trim($participant_all_details['admn_no'])).
																				str_replace(' ','',trim($participant_all_details['parent_admn_no'])).
																				trim($participant_all_details['item_code']).
																				trim($participant_all_details['item_type']).
																				trim($participant_all_details['is_captain']));
				
			}
		}

		$total_row_count	= count($participant_details_data)+count($participant_item_details_data);
		$total_row_count	= ($total_row_count >0) ? $total_row_count-2:$total_row_count;
		
		$sub_district_data	= array(0 => array('district_code' => $this->session->userdata('DISTRICT'),
												'sub_district_code' => $this->session->userdata('SUB_DISTRICT'),
												'total_row_count' => $total_row_count,
												'encr_sub_district_data' => get_encr_password(trim($this->session->userdata('DISTRICT')).trim($this->session->userdata('SUB_DISTRICT')).$total_row_count)
												) );
		
		$export_array		=	array();
		$export_array		=	array_merge($export_array, $sub_district_data, $date_data_array,  $participant_details_data, $participant_item_details_data);
		return $export_array;
	}
	
	
	function get_state_export_data()
	{
		$data_data_array				=	array();
		$curr_date						=	time();
		$encr_date						=	get_encr_password($curr_date);
		$date_data_array[0]['date']		=	$curr_date;
		$date_data_array[0]['encr_date']=	$encr_date;
		
		// total rows count leaving the titles
		$total_row_count				=	0;
		
		$district_code				=	$this->session->userdata('DISTRICT');
		$i								= 0;	

		$this->db->select('pd.*, pid.*, rp.is_withheld');
		$this->db->from('result_publish rp');
		$this->db->join('result_master rm', 'rm.participant_id=rp.participant_id AND rp.item_code=rm.item_code');
		$this->db->join('participant_item_details pid', 'pid.parent_admn_no=rm.admn_no AND pid.school_code=rm.school_code AND rp.item_code=pid.item_code');		
		$this->db->join('participant_details pd', 'pid.participant_id=pd.participant_id');
		//$this->db->where('pd.sub_district_code', $sub_district_code);
		$this->db->order_by('pid.participant_id', 'ASC');
		$this->db->where('rp.grade', 'A');
		$this->db->where('rp.is_withheld', 'N');
		$this->db->where('pd.class >', 7);
		
		$participant_all_details			= $this->db->get();
		$participant_all_details			= $participant_all_details->result_array();
		
		$participant_details_data			= array();
		$participant_item_details_data		= array();
		if (is_array($participant_all_details) && count($participant_all_details) > 0)
		{
			$j = 0;
			$participant_item_details_data[$j]['title']	= 'PID_DETAILS';
			$check_participant							= array();
			$k = 0;
			$participant_details_data[$k]['title'] 		= 'PD_DETAILS';
			foreach ($participant_all_details as $key => $participant_all_details)
			{
				$j++;
				
				if (!in_array($participant_all_details['participant_id'],$check_participant))
				{
					$k++;
					//$participant_details_data[$k]['participant_id']		= $participant_all_details['participant_id'];
					$participant_details_data[$k]['school_code']		= trim($participant_all_details['school_code']);
					$participant_details_data[$k]['sub_district_code']	= trim($participant_all_details['sub_district_code']);
					$participant_details_data[$k]['admn_no']			= str_replace(' ','',trim($participant_all_details['admn_no']));
					$participant_details_data[$k]['participant_name']	= str_replace(',',' ',trim($participant_all_details['participant_name']));
					$participant_details_data[$k]['class']				= trim($participant_all_details['class']);
					$participant_details_data[$k]['gender']				= trim($participant_all_details['gender']);
					$participant_details_data[$k]['encr_code']			= get_encr_password(
																					trim($participant_all_details['school_code']).
																					trim($participant_all_details['sub_district_code']).
																					str_replace(' ','',trim($participant_all_details['admn_no'])).																					
																					trim($participant_all_details['class']).
																					trim($participant_all_details['gender']));
					$check_participant[]								= $participant_all_details['participant_id'];
				}
				
				//$participant_item_details_data[$j]['participant_id']					= $participant_all_details['participant_id'];
				$participant_item_details_data[$j]['school_code']						= trim($participant_all_details['school_code']);
				$participant_item_details_data[$j]['admn_no']							= str_replace(' ','',trim($participant_all_details['admn_no']));
				$participant_item_details_data[$j]['parent_admn_no']					= str_replace(' ','',trim($participant_all_details['parent_admn_no']));
				$participant_item_details_data[$j]['item_code']							= trim($participant_all_details['item_code']);
				$participant_item_details_data[$j]['item_type']							= trim($participant_all_details['item_type']);
				$participant_item_details_data[$j]['is_captain']						= trim($participant_all_details['is_captain']);
				$participant_item_details_data[$j]['encr']= get_encr_password(
																				trim($participant_all_details['school_code']).
																				str_replace(' ','',trim($participant_all_details['admn_no'])).
																				str_replace(' ','',trim($participant_all_details['parent_admn_no'])).
																				trim($participant_all_details['item_code']).
																				trim($participant_all_details['item_type']).
																				trim($participant_all_details['is_captain']));
				
			}
		}

		$total_row_count	= count($participant_details_data)+count($participant_item_details_data);
		$total_row_count	= ($total_row_count >0) ? $total_row_count-2:$total_row_count;
		
		$district_data		= array(0 => array('district_code' => $this->session->userdata('DISTRICT'),
												'total_row_count' => $total_row_count,
												'encr_district_data' => get_encr_password(trim($this->session->userdata('DISTRICT')).$total_row_count)
												) );
		
		$export_array		=	array();
		$export_array		=	array_merge($export_array, $district_data, $date_data_array,  $participant_details_data, $participant_item_details_data);
		return $export_array;
	}

}
?>