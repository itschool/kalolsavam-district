<?php
class Prereport_Model extends Model{
	function Prereport_Model()
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
	function participate_item_details($festid,$subdist)
	{
	
	  if($subdist!='All')
	  {
		$this->db->where('PD.admn_no = PM.admn_no');
		$this->db->from('participant_item_details AS PD');
		$this->db->join('participant_details  AS PM ','PD.school_code = PM.school_code');
		$this->db->join('school_master as SM','SM.school_code=PM.school_code');
		$this->db->join('sub_district_master as SDM','SM.sub_district_code=SDM.sub_district_code');
		$this->db->join('item_master   AS IM ','IM.item_code = PD.item_code');
		$this->db->join('festival_master   AS FM','FM.fest_id = IM.fest_id');
		if($festid!=0)
		{
		$this->db->where('FM.fest_id',$festid);
		}
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->group_by('PM.school_code');
		$this->db->order_by('PM.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		}
		else
		{
		$this->db->where('PD.admn_no = PM.admn_no');
		$this->db->from('participant_item_details AS PD');
		$this->db->join('participant_details  AS PM ','PD.school_code = PM.school_code');
		$this->db->join('school_master as SM','SM.school_code=PM.school_code');
		$this->db->join('sub_district_master as SDM','SM.sub_district_code=SDM.sub_district_code');
		$this->db->join('item_master   AS IM ','IM.item_code = PD.item_code');
		$this->db->join('festival_master   AS FM','FM.fest_id = IM.fest_id');
       if($festid!=0)
		{
		$this->db->where('FM.fest_id',$festid);
			}
		$this->db->group_by('PM.school_code');
		$this->db->order_by('PM.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		}
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
	function part_item_details($sub_district_code,$festid)
	{
	/*
	$qy="SELECT p.participant_id, p.school_code, p.item_code, p.item_type, p.is_captain, d.participant_name, d.gender, d.class, c.cluster_no, date( s.start_time ) AS ddt, 					         im.time_type, ss.stage_name, ss.stage_desc, im.item_name, F.fest_id,         F.fest_name, m.school_name, s.no_of_participant, im.is_off_stage,im.max_time
         FROM participant_item_details AS p
         JOIN item_master AS im ON im.item_code = p.item_code
         JOIN festival_master AS F ON F.fest_id = im.fest_id
         JOIN school_master AS m ON m.school_code = p.school_code
         JOIN participant_details AS d ON d.participant_id = p.participant_id
         LEFT JOIN cluster_participant_details AS c ON p.participant_id = c.participant_id
         AND c.item_code = p.item_code
         LEFT JOIN stage_item_master AS s ON s.item_code = c.item_code
         LEFT JOIN stage_master AS ss ON ss.stage_id = s.stage_id
         where p.school_code='$schoolcode'
        GROUP BY p.participant_id, p.item_code
        ORDER BY p.school_code, F.fest_id, p.item_code";
		*/
		$this->db->select('p.participant_id,d.admn_no,	 p.school_code, p.item_code, p.item_type, p.is_captain, d.participant_name, d.gender, d.class, c.cluster_no, date( s.start_time ) AS ddt, im.time_type, ss.stage_name, ss.stage_desc, im.item_name, F.fest_id,F.fest_name, m.school_name,su.sub_district_name, s.no_of_participant, im.is_off_stage,im.max_time');
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS im','im.item_code = p.item_code');
		$this->db->join('festival_master AS F','F.fest_id = im.fest_id');
		$this->db->join('school_master AS m',' m.school_code = p.school_code');
		$this->db->join('sub_district_master AS su',' m.sub_district_code = su.sub_district_code');
		$this->db->join('participant_details AS d','d.participant_id = p.participant_id');
		$this->db->join('cluster_participant_details AS c','p.participant_id = c.participant_id and c.item_code = p.item_code','LEFT');
		$this->db->join('stage_item_master AS s','s.item_code = c.item_code','LEFT');
		$this->db->join('stage_master AS ss','ss.stage_id = s.stage_id','LEFT');
		//$this->db->where('p.school_code',$schoolcode);
		$this->db->where('m.sub_district_code',$sub_district_code);
		if($festid!=0){
		$this->db->where('F.fest_id',$festid);
		}
		$this->db->group_by('p.participant_id');
		$this->db->group_by('p.item_code');
		$this->db->order_by('p.school_code');
		$this->db->order_by('F.fest_id');
		$this->db->order_by('p.item_code');
		$this->db->order_by('p.is_captain','desc');
		
		
		
		$school_details		=	$this->db->get();
		return $school_details->result_array();

	}
	function part_item_details_allschool($festid)
	{
		/*$this->db->select('p.participant_id, p.school_code, p.item_code, p.item_type,          p.is_captain, d.participant_name, d.gender, d.class, c.cluster_no, date( s.start_time )          AS ddt,im.time_type, ss.stage_name, ss.stage_desc, im.item_name, F.fest_id, F.fest_name,          m.school_name, s.no_of_participant, im.is_off_stage,im.max_time');
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS im','im.item_code = p.item_code');
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
		*/
		$where		=	'';
		if ($festid)
		{
			$where		=	" where F.fest_id='$festid' ";
		}
		
		$qy="SELECT p.participant_id,d.admn_no, p.school_code, p.item_code, p.item_type, p.is_captain, d.participant_name, d.gender, d.class, c.cluster_no, date( s.start_time ) AS ddt, im.time_type, ss.stage_name, ss.stage_desc, im.item_name, F.fest_id, F.fest_name, m.school_name, su.sub_district_name, s.no_of_participant, im.is_off_stage,im.max_time
             FROM participant_item_details AS p
             JOIN item_master AS im ON im.item_code = p.item_code
             JOIN festival_master AS F ON F.fest_id = im.fest_id
             JOIN school_master AS m ON m.school_code = p.school_code
			 JOIN sub_district_master AS su ON m.sub_district_code = su.sub_district_code 
             JOIN participant_details AS d ON d.participant_id = p.participant_id
             LEFT JOIN cluster_participant_details AS c ON p.participant_id = c.participant_id
             AND c.item_code = p.item_code
             LEFT JOIN stage_item_master AS s ON s.item_code = c.item_code
             LEFT JOIN stage_master AS ss ON ss.stage_id = s.stage_id
             $where
             GROUP BY p.participant_id, p.item_code
             ORDER BY m.sub_district_code,p.school_code, F.fest_id, p.item_code,p.is_captain desc";
		 $fest_detail1		=	$this->db->query($qy);
		return $fest_detail1->result_array();

//$school_details		=	$this->db->query();
//return $school_details->result_array();
		
	}
		function itemdetails_allschoolfest()
		{
		$qy="SELECT p.participant_id, p.admn_no, p.school_code, p.item_code, p.item_type, p.is_captain, 						             d.participant_name, d.gender, d.class, c.cluster_no, date( s.start_time ) AS ddt,             im.time_type, ss.stage_name, ss.stage_desc, im.item_name, F.fest_id, F.fest_name,             m.school_name, s.no_of_participant, im.is_off_stage,im.max_time
             FROM participant_item_details AS p
             JOIN item_master AS im ON im.item_code = p.item_code
             JOIN festival_master AS F ON F.fest_id = im.fest_id
             JOIN school_master AS m ON m.school_code = p.school_code
             JOIN participant_details AS d ON d.participant_id = p.participant_id
             LEFT JOIN cluster_participant_details AS c ON p.participant_id = c.participant_id
             AND c.item_code = p.item_code
             LEFT JOIN stage_item_master AS s ON s.item_code = c.item_code
             LEFT JOIN stage_master AS ss ON ss.stage_id = s.stage_id
             GROUP BY p.participant_id, p.item_code
             ORDER BY p.school_code, F.fest_id, p.item_code";
			 
		 	$fest_detail1		=	$this->db->query($qy);
			return $fest_detail1->result_array();

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
		 $this->db->order_by('d.school_code');
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
		
		//print_r($school);
		$jh[$i]=array(	
		$return_array['school']     =   $school_struct[$j]['school_code'],
		$return_array['up_fee']		=	$up_fee,
		$return_array['hs_fee']		=	$hs_fee,
	 	$return_array['hss_fee']	=	$hss_fee,
		$return_array['vhss_fee']	=	$vhss_fee
		);
		
		$jhh[$k]=array("schoolcode"=>$school_struct[$j]['school_code'],"schoolname"=>$school_struct[$j]['school_name'],"up_afli"=>$up_fee['afliation'],"up_part"=>$up_fee['participant'],"hs_afli"=>$hs_fee['afliation'],"hs_part"=>$hs_fee['participant'],"hss_afli"=>$hss_fee['afliation'],"hss_part"=>$hss_fee['participant'],"vhss_afli"=>$vhss_fee['afliation'],"vhss_part"=>$vhss_fee['participant']);
		$i++; 
		$k++;
		
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
	$this->db->select(' SM.stage_name, SM.stage_desc, IM.item_code, IM.item_name, FM.fest_id, FM.fest_name, CP.participant_id, CP.cluster_no, SIM.start_time, SIM.item_time, SIM.time_type,SIM.no_of_participant,pd.spo_id,so.is_publish');
		$this->db->where('SIM.item_code = CP.item_code');
		$this->db->from('stage_item_master  AS SIM');
		$this->db->join('stage_master AS SM ','SM.stage_id = SIM.stage_id');
		$this->db->join('item_master    AS IM ','IM.item_code = SIM.item_code');
		$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
		$this->db->join('cluster_participant_details  AS CP','SIM.stage_id = CP.stage_id');
		$this->db->join('participant_item_details AS pd','pd.participant_id=CP.participant_id');
		$this->db->join('special_order_master AS so','so.spo_id=pd.spo_id','LEFT');
		$this->db->where('CP.item_code',$itemcode);
		$this->db->group_by('CP.participant_id');
		$this->db->group_by('IM.item_code');
		$this->db->order_by('CP.cluster_id');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		
	}
	
		function all_callsheet_details($festcode,$date)
	{   
	if($date!='All')
	{
		$this->db->select(' SM.stage_name, SM.stage_desc,SIM.start_time,IM.item_code, IM.item_name, FM.fest_id, FM.fest_name, CP.participant_id, CP.cluster_no, SIM.start_time, SIM.item_time, SIM.time_type,SIM.no_of_participant,pd.spo_id,so.is_publish');
		$this->db->where('SIM.item_code = CP.item_code');
		$this->db->from('stage_item_master  AS SIM');
		$this->db->join('stage_master AS SM ','SM.stage_id = SIM.stage_id');
		$this->db->join('item_master    AS IM ','IM.item_code = SIM.item_code');
		$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
		$this->db->join('cluster_participant_details  AS CP','SIM.stage_id = CP.stage_id');
		$this->db->join('participant_item_details AS pd','pd.participant_id=CP.participant_id');
		$this->db->join('special_order_master AS so','so.spo_id=pd.spo_id','LEFT');
		$this->db->where('IM.fest_id',$festcode);
		$this->db->where('date(SIM.start_time)',$date);
		$this->db->where('pd.item_code = IM.item_code');
		$this->db->group_by('CP.participant_id');
		$this->db->group_by('IM.item_code');
		$this->db->order_by('CP.item_code');
		$this->db->order_by('CP.cluster_id');
		
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		}
		else
		{
		$this->db->select(' SM.stage_name, SM.stage_desc,SIM.start_time,IM.item_code, IM.item_name, FM.fest_id, FM.fest_name, CP.participant_id, CP.cluster_no, SIM.start_time, SIM.item_time, SIM.time_type,SIM.no_of_participant,pd.spo_id,so.is_publish');
		$this->db->where('SIM.item_code = CP.item_code');
		$this->db->from('stage_item_master  AS SIM');
		$this->db->join('stage_master AS SM ','SM.stage_id = SIM.stage_id');
		$this->db->join('item_master    AS IM ','IM.item_code = SIM.item_code');
		$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
		$this->db->join('cluster_participant_details  AS CP','SIM.stage_id = CP.stage_id');
		$this->db->join('participant_item_details AS pd','pd.participant_id=CP.participant_id');
		$this->db->join('special_order_master AS so','so.spo_id=pd.spo_id','LEFT');
		$this->db->where('IM.fest_id',$festcode);
		$this->db->where('pd.item_code = IM.item_code');
		$this->db->group_by('CP.participant_id');
		$this->db->group_by('IM.item_code');
		$this->db->order_by('CP.item_code');
		$this->db->order_by('CP.cluster_id');
		
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		}
	}
	
	
	function get_participant_card($schoolcode)
	{
		$this->db->from('school_details   AS sd');
		$this->db->select('sd.school_code,mj.school_name, pd.participant_id, pd.school_code, pd.participant_name,
pd.class, pd.gender, pid.item_code, pid.item_type, pid.is_captain, it.item_name, it.fest_id, sm.stage_id, date(sm.start_time) AS datee, ssm.stage_desc,ssm.stage_name, fm.fest_name,cpd.cluster_no');
		$this->db->join('school_master AS mj','mj.school_code = sd.school_code');
		$this->db->join('participant_details AS pd','pd.school_code = sd.school_code');
		$this->db->join('participant_item_details  AS pid ','pid.participant_id = pd.participant_id');
		$this->db->join('item_master AS it','it.item_code = pid.item_code');
		$this->db->join('festival_master AS fm','fm.fest_id = it.fest_id');
		$this->db->join('stage_item_master AS sm','sm.item_code = it.item_code');
		$this->db->join('stage_master AS ssm','ssm.stage_id = sm.stage_id');
		$this->db->join('cluster_participant_details AS cpd','cpd.item_code = pid.item_code'); 
		$this->db->where('sd.school_code',$schoolcode);
		$this->db->group_by('it.fest_id'); 
		$this->db->group_by('pid.item_code');
		$this->db->order_by('it.fest_id'); 
		$this->db->order_by('pd.participant_id');
		$this->db->order_by('pid.item_code');
	

		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	//===============participant card single register number
	
	function get_participant_details($school_code)
	{
		$this->db->where('PD.school_code',$school_code);
		$this->db->join('school_master AS SM','SM.school_code = PD.school_code');
		$this->db->join('sub_district_master AS SDM','SDM.sub_district_code = SM.sub_district_code');
		$this->db->select('PD.*,SM.school_name,SDM.sub_district_name');
		$participant		=	$this->db->get('participant_details AS PD');
		return $participant->result_array();
		
	
	}
	function get_participant_details_sub_dist($sub_district_code)
	{
		$this->db->where('PD.sub_district_code',$sub_district_code);
		$this->db->join('school_master AS SM','SM.school_code = PD.school_code');
		$this->db->join('sub_district_master AS SDM','PD.sub_district_code = SDM.sub_district_code');
		$this->db->select('PD.*,SM.school_name,SDM.sub_district_name');
		$participant		=	$this->db->get('participant_details AS PD');
		return $participant->result_array();
		
	
	}
	
	
	function get_participant_item_details($participant_id)
	{
		$this->db->where('PD.participant_id',$participant_id);
		$this->db->join('item_master AS IM','IM.item_code = PD.item_code');
		$this->db->join('stage_item_master AS SM','IM.item_code = SM.item_code','LEFT');
		$this->db->join('cluster_participant_details AS CP','CP.item_code = IM.item_code AND CP.participant_id = PD.participant_id','LEFT');
		$this->db->join('stage_master AS ST','ST.stage_id = SM.stage_id','LEFT');
		$this->db->select('PD.*,IM.item_name,ST.stage_name,ST.stage_desc,CP.cluster_no,SM.start_time');
		$participant		=	$this->db->get('participant_item_details AS PD');
		return $participant->result_array();
		
	
	}
	
	
	function get_participant_regno($regno)
	{
	$this->db->from('school_details   AS sd');
		$this->db->select('sd.school_code,mj.school_name, pd.participant_id, pd.school_code, pd.participant_name,
pd.class, pd.gender, pid.item_code, pid.item_type, pid.is_captain, it.item_name, it.fest_id, sm.stage_id,sm.start_time as timer,date(sm.start_time) AS datee, ssm.stage_desc,ssm.stage_name, fm.fest_name,cpd.cluster_no, pd.sub_district_code,SDM.sub_district_name');
		$this->db->join('school_master AS mj','mj.school_code = sd.school_code');
		$this->db->join('participant_details AS pd','pd.school_code = sd.school_code');
		$this->db->join('participant_item_details  AS pid ','pid.participant_id = pd.participant_id');
		$this->db->join('item_master AS it','it.item_code = pid.item_code');
		$this->db->join('festival_master AS fm','fm.fest_id = it.fest_id');
		$this->db->join('stage_item_master AS sm','sm.item_code = it.item_code');
		$this->db->join('stage_master AS ssm','ssm.stage_id = sm.stage_id');
		$this->db->join('cluster_participant_details AS cpd','cpd.item_code = pid.item_code'); 
		$this->db->join('sub_district_master AS SDM','pd.sub_district_code = SDM.sub_district_code');
		$this->db->where('pd.participant_id',$regno);
		$this->db->group_by('pid.item_code');
		$this->db->order_by('it.fest_id'); 
		$this->db->order_by('pd.participant_id');
		$this->db->order_by('pid.item_code');
	

		$school_details		=	$this->db->get();
		return $school_details->result_array();
	
	
	
	}
	
	//================list of student participat more than one item
	
		function participant_details()
		{
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
	function item_names()
	{
		$sql="SELECT pid.item_code,im.item_name,fm.fest_id,pid.participant_id,sm.school_code,sm.school_name from participant_item_details as pid
		      join school_master as sm on pid.school_code=sm.school_code
			  join item_master as im on pid.item_code=im.item_code
			  join festival_master as fm on im.fest_id=fm.fest_id";
				$item_names		=$this->db->query($sql);
                   return   $item_names->result_array();
		
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
		function find_subdistrict()
		{
		$user_id		=	$this->session->userdata('USERID');
		$subdist		=	$this->session->userdata('SUB_DISTRICT');
		$usrtype        =   $this->session->userdata('USER_TYPE');
		$this->db->select('sub_district_code,rev_district_code');
		$this->db->where('user_id',$user_id);
		$rev_details		=	$this->db->get('user_master');
		$rev			=	$rev_details->row();
		if($rev->sub_district_code!=0)
		{
		
		$this->db->select('sdm.sub_dist_kalolsavam_name as sub_dist, sdm.venue');
		$this->db->from('sub_dist_kalolsavam_master  AS sdm');
		$this->db->where('sdm.sub_district_code',$subdist);
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		}
		else if($rev->rev_district_code!=0){
		$this->db->select('sdm.dist_kalolsavam_name as sub_dist,sdm.venue');
			$this->db->from('dist_kalolsavam_master  AS sdm');
			$this->db->where('sdm.rev_district_code',$rev->rev_district_code);
			$school_details		=	$this->db->get();
			return $school_details->result_array();
		}
		else{
		$retdata[0]['sub_dist']="State School Kalolsavam ";
		$retdata[0]['venu']="";
		return $retdata;
		}
		}
	function list_eligible_schools()
	{
		$user_id		=	$this->session->userdata('USERID');
		$subdist		=	$this->session->userdata('SUB_DISTRICT');
		$usrtype        =   $this->session->userdata('USER_TYPE');
		
		$this->db->select('sm.school_code, sm.school_name, sm.sub_district_code, sdm.sub_district_name');
		$this->db->from('school_master AS sm');
		$this->db->from('sub_district_master  AS sdm');
		//$this->db->where('sdm.sub_district_code',$subdist);
		$this->db->where('sm.sub_district_code = sdm.sub_district_code');
		$this->db->order_by('sm.school_code');
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
		$this->db->select('cm.stage_id, cm.item_code, cm.cluster_id, cm.cluster_no, cpd.participant_id, cpd.cluster_no, fm.fest_name, im.item_name, sm.stage_name, sm.stage_desc, (cm.start_time) AS stime,im.max_time,time( cm.start_time ) AS ttime');
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
	
	function cluster_report_all($festid)
	{
		$this->db->where('im.fest_id',$festid);
		$this->db->select('min(cm.start_time) as cm_start_time, cm.stage_id, cm.item_code, cm.cluster_id, cm.cluster_no, cpd.participant_id, cpd.cluster_no as clustno, fm.fest_name,fm.fest_id, im.item_name, sm.stage_name, sm.stage_desc, (cm.start_time) AS stime,im.max_time,time( cm.start_time ) AS ttime');
		$this->db->from('cluster_master AS cm');
		$this->db->join('cluster_participant_details AS cpd','cm.item_code = cpd.item_code');
		$this->db->join('item_master  AS  im','im.item_code = cpd.item_code');
		$this->db->join('festival_master  AS fm','fm.fest_id = im.fest_id');
		$this->db->join('stage_master AS sm','sm.stage_id = cm.stage_id');
		$this->db->group_by('cpd.participant_id');
		$this->db->group_by('cm.item_code');
		$this->db->order_by('cm.stage_id');
		$this->db->order_by('cm_start_time');
		$this->db->order_by('cm.item_code');
		$this->db->order_by('cpd.cluster_no');
		$fest_details		=	$this->db->get();
		return $fest_details->result_array();
	}
	function clash_info1($festival,$date)
	{
	if($festival=='all')
	{
	   $que="SELECT PD.participant_id, PD.participant_name, PD.school_code, PID.parent_admn_no, PID.item_code, CPD.cluster_id, 	 SM.school_name, IM.item_name, C.cnt, CM.start_time, CM.end_time,(CM.start_time) AS stime, date_format(CM.start_time,'%h %i %p') AS stimer,date_format(CM.end_time,'%h %i %p') AS etimer,FM.fest_name,FM.fest_id
FROM (

SELECT count( PID.participant_id ) AS cnt, participant_id
FROM participant_item_details AS PID
GROUP BY `PID`.`participant_id` 
HAVING cnt > '1'
) AS C, participant_item_details AS PID
LEFT JOIN participant_details AS PD ON PD.participant_id = PID.participant_id
LEFT JOIN cluster_participant_details AS CPD ON PD.participant_id = CPD.participant_id and PID. item_code=CPD.item_code  
LEFT JOIN school_master AS SM ON SM.school_code = PD.school_code
LEFT JOIN item_master AS IM ON IM.item_code = PID.item_code
LEFT JOIN cluster_master AS CM ON CM. cluster_id = CPD. cluster_id and CM. item_code = PID. item_code
LEFT JOIN festival_master AS FM ON FM.fest_id = IM.fest_id
WHERE C.participant_id = PD.participant_id and CM.start_time!='' and CM.end_time!='' and date(CM.start_time)='$date'  
ORDER BY FM.fest_id,PD.participant_name,CM.start_time,CM.end_time";

$clash_detail		=$this->db->query($que);

		
		return   $clash_detail->result_array();
		}
		else
		{
		$query="SELECT PD.participant_id, PD.participant_name, PD.school_code, PID.parent_admn_no, PID.item_code, CPD.cluster_id, 	 SM.school_name, IM.item_name, C.cnt, CM.start_time, CM.end_time,date(CM.start_time) AS stime, date_format(CM.start_time,'%h %i %p') AS stimer,date_format(CM.end_time,'%h %i %p') AS etimer,FM.fest_name,FM.fest_id
FROM (

SELECT count( PID.participant_id ) AS cnt, participant_id
FROM participant_item_details AS PID
GROUP BY `PID`.`participant_id` 
HAVING cnt > '1'
) AS C, participant_item_details AS PID
LEFT JOIN participant_details AS PD ON PD.participant_id = PID.participant_id
LEFT JOIN cluster_participant_details AS CPD ON PD.participant_id = CPD.participant_id and PID. item_code=CPD.item_code  
LEFT JOIN school_master AS SM ON SM.school_code = PD.school_code
LEFT JOIN item_master AS IM ON IM.item_code = PID.item_code
LEFT JOIN cluster_master AS CM ON CM. cluster_id = CPD. cluster_id and CM. item_code = PID. item_code
LEFT JOIN festival_master AS FM ON FM.fest_id = IM.fest_id
WHERE C.participant_id = PD.participant_id and CM.start_time!='' and CM.end_time!='' and IM.fest_id=$festival and date(CM.start_time)='$date'
ORDER BY  PD.participant_name,CM.start_time,CM.end_time";

$clash_detail		=$this->db->query($query);

		
		return   $clash_detail->result_array();
		
		}
		
	}
	
	
	function item_list()
	{
		         $this->db->from('item_master AS m');
				  $this->db->from('festival_master AS f');
				 $this->db->where('m.fest_id = f.fest_id');
				  //$this->db->where('m.fest_id = 1');
				 
		         $this->db->order_by('m.item_code');		   		 
		         $item_details= $this->db->get();
		
		        return $item_details->result_array();
	}
	
		function  fetch_item_name($item_id)
		{            
	     $query="SELECT item_name FROM item_master WHERE item_master.`item_code`=$item_id";	  
	     $item_name=$this->db->query($query);	
	      return $item_name->result_array();         
	  }
	
		function  fetch_fest_name($fest_id)//vipin
		{            
		 $this->db->where('IM.fest_id',$fest_id);
		 $this->db->from('item_master AS IM');
		 $this->db->join('festival_master   AS FM','FM.fest_id= IM.fest_id');
		 $fest_data=$this->db->get();
		 return  $fest_data->result_array();
		 }
		
function tabulation_details($itemcode)
	{
	    
		//echo $itemcode;
		$query="SELECT IM.item_code, IM.item_name,date(SM.start_time) as timer FROM (`item_master` AS IM) LEFT JOIN participant_item_details AS PD ON IM.item_code =PD.item_code LEFT JOIN stage_item_master  AS SM ON IM.item_code =SM.item_code GROUP BY IM.item_code HAVING IM.item_code =$itemcode";
 
		$tabulation_detail		=$this->db->query($query);
		return   $tabulation_detail->result_array();
	}
	function tabulation_fest_details($festival)
	{
	$this->db->from('festival_master AS FM');
		$this->db->where('FM.fest_id',$festival);
$fest_detail		=	$this->db->get();
		return $fest_detail->result_array();
	}
	function tabulation_info($festival,$date)
	{
	//$this->db->from('`item_master` AS IM');
	
	//$this->db->join('festival_master   AS FM','FM.fest_id= IM.fest_id');
		//$this->db->where('IM.`fest_id`',$festival);
		if($date!='All')
		{
	$que="SELECT IM.item_name,IM.item_code, FM.fest_name,date(SM.start_time) as timer, count( PID.participant_id ) as cnt FROM (`item_master` AS IM)
    JOIN festival_master AS FM ON FM.`fest_id` = IM.`fest_id`
    LEFT JOIN participant_item_details AS PID ON PID.`item_code` = IM.`item_code` and PID.is_captain='Y'
	LEFT JOIN stage_item_master  AS SM ON IM.item_code =SM.item_code
    WHERE FM.`fest_id` =$festival and date(SM.start_time)='$date'
    GROUP BY (IM.item_code)";
   $fest_detail1		=	$this->db->query($que);
		return $fest_detail1->result_array();
		}
		else
		{
		$que="SELECT IM.item_name,IM.item_code, FM.fest_name,date(SM.start_time) as timer, count( PID.participant_id ) as cnt FROM (`item_master` AS IM)
    JOIN festival_master AS FM ON FM.`fest_id` = IM.`fest_id`
    LEFT JOIN participant_item_details AS PID ON PID.`item_code` = IM.`item_code` and PID.is_captain='Y'
	LEFT JOIN stage_item_master  AS SM ON IM.item_code =SM.item_code
    WHERE FM.`fest_id` =$festival 
    GROUP BY (IM.item_code)";
   $fest_detail1		=	$this->db->query($que);
		return $fest_detail1->result_array();
		
		}
	}

	
	function Festname($festval)
	{
	    $this->db->from('festival_master AS FM');
		$this->db->where('FM.fest_id',$festval);
		
		$festname		=	$this->db->get();
		return $festname->result_array();
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
	//=====================================================date wise 
	
	function lpstudents_date($date)
	{
	$this->db->select('count(distinct p.participant_id ) AS cntlp, p.school_code, p.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('participant_item_details AS pd','pd.participant_id = p.participant_id');
	$this->db->join('stage_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('p.class BETWEEN 1 AND 4');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function upstudents_date($date)
	{
	$this->db->select('count(distinct p.participant_id ) AS upid, p.school_code, p.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('participant_item_details AS pd','pd.participant_id = p.participant_id');
	$this->db->join('stage_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('p.class BETWEEN 5 AND 7');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function hsstudents_date($date)
	{
	$this->db->select('count(distinct p.participant_id ) AS hsid, p.school_code, p.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('participant_item_details AS pd','pd.participant_id = p.participant_id');
	$this->db->join('stage_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('p.class BETWEEN 8 AND 10');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function hssstudents_date($date)
	{
	$this->db->select('count(distinct p.participant_id ) AS hssid, p.school_code, p.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('participant_item_details AS pd','pd.participant_id = p.participant_id');
	$this->db->join('stage_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('p.class BETWEEN 11 AND 12');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	
	
	
	//========================================
	function school_lpdetails()
	{
	$this->db->select('d.school_code,m.school_name,sm.sub_district_code,sm.sub_district_name');
	$this->db->from('school_details AS d');
	$this->db->join('school_master AS m','m.school_code=d.school_code');
	$this->db->join('sub_district_master AS sm','sm.sub_district_code=m.sub_district_code');
	$this->db->order_by('sm.sub_district_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function lpstudents()
	{
	$this->db->select('count(distinct p.participant_id ) AS cntlp, p.school_code, p.gender, s.school_name');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('school_details AS d','d.school_code=p.school_code','RIGHT');
	$this->db->where('p.class BETWEEN 1 AND 4');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function upstudents()
	{
	$this->db->select('count(distinct p.participant_id ) AS upid, p.school_code, p.gender, s.school_name');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 5 AND 7');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function hsstudents()
	{
	$this->db->select('count(distinct p.participant_id ) AS hsid, p.school_code, p.gender, s.school_name');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 8 AND 10');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function hssstudents()
	{
	$this->db->select('count(distinct p.participant_id ) AS hssid, p.school_code, p.gender, s.school_name');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 11 AND 12');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	
	
	
	///Sub District
	
	function sub_dist_lpdetails()
	{
	$this->db->select('sub_district_code,sub_district_name');
	$this->db->where('rev_district_code',$this->session->userdata('DISTRICT'));
	$this->db->order_by('sub_district_code');
	$participants_details		=	$this->db->get('sub_district_master');
	return $participants_details->result_array();
	}
	function subupstudents_date($date)
	{
	$this->db->select('count(distinct p.participant_id ) AS upid, s.sub_district_code, p.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('participant_item_details AS pd','pd.participant_id = p.participant_id');
	$this->db->join('stage_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('p.class BETWEEN 5 AND 7');
	$this->db->group_by('p.gender');
	$this->db->group_by('s.sub_district_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function subhsstudents_date($date)
	{
	$this->db->select('count(distinct p.participant_id ) AS hsid, s.sub_district_code, p.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('participant_item_details AS pd','pd.participant_id = p.participant_id');
	$this->db->join('stage_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('p.class BETWEEN 8 AND 10');
	$this->db->group_by('p.gender');
	$this->db->group_by('s.sub_district_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function subhssstudents_date($date)
	{
	$this->db->select('count(distinct p.participant_id ) AS hssid, s.sub_district_code, p.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('participant_item_details AS pd','pd.participant_id = p.participant_id');
	$this->db->join('stage_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('p.class BETWEEN 11 AND 12');
	$this->db->group_by('p.gender');
	$this->db->group_by('s.sub_district_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	
	function subupstudents()
	{
	$this->db->select('count(distinct p.participant_id ) AS upid, s.sub_district_code, p.gender, s.school_name');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 5 AND 7');
	$this->db->group_by('p.gender');
	$this->db->group_by('s.sub_district_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function subhsstudents()
	{
	$this->db->select('count(distinct p.participant_id ) AS hsid, s.sub_district_code, p.gender, s.school_name');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 8 AND 10');
	$this->db->group_by('p.gender');
	$this->db->group_by('s.sub_district_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function subhssstudents()
	{
	$this->db->select('count(distinct p.participant_id ) AS hssid, s.sub_district_code, p.gender, s.school_name');
	$this->db->from('participant_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 11 AND 12');
	$this->db->group_by('p.gender');
	$this->db->group_by('s.sub_district_code');
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
	
	/*function datewise_stagereport($date)
	{
		$this->db->from('stage_item_master  AS SIM');
		$this->db->join('item_master  AS IM ','SIM.item_code = IM.item_code');
		$this->db->join('festival_master AS FM ','FM.fest_id = IM.fest_id');
		$this->db->where("DATE_FORMAT(SIM.start_time,'%Y-%m-%d')",$date);
		$participants_details		=	$this->db->get();
		return $participants_details->result_array();
	}*/
	
	function datewise_stagealtreport($date,$stage)
	{
	/*	$this->db->select('SIM1.stage_id, date_format(SIM.start_time, "%h %i %p") as stime,SIM.start_time, SIM.item_code, SIM.no_of_participant, IM.item_name, IM.item_type, IM.is_off_stage, IM.max_time, F.fest_id, F.fest_name');
		$this->db->from('stage_item_master AS SIM');
		$this->db->join('item_master AS IM','SIM.item_code = IM.item_code');
		$this->db->join('festival_master AS F ','F.fest_id = IM.fest_id');
		$this->db->where("DATE_FORMAT( SIM.start_time, '%Y-%m-%d' )=",$date);
		$this->db->where('SIM.stage_id',$stage);
		$stage		=	$this->db->get();
		return $stage->result_array();*/
		$sql="SELECT `SIM`.`stage_id` , date_format( SIM.start_time, ' %h %i %p ' ) AS stime, `SIM`.`start_time` , `SIM`.`item_code` , `SIM`.`no_of_participant` , `IM`.`item_name` , `IM`.`item_type` , `IM`.`is_off_stage` , `IM`.`max_time` , `F`.`fest_id` , `F`.`fest_name`
		FROM (
		`stage_item_master` AS SIM
		)
		JOIN `item_master` AS IM ON `SIM`.`item_code` = `IM`.`item_code`
		JOIN `festival_master` AS F ON `F`.`fest_id` = `IM`.`fest_id`
		WHERE DATE_FORMAT( SIM.start_time, '%Y-%m-%d' ) = '$date'
		AND `SIM`.`stage_id` ='$stage'";
		 $stage_detail1		=	$this->db->query($sql);
		return $stage_detail1->result_array();
		}
	
	//find stage name
	function Stagename($stageid)
	{
	    $this->db->from('stage_master AS SM');
		$this->db->where('SM.stage_id',$stageid);
		
		$stagedetails		=	$this->db->get();
		return $stagedetails->result_array();
	}
	
	function timesheet($itemcode)
	{
		$this->db->from('item_master AS IT');
		$this->db->where('IT.item_code ',$itemcode);
		$this->db->join('stage_item_master AS ST','ST.item_code = IT.item_code','LEFT');
		$this->db->join('stage_master AS SM','SM.stage_id = ST.stage_id','LEFT');
		$this->db->select('IT.*,SM.stage_name,date(ST.start_time) as ttime');
		$item_details		=	$this->db->get();
		return $item_details->result_array();
	}

		 function  fetch_item_name2($item_id)
		{
		
			$que="SELECT *
			FROM `item_master` AS IM
			JOIN festival_master AS FM ON IM.`fest_id` = FM.`fest_id`
			LEFT JOIN stage_item_master AS SM ON IM.`item_code` = SM.`item_code`
			LEFT JOIN stage_master AS ST ON ST.`stage_id` = SM.`stage_id`
			WHERE IM.`item_code` =$item_id";
			
			$fest_data=$this->db->query($que);
			return  $fest_data->result_array();
		
		
		
		
		
		/*
		
		
		  $this->db->select('f.fest_id, f.fest_name, m.item_code, m.item_name, sm.start_time, sm.no_of_participant');
		  $this->db->where('m.item_code',$item_id);
		  $this->db->from('festival_master AS f');
		  $this->db->from('item_master AS m');
		  $this->db->join('stage_item_master  AS sm','sm.item_code = m.item_code','LEFT');
		  $this->db->group_by('m.item_code');
		 $fest_data=$this->db->get();
		 return  $fest_data->result_array();
		*/
		
		/* 
		 $this->db->where('IM.item_code',$item_id);
		 $this->db->from('item_master AS IM');
		 $this->db->join('festival_master   AS FM','FM.fest_id= IM.fest_id');
		 $this->db->join('stage_item_master   AS SM','SM.item_code= IM.item_code');
		 $fest_data=$this->db->get();
		 return  $fest_data->result_array();
	 */
	 
	  }
	
	  function  fetch_fest_scoresheet($fest_id,$date)
		{ 
		if($date!='All')
		{           
		  $this->db->select('f.fest_id, f.fest_name, m.item_code, m.item_name,sm.start_time, sm.no_of_participant,st.stage_name,st.stage_desc');
		  $this->db->where('f.fest_id',$fest_id);
		  $this->db->where('m.fest_id = f.fest_id');
		  $this->db->from('festival_master AS f');
		  $this->db->from('item_master AS m');
		  $this->db->join('stage_item_master  AS sm','sm.item_code = m.item_code','LEFT');
		   $this->db->join('stage_master  AS st','st.stage_id = sm.stage_id','LEFT');
		   $this->db->where('date(sm.start_time)',$date); 
		  $this->db->group_by('m.item_code');
		 $fest_data=$this->db->get();
		 return  $fest_data->result_array();
		 }
		 else
		 {
		 $this->db->select('f.fest_id, f.fest_name, m.item_code, m.item_name, sm.start_time, sm.no_of_participant,st.stage_name,st.stage_desc');
		  $this->db->where('f.fest_id',$fest_id); 
		  $this->db->where('m.fest_id = f.fest_id');
		  $this->db->from('festival_master AS f');
		  $this->db->from('item_master AS m');
		  $this->db->join('stage_item_master  AS sm','sm.item_code = m.item_code','LEFT');
		   $this->db->join('stage_master  AS st','st.stage_id = sm.stage_id','LEFT');
		  $this->db->group_by('m.item_code');
		 $fest_data=$this->db->get();
		 return  $fest_data->result_array();
		 }
		}
		function stagereport_all()
		{
		
		$this->db->select('s.stage_id, s.item_code, date(s.start_time) AS ddt,s.no_of_cluster,s.no_of_participant, im.item_name, f.fest_id, f.fest_name,sm.stage_name, sm.stage_desc,im.is_off_stage,im.item_type,im.max_time,im.time_type,s.no_of_participant');
		$this->db->from('stage_item_master AS s');
		$this->db->join('stage_master AS sm',' s.stage_id = sm.stage_id');
		$this->db->join('item_master AS im','im.item_code = s.item_code');
		$this->db->join('festival_master AS f','f.fest_id = im.fest_id');
		$this->db->group_by('s.item_code');
		$this->db->order_by('ddt');
		//$this->db->order_by('f.fest_id');
		$this->db->order_by('s.stage_id');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		function stageallot_duration($festid)
		{
		$this->db->select('count( pd.participant_id ) AS pdcount, pd.item_code, im.item_name, im.fest_id, im.item_type, im.max_time, im.time_type, im.is_off_stage, f.fest_name,date(sm.start_time) as ddttime');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('item_master AS im','im.item_code = pd.item_code');
		$this->db->join('festival_master AS f','f.fest_id = im.fest_id');
		$this->db->join('stage_item_master AS sm','sm.item_code=im.item_code','LEFT');
		$this->db->where('im.fest_id',$festid);
		$this->db->where('pd.is_captain','Y');
		$this->db->group_by('pd.item_code');
		$this->db->order_by('pd.item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		function stageallot_duration_all()
		{
		$this->db->select('count( pd.participant_id ) AS pdcount, pd.item_code, im.item_name, im.fest_id, im.item_type, im.max_time, im.time_type, im.is_off_stage, f.fest_name,date(sm.start_time) as ddttime');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('item_master AS im','im.item_code = pd.item_code');
		$this->db->join('festival_master AS f','f.fest_id = im.fest_id');
		$this->db->join('stage_item_master AS sm','sm.item_code=im.item_code','LEFT');
		$this->db->where('pd.is_captain','Y');
		$this->db->group_by('pd.item_code');
		$this->db->order_by('f.fest_id');
		$this->db->order_by('pd.item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		
		
		
		function groupallotduration()
		{
		$this->db->select('count( `participant_id` ) AS cpid, item_code, item_type');
		$this->db->from('participant_item_details');
		$this->db->where('item_type','G');
		$this->db->where('is_captain','Y');
		$this->db->group_by('item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		function appealed_part($festcode)
		{
		$this->db->select('pd.participant_id,sh.school_name,sh.school_code, pd.spo_id, so.spo_title, so.is_publish,  pd.item_code, im.item_name, pm.participant_name, pm.school_code, pm.class, pm.gender,fm.fest_name, fm.fest_id,date(sm.start_time) as sdt');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('special_order_master AS so','so.spo_id = pd.spo_id');
		$this->db->join('item_master AS im','im.item_code = pd.item_code');
		$this->db->join('participant_details AS pm','pm.participant_id = pd.participant_id');
		$this->db->join('school_master AS sh','pm.school_code = sh.school_code');
		$this->db->join('festival_master AS fm','fm.fest_id = im.fest_id');
		$this->db->join('stage_item_master AS sm','sm.item_code=pd.item_code','LEFT');
		$this->db->where('pd.spo_id !=0');
		$this->db->where('fm.fest_id',$festcode);
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		function appeal_courtorder($festcode)
		{
		$this->db->select('pd.participant_id, pd.spo_id, so.spo_title, so.is_publish, 	           pd.item_code, im.item_name, pm.participant_name, pm.school_code, pm.class, pm.gender,           fm.fest_name, fm.fest_id,date(sm.start_time) as sdt');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('special_order_master AS so','so.spo_id = pd.spo_id');
		$this->db->join('item_master AS im','im.item_code = pd.item_code');
		$this->db->join('participant_details AS pm','pm.participant_id = pd.participant_id');
		$this->db->join('festival_master AS fm','fm.fest_id = im.fest_id');
		$this->db->join('stage_item_master AS sm','sm.item_code=pd.item_code','LEFT');
		$this->db->where('pd.spo_id !=0');
		$this->db->where('fm.fest_id',$festcode);
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		function alldate_stagereport($stage)
		{
		/*$this->db->select('s1.stage_id, s.item_code,s.start_time as sdt,date(s.start_time)as ddt,date_format( SIM.start_time, "%h %i %p " ) AS stime, s.no_of_participant, t.item_name,t.time_type, m.stage_name, m.stage_desc,f.fest_name,t.item_type,t.max_time,t.is_off_stage');
		$this->db->from('stage_item_master AS s');
		$this->db->join('stage_master AS m',' m.stage_id = s.stage_id');
		$this->db->join('item_master AS t','t.item_code = s.item_code');
		$this->db->join('festival_master AS f','f.fest_id = t.fest_id');
		$this->db->where('s.stage_id',$stage);
		$this->db->group_by('s.item_code');
		$this->db->order_by('s.stage_id, f.fest_id, s.item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();*/
		$sql="SELECT `s`.`stage_id` , `s`.`item_code` , `s`.`start_time` AS sdt, date( s.start_time ) AS ddt, date_format( s.start_time, '%h %i %p ' ) AS stime, `s`.`no_of_participant` , `t`.`item_name` , `t`.`time_type` , `m`.`stage_name` , `m`.`stage_desc` , `f`.`fest_name` , `t`.`item_type` , `t`.`max_time` , `t`.`is_off_stage`
		FROM (
		`stage_item_master` AS s
		)
		JOIN `stage_master` AS m ON `m`.`stage_id` = `s`.`stage_id`
		JOIN `item_master` AS t ON `t`.`item_code` = `s`.`item_code`
		JOIN `festival_master` AS f ON `f`.`fest_id` = `t`.`fest_id`
		WHERE `s`.`stage_id` = '1'
		GROUP BY `s`.`item_code`
		ORDER BY `s`.`stage_id` , `f`.`fest_id` , `s`.`item_code`";
		$stage_data=$this->db->query($sql);
		return  $stage_data->result_array();
		}
		function itemwise_allfestival($festid)
		{
		$this->db->select('p.participant_name, p.class, p.school_code, p.gender, p.participant_id, pd.item_code, pd.item_type, pd.is_captain, m.school_name,m.school_code,sdm.sub_district_code,sdm.sub_district_name,I.item_name, f.fest_name');
		$this->db->from('participant_details AS p');
		$this->db->join('participant_item_details AS pd',"pd.participant_id = p.participant_id AND pd.school_code = p.school_code and pd.is_captain='Y'");
		$this->db->join('school_master AS m','m.school_code = p.school_code');
		$this->db->join('sub_district_master AS sdm','m.sub_district_code = sdm.sub_district_code');
		$this->db->join('item_master AS I','I.item_code = pd.item_code');
		$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
		$this->db->where('f.fest_id',$festid);
		$this->db->group_by('p.participant_id');
		$this->db->group_by('pd.item_code');
		$this->db->order_by('pd.item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		
		function stageallot_abstract()
		{
		  $this->db->select('count( sm.item_code ) AS itcode,ms.stage_name, sm.stage_id, date( start_time ) AS dt, im.fest_id');
		  $this->db->from('stage_item_master AS sm');
		  $this->db->join('item_master AS im','im.item_code = sm.item_code');
		  $this->db->join('festival_master as f','f.fest_id=im.fest_id');
		  $this->db->join('stage_master as ms','ms.stage_id=sm.stage_id');
		  $this->db->group_by('im.fest_id');
		  $this->db->group_by('date(start_time)');
		   $this->db->group_by('sm.stage_id');
		 
		   $this->db->order_by('sm.stage_id');
		    $this->db->order_by('date(start_time)');
		  $this->db->order_by('im.fest_id');
		  $retdata=$this->db->get();
			return $retdata->result_array();
		}
		function timesheet_date($festival,$date)
	{
	  if ($date!='All')
	  {
		$que="SELECT *,SM.start_time,
		(select count(*) from participant_item_details AS PID where PID.item_code = IM.item_code and is_captain = 'Y' ) as item_count,
		IM.item_name, IM.item_code, date(SM.start_time) as item_date
		FROM `item_master` AS IM
		JOIN festival_master AS FM ON IM.`fest_id` = FM.`fest_id`
		JOIN stage_item_master AS SM ON IM.`item_code` = SM.`item_code`
		JOIN stage_master AS ST ON ST.`stage_id` = SM.`stage_id`
		WHERE date(SM.start_time) ='$date' and FM.fest_id='$festival'";
		
		$fest_data=$this->db->query($que);
		return  $fest_data->result_array();
	}
	else
	{
	   $que="SELECT *,SM.start_time,
		(select count(*) from participant_item_details AS PID where PID.item_code = IM.item_code and is_captain = 'Y' ) as item_count,
		IM.item_name, IM.item_code, date(SM.start_time) as item_date
		FROM `item_master` AS IM
		JOIN festival_master AS FM ON IM.`fest_id` = FM.`fest_id`
		JOIN stage_item_master AS SM ON IM.`item_code` = SM.`item_code`
		JOIN stage_master AS ST ON ST.`stage_id` = SM.`stage_id`
		WHERE FM.fest_id='$festival'";
		
		$fest_data=$this->db->query($que);
		return  $fest_data->result_array();
	}
 }
 function list_subdistricts()
 {
     $q="select SM.sub_district_code,S.sub_district_name,PD.school_code from participant_item_details AS PD
	 Join school_master AS SM ON PD.school_code=SM.school_code
	 Join sub_district_master AS S ON SM.sub_district_code=S.sub_district_code
	 order by SM.sub_district_code";
	 $list=$this->db->query($q);
	 return  $list->result_array();
 }
 function list_all_school_details()
		{
						$q="SELECT DISTINCT PID.school_code, SD. * , SM.school_name
			FROM participant_item_details AS PID
			JOIN school_master AS SM ON SM.school_code = PID.school_code
			JOIN school_details AS SD ON SM.school_code = SD.school_code
			ORDER BY SM.school_code";
			 $list=$this->db->query($q);
			 return  $list->result_array();
		}
  function higherlevel_result($festid,$item)
	{
		
					   
			$this->db->select('pid.item_code, pid.participant_id, pid.school_code, m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, i.item_name');
			$this->db->from('participant_item_details AS pid');
			$this->db->join('school_master AS m','m.school_code = pid.school_code');
			$this->db->join('participant_details AS p',"p.participant_id = pid.participant_id AND p.class >4");
			$this->db->join('item_master AS i','i.item_code = pid.item_code');
			$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
			$this->db->where("pid.is_captain","Y");
			if($festid!='All')
			$this->db->where("f.fest_id",$festid);
			if($item!='ALL')
			$this->db->where("pid.item_code",$item);
			
		//	$this->db->where("  ");
			$this->db->group_by('pid.item_code');
			$this->db->group_by('pid.participant_id');
			$this->db->order_by('f.fest_id');
			$this->db->order_by('pid.item_code');
			
				$details	=	$this->db->get();
				return  $details->result_array();
	}
	function higherlevel_result_subdistrict($sub_dist)
	{
		
					   
			$this->db->select('pid.item_code, pid.participant_id, pid.school_code,  m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, i.item_name,sdm.sub_district_name,sdm.sub_district_code');
			$this->db->from('participant_item_details AS pid');
			$this->db->join('school_master AS m','m.school_code = pid.school_code');
			$this->db->join('sub_district_master AS sdm','sdm.sub_district_code = m.sub_district_code');
			$this->db->join('participant_details AS p',"p.participant_id = pid.participant_id AND class >4");
			$this->db->join('item_master AS i','i.item_code = pid.item_code');
			$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
			$this->db->where("sdm.sub_district_code = $sub_dist");
			$this->db->where("pid.is_captain","Y");
			$this->db->group_by('pid.item_code');
			$this->db->group_by('pid.participant_id');
			$this->db->order_by('f.fest_id');
			$this->db->order_by('i.item_code');
			
				$details	=	$this->db->get();
				return  $details->result_array();
	}
	
	
	function schoolhigher_result($school)
	{
			$this->db->select('pid.item_code, pid.participant_id, pid.school_code, m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, i.item_name');
			$this->db->from('participant_item_details AS pid');
			$this->db->join('school_master AS m','m.school_code = pid.school_code');
			$this->db->join('participant_details AS p',"p.participant_id = pid.participant_id AND class > 4");
			$this->db->join('item_master AS i','i.item_code = pid.item_code');
			$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
			//$this->db->where("R.is_taken ='Y' and R.is_finish = 'Y'");
			$this->db->where("pid.school_code",$school);
			$this->db->where("pid.is_captain","Y");
			$this->db->order_by('i.fest_id');
			$this->db->order_by('pid.item_code');
			
				$details	=	$this->db->get();
				return  $details->result_array();
	}
	
	function schoolhigher_resultall()
	{
			$this->db->select('pid.item_code, pid.participant_id, pid.school_code,  m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, i.item_name');
			$this->db->from('participant_item_details AS pid');
			$this->db->join('school_master AS m','m.school_code = pid.school_code');
			$this->db->join('participant_details AS p',"p.participant_id = pid.participant_id AND class > 4");
			$this->db->join('item_master AS i','i.item_code = pid.item_code');
			$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
			$this->db->where("pid.is_captain","Y");
			$this->db->order_by('i.fest_id');
			$this->db->order_by('pid.item_code');
			
			$details	=	$this->db->get();
			return  $details->result_array();
		
	}
	function consolidated_resultall()
	{
		$sql="SELECT count( DISTINCT pid.participant_id ) AS cnt , pid.school_code, f.fest_id, f.fest_name,s.school_name,sdm.sub_district_code,sdm.sub_district_name
				FROM participant_item_details AS pid
				JOIN participant_details AS pd ON pd.participant_id = pid.participant_id
				JOIN school_master AS s ON s.school_code = pid.school_code
				JOIN sub_district_master AS sdm ON sdm.sub_district_code = s.sub_district_code
				JOIN item_master AS i ON pid.item_code = i.item_code
				JOIN festival_master AS f ON i.fest_id = f.fest_id
				where pd.class > 4 AND pid.is_captain='Y' 
				GROUP BY pid.school_code, f.fest_id
				ORDER BY pid.school_code, f.fest_id";
				$consolidated		=$this->db->query($sql);
                   return   $consolidated->result_array();
		
	}
	function consolidated_total()
	{
		$sql="SELECT count( DISTINCT pid.participant_id ) AS counter_total
				FROM participant_item_details AS pid
				JOIN participant_details AS pd ON pd.participant_id = pid.participant_id
				where pd.class > 4 AND pid.is_captain='Y'";
				$consolidated		=$this->db->query($sql);
                   return   $consolidated->result_array();
		
	}
	function consolidated_result_boys()
	{
		$sql="SELECT count( DISTINCT pid.participant_id ) AS cnt_boys , pid.school_code, f.fest_id, f.fest_name,s.school_name,sdm.sub_district_code,sdm.sub_district_name
				FROM participant_item_details AS pid
				 left JOIN participant_details AS pd ON pd.participant_id =pid.participant_id
				 left JOIN school_master AS s ON s.school_code = pid.school_code
				JOIN sub_district_master AS sdm ON sdm.sub_district_code = s.sub_district_code
				 left JOIN item_master AS i ON pid.item_code = i.item_code
				JOIN festival_master AS f ON i.fest_id = f.fest_id
				where pd.class > 4 AND pd.gender='B' AND pid.is_captain='Y'
				GROUP BY pid.school_code, f.fest_id
				ORDER BY pid.school_code, f.fest_id";
				$consolidated		=$this->db->query($sql);
                   return   $consolidated->result_array();
		
	}
	function consolidated_result_girls()
	{
		$sql="SELECT count( DISTINCT pid.participant_id ) AS cnt_girls , pid.school_code, f.fest_id, f.fest_name,s.school_name,sdm.sub_district_code,sdm.sub_district_name
				FROM participant_item_details AS pid
				 left JOIN participant_details AS pd ON pd.participant_id = pid.participant_id
				 left JOIN school_master AS s ON s.school_code = pid.school_code
				JOIN sub_district_master AS sdm ON sdm.sub_district_code = s.sub_district_code
				 left JOIN item_master AS i ON pid.item_code = i.item_code
				JOIN festival_master AS f ON i.fest_id = f.fest_id
				where pd.class > 4 AND pd.gender='G' AND pid.is_captain='Y'
				GROUP BY pid.school_code, f.fest_id
				ORDER BY pid.school_code, f.fest_id";
				$consolidated		=$this->db->query($sql);
                   return   $consolidated->result_array();
		
	}
	function consolidated_boys_total()
	{
		$sql="SELECT count( DISTINCT pid.participant_id ) AS counter_boys_total
				FROM participant_item_details AS pid
				JOIN participant_details AS pd ON pd.participant_id =pid.participant_id
				where pd.class > 4 AND pd.gender='B' AND pid.is_captain='Y'";
				$consolidated		=$this->db->query($sql);
                   return   $consolidated->result_array();
		
	}
	function consolidated_girls_total()
	{
		$sql="SELECT count( DISTINCT pid.participant_id) AS counter_girls_total
				FROM participant_item_details AS pid
				JOIN participant_details AS pd ON pd.participant_id = pid.participant_id
				where pd.class > 4 AND pd.gender='G' AND pid.is_captain='Y'";
				$consolidated		=$this->db->query($sql);
                   return   $consolidated->result_array();
		
	}
 }

?>