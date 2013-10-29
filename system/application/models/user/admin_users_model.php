<?php
class Admin_Users_Model extends Model{
	function Admin_Users_Model()
	{
		parent::Model();
	}
	function save_admin_details ($data)
	{
		$this->db->insert('user_master', $data);
		$userId	=	$this->db->insert_id();
		if ($this->save_user_rights($userId)) return TRUE;
		else FALSE;
	}
	
	function update_admin_details()
	{
		$userId	=	$this->input->post('hidUserId');
		$data['user_name']			=	$this->input->post('txtNewUserName');
		if(isset($_POST['txtNewPassword']) && trim($_POST['txtNewPassword']) != '')
		{
			$data['password']			=	get_encr_password($this->input->post('txtNewPassword'));
			$data['generated_password']	=	$this->input->post('txtNewPassword');
			$data['is_change_password']	=	'N';
		}
		$data['created_by']			=	$this->session->userdata('USERID');
		$data['user_type']			=	$this->input->post('userType');
		$data['rev_district_code']	=	$this->input->post('cmbDistrict');
		$data['sub_district_code']	=	$this->input->post('cmbSubDistrict');
		$data['school_code']		=	$this->input->post('cmbSchool');
		$this->db->where('user_id', $userId);
		$this->db->update('user_master',$data);
		
		$this->db->where('user_id', $userId	);		
		$this->db->delete('user_rights');
		$this->save_user_rights($userId);
		
	}
	
	function exist_admin_details()
	{
		$sessionID=$this->session->userdata('USERID');
		if((isset($_POST['filter']) && trim($_POST['filter']) != '') || (isset($_POST['generate_pdf']) && trim($_POST['generate_pdf']) != '') || (isset($_POST['userTypeFilter']) && trim($_POST['userTypeFilter']) != 0)){
			
			if(isset($_POST['userTypeFilter']) && trim($_POST['userTypeFilter']) != 0) {
				$this->db->where('UM.user_type', trim($_POST['userTypeFilter']));
			}
			if(isset($_POST['cmbDistrictFilter']) && trim($_POST['cmbDistrictFilter']) != 0) {
				$this->db->where('UM.rev_district_code', trim($_POST['cmbDistrictFilter']));
			}
			if(isset($_POST['cmbSubDistrictFilter']) && trim($_POST['cmbSubDistrictFilter']) != 0) {
				$this->db->where('UM.sub_district_code', trim($_POST['cmbSubDistrictFilter']));
			}
			if(isset($_POST['cmbSchoolFilter']) && trim($_POST['cmbSchoolFilter']) != 0) {
				$this->db->where('UM.school_code', trim($_POST['cmbSchoolFilter']));
			}
		}
		$this->db->where('UM.created_by',$sessionID);
		$this->db->from('user_master AS UM');
		$this->db->join('rev_district_master AS RDM','RDM.rev_district_code=UM.rev_district_code', 'left');
		$this->db->join('sub_district_master AS SDC','SDC.sub_district_code=UM.sub_district_code', 'left');
		$this->db->orderby('rev_district_code,sub_district_code,school_code');
		$this->db->select('UM.*, user_id, user_name,password,user_type,is_change_password,created_by ,generated_password, RDM.rev_district_name, SDC.sub_district_name');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function get_admin_registration()
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
	
	function get_user_rights() 
	{
		$this->db->where('user_type_id', $this->input->post('userType'));
		$this->db->from('user_right_functionalities');
		$this->db->select('rf_functionality, rf_id');
		$result = $this->db->get();
		return $result->result_array();
	}
	
	function select_admin_details() 
	{
		$this->db->where('user_id', $this->input->post('UserIdty'));
		$this->db->from('user_master');
		$this->db->select('user_id, user_name,user_type, rev_district_code, sub_district_code, school_code');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	
	function delete_user_details(){
		$this->db->where('user_id', $this->input->post('UserIdty'));
		$this->db->delete('user_master');
		$this->db->where('user_id', $this->input->post('UserIdty'));
		$this->db->delete('user_rights');
	}
	
	function save_user_rights($userId)
	{
		$rights	=	$this->get_user_rights();
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
		return TRUE;
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
	function get_all_sub_dist_admins ()
	{
		$this->db->select('sdm.sub_district_name, sdm.edu_district_code, sdm.rev_district_code, sub_district_code');
		$this->db->from('sub_district_master sdm');
		if ('' != $this->input->post('cmbDistrict') && 0 != $this->input->post('cmbDistrict')) $this->db->where ('rev_district_code', $this->input->post('cmbDistrict'));
		if ('' != $this->input->post('cmbSubDistrict') && 0 != $this->input->post('cmbSubDistrict')) $this->db->where ('sub_district_code', $this->input->post('cmbSubDistrict'));
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
}

?>