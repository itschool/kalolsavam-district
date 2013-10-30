<?php
class Special_Order_Entry extends Controller {
	function Special_Order_Entry()
	{
		parent::Controller();
		$this->Session_Model->is_user_logged(true);
		$this->template->write_view('menu', 'menu', '');
		$this->load->model('schools/Registration_Model');
		//$this->template->write_view('left_panel', 'menu_left', '');
		$this->load->library('upload');
		$this->load->library('image_lib');	
		$this->load->model('photos/Photos_Model');	
		$this->template->add_js('js/photo/upload_photo.js');
		$this->Content['is_edit']	=	'yes';
	}
	
	function index($message = array())
	{	
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if (count(@$message['error_array']) > 0)
		{
			foreach(@$message['error_array'] as $error)
			{
				$this->template->write('error',$error.'<br>');
			}
		}
		$schoolCode	=	'';
		if($this->input->post('hidSchoolId')){
			$schoolCode	=	$this->input->post('hidSchoolId');
		}
	
		if($schoolCode){
			$this->Content['school_show']			=	'show';
			$this->Content['school_details']		= 	$this->Registration_Model->get_school_details($schoolCode);
			$this->Content['participant_details']	= 	$this->Registration_Model->get_special_order_participant_details($schoolCode);
			$this->Content['Photo']					=	$this->Photos_Model->get_special_entry_photo($this->Content);
			
			$this->Content['participants']			= 	$this->General_Model->get_participant_details_combo($schoolCode);
			$this->Content['orders']				= 	$this->General_Model->prepare_select_box_data('special_order_master','spo_id, spo_title','','Select Order','spo_id');
			
		} else {
			$this->Content = array();
		}
		$this->template->write_view('content', 'schools/special_order_entry', $this->Content);
		$this->template->load();
	}

	function get_school_details(){
		
		$school_details							=	 $this->Registration_Model->get_school_details($this->input->post('code'));
		$this->Content['participant_details']	=	 $this->Registration_Model->get_special_order_participant_details($this->input->post('code'));
		$this->Content['Photo']					=	$this->Photos_Model->get_special_entry_photo($this->Content);
		$this->Content['participants']			= 	$this->General_Model->get_participant_details_combo($this->input->post('code'));
		$this->Content['orders']				= 	$this->General_Model->prepare_select_box_data('special_order_master','spo_id, spo_title','','Select Order','spo_id');
		$this->Content['school_details']		=	$school_details;
		if ((int)@$school_details[0]['sd_id'] > 0)
		{
			$this->Content['school_show']	=	'show';
			
		}
		else
		{
			$this->Content['school_show']	=	'';
		    
		}
		$this->load->view('schools/special_order_entry', $this->Content);
	}
	
	
	function get_itemcode_details(){
	
	    //echo "<script>hiiiiiiiii<script>";
	   //echo "<br /><br /><br />kooooooooooooooooooo";
		$school_code	=	$this->input->post('sch_code');
		//echo "<br /><br /><br />kooooooooooooooooooo".$school_code."<br />";
		$item_details	= 	$this->General_Model->get_data('item_master','*',array('item_code' => $this->input->post('code')));
		$capt_details	= 	$this->General_Model->get_data('participant_item_details','*',array('item_code' => $this->input->post('code'),'school_code' => $school_code,'is_captain' => 'Y'));
		
		$this->Content['item_det']		=	$item_details;
		$this->Content['capt_det']		=	$capt_details;
		/*$school_details					=	 $this->General_Model->get_data('school_details','*',array('school_code' => $school_code));*/
		$school_details					=	 $this->Registration_Model->get_school_details($school_code);
		//var_dump($school_details);
		$this->Content['school_details']	=	$school_details;
			//	var_dump($this->Content);
		$this->load->view('schools/group_entry',$this->Content);
	}
	
	
	function save_participant () {
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$save_participant		=	$this->Registration_Model->save_special_order_participant_details();
				
		$this->index($save_participant);
	}
	
	function edit_participant_detials() {
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		//echo "<br /><br />jjjjjjjjjjjjjjjj";
		
		$this->Content['selected_participant']	=	 $this->Registration_Model->get_special_order_participant_details($this->input->post('hidSchoolId'), $this->input->post('hidPiId'));
		//echo "<br /><br />";
		//var_dump($this->Content['selected_participant']);
		$admn					=	$this->Content['selected_participant'][0]['admn_no'];
		$school_code			=	$this->input->post('hidSchoolId');
		
		$fileName				=	$school_code."_".$admn;
		$path					=	$this->Photos_Model->get_Photo($fileName);
		$this->Content['pic']	=	$path;
		
		$this->Content['show_edit']	=	 "show";
		$this->index();
	}
	
	function update_participant_detials() {
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$update_participant		=	$this->Registration_Model->update_participant_details();
		$this->index($update_participant);
	}
	
	function delete_participant_detials () {
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$delete_participant		=	$this->Registration_Model->delete_special_order_participant_details();
		$this->index($delete_participant);
	}
	
	function get_parti_photo()
	{
		$filen	=	$this->input->post('fileName');
		$path	=	$this->Photos_Model->get_Photo($filen);
		echo "<img src='".$path."' width='70' height='70'>";	
		//echo $path;	
	}
	
}
?>