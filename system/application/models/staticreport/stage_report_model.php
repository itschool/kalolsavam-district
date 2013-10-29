<?php
class Stage_Report_Model extends Model{
	function Stage_Report_Model()
	{
		parent::Model();
	}
	function participate_school_details()
	{
		$this->db->from('school_details AS SM');
		$this->db->join('school_master AS SD','SM.school_code = SD.school_code','LEFT');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function participate_item_details($festid)
	{
		$this->db->where('PD.admn_no = PM.admn_no');
		$this->db->from('participant_item_details AS PD');
		$this->db->join('participant_details  AS PM ','PD.school_code = PM.school_code');
		$this->db->join('school_master as SM','SM.school_code=PM.school_code');
		$this->db->join('item_master   AS IM ','IM.item_code = PD.item_code');
		$this->db->join('festival_master   AS FM','FM.fest_id = IM.fest_id');
		$this->db->where('FM.fest_id',$festid);
		$this->db->group_by('PM.school_code');
		$this->db->order_by('PM.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function schoolalldetails()
	{
		$this->db->select('sd.school_code, pd.item_code, it.item_code, it.item_name, fm.fest_id, fm.fest_name,sm.school_name');
		$this->db->from('school_details AS sd');
		$this->db->join('participant_item_details AS pd ','pd.school_code = sd.school_code');
		$this->db->join('item_master AS it','it.item_code = pd.item_code');
		$this->db->join('festival_master AS fm','fm.fest_id = it.fest_id');
		$this->db->join('school_master AS sm','sm.school_code = sd.school_code');
		$this->db->group_by('sd.school_code');
		$this->db->group_by('fm.fest_id');
		$this->db->order_by('fm.fest_id');
		$this->db->order_by('sd.school_code');
		$res_set    =      $this->db->get();
		return $res_set->result_array();
	}
	
	function itempart_details()
	{
		$this->db->from('festival_master AS FM');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function festval_details()
	{
		$this->db->from('festival_master AS FM');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function list_school_details()
	{
		$this->db->from('school_details AS SM');
		$this->db->select('SM.*,SM.school_code,SD.school_name');
		$this->db->join('school_master AS SD','SM.school_code = SD.school_code','LEFT');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	
	}
	  function get_fee_school_single($schoolCode)
	{
		$this->db->from('school_details AS SM');
		$this->db->where('school_code',$schoolCode);
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
    function get_school_single($schoolCode)
	{
		$this->db->from('school_master AS SM');
		$this->db->where('school_code',$schoolCode);
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function part_item_details($schoolcode)
	{
		$this->db->select('d.school_code, m.school_name, p.participant_id, p.participant_name, p.class, p.gender, pd.item_code, im.item_name, ms.stage_desc, ms.stage_name, cp.cluster_no,fm.fest_name,date(sm.start_time) as ddt,im.max_time,im.time_type,sm.no_of_participant');
		$this->db->from('school_details AS d');
		$this->db->join('school_master AS m','d.school_code = m.school_code');
		$this->db->join('participant_details AS p','p.school_code = d.school_code');
		$this->db->join('participant_item_details AS pd','p.participant_id = pd.participant_id');
		$this->db->join('item_master AS im',' im.item_code = pd.item_code');
		$this->db->join('festival_master AS fm','fm.fest_id=im.fest_id');
		$this->db->join('stage_item_master AS sm','pd.item_code = sm.item_code');
		$this->db->join('stage_master AS ms',' ms.stage_id = sm.stage_id');
		$this->db->join('cluster_participant_details AS cp','cp.item_code = sm.item_code');
		$this->db->where('cp.participant_id = p.participant_id');
		$this->db->where('d.school_code',$schoolcode);
		$this->db->group_by('p.participant_id');
		$this->db->group_by('pd.item_code');
		$this->db->order_by('p.participant_id');
		$this->db->order_by('fm.fest_id');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function part_item_details_allschool()
	{
		$this->db->select('d.school_code, m.school_name, p.participant_id, p.participant_name, p.class, p.gender, pd.item_code, im.item_name, ms.stage_desc, ms.stage_name, cp.cluster_no,fm.fest_name,fm.fest_id,date(sm.start_time) as ddt,im.max_time,im.time_type,sm.no_of_participant ');
		$this->db->from('school_details AS d');
		$this->db->join('school_master AS m','d.school_code = m.school_code');
		$this->db->join('participant_details AS p','p.school_code = d.school_code');
		$this->db->join('participant_item_details AS pd','p.participant_id = pd.participant_id');
		$this->db->join('item_master AS im',' im.item_code = pd.item_code');
		$this->db->join('festival_master AS fm','fm.fest_id=im.fest_id');
		$this->db->join('stage_item_master AS sm','pd.item_code = sm.item_code');
		$this->db->join('stage_master AS ms',' ms.stage_id = sm.stage_id');
		$this->db->join('cluster_participant_details AS cp','cp.item_code = sm.item_code');
		$this->db->where('cp.participant_id = p.participant_id');
		$this->db->group_by('p.participant_id');
		$this->db->group_by('pd.item_code');
		$this->db->order_by('d.school_code');
		$this->db->order_by('p.participant_id');
		$this->db->order_by('fm.fest_id');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	
	
	
	function get_fees_details($school_code)
	{
		$this->db->where('school_code',$school_code);
		$school_details		=	$this->db->get('school_details');
		$up_fee				=	0;
		$hs_fee				=	0;
		$hss_fee			=	0;
		$vhss_fee			=	0;
		if ($school_details->num_rows() > 0){
		
			$school				=	$school_details->row();
			
		}
		if ($school->class_end > 5)
			{
				if ((int)$school->strength_up > 0)
				{
					$this->db->where('school_code',$school_code);
					$this->db->where('class >= 5');
					$this->db->where('class <= 7');					
					$cnt_participants		=	$this->db->count_all_results('participant_details');
					$up_fee					=	$this->get_fee_div('UP',(int)$school->strength_up,(int)$cnt_participants);
				}
				if ((int)$school->strength_hs > 0)
				{
					$this->db->where('school_code',$school_code);
					$this->db->where('class >= 8');
					$this->db->where('class <= 10');					
					$cnt_participants		=	$this->db->count_all_results('participant_details');
					
					$hs_fee				=	$this->get_fee_div('HS',(int)$school->strength_hs,(int)$cnt_participants);
				}
				if ((int)$school->strength_hss > 0)
				{
					$hss_fee				=	$this->get_fee_div('HSS',(int)$school->strength_hss,(int)$school->strength_hss);
				}
				if ((int)$school->strength_vhss > 0)
				{
					$vhss_fee				=	$this->get_fee_div('VHSS',(int)$school->strength_vhss,(int)$school->strength_vhss);
				}
				
			}
		$school=$this->get_school_data($school_code);
		//print_r($hs_fee);
		$return_array['up_fee']		=	$up_fee;
		$return_array['hs_fee']		=	$hs_fee;
	 	$return_array['hss_fee']	=	$hss_fee;
		$return_array['vhss_fee']	=	$vhss_fee;
		$return_array['school']     =   $school;
		return $return_array;
	}
	
	function get_fee_div($div,$no_studts,$no_participant)
	{
		$this->db->where('fee_class',$div);
		$this->db->where('min_students < ',$no_studts);
		$this->db->where('max_students >=',$no_studts);
		$fees_master		=	$this->db->get('fees_master');
		$fee_struct		=	$fees_master->result_array();
		$fee['afliation']				=	$fee_struct[0]['fees'];
		$fee['participant']				=	($no_participant * 5);
		return $fee;
	}
	function get_school_data($school_code)
	{
		$this->db->where('PD.school_code',$school_code);
		$this->db->from('school_master AS PD');
		$this->db->select('PD.*');
		$school_details		=	$this->db->get();
		$school_struct		=	$school_details->result_array();
		$school['name']     =   $school_struct[0]['school_name'];
		$school['code']     =   $school_struct[0]['school_code'];
		$school['edu']      =   $school_struct[0]['sub_district_code'];
		return $school;
	}
	
	
	//============all school fee details
	
	function get_fees_details_all()
	{
		 $this->db->where('s.school_code = d.school_code');
		 $this->db->from('school_master AS s');
		  $this->db->from('school_details AS d');
		$school_details		=	$this->db->get();
		$school_struct		=	$school_details->result_array();
		
	/*	if ($school_struct->num_rows() > 0){
		
			$school				=	$school_details->row();
			
		}*/
		$i=0; $k=0;
		for($j=0; $j<count($school_struct); $j++)
		{
		$up_fee				=	0;
		$hs_fee				=	0;
		$hss_fee			=	0;
		$vhss_fee			=	0;
		
		if ($school_struct[$j]['class_end'] > 5)
			{
				if (($school_struct[$j]['strength_up']) > 0)
				{
					$this->db->where('school_code',$school_struct[$j]['school_code']);
					$this->db->where('class >= 5');
					$this->db->where('class <= 7');					
					$cnt_participants		=	$this->db->count_all_results('participant_details');
					$up_fee					=	$this->get_fee_div('UP',$school_struct[$j]['strength_up'],$cnt_participants);
				}
				if (($school_struct[$j]['strength_hs']) > 0)
				{
					$this->db->where('school_code',$school_struct[$j]['school_code']);
					$this->db->where('class >= 8');
					$this->db->where('class <= 10');					
					$cnt_participants		=	$this->db->count_all_results('participant_details');
					
					$hs_fee				=	$this->get_fee_div('HS',$school_struct[$j]['strength_hs'],$cnt_participants);
				}
				if (($school_struct[$j]['strength_hss']) > 0)
				{
					$hss_fee				=	$this->get_fee_div('HSS',$school_struct[$j]['strength_hss'],$school_struct[$j]['strength_hss']);
				}
				if (($school_struct[$j]['strength_vhss']) > 0)
				{
					$vhss_fee				=	$this->get_fee_div('VHSS',$school_struct[$j]['strength_vhss'],$school_struct[$j]['strength_vhss']);
				}
				
			}
		$school=$this->get_school_data_single($school_struct[$j]['school_code']);
		//$this->db->where('school_code',$school_struct[$j]['school_code']);
		//$school_details		=	$this->db->get('school_master');
		//$school				=	$school_details->row();
		//$school_struct		=	$school_details->result_array();
		//$ret['code']= $school[0]['school_code'];
		//$ret['name']= $school[0]['school_name'];
		
		//print_r($school);
		$jh[$i]=array(	
		$return_array['school']     =   $school_struct[$j]['school_code'],
		$return_array['up_fee']		=	$up_fee,
		$return_array['hs_fee']		=	$hs_fee,
	 	$return_array['hss_fee']	=	$hss_fee,
		$return_array['vhss_fee']	=	$vhss_fee
		);
		
		$jhh[$k]=array("schoolcode"=>$school_struct[$j]['school_code'],"schoolname"=>$school_struct[$j]['school_name'],"up_afli"=>$up_fee['afliation'],"up_part"=>$up_fee['participant'],"hs_afli"=>$hs_fee['afliation'],"hs_part"=>$hs_fee['participant'],"hss_afli"=>$hss_fee['afliation'],"hss_part"=>$hss_fee['participant'],"vhss_afli"=>$vhss_fee['afliation'],"vhss_part"=>$vhss_fee['participant']);
		$i++; $k++;
		
		}
		return $jhh;
	
	}
	
	function get_school_data_single($school_code)
	{
		$this->db->where('PD.school_code',$school_code);
		$this->db->from('school_master AS PD');
		$this->db->select('PD.*');
		$school_details		=	$this->db->get();
		$school_struct		=	$school_details->result_array();
		
		return $school_struct;
	}
	
	function get_callsheet_details($itemcode)
	{
		$this->db->where('SIM.item_code = CP.item_code');
		$this->db->from('stage_item_master  AS SIM');
		$this->db->join('stage_master AS SM ','SM.stage_id = SIM.stage_id');
		$this->db->join('item_master    AS IM ','IM.item_code = SIM.item_code');
		$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
		$this->db->join('cluster_participant_details  AS CP','SIM.stage_id = CP.stage_id');
		$this->db->where('CP.item_code',$itemcode);
		$this->db->group_by('CP.participant_id');
		$this->db->group_by('IM.item_code');
		$this->db->order_by('CP.cluster_id');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		
	}
	function get_participant_card($schoolcode)
	{
		$this->db->from('school_details   AS sd');
		$this->db->select('sd.school_code, pd.participant_id, pd.school_code, pd.participant_name,
pd.class, pd.gender, pid.item_code, pid.item_type, pid.is_captain, it.item_name, it.fest_id, sm.stage_id, date(sm.start_time) AS datee, ssm.stage_desc,ssm.stage_name, fm.fest_name,cpd.cluster_no');
		$this->db->join('participant_details AS pd','pd.school_code = sd.school_code');
		$this->db->join('participant_item_details  AS pid ','pid.participant_id = pd.participant_id');
		$this->db->join('item_master AS it','it.item_code = pid.item_code');
		$this->db->join('festival_master AS fm','fm.fest_id = it.fest_id');
		$this->db->join('stage_item_master AS sm','sm.item_code = it.item_code');
		$this->db->join('stage_master AS ssm','ssm.stage_id = sm.stage_id');
		$this->db->join('cluster_participant_details AS cpd','cpd.item_code = pid.item_code'); 
		$this->db->where('sd.school_code',$schoolcode);
		//$this->db->where(' pid.school_code = sd.school_code');
		//$this->db->where(' cpd.stage_id = sm.stage_id');
		//$this->db->where(' cpd.participant_id = pd.participant_id');
		$this->db->group_by('it.fest_id'); 
		$this->db->group_by('pid.item_code');
		$this->db->order_by('it.fest_id'); 
		$this->db->order_by('pid.item_code');

		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	//================list of student participat more than one item
	
		function participant_details()
		{
		//$this->db->from('participant_item_details AS PID');
		//$this->db->select('count( PID.participant_id ) AS cnt, PID.participant_id, PD.school_code, PD.participant_name, PD.class, PD.gender, PD.admn_no, PID.item_code, IM.item_name, IM.fest_id');
		//$this->db->join('participant_details AS PD','PD.participant_id = PID.participant_id');
		//$this->db->join('item_master AS IM','IM.item_code = PID.item_code');
		//$this->db->join('school_master AS SM','SM.school_code=PD.school_code');
		//$this->db->group_by('PID.participant_id');
		//$this->db->having('cnt >', '1');
		//$this->db->order_by('IM.fest_id');
		$this->db->from('participant_item_details ');
		$this->db->select('count(participant_id) AS cnt,participant_id');
		$this->db->group_by('participant_id');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function list_participant_more($festid)
	{
		$this->db->from('participant_item_details AS PID');
		$this->db->select('count( PID.participant_id ) AS cnt, PID.participant_id, PD.school_code, PD.participant_name, PD.class, PD.gender, PD.admn_no, PID.item_code, IM.item_name, IM.fest_id,SM.school_name,FM.fest_name');
		$this->db->join('participant_details AS PD','PD.participant_id = PID.participant_id');
		$this->db->join('item_master AS IM','IM.item_code = PID.item_code');
		$this->db->join('festival_master AS FM','FM.fest_id=IM.fest_id');
		$this->db->join('school_master AS SM','SM.school_code=PD.school_code');
		$this->db->group_by('PID.participant_id');
		$this->db->having('cnt >', '1');
		if($festid==0)
		$this->db->order_by('IM.fest_id');
		else 
		$this->db->where('IM.fest_id',$festid);
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function list_more_limitpart($festid,$limit)
	{
		$this->db->from('participant_item_details AS PID');
		$this->db->select('count( PID.participant_id ) AS cnt, PID.participant_id, PD.school_code, PD.participant_name, PD.class, PD.gender, PD.admn_no, PID.item_code, IM.item_name, IM.fest_id,SM.school_name,FM.fest_name');
		$this->db->join('participant_details AS PD','PD.participant_id = PID.participant_id');
		$this->db->join('item_master AS IM','IM.item_code = PID.item_code');
		$this->db->join('festival_master AS FM','FM.fest_id=IM.fest_id');
		$this->db->join('school_master AS SM','SM.school_code=PD.school_code');
		$this->db->group_by('PID.participant_id');
		$this->db->having('cnt >=', $limit);
		$this->db->where('IM.fest_id',$festid);
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	
	}
	function list_eligible_schools()
	{
	$this->db->from('school_details AS d');
	$this->db->from('school_master AS m');
	$this->db->select('d.school_code, m.school_name, m.sub_district_code, m.edu_district_code, m.rev_district_code');
	$this->db->where('m.school_code = d.school_code');
	$this->db->order_by('m.school_code');
	$school_details		=	$this->db->get();
	return $school_details->result_array();
	
	}
	function timesheet_details($festid,$itemcode)
	{
		$this->db->where('m.item_code',$itemcode);
	 	$this->db->where('m.fest_id',$festid);
	 	$this->db->select('m.item_code, m.item_name, m.fest_id,f.fest_name');
	 	$this->db->from('item_master AS m');
	    $this->db->from('festival_master AS f');
	    $this->db->group_by('m.item_code');
	    $fest_details		=	$this->db->get();
		return $fest_details->result_array();
	}
	
	function cluster_reportreport($festid,$itemcode)
	{
	$this->db->where('cm.item_code',$itemcode);
	$this->db->select('cm.stage_id, cm.item_code, cm.cluster_id, cm.cluster_no, cpd.participant_id, cpd.cluster_no, fm.fest_name, im.item_name, sm.stage_name, sm.stage_desc, date(cm.start_time) AS stime,im.max_time,time( cm.start_time ) AS ttime');
	$this->db->from('cluster_master AS cm');
	$this->db->join('cluster_participant_details AS cpd','cm.item_code = cpd.item_code');
	$this->db->join('item_master  AS  im','im.item_code = cpd.item_code');
	$this->db->join('festival_master  AS fm','fm.fest_id = im.fest_id');
	$this->db->join('stage_master AS sm','sm.stage_id = cm.stage_id');
	$this->db->group_by('cpd.participant_id');
	$this->db->group_by('cm.item_code');
	$this->db->order_by('cpd.cluster_no');
	 	$fest_details		=	$this->db->get();
		return $fest_details->result_array();

	}
	function clash_info1()
	{
	
	   $query="SELECT PD.participant_id, PD.participant_name, PD.school_code, PID.parent_admn_no, PID.item_code, CPD.cluster_id, 	 SM.school_name, IM.item_name, C.cnt, CM.start_time, CM.end_time
FROM (

SELECT count( PID.participant_id ) AS cnt, participant_id
FROM participant_item_details AS PID
GROUP BY `PID`.`participant_id` 
HAVING cnt > '1'
) AS C, participant_item_details AS PID
 JOIN participant_details AS PD ON PD.participant_id = PID.participant_id
JOIN cluster_participant_details AS CPD ON PD.participant_id = CPD.participant_id
JOIN school_master AS SM ON SM.school_code = PD.school_code
JOIN item_master AS IM ON IM.item_code = PID.item_code
LEFT JOIN cluster_master AS CM ON CM. cluster_id = CPD. cluster_id and CM. item_code = PID. item_code
WHERE c.participant_id = PD.participant_id and CM.start_time!='' and CM.end_time!=''
ORDER BY  PD.participant_name,CM.start_time,CM.end_time";
$clash_detail		=$this->db->query($query);
		return   $clash_detail->result_array();
	}
	
}

?>