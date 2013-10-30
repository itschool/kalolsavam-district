<?php
class Kalolsavam extends Controller {

	function Kalolsavam()
	{
		parent::Controller();
		$this->load->model('admin/Kalolsavam_Model');
		$this->template->add_js('js/admin/admin.js');
		$this->load->model('general_model');
		//$this->Session_Model->is_user_logged(true);
		
		
		$this->Content=array();
		//$this->template->write_view('left_panel', 'menu_left', '');
	}
	
	function index()
	{
		if (is_define_kalolsavam ($this->session->userdata('DISTRICT')))
			$this->template->write_view('menu', 'menu', '');
			
		$this->template->add_js('js/popcalendar.js');
	  	$this->template->add_css('style/calendar.css');
		if (0 == $this->session->userdata('USER_TYPE') || 1 == $this->session->userdata('USER_TYPE'))
		{
			$this->Content['kalolsavam_details']	= $this->General_Model->get_data('kalolsavam_master', '*', array(),'kalolsavam_id desc');
			if (!isset($this->Content['admin_action']) || (isset($this->Content['admin_action']) && $this->Content['admin_action'] == 'ADD'))
			{
				if ($this->General_Model->is_record_exists('kalolsavam_master',"status = 'O'"))
				{
					$this->Content['add_edit_kalolsavam']	= 'no'; 
				}
			}
			$this->template->write_view('content', 'admin/kalolsavam_view', $this->Content);
		}
		if (2 == $this->session->userdata('USER_TYPE'))
		{
			$this->Content['edit_kalolsavam']	= 'no'; 
			if (isset($this->Content['admin_action']) && $this->Content['admin_action']== 'EDIT')
			{
				$this->Content['edit_kalolsavam']	= 'yes'; 
			}
			$this->Content['kalolsavam_details']	= $this->General_Model->get_data('dist_kalolsavam_master', '*', 
														array("rev_district_code" => $this->session->userdata('DISTRICT')),
														'kalolsavam_id desc');
			$this->template->write_view('content', 'admin/dist_kalolsavam_view', $this->Content);
		}
		if (3 == $this->session->userdata('USER_TYPE'))
		{
			$this->Content['edit_kalolsavam']	= 'no'; 
			$this->Content['kalolsavam_details']	= $this->General_Model->get_data('sub_dist_kalolsavam_master', '*', 
														array("sub_district_code" => $this->session->userdata('SUB_DISTRICT')),
														'kalolsavam_id desc');
			if (isset($this->Content['admin_action']) && $this->Content['admin_action']== 'EDIT')
			{
				$this->Content['edit_kalolsavam']	= 'Yes'; 
			}
			$this->template->write_view('content', 'admin/sub_dist_kalolsavam_view', $this->Content);
		}
		$this->template->load();
	}
	function add_kalolsavam()
	{
		if (isset($_POST['txtKalolsavamName']))
		{
			if (!$this->General_Model->is_record_exists('kalolsavam_master',"status = 'O'"))
			{
				$data['kalolsavam_name']	=	trim($this->input->post('txtKalolsavamName'));
				$data['kalolsavam_year']	=	trim($this->input->post('txtKalolsavamYear'));
				$data['venue']				=	trim($this->input->post('txtKalolsavamVenue'));
				$data['status']				=	"O";
				if (isset($_FILES['kalolsavamLogo']['name']) && !empty($_FILES['kalolsavamLogo']['name']))
				{
					$image_name	= $this->General_Model->upload_logo_image ('kalolsavamLogo', 'kalolsavam'.substr(fncUuid(), 10), 'state');
					if (!$image_name)
					{
						$this->template->write('error', $this->upload->display_errors());
					}
					else $data['logo_name']		= $image_name;
				}
				
				if ($this->Kalolsavam_Model->save_kalolsavam_details ($data, 'ADD'))
					$this->template->write('message', 'Kalolsavam details saved successfully');
				else $this->template->write('message', 'Failed to add Kalolsavam details');
			}
			$this->index();
		}
		else redirect ('admin/kalolsavam');
	}
	
	function edit_kalolsavam ()
	{
		if('' != $this->input->post('sel_kalolsavam_id') || (isset($this->Content['sel_kalolsavam_id']) && !empty($this->Content['sel_kalolsavam_id'])))
		{
			$this->Content['admin_action']			= 'EDIT';
			$this->Content['kalolsavam_id']			= ('' == $this->input->post('sel_kalolsavam_id')) ? $this->Content['sel_kalolsavam_id']:$this->input->post('sel_kalolsavam_id');
			
			
			if (0 == $this->session->userdata('USER_TYPE') || 1 == $this->session->userdata('USER_TYPE'))
			{
				$this->Content['selected_kalolsavam']	= $this->General_Model->get_data('kalolsavam_master', '*', array('kalolsavam_id'=>$this->Content['kalolsavam_id']));
			}
			if (2 == $this->session->userdata('USER_TYPE'))
			{
				$this->Content['selected_kalolsavam']	= $this->General_Model->get_data('dist_kalolsavam_master', '*', array('dist_kalolsavam_id'=>$this->Content['kalolsavam_id']));
			}
			if (3 == $this->session->userdata('USER_TYPE'))
			{
				$this->Content['selected_kalolsavam']	= $this->General_Model->get_data('sub_dist_kalolsavam_master', '*', array('sub_dist_kalolsavam_id'=>$this->Content['kalolsavam_id']));
			}
			$this->index();
		}
		else redirect ('admin/kalolsavam');
	}
	
