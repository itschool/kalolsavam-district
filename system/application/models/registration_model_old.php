<?php
class Registration_Model extends Model{
	function Registration_Model(){
		parent::Model();
	}
	
	function get_school_details($schoolCode){
			
		if(trim($this->session->userdata('SUB_DISTRICT')) != 0)
			$this->db->where('SM.sub_district_code', trim($this->session->userdata('SUB_DISTRICT')));
			
		if(trim($this->session->userdata('DISTRICT')) != 0)
			$this->db->where('SM.rev_district_code', trim($this->session->userdata('DISTRICT')));
		
		$this->db->where('SM.school_code',$schoolCode);
		$this->db->from('school_master AS SM');
		
		/** check if the user is cluster user*/
		if(trim($this->session->userdata('USER_TYPE')) == 5) {
			$this->db->join('user_cluster AS UC','SM.school_code = UC.school_code','INNER');
			$this->db->where('UC.user_id', trim($this->session->userdata('USERID')));
		}
		/** check if the user is cluster user ends*/
		
		$this->db->select('SM.*, sd_id, class_start, class_end, school_phone, school_email, hm_name, hm_phone, principal_name, principal_phone, 
										teachers, strength_lp, strength_up, strength_hs, strength_hss, strength_vhss, total_strength, is_create_report, is_finalize');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code','LEFT');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function get_participant_details($schoolCode) {
		$this->db->where('PD.school_code',$schoolCode);
		$this->db->from('participant_details AS PD');
		$this->db->select('PD.*');
		//$this->db->join('participant_item_details AS ID','PD.participant_id = ID.participant_id','RIGHT');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function get_group_details($schoolCode)
	{
		/*if(isset($_POST['code']) && trim($_POST['code']) != ''){
			$schoolCode = $_POST['code'];
		} else {
			$schoolCode	=	$this->input->post('hidSchoolId');
		}*/
		$this->db->where('PD.school_code',$schoolCode);
		$this->db->where('PD.item_type','G');
		$this->db->from('participant_item_details AS PD');
		$this->db->join('item_master AS IM','PD.item_code = IM.item_code');
		$this->db->select('IM.item_code,IM.item_name,PD.admn_no');
		$this->db->group_by('PD.item_code');
		$group_items	=	$this->db->get();
		if ($group_items->num_rows() > 0)
		{
			$participants_array			=	array();
			$group_leader				=	array();
			$group_array				=	$group_items->result_array();
			foreach($group_array as $groups)
			{
				$group_leader[$groups['item_code']]		=	0;
				$this->db->where('PD.school_code',$schoolCode);
				$this->db->where('PD.item_type','G');
				$this->db->where('PD.item_code',$groups['item_code']);
				$this->db->from('participant_item_details AS PD');
				$this->db->join('participant_details AS PM','PM.school_code = PD.school_code AND PM.admn_no = PD.admn_no');
				$this->db->select("PM.admn_no,PM.participant_name,PD.is_captain");
				$participant_details	=	$this->db->get();
				
				//$participants_array[$groups['item_code']][0]		=	"-- Select Captain --";	
				foreach($participant_details->result_array() as $participant)
				{
					if ($participant['is_captain'] == 'Y')
					{
						$group_leader[$groups['item_code']]		=	$participant['admn_no'];	
					}
					$participants_array[$groups['item_code']][$participant['admn_no']]		=	$participant['participant_name'].'('.$participant['admn_no'].')';
				}
			}
			$return_array['group_array']				=	$group_array;
			$return_array['group_leader']				=	$group_leader;
			$return_array['group_participant_array']	=	$participants_array;
			return $return_array;
		}
		return false;
	}
	
	
	function get_participant_item_details($id, $adno,$item_type = '',$is_special = '') { /// C means Common for both Single and Group P for Pinnany
		if (trim($item_type) != '')
		{
			if (trim($item_type) == 'C')
			{
				$this->db->where("(PD.item_type = 'S' or PD.item_type = 'G')");
			}
			else
			{
				$this->db->where('PD.item_type',trim($item_type));
			}
		}
		if(isset($_POST['code']) && trim($_POST['code']) != ''){
			$schoolCode = $_POST['code'];
		} else {
			$schoolCode	=	$this->input->post('hidSchoolId');
		}
		if ($is_special == 'N')
		{
			$this->db->where('PD.spo_id','0');
		}
		$this->db->where('PD.school_code',$schoolCode);
		$this->db->where('PD.participant_id',$id);
		$this->db->where('PD.admn_no',$adno);
		$this->db->from('participant_item_details AS PD');
		$this->db->join('item_master AS IM','IM.item_code = PD.item_code');
		$this->db->select('PD.*,IM.item_name');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
		
	function log_school_details($schoolCode,$status)
	{
		$this->db->where('school_code',$schoolCode);
		$school_details		=	$this->db->get('school_details');
		if ($school_details->num_rows() > 0)
		{
			$school				=	$school_details->result_array();
			
			$data						=	array();
			$data['school_code']		=	$school[0]['school_code'];	
			$data['class_start']		=	$school[0]['class_start'];
			$data['class_end']			=	$school[0]['class_end'];
			$data['school_phone']		=	$school[0]['school_phone'];
			$data['hm_name']			=	$school[0]['hm_name'];
			$data['hm_phone']			=	$school[0]['hm_phone'];
			$data['principal_name']		=	$school[0]['principal_name'];
			$data['principal_phone']	=	$school[0]['principal_phone'];
			$data['teachers']			=	$school[0]['teachers'];
			$data['strength_lp']		=	$school[0]['strength_lp'];
			$data['strength_up']		=	$school[0]['strength_up'];
			$data['strength_hs']		=	$school[0]['strength_hs'];	
			$data['strength_hss']		=	$school[0]['strength_hss'];	
			$data['strength_vhss']		=	$school[0]['strength_vhss'];	
			$data['total_strength']		=	$school[0]['total_strength'];
			$data['ip']					=	$this->input->ip_address();
			$data['user_id']			=	$this->session->userdata('USERID');
			$data['status']				=	$status;
			
			$this->db->insert('z_school_details_log',$data);
		}
	}
	
	
	function log_participant_details($schoolCode,$admnNo,$status)
	{
		$this->db->where('school_code',$schoolCode );
		$this->db->where('admn_no', $admnNo);
		$participant_details	=	$this->db->get('participant_details');
		if ($participant_details->num_rows() > 0)
		{
			$participant	=	$participant_details->result_array();			
			$data						=	array();
			$data['participant_id']		=	$participant[0]['participant_id'];
			$data['school_code']		=	$participant[0]['school_code'];
			$data['admn_no']			=	$participant[0]['admn_no'];
			$data['participant_name']	=	$participant[0]['participant_name'];
			$data['class']				=	$participant[0]['class'];
			$data['gender']				=	$participant[0]['gender'];
			
			$data['ip']					=	$this->input->ip_address();
			$data['user_id']			=	$this->session->userdata('USERID');
			$data['status']				=	$status;
			
			$this->db->insert('z_participant_details_log',$data);
		}
		
		$this->db->where('school_code',$schoolCode );
		$this->db->where('admn_no', $admnNo);
		$participant_item_details	=	$this->db->get('participant_item_details');
		foreach($participant_item_details->result_array() as $participant_item)
		{
			$data 	=	array();
			$data['pi_id']				=	$participant_item['pi_id'];
			$data['participant_id']		=	$participant_item['participant_id'];
			$data['school_code']		=	$participant_item['school_code'];
			$data['admn_no']			=	$participant_item['admn_no'];
			$data['parent_admn_no']		=	$participant_item['parent_admn_no'];
			$data['item_code']			=	$participant_item['item_code'];
			$data['item_type']			=	$participant_item['item_type'];
			$data['spo_id']				=	$participant_item['spo_id'];
			$data['spo_remarks']		=	$participant_item['spo_remarks'];			
			$data['is_captain']			=	$participant_item['is_captain'];
			$data['ip']					=	$this->input->ip_address();
			$data['user_id']			=	$this->session->userdata('USERID');
			$data['status']				=	$status;
			
			$this->db->insert('z_participant_item_details_log',$data);
			
		}
		
	}
	
	
	function save_school_details(){
		$schoolCode	=	$this->input->post('hidSchoolId');
		
		$this->db->where('school_code',$schoolCode);
		$old_school_details		=	$this->db->get('school_details');
		if ($old_school_details->num_rows() > 0)
		{
			$this->log_school_details($schoolCode,'O');
		}
		
		
		$this->db->where('school_code',$schoolCode);
		$this->db->where("(class < '".(int)$this->input->post('txtStandardFrom')."' OR class > '".(int)$this->input->post('txtStandardTo')."')");
		//$this->db->where('class >',(int)$this->input->post('txtStandardTo'));
		$cnt_participant		=	$this->db->count_all_results('participant_details');
		if ($cnt_participant > 0)
		{
			$error_array[]	= 'Select Valid Standards';
			$return_array['error_array']	=	$error_array;
			return $return_array;
		}	
		
		
		$this->db->where('school_code',$schoolCode);
		$count = $this->db->count_all_results('school_details');
		if($count > 0){
			$this->db->where('school_code',$schoolCode);
		}else{
			$data['school_code']		=	$schoolCode;
		}
		$teachers	=	'';
		for( $i = 1 ;$i <= $this->input->post('hidTeachers'); $i++){
			if(isset($_POST['txtTeacher_'.$i]) && trim($_POST['txtTeacher_'.$i]) != ''){
			
				$teachers	.=	$_POST['txtTeacher_'.$i].'#$#'.(int)$_POST['txtPhone_'.$i].'#@#';	
			}
		}
		$data['class_start']		=	(int)$this->input->post('txtStandardFrom');
		$data['class_end']			=	(int)$this->input->post('txtStandardTo');
		$data['school_phone']		=	$this->input->post('txtSchoolPhone');
		$data['school_email']		=	$this->input->post('txtSchoolEmail');
		$data['hm_name']			=	$this->input->post('txtHeadmaster');
		$data['hm_phone']			=	$this->input->post('txtHeadmasterPhone');
		$data['principal_name']		=	$this->input->post('txtPrincipal');
		$data['principal_phone']	=	$this->input->post('txtPrincipalPhone');
		$data['teachers']			=	$teachers;
		$data['strength_lp']		=	(int)$this->input->post('txtTotalLP');
		$data['strength_up']		=	(int)$this->input->post('txtTotalUP');
		$data['strength_hs']		=	(int)$this->input->post('txtTotalHS');
		$data['strength_hss']		=	(int)$this->input->post('txtTotalHSS');
		$data['strength_vhss']		=	(int)$this->input->post('txtTotalVHSS');
		$data['total_strength']		=	(int)$this->input->post('txtTotal');
		if($count > 0){
			$this->db->update('school_details',$data);
		}else{
			$this->db->insert('school_details',$data);
		}
		$this->log_school_details($schoolCode,'N');
		return false;
	}
	
	function save_participant_details () {
		$error_array	=	array();
		$schoolCode	=	$this->input->post('hidSchoolId');
		$admnNo		=	$this->input->post('txtADNO');
		
		
		$this->db->where('school_code',$schoolCode );
		$this->db->where('admn_no', $admnNo);
		$this->db->select('participant_id');
		$result = $this->db->get('participant_details');
		$participant	=	$result->result_array();	
		$data['school_code']		=	(int)$schoolCode;
		$data['admn_no']			=	$admnNo;
		$data['participant_name']	=	$this->input->post('txtParticipantName');
		$data['class']				=	$this->input->post('txtClass');
		$data['gender']				=	$this->input->post('txtGender');
		if(count($participant) > 0){
			//$participant_id	=	$participant[0]['participant_id'];
			//$this->db->update('participant_details',$data);
			$error_array[]	= 'Participant already registered';
			$return_array['error_array']	=	$error_array;
			return $return_array; 
		}else{
			$this->db->insert('participant_details',$data);
			$participant_id =	$this->db->insert_id();
		}
		
		
		$this->db->where('school_code', $schoolCode);
		$this->db->where('admn_no', $admnNo);
		$participant_details		=	$this->db->get('participant_details');
		$participant				=	$participant_details->result_array();
		$class						=	$participant[0]['class'];
		
		for($i=1; $i <= 10; $i++){
			if(isset($_POST['txtItemCode_'.$i]) && trim($_POST['txtItemCode_'.$i]) != ''){
				$item_code		=	$_POST['txtItemCode_'.$i];
				
				$item_validation		=	$this->validate_item_school_participant($item_code,$admnNo,$schoolCode,$class);
				
				if ($item_validation)
				{
					$error_array[]		=	$item_validation;
				}
				else
				{
				
					/* Check the item code is valid one */
					$this->db->where('item_code', $item_code);
					$this->db->select('item_type');
					$result = $this->db->get('item_master');
					$itemcode	=	$result->result_array();
					if(count($itemcode) > 0){
						/**
						Check here for already registered for this item
						*/
						
						$is_captain		=	'Y';
						$parent_admn_no	=	$admnNo;
								
						if($itemcode[0]['item_type'] == 'G')
						{
							$this->db->where('item_code', $item_code);
							$this->db->where('school_code', $schoolCode);
							$this->db->where('is_captain', 'Y');
							$this->db->where('spo_id', '0');
							
							$this->db->select('admn_no');
							$result = $this->db->get('participant_item_details');
							$caption	=	$result->result_array();
							if(count($caption) > 0){
								$is_captain		=	'N';
								$parent_admn_no	=	$caption[0]['admn_no'];
							}
						}
						
						$items	=	array();
						$items['participant_id']	=	$participant_id;
						$items['school_code']		=	(int)$schoolCode;
						$items['admn_no']			=	$admnNo;
						$items['item_code']			=	$item_code;
						$items['item_type']			=	$itemcode[0]['item_type'];
						$items['parent_admn_no']	=	$parent_admn_no;
						$items['is_captain']		=	$is_captain	;
						$this->db->insert('participant_item_details',$items);
					} else {
						$error_array[]	=	'Invalid Item Code : '.$_POST['txtItemCode_'.$i].'.';
					}
				}
			}
		}
		for($i=1; $i <= 5; $i++){
			if(isset($_POST['txtPinnanyCode_'.$i]) && trim($_POST['txtPinnanyCode_'.$i]) != ''){
				$item_code		=	$_POST['txtPinnanyCode_'.$i];
				
				$item_validation		=	$this->validate_item_school_participant($item_code,$admnNo,$schoolCode,$class,'P');
				
				if ($item_validation)
				{
					$error_array[]		=	$item_validation;
				}
				else
				{
				
					/* Check the item code is valid one */
					$this->db->where('item_code', $item_code);
					$this->db->select('item_type');
					$result = $this->db->get('item_master');
					$itemcode	=	$result->result_array();
					if(count($itemcode) > 0){
						
						$this->db->where('item_code', $item_code);
						$this->db->where('school_code', $schoolCode);
						$this->db->where('is_captain', 'Y');
						$this->db->where('spo_id', '0');
						
						$this->db->select('admn_no');
						$result = $this->db->get('participant_item_details');
						$caption	=	$result->result_array();
						if(count($caption) > 0){
							$is_captain		=	'N';
							$parent_admn_no	=	$caption[0]['admn_no'];
						
						
							/**
							Check here for already registered for this item
							*/
							$items	=	array();
							$items['participant_id']	=	$participant_id;
							$items['school_code']		=	(int)$schoolCode;
							$items['admn_no']			=	$admnNo;
							$items['item_code']			=	$item_code;
							$items['item_type']			=	'P';
							
							$items['parent_admn_no']	=	$parent_admn_no;
							$items['is_captain']		=	$is_captain	;
							
							$this->db->insert('participant_item_details',$items);
						}
						else
						{
							$error_array[]	=	$_POST['txtPinnanyCode_'.$i].' pinnany has no main participants';
						}
					} else {
						$error_array[]	=	'Invalid Item Code : '.$_POST['txtItemCode_'.$i].'.';
					}
				}
			}
		}
		$this->log_participant_details($schoolCode,$admnNo,'N');
		
		$return_array['error_array']	=	$error_array;
		return $return_array;
	}
	
	
	
	
	function save_special_order_participant_details () 
	{
		$error_array	=	array();
		$schoolCode	=	$this->input->post('hidSchoolId');
		if($this->input->post('cmbParticipant') != '0')
		{
			$admnNo		=	$this->input->post('cmbParticipant');
			$this->db->where('school_code',$schoolCode );
			$this->db->where('admn_no', $admnNo);
			$this->db->select('participant_id');
			$result = $this->db->get('participant_details');
			$participant	=	$result->result_array();
			if(count($participant) > 0){
				$participant_id	=	$participant[0]['participant_id'];
			} else {
				return;
			} 
		}
		else
		{
			$admnNo		=	$this->input->post('txtADNO');
			
			$this->db->where('school_code',$schoolCode );
			$this->db->where('admn_no', $admnNo);
			$this->db->select('participant_id');
			$result = $this->db->get('participant_details');
			$participant	=	$result->result_array();
			if(count($participant) > 0){
				$error_array[]	= 'Participant already registered';
				$return_array['error_array']	=	$error_array;
				return $return_array; 
			}
			$data['school_code']		=	(int)$schoolCode;
			$data['admn_no']			=	$admnNo;
			$data['participant_name']	=	$this->input->post('txtParticipantName');
			$data['class']				=	$this->input->post('txtClass');
			$data['gender']				=	$this->input->post('txtGender');
			$this->db->insert('participant_details',$data);
			$participant_id =	$this->db->insert_id();
		}
		
		$this->db->where('school_code', $schoolCode);
		$this->db->where('admn_no', $admnNo);
		$participant_details		=	$this->db->get('participant_details');
		$participant				=	$participant_details->result_array();
		$class						=	$participant[0]['class'];

			if(isset($_POST['txtItemCode_1']) && trim($_POST['txtItemCode_1']) != ''){
				$item_code		=	$_POST['txtItemCode_1'];
				
				//$item_validation		=	$this->validate_item_school_participant($item_code,$admnNo,$schoolCode,$class);
				
				$item_validation		=	$this->validate_item_school_participant($item_code,$admnNo,$schoolCode,$class,'','S');
				
				if ($item_validation)
				{
					$error_array[]		=	$item_validation;
				}
				else
				{
					
						
					
					/* Check the item code is valid one */
					$this->db->where('item_code', $item_code);
					$this->db->select('item_type');
					$result = $this->db->get('item_master');
					$itemcode	=	$result->result_array();
					if(count($itemcode) > 0){
					/**
					Check here for already registered for this item
					*/
					
						if(isset($_POST['chkIsPinnany'])){
							$this->db->where('school_code', $schoolCode);
							$this->db->where('admn_no', $this->input->post('txtCaptionAdNo'));
							$this->db->where('item_code', $item_code);
							$this->db->where('spo_id', $this->input->post('cmbOrder'));
							$this->db->select('pi_id');
							$result = $this->db->get('participant_item_details');
							$caption	=	$result->result_array();
							if(count ($caption) > 0) {
								$item_type		=	'P';
								$parent_admn_no	=	$this->input->post('txtCaptionAdNo');
								$is_caption 	=	'N';
							} else {
								$error_array[]	=	'Caption AD NO is invalid';
								return;
							}
						}else{
							$item_type		=	$itemcode[0]['item_type'];
							$parent_admn_no	=	$admnNo;
							$is_caption 	=	'Y';
						}
						if($itemcode[0]['item_type'] == 'G') {
							/** check the caption admission no */
							if(isset($_POST['txtCaptionAdNo']) && trim($_POST['txtCaptionAdNo']) != '') {
								$this->db->where('school_code', $schoolCode);
								$this->db->where('admn_no', $this->input->post('txtCaptionAdNo'));
								$this->db->where('item_code', $item_code);
								$this->db->where('spo_id', $this->input->post('cmbOrder'));
								$this->db->select('pi_id');
								$result = $this->db->get('participant_item_details');
								$caption	=	$result->result_array();
								if(count ($caption) > 0) {
								
									
									$items	=	array();
									$items['participant_id']	=	$participant_id;
									$items['school_code']		=	(int)$schoolCode;
									$items['admn_no']			=	$admnNo;
									$items['item_code']			=	$item_code;
									$items['item_type']			=	$item_type;
									$items['parent_admn_no']	=	$this->input->post('txtCaptionAdNo');	
									$items['spo_id']			=	$this->input->post('cmbOrder');
									$items['spo_remarks']		=	$this->input->post('txtRemarks');
									$items['is_captain']		=	'N';
									$this->db->insert('participant_item_details',$items);
								} else {
									if($this->input->post('txtCaptionAdNo') == $admnNo){
										$items	=	array();
										$items['participant_id']	=	$participant_id;
										$items['school_code']		=	(int)$schoolCode;
										$items['admn_no']			=	$admnNo;
										$items['item_code']			=	$item_code;
										$items['item_type']			=	$item_type;
										$items['parent_admn_no']	=	$admnNo;	
										$items['spo_id']			=	$this->input->post('cmbOrder');
										$items['spo_remarks']		=	$this->input->post('txtRemarks');
										$items['is_captain']		=	'Y';
										$this->db->insert('participant_item_details',$items);
									} else {
										$error_array[]	=	'Caption AD NO or special order is wrong';
									}
								}
							} else {
								$error_array[]	=	'Please enter Caption AD NO for group items';
							}
						} else {
							/* for single item */
							$items	=	array();
							$items['participant_id']	=	$participant_id;
							$items['school_code']		=	(int)$schoolCode;
							$items['admn_no']			=	$admnNo;
							$items['item_code']			=	$item_code;
							$items['item_type']			=	$item_type;
							$items['parent_admn_no']	=	$parent_admn_no;	
							$items['spo_id']			=	$this->input->post('cmbOrder');
							$items['spo_remarks']		=	$this->input->post('txtRemarks');
							$items['is_captain']		=	$is_caption;
							$this->db->insert('participant_item_details',$items);
						}
						
						
					} else {
						$error_array[]	=	'Invalid Item Code : '.$_POST['txtItemCode_1'].'.';
					}
				}
			}
		$this->log_participant_details($schoolCode,$admnNo,'S');
		$return_array['error_array']	=	$error_array;
		return $return_array;
	}
	
	
	function update_participant_details () {
		$error_array	=	array();
			
		$schoolCode	=	$this->input->post('hidSchoolId');
		$admnNo		=	$this->input->post('txtADNO');
		$this->log_participant_details($schoolCode,$admnNo,'O');
		if ($admnNo != $this->input->post('hidADNO'))
		{
			$this->db->where('school_code',$schoolCode );
			$this->db->where('admn_no', $admnNo);
			$this->db->select('participant_id');
			$result = $this->db->get('participant_details');
			$participant	=	$result->result_array();
			if(count($participant) > 0){
				$error_array[]	= 'Participant already registered';
				$return_array['error_array']	=	$error_array;
				return $return_array; 
			}
			$this->db->where('school_code',$schoolCode );
			$this->db->where('parent_admn_no', $this->input->post('hidADNO'));
			$data	=	array();
			$data['parent_admn_no']		=	$admnNo;
			$this->db->update('participant_item_details',$data);
			
			$this->db->where('school_code',$schoolCode );
			$this->db->where('admn_no', $this->input->post('hidADNO'));
			$data	=	array();
			$data['admn_no']		=	$admnNo;
			$this->db->update('participant_item_details',$data);
			
		}
		
		
		$this->db->where('school_code',$schoolCode );
		$this->db->where('admn_no', $this->input->post('hidADNO'));
		$this->db->select('participant_id');
		$result = $this->db->get('participant_details');
		$participant	=	$result->result_array();
		$data	=	array();
		$data['school_code']		=	$schoolCode;
		$data['admn_no']			=	$this->input->post('txtADNO');
		$data['participant_name']	=	$this->input->post('txtParticipantName');
		$data['class']				=	$this->input->post('txtClass');
		$data['gender']				=	$this->input->post('txtGender');
		if(count($participant) > 0){
			$participant_id	=	$participant[0]['participant_id'];
			$this->db->where('school_code',$schoolCode );
			$this->db->where('admn_no', $this->input->post('hidADNO'));
			$this->db->update('participant_details',$data);
		}else{
			$error_array[]	=	'Invalid details.';
		}
		
		
		$this->db->where('school_code', $schoolCode);
		$this->db->where('admn_no', $admnNo);
		$this->db->where('is_captain', 'Y');
		$this->db->where('spo_id', '0');
		$this->db->select('item_code');
		$exist_item_details	=	$this->db->get('participant_item_details');
		$exist_item_array	=	array();
		foreach($exist_item_details->result_array() as $exist_item)
		{
			$exist_item_array[]		=	$exist_item['item_code'];
		}
		
		$balance_item_array = $exist_item_array;
		for($i=1; $i <= 10; $i++){
			if(isset($_POST['txtItemCode_'.$i]) && trim($_POST['txtItemCode_'.$i]) != '' && in_array($_POST['txtItemCode_'.$i],$exist_item_array)){
				$balance_item_array	=	array_remove($balance_item_array,$_POST['txtItemCode_'.$i]);
			}
		}
		
		/**
		** Removing and changing the captain for deleteing item codes
		*/
		$this->removing_item_wt_transfer_captain($balance_item_array,$schoolCode,$admnNo);
		/**
		** End Removing and changing the captain for deleteing item codes
		*/
		
		/**
		** Removing itemcdes for not a captain
		*/
		$this->db->where('school_code', $schoolCode);
		$this->db->where('admn_no', $admnNo);
		$this->db->where("is_captain != 'Y'");
		//$this->db->where('item_type !=', 'G');
		$this->db->where('spo_id', '0');
		$this->db->delete('participant_item_details');
		
		$this->db->where('school_code', $schoolCode);
		$this->db->where('admn_no', $admnNo);
		$participant_details		=	$this->db->get('participant_details');
		$participant				=	$participant_details->result_array();
		$class						=	$participant[0]['class'];		
		
		
		
		
		for($i=1; $i <= 10; $i++){
		
			if(isset($_POST['txtItemCode_'.$i]) && trim($_POST['txtItemCode_'.$i]) != ''){
			
				$item_code		=	$_POST['txtItemCode_'.$i];
				
				/**
				** Checking whether the item code is valid for this student
				*/
				if (in_array($item_code,$exist_item_array))
                {
                    $not_valid_item_fest        =    $this->is_not_valid_item_fest($item_code,$class);
                    $not_valid_gender        =    $this->is_not_valid_gender($item_code,$admnNo,$schoolCode);
                    if ($not_valid_item_fest or $not_valid_gender)
                    {
                        $this->db->where('school_code', $schoolCode);
                        $this->db->where('admn_no', $admnNo);
                        $this->db->where("is_captain  != 'Y'");
                        $this->db->where('item_code', $item_code);
                        $this->db->where('spo_id', '0');
                        $this->db->delete('participant_item_details');
                        if ($not_valid_item_fest)
                        {
                            $error_array[]    =    $item_code." ".$not_valid_item_fest;
                        }
                        else
                        {
                            $error_array[]    =    $item_code." ".$not_valid_gender;
                        }
                       
                    }
                    else
                    {
                        $exist_item_array    =    array_remove($exist_item_array,$item_code);
                    }
                }
				else
				{
				
					$item_validation		=	$this->validate_item_school_participant($item_code,$admnNo,$schoolCode,$class);
										
					if ($item_validation)
					{
						$error_array[]		=	$item_validation;
					}
					else
					{
						
						/* Check the item code is valid one */
						$this->db->where('item_code', $item_code);
						$this->db->select('item_type');
						$result = $this->db->get('item_master');
						$itemcode	=	$result->result_array();
						if(count($itemcode) > 0){
							/**
							Check here for already registered for this item
							*/
							
							$is_captain		=	'Y';
							$parent_admn_no	=	$admnNo;
									
							if($itemcode[0]['item_type'] == 'G')
							{
								$this->db->where('item_code', $item_code);
								$this->db->where('school_code', $schoolCode);
								$this->db->where('is_captain', 'Y');
								$this->db->where('spo_id', '0');
								
								$this->db->select('admn_no');
								$result = $this->db->get('participant_item_details');
								$caption	=	$result->result_array();
								if(count($caption) > 0){
									$is_captain		=	'N';
									$parent_admn_no	=	$caption[0]['admn_no'];
								}
							}
							
							$items	=	array();
							$items['participant_id']	=	$participant_id;
							$items['school_code']		=	(int)$schoolCode;
							$items['admn_no']			=	$admnNo;
							$items['item_code']			=	$item_code;
							$items['item_type']			=	$itemcode[0]['item_type'];
							
							$items['parent_admn_no']	=	$parent_admn_no;
							$items['is_captain']		=	$is_captain	;
						
							$this->db->insert('participant_item_details',$items);
						} else {
							$error_array[]	=	'Invalid Item Code : '.$_POST['txtItemCode_'.$i].'.';
						}
					
					}
				}
			}
		}
		
		$this->removing_item_wt_transfer_captain($exist_item_array,$schoolCode,$admnNo);
				
		for($i=1; $i <= 5; $i++){
		
			if(isset($_POST['txtPinnanyCode_'.$i]) && trim($_POST['txtPinnanyCode_'.$i]) != ''){
			
			 	$item_code		=	$_POST['txtPinnanyCode_'.$i];
				
				$item_validation		=	$this->validate_item_school_participant($item_code,$admnNo,$schoolCode,$class,'P');
				
				if ($item_validation)
				{
					$error_array[]		=	$item_validation;
				}
				else
				{
				
					/* Check the item code is valid one */
					$this->db->where('item_code', $item_code);
					$this->db->select('item_type');
					$result = $this->db->get('item_master');
					$itemcode	=	$result->result_array();
					if(count($itemcode) > 0){
						
						$this->db->where('item_code', $item_code);
						$this->db->where('school_code', $schoolCode);
						$this->db->where('is_captain', 'Y');
						$this->db->where('spo_id', '0');
						
						$this->db->select('admn_no');
						$result = $this->db->get('participant_item_details');
						$caption	=	$result->result_array();
						if(count($caption) > 0){
							$is_captain		=	'N';
							$parent_admn_no	=	$caption[0]['admn_no'];
							/**
							Check here for already registered for this item
							*/
							$items	=	array();
							$items['participant_id']	=	$participant_id;
							$items['school_code']		=	(int)$schoolCode;
							$items['admn_no']			=	$admnNo;
							$items['item_code']			=	$item_code;
							$items['item_type']			=	'P';
							
							
							$items['parent_admn_no']	=	$parent_admn_no;
							$items['is_captain']		=	$is_captain	;
							
							$this->db->insert('participant_item_details',$items);
						}
						else
						{
							$error_array[]	=	$_POST['txtPinnanyCode_'.$i].' pinnany has no main participants';
						}
						
					} else {
						$error_array[]	=	'Invalid Item Code : '.$_POST['txtItemCode_'.$i].'.';
					}
				}
			}
		}
		$this->log_participant_details($schoolCode,$admnNo,'N');
		
		$return_array['error_array']	=	$error_array;
		return $return_array;
	}
	
	
	function removing_item_wt_transfer_captain($balance_item_array,$schoolCode,$admnNo)
	{
		/**
		** Removing and changing the captain for deleteing item codes
		*/
		foreach($balance_item_array as $balance_item)
		{
			/**
			** Change Captain to other person
			*/
			
			$this->db->where('school_code', $schoolCode);
			$this->db->where('admn_no !=', $admnNo);
			$this->db->where('item_code', $balance_item);
			$this->db->where('is_captain !=', 'Y');
			$this->db->where('item_type !=', 'P');
			$this->db->where('spo_id', '0');
			$part_item_deta		=	$this->db->get('participant_item_details');
			if ($part_item_deta->num_rows() > 0)
			{
				$part_item		=	$part_item_deta->result_array();
				$new_capt_adno	=	$part_item[0]['admn_no'];
				$this->db->where('school_code', $schoolCode);
				$this->db->where('admn_no', $new_capt_adno);
				$this->db->where('item_code', $balance_item);
				$this->db->where('is_captain !=', 'Y');
				$this->db->where('spo_id', '0');
				$up_captain_data['parent_admn_no']	=	$new_capt_adno;
				$up_captain_data['is_captain']		=	'Y';
				$this->db->update('participant_item_details',$up_captain_data);
				
				$this->db->where('school_code', $schoolCode);
				$this->db->where('item_code', $balance_item);
				$this->db->where('is_captain !=', 'Y');
				$this->db->where('spo_id', '0');
				
				$up_all_captain_data['parent_admn_no']	=	$new_capt_adno;
				
				$this->db->update('participant_item_details',$up_all_captain_data);
				
			}
			
			/**
			** Remove pinnanies if exists and no main participant
			*/
			
			$this->db->where('school_code', $schoolCode);
			$this->db->where('item_code', $balance_item);
			$this->db->where('is_captain', 'Y');
			$this->db->where('spo_id', '0');
			$pinnany_no_mn_part		=	$this->db->get('participant_item_details');
			if ($pinnany_no_mn_part->num_rows() <= 0)
			{
				$this->db->where('school_code', $schoolCode);
				$this->db->where('admn_no !=', $admnNo);
				$this->db->where('parent_admn_no', $admnNo);
				$this->db->where('item_code', $balance_item);
				$this->db->where('is_captain !=', 'Y');
				$this->db->where('item_type', 'P');
				$this->db->where('spo_id', '0');
				$part_item_deta		=	$this->db->delete('participant_item_details');
			}
			
			
			/**
			** Remove balance items
			*/
			
			$this->db->where('school_code', $schoolCode);
			$this->db->where('admn_no', $admnNo);
			$this->db->where('item_code', $balance_item);
			$this->db->where('spo_id', '0');
			$part_item_deta		=	$this->db->delete('participant_item_details');
			
			
		}
		/**
		** End Removing and changing the captain for deleteing item codes
		*/
	}
	
	
	function validate_item_school_participant($item_code,$admn_no,$school_code,$class,$item_type = '', $is_special = '',$check_repeat = '')
	{
		$not_valid_item_code		=	$this->is_not_valid_item_code($item_code);
		if ($not_valid_item_code)
		{
			return $item_code." ".$not_valid_item_code;
		}
		
		$not_valid_item_fest		=	$this->is_not_valid_item_fest($item_code,$class);
		if ($not_valid_item_fest)
		{
			return $item_code." ".$not_valid_item_fest;
		}
		$not_valid_gender		=	$this->is_not_valid_gender($item_code,$admn_no,$school_code);
		if ($not_valid_gender)
		{
			return $item_code." ".$not_valid_gender;
		}
		
		if ($check_repeat != 'R')
		{
			$repeat_item_code		=	$this->is_repeate_item_code($item_code,$admn_no,$school_code);
			if ($repeat_item_code)
			{
				return $item_code." ".$repeat_item_code;
			}
		}
		
		
		$contain_arabic_sanskrit		=	$this->is_contain_both_arabic_sanskrit($item_code,$admn_no,$school_code);
		if ($contain_arabic_sanskrit)
		{
			return $item_code." ".$contain_arabic_sanskrit;
		}
		
		$arbic_general_padyam		=	$this->is_arbic_general_padyam($item_code,$admn_no,$school_code);
		if ($arbic_general_padyam)
		{
			return $item_code." ".$arbic_general_padyam;
		}
		
		$over_max_item		=	$this->is_over_max_item($admn_no,$school_code,$item_code);
		if ($over_max_item)
		{
			return $item_code." ".$over_max_item;
		}
		
		if($is_special != 'S'){
			$over_max_item		=	$this->is_over_max_item_school($admn_no,$school_code,$item_code,$item_type);
			if ($over_max_item)
			{
				return $item_code." ".$over_max_item;
			}
		
		
			$over_max_vibhagam		=	$this->is_over_max_vibhagam_school($item_code,$school_code);
			if ($over_max_vibhagam)
			{
				return $item_code." ".$over_max_vibhagam;
			}
		} else {
			
		}
		
		return false;
	}
	
	function is_not_valid_item_code_123456($item_code)
	{
		$this->db->where('item_code',$item_code);
		$cnt_item	=	$this->db->count_all_results('item_master');
		if ($cnt_item <= 0)
		{
			return "is not valid item code";
		}
		return false;
	}
	
	function is_not_valid_item_code($item_code)
	{
		$this->db->where('item_code',$item_code);
		$cnt_item	=	$this->db->count_all_results('item_master');
		if ($cnt_item <= 0)
		{
			return "is not valid item code";
		}
		return false;
	}
	
	function is_not_valid_item_fest($item_code,$class)
	{
		$this->db->where('FM.class_start <=',(int)$class);
		$this->db->where('FM.class_end >=',(int)$class);
		$this->db->where('IM.item_code',$item_code);
		$this->db->from('item_master AS IM');
		$this->db->join('festival_master AS FM','IM.fest_id = FM.fest_id');
		$item_details		=	$this->db->get();
		
		if($item_details->num_rows() <= 0)
		{
			return "is not in his category";
		}
		if(($item_code == '111' or $item_code == '112') and $class > 2)
		{
			return "is not in his category";
		}
		return false;
	}
	
	function is_arbic_general_padyam($item_code,$admn_no,$school_code)
	{
		if ($item_code == '103')
		{
			$this->db->where('item_code','204');
			$this->db->where('admn_no',$admn_no);
			$this->db->where('school_code',$school_code);
			$cnt_item_details	=	$this->db->count_all_results('participant_item_details');
			if ($cnt_item_details > 0)
			{
				return "Both Arbic and general Padyamchollal not provide";
			}
		}
		if ($item_code == '204')
		{
			$this->db->where('item_code','103');
			$this->db->where('admn_no',$admn_no);
			$this->db->where('school_code',$school_code);
			$cnt_item_details	=	$this->db->count_all_results('participant_item_details');
			if ($cnt_item_details > 0)
			{
				return "Both Arbic and general Padyamchollal not provide";
			}
		}
		if ($item_code == '306')
		{
			$this->db->where('item_code','403');
			$this->db->where('admn_no',$admn_no);
			$this->db->where('school_code',$school_code);
			$cnt_item_details	=	$this->db->count_all_results('participant_item_details');
			if ($cnt_item_details > 0)
			{
				return "Both Arbic and general Padyamchollal not provide";
			}
		}
		if ($item_code == '403')
		{
			$this->db->where('item_code','306');
			$this->db->where('admn_no',$admn_no);
			$this->db->where('school_code',$school_code);
			$cnt_item_details	=	$this->db->count_all_results('participant_item_details');
			if ($cnt_item_details > 0)
			{
				return "Both Arbic and general Padyamchollal not provide";
			}
		}
		if ($item_code == '652')
        {
            $this->db->where('(item_code = 706 OR item_code = 707)');
            $this->db->where('admn_no',$admn_no);
            $this->db->where('school_code',$school_code);
            $cnt_item_details    =    $this->db->count_all_results('participant_item_details');
            if ($cnt_item_details > 0)
            {
                return "Both Arbic and general Padyamchollal not provide";
            }
        }
        if ($item_code == '706' OR $item_code == '707')
        {
            $this->db->where('item_code','652');
            $this->db->where('admn_no',$admn_no);
            $this->db->where('school_code',$school_code);
            $cnt_item_details    =    $this->db->count_all_results('participant_item_details');
            if ($cnt_item_details > 0)
            {
                return "Both Arbic and general Padyamchollal not provide";
            }
        }
		
		
		
	}
	function is_not_valid_gender($item_code,$admn_no,$school_code)
	{
		$this->db->where('item_code',$item_code);
		
		$item_master		=	$this->db->get('item_master');
		$item				=	$item_master->row();
		if ($item->gender != 'C')
		{
			$this->db->where('admn_no',$admn_no);
			$this->db->where('school_code',$school_code);
			$this->db->where('gender',$item->gender);
			$participant_details		=	$this->db->get('participant_details');
			if ($participant_details->num_rows() <= 0)
			{
				return "Wrong Gender";
			}
			
		}
		return false;
	}
	
	function is_repeate_item_code($item_code,$admn_no,$school_code)
	{
		$this->db->where('item_code',$item_code);
		$this->db->where('admn_no',$admn_no);
		$this->db->where('school_code',$school_code);
		$cnt_item		=	$this->db->count_all_results('participant_item_details');
		if ($cnt_item > 0)
		{
			return "repeated item code";
		}
		return false;
	}
	
	function is_contain_both_arabic_sanskrit($item_code,$admn_no,$school_code)
	{
		$this->db->where('IM.item_code',$item_code);
		$this->db->from('item_master AS IM');
		$this->db->join('festival_master AS FM','IM.fest_id = FM.fest_id');
		$item_details		=	$this->db->get();
		$items				=	$item_details->result_array();
		$fest_id			=	$items[0]['fest_id'];
		
		if ($fest_id >= 5)
		{
			if ($fest_id == 5)
			{
				$this->db->where('PD.school_code',$school_code);
				$this->db->where('PD.admn_no',$admn_no);
				$this->db->where('FM.fest_id','8');
				$this->db->from('participant_item_details AS PD');
				$this->db->join('item_master AS IM','IM.item_code = PD.item_code');
				$this->db->join('festival_master AS FM','IM.fest_id = FM.fest_id');
				$fest_details		=	$this->db->get();
				if ($fest_details->num_rows() > 0)
				{
					return "Arabic and Sanskrit events together not allowed";
				}
				else
				{
					return false;
				}  
			}
			
			if ($fest_id == 8)
			{
				$this->db->where('PD.school_code',$school_code);
				$this->db->where('PD.admn_no',$admn_no);
				$this->db->where('FM.fest_id','5');
				$this->db->from('participant_item_details AS PD');
				$this->db->join('item_master AS IM','IM.item_code = PD.item_code');
				$this->db->join('festival_master AS FM','IM.fest_id = FM.fest_id');
				$fest_details		=		$this->db->get();
				if ($fest_details->num_rows() > 0)
				{
					return "Arabic and Sanskrit events together not allowed";
				}
				else
				{
					return false;
				}  
			}
			
			if ($fest_id == 6)
			{
				$this->db->where('PD.school_code',$school_code);
				$this->db->where('PD.admn_no',$admn_no);
				$this->db->where('FM.fest_id','9');
				$this->db->from('participant_item_details AS PD');
				$this->db->join('item_master AS IM','IM.item_code = PD.item_code');
				$this->db->join('festival_master AS FM','IM.fest_id = FM.fest_id');
				$fest_details		=		$this->db->get();
				if ($fest_details->num_rows() > 0)
				{
					return "Arabic and Sanskrit events together not allowed";
				}
				else
				{
					return false;
				}  
			}
			
			if ($fest_id == 9)
			{
				$this->db->where('PD.school_code',$school_code);
				$this->db->where('PD.admn_no',$admn_no);
				$this->db->where('FM.fest_id','6');
				$this->db->from('participant_item_details AS PD');
				$this->db->join('item_master AS IM','IM.item_code = PD.item_code');
				$this->db->join('festival_master AS FM','IM.fest_id = FM.fest_id');
				$fest_details		=		$this->db->get();
				if ($fest_details->num_rows() > 0)
				{
					return "Arabic and Sanskrit events together not allowed";
				}
				else
				{
					return false;
				}  
			}
		}
				
	}
	
	function is_over_max_item($admn_no,$school_code,$item_code)
	{
		$this->db->where('IM.item_code',$item_code);
		$this->db->from('item_master AS IM');
		$this->db->join('festival_master AS FM','IM.fest_id = FM.fest_id');
		$this->db->select('IM.item_type,FM.fest_id');
		$item_details		=	$this->db->get();
		
		if ($item_details->num_rows() > 0)
		{
			$items		=	$item_details->result_array();
			$fest_id	=	$items[0]['fest_id'];
			$item_type	=	$items[0]['item_type'];
			
			if ($item_type == 'G')
			{
				$max_no	=	2;
				$type	=	'group';
			}
			else
			{
				$max_no	=	3;
				$type	=	'individual';
			}
			
			$this->db->where('PD.admn_no',$admn_no);
			$this->db->where('PD.school_code',$school_code);
			$this->db->where('IM.item_type',$item_type);
			$this->db->where('IM.fest_id',$fest_id);
			$this->db->from('participant_item_details AS PD');
			$this->db->join('item_master AS IM','PD.item_code = IM.item_code' );
			$this->db->group_by('PD.item_code');
					
			$item	=	$this->db->get('participant_item_details');
			if ($item->num_rows() >= $max_no)
			{
				return "Maximum number of ".$type." limit was exceed";
			}
			else
			{
				return false;
			}
		}
	}
	
	
	function is_over_max_item_school($admn_no,$school_code,$item_code,$item_type = '')
	{
		$this->db->where('item_code',$item_code);
		$item_master		=	$this->db->get('item_master');
		$item				=	$item_master->result_array();
		if ($item_type == 'P')
		{
			$max_no				=	$item[0]['max_pinnani'];
		}
		else
		{
			$max_no				=	$item[0]['max_participants'];
		}
		
		$this->db->where('school_code',$school_code);
		$this->db->where('item_code',$item_code);
		if ($item_type == 'P')
		{
			$this->db->where('item_type',$item_type);
		}
		else
		{
			$this->db->where("item_type != 'P'");
		}
		$cnt_item	=	$this->db->count_all_results('participant_item_details');
		
		if ($cnt_item >= $max_no)
		{
			if ($item_type == 'P')
			{
				if ($max_no == 0)
				{
					return "No Pinnany";
				}
				else
				{
					return "Maximum number of Pinnany was exceed";
				}
			}
			else
			{
				return "Maximum number of students was exceed";
			}
			
		}
				
	}
	
	function is_over_max_vibhagam_school($item_code,$school_code)
	{
		$this->db->where('IM.item_code',$item_code);
		$this->db->from('item_master AS IM');
		$this->db->join('vibhagam_master AS VM','IM.vibhagam_id = VM.vibhagam_id');
		$this->db->select('VM.vibhagam_id,VM.vibhagam_name,VM.max_items,IM.item_type');
		$vibhagam_details		=	$this->db->get();
		$vibhagam				=	$vibhagam_details->result_array();
			
		$vibhagam_id			=	$vibhagam[0]['vibhagam_id'];
		$vibhagam_name			=	$vibhagam[0]['vibhagam_name'];
		$max_items				=	$vibhagam[0]['max_items'];
		$item_type				=	$vibhagam[0]['item_type'];
		
		
		$this->db->where('PD.school_code',$school_code);
		$this->db->where('IM.vibhagam_id',$vibhagam_id);
		$this->db->where('PD.item_code !=',$item_code);
		//$this->db->where('PD.item_type !=',$item_type);
		$this->db->from('participant_item_details AS PD');
		$this->db->join('item_master AS IM','PD.item_code = IM.item_code');
		$this->db->group_by('PD.item_code');
		$item_details		=	$this->db->get();
		if ($item_details->num_rows() >= $max_items)
		{
			return "Maximum number of students in ".$vibhagam_name." was exceed";
		}
		else
		{
			return false;
		}
	}
	
	
	function update_group_captains()
	{
		$schoolCode		=	$this->input->post('hidSchoolId');
		$group_count	=	$this->input->post('hidGrpCount');
		
		for($i = 0; $i < $group_count; $i++)
		{
			if(isset($_POST['hidGrpItemCode_'.$i]) && trim($_POST['hidGrpItemCode_'.$i]) != ''){
				$item_code		=	trim($_POST['hidGrpItemCode_'.$i]);
				$admn_no		=	trim($_POST['cmbGrpParticipant_'.$i]);
				
				$this->db->where('school_code',$schoolCode);
				$this->db->where('item_code',$item_code);
				$this->db->update('participant_item_details',array('is_captain' => 'N','parent_admn_no' => $admn_no));
				
				$this->db->where('school_code',$schoolCode);
				$this->db->where('item_code',$item_code);
				$this->db->where('admn_no',$admn_no);
				$this->db->update('participant_item_details',array('is_captain' => 'Y','parent_admn_no' => $admn_no));
				
				
					
			}
		}	
	}
	
	function finalize_school_details($school_code)
	{
		/*
		** Check whether a group item has no captain
		*/
		$this->db->where('school_code',$school_code);
		$this->db->where('item_type','G');
		$group_details		=	$this->db->get('participant_item_details');
		foreach($group_details->result_array() as $group)
		{
			$item_code		=	$group['item_code'];
			$this->db->where('school_code',$school_code);
			$this->db->where('item_code',$item_code);
			$this->db->where('is_captain','Y');
			$this->db->where('spo_id','0');
			$count = $this->db->count_all_results('participant_item_details');
			if ($count <= 0)
			{
				$error_array[]		=	"Please fix a captain for all group items";
				$return_array['error_array']	=	$error_array;
				return $return_array;
			}
		}
		/*
		** End Check whether a group item has no captain
		*/
		
		/**
		** Delete who is not participating any items
		*/
		$this->db->where('PD.school_code',$school_code);
		$this->db->where('PI.pi_id IS NULL');
		$this->db->from('participant_details AS PD');
		$this->db->join('participant_item_details AS PI','PD.participant_id = PI.participant_id','LEFT');
		$this->db->select('PD.participant_id');
		$pd_details		=	$this->db->get();
		foreach($pd_details->result_array() as $pd)
		{
			$this->db->where('participant_id',$pd['participant_id']);
			$this->db->delete('participant_details');
		}
		/**
		** End Delete who is not participating any items
		*/
		
		$this->db->where('school_code',$school_code);
		$this->db->update('school_details',array('is_finalize' => 'Y'));
		
		$data					=	array();
		$data['school_code']	=	$school_code;
		$data['status']			=	'Y';
		$data['ip']					=	$this->input->ip_address();
		$data['user_id']			=	$this->session->userdata('USERID');
		$this->db->insert('z_school_confirm_log',$data);
		
	}
	
	function create_csv_generation($school_code)
	{
		$this->db->where('school_code',$school_code);
		$this->db->where('is_finalize','Y');
		$school_details		=	$this->db->get('school_details');
		if ($school_details->num_rows() <= 0)
		{
			$error_array[]		=	"Please finalize the school details";
			$return_array['error_array']	=	$error_array;
			return $return_array;
		}	
		
		$this->db->where('school_code',$school_code);
		$this->db->where('item_type','G');
		$group_details		=	$this->db->get('participant_item_details');
		foreach($group_details->result_array() as $group)
		{
			$item_code		=	$group['item_code'];
			$this->db->where('school_code',$school_code);
			$this->db->where('item_code',$item_code);
			$this->db->where('is_captain','Y');
			$count = $this->db->count_all_results('participant_item_details');
			if ($count <= 0)
			{
				$error_array[]		=	"Please fix a captain for all group items";
				$return_array['error_array']	=	$error_array;
				return $return_array;
			}
		}
		
		/*$this->db->where('school_code',$school_code);
		$this->db->update('school_details',array('is_csv_taken' => 'Y'));
		
		$this->db->where('school_code',$school_code);
		$school_details		=	$this->db->get('school_details');
		query_to_csv($school_details,true,'dddd.csv');*/

	}
	
	function is_editable_school($school_code)
	{
		$this->db->where('school_code',$school_code);
		$school_details		=	$this->db->get('school_master');
		if ($school_details->num_rows() > 0)
		{
			$this->db->where('SM.school_code',$school_code);
			$this->db->join('school_master AS SM','SM.school_code = SD.school_code','RIGHT');
			$school_details		=	$this->db->get('school_details AS SD');
			$school				=	$school_details->result_array();
			if (@$school[0]['is_finalize'] == 'Y' or @$school[0]['master_confirm'] == 'Y' )
			{
				return 'no';
			}
			else
			{
				return 'yes';
			}
			
		}
		else
		{
			return 'no';
		}
		
	}
	
	function delete_participant_details($school_code,$admn_no) 
	{
		$this->db->where('school_code',$school_code);
		$this->db->where('admn_no',$admn_no);
		$this->db->where('spo_id > 0');
		$cnt_special_order		=	$this->db->count_all_results('participant_item_details');
		if ($cnt_special_order > 0)
		{
			$error_array[]	= 'This Participant has special order items';
			$return_array['error_array']	=	$error_array;
			return $return_array;
		}
		
		$this->db->where('school_code',$school_code);
		$this->db->where('parent_admn_no',$admn_no);
		$this->db->where('admn_no !=',$admn_no);
		//$this->db->where('is_captain','Y');
		$cnt_captains	=	$this->db->count_all_results('participant_item_details');
		
		if ($cnt_captains > 0)
		{
			$error_array[]	= 'This Participant has a team captain ';
			$return_array['error_array']	=	$error_array;
			return $return_array;
		}
		
		
		$this->db->where('school_code',$school_code);
		$this->db->where('admn_no',$admn_no);
		$this->db->delete('participant_item_details');
		
		$this->db->where('school_code',$school_code);
		$this->db->where('admn_no',$admn_no);
		$this->db->delete('participant_details');
		
		
	} 
	
	function get_special_order_participant_details($schoolCode, $pi_id = '')
	{
		if($pi_id != '')
			$this->db->where('PID.pi_id',$pi_id);
		$this->db->where('PD.school_code',$schoolCode);
		$this->db->where('PID.spo_id != 0');
		$this->db->from('participant_details AS PD');
		$this->db->join('participant_item_details AS PID', "PD.participant_id = PID.participant_id", 'INNER');
		$this->db->join('item_master AS IM', "IM.item_code = PID.item_code", 'INNER');
		$this->db->join('special_order_master AS SOM', "SOM.spo_id = PID.spo_id", 'INNER');
		$this->db->select('PD.*, PID.spo_id, PID.parent_admn_no, PID.item_type, PID.pi_id, PID.item_code, IM.item_name, SOM.spo_title');
		$this->db->order_by('PID.item_code, PID.parent_admn_no, PID.is_captain DESC');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	
	function delete_special_order_participant_details () 
	{
		$adno		=	$this->input->post('hidADNO');
		$item_code	=	$this->input->post('hidItemId');
		$school_id	=	$this->input->post('hidSchoolId');
		$this->db->where('parent_admn_no', $adno);
		$this->db->where('school_code', $school_id);
		$this->db->where('item_code', $item_code);
		$this->db->where('spo_id != 0');
		$this->db->select('admn_no');
		$participants	=	$this->db->get('participant_item_details');
		$participants	=	$participants->result_array();
		for( $i = 0; $i < count($participants); $i++ ) {
			
			$this->log_participant_details($school_id,$participants[$i]['admn_no'],'O');
			
			$this->db->where('school_code', $school_id);
			$this->db->where('item_code', $item_code);
			$this->db->where('admn_no', $participants[$i]['admn_no']);
			$this->db->delete('participant_item_details');
			
			$this->db->where('school_code', $school_id);
			$this->db->where('admn_no', $participants[$i]['admn_no']);
			$this->db->select('admn_no');
			$participants_other_items	=	$this->db->get('participant_item_details');
			$participants_other_items	=	$participants_other_items->result_array();
			if( count($participants_other_items) == 0 ) {
				$this->db->where('school_code', $school_id);
				$this->db->where('admn_no', $participants[$i]['admn_no']);
				$this->db->delete('participant_details');
			}
			
			$this->log_participant_details($school_id,$participants[$i]['admn_no'],'N');
		}
	} 
	
	function get_participant_item_list($school_code)
	{
		$this->db->where('PD.school_code',$school_code);
		$this->db->group_by('PD.item_code');
		$this->db->select('PD.item_code,IM.item_name');
		$this->db->join('item_master AS IM','PD.item_code = IM.item_code');
		$participant_item_details	=	$this->db->get('participant_item_details AS PD');
		$item_details_array		=	array();
		if ($participant_item_details->num_rows() > 0)
		{
			$count = 0;
			foreach($participant_item_details->result_array() as $item_details)
			{
					
				$item_code		=	$item_details['item_code'];
				$this->db->where('school_code',$school_code);
				$this->db->where('item_code',$item_code);
				$this->db->where("(item_type ='G' OR item_type = 'S')");
				$cnt_participant	=	$this->db->count_all_results('participant_item_details');
				
				$this->db->where('school_code',$school_code);
				$this->db->where('item_code',$item_code);
				$this->db->where("item_type ='P'");
				$cnt_pinnany	=	$this->db->count_all_results('participant_item_details');
				
				$this->db->where('PD.school_code',$school_code);
				$this->db->where('PD.item_code',$item_code);
				$this->db->where("PD.is_captain ='Y'");
				$this->db->join('participant_details as PM','PD.school_code = PM.school_code AND PD.admn_no = PM.admn_no');
				$this->db->select('PM.participant_name');
				$captian_details	=	$this->db->get('participant_item_details AS PD');
				if ($captian_details->num_rows() > 0)
				{
					$captian	=	$captian_details->result_array();
					$item_details_array[$count]['captian']			=	$captian[0]['participant_name'];
				}	
								
				$item_details_array[$count]['item_code']			=	$item_code;
				$item_details_array[$count]['item_name']			=	$item_details['item_name'];
				$item_details_array[$count]['cnt_participant']		=	$cnt_participant;
				$item_details_array[$count]['cnt_pinnany']			=	$cnt_pinnany;
				$count++;
			}
			return $item_details_array;
		}
	}
	
	
}
?>
