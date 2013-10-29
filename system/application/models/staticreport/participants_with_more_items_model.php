<?php
class Participants_with_more_items_model extends Model{
	function Participants_with_more_items_model()
	{
		parent::Model();
	}
    
	function participant_details()
	{
		$this->db->from('participant_item_details AS PID');
		$this->db->select('count( PID.participant_id ) AS cnt, PID.participant_id, PD.school_code, PD.participant_name, PD.class, PD.gender, PD.admn_no, PID.item_code, IM.item_name, IM.fest_id,SM.school_name');
		$this->db->join('participant_details AS PD','PD.participant_id = PID.participant_id');
		$this->db->join('item_master AS IM','IM.item_code = PID.item_code');
		$this->db->join('school_master AS SM','SM.school_code=PD.school_code');
		$this->db->group_by('PID.participant_id');
		$this->db->having('cnt >1');
		$this->db->order_by('IM.fest_id');
		//$this->db->from('participant_item_details ');
		//$this->db->select('count(participant_id) AS cnt,participant_id');
		//$this->db->group_by('participant_id');
	    $participants_details		=	$this->db->get();
		return $participants_details->result_array();
		
	}
	}
?>