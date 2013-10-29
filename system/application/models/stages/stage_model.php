<?php
class Stage_Model extends Model{
	function Stage_Model()
	{
		parent::Model();
	}
	function save_stage_details()
	{
		$data['stage_name']			=	$this->input->post('txtStageName');
		$data['stage_desc']			=	$this->input->post('txtStageDescription');
		$this->db->insert('stage_master',$data);
		return $this->db->insert_id();
	}
	
	
	
	function update_stage_details()
	{
		$stageId	=	$this->input->post('hidStId');
		$data['stage_name']			=	$this->input->post('txtStageName');
		$data['stage_desc']			=	$this->input->post('txtStageDescription');
		$this->db->where('stage_id', $stageId);
		$this->db->update('stage_master',$data);
	}
	
	function get_stages()
	{
		$this->db->from('stage_master');
		$this->db->orderby('stage_id', 'ASC');
		$this->db->select('*');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function select_stage_details() 
	{
		$this->db->where('stage_id', $this->input->post('hidStageId'));
		$this->db->from('stage_master');
		$this->db->select('*');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function delete_stage_details(){
		$this->db->where('stage_id', $this->input->post('hidStageId'));
		$this->db->delete('stage_master');
	}
	
	function check_stagename_exists($id='', $stagename)
	{
		if($id != '')
			$this->db->where('stage_id != "'.$id.'"');
		$this->db->where('stage_name = "'.$stagename.'"');
		$this->db->select('stage_id');
		$this->db->from('stage_master');
		$result	=	$this->db->get();
		if(count($result->result_array()) > 0)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	function get_item_details()
	{
		$this->db->where('item_code', $this->input->post('code'));
		$this->db->select('item_code, item_name, max_time, time_type, item_type');
		$this->db->from('item_master');
		$result	=	$this->db->get();
		$result =	$result->result_array();
		if(count($result) > 0)
		{
			if($result[0]['item_type'] == 'G')
			{
				$this->db->where('is_captain', 'Y');
			}
			$this->db->where('item_type != "P"');
			$this->db->where('item_code', $this->input->post('code'));
			$this->db->select('COUNT(pi_id) as count');
			$this->db->from('participant_item_details');
			$result2	=	$this->db->get();
			$result2 =	$result2->result_array();
			if(count($result2) > 0)
			{
				$result[0]['total_participants'] = $result2[0]['count'];
				$time	=	($result[0]['time_type'] == 'S') ? ceil((int)$result[0]['max_time'] / 60) : (int)$result[0]['max_time'];
				$result[0]['total_time']	=	(int)$time * (int)$result2[0]['count'];
			}
		}
		else
		{
			return;
		}
		return $result;
	}
	
	function get_stage_name_array()
	{
		$stage_array		=	array();
		for($i = 1; $i <=50; $i++)
		{
			$satege_name					=	'Stage '.$i;
			$stage_array[$satege_name]		=	$satege_name;
		}
		return $stage_array;
	}
}

?>