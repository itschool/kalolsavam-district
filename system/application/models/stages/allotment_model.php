<?php
class Allotment_Model extends Model{
	function Allotment_Model()
	{
		parent::Model();
	}
	
	function get_stages()
	{
		$this->db->from('stage_master');
		$this->db->orderby('stage_name', 'ASC');
		$this->db->select('*');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function get_item_details($item_code='')
	{
		$item_code	=	($item_code != '') ? $item_code : $this->input->post('code');
		$this->db->where('item_code', $item_code );
		$this->db->select('item_code, item_name, max_time, time_type, item_type, is_off_stage');
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
			$this->db->select('COUNT(pi_id) as count');
			$this->db->from('participant_item_details');
			$result2	=	$this->db->get();
			$result2 =	$result2->result_array();
			
			if(count($result2) > 0)
			{
				$result[0]['total_participants'] = $result2[0]['count'];
				$time	=	($result[0]['time_type'] == 'S') ? ceil((int)$result[0]['max_time'] / 60) : (int)$result[0]['max_time'];
				if ($result[0]['is_off_stage'] == 'Y')
				{
					$result[0]['total_time']	=	(int)$time;
				}
				else
				{
					$result[0]['total_time']	=	(int)$time * (int)$result2[0]['count'];
				}
			
			}
			
		}
		else
		{
			return;
		}
		return $result;
	}
	
	function save_allotment () 
	{
		$si_id			=	$this->save_stage_item_details();
		$cluster_id		=	$this->save_cluster_details($si_id);	
	}
	
	/** function for save details of allotment to stage item master*/
	function save_stage_item_details ()
	{
		$stage_id					=	$this->input->post('cmbStage');
		$item_code					=	$this->input->post('hidItemId');
		$this->db->where('item_code',$item_code);
		$item_master				=	$this->db->get('item_master');
		$item						=	$item_master->result_array();
		$item_time					=	$item[0]['max_time'];
		$time_type					=	$item[0]['time_type'];
		$off_stage					=	$item[0]['is_off_stage'];
		$no_of_participant			=	$this->input->post('hidMaxPartcipants');	
		$start_time					=	$this->input->post('txtDate').' '.$this->input->post('txtHour').':'.$this->input->post('txtMin').':00';	
		
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
		$data['no_of_cluster']		=	$this->input->post('cmbNoOfCluster');
		$data['no_of_judges']		=	$this->input->post('cmbNoOfJudges');
		$data['no_of_participant']	=	$no_of_participant;
		$data['item_time']			=	$item_time;
		$data['time_type']			=	$time_type;
		$this->db->insert('stage_item_master', $data);
		$si_id 	=	$this->db->insert_id();
		return $si_id;
	}
	
