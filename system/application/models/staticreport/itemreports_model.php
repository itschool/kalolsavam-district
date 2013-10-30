<?php
class Itemreports_Model extends Model{
	function Itemreports_Model()
	{
		parent::Model();
	}
    
	function itemwise_participants($itemcode)
	{
	    
		
		$this->db->from('participant_item_details AS PD');
		$this->db->where('PD.item_code',$itemcode);
		$this->db->where('PD.is_captain','Y');
		$this->db->join('participant_details  AS PM ','PD.school_code = PM.school_code and PD.admn_no=PM.admn_no');
		$this->db->join('school_master  AS SM ','SM.school_code = PM.school_code');
		$this->db->join('sub_district_master  AS SDM ','SM.sub_district_code = SDM.sub_district_code');
		
		$participants_details		=	$this->db->get();
		return $participants_details->result_array();
	}
	
	function Eventname($itemcode)
	{
	    $this->db->from('item_master AS IT');
		$this->db->where('IT.item_code ',$itemcode);
		
		$item_details		=	$this->db->get();
		return $item_details->result_array();
	}
	function Festname($festval)
	{
	    $this->db->from('festival_master AS FM');
		$this->db->where('FM.fest_id',$festval);
		
		$festname		=	$this->db->get();
		return $festname->result_array();
	}
	function item_details()
	{
		$this->db->from('school_details AS SM');
		$this->db->join('school_master AS SD','SM.school_code = SD.school_code','LEFT');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function timesheet($itemcode)
	{
		$this->db->from('item_master AS IT');
		$this->db->where('IT.item_code ',$itemcode);
		$this->db->join('stage_item_master AS ST','ST.item_code = IT.item_code','LEFT');
		$this->db->join('stage_master AS SM','SM.stage_id = ST.stage_id','LEFT');
		$item_details		=	$this->db->get();
		return $item_details->result_array();
	}
	
	function datewise_participants($date)
	{
	   
		$this->db->from('school_master AS SD');
		
		$this->db->join('participant_item_details  AS PD ','PD.school_code = SD.school_code');
		
		$this->db->join('stage_item_master  AS SIM ','SIM.item_code = PD.item_code');
		
		$this->db->where("DATE_FORMAT(SIM.start_time,'%Y-%m-%d')",$date);
		
		$this->db->select('COUNT(PD.pi_id) as total, PD.item_code, PD.admn_no, SD.school_code, SD.school_name');
		
		$this->db->groupby('SD.school_code');
		
		$participants_details		=	$this->db->get();
		return $participants_details->result_array();
	}
	
	//stage report
	function datewise_stagereport($date)
	{
		$this->db->from('stage_item_master  AS SIM');
		$this->db->join('item_master  AS IM ','SIM.item_code = IM.item_code');
		$this->db->join('festival_master AS FM ','FM.fest_id = IM.fest_id');
		$this->db->where("DATE_FORMAT(SIM.start_time,'%Y-%m-%d')",$date);
		$participants_details		=	$this->db->get();
		return $participants_details->result_array();
	}
	
	//find stage name
	function Stagename($stageid)
	{
	    $this->db->from('stage_master AS SM');
		$this->db->where('SM.stage_id',$stageid);
		
		$stagedetails		=	$this->db->get();
		return $stagedetails->result_array();
	}
	
	
}

?>