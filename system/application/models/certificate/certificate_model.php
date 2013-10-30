<?php
class Certificate_Model extends Model{
	function Certificate_Model()
	{
		parent::Model();
	}
	function get_font_array()
	{
		$font_array			=	array('Arial'		=>	'Arial',
									  'courier'		=>	'Courier',
									  'helvetica'	=>	'Helvetica',
									  'times'		=>	'Times'
									   );
									   
									   
		/*$font_array			=	array('courier'=>'Courier', 'courierB'=>'Courier-Bold', 'courierI'=>'Courier-Oblique', 'courierBI'=>'Courier-BoldOblique',
		'helvetica'=>'Helvetica', 'helveticaB'=>'Helvetica-Bold', 'helveticaI'=>'Helvetica-Oblique', 'helveticaBI'=>'Helvetica-BoldOblique',
		'times'=>'Times-Roman', 'timesB'=>'Times-Bold', 'timesI'=>'Times-Italic', 'timesBI'=>'Times-BoldItalic',
		'symbol'=>'Symbol', 'zapfdingbats'=>'ZapfDingbats');*/							   
									   
		return $font_array;
	}
	function get_font_size_array()
	{
		$font_size_array		=	array('9'	=>	'9',
									  '10'		=>	'10',
									  '11'		=>	'11',
									  '12'		=>	'12',
									  '13'		=>	'13',
									  '14'		=>	'14',
									  '15'		=>	'15',
									  '16'		=>	'16',
									  '17'		=>	'17',
									  '18'		=>	'18',
									  '19'		=>	'19',
									  '20'		=>	'20',
									  '21'		=>	'21',
									  '22'		=>	'22',
									  '23'		=>	'23',
									  '24'		=>	'24',
									  '25'		=>	'25',
									  '26'		=>	'26',
									  '27'		=>	'27',
									  '28'		=>	'28'									  
									   );
		return $font_size_array;
	}
	function get_line_height_array()
	{
		$font_size_array		=	array('1'	=>	'1',
									  '2'		=>	'2',
									  '3'		=>	'3',
									  '4'		=>	'4',
									  '5'		=>	'5',
									  '6'		=>	'6',
									  '7'		=>	'7',
									  '8'		=>	'8',
									  '9'		=>	'9',
									  '10'		=>	'10',
									  '11'		=>	'11',
									  '12'		=>	'12',
									  '13'		=>	'13',
									  '14'		=>	'14',
									  '15'		=>	'15',
									  '16'		=>	'16',
									  '17'		=>	'17',
									  '18'		=>	'18',
									  '19'		=>	'19',
									  '20'		=>	'20',
									  '21'		=>	'21',
									  '22'		=>	'22',
									  '23'		=>	'23',
									  '24'		=>	'24',
									  '25'		=>	'25',
									  '26'		=>	'26',
									  '27'		=>	'27',
									  '28'		=>	'28',
									  '29'		=>	'29',
									  '30'		=>	'30'									  
									   );
		return $font_size_array;
	}
	function get_certificate_details($dist_code,$sub_dist_code)
	{
		$this->db->where('sub_district_code',$sub_dist_code);
		$this->db->where('district_code',$dist_code);
		
		$certificate_template		=	$this->db->get('certificate_template');
		return $certificate_template->result_array();
	}
	
