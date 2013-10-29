<?php
class Resultindex_Model extends Model{
	function Resultindex_Model()
	{
		parent::Model();
	}
	function result_rank($festid)
	{
			$this->db->select(' R.item_code, R.participant_id, R.school_code, R.code_no, R.total_mark, R.grade, R.point, R.rank, M.school_name, P.participant_name, P.class, I.item_name, F.fest_name,pd.spo_id, sp.is_publish');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('participant_details AS P','P.participant_id = R.participant_id');
			$this->db->join('item_master AS I',"I.item_code = R.item_code AND I.fest_id ='$festid'");
			$this->db->join('festival_master AS F'," F.fest_id = I.fest_id AND F.fest_id='$festid'");
			
			$this->db->join('participant_item_details AS pd','pd.participant_id = R.participant_id AND pd.item_code = R.item_code');
			$this->db->join('special_order_master AS sp',"pd.spo_id = sp.spo_id AND sp.is_publish = 'N'",'LEFT');
			
			$this->db->where("R.grade != ''");
			$this->db->where("(sp.is_publish IS NULL OR sp.is_publish != 'Y')");
			$this->db->where("R.is_finish",'Y');
			$this->db->order_by('R.item_code');
			$this->db->order_by('R.total_mark DESC');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
		}
	function schoolpoints($festid)
	{
			$this->db->select('s.school_code, sum( point ) AS spoint, m.school_name,f.fest_name,f.fest_id');
			$this->db->from('school_point_details AS s');
			$this->db->join('school_master AS m','s.school_code = m.school_code');
			$this->db->join('item_master AS I','I.item_code = s.item_code');
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id and f.fest_id='$festid'");
			$this->db->where('I.fest_id',$festid);
			$this->db->group_by('s.school_code');
			$this->db->group_by('s.school_code');
			$this->db->order_by('spoint desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	function allresults()
	{
			$this->db->select('R.item_code , R.participant_id , R.school_code , R.code_no , R.total_mark , R.grade , R.point , R.rank , M.school_name , P.participant_name , P.class , I.item_name , F.fest_name , F.fest_id,pd.spo_id, sp.is_publish');
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
			$this->db->select('count( DISTINCT p.item_code ) AS pcode, f.fest_name, f.fest_id');
			$this->db->from('result_publish AS p');
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
	//	$this->db->order_by('R.total_mark desc');
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
function rankwise_report($festid,$item,$rank,$date)
	{
		$this->db->select('R.item_code, R.participant_id, R.school_code, R.rank, R.point, R.grade, pd.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name, R.percentage, p.spo_id, sp.is_publish,date(sim.start_time),sdm.sub_district_code,sdm.sub_district_name');
		$this->db->from('result_master AS R');
		$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
		$this->db->join('participant_details AS pd','pd.participant_id = R.participant_id');
		$this->db->join('item_master AS I','I.item_code = R.item_code');
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		$this->db->join('sub_district_master AS sdm','sdm.sub_district_code = s.sub_district_code');
		$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
		$this->db->join('stage_item_master AS sim','R.item_code = sim.item_code');
		$this->db->join('special_order_master AS sp',"sp.spo_id = p.spo_id AND sp.is_publish = 'N'",'LEFT');
		
		if($rank=='ALL'){
		$this->db->where("R.rank IN(1,2,3)");
		}
		else{
		$this->db->where('R.rank',$rank);
		}
		if($festid!='ALL'){
		$this->db->where('f.fest_id',$festid);
		
		}
		if($item!='ALL'){
		
		$this->db->where('R.item_code',$item);
		}
		if($date!='All'){
		$this->db->where('date(sim.start_time)',$date);
		
		}
		$this->db->where("R.is_finish = 'Y'");
		$this->db->where('f.fest_id',$festid);
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		$this->db->order_by('f.fest_id');
		$this->db->order_by('R.item_code');
		$this->db->order_by('R.total_mark desc');
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
	
	function gradewiseparticip_report($festid,$item,$grade)
	{
		$this->db->select('R.item_code,R.is_taken, R.participant_id, R.school_code, R.rank, R.point, R.grade, pd.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name, R.percentage, p.spo_id,sp.is_publish,sdm.sub_district_code,sdm.sub_district_name');
		$this->db->from('result_master AS R');
		$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
		$this->db->join('participant_details AS pd','pd.participant_id = R.participant_id');
		$this->db->join('item_master AS I','I.item_code = R.item_code');
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		$this->db->join('sub_district_master AS sdm','sdm.sub_district_code = s.sub_district_code');
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
		if($item!='ALL'){
		
		$this->db->where('R.item_code',$item);
		}
		$this->db->where("R.is_finish = 'Y'");
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		$this->db->order_by('f.fest_id');
		$this->db->order_by('R.item_code');
		$this->db->order_by("R.total_mark desc");
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
		$this->db->select('s.stage_id,date(s.start_time) as ddt,sm.stage_name,f.fest_name, s.item_code, s.start_time, s.no_of_cluster, s.no_of_participant, s.item_time, s.time_type, r.item_code as leftitem, i.item_name,i.item_type,i.max_time,i.time_type');
		$this->db->from('stage_item_master AS s');
		$this->db->join('item_master AS i','i.item_code = s.item_code');
		$this->db->join('stage_master AS sm','sm.stage_id=s.stage_id');
		$this->db->join('festival_master AS f','f.fest_id=i.fest_id');
		$this->db->join('result_publish AS r','r.item_code = s.item_code','LEFT');
		$this->db->where('f.fest_id',$festid);
		$this->db->group_by('s.item_code');
		$this->db->order_by('s.item_code');
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
	function allfestschoolpoints()
	{
			$this->db->select('s.school_code, sum( point ) AS spoint, m.school_name,f.fest_name,f.fest_id');
			$this->db->from('school_point_details AS s');
			$this->db->join('school_master AS m','s.school_code = m.school_code');
			$this->db->join('item_master AS I','I.item_code = s.item_code');
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id");
			$this->db->group_by('s.school_code');
			$this->db->group_by('f.fest_id');
			$this->db->order_by('f.fest_id');
			$this->db->order_by('spoint desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	function itemcode_report($item)
	{
		$this->db->select('R.item_code, R.participant_id, R.school_code, R.rank, R.point, R.grade, pd.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name, R.percentage, p.spo_id, sp.is_publish,date(sim.start_time),sdm.sub_district_code,sdm.sub_district_name,rdm.rev_district_code,rdm.rev_district_name');
		$this->db->from('result_master AS R');
		$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
		$this->db->join('participant_details AS pd','pd.participant_id = R.participant_id');
		$this->db->join('item_master AS I','I.item_code = R.item_code');
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		$this->db->join('sub_district_master AS sdm','s.sub_district_code = sdm.sub_district_code');
		$this->db->join('rev_district_master AS rdm','s.rev_district_code = rdm.rev_district_code');
		$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
		$this->db->join('stage_item_master AS sim','R.item_code = sim.item_code');
		$this->db->join('special_order_master AS sp',"sp.spo_id = p.spo_id AND sp.is_publish = 'N' or sp.is_publish IS NULL",'LEFT');
		$this->db->where('R.item_code',$item);
		$this->db->where("R.is_finish = 'Y'");
		//$this->db->where("sp.is_publish = 'Y'");
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		$this->db->order_by('f.fest_id');
		$this->db->order_by('R.item_code');
		$this->db->order_by('R.total_mark desc');
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
	
	function timewise_result_report()
	{
		$parti_count				  =		0;
		$from_date 				      =		$this->input->post('txtfromDate');
		$to_date 				      =		$this->input->post('txttoDate');
		$from_time 				      =		$this->input->post('txtfromTime');
		$to_time 				      =		$this->input->post('txttoTime');
		$from_ampm 				      =		$this->input->post('txtfromampm');
		$to_ampm 				      =		$this->input->post('txttoampm');
		//echo "<br /><br />fromD---->".$from_date;
		//echo "<br /><br />toD---->".$to_date;
		/*echo "<br /><br />fromt---->".$from_time;
		echo "<br /><br />tot---->".$to_time;
		echo "<br /><br />froma---->".$from_ampm;
		echo "<br /><br />toa---->".$to_ampm;*/
		$details['from_date']			  =		$from_date ;
		$details['to_date']			  	  =		$to_date ;
		$details['from_time']			  =		$from_time ;
		$details['to_time']			  	  =		$to_time ;
		$details['from_ampm']			  =		$from_ampm ;
		$details['to_ampm']			  	  =		$to_ampm ;
	    $from_time 	= ($from_time != 12 && $from_ampm == 'PM' ) ? $from_time+12 :$from_time;
		$to_time 	= ($to_time != 12 && $to_ampm == 'PM' ) ? $to_time+12 :$to_time;
		
		$from_time 	= ($from_time < 10) ? '0'.$from_time :$from_time;
		$to_time 	= ($to_time < 10) ? '0'.$to_time :$to_time;
		
		$from_time 	= ($from_time == 12 && $from_ampm == 'AM') ? 00 :$from_time;
		$to_time 	= ($to_time == 12 && $to_ampm == 'AM') ? 00 :$to_time;
				
		//echo "<br /><br />New_fromtime---->".$from_time;
		//echo "<br /><br />New_totime---->".$to_time;		
		if($from_time == $to_time)
		{		
			//$new_time	=	$from_time - 1;
			//$to_time 	= 	$new_time.':59:59';
		}
		
		
		$query="SELECT RT.item_code, RT.confirm_date, RT.confirm_time, RT.result_no, IM.item_name, FM.fest_name,FM.fest_id from result_time AS RT  JOIN result_master AS RM ON  RT.`item_code`=RM.`item_code` JOIN item_master AS IM ON RT.item_code=IM.item_code JOIN festival_master AS FM ON IM.fest_id=FM.fest_id   where   RT.confirm_date >= '". $from_date."' and  RT.confirm_date <= '". $to_date."' and RT.confirm_time >= '". $from_time.":00:00' and  RT.is_finalized='Y' group by RT.item_code order by RT.result_no,RT.item_code asc";
		$details1				=	$this->db->query($query);	
		$details['values']		= 	$details1->result_array();	
		
		if(is_object($details1)) 
		{
    		if($details1->num_rows() > 0) 
			{
				$ArrReturn['item'] = $details1->result_array();
				foreach($ArrReturn['item'] as $row)
				{
					$item_code		=	$row['item_code'];
					$parti_query="SELECT SPD.participant_id,RM.percentage,RM.grade,SPD.point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld from  result_master AS RM
		               JOIN school_point_details AS SPD ON RM.participant_id =            SPD.participant_id and RM.item_code=SPD.item_code
					   JOIN participant_details AS PD ON PD.participant_id=SPD.participant_id and PD.school_code=SPD.school_code 
					   JOIN item_master AS IM ON IM.item_code=SPD.item_code						
					   JOIN school_master AS SM ON SM.school_code=RM.school_code
					   JOIN festival_master AS FM ON IM.fest_id=FM.fest_id 
					   where RM.item_code='".$item_code."' and SPD.is_withheld='N' AND RM.is_finish='Y' AND RM.grade!='' order by FM.fest_id asc,SPD.item_code asc,RM.rank asc,RM.point desc";
					$parti_det				=	$this->db->query($parti_query);	
					$details['parti_det'][$item_code]	= 	$parti_det->result_array();	
					$parti_count	+= count($parti_det->result_array());	
					$confirm_date	=	$row['confirm_date'];
					$confirm_time	=	$row['confirm_time'];
					$query1="SELECT RT.item_code,RT.confirm_date,RT.confirm_time,RT.result_no from  result_time AS RT	where  RT.confirm_date ='". $to_date."' and RT.confirm_time >'". $to_time.":00:00' and  RT.is_finalized='Y'";
					$disc_code				=	$this->db->query($query1);	
					$details['disc_code']	= 	$disc_code->result_array();		
					//echo "<br /><br /><br />item_code-->".$item_code;
					//echo "<br />date-->".$confirm_date;
					//echo "<br />time-->".$confirm_time;
				}
				
			}
		}
		
		 $details['parti_count']		=		$parti_count;	
		 return  $details;
	
	}
	
	
	function numwise_timeresult_report()
	{
	
		$result_nums 				      =		$this->input->post('txtResultno');
		//echo "<br /><br />--------->".$result_nums;		
		$result_nums	=	explode(',',$result_nums);
		$len			=	count($result_nums);
		for($i=0;$i<$len;$i++)
		{
			$result_no	=	$result_nums[$i];		
			$query="SELECT SPD.item_code,RT.result_no,IM.item_name,SPD.participant_id,RM.percentage,RM.grade,SPD.point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld,FM.fest_name,FM.fest_id from  result_master AS RM
		                  JOIN school_point_details AS SPD ON RM.participant_id=SPD.participant_id and RM.item_code=SPD.item_code
						  JOIN participant_details AS PD ON PD.participant_id=SPD.participant_id and PD.school_code=SPD.school_code 
					      JOIN item_master AS IM ON IM.item_code=SPD.item_code						
						  JOIN school_master AS SM ON SM.school_code=RM.school_code
						  JOIN festival_master AS FM ON IM.fest_id=FM.fest_id
						  JOIN result_time AS RT ON RM.`item_code` = RT.`item_code`
						where SPD.is_withheld='N' AND RM.is_finish='Y' AND RM.grade!='' and RT.result_no ='$result_no' group by SPD.participant_id,SPD.item_code  order by FM.fest_id asc,IM.item_code,RM.total_mark desc ";
			$details			=	$this->db->query($query);
			$det_report[$i]		=	$details->result_array();		
		}
		
		 return  $det_report;
	
	
	}
	
	
}

?>