<?php
class Photos_Model extends Model{
    function Photos_Model()
    {
        parent::Model();
    }

    function get_participant_details($reg_no,$sch_code)
    {
        $dist	=	$this->session->userdata('DISTRICT');
        //echo "<br />dist------>".$dist;
        $result=$this->db->query("select PD.*,SM.school_name from participant_details as PD,school_master as SM where PD.admn_no='$reg_no' and PD.school_code = '$sch_code' and PD.school_code=SM.school_code and SM.rev_district_code='$dist'");
        //echo $result;
        if(is_object($result))
        {
            if($result->num_rows() > 0)
            {
                return $result->result_array();
            }
        }
    }

    function get_item_details($reg_no,$sch_code)
    {
        $dist	=	$this->session->userdata('DISTRICT');
        $result=$this->db->query("select IM.item_name from participant_item_details as PID,school_master as SM,item_master as IM where PID.admn_no='$reg_no' and PID.school_code = '$sch_code' and PID.school_code=SM.school_code and SM.rev_district_code='$dist' and IM.item_code=PID.item_code");
        //echo $result;
        if(is_object($result))
        {
            if($result->num_rows() > 0)
            {
                return $result->result_array();
            }
        }
    }

    /********   Retrieving the Photo  *******/

	function get_Photo($name,$schoolcode)
    {
        $subDistrict = $this->General_Model->get_data('school_master', 'sub_district_code', array('school_code'=>$schoolcode));
        $subDistrict = $subDistrict[0]['sub_district_code'];
		$dirname 	=   "photos/$subDistrict/".$schoolcode."/";
		$exts 		= 	array('jpg', 'jpeg', 'gif', 'png');
		foreach($exts as $ext)
		{
			if (file_exists($dirname.'/'.$name.'.'.$ext))
            {
				return base_url(false).$dirname.$name.'.'.$ext;
			}
        }
    }

    function get_count_schoolwise_participant_details($sch_code)
    {
        $dist	=	$this->session->userdata('DISTRICT');
        //echo "<br />dist------>".$dist;
        $result=$this->db->query("select PD.* from participant_details as PD,school_master as SM where PD.school_code = '$sch_code' and PD.school_code=SM.school_code and SM.rev_district_code='$dist' order by PD.admn_no");
        //echo $result;
        if(is_object($result))
        {
            if($result->num_rows() > 0)
            {
                return $result->result_array();
            }
        }
    }

    function get_schoolwise_participant_details($num=1,$offset=4,$sch_code)
    {
        $dist	=	$this->session->userdata('DISTRICT');

        $result=$this->db->query("select PD.* from participant_details as PD,school_master as SM where PD.school_code = '$sch_code' and PD.school_code=SM.school_code and SM.rev_district_code='$dist' order by PD.class,PD.participant_name LIMIT $offset,$num");
        //echo $result;
        if(is_object($result))
        {
            if($result->num_rows() > 0)
            {
                return $result->result_array();
            }
        }
    }

    function get_schoolwise_Photo($arr,$schoolcode)
    {
        $PhotoReturn	=	false;
        //echo "<br /><br />".var_dump($arr)."<br /><br /><br />";
        foreach($arr['participant_det'] as $stud_row)
        {
            $regno							=	$stud_row['admn_no'];
            $img								=	$schoolcode."_".$regno;
            $PhotoReturn['pic'][$regno]	    =	$this->get_Photo($img, $schoolcode);
            //echo "<br /><br />---->".$stud_row['admn_no']."<br /><br />";
        }
        // var_dump($PhotoReturn);
        return $PhotoReturn;
    }

    function get_subdistwise_Photo($arr)
    {
        //echo "<br /><br />".var_dump($arr)."<br /><br /><br />";
        $PhotoReturn	=	false;
        foreach($arr['participant_det'] as $stud_row)
        {
            $regno							=	$stud_row['admn_no'];
            $schoolcode						=	$stud_row['school_code'];
            $img								=	$schoolcode."_".$regno;
            $PhotoReturn['pic'][$regno]	    =	$this->get_Photo($img, $schoolcode);
            //echo "<br /><br />---->".$stud_row['admn_no']."<br /><br />";
        }
        // var_dump($PhotoReturn);
        return $PhotoReturn;

    }

    function get_participant_regno_Photo($arr)
    {
        $PhotoReturn	=	false;
        foreach($arr['partcard'] as $stud_row)
        {
            $regno							=	$stud_row['admn_no'];
            $schoolcode						=	$stud_row['school_code'];
            $img								=	$schoolcode."_".$regno;
            $PhotoReturn['pic'][$regno]	    =	$this->get_Photo($img, $schoolcode);
        }

        foreach($arr['partcard1'] as $stud_row)
        {
            $regno							=	$stud_row['admn_no'];
            $schoolcode						=	$stud_row['school_code'];
            $img								=	$schoolcode."_".$regno;
            $PhotoReturn['pic'][$regno]	    =	$this->get_Photo($img, $schoolcode);
        }

        foreach($arr['partcard2'] as $stud_row)
        {
            $regno							=	$stud_row['admn_no'];
            $schoolcode						=	$stud_row['school_code'];
            $img								=	$schoolcode."_".$regno;
            $PhotoReturn['pic'][$regno]	    =	$this->get_Photo($img, $schoolcode);
        }
        return $PhotoReturn;
    }

    function get_rank_Photo($arr)
    {
        $PhotoReturn	=	false;
        //echo "<br /><br />".var_dump($arr);
        foreach($arr['details'] as $stud_row)
        {
            $regno							=	$stud_row['admn_no'];
            $schoolcode						=	$stud_row['school_code'];
            $img								=	$schoolcode."_".$regno;
            $PhotoReturn['pic'][$regno]	    =	$this->get_Photo($img, $schoolcode);
        }
        return $PhotoReturn;
    }

    function get_special_entry_photo($arr)
    {
        $PhotoReturn	=	false;
        foreach($arr['participant_details'] as $stud_row)
        {
            $regno							=	$stud_row['admn_no'];
            $schoolcode						=	$stud_row['school_code'];
            $img								=	$schoolcode."_".$regno;
            $PhotoReturn['pic'][$regno]	    =	$this->get_Photo($img, $schoolcode);
        }
        return $PhotoReturn;

    }
}