	function save_certificate_details($dist_code,$sub_dist_code)
	{
		$data					=	array();
		
		$data['name_x']			=	(int)$this->input->post('txtNameX');
		$data['name_y']			=	(int)$this->input->post('txtNameY');
		$data['name_font']		=	$this->input->post('cboNameFont');
		$data['name_size']		=	(int)$this->input->post('cboNameSize');
		
		
		$data['item_x']			=	(int)$this->input->post('txtItemX');
		$data['item_y']			=	(int)$this->input->post('txtItemY');
		$data['item_font']		=	$this->input->post('cboItemFont');
		$data['item_size']		=	(int)$this->input->post('cboItemSize');
		
		$data['category_x']		=	(int)$this->input->post('txtCategoryX');
		$data['category_y']		=	(int)$this->input->post('txtCategoryY');
		$data['category_font']	=	$this->input->post('cboCategoryFont');
		$data['category_size']	=	(int)$this->input->post('cboCategorySize');
		
		
		$data['grade_x']		=	(int)$this->input->post('txtGradeX');
		$data['grade_y']		=	(int)$this->input->post('txtGradeY');
		$data['grade_font']		=	$this->input->post('cboGradeFont');
		$data['grade_size']		=	(int)$this->input->post('cboGradeSize');
		
		$data['class_x']		=	(int)$this->input->post('txtClassX');
		$data['class_y']		=	(int)$this->input->post('txtClassY');
		$data['class_font']		=	$this->input->post('cboClassFont');
		$data['class_size']		=	(int)$this->input->post('cboClassSize');
		
		
		$data['school_x']		=	(int)$this->input->post('txtSchoolX');
		$data['school_y']		=	(int)$this->input->post('txtSchoolY');
		$data['school_font']	=	$this->input->post('cboSchoolFont');
		$data['school_size']	=	(int)$this->input->post('cboSchoolSize');
		
		$data['sub_dist_x']		=	(int)@$this->input->post('txtSubdistrictX');
		$data['sub_dist_y']		=	(int)@$this->input->post('txtSubdistrictY');
		$data['sub_dist_font']	=	@$this->input->post('cboSubDistFont');
		$data['sub_dist_size']	=	(int)@$this->input->post('cboSubDistSize');
		
		$data['dist_x']			=	(int)@$this->input->post('txtDistrictX');
		$data['dist_y']			=	(int)@$this->input->post('txtDistrictY');
		$data['dist_font']		=	@$this->input->post('cboDistFont');
		$data['dist_size']		=	(int)@$this->input->post('cboDistSize');
		
		$data['date_x']			=	(int)@$this->input->post('txtDateX');
		$data['date_y']			=	(int)@$this->input->post('txtDateY');
		$data['date_font']		=	@$this->input->post('cboDateFont');
		$data['date_size']		=	(int)@$this->input->post('cboDateSize');
		
		$data['place_x']		=	(int)@$this->input->post('txtPlaceX');
		$data['place_y']		=	(int)@$this->input->post('txtPlaceY');
		$data['place_font']		=	@$this->input->post('cboPlaceFont');
		$data['place_size']		=	(int)@$this->input->post('cboPlaceSize');
		
		$data['ehs_x']		=	(int)@$this->input->post('txtehsX');
		$data['ehs_y']		=	(int)@$this->input->post('txtehsY');
		$data['ehs_font']		=	@$this->input->post('cboehsFont');
		$data['ehs_size']		=	(int)@$this->input->post('cboehsSize');
		
		$data['photoX']			=	(int)@$this->input->post('photoX');
		$data['photoY']			=	(int)@$this->input->post('photoY');
		$data['photoWidth']		=	@$this->input->post('photoWidth');
		$data['photoHight']		=	(int)@$this->input->post('photoHight');
						
		$data['page_style']		=	$this->input->post('cboPageStyle');
		$data['line_height']	=	$this->input->post('cboLineHeight');
		$data['top_margin']		=	$this->input->post('cboTopMargin');
		$data['left_margin']	=	$this->input->post('cboLeftMargin');
		$data['right_margin']	=	$this->input->post('cboRightMargin');
		$data['type_id']		=	$this->input->post('cboCtType');
		$data['label_print']	=	$this->input->post('cboLabelPrint');
		$this->db->where('sub_district_code',$sub_dist_code);
		$this->db->where('district_code',$dist_code);
		
		$certificate_template		=	$this->db->get('certificate_template');
		if ($certificate_template->num_rows() > 0)
		{
			$this->db->where('sub_district_code',$sub_dist_code);
			$this->db->where('district_code',$dist_code);
			$this->db->update('certificate_template',$data);
		}
		else
		{
			$data['sub_district_code']	=	$sub_dist_code;
			$data['district_code']		=	$dist_code;
			$this->db->insert('certificate_template',$data);
		}
	}
	
