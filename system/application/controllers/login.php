<?php
class Login extends Controller {

	function Login()
	{
		parent::Controller(); 
		//$this->template->add_js('js/user/user.js');	
		$this->load->model('Session_Model'); 
		$this->load->model('user/User_Registration_Model');
		$this->load->model('General_Model');
		$this->load->model('login/Login_Model');
	}
	
	function index()
	{
		$this->Contents	= array();
		if(isset($_POST['login'])){
			$this->form_validation->set_rules('txtUserName', 'User name', 'required|');
			$this->form_validation->set_rules('txtPassword', 'Password', 'required');
			if ($this->form_validation->run() == false)
			{
				$this->template->write('error', validation_errors().'<br><br>');
			}
			else
			{
				$email		= mysql_real_escape_string( $_POST['txtUserName'] );
				$password	= $_POST['txtPassword'];
				//echo $password;
				$login	  = $this->Login_Model->logincheck($email, $password);
				//print(count($login));
				if(count($login) > 0 and is_array($login)){
					// Set Session 
					$set_session_data 	= array('USERID' 		=> $login[0]['user_id'], 
												'CHANGEPWD' 	=> $login[0]['is_change_password'],
												'USER_GROUP'	=> $login[0]['user_group'],
												'DISTRICT'		=>	$login[0]['rev_district_code'],
												'SUB_DISTRICT'	=>	$login[0]['sub_district_code'],
												'SCHOOL_CODE'	=>	$login[0]['school_code'],
												'USER_TYPE'		=>	$login[0]['user_type']);
					if($login[0]['sub_district_code'] != '' && $login[0]['sub_district_code'] != 0){
						$rev_district	=	$this->General_Model->get_single_column_value('sub_district_master', 'edu_district_code', 'sub_district_code = "'.$login[0]['sub_district_code'].'"');
						$set_session_data['EDU_DISTRICT']	=	$rev_district[0];
					} else {
						$set_session_data['EDU_DISTRICT']	=	'';
					}							
					$this->Session_Model->set_session($set_session_data);
					if($login[0]['is_change_password'] == 'N'){
						redirect('login/change_password/'); 
					} else {
						redirect('welcome/'); 
					}
				}
				
			}
		}
		
		if(isset($login) && is_int($login)){ 
			if($login==2)
			{
				$this->template->write('error', 'Sorry, we can\'t identify your login details. Did you make a mistake when typing the User name / Password?');
			} 
			
		}
		
		$this->template->write('title', '');
		$this->template->write_view('header', 'header', $this->Contents);
		$this->template->write_view('content', 'login/user_login', $this->Contents);
		$this->template->load();
	}
	
	function change_password()
	{
		$this->Content = array();
		$this->template->write('title', '');
		$this->Content['retvalue']	=	$this->Login_Model->give_user_details();
		$checkval			=	$this->Login_Model->check_pwd_details();
		$this->Content['checkval']  =$checkval;
		//echo  count($checkval);
		$this->template->write_view('content', 'login/change_pwd',$this->Content);
		$this->template->load();
	}
	function change_Pwd_insert()
	{
		$this->Contents=array();
		$checkval			=	$this->Login_Model->check_pwd_details();
		$this->Contents['checkval']  =$checkval;
 		$password	 = $_POST['txtOLDPassword'];
		$Newpassword = get_encr_password($_POST['txtNewPassword']);
		$login	  = $this->Login_Model->checkexistpwd($password);
		
		if(count($login) > 0 ){
				if($login[0]['password']!=$Newpassword){
					$this->Login_Model->save_chgpwd_details();
					redirect('welcome/');
				} 
				else {
				
					$this->template->write('error', 'Old Password and New Password are same!!! Enter a new one');
					$this->template->write('title', '');
					$this->template->write_view('content', 'login/change_pwd', $this->Contents);
					$this->template->load();
					//redirect('login/change_password/'); 
				}
			}
			else {
		
				$this->template->write('error', 'Old Password entered is wrong');
				$this->template->write('title', '');
				$this->template->write_view('content', 'login/change_pwd', $this->Contents);
				$this->template->load();
				//redirect('login/change_password/'); 
			} 
	}
	function logout()
	{
		$this->Login_Model->logout_user();
		//$sessiondata = array('USERID' => '', 'CHANGEPWD' => '');
		//$this->session->unset_userdata($sessiondata);
		redirect('login');
	}
}

/* End of file login.php */
/* Location: ./system/application/controllers/login.php */
?>