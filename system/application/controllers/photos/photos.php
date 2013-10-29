<?php
class Photos extends Controller {

	function Photos()
	{
		parent::Controller();
		$this->Session_Model->is_user_logged(true);
		$this->template->add_js('js/photo/upload_photo.js');
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/report/reportjs.js');		
		$this->load->library('upload');
		$this->load->library('image_lib');	
		$this->template->write_view('menu', 'menu', '');			
		$this->load->model('photos/Photos_Model');	
		$this->load->model('general_model');
	
	}
	
	function index()
	{
		
           /* $dir = "/etc/php5/";

			// Open a known directory, and proceed to read its contents
			if (is_dir($dir)) 
			{
				if ($dh = opendir($dir)) 
				{
					while (($file = readdir($dh)) !== false) 
					{
						echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
					}
					closedir($dh);
				}
           }*/
				
	}
	
	/***** Admission No wise Photo Uploading ******/
	
	function regnum_wise_photo_interface($school_code = NULL,$admn_no = NULL)
	{
		$this->template->write('title', '');
		if($school_code == '' && $admn_no == '')
		{
			$schoolcode	=	$this->input->post('txtSchoolCode');
			$reg_no	    =	$this->input->post('txtRegNum');
		}
		else
		{
			$schoolcode	=	$school_code;
			$reg_no	    =	$admn_no;		
		}
		
		if($reg_no == '' && $schoolcode == '' )
		{						
			$this->template->write_view('content','photos/reg_num_wise_photo');			
		}
		else if($reg_no != '' && $schoolcode != '')
		{
			$img							=	$schoolcode."_".$reg_no;
			$dataReturn['participant_det'] = $this->Photos_Model->get_participant_details($reg_no,$schoolcode);
			$dataReturn['Photo']			=	$this->Photos_Model->get_Photo($img);
			$dataReturn['item_det'] = $this->Photos_Model->get_item_details($reg_no,$schoolcode);
			//echo "<br /><br /><br />--><br /><br />".var_dump(@$dataReturn['participant_det']);
			if($dataReturn['participant_det'])
			{
				$this->template->write_view('content','photos/reg_num_wise_photo',$dataReturn);				
			}
			else
			{
				$errors_msg	=	"Not a valid school code and admission number";
				$this->template->write('error',$errors_msg);
				$this->template->write_view('content','photos/reg_num_wise_photo');			
			}	  	
		}
		
		$this->template->load();	
	
	}
	//********** ends here ************
	
	
	//************** function to upload the photo **************
	