	function update_kalolsavam()
	{
		if (isset($_POST['kalolsavam_id']))
		{	
			if(trim($this->input->post('txtStartDate')) == '' || trim($this->input->post('txtEndDate')) == '')
			{
				$this->Content['sel_kalolsavam_id'] = trim($this->input->post('kalolsavam_id'));
				$this->template->write('error', 'Please enter Start Date and End Date');
				$this->edit_kalolsavam();
				return;
			}
			else if(date(trim($this->input->post('txtStartDate'))) > date(trim($this->input->post('txtEndDate'))))
			{
				$this->Content['sel_kalolsavam_id'] = trim($this->input->post('kalolsavam_id'));
				$this->template->write('error', 'End Date is must be greater value than Start Date ');
				$this->edit_kalolsavam();
				return;
			}
			else
			{
					
				$file_upload	= FALSE;
				if (isset($_FILES['kalolsavamLogo']['name']) && !empty($_FILES['kalolsavamLogo']['name'])) $file_upload	= TRUE;
				
				if (0 == $this->session->userdata('USER_TYPE') || 1 == $this->session->userdata('USER_TYPE'))
				{
					if ($this->General_Model->is_record_exists('kalolsavam_master',"status = 'O' AND kalolsavam_id = ".$this->input->post('kalolsavam_id')))
					{
						if ($file_upload)
						{
							/*$image_name	= $this->General_Model->upload_logo_image ('kalolsavamLogo', 
									strtolower(str_replace(' ', '_', $this->input->post('txtKalolsavamName'))).'_'.
									$this->input->post('txtKalolsavamYear').'_'.$this->input->post('kalolsavam_id'), 
									'state');*/
							$image_name	= $this->General_Model->upload_logo_image ('kalolsavamLogo', 'kalolsavam'.substr(fncUuid(), 10), 'state');
							
							if (!$image_name)
							{
								$this->template->write('error', $this->upload->display_errors());
							}
							else
							{
								$prev_image_name		= $this->General_Model->get_single_column_value ('kalolsavam_master', 'logo_name', 'kalolsavam_id = '.$this->input->post('kalolsavam_id'));
								if (isset($prev_image_name) && is_array($prev_image_name) && count($prev_image_name) > 0)
									$prev_image_name = $prev_image_name[0];
								else $prev_image_name ='';
								$data['logo_name']		= $image_name;
							}
						}
						
						$data['kalolsavam_id']		=	$this->input->post('kalolsavam_id');
						$data['kalolsavam_name']	=	trim($this->input->post('txtKalolsavamName'));
						$data['kalolsavam_year']	=	trim($this->input->post('txtKalolsavamYear'));
						$data['venue']				=	trim($this->input->post('txtKalolsavamVenue'));
						$data['start_date']			=	trim($this->input->post('txtStartDate'));
						$data['end_date']			=	trim($this->input->post('txtEndDate'));
						$data['status']				=	"O";
						if ($this->Kalolsavam_Model->save_kalolsavam_details ($data, 'EDIT'))
						{
	
							if (isset($prev_image_name) && !empty($prev_image_name))
							{
								unlink_kalolsavam_logo ($prev_image_name, 'state');
							}
							$this->template->write('message', 'Kalolsavam details saved successfully');
						}
						else $this->template->write('error', 'Failed to save Kalolsavam details');
					}
				}
				if (2 == $this->session->userdata('USER_TYPE'))
				{
					if ($this->General_Model->is_record_exists('dist_kalolsavam_master', "status = 'O' AND dist_kalolsavam_id = ".$this->input->post('kalolsavam_id')))
					{
						$data['venue']					=	trim($this->input->post('txtKalolsavamVenue'));
						$data['dist_kalolsavam_id']		=	$this->input->post('kalolsavam_id');
						$data['start_date']				=	trim($this->input->post('txtStartDate'));
						$data['end_date']				=	trim($this->input->post('txtEndDate'));
						if ($file_upload)
						{
							$image_name	= $this->General_Model->upload_logo_image ('kalolsavamLogo', 'dist_kalolsavam'.substr(fncUuid(), 10), 'dist');
							if (!$image_name)
							{
								$this->template->write('error', $this->upload->display_errors());
							}
							else $data['logo_name']		= $image_name;
						}
						
						
						if ($this->Kalolsavam_Model->update_dist_kalolsavam_details ($data))
							$this->template->write('message', 'Kalolsavam details saved successfully');
						else $this->template->write('error', 'Failed to save Kalolsavam details');
					}
				}
				if (3 == $this->session->userdata('USER_TYPE'))
				{
					if ($this->General_Model->is_record_exists('sub_dist_kalolsavam_master', "status = 'O' AND sub_dist_kalolsavam_id = ".$this->input->post('kalolsavam_id')))
					{
						$data['venue']					=	trim($this->input->post('txtKalolsavamVenue'));
						$data['sub_dist_kalolsavam_id']	=	$this->input->post('kalolsavam_id');
						$data['start_date']				=	trim($this->input->post('txtStartDate'));
						$data['end_date']				=	trim($this->input->post('txtEndDate'));
						if ($file_upload)
						{
							$image_name	= $this->General_Model->upload_logo_image ('kalolsavamLogo', 'sub_dist_kalolsavam'.substr(fncUuid(), 10), 'sub_dist');
							if (!$image_name)
							{
								$this->template->write('error', $this->upload->display_errors());
							}
							else $data['logo_name']		= $image_name;
						}
						
						if ($this->Kalolsavam_Model->update_sub_dist_kalolsavam_details ($data))
							$this->template->write('message', 'Kalolsavam details saved successfully');
						else $this->template->write('error', 'Failed to save Kalolsavam details');
					}
				}
			}
			$this->index();
		}
		else redirect ('admin/kalolsavam');
	}
}

?>