	/** function for save the cluster details*/
	function save_cluster_details($si_id)
	{
	
			$item_code					=	$this->input->post('hidItemId');
			$this->db->where('item_code',$item_code);
			$item_master				=	$this->db->get('item_master');
			$item						=	$item_master->result_array();
			$item_time					=	$item[0]['max_time'];
			$time_type					=	$item[0]['time_type'];
			$off_stage					=	$item[0]['is_off_stage'];
			
		//if($this->input->post('cmbNoOfCluster') >1){
			$cluster_no			=	1;
			$in_each_cluster	=	floor((int)$this->input->post('hidMaxPartcipants') / (int)$this->input->post('cmbNoOfCluster'));
			$balance			=	(int)$this->input->post('hidMaxPartcipants') % (int)$this->input->post('cmbNoOfCluster');	
			$participants		=	$this->get_participanrts_details($item_code);
			$start_time			=	$this->input->post('txtDate').' '.$this->input->post('txtHour').':'.$this->input->post('txtMin').':00';
			$i					=	0;
			//print_r($participants);
			for($j = 1; $j <= $this->input->post('cmbNoOfCluster'); $j++)
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

				$total_time_for_item	=	($this->input->post('hidTimeType') == 'S') ? ceil((int)$this->input->post('hidMaxTime') / 60) : (int)$this->input->post('hidMaxTime');	
				
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
				$data['stage_id']			=	$this->input->post('cmbStage');
				$data['item_code']			=	$this->input->post('hidItemId');
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
					$cluster_item['stage_id']		=	$this->input->post('cmbStage');
					$cluster_item['participant_id']	=	$participants[$i]['participant_id'];
					$cluster_item['item_code']		=	$this->input->post('hidItemId');
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
	
	function update_allotment ()
	{
		//if($this->input->post('cmbNoOfCluster') != $this->input->post('hidNoOfCluster'))
		{
			$this->db->where('item_code', $this->input->post('hidItemId'));
			$this->db->delete('stage_item_master');
			
			$this->db->where('item_code', $this->input->post('hidItemId'));
			$this->db->delete('cluster_master');
			
			$this->db->where('item_code', $this->input->post('hidItemId'));
			$this->db->delete('cluster_participant_details');
			$this->save_allotment();
			return;
		}
		//else
		{
			//$data['start_time']			=	$this->input->post('txtDate').' '.$this->input->post('txtHour').':'.$this->input->post('txtMin').':00';
			
			
			/*$this->db->where('item_code', $this->input->post('hidItemId'));
			$data	=	array();
			$data['stage_id']			=	$this->input->post('cmbStage');
			$data['no_of_judges']		=	$this->input->post('cmbNoOfJudges');
			$this->db->update('stage_item_master', $data);
			
			$this->db->where('item_code', $this->input->post('hidItemId'));
			$data	=	array();
			$data['stage_id']			=	$this->input->post('cmbStage');
			$this->db->update('cluster_master', $data);
			
			$this->db->where('item_code', $this->input->post('hidItemId'));
			$cluster_item	=	array();
			$cluster_item['stage_id']		=	$this->input->post('cmbStage');
			$this->db->update('cluster_participant_details', $cluster_item);
			
			$this->update_cluster_time();
			return;*/
		}
	}
	
	/** function for update cluster start time and end time */
	function update_cluster_time()
	{
		$item_code		=	$this->input->post('hidItemId');
		$start_time	=	$this->input->post('txtDate').' '.$this->input->post('txtHour').':'.$this->input->post('txtMin').':00';
		
		$this->db->where('item_code', $item_code);
		$this->db->where('start_time', $start_time);
		$stage_time		=	$this->db->get('stage_item_master');
		if ($stage_time->num_rows() <= 0)
		{
			$this->db->where('item_code',$item_code);
			$item_master				=	$this->db->get('item_master');
			$item						=	$item_master->result_array();
			$item_time					=	$item[0]['max_time'];
			$time_type					=	$item[0]['time_type'];
			$off_stage					=	$item[0]['is_off_stage'];
			
			
			$this->db->where('item_code', $item_code);
			$data	=	array();
			$data['start_time']			=	$start_time;
			$this->db->update('stage_item_master', $data);
			
			$this->db->where('CM.item_code', $item_code);
			$this->db->order_by('CM.cluster_no');
			$this->db->select('CM.cluster_no,CM.no_of_participant,IM.max_time,IM.time_type');
			$this->db->join('item_master AS IM','CM.item_code = IM.item_code');
			$cluster_master		=	$this->db->get('cluster_master AS CM');
			foreach($cluster_master->result_array() as $cluster)
			{
				
				$cluster_no				=	$cluster['cluster_no'];
				$no_of_participant		=	$cluster['no_of_participant'];
				$max_time				=	$cluster['max_time'];
				$time_type				=	$cluster['time_type'];

				$total_time_for_item	=	($time_type == 'S') ? ceil((int)$max_time / 60) : (int)$max_time;	
				if ($off_stage)
				{
					$total_time_in_minutes	= 	(int)$total_time_for_item;	
				}
				else
				{
					$total_time_in_minutes	= 	(int)$total_time_for_item * $no_of_participant;	
				}
				
				
				$timestamp = strtotime(date("Y-m-d H:i:s", strtotime($start_time)) . " + ".$total_time_in_minutes." mins");  
				$end_time = date('Y-m-d H:i:s', $timestamp);  
				/* Calculating end time of the cluster ends */
				
				$this->db->where('cluster_no',$cluster_no);
				$this->db->where('item_code',$item_code);
				$data					=	array();
				$data['start_time']		=	$start_time;
				$data['end_time']		=	$end_time;
				
				$this->db->update('cluster_master',$data);
				
				$start_time				=	$end_time;	
					
			}
			
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
	
	function get_alloted_item_details ($item_code='')
	{
		$item_code	=	($item_code != '') ? $item_code : $this->input->post('code');
		$this->db->select('PD.item_code, PD.cluster_no, PD.participant_id, PDT.school_code, PD.cp_id, PD.stage_id, PD.cluster_id, CM.si_id, IM.no_of_cluster, IM.start_time, IM.no_of_judges');
		$this->db->from('cluster_participant_details PD');
		$this->db->join('cluster_master CM', 'CM.cluster_id = PD.cluster_id', 'INNER');
		$this->db->join('stage_item_master IM', 'CM.si_id = IM.si_id', 'INNER');
		$this->db->join('participant_details PDT', 'PDT.participant_id = PD.participant_id', 'INNER');
		$this->db->where('PD.item_code', $item_code);
		$this->db->order_by('PD.cluster_no');
		$result	=	$this->db->get();
		return $result->result_array();
	}
	function get_cluster_master_details($item_code = '')
	{
		$item_code	=	($item_code != '') ? $item_code : $this->input->post('code');
		$this->db->where('CM.item_code',$item_code);
		$this->db->order_by('CM.cluster_no');
		$this->db->join('stage_master AS SM','CM.stage_id = SM.stage_id');
		$this->db->select('CM.*,SM.stage_name');
		$cluster_master		=	$this->db->get('cluster_master AS CM');
		return $cluster_master->result_array();
	}
	
	
	function update_cluster_participant($item_code)
	{
		$item_code	=	($item_code != '') ? $item_code : $this->input->post('code');
		$this->db->where('item_code',$item_code);
		$cluster_participant_details		=	$this->db->get('cluster_participant_details');
		foreach($cluster_participant_details->result_array() as $cluster_participant)
		{
			$cp_id					=	$cluster_participant['cp_id'];
			$cluster_no				=	$this->input->post('cmbClusterNo_'.$cp_id);
			
			$this->db->where('cluster_no',$cluster_no);
			$this->db->where('item_code',$item_code);
			$cluster_master		=	$this->db->get('cluster_master');
			$cluster			=	$cluster_master->result_array();
			$cluster_id			=	@$cluster[0]['cluster_id'];
				
			
			
			$data					=	array();
			$data['cluster_no']		=	$cluster_no;
			$data['cluster_id']		=	$cluster_id;
			$this->db->where('cp_id',$cp_id);			
			$this->db->update('cluster_participant_details',$data);
		}
		
		$this->db->where('item_code',$item_code);
		$stage_item_master	=	$this->db->get('stage_item_master');
		
		$stage_item			=	$stage_item_master->result_array();
		$start_time			=	$stage_item[0]['start_time'];	
		$item_time			=	$stage_item[0]['item_time'];
		$time_type			=	$stage_item[0]['time_type'];
		
		
		
		$this->db->where('item_code',$item_code);
		$this->db->order_by('cluster_no');
		$cluster_master		=	$this->db->get('cluster_master');
		foreach($cluster_master->result_array() as $cluster)
		{
			$cluster_id			=	$cluster['cluster_id'];
			$this->db->where('cluster_id',$cluster_id);
			$no_of_participant	=	$this->db->count_all_results('cluster_participant_details');
			
			$total_time_for_item	=	($time_type == 'S') ? ceil((int)$item_time / 60) : (int)$item_time;	
			$total_time_in_minutes	= 	(int)$total_time_for_item * $no_of_participant;	
			$timestamp = strtotime(date("Y-m-d H:i:s", strtotime($start_time)) . " + ".$total_time_in_minutes." mins");  
			$end_time = date('Y-m-d H:i:s', $timestamp);  
			
			
			/**
			** Set participant count start time and end time in Cluster Master
			*/
			$this->db->where('cluster_id',$cluster_id);
			$data						=	array();
			$data['no_of_participant']	=	$no_of_participant;
			$data['start_time']			=	$start_time;
			$data['end_time']			=	$end_time;
			$this->db->update('cluster_master',$data);
			
			$start_time					=	$end_time;		
				
		}
			
		
	}
}

?>