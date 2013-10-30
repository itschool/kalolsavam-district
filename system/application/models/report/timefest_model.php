<?php
class Timefest_model extends Model{
	function Timefest_model()
	{
		parent::Model();
	}
	
	
	
	function timeoffest_result($itemcode)
	{  
			$this->db->where('rs.item_code',$itemcode);
			$this->db->select('rs.item_code,Sd.stage_name,rs.code_no,rs.marks,rs.total_mark,rs.percentage,rs.grade,rs.point,rs.rank,im.item_name,sm.school_name,sm.school_code,pd.participant_name,rs.participant_id,si.start_time,sp.is_publish,pi.spo_id,si.no_of_judges,fm.fest_name,rs.is_taken,sdm.sub_district_name,sdm.sub_district_code');
			$this->db->from('result_master AS rs');
			$this->db->join('item_master AS im','im.item_code = rs.item_code');
			$this->db->join('school_master AS sm','sm.school_code = rs.school_code');
			$this->db->join('sub_district_master AS sdm','sdm.sub_district_code = sm.sub_district_code');
			$this->db->join('participant_details AS pd','pd.participant_id = rs.participant_id','LEFT');
			$this->db->join('participant_item_details AS pi',"pi.participant_id = rs.participant_id AND pi.item_code = rs.item_code and pi.is_captain='Y'");
			$this->db->join('special_order_master AS sp',"sp.spo_id = pi.spo_id AND sp.is_publish = 'N'",'LEFT');
			$this->db->join('stage_item_master AS si','si.item_code = rs.item_code');
			$this->db->join('stage_master AS Sd','si.stage_id = Sd.stage_id');
			$this->db->join('festival_master AS fm','fm.fest_id = im.fest_id');
			$this->db->where("rs.is_finish ='Y'");
			$this->db->group_by('rs.item_code');
			$this->db->group_by('rs.participant_id');
			$this->db->order_by('rs.total_mark','DESC');
			$details	=	$this->db->get();
			return  $details->result_array();
	}
	
	
		
	function timeoffest_count($itemcode)
	{  
		 $this->db->where('pi.item_code',$itemcode);
		 $this->db->select('count(pi.item_code) as picount');
		 $this->db->from('participant_item_details AS pi');
		 $this->db->where('pi.is_captain','Y');
	     $details	=	$this->db->get();	
         return  $details->result_array();
	}
	
	function timeoffest_count2($itemcode)
	{  
		 $this->db->where('rs.item_code',$itemcode);
		 $this->db->select('count(rs.item_code) as rscount');
		 $this->db->from('result_master AS rs');
	     $details	=	$this->db->get();	
         return  $details->result_array();
	}
	
	function fetch_festname($festid)
		{   
			$this->db->where('fm.fest_id',$festid);
			$this->db->select('fm.fest_name');
			$this->db->from('festival_master AS fm');
			$details	=	$this->db->get();
			return  $details->result_array();
		}

	function fetch_fest_all_result($festival)
	{  
		$this->db->where('fm.fest_id',$festival);
		$this->db->select('rs.item_code,Sd.stage_name,rs.code_no,rs.marks,rs.total_mark,rs.percentage,rs.grade,sp.is_publish,pi.spo_id,   rs.point,rs.rank,im.item_name,sm.school_name,sm.school_code,pd.participant_name,rs.participant_id,si.start_time,fm.fest_id,fm.fest_name,si.no_of_participant,si.no_of_judges,sdm.sub_district_code,sdm.sub_district_name');
		$this->db->from('result_master AS rs');
		$this->db->join('item_master AS im','im.item_code = rs.item_code');
		$this->db->join('school_master AS sm','sm.school_code = rs.school_code');
		$this->db->join('sub_district_master AS sdm','sm.sub_district_code = sdm.sub_district_code');
		$this->db->join('participant_details AS pd','pd.participant_id = rs.participant_id','LEFT');
		$this->db->join('participant_item_details AS pi','pi.participant_id = rs.participant_id AND pi.item_code = rs.item_code');
		$this->db->join('special_order_master AS sp',"sp.spo_id = pi.spo_id AND sp.is_publish = 'N'",'LEFT');
		$this->db->join('stage_item_master AS si','si.item_code = rs.item_code');
		$this->db->join('stage_master AS Sd','si.stage_id = Sd.stage_id');
		$this->db->join('festival_master AS fm','fm.fest_id = im.fest_id');
		$this->db->where("rs.is_finish ='Y'");
		$this->db->group_by('rs.item_code');
		$this->db->group_by('rs.participant_id');
		$this->db->order_by('rs.item_code');
		$this->db->order_by('rs.total_mark','DESC');
		$details	=	$this->db->get();
		return  $details->result_array();
	}

 	  function  fetch_fest_all_result_count($itemcode)
	 {
	  	 $this->db->where('pi.item_code',$itemcode);
		 $this->db->select('count(pi.item_code) as cnt');
		 $this->db->from('participant_item_details AS pi');
		 $details	=	$this->db->get();
		 return  $details->result_array();
    }



/*function timeoffest_result_absentee($itemcode)
	{   
		$this->db->where("pi.participant_id NOT IN (select   participant_id from  result_master AS rs where  pi.item_code=rs.item_code AND rs.item_code='$itemcode') AND pi.item_code ='$itemcode'");
		$this->db->select('pi.participant_id');
		$this->db->from('participant_item_details AS pi');
		
		$details	=	$this->db->get();
		return  $details->result_array();
	}
	
*/	
	function timeoffest_result_absentee($itemcode)
	{   
		$this->db->where('ab.item_code',$itemcode);
		$this->db->select('ab.participent_id_csv ');
		$this->db->from('item_absentee_master AS ab');
		
		$details	=	$this->db->get();
		if($details->num_rows() > 0)
		{
			$absentee   = $details->result_array();
			return $absentee[0]['participent_id_csv'];
		}
		return '';
	
	    
	}
	
	
	
	
	

function timeoffest_result_absentee_all($festival)
	{   $this->db->where("pi.participant_id NOT IN (select   participant_id from  result_master AS rs where  pi.item_code=rs.item_code ) AND fm.fest_id ='$festival'");
		$this->db->select('pi.participant_id,fm.fest_id,pi.item_code');
		$this->db->from('participant_item_details AS pi,festival_master AS fm');
		 $this->db->order_by('pi.item_code');
		$details	=	$this->db->get();
		return  $details->result_array();
	}

	function timefestconfidential($resfest)
	{
		$this->db->select('r.item_code, I.item_name,I.item_type,f.fest_name');
		$this->db->from('result_master AS r');
		$this->db->join('item_master AS I',"I.item_code = r.item_code and I.fest_id='$resfest'");
		$this->db->join('festival_master AS f',"f.fest_id =I.fest_id");
		$this->db->where('r.is_finish','Y');
		$this->db->group_by('r.item_code');
		$this->db->order_by('r.item_code');
		$details	=	$this->db->get();
		return  $details->result_array();
	
	}

}

?>