	function upload()
	{
		if($this->input->post('upload'))
		{		
			$school_code		=	$this->input->post('hidschcode');
			$admn_no			=	$this->input->post('hidadmn');
			
			//echo "<br />EXT-->".$ext;);
			$ext				=   end(explode('.', $_FILES['userfile']['name']));
			//echo "<br />EXT-->".$ext;
			
			$im_name						=	$school_code."_".$admn_no.".".$ext;
			$img							=	$school_code."_".$admn_no;
			$_FILES['userfile']['name']		= 	$im_name;
			$config['upload_path'] 			= 	'uploads/photos';
			$config['allowed_types'] 		= 	'gif|jpg|png';
			$config['max_size']				= 	'200';
			$config['max_width']  			= 	'600';
			$config['max_height']  			= 	'600';
			$config['overwrite'] 			= 	TRUE;
			$upload_path					= 	$config['upload_path'];
			$image_name						= 	$_FILES['userfile']['name'];
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				//echo "entereeeeedd".var_dump($error);
				
				$this->template->write('error',$this->upload->display_errors());
				$this->regnum_wise_photo_interface($school_code,$admn_no);
			
			}	
			else
			{						
				$config['image_library'] 	= 	'gd2';
				$config['source_image'] 	= 	$upload_path.$image_name;
				$config['create_thumb'] 	= 	TRUE;
				$config['maintain_ratio'] 	= 	TRUE;
				$config['new_image']		= 	'thumb_'.$image_name;
				$config['thumb_marker']		= 	'';
				$config['width'] = '130';
				$config['height'] = '130';
				
				$this->load->library('image_lib', $config);
				if ($this->image_lib->resize()) 
				{				  
					  $data = array('upload_data' => $this->upload->data());
					 // $arrData['data'] 			= 	$this->Reg_model->get_data();
					  $this->regnum_wise_photo_interface($school_code,$admn_no);				  
				}
				else 
				{
				 
				}
							
			}
		}
		 
	}
	
	
	
	function bulk_upload()
	{
		//$this->ini_set('upload_max_filesize','20M');
		//echo "<br /><br /><br />jiiiiiiiii".$this->input->post('upload');
		if($this->input->post('upload'))
		{		
			$total		=	$this->input->post('hidtot');
			//echo "<br /><br />".$total."<br />";
			$flag		=	0;
			for($i=1;$i<=$total;$i++)
			{
			
				$school_code		=	$this->input->post('hidschcode'.$i);
				$admn_no			=	$this->input->post('hidadmn'.$i);
				$userfile			=	'userfile'.$i;
				//echo "<br /><br /><br /><br />".var_dump($_FILES);
				$file_selected		=	$_FILES[$userfile]['name'];
				//echo "<br /><br /><br />jiiiiiiiii".$file_selected;
				if($file_selected != '')
				{
					$flag	=	1;
					$ext				=   end(explode('.', $_FILES[$userfile]['name']));
					$im_name						=	$school_code."_".$admn_no.".".$ext;
					$img							=	$school_code."_".$admn_no;
					$config['file_name']			=	$im_name;
					$config['upload_path'] 			= 	'uploads/photos';
					$config['allowed_types'] 		= 	'gif|jpg|png';
					$config['max_size']				= 	'200';
					$config['max_width']  			= 	'600';
					$config['max_height']  			= 	'600';
					$config['overwrite'] 			= 	TRUE;
					$upload_path					= 	$config['upload_path'];
					$image_name						= 	$im_name;
					//$config['image_type']		=	$ext;
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if ( ! $this->upload->do_upload($userfile))
					{
						$error = array('error' => $this->upload->display_errors());
						$error	=	$error." admission number ".$admn_no;
						$this->template->write('error',$this->upload->display_errors());									
					}	
					else
					{			
					    //$check_format				=	$this->upload->set_image_properties();	
						//var_dump($check_format);
						$config['image_library'] 	= 	'gd2';
						$config['source_image'] 	= 	$upload_path.$image_name;
						$config['create_thumb'] 	= 	TRUE;
						$config['maintain_ratio'] 	= 	TRUE;
						$config['new_image']		= 	'thumb_'.$image_name;
						$config['thumb_marker']		= 	'';
						$config['width'] 			= 	'130';
						$config['height'] 			= 	'130';
						//$check_format				=	$this->upload->is_image();	
						//var_dump($check_format);
						
						$this->load->library('image_lib',$config);
						if ($this->image_lib->resize()) 
						{				  
							  $data = array('upload_data' => $this->upload->data());
							  //echo "<br /><br />dataaaaaa".var_dump($data);
							 // $arrData['data'] 			= 	$this->Reg_model->get_data();	  
						}
						else 
						{
						 
						}
									
					}
					
				 }
			 }//for each ends
			 if($flag == 0)
			 {				
				$error	=	"No files Selected";
				$this->template->write('error',$error);		 
			 }
			
			$this->school_wise_photo_interface($school_code);		
		}//if ends
		 
	}
	
	function school_wise_photo_interface($school_code = NULL)
	{
	    
		$this->template->write('title', '');
		if($school_code == '')
		{		   
			$schoolcode	=	$this->input->post('txtSchoolCode');	
			 
		}
		else
		{
		  	$schoolcode	=	$school_code;			
		}
		
		if($schoolcode == '' )
		{					
			$this->template->write_view('content','photos/school_wise_photo');	
			$this->template->load();			
		}
		else 
		{		     
			$dataReturn['participant_details'] = $this->Photos_Model->get_count_schoolwise_participant_details($schoolcode);			
			if($dataReturn['participant_details'])
			{			
			    $count1								=	count($dataReturn['participant_details']);	
				$set_session_data['pag_school']		=	$schoolcode."/".$count1	;
				$this->Session_Model->set_session($set_session_data);
				$this->pag1();							
			}
			else
			{
				$errors_msg	=	"Not a valid school code";
				$this->template->write('error',$errors_msg);
				$this->template->write_view('content','photos/school_wise_photo');	
				$this->template->load();			
			}	  	
		}
		
		
	
	}	
	
	function pag1($intOffset=0)
		{		
		
		    //echo "<br /><br /><br />hiiiiiiiiiiiiiiii";
			//$i = 0;$i++;
			
			$pag_det	=	$this->session->userdata('pag_school');
			$pag_det	=	explode('/',$pag_det);
			$pag_school	=	$pag_det[0];
			$pag_count	=	$pag_det[1];
			$this->load->library('pagination');
			$config['per_page'] = '50';
			$config['base_url'] = base_url().'photos/photos/pag1/';
			$config['uri_segment']		=	4;		
			//$config['num_links'] = 20;
			$tot 	= $pag_count;
			$num	=	$pag_count/50;
			$total_pages1 = ($pag_count/$config['per_page']);
			$total_pages = round($total_pages1);
			$dataReturn['tot_page']	=	$total_pages;								
			$config['total_rows'] = $tot;
			$config['prev_link'] = '&lt;';
			$config['next_link'] = '&gt;';
    		$this->pagination->initialize($config);			
			$ext			=   end(explode('/', current_url()));			
			$dataReturn['cur_num']			=	$ext++;
			$dataReturn['participant_det']  = $this->Photos_Model->get_schoolwise_participant_details($config['per_page'],$intOffset,$pag_school);	
			$dataReturn['Photo']			=	$this->Photos_Model->get_schoolwise_Photo($dataReturn,$pag_school);
			$dataReturn['school_det']		=	$this->General_Model->get_data('school_master', '*',array('school_code'=> $pag_school));
			$dataReturn['pagination']		=	$this->pagination->create_links();
			//echo "<br /><br /><br />hiiiiiiiiiiiiiiii".var_dump($dataReturn);
			$this->template->write_view('content','photos/school_wise_photo',$dataReturn);	
			$this->template->load();		  
		
		}
		
	
   	

//----------------------------function end----------------------------------------------------------------------------------------------------	
}
?>