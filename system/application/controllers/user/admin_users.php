<?php
class Admin_Users extends Controller {

	function Admin_Users()
	{
		parent::Controller(); 
		$this->template->add_js('js/user/adminusers.js');	
		$this->load->model('user/Admin_Users_Model');
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->template->write_view('menu', 'menu', '');
		$this->Session_Model->is_user_logged();
		if($this->session->userdata('USER_GROUP') != 'W'){
			header ( "Location: ". base_url(). 'welcome/' );
		}
	}
	function index()
	{
		//if(!isset($this->Content))
		//$this->Content				=	array();
		
		$this->Content['states']		=	$this->General_Model->prepare_select_box_data('rev_district_master', 'rev_district_code, rev_district_name','','Select District','rev_district_code');
		$this->Content['user_types']	=	$this->General_Model->prepare_select_box_data('user_types', 'user_type_id, type_name','user_type_id NOT IN (4,5)','-- Select User Type --','user_type_id');
		$this->template->write_view('content', 'user/add_admin_users', $this->Content);
		$this->Content['retvalue']	=	$this->Admin_Users_Model->exist_admin_details();
		if(count($this->Content['retvalue'])>0 || isset($_POST['filter'])){
			if(isset($_POST['cmbSubDistrictFilter']) && trim($_POST['cmbSubDistrictFilter']) != 0) {
				$this->Content['sub_districts']	=	$this->General_Model->get_subdistrict_details_combo(trim($_POST['cmbDistrictFilter']));
			}
			if(isset($_POST['cmbSchoolFilter']) && trim($_POST['cmbSchoolFilter']) != 0) {
				$this->Content['schools']	=	$this->General_Model->get_school_details_combo(trim($_POST['cmbSubDistrictFilter']));
			}
			
			$this->template->write_view('content', 'user/admin_users',$this->Content);
		}
		$this->template->load();
	}
	
	function add_admin()
	{
		if($this->Admin_Users_Model->check_username_exists('', $this->input->post('txtNewUserName')))
		{
			$this->template->write('error', 'User name already exists');
			$this->index();
			return;
		}
		$data['user_name']			=	$this->input->post('txtNewUserName');
		$data['password']			=	get_encr_password($this->input->post('txtNewPassword'));
		$data['generated_password']	= 	$this->input->post('txtNewPassword');
		$data['user_type']			=	$this->input->post('userType');
		$data['user_group']			=	'A';
		$data['rev_district_code']	=	$this->input->post('cmbDistrict');
		$data['sub_district_code']	=	$this->input->post('cmbSubDistrict');
		$data['school_code']		=	$this->input->post('cmbSchool');
		$data['is_change_password']	=	"N";
		$data['created_by']			=	$this->session->userdata('USERID');
		if ($this->Admin_Users_Model->save_admin_details ($data)) $this->template->write('message', 'Admin details saved successfully');
		else $this->template->write('error', 'Failed to Add Admin Details', $this->Content);
		
		
		$this->index();
	}
	
	function edit_admin_detials()
	{
		$this->Content['selected_user']	=	$this->Admin_Users_Model->select_admin_details();
		
		$this->Content['subdistricts']	=		$this->General_Model->get_subdistrict_details_combo($this->Content['selected_user'][0]['rev_district_code']);
		$this->Content['schools']		=		$this->General_Model->get_school_details_combo($this->Content['selected_user'][0]['sub_district_code']);
		$this->Content['show_generate_admin']	= '1';
		$this->index();
	}
	
	function update_admin_detials()
	{
		$userId	=	$this->input->post('hidUserId');
		if($this->Admin_Users_Model->check_username_exists($userId, $this->input->post('txtNewUserName')))
		{
			$this->template->write('error', 'User name already exists');
			$this->index();
			return;
		}
		$this->Admin_Users_Model->update_admin_details();
		$this->template->write('message', 'Admin details updated successfully');
		$this->index();
	}
	
