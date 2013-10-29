<?php
class Allotmentfest_Model extends Model{
	function Allotmentfest_Model()
	{
		parent::Model();
	}
	
	
	function save_allotment ($item_code) 
	{
		$si_id			=	$this->save_stage_item_details($item_code);
		$cluster_id		=	$this->save_cluster_details($si_id,$item_code);	
	}
	
	/** function for save details of allotment to stage item master*/
	function save_stage_item_details ($item_code)
	{
		$stage_id					=	$this->input->post('cmbStage'.$item_code);
		//$item_code					=	$this->input->post('hidItemId');
		$this->db->where('item_code',$item_code);
		$item_master				=	$this->db->get('item_master');
		$item						=	$item_master->result_array();
		$item_time					=	$item[0]['max_time'];
		$time_type					=	$item[0]['time_type'];
		$off_stage					=	$item[0]['is_off_stage'];
		$no_of_participant			=	$this->input->post('hidMaxPartcipants'.$item_code);	
		$start_time					=	$this->input->post('txtDate'.$item_code).' '.$this->input->post('txtHour'.$item_code).':'.$this->input->post('txtMin'.$item_code).':00';	
		
		$total_time_for_item	=	($time_type == 'S') ? ceil((int)$item_time / 60) : (int)$item_time;	
		if ($off_stage)
		{
			$total_time_in_minutes	= 	(int)$total_time_for_item ;	
		}
		else
		{
			$total_time_in_minutes	= 	(int)$total_time_for_item * $no_of_participant;	
		}
		$timestamp = strtotime(date("Y-m-d H:i:s", strtotime($start_time)) . " + ".$total_time_in_minutes." mins");  
		$end_time = date('Y-m-d H:i:s', $timestamp);  
		
		$this->db->where('stage_id',$stage_id);
		$this->db->where("('".$start_time."' BETWEEN start_time AND end_time) OR ('".$end_time."' BETWEEN start_time AND end_time)");
		$cnt_stage_exist	=	$this->db->count_all_results('cluster_master');
		
		$data['stage_id']			=	$stage_id;
		$data['item_code']			=	$item_code;
		$data['start_time']			=	$start_time;
		$data['no_of_cluster']		=	$this->input->post('cmbNoOfCluster'.$item_code);
		$data['no_of_judges']		=	$this->input->post('cmbNoOfJudges'.$item_code);
		$data['no_of_participant']	=	$no_of_participant;
		$data['item_time']			=	$item_time;
		$data['time_type']			=	$time_type;
		$this->db->insert('stage_item_master', $data);
		$si_id 	=	$this->db->insert_id();
		return $si_id;
	}
	
	/** function for save the cluster details*/
	function save_cluster_details($si_id,$item_code)
	{
	
			//$item_code					=	$this->input->post('hidItemId');
			$this->db->where('item_code',$item_code);
			$item_master				=	$this->db->get('item_master');
			$item						=	$item_master->result_array();
			$item_time					=	$item[0]['max_time'];
			$time_type					=	$item[0]['time_type'];
			$off_stage					=	$item[0]['is_off_stage'];
			
		//if($this->input->post('cmbNoOfCluster') >1){
			$cluster_no			=	1;
			$in_each_cluster	=	floor((int)$this->input->post('hidMaxPartcipants'.$item_code) / (int)$this->input->post('cmbNoOfCluster'.$item_code));
			$balance			=	(int)$this->input->post('hidMaxPartcipants'.$item_code) % (int)$this->input->post('cmbNoOfCluster'.$item_code);	
			$participants		=	$this->get_participanrts_details($item_code);
			$start_time			=	$this->input->post('txtDate'.$item_code).' '.$this->input->post('txtHour'.$item_code).':'.$this->input->post('txtMin'.$item_code).':00';
			$i					=	0;
			//print_r($participants);
			for($j = 1; $j <= $this->input->post('cmbNoOfCluster'.$item_code); $j++)
			{
				/* calculating no of participants in this cluster*/

				if($balance > 0)
				{ 
					$no_of_participant	=	(int)$in_each_cluster + 1;
					$balance--;
				}
				else
				{
					$no_of_participant	=	(int)$in_each_cluster;
				}
				/* calculating no of participants in this cluster ends */
				
				/* Calculating end time of the cluster*/
				$date = date($start_time);  

				$total_time_for_item	=	($time_type == 'S') ? ceil((int)$item_time / 60) : (int)$item_time;	
				
				if ($off_stage == 'Y')
				{
					$total_time_in_minutes	= 	(int)$total_time_for_item ;
				}
				else
				{
					$total_time_in_minutes	= 	(int)$total_time_for_item * $no_of_participant;
				}
					

				$timestamp = strtotime(date("Y-m-d H:i:s", strtotime($date)) . " + ".$total_time_in_minutes." mins");  
				$end_time = date('Y-m-d H:i:s', $timestamp);  
				/* Calculating end time of the cluster ends */
				
				/** inserting data to cluster master */
				$data	=	array();
				$data['si_id']				=	$si_id;
				$data['stage_id']			=	$this->input->post('cmbStage'.$item_code);
				$data['item_code']			=	$item_code;
				$data['cluster_no']			=	$j;
				$data['start_time']			=	$start_time;
				$data['no_of_participant']	=	$no_of_participant;
				$data['end_time']			=	$end_time;
				$this->db->insert('cluster_master', $data);
				$cluster_id	=	$this->db->insert_id();
				/** inserting data to cluster master ends */
				
				$start_time	=	$end_time;
				
				/** inserting data to cluster_participant_details */	
				for($k = 0; $k < $no_of_participant; $k++)
				{
					$cluster_item					=	array();
					$cluster_item['cluster_id']		=	$cluster_id;
					$cluster_item['stage_id']		=	$this->input->post('cmbStage'.$item_code);
					$cluster_item['participant_id']	=	(int)@$participants[$i]['participant_id'];
					$cluster_item['item_code']		=	$item_code;
					$cluster_item['cluster_no']		=	$j;
					$this->db->insert('cluster_participant_details', $cluster_item);
					
					
					$i++;	
				}
				/** inserting data to cluster_participant_details ends */
			}
			//echo $balance;
			$no_of_participant	=	'';
		//}
	}
	
