<?php
class Participant_Model extends Model{
	function Participant_Model()
	{
		parent::Model();
	}
	
	function get_item_participant($festtype)
	{
		$this->db->select('count( p.participant_id ) AS cpt, p.item_code, i.item_type, i.item_name, i.is_off_stage, f.fest_name,s.start_time,s.no_of_cluster,s.stage_id, s.no_of_judges,sm.stage_name, sm.stage_desc');
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		$this->db->join('stage_item_master AS s','s.item_code= p.item_code','LEFT');
		$this->db->join('stage_master AS sm','sm.stage_id = s.stage_id','LEFT');
		$this->db->where('i.fest_id',$festtype);
		$this->db->where('p.is_captain','Y');
		$this->db->where('i.item_type','G');
		$this->db->group_by('p.item_code');
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();
	}
	
	function get_item_participant_single($festtype)
	{
	
		$this->db->select('count( p.participant_id) AS cpt, p.item_code, i.item_type, i.item_name, i.is_off_stage, f.fest_name,s.start_time,s.no_of_cluster,s.stage_id, s.no_of_judges, sm.stage_name, sm.stage_desc');
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		$this->db->join('stage_item_master AS s','s.item_code= p.item_code','LEFT');
		$this->db->join('stage_master AS sm','sm.stage_id = s.stage_id','LEFT');
		$this->db->where('i.fest_id',$festtype);
		$this->db->where('i.item_type','S');
		$this->db->group_by('p.item_code');
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();
		
	}
	
}