<?php
class Login_Model extends Model{
	function Login_Model()
	{
		parent::Model();
	}
	function logincheck($userName,$password)
	{
		$logdata['ip']				=	$this->input->ip_address();
		$logdata['user_name']		=	$userName;
		$this->db->where('user_name',$userName);
		$user_master		=	$this->db->get('user_master');
		if ($user_master->num_rows() > 0)
		{
			$user							=	$user_master->result_array();
			$logdata['user_id']				=	$user[0]['user_id'];
			$logdata['rev_district_code']	=	$user[0]['rev_district_code'];
			$logdata['sub_district_code']	=	$user[0]['sub_district_code'];
			$logdata['school_code']			=	$user[0]['school_code'];
		}
		
		$this->db->where('user_name',$userName);
		$this->db->where('password',get_encr_password($password));
		//$this->db->where('password',$password);
		$result= $this->db->get('user_master');
		
		if ($result->num_rows() > 0)
		{
			$logdata['status']			=	'L';
		}
		else
		{
			$logdata['status']			=	'F';
			return 2;
		}
		$this->db->insert('z_login_log',$logdata);
		
		return $result->result_array();
		
		
	}
	
	function give_user_details()
	{
		$USERID=$this->session->userdata('USERID');
		$this->result=array();
		$this->db->where('UM.user_id',$USERID);
		$this->db->from('user_master AS UM');	
		$this->db->select('UM.*, user_id, user_name,password,is_change_password,created_by');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	function check_pwd_details()
	{
		$USERID=$this->session->userdata('USERID');
		
		$this->result=array();
		$this->db->where('UM.user_id',$USERID);
		$this->db->from('user_master AS UM');	
		$this->db->select('UM.*, user_id, user_name,password,is_change_password,created_by');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function checkexistpwd($pwd)
	{
		$USRID=$this->session->userdata('USERID');
		$this->db->where('user_id',$USRID);
		$this->db->where('password',get_encr_password($pwd));
		$result= $this->db->get('user_master');
		return $result->result_array();
	}
	
	
	
	function save_chgpwd_details()
	{
		$this->db->trans_start();
		
		$USRID					=	$this->session->userdata('USERID');
		$this->db->where('user_id',$USRID);
		$this->db->where('is_change_password','N');
		$this->db->where('user_group','A');
		$user_master	=	$this->db->get('user_master');
		if ($user_master->num_rows() > 0)
		{
			$user				=	$user_master->result_array();
			$district_code	=	$user[0]['rev_district_code'];	
			if ($district_code)
			{
				$this->db->where('rev_district_code !=',$district_code);
				$this->db->where('user_group !=','W');
				$this->db->delete('user_master');
				
				$this->db->where('rev_district_code !=',$district_code);
				$school_master		=	$this->db->get('school_master');
				foreach($school_master->result_array() as $school)
				{
					$school_code	=	$school['school_code'];
					
					//$this->db->where('school_code',$school_code);
					//$this->db->delete('participant_item_details');
					
					//$this->db->where('school_code',$school_code);
					//$this->db->delete('participant_details');
					
					$this->db->where('school_code',$school_code);
					$this->db->delete('school_details');
					
				}
				$this->db->where('rev_district_code !=',$district_code);
				$this->db->delete('school_master');
				
			}		
		}
		
		
		
		$data['password']		=	get_encr_password($this->input->post('txtNewPassword'));
		$data['is_change_password']="Y";
		$data['name']           =  $this->input->post('Name');
		$data['mobile']         =  $this->input->post('Mobile_Number');
		$data['email']          =  $this->input->post('Email_id');
		$this->db->where('user_id',$USRID);
		$this->db->update('user_master',$data);

		$this->session->set_userdata(array('CHANGEPWD' => 'Y'));
		
		$this->db->where('user_id',$USRID);
		$user_master	=	$this->db->get('user_master');
		
		if ($user_master->num_rows() > 0)
		{
			$user							=	$user_master->result_array();
			$logdata['user_id']				=	$user[0]['user_id'];
			$logdata['rev_district_code']	=	$user[0]['rev_district_code'];
			$logdata['sub_district_code']	=	$user[0]['sub_district_code'];
			$logdata['school_code']			=	$user[0]['school_code'];
			$logdata['ip']					=	$this->input->ip_address();
			$logdata['user_name']			=	$user[0]['user_name'];
			$logdata['status']				=	'C';
			$this->db->insert('z_login_log',$logdata);
		}
		
		
		$this->db->trans_complete(); 
		
	}
	
	function logout_user()
	{
	
		$user_id		=	$this->session->userdata('USERID');
		$this->db->where('user_id',$user_id);
		$user_master	=	$this->db->get('user_master');
		
		if ($user_master->num_rows() > 0)
		{
			$user							=	$user_master->result_array();
			$logdata['user_id']				=	$user[0]['user_id'];
			$logdata['rev_district_code']	=	$user[0]['rev_district_code'];
			$logdata['sub_district_code']	=	$user[0]['sub_district_code'];
			$logdata['school_code']			=	$user[0]['school_code'];
			$logdata['ip']					=	$this->input->ip_address();
			$logdata['user_name']			=	$user[0]['user_name'];
			$logdata['status']				=	'O';
			$this->db->insert('z_login_log',$logdata);
		}
		
		
		$sessiondata 	= array('USERID' 		=> '', 
								'USERID_LIVE' => '',
								'CHANGEPWD' 	=> '',
								'USER_GROUP'	=> '',
								'DISTRICT'		=> '',
								'SUB_DISTRICT'	=> '',
								'SCHOOL_CODE'	=> '',
								'EDU_DISTRICT'	=> '',
								'USER_TYPE'		=> '');
									
		$this->session->unset_userdata($sessiondata);
	}
	
	function get_cluster_details ($subdist) {
		//$user_id		=	$this->session->userdata('USERID');
		//$subdist		=	$this->input->post('sel_sub_district_id');
		if (empty($subdist)) $subdist	= $this->session->userdata('SUB_DISTRICT') ;
		
		$this->db->select('UM.user_id, UM.user_name,
		COUNT(UC.school_code) AS total, COUNT(SD.school_code) AS data_entered, COUNT(SF.is_finalize) AS finialized');
		$this->db->from('user_cluster AS UC');
		$this->db->join('user_master AS UM','UM.user_id = UC.user_id');
		$this->db->join('school_details AS SD','SD.school_code = UC.school_code','LEFT');
		$this->db->join('school_details AS SF',"SF.school_code = UC.school_code AND SF.is_finalize = 'Y'",'LEFT');
		//$this->db->where('UM.user_id',$user_id);
		$this->db->where('UM.sub_district_code',$subdist);
		$this->db->order_by('SD.is_finalize, data_entered');
		$this->db->group_by('UM.user_id');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function get_unclustersch_details($subdist)
	{
	$user_id		=	$this->session->userdata('USERID');
	if (empty($subdist)) $subdist	= $this->session->userdata('SUB_DISTRICT') ;
	$this->db->select('count( m.school_code ) AS mcode');
	$this->db->from('school_master AS m');
	$this->db->where('m.sub_district_code',$subdist);
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function get_unclustersch_finentry($subdist)
	{
		$this->db->select('count( m.school_code ) AS ent, count( m2.school_code ) AS fin');
		$this->db->from('school_details m');
		$this->db->join('school_master AS w',"w.school_code = m.school_code AND w.sub_district_code ='$subdist'");
		$this->db->join('school_details AS m2',"m.school_code = m2.school_code AND m2.is_finalize = 'Y'",'LEFT');
		$this->db->where("m.school_code NOT IN (SELECT c.school_code FROM user_cluster c JOIN school_master t ON c.school_code = t.school_code AND t.sub_district_code ='$subdist')");
		$ret=$this->db->get();
		return $ret->result_array();
		/*
		$qrt="SELECT count( m.school_code ) AS ent, count( m2.school_code ) AS fin
			FROM school_details m
			JOIN school_master w ON w.school_code = m.school_code
			AND w.sub_district_code ='$subdist'
				LEFT JOIN school_details AS m2 ON m.school_code = m2.school_code
			AND m2.is_finalize = 'Y'
			WHERE m.school_code NOT 
			IN (

			SELECT c.school_code
			FROM user_cluster c
			JOIN school_master t ON c.school_code = t.school_code
			AND t.sub_district_code ='$subdist'
			) ";
			$fest_detail1		=	$this->db->query($qrt);
		return $fest_detail1->result_array();
		*/

	}
	
	
	function get_sub_school_details($subdist = '') {
		$user_id		=	$this->session->userdata('USERID');
		//$subdist		=	$this->input->post('sel_sub_district_id');
		if (empty($subdist)) $subdist	= $this->session->userdata('SUB_DISTRICT') ;
		
		$this->db->where('sub_district_code',$subdist);
		$total_school	=	$this->db->count_all_results('school_master');
		
		$this->db->where('sub_district_code',$subdist);
		$cluster_school	=	$this->db->count_all_results('user_cluster');
		
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$data_entered	=	$this->db->count_all_results('school_master AS SM');
		
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('SD.is_finalize','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$confirmed	=	$this->db->count_all_results('school_master AS SM');
		
		
		$this->db->select('confirm_data_entry');
		$this->db->where('sub_district_code', $subdist);
		$confirm_data_entry	= $this->db->get('sub_district_master');
		$confirm_data_entry	= $confirm_data_entry->result_array();
		
		
		$return_array['total_school']		=	$total_school;
		$return_array['cluster_school']		=	$cluster_school;
		$return_array['data_entered']		=	$data_entered;
		$return_array['confirmed']			=	$confirmed;
		$return_array['confirm_data_entry']	=	$confirm_data_entry[0]['confirm_data_entry'];
		
		return $return_array;
		
	}
	function schooldetails($userId='')
	{
		
		$user_id		=	$userId ? $userId : $this->session->userdata('USERID');
		$subdist		=	$this->session->userdata('SUB_DISTRICT');
		$usrtype        =   $this->session->userdata('USER_TYPE');
		if (3 > $usrtype)
		{
			$user_id		=	$this->input->post('hidClusterId');
			$this->db->select('sub_district_code');
			$this->db->where ('user_id', $user_id);
			$this->db->group_by('user_id');
			$result		= $this->db->get('user_cluster');
			$result		= $result->result_array();
			$subdist	= $result[0]['sub_district_code'];
		}
		
		$this->db->select('sd.school_code, sd.sub_district_code, sm.school_name,dt.is_finalize');
		$this->db->from('user_cluster AS sd');
		$this->db->join('school_master AS sm','sm.school_code = sd.school_code');
		$this->db->join('school_details AS dt','dt.school_code=sd.school_code','LEFT');
		$this->db->where('sd.user_id',$user_id);
		$this->db->where('sd.sub_district_code',$subdist);
		$this->db->order_by('sd.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function clusterdetails($userId='')
	{
		
		$user_id		=	$userId ? $userId : $this->session->userdata('USERID');
		$usrtype        =   $this->session->userdata('USER_TYPE');
		if (3 > $usrtype)
		{
			$user_id		=	$this->input->post('hidClusterId');
		}
		$this->db->select('user_name, name, mobile, email');
		$this->db->where('user_id', $user_id);
		$user_details		=	$this->db->get('user_master');
		return $user_details->result_array();
	}
	
	
	function schoolpartcip()
	{
		$this->db->select('sd.school_code');
		$this->db->from('school_details AS sd');
		$this->db->order_by('sd.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function get_confirmation_status($school_code)
	{
		$this->db->select('is_finalize');
		$this->db->where('school_code', $school_code);
		$this->db->from('school_details');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function set_confirmation_status($school_code, $status)
	{
		$this->db->where('school_code', $school_code);
		if ($this->db->update('school_details', array('is_finalize' => $status)))
		{
			$data					=	array();
			$data['school_code']	=	$school_code;
			$data['status']			=   $status;
			$data['ip']				=	$this->input->ip_address();
			$data['user_id']		=	$this->session->userdata('USERID');
			if ($this->db->insert('z_school_confirm_log', $data))
			{
				if ($status == 'N') return 'No';
				else if ($status == 'Y') return 'Yes';
			}
		}
	}
	
	function get_district_school_details($dist) 
	{
		$this->db->where('rev_district_code', $dist);
		$total_school	=	$this->db->count_all_results('school_master');
		
		$this->db->where('sub_district_code IN (SELECT sub_district_code FROM sub_district_master WHERE rev_district_code= '.$dist.')', NULL, FALSE);
		$cluster_school	=	$this->db->count_all_results('user_cluster');
		
		$this->db->where('SM.sub_district_code IN (SELECT SDM.sub_district_code FROM sub_district_master SDM WHERE SDM.rev_district_code= '.$dist.')', NULL, FALSE);
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$data_entered	=	$this->db->count_all_results('school_master AS SM');
		
		$this->db->where('SM.sub_district_code IN (SELECT SDM.sub_district_code FROM sub_district_master SDM WHERE SDM.rev_district_code= '.$dist.')', NULL, FALSE);
		$this->db->where('SD.is_finalize','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$confirmed	=	$this->db->count_all_results('school_master AS SM');
		
		$return_array['total_school']		=	$total_school;
		$return_array['cluster_school']		=	$cluster_school;
		$return_array['data_entered']		=	$data_entered;
		$return_array['confirmed']			=	$confirmed;
		
		return $return_array;
	}
	
	function nonclustdetails_sname($subdist)
	{
		if (empty($subdist)) $subdist	= $this->session->userdata('SUB_DISTRICT') ;
		$this->db->select('m.school_code, m2.school_name,m.is_finalize');
		$this->db->from('school_details m');
		$this->db->join('school_master AS m2',"m.school_code = m2.school_code AND m2.sub_district_code ='$subdist'");
		$this->db->where("m.school_code NOT IN (SELECT c.school_code FROM user_cluster c JOIN school_master t ON c.school_code = t.school_code AND t.sub_district_code ='$subdist')");
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		
		/*
		$qrt="SELECT m.school_code, m2.school_name,m.is_finalize
			FROM school_details m
			JOIN school_master AS m2 ON m.school_code = m2.school_code
			AND m2.sub_district_code ='$subdist'
			WHERE m.school_code NOT
			IN (
				SELECT c.school_code
				FROM user_cluster c
				JOIN school_master t ON c.school_code = t.school_code
				AND t.sub_district_code ='$subdist')";
				$fest_detail1		=	$this->db->query($qrt);
				return $fest_detail1->result_array();
				*/
	}
	
	function nonclustdetails_nosname($subdist)
	{
		if (empty($subdist)) $subdist	= $this->session->userdata('SUB_DISTRICT') ;
		$this->db->select('m2.school_name, m2.school_code');
		$this->db->from('school_master AS m2');
		$this->db->where('m2.sub_district_code',$subdist);
		$this->db->where("m2.school_code NOT IN (SELECT c.school_code FROM user_cluster c JOIN school_master t ON c.school_code = t.school_code AND t.sub_district_code = '$subdist')");
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		
	/*$qrt="SELECT m2.school_name, m2.school_code
		  FROM school_master AS m2
			WHERE m2.sub_district_code = '$subdist'
			AND m2.school_code NOT
			IN (
			SELECT c.school_code
			FROM user_cluster c
			JOIN school_master t ON c.school_code = t.school_code
			AND t.sub_district_code = '$subdist')";
			$fest_detail1		=	$this->db->query($qrt);
				return $fest_detail1->result_array();
		*/
	}
	
	function get_sub_admin_details($sub_district_code)
	{
		$this->db->where('sub_district_code',$sub_district_code);
		$this->db->where('user_group','A');
		$user_master	=	$this->db->get('user_master');
		return $user_master->result_array();
	}
	
	function makeResultTime_Table(){
		
		 $query1="DROP TABLE IF EXISTS `result_time`
";
         $dropTable		=$this->db->query($query1);
		 $query2="CREATE TABLE IF NOT EXISTS `result_time` (
				  `result_no` int(5) NOT NULL,
				  `item_code` mediumint(9) NOT NULL,
				  `confirm_date` date NOT NULL,
				  `confirm_time` time NOT NULL,
				  `is_finalized` char(1) NOT NULL,
				  `is_reset` mediumint(2) NOT NULL,
				  PRIMARY KEY (`item_code`)
				)";
         $makeTable		=$this->db->query($query2);
         return  true;
		
		}
		
		function insertSubdist(){
		
				$query2="INSERT INTO `kalolsavam_district`.`sub_district_master` (
						`sub_district_code` ,
						`sub_district_name` ,
						`edu_district_code` ,
						`rev_district_code` ,
						`confirm_data_entry`
						)
						VALUES (
						'477', 'Koduvally', '47', '11', 'N')";
         	$makeTable		=$this->db->query($query2);
         	return  true;
		}
		
	  function resetSchools(){
			$query1			=	"UPDATE `school_master` SET `master_confirm` = 'N' WHERE 1";
			$makeTable1		=	$this->db->query($query1);
			$query2			=	"UPDATE `school_details` SET `is_finalize` = 'N' WHERE 1";
			$makeTable		=	$this->db->query($query2);
         	return  true;
	  }
}

?>