	function update_allotment ($fest_id)
	{
		$this->db->where('fest_id',$fest_id);
		$item_master		=	$this->db->get('item_master');
		foreach($item_master->result_array() as $item)
		{
			$item_code		=	$item['item_code'];
			if ($this->input->post('txtDate'.$item_code) and $this->is_item_to_be_stage_allot($item_code))
			{
				$this->db->where('item_code', $item_code);
				$this->db->delete('stage_item_master');
				
				$this->db->where('item_code', $item_code);
				$this->db->delete('cluster_master');
				
				$this->db->where('item_code', $item_code);
				$this->db->delete('cluster_participant_details');
				$this->save_allotment($item_code);
			}
			
			
			
		}
		return;
	}
	
	function is_item_to_be_stage_allot($item_code)
	{
		$this->db->where('item_code',$item_code);
		$stage_item_master		=	$this->db->get('stage_item_master');
		if ($stage_item_master->num_rows() > 0)
		{
			$stage_item			=	$stage_item_master->result_array();
			$stage_id			=	$stage_item[0]['stage_id'];
			$start_time			=	$stage_item[0]['start_time'];
			$no_of_cluster		=	$stage_item[0]['no_of_cluster'];
			$no_of_participant	=	$stage_item[0]['no_of_participant'];
			$no_of_judges		=	$stage_item[0]['no_of_judges'];
			
			$start_time_fest	=	$this->input->post('txtDate'.$item_code).' '.$this->input->post('txtHour'.$item_code).':'.$this->input->post('txtMin'.$item_code).':00';
			if ($start_time != $start_time_fest || $stage_id != $this->input->post('cmbStage'.$item_code) || $no_of_cluster != $this->input->post('cmbNoOfCluster'.$item_code) || $no_of_judges != $this->input->post('cmbNoOfJudges'.$item_code) || $no_of_participant != $this->input->post('hidMaxPartcipants'.$item_code) )
			{
				return true;
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			return true;
		}
	}
	
	
	function get_participanrts_details($item_code)
	{
		//$item_code	=	$item_code != '') ? $item_code : $this->input->post('code');
		$this->db->where('item_code', $item_code );
		$this->db->select('item_type');
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
			$this->db->where('item_code', $item_code);
			$this->db->select('participant_id');
			//$this->db->order_by('participant_id');
			$this->db->order_by('RAND()');
			$this->db->from('participant_item_details');
			
			
			$result2	=	$this->db->get();
			$result2 =	$result2->result_array();
			if(count($result2) > 0)
			{
				return $result2;
			}
		}
		else
		{
			return;
		}
		return $result2;
	}
	
	
	
	
	
	
}

?>