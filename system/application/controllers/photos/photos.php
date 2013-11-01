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
            $dataReturn['Photo']			=	$this->Photos_Model->get_Photo($img, $schoolcode);
			$dataReturn['item_det'] = $this->Photos_Model->get_item_details($reg_no,$schoolcode);
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
        if(!$this->input->post('upload'))
        {
            redirect('photos/photos/regnum_wise_photo_interface');
        }
        $school_code		=	$this->input->post('hidschcode');
        $admn_no			=	$this->input->post('hidadmn');
        $subDistrict = $this->General_Model->get_data('school_master', 'sub_district_code', array('school_code'=>$school_code));
        $subDistrict = $subDistrict[0]['sub_district_code'];
        $this->load->library('upload');
        $this->load->library('image_lib');

        $_FILES['userfile']['name'] = $school_code."_".$admn_no.strtolower($this->upload->get_extension($_FILES['userfile']['name']));
        $config['upload_path']= 'photos/'.$subDistrict.'/'.$school_code;
        $config['allowed_types']= 'gif|jpg|png|jpeg';
        $config['max_size']= '1000';
        $config['max_width'] = '1500';
        $config['max_height'] = '1500';
        $config['overwrite'] = 	TRUE;

        if (!is_dir ($config['upload_path'])){
            mkdir($config['upload_path'], 0777, true);
        }
        $this->deletePhoto($school_code."_".$admn_no, $config['upload_path']);
        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->template->write('error',$this->upload->display_errors());
        }
        else
        {
            $finfo = $this->upload->data();
            $config1['image_library'] 	= 	'gd2';
            $config1['source_image'] 	= $finfo['full_path'];
            $config1['create_thumb'] 	= 	false;
            $config1['maintain_ratio'] 	= 	TRUE;
            $config1['width'] = 100;
            $config1['height'] = 100;
            $this->image_lib->initialize($config1);

            if (!$this->image_lib->resize())
            {
                $error = array('error' => $this->image_lib->display_errors());
                $this->template->write('error',$this->upload->display_errors());
            }
            $this->image_lib->clear();
        }
        $data = array('upload_data' => $this->upload->data());
        $this->regnum_wise_photo_interface($school_code,$admn_no);
	}



	function bulk_upload()
	{
        if(!$this->input->post('upload')){
            return;
        }
        $total		=	$this->input->post('hidtot');
        $flag		=	0;
        $this->load->library('upload');
        $this->load->library('image_lib');

        for($i=1;$i<=$total;$i++)
        {

            $school_code		=	$this->input->post('hidschcode'.$i);
            $admn_no			=	$this->input->post('hidadmn'.$i);
            $subDistrict = $this->General_Model->get_data('school_master', 'sub_district_code', array('school_code'=>$school_code));
            $subDistrict = $subDistrict[0]['sub_district_code'];
            $userfile			=	'userfile'.$i;
            $file_selected		=	$_FILES[$userfile]['name'];
            if($file_selected != '')
            {
                $flag	=	1;
                $img = $school_code."_".$admn_no;
                $config['file_name'] = $school_code."_".$admn_no.strtolower($this->upload->get_extension($_FILES["$userfile"]['name']));
                $config['upload_path'] = "photos/$subDistrict/$school_code";
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] ='1000';
                $config['max_width']= '1500';
                $config['max_height'] =	'1500';
                $config['overwrite'] = 	TRUE;

                if (!is_dir($config['upload_path'])){
                    mkdir($config['upload_path'], 0777, true);
                }
                $this->deletePhoto($img, $config['upload_path']);

                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload($userfile))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $error	=	$error." admission number ".$admn_no;
                    $this->template->write('error',$this->upload->display_errors());
                }
                else
                {
                    $finfo = $this->upload->data();
                    $config1['image_library'] 	= 	'gd2';
                    $config1['source_image'] 	= $finfo['full_path'];
                    $config1['create_thumb']	= false;
                    $config1['maintain_ratio'] = TRUE;
                    $config1['width'] = 100;
                    $config1['height'] = 100;
                    $this->image_lib->initialize($config1);

                    if ($this->image_lib->resize())
                    {
                        $data = array('upload_data' => $this->upload->data());
                    }
                    $this->image_lib->clear();
                }

            }
        }//for each ends
        if($flag == 0)
        {
            $error	=	"No files Selected";
            $this->template->write('error',$error);
        }

        $this->school_wise_photo_interface($school_code);
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

    function deletePhoto($photo, $directory){
        if(substr($directory, -1) !== '/'){
            $directory.="/";
        }
        exec("rm $directory$photo.*");
    }





//----------------------------function end----------------------------------------------------------------------------------------------------
}
