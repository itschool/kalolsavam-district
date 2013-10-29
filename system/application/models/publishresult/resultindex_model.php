<?php
class Resultindex_Model extends Model{
	function Resultindex_Model()
	{
		parent::Model();
	}
	function result_rank($festid)
	{
			$this->db->select(' R.item_code, R.participant_id, R.school_code, R.code_no, R.total_mark, R.grade, R.point, R.rank, M.school_name, P.participant_name, P.class, I.item_name, F.fest_name,pd.spo_id, sp.is_publish,P.admn_no');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('participant_details AS P','P.participant_id = R.participant_id');
			$this->db->join('item_master AS I',"I.item_code = R.item_code AND I.fest_id ='$festid'");
			$this->db->join('festival_master AS F'," F.fest_id = I.fest_id AND F.fest_id='$festid'");
			
			$this->db->join('participant_item_details AS pd','pd.participant_id = R.participant_id AND pd.item_code = R.item_code');
			$this->db->join('special_order_master AS sp',"pd.spo_id = sp.spo_id AND sp.is_publish = 'N'",'LEFT');
			
			$this->db->where("(sp.is_publish IS NULL OR sp.is_publish != 'Y')");
			$this->db->where("R.is_finish",'Y');
			
			$this->db->where("R.grade != ''");
			$this->db->order_by('R.item_code');
			$this->db->order_by('R.total_mark DESC');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
		}
	function schoolpoints($festid)
	{
			$this->db->select('s.school_code, sum( point ) AS spoint, m.school_name,f.fest_name,f.fest_id,sdm.sub_district_code,sdm.sub_district_name');
			$this->db->from('school_point_details AS s');
			$this->db->join('school_master AS m','s.school_code = m.school_code');
			$this->db->join('sub_district_master AS sdm','m.sub_district_code = sdm.sub_district_code');
			$this->db->join('item_master AS I','I.item_code = s.item_code');
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id and f.fest_id='$festid'");
			$this->db->where('I.fest_id',$festid);
			$this->db->group_by('s.school_code');
			$this->db->group_by('s.school_code');
			$this->db->order_by('spoint desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	function subdistpoints($festid)
	{
			$this->db->select('s.sub_district_code, sum( point ) AS spoint, m.sub_district_name,f.fest_name,f.fest_id');
			$this->db->from('sub_dist_point_details AS s');
			$this->db->join('sub_district_master AS m','s.sub_district_code = m.sub_district_code');
			$this->db->join('item_master AS I','I.item_code = s.item_code');
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id and f.fest_id='$festid'");
			$this->db->where('I.fest_id',$festid);
			$this->db->group_by('s.sub_district_code');
			$this->db->order_by('spoint desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	function allresults()
	{
			$this->db->select('R.item_code , R.participant_id , R.school_code , R.code_no , R.total_mark , R.grade , R.point , R.rank , M.school_name , P.participant_name , P.class , I.item_name , F.fest_name , F.fest_id,pd.spo_id, sp.is_publish,P.admn_no');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('participant_details AS P','P.participant_id = R.participant_id');
			$this->db->join('item_master AS I',"I.item_code = R.item_code");
			$this->db->join('festival_master AS F'," F.fest_id = I.fest_id");
			$this->db->join('participant_item_details AS pd','pd.participant_id = R.participant_id AND pd.item_code = R.item_code');
			$this->db->join('special_order_master AS sp',"pd.spo_id = sp.spo_id AND sp.is_publish = 'N'",'LEFT');
			$this->db->where("R.grade IN ('A','B','C')");
			$this->db->where("(sp.is_publish IS NULL OR sp.is_publish != 'Y')");
			$this->db->where("R.is_finish",'Y');
			$this->db->order_by('F.fest_id');
			$this->db->order_by('R.item_code');
			$this->db->order_by('R.total_mark  desc');
			$this->db->order_by('R.grade');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	function festval_status1()
	{
			$this->db->select('count( s.item_code ) AS cnt, f.fest_name, f.fest_id');
			$this->db->from('stage_item_master AS s');
			$this->db->join('item_master AS m','s.item_code = m.item_code');
			$this->db->join('festival_master AS f','f.fest_id = m.fest_id');
			$this->db->group_by('f.fest_id');
			$this->db->order_by('f.fest_id');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	function festival_status2()
	{
			$this->db->where('is_finish','Y');
			$this->db->select('count( DISTINCT P.item_code ) AS pcode, f.fest_name, f.fest_id');
			$this->db->from('result_master AS P');
			$this->db->join('item_master AS m','P.item_code = m.item_code');
			$this->db->join('festival_master AS f','f.fest_id = m.fest_id');
			$this->db->group_by('f.fest_id');
			$this->db->order_by('f.fest_id');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	function gradewise_report($schoolcode)
	{
		$this->db->select('R.item_code, R.participant_id, R.school_code, R.rank, R.point, R.grade, R.total_mark , pd.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name,p.spo_id, sp.is_publish');
		$this->db->from('result_master AS R');
		$this->db->join('participant_details AS pd','pd.participant_id = R.participant_id');
		$this->db->join('item_master AS I','I.item_code = R.item_code');
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
		$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
		$this->db->join('special_order_master AS sp',"p.spo_id = sp.spo_id AND sp.is_publish = 'N'",'LEFT');
		if($schoolcode!=""){
		$this->db->where('R.school_code',$schoolcode);
		}
		$this->db->where("R.grade IN('A','B','C')");
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		$this->db->order_by('R.school_code');
		$this->db->order_by('f.fest_id');
		$this->db->order_by('R.total_mark desc');
		$this->db->order_by('R.item_code');
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
	function itemwise_report($festid,$itemid)
	{
		$this->db->select('R.item_code, R.participant_id, R.school_code, R.rank, R.point, R.grade, pd.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name, R.percentage, p.spo_id, sp.is_publish');
		$this->db->from('result_master AS R');
		$this->db->join('participant_details AS pd','pd.participant_id = R.participant_id');
		$this->db->join('item_master AS I','I.item_code = R.item_code');
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
		$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
		$this->db->join('special_order_master AS sp',"p.spo_id = sp.spo_id AND sp.is_publish = 'N'",'LEFT');
		$this->db->where('R.item_code',$itemid);
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		$this->db->order_by('f.fest_id');
		$this->db->order_by('R.percentage desc');
		$this->db->order_by('R.grade');
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
	
	function rankwise_report($festid,$rank)
	{
		$this->db->select('R.item_code, R.participant_id, R.school_code, R.rank, R.point, R.grade, pd.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name, R.percentage, p.spo_id, sp.is_publish');
		$this->db->from('result_master AS R');
		$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
		$this->db->join('participant_details AS pd','pd.participant_id = R.participant_id');
		$this->db->join('item_master AS I','I.item_code = R.item_code');
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
		$this->db->join('special_order_master AS sp',"sp.spo_id = p.spo_id AND sp.is_publish = 'N'",'LEFT');
		if($rank=='ALL'){
		$this->db->where("R.rank IN(1,2,3)");
		}
		else{
		$this->db->where('R.rank',$rank);
		}
		$this->db->where('f.fest_id',$festid);
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		$this->db->order_by('R.item_code');
		$this->db->order_by('R.rank');
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
	
	function gradewiseparticip_report($festid,$grade)
	{
		$this->db->select('R.item_code, R.participant_id, R.school_code, R.rank, R.point, R.grade, pd.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name, R.percentage, p.spo_id, sp.is_publish');
		$this->db->from('result_master AS R');
		$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
		$this->db->join('participant_details AS pd','pd.participant_id = R.participant_id');
		$this->db->join('item_master AS I','I.item_code = R.item_code');
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
		$this->db->join('special_order_master AS sp',"sp.spo_id = p.spo_id AND sp.is_publish = 'N'",'LEFT');
		if($grade=='ALL'){
		$this->db->where("R.grade IN('A','B','C')");
		}
		else{
		$this->db->where('R.grade',$grade);
		}
		if($festid!='ALL'){
		$this->db->where('f.fest_id',$festid);
		}
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		$this->db->order_by('f.fest_id');
		$this->db->order_by('R.item_code');
		$this->db->order_by("R.rank desc");
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
	

	function festval_allitems($festid)
	{
		$this->db->select('m.item_code,date(m.start_time) as ddt, sm.stage_name, m.no_of_cluster, m.no_of_participant, t.item_name, t.gender, t.item_type, t.max_time, t.time_type, f.fest_id, f.fest_name');
		$this->db->from('stage_item_master AS m');
		$this->db->join('item_master AS t',"t.item_code = m.item_code AND t.fest_id = '$festid'");
		$this->db->join('stage_master AS sm','sm.stage_id=m.stage_id');
		$this->db->join('festival_master AS f','f.fest_id = t.fest_id');
		$this->db->group_by('m.item_code');
		$this->db->order_by('m.item_code');
		$details	=	$this->db->get();
		return  $details->result_array();
	}
	function finished_allitems($festid)
	{
			$this->db->select('t.item_code, m.item_name');
			$this->db->from('result_master AS t');
			$this->db->join('item_master AS m','m.item_code = t.item_code');
			$this->db->where('m.fest_id',$festid);
			$this->db->group_by('t.item_code');
			$this->db->order_by('t.item_code');
			
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	function incomplete_allitems($festid)
	{
		$query1="SELECT IM.item_name,IM.item_code, FM.fest_name,date(sm.start_time) as ddt,sm.item_time,s.stage_name,IM.item_code as leftitem,FM.fest_id,IM.item_type,IM.time_type,sm.no_of_cluster,sm.no_of_participant,IM.max_time
							FROM item_master AS IM
							JOIN stage_item_master AS sm ON sm.item_code = IM.item_code
						    JOIN stage_master AS s ON sm.stage_id = s.stage_id
							JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
							WHERE IM.fest_id =$festid
							AND IM.item_code NOT
							IN (
							SELECT distinct(RP.item_code)
							FROM result_master AS RP
							LEFT JOIN item_master AS IM ON IM.item_code = RP.item_code
							LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
							WHERE IM.fest_id =$festid)order by IM.item_code";
							
				   $school_wise_result		=$this->db->query($query1);
                   return   $school_wise_result->result_array();
	}
	function allfestschoolpoints()
	{
			/*$this->db->select('s.school_code, sum( point ) AS spoint, m.school_name,f.fest_name,f.fest_id');
			$this->db->from('school_point_details AS s');
			$this->db->join('school_master AS m','s.school_code = m.school_code');
			$this->db->join('item_master AS I','I.item_code = s.item_code');
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id");
			$this->db->group_by('s.school_code');
			$this->db->group_by('f.fest_id');
			$this->db->order_by('f.fest_id');
			$this->db->order_by('spoint desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();*/
			
			$this->db->select('s.school_code, sum( s.point ) AS spoint, m.school_name');
			$this->db->from('school_point_details AS s');
			$this->db->join('school_master AS m','s.school_code = m.school_code');
			/*$this->db->join('item_master AS I','I.item_code = s.item_code');
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id");*/
			$this->db->group_by('s.school_code');
			/*$this->db->group_by('f.fest_id');
			$this->db->order_by('f.fest_id');*/
			$this->db->order_by('spoint desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	function allfestsubdistpoints()
	{
			
			$this->db->select('s.sub_district_code, sum( s.point ) AS spoint, m.sub_district_name');
			$this->db->from('sub_dist_point_details AS s');
			$this->db->join('sub_district_master AS m','s.sub_district_code = m.sub_district_code');
			/*$this->db->join('item_master AS I','I.item_code = s.item_code');
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id");*/
			$this->db->group_by('s.sub_district_code');
			/*$this->db->group_by('f.fest_id');
			$this->db->order_by('f.fest_id');*/
			$this->db->order_by('spoint desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
}

?>