	function get_item_certificate($festtype, $school_code ='')
	{
		// s.start_time,s.no_of_cluster,s.stage_id,sm.stage_name, sm.stage_desc,
		
		$this->db->select('count( p.participant_id ) AS cpt, p.item_code, i.item_type, 
			i.item_name, f.fest_name,rs.is_certificate_printed,
			(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.is_withheld="N" AND cm.item_code=p.item_code AND cm.admn_no=cm.parent_admn_no  AND cm.grade = "A" GROUP BY cm.grade) AS a_grade,
			(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.is_withheld="N" AND cm.item_code=p.item_code AND cm.admn_no=cm.parent_admn_no  AND cm.grade = "B" GROUP BY cm.grade) AS b_grade,
			(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.is_withheld="N" AND cm.item_code=p.item_code AND cm.admn_no=cm.parent_admn_no  AND cm.grade = "C" GROUP BY cm.grade) AS c_grade,
			 (SELECT count(rm.participant_id) FROM result_master rm WHERE rm.item_code=p.item_code) AS participated_no,
			 IF((SELECT count(rm1.item_code) FROM result_master rm1 
					WHERE rm1.item_code=p.item_code ) > 0 ,
					IF((	SELECT count(rm1.item_code) FROM result_master rm1 
							WHERE rm1.item_code=p.item_code AND rm1.is_finish ="N"
						) > 0, "No", "Yes"
					),
					"No"
			) AS is_confirmed', FALSE);
		$this->db->from('participant_item_details AS p');
		$this->db->join('result_master AS rs','rs.item_code = p.item_code');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		//$this->db->where('rs.is_certificate_printed',0);
		if ('' == $school_code) $this->db->where('i.fest_id',$festtype);
		$this->db->where('p.is_captain','Y');
		//$this->db->where('i.item_type','G');
		$this->db->group_by('p.item_code');
		$this->db->having("is_confirmed = 'Yes'");
		$this->db->order_by('p.item_code');		
		$getdet		=	$this->db->get();
		return $getdet->result_array();

	}
	
	function get_item_certificate_single($festtype)
	{
	//AND rm1.is_finish ="N"
	//s.start_time,s.no_of_cluster,s.stage_id,sm.stage_name, sm.stage_desc,
	
		$this->db->select('count( p.participant_id) AS cpt, p.item_code, i.item_type, i.item_name, 
		f.fest_name,
		(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.item_code=p.item_code AND cm.grade = "A" GROUP BY cm.grade) AS a_grade,
		(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.item_code=p.item_code AND cm.grade = "B" GROUP BY cm.grade) AS b_grade,
		(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.item_code=p.item_code AND cm.grade = "C" GROUP BY cm.grade) AS c_grade,
		(SELECT count(rm.participant_id) FROM result_master rm WHERE rm.item_code=p.item_code) AS participated_no,
		 IF((SELECT count(rm1.item_code) FROM result_master rm1 
				WHERE rm1.item_code=p.item_code ) > 0 ,
				IF((	SELECT count(rm1.item_code) FROM result_master rm1 
						WHERE rm1.item_code=p.item_code AND rm1.is_finish ="N"
					) > 0, "No", "Yes"
				),
				"No"
		) AS is_confirmed', FALSE);
		
		$this->db->from('certificate_master cm');			
		$this->db->join('participant_item_details AS p', 'cm.item_code=p.item_code AND  p.participant_id=cm.participant_id');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		$this->db->where('i.fest_id', $festtype);
		$this->db->where('i.item_type', 'S');
		//$this->db->where('is_confirmed', "Yes");
		/*$this->db->where('(SELECT count(rm1.item_code) FROM result_master rm1 WHERE rm1.item_code=p.item_code ) > 0', NULL, FALSE); 
		$this->db->where('(SELECT count(rm1.item_code) FROM result_master rm1 
											WHERE rm1.item_code=p.item_code AND rm1.is_finish ="Y") > 0', NULL, FALSE); */
		$this->db->group_by('p.item_code');
		$this->db->having("is_confirmed = 'Yes'");
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();
		
	}
	
	function get_captains_details ($item_code, $school_code ='')
	{
		/**
		**  CM PRINT
		*/
		$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		
		$this->db->select('cm.participant_id, cm.rank, pd.participant_name, pd.admn_no, pd.school_code');
		$this->db->from('certificate_master cm');
		$this->db->join('participant_details AS pd', 'pd.participant_id=cm.participant_id');
		$this->db->join('participant_item_details AS p', 'cm.item_code=p.item_code AND  p.participant_id=cm.participant_id');
		$this->db->where('cm.item_code', $item_code);
		$this->db->where('cm.is_withheld', 'N');
		$this->db->where('p.is_captain', 'Y');
		
		
		if (!empty($school_code)) $this->db->where('cm.school_code', $school_code);
		$this->db->order_by('cm.participant_id', 'ASC');
		$captains		= $this->db->get();
		$captains		= $captains->result_array();
		if(isset($captains) && count($captains) > 0)
		{
			$captains_array[0] = 'All Participant';
			foreach ($captains as $key=>$captains)
			{
				$captains_array[$captains['participant_id']] = $captains['participant_id'].' - '.$captains['participant_name'];
			}
			return $captains_array;
		}
		return FALSE;
	}
	
	function get_participant_details ($item_code, $captain_id, $item_type, $participant_id ='')
	{
		/**
		**  CM PRINT
		*/
		
		$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		
		$this->db->select('cm.item_code, cm.rank, cm.participant_id, pd.participant_name, sm.school_code, sm.school_name, sd.sub_district_name,
							i.item_name, f.fest_name, pd.class, pd.gender,pd.admn_no, cm.grade, cm.is_withheld');
		$this->db->from('certificate_master cm');
		$this->db->join('participant_details AS pd', 'pd.participant_id=cm.participant_id');
		$this->db->join('school_master AS sm', 'sm.school_code=pd.school_code');
		$this->db->join('sub_district_master AS sd', 'sm.sub_district_code=sd.sub_district_code');
		if ('S' == $item_type) $this->db->join('participant_item_details AS p', 'cm.item_code=p.item_code AND p.participant_id=cm.participant_id');
		else if('G' == $item_type) $this->db->join('participant_item_details AS p', 'cm.item_code=p.item_code AND p.admn_no=cm.parent_admn_no');
		
		$this->db->join('item_master AS i', 'i.item_code = p.item_code');
		$this->db->join('festival_master AS f', 'i.fest_id = f.fest_id');
		$this->db->order_by('FIELD(rank, 1, 2, 3, 0)');
		$this->db->order_by('cm.grade', 'ASC');
		$this->db->order_by('sm.school_code', 'ASC');
		$this->db->where('cm.is_withheld', 'N');
		
		
		
		if ('' != $participant_id)
		{
			$this->db->where('p.participant_id', $captain_id);
			$this->db->where('cm.participant_id', $participant_id);
		}
		else
		{
			if ($captain_id != 'all')
			{ 
				if ('S' == $item_type) $this->db->where('cm.participant_id', $captain_id);
				else if('G' == $item_type)
					{
						$this->db->where('p.participant_id', $captain_id);
					}
				}
			}
			$this->db->where('cm.item_code', $item_code);			
			$participant_details		= $this->db->get();
			return $participant_details->result_array();
	}
	
	function is_group_item ($item_code)
	{
		$this->db->select('item_type,max_pinnani');
		$this->db->where('item_code', $item_code);
		$item_details	= $this->db->get('item_master');
		$item_details	= $item_details->result_array();
		if (is_array($item_details) && count($item_details))
		{
			if ($item_details[0]['max_pinnani'] > 0)
			{
				return 'G';
			}
			return $item_details[0]['item_type'];
		}
		return FALSE;
	}
	
	function get_group_participants($item_code, $captain_id, $school_code = '')
	{
		
		/**
		**  CM PRINT
		*/
		$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		
		$this->db->select('cm.participant_id, cm.rank, pd.participant_name, pd.admn_no, pd.school_code');
		$this->db->from('certificate_master cm');
		$this->db->join('participant_details AS pd', 'pd.participant_id=cm.participant_id');
		$this->db->where('cm.item_code', $item_code);
		if (!empty($captain_id) && 0 != $captain_id) 
			$this->db->where('cm.parent_admn_no =(SELECT parent_admn_no FROM certificate_master WHERE participant_id='.$captain_id.' AND item_code='.$item_code.' GROUP BY participant_id)', NULL, FALSE);
			
		$this->db->where('cm.is_withheld', 'N');
		if (!empty($school_code)) $this->db->where('cm.school_code', $school_code);
		//$this->db->order_by('cm.participant_id', 'ASC');
		$this->db->order_by('cm.school_code', 'ASC');
		$captains		= $this->db->get();
		$captains		= $captains->result_array();
		if(isset($captains) && count($captains) > 0)
		{
			$participant_select_box = '<select  class="input_box" name="participant_id" id="participant_id" ><option value="0">All Participant</option>';
			foreach ($captains as $key=>$captains)
			{
				$participant_select_box .= '<option value="'.$captains['participant_id'].'">'.$captains['participant_id'].' - '.$captains['participant_name'].'</option>';
			}
			$participant_select_box .= '</select>';
			return $participant_select_box;
		}
		return FALSE;
	}
	
	function school_details_certificate_wise ()
	{
		if ($this->session->userdata('SUB_DISTRICT'))
		{
			$this->db->where('sm.sub_district_code', $this->session->userdata('SUB_DISTRICT'));
		}
		$this->db->select('sm.school_name, sm.school_code, 
				(SELECT SUM(spd.point) FROM school_point_details spd WHERE spd.school_code=cm.school_code)  AS total_point, 
				(SELECT COUNT(rm.participant_id) FROM result_master rm WHERE rm.school_code=sm.school_code GROUP BY rm.school_code ) as no_participation, 
				
				(SELECT COUNT(cm1.grade) FROM certificate_master cm1 WHERE cm1.school_code=cm.school_code AND 
				is_withheld = "N" AND cm1.parent_admn_no=cm1.admn_no AND cm1.grade = "A" GROUP BY cm.item_code) AS a_grade,
				
				
				(SELECT COUNT(cm1.grade) FROM certificate_master cm1 WHERE cm1.school_code=cm.school_code AND is_withheld = "N"  AND cm1.parent_admn_no=cm1.admn_no AND cm1.grade = "B" GROUP BY cm.item_code) AS b_grade,
				(SELECT COUNT(cm1.grade) FROM certificate_master cm1 WHERE cm1.school_code=cm.school_code AND is_withheld = "N"  AND cm1.parent_admn_no=cm1.admn_no AND cm1.grade = "C" GROUP BY cm.item_code) AS c_grade', FALSE);
		$this->db->from('school_master AS sm');
		$this->db->join ('certificate_master AS cm', 'cm.school_code=sm.school_code');
	//	$this->db->join ('school_point_details AS spd', 'spd.school_code=cm.school_code');
		$this->db->join ('result_master AS rm', 'rm.school_code=cm.school_code');
		$this->db->order_by('sm.school_code', 'ASC');
		$this->db->group_by('cm.school_code');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function get_school_festival_details ($school_code)
	{
		/**
		**  CM PRINT
		*/
		$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		$this->db->select('fm.fest_id, fm.fest_name');
		$this->db->from('certificate_master cm');
		$this->db->join('item_master i', 'i.item_code=cm.item_code');
		$this->db->join('festival_master fm', 'fm.fest_id=i.fest_id');
		$this->db->group_by('fm.fest_id');
		$this->db->where('cm.is_withheld', 'N');
		$this->db->where('cm.school_code', $school_code);
		$fest_array	= $this->db->get();
		$fest_array	= $fest_array->result_array();
		if (is_array($fest_array) && count($fest_array) > 0)
		{
			$result_array[0]	= 	'All Festival';
			foreach ($fest_array as $fest_array)
			{
				$result_array[$fest_array['fest_id']]	= 	$fest_array['fest_name'];
			}
			
			return  $result_array;
		}
		return FALSE;
	}
	
	function get_school_item_details ($school_code, $fest_id)
	{
		/**
		**  CM PRINT
		*/
		$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		$this->db->select('i.item_code, i.item_name');
		$this->db->from('certificate_master cm');
		$this->db->join('item_master i', 'i.item_code=cm.item_code');
		if (0 != $fest_id) $this->db->where('i.fest_id', $fest_id);
		$this->db->group_by('i.item_code');
		$this->db->where('cm.is_withheld', 'N');
		$this->db->where('cm.school_code', $school_code);
		$item_array			= $this->db->get();
		$item_array			= $item_array->result_array();
		$item_select_box	= '';
		if (is_array($item_array) && count($item_array) > 0)
		{
			$item_select_box = '<select class="input_box" name="item_code" id="item_code" onChange="javascript:get_school_captains(this.value);" ><option value="0">All Items</option>';
			foreach ($item_array as $item_array)
			{
				$item_select_box .= '<option value="'.$item_array['item_code'].'">'.$item_array['item_code'].' - '.$item_array['item_name'].'</option>';
			}
			$item_select_box .= '</select>';
			return  $item_select_box;
		}
		return FALSE;
	}
	
	function get_school_participant_details ($school_code ='', $festival='', $item_code='', $captain_id='', $participant_id='')
	{
		/**
		**  CM PRINT
		*/
		$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		
		
		$this->db->select('cm.item_code, cm.rank, cm.participant_id, pd.participant_name, sm.school_code, sm.school_name, sd.sub_district_name,
							i.item_name, f.fest_name, pd.class, pd.gender, pd.admn_no, cm.grade, cm.is_withheld');
		$this->db->from('certificate_master cm');
		$this->db->join('item_master i', 'i.item_code=cm.item_code');
		$this->db->join('school_master sm', 'sm.school_code=cm.school_code');
		$this->db->join('sub_district_master AS sd', 'sm.sub_district_code=sd.sub_district_code');
		$this->db->join('participant_details AS pd', 'pd.participant_id=cm.participant_id');
		$this->db->join('festival_master f', 'f.fest_id=i.fest_id');
		if (!empty($school_code) && 0 != $school_code)
		{
			$this->db->where('sm.school_code', $school_code);
		}
		if (!empty($festival) && 0 != $festival)
		{
			$this->db->where('f.fest_id', $festival);
		}
		if (!empty($item_code) && 0 != $item_code)
		{
			$this->db->where('cm.item_code', $item_code);
		}
		if (!empty($captain_id) && 0 != $captain_id)
		{
			$this->db->where('cm.parent_admn_no = (SELECT parent_admn_no FROM certificate_master WHERE item_code='.$item_code.' AND participant_id='.$captain_id.')', NULL, FALSE);
		}
		if (!empty($participant_id) && 0 != $participant_id)
		{
			$this->db->where('cm.participant_id', $participant_id);
			$this->db->group_by('cm.participant_id');
		}
		
		$participant_details		= $this->db->get();
		return $participant_details->result_array();
	}
	
	function get_participant_details_with_id ($participant_id)
	{
		/**
		**  CM PRINT
		*/
		$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		$this->db->select('cm.participant_id, cm.rank, pd.participant_name, pd.admn_no,sm.school_code, sm.school_name');
		$this->db->from('certificate_master cm');
		$this->db->join('participant_details pd', 'pd.participant_id=cm.participant_id');
		$this->db->join('school_master sm', 'sm.school_code=cm.school_code');
		$this->db->where('cm.participant_id', $participant_id);
		$this->db->group_by('cm.participant_id');
		$participant_details		= $this->db->get();
		return $participant_details->result_array();
	}
	
	function get_participant_item_details ($participant_id)
	{
		/**
		**  CM PRINT
		*/
		$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		$this->db->select('i.item_code, i.item_name');
		$this->db->from('certificate_master cm');
		$this->db->join('item_master i', 'i.item_code=cm.item_code');
		$this->db->where('cm.participant_id', $participant_id);
		$item_details		= $this->db->get();
		$item_details		= $item_details->result_array();
		$result_array		= array();
		if (is_array($item_details) && count($item_details) > 0)
		{
			$result_array[0]	= 	'All Items';
			foreach ($item_details as $item_details)
			{
				$result_array[$item_details['item_code']]	= 	$item_details['item_name'];
			}
			
			return  $result_array;
		}
		return FALSE;
	}
	
	function get_certificate_type_condition()
	{
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		$this->db->where('sub_district_code',$sub_dist_code);
		$this->db->where('district_code',$dist_code);
		$this->db->select('type_id');
		$certificate_type		=	$this->db->get('certificate_template');
		$where					=	'';
		if ($certificate_type->num_rows() > 0)
		{
			$certificate		=	$certificate_type->result_array();
			$type_id			=	$certificate[0]['type_id'];
			
			if ($type_id == 1)
			{
				$where		=	"(cm.grade = 'A')";
			}
			else if ($type_id == 2)
			{
				$where		=	"(cm.grade IN ('A','B'))";
			}
			else if ($type_id == 3)
			{
				$where		=	"(cm.grade IN ('A','B','C'))";
			}
			else if ($type_id == 4)
			{
				$where		=	"cm.rank != 0";
			}
			else if ($type_id == 5)
			{
				$where		=	"(cm.rank < 3 and cm.rank != 0)";
			}
			else if ($type_id == 6)
			{
				$where		=	"(cm.rank = 1)";
			}
			else if ($type_id == 7)
			{
				$where		=	"(cm.rank = 1  and cm.grade = 'A')";
			}
			else if ($type_id == 8)
			{
				$where		=	"(cm.grade = 'A' or cm.rank IN (1,2,3))";
			}
		}
		return $where;
		
	}
}

?>
