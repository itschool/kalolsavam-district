<?php
class Itemreport_Model extends Model{
	function Itemreport_Model()
	{
		parent::Model();
	}
	
	function get_item_details($fest_id = '')
	{
		if ($fest_id)
		{
			$this->db->where('IM.fest_id',$fest_id);
		}
		$this->db->from('item_master AS IM');
		$this->db->join('vibhagam_master AS VM','IM.vibhagam_id = VM.vibhagam_id');
		$this->db->join('festival_master AS FM','FM.fest_id = IM.fest_id');
		$this->db->order_by('IM.fest_id,IM.item_code');
		$this->db->select('IM.*,VM.vibhagam_name,FM.fest_name,VM.max_items');
		$item_details	=	$this->db->get();
		return $item_details->result_array();
	}	
	
}
?>