<?php
class User_Cluster_Model extends Model{
	function User_Cluster_Model()
	{
		parent::Model();
	}
	
	/** function for save user*/
	function save_cluster_users()
	{
		$data['user_name']			=	$this->input->post('txtNewUserName');
		$data['password']			=	get_encr_password($this->input->post('txtNewPassword'));
		$data['generated_password']	=	$this->input->post('txtNewPassword');
		$data['user_type']			=	'5';
		$data['is_change_password']	=	"N";
		$data['sub_district_code']	=	 $this->session->userdata('SUB_DISTRICT');
		$data['created_by']			=	$this->session->userdata('USERID');
		
		$this->db->insert('user_master',$data);
		$userId	=	$this->db->insert_id();
		$this->save_cluster_school_codes($userId);
		$this->save_user_rights($userId);
	}

	/** function for update user*/
	function update_user_cluster_details()
	{
		$userId	=	$this->input->post('hidUserId');
		$data['user_name']			=	$this->input->post('txtNewUserName');
		if(isset($_POST['txtNewPassword']) && trim($_POST['txtNewPassword']) != '')
		{
			$data['password']			=	get_encr_password($this->input->post('txtNewPassword'));
			$data['generated_password']	=	$this->input->post('txtNewPassword');
			$data['is_change_password']	=	'N';
		}
		$this->db->where('user_id', $userId);
		$this->db->update('user_master',$data);
		
		$this->db->where('user_id', $userId	);		
		$this->db->delete('user_cluster');
		$this->save_cluster_school_codes($userId);
		
		$this->db->where('user_id', $userId	);	
		$this->db->delete('user_rights');
		
		$this->save_user_rights($userId);
	}
	
	/** function for save the default user rights*/
	function save_user_rights($userId)
	{
		$this->db->where('user_type_id', 5);
		$this->db->from('user_right_functionalities');
		$this->db->select('rf_functionality, rf_id');
		$result = $this->db->get();
		$rights	=	$result->result_array();
		if(count($rights) > 0)
		{
			for($i=0; $i < count($rights); $i++)
			{
				$user_right	=	array();
				$user_right['user_id']	=	$userId;
				$user_right['rf_id']	=	$rights[$i]['rf_id'];
				$this->db->insert('user_rights',$user_right);
			}	
		}
	}
	
	/** function for fetch user*/
	function existing_cluster_details()
	{
		/*$sessionID=$this->session->userdata('USERID');
		$this->db->where('UM.created_by',$sessionID);*/
		$sub_district_code=$this->session->userdata('SUB_DISTRICT');
		$this->db->where('UM.sub_district_code',$sub_district_code);
		$this->db->where('UM.user_type', '5');
		$this->db->from('user_master AS UM');
		$this->db->orderby('user_name', 'ASC');
		$this->db->select('user_id, user_name, (SELECT COUNT(uc_id) FROM user_cluster UC WHERE UC.user_id = UM.user_id) AS total ');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	
	function get_user_registration()
	{
		$userName	=	$this->input->post('txtUserName');
		$password   =   $this->input->post('txtPassword');
		$this->db->where('user_name',$userName);
		$this->db->where('password',get_encr_password($password));
		$count = $this->db->count_all_results('user_master');
		if($count > 0){
			
		}else{
			
		}
	
	}
	
	/** function for fetch schools*/
	function get_Schools() 
	{
		$this->db->where('sub_district_code', $this->session->userdata('SUB_DISTRICT'));
		$this->db->where('school_code NOT IN (SELECT UC.school_code FROM user_cluster AS UC WHERE UC.sub_district_code = "'.$this->session->userdata('SUB_DISTRICT').'")');
		$this->db->from('school_master');
		$this->db->order_by('school_code');
		$this->db->select('school_code, school_name');
		$result = $this->db->get();
		return $result->result_array();
	}
	/** function for fetch entered schools*/
	function get_entered_school() 
	{
		$this->db->where('SM.sub_district_code', $this->session->userdata('SUB_DISTRICT'));
		$this->db->from('school_master AS SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->select('SM.school_code');
		$result = $this->db->get();
		
		$return_array	=	array();
		foreach($result->result_array() as $school)
		{
			$return_array[]		=	$school['school_code'];
		}
		return $return_array;
	}
	
	
	function select_cluster_user_details() 
	{
		$this->db->where('user_id', $this->input->post('UserIdty'));
		$this->db->from('user_master');
		$this->db->select('user_id, user_name');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}

	function get_selected_Schools() 
	{
		$this->db->where('SM.sub_district_code', $this->session->userdata('SUB_DISTRICT'));
		$this->db->where('UC.user_id', $this->input->post('UserIdty'));
		$this->db->from('user_cluster UC');
		$this->db->join('school_master SM', 'UC.school_code = SM.school_code');	
		$this->db->order_by('SM.school_code');
		$this->db->select('SM.school_code, school_name');
		$result = $this->db->get();
		return $result->result_array();
	}
	
	function delete_cluster_user_details(){
		$this->db->where('user_id', $this->input->post('UserIdty'));
		$this->db->delete('user_master');
		$this->db->where('user_id', $this->input->post('UserIdty'));
		$this->db->delete('user_cluster');
	}
	
	function save_cluster_school_codes($userId)
	{
		$schools	=	$this->get_Schools();
		if(count($schools) > 0)
		{
			for($i=0; $i < count($schools); $i++)
			{
				$school_code	=	array();
				if(isset($_POST[$schools[$i]['school_code']])){
					$school_code['user_id']				=	$userId;
					$school_code['school_code']			=	$schools[$i]['school_code'];
					$school_code['sub_district_code']	=	$this->session->userdata('SUB_DISTRICT');
					$this->db->insert('user_cluster',$school_code);
				}
			}	
		}
	}
	
	function check_username_exists($userId = '', $username)
	{
		if($userId != '')
			$this->db->where('user_id != "'.$userId.'"');
		$this->db->where('user_name = "'.$username.'"');
		$this->db->select('user_id');
		$this->db->from('user_master');
		$result	=	$this->db->get();
		if(count($result->result_array()) > 0)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	function confirm_sub_dist_schools()
	{
		$sub_district_code		=	$this->session->userdata('SUB_DISTRICT');
		
		$this->db->where('sub_district_code',$sub_district_code);
		$cnt_school_master		=	$this->db->count_all_results('school_master');
		
		
		
		
		$this->db->where('SM.sub_district_code',$sub_district_code);
		$this->db->where('SD.is_finalize','Y');
		$this->db->from('school_master AS SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$cnt_finalize_school		=	$this->db->count_all_results();
		if ($cnt_school_master > $cnt_finalize_school)
		{
			$nt_confirm_school	=	$cnt_school_master - $cnt_finalize_school;
			$error_array		=	array();
			$error_array[]		=	$nt_confirm_school.' schools are yet to confirm the data entry list';
			$return_array['error_array']	=	$error_array;
			return $return_array;
		}
		else
		{
			$data						=	array();
			$data['master_confirm']		=	'Y';
			$this->db->where('sub_district_code',$sub_district_code);
			$this->db->update('school_master',$data);
			
			$data						=	array();
			$data['confirm_data_entry']	=	'Y';
			$this->db->where('sub_district_code',$sub_district_code);
			$this->db->update('sub_district_master',$data);
			
			
		}
	}
}

?>