	function delete_admin_detials()
	{
		$this->Admin_Users_Model->delete_user_details();
		$this->index();
	}
	
	function generate_sub_dist_admins ()
	{
		$sub_dist_admin_details	= $this->Admin_Users_Model->get_all_sub_dist_admins ();
		if (is_array ($sub_dist_admin_details) && count($sub_dist_admin_details) > 0)
		{
			$error_sub_dist	= array();
			$exist_sub_dist	= array();
			$new_sub_dist	=  array();
			foreach ($sub_dist_admin_details as $sub_dist_admin_details)
			{
				$data['user_name']	= strtolower(str_replace(' ', '_',trim($sub_dist_admin_details['sub_district_name'])));
				if (!$this->Admin_Users_Model->check_username_exists('', $data['user_name']))
				{
					$data['generated_password']	= substr(fncUuid (), 0, 8);
					$data['password']			= get_encr_password($data['generated_password']);
					$data['user_type']			= 3;
					$data['user_group']			= 'A';
					$data['rev_district_code']	= $sub_dist_admin_details['rev_district_code'];
					$data['sub_district_code']	= $sub_dist_admin_details['sub_district_code'];
					$data['school_code']		= 'A';
					$data['created_by']			= 0;
					$data['school_code']		= 0;
					$data['is_change_password']	= "N";
					$data['created_by']			= $this->session->userdata('USERID');
					if ($this->Admin_Users_Model->save_admin_details ($data)) 
					{
							$new_sub_dist[]		= $sub_dist_admin_details['sub_district_name'];
					}
					else
					{
						$error_sub_dist[] = $sub_dist_admin_details['sub_district_name'];
					}
					
				}
				else $exist_sub_dist[]	= $data['user_name'];
			}
		}
		$message_info 			= $error_message_info = '';
		$total_count			= (count($error_sub_dist) > 0)? 0: count($error_sub_dist);
		if (count($exist_sub_dist) > 0) $error_message_info .= '<p>'.count($exist_sub_dist).' Sub District Admin(s) Exists.</p>';
		if (count($error_sub_dist) > 0) $error_message_info .= '<p>Create Sub-District admin Failed : '.count($error_sub_dist).'</p>';
		else if (count($new_sub_dist) > 0) $message_info .= '<p>'.count($new_sub_dist).' Sub-District Admins are Created. </p>';
		$this->template->write('message', $message_info);
		$this->template->write('error', $error_message_info);
		$this->index();
	}
	function sub_district_admin_list_pdf_creation()
	{
		$this->load->library('HTML2PDF');
		$this->Content['retvalue']	= $this->Admin_Users_Model->exist_admin_details();
		$this->Content['user_type_name'] = $this->Content['district_name'] = $this->Content['sub_district_name'] ='';
		if(isset($_POST['userTypeFilter']) && trim($_POST['userTypeFilter']) != 0) 
		{
			$user_type_name	= $this->General_Model->get_single_column_value('user_types', 'type_name', 'user_type_id = '.trim($_POST['userTypeFilter']));
			$this->Content['user_type_name'] = $user_type_name[0];
		}
		if(isset($_POST['cmbDistrictFilter']) && trim($_POST['cmbDistrictFilter']) != 0) 
		{
			$district_name	= $this->General_Model->get_single_column_value('rev_district_master', 'rev_district_name', 'rev_district_code = '.trim($_POST['cmbDistrictFilter']));
			$this->Content['district_name'] = $district_name[0];
		}
		if(isset($_POST['cmbSubDistrictFilter']) && trim($_POST['cmbSubDistrictFilter']) != 0) 
		{
			$sub_district_name	= $this->General_Model->get_single_column_value('sub_district_master', 'sub_district_name', 'sub_district_code = '.trim($_POST['cmbSubDistrictFilter']));
			$this->Content['sub_district_name'] = $sub_district_name[0];
		}
		$content					= $this->load->view('report/prereportpdf/list_sub_district_details',$this->Content, true);
		
		
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'I');
	}
}
	?>