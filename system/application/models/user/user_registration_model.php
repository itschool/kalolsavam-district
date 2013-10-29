<?php
class User_Registration_Model extends Model{
	function User_Registration_Model()
	{
		parent::Model();
	}
	function save_user_details()
	{
		$data['user_name']			=	$this->input->post('txtNewUserName');
		$data['password']			=	get_encr_password($this->input->post('txtNewPassword'));
		$data['generated_password']	=	$this->input->post('txtNewPassword');
		
		$data['rev_district_code']	=	$this->session->userdata('DISTRICT');
		$data['sub_district_code']	=	$this->session->userdata('SUB_DISTRICT');
		$data['school_code']		=	$this->session->userdata('SCHOOL_CODE');
		
		$data['user_type']			=	$this->session->userdata('USER_TYPE');
		$data['is_change_password']	=	"N";
		$data['created_by']			=	$this->session->userdata('USERID');
		$this->db->insert('user_master',$data);
		$userId	=	$this->db->insert_id();
		$this->save_user_rights($userId);
		
	}
	
	
	
	function update_user_details()
	{
		$userId	=	$this->input->post('hidUserId');
		$data['user_name']			=	$this->input->post('txtNewUserName');
		if(isset($_POST['txtNewPassword']) && trim($_POST['txtNewPassword']) != '')
			$data['password']			=	get_encr_password($this->input->post('txtNewPassword'));
		$data['created_by']			=	$this->session->userdata('USERID');
		$this->db->where('user_id', $userId);
		$this->db->update('user_master',$data);
		
		$this->db->where('user_id', $userId	);		
		$this->db->delete('user_rights');
		$this->save_user_rights($userId);
		
	}
	
	function exist_user_details()
	{
		$sessionID=$this->session->userdata('USERID');
		$this->db->where('UM.created_by',$sessionID);
		$this->db->from('user_master AS UM');
		$this->db->orderby('user_name', 'ASC');
		$this->db->select('UM.*, user_id, user_name,password,user_type,is_change_password,created_by ');
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
	
	function get_user_rights() 
	{
		$this->db->where('user_id', $this->session->userdata('USERID'));
		$this->db->where('user_group', 'A');
		$this->db->where('admin_user_only', 'N');
		$this->db->from('user_master UM');
		$this->db->join('user_right_functionalities UF', 'UM.user_type = UF.user_type_id', 'INNER');
		$this->db->join('user_right_functionality_label FL', 'FL.label_id = UF.label_id', 'INNER');
		$this->db->order_by('FL.label_id, display_order');
		$this->db->select('rf_functionality, rf_id, label_name');
		$result = $this->db->get();
		return $result->result_array();
	}
	
	function select_user_details() 
	{
		$this->db->where('user_id', $this->input->post('UserIdty'));
		$this->db->from('user_master');
		$this->db->select('user_id, user_name');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function select_user_rights()
	{
		$this->db->where('user_id', $this->input->post('UserIdty'));
		$this->db->from('user_rights');
		$this->db->select('rf_id');
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
				if(isset($_POST['chkRight_'.$rights[$i]['rf_id']])){
					$user_right['user_id']	=	$userId;
					$user_right['rf_id']	=	$rights[$i]['rf_id'];
					$this->db->insert('user_rights',$user_right);
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
}

?>