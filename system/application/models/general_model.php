<?php 
class General_Model extends Model{
	function General_Model(){
		parent::Model();
	}
	
	function get_data( $table, $fields = '*', $where = array(),$order_by = '' ){
		if((is_array($where) && count($where)>0) or (!is_array($where) && trim($where) != '')) $this->db->where($where);
		if($order_by) $this->db->order_by($order_by);
		$this->db->select($fields);
		$query = $this->db->get($table);
		return $query->result_array();
	}
	
	function insert($table, $fields = array()){
		if(count($fields) <= 0) return false;
		$this->db->insert( $table, $fields );
		return $this->db->insert_id();
	}
	
	function update($table, $fields = array(), $where = array()){
		if(count($fields) <= 0) return false;
		if(is_array($where) and count($where) > 0) $this->db->where($where);
		return $this->db->update( $table, $fields );
		
	}
	function delete($table, $where){
		$this->db->where($where);
		return $this->db->delete( $table );
	}
	function fetch_data($table, $fields = '*', $where = ''){
		$fields = is_array($fields) ? implode(',', $fields) : $fields;
		$where = (trim($where) != '') ? " WHERE $where " : '';
		$sql = "SELECT $fields FROM $table $where";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function prepare_select_box_data( $table, $fields, $where = array(), $insert_null = false,$order_by = ''){
		
		list($key, $val) 	= explode(',',$fields);
		$key 				= trim($key);
		$val 				= trim($val);
		$order_by			= $order_by ? $order_by : $val;
		$input_array 		= $this->get_data( $table, $fields, $where, $order_by );
		
		$select_box_array 	= array();
		$total_records 		= count($input_array);
		if($insert_null) {
			$select_box_array[] = $insert_null===true ? '' : $insert_null;
		}
		for($i = 0; $i < $total_records; $i++){
		 	$select_box_array[$input_array[$i][$key]] = $input_array[$i][$val];
		}
		return $select_box_array;
	}
	
	function prepare_select_box_data_special( $table, $field_list, $fields, $where = array(), $insert_null = false,$order_by = ''){
		
		list($key, $val) 	= explode(',',$field_list);
		//$fields				= str_replace('#$#',',',$fields);
		$key 				= trim($key);
		$val 				= trim($val);
		$order_by			= $order_by ? $order_by : $val;
		$input_array 		= $this->get_data( $table, $fields, $where, $order_by );
		
		$select_box_array 	= array();
		$total_records 		= count($input_array);
		if($insert_null) {
			$select_box_array[] = $insert_null===true ? '' : $insert_null;
		}
		for($i = 0; $i < $total_records; $i++){
		 	$select_box_array[$input_array[$i][$key]] = $input_array[$i][$val];
		}
		return $select_box_array;
	}
	
	public function is_record_exists($table, $where = ''){
		$where 	= (trim($where) != '') ? ' WHERE '.$where : '';
		$sql 	= "SELECT COUNT(*) AS CNT FROM $table $where";
		$query 	= $this->db->query($sql);
		if($query->num_rows() >0){
			$result = $query->result_array(); 
			return $result[0]['CNT'];
		}else{
			return 0;
		}
	}
	public function get_record_count($table, $where = '',$feild = '*'){
		$where 	= (trim($where) != '') ? ' WHERE '.$where : '';
		$sql 	= "SELECT COUNT($feild) AS CNT FROM $table $where";
		$query 	= $this->db->query($sql);
		if($query->num_rows() >0){
			$result = $query->result_array(); 
			return $result[0]['CNT'];
		}else{
			return 0;
		}
	}
	
	public function get_single_column_value($table, $feild, $where = '')
	{
		$where 	= (trim($where) != '') ? ' WHERE '.$where : '';
		$sql 	= "SELECT $feild FROM $table $where";
		$query 	= $this->db->query($sql);
		if($query->num_rows() >0){
			$result = $query->result_array(); 
			foreach($result AS $value)
				$result_array[]	=	$value[$feild];
			return $result_array;
		}else{
			return 0;
		}
	}
	
	public function get_settings($id)
	{
		$this->db->where("id", $id);
		$this->db->select('value');
		$this->db->from('general_settings');
		$result = $this->db->get();
		$result = $result->result_array();
		if(count($result) > 0){
			return $result[0]['value'];
		}
		else
		{
			return 0;
		}
		
		
	}
	
	public function get_subdistrict_details_combo($district_code)
	{
		$this->db->where('rev_district_code', $district_code);
		$this->db->select('sub_district_code, CONCAT(sub_district_code, " - ",sub_district_name) AS subdistrict', FALSE);
		$query = $this->db->get('sub_district_master');
		$subdistricts	=	$query->result_array();
		$subdistrict_array[0]	=	'Select Sub-district';
		for($i = 0; $i < count($subdistricts); $i++){
		 	$subdistrict_array[$subdistricts[$i]['sub_district_code']] = $subdistricts[$i]['subdistrict'];
		}
		return $subdistrict_array;
	}
	
	public function get_school_details_combo($subdistrict_code)
	{
		$this->db->where('sub_district_code', $subdistrict_code);
		$this->db->select('school_code, CONCAT(school_code, " - ",school_name) AS school', FALSE);
		$query = $this->db->get('school_master');
		$subdistricts	=	$query->result_array();
		$subdistrict_array[0]	=	'Select School';
		for($i = 0; $i < count($subdistricts); $i++){
		 	$subdistrict_array[$subdistricts[$i]['school_code']] = $subdistricts[$i]['school'];
		}
		return $subdistrict_array;
	}

	public function get_participant_details_combo($school_code)
	{
		$this->db->where('school_code', $school_code);
		$this->db->select('admn_no, CONCAT_WS(" - ",admn_no,participant_name) AS participant', FALSE);
		$this->db->order_by('admn_no');
		$query = $this->db->get('participant_details');
		$subdistricts	=	$query->result_array();
		$Participant_array[0]	=	'Select Participant';
		for($i = 0; $i < count($subdistricts); $i++){
		 	$Participant_array[$subdistricts[$i]['admn_no']] = $subdistricts[$i]['participant'];
		}
		return $Participant_array;
	}
	public function upload_logo_image ($file_input_name, $image_name, $kalolsavam_type)
	{
		if ($kalolsavam_type == 'state') $upload_path = $this->config->item('base_path').'uploads/state/';
		else if ($kalolsavam_type == 'dist') $upload_path = $this->config->item('base_path').'uploads/district/';
		else if ($kalolsavam_type == 'sub_dist') $upload_path = $this->config->item('base_path').'uploads/sub_district/';
		
		$config['upload_path'] 		= $upload_path;
		$ext						= end(explode('.', $_FILES[$file_input_name]['name']));
		$config['file_name'] 		= $image_name.'.'.$ext;
		
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['overwrite'] 		= TRUE;
		/*$config['max_size']			= '2000';
		$config['max_width']  		= '500';
		$config['max_height']  		= '500';*/
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($file_input_name))
		{
			return FALSE;
		}	
		else
		{
			$image_name 				= $image_name.'.'.$ext;
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= $upload_path.$image_name;
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['new_image']		= 'thumb_'.$image_name;
			$config['thumb_marker']		= '';
			$config['width'] = 75;
			$config['height'] = 75;
			
			$this->load->library('image_lib', $config);
			if ($this->image_lib->resize()) return $image_name;
			else FALSE;
		}
	}
	function unlink_kalolsavam_logo ($prev_image_name, $prev_image_type)
	{
		if ($kalolsavam_type == 'state') $upload_path = $this->config->item('base_path').'uploads/state/';
		else if ($kalolsavam_type == 'dist') $upload_path = $this->config->item('base_path').'uploads/district/';
		else if ($kalolsavam_type == 'sub_dist') $upload_path = $this->config->item('base_path').'uploads/sub_district/';
		
		if(file_exists ($upload_path.$prev_image_name))
		{
			@unlink(upload_path.$prev_image_name);
		}
		if(file_exists ($upload_path.'thumb_'.$prev_image_name))
		{
			@unlink($upload_path.'thumb_'.$prev_image_name);
		}
	}
	
	function get_hour_array($start_HH = true)
	{
		if ($start_HH)
			$hour_array['HH']		=	'HH';
		
		for ($i = 0; $i < 24;$i++)
		{
			$hour				=	sprintf('%02s',$i);
			$hour_array[$hour]	=	$hour;
		}
		return $hour_array;
	}
	function get_min_array($start_MM = true)
	{
		if ($start_MM)
			$min_array['MM']		=	'MM';
		
		for ($i = 0; $i < 60;$i+=5)
		{
			$min				=	sprintf('%02s',$i);
			$min_array[$min]	=	$min;
		}
		return $min_array;
	}
	
	function get_fest_date_array()
	{
		if ($this->session->userdata('USER_TYPE') == 3)
		{
			$this->db->where('sub_district_code',$this->session->userdata('SUB_DISTRICT'));
			$sub_dist_kalolsavam_master		=	$this->db->get('sub_dist_kalolsavam_master');
			if ($sub_dist_kalolsavam_master->num_rows() > 0)
			{
				$sub_dist		=	$sub_dist_kalolsavam_master->result_array();
				$start_date		=	$sub_dist[0]['start_date'];
				$end_date		=	$sub_dist[0]['end_date'];
				$date_array		=	array();
				$i=0;
				while($start_date <= $end_date and $i<100)
				{
					$date_array[$start_date]		=	date('j M Y',strtotime($start_date));
					list($y,$m,$d)					=	explode('-',$start_date);
					$start_date						=	date('Y-m-d',mktime(0,0,0,$m,$d+1,$y));
					$i++;
				}
			}
			return $date_array;
		}
		else if ($this->session->userdata('USER_TYPE') == 2)
		{
			$this->db->where('rev_district_code',$this->session->userdata('DISTRICT'));
			$sub_dist_kalolsavam_master		=	$this->db->get('dist_kalolsavam_master');
			if ($sub_dist_kalolsavam_master->num_rows() > 0)
			{
				$sub_dist		=	$sub_dist_kalolsavam_master->result_array();
				$start_date		=	$sub_dist[0]['start_date'];
				$end_date		=	$sub_dist[0]['end_date'];
				$date_array		=	array();
				$i=0;
				while($start_date <= $end_date and $i<10)
				{
					$date_array[$start_date]		=	date('j M Y',strtotime($start_date));
					list($y,$m,$d)					=	explode('-',$start_date);
					$start_date						=	date('Y-m-d',mktime(0,0,0,$m,$d+1,$y));
					$i++;
				}
			}
			return $date_array;
		}
		
	}
	
	function get_result_date_array()
	{
		/*if ($this->session->userdata('USER_TYPE') == 2)
		{*/
			//$this->db->where('sub_district_code',$this->session->userdata('SUB_DISTRICT'));
			//echo "<br /><br /><br /><<<<<<<<<<";
			$this->db->distinct('confirm_date');
			$this->db->select('confirm_date');
			$this->db->orderby('confirm_date','DESC');
			$result_time_master		=	$this->db->get('result_time');
			if ($result_time_master->num_rows() > 0)
			{
				$date_array		=	array();
				foreach($result_time_master->result_array() as $date_time)				
				{
					//echo "<br /><br />1st date-----".var_dump($date_time);					
					$start_date		=	$date_time['confirm_date'];
					$date_array[$start_date]	=	date('j M Y',strtotime($start_date));
					//echo "<br /><br />date-----".var_dump($date_array);								
			    }								
			}
			return $date_array;
			//var_dump($date_array);
		//}
	}
	
	function get_fest_master_details()
	{
		if ($this->session->userdata('USER_TYPE') == 3)
		{
			$this->db->where('sub_district_code',$this->session->userdata('SUB_DISTRICT'));
			$sub_dist_kalolsavam_master		=	$this->db->get('sub_dist_kalolsavam_master');
			if ($sub_dist_kalolsavam_master->num_rows() > 0)
			{
				return $sub_dist_kalolsavam_master->result_array();
			}
			
		}
		else if ($this->session->userdata('USER_TYPE') == 2)
		{
			$this->db->where('rev_district_code',$this->session->userdata('DISTRICT'));
			$dist_kalolsavam_master		=	$this->db->get('dist_kalolsavam_master');
			if ($dist_kalolsavam_master->num_rows() > 0)
			{
				return $dist_kalolsavam_master->result_array();
			}
			
		}
		
		else 
		{
			$this->db->where('status','O');
			$kalolsavam_master		=	$this->db->get('kalolsavam_master');
			if ($kalolsavam_master->num_rows() > 0)
			{
				return $kalolsavam_master->result_array();
			}
			
		}
		
		
	}
	
	function upload_kalolsavam_csv_data ($file_input_name, $file_name)
	{
		$upload_path				= $this->config->item('base_path').'uploads/csv/';
		$config['upload_path'] 		= $upload_path;
		$ext						= end(explode('.', $_FILES[$file_input_name]['name']));
		$config['file_name'] 		= $file_name.'.'.$ext;
		
		$config['allowed_types'] 	= 'csv';
		$config['overwrite'] 		= TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($file_input_name))
		{
			return FALSE;
		}	
		else
		{
			return $config['file_name'];
		}
	}
	
	function is_certificate_template_set()
	{
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		
		$this->db->where('sub_district_code',$sub_dist_code);
		$this->db->where('district_code',$dist_code);
		
		$certificate_template		=	$this->db->get('certificate_template');
		if ($certificate_template->num_rows() > 0)
		{
			return true;
		}
		return false;
	}
	
	
	function is_all_stage_alloted()
	{
		$this->db->group_by('item_code');
		$participant_item_details	=	$this->db->get('participant_item_details');
		$participant_item			=	$participant_item_details->num_rows();
		
		$this->db->group_by('item_code');
		$stage_item_master	=	$this->db->get('stage_item_master');
		$stage_item			=	$stage_item_master->num_rows();
		
		if ($participant_item > $stage_item)
		{
			return false;
		}
		return true;
	}
	
	function is_all_result_entered()
	{
		$this->db->group_by('item_code');
		$this->db->where('is_finish','Y');
		$result_master	=	$this->db->get('result_master');
		$result_item	=	$result_master->num_rows();
		
		$this->db->group_by('item_code');
		$stage_item_master	=	$this->db->get('stage_item_master');
		$stage_item			=	$stage_item_master->num_rows();
		
		if ($stage_item > $result_item)
		{
			return false;
		}
		return true;
	}
	
	
	function get_item_captains_array($item_id)
	{
		$captains_array			=	array();
		$this->db->where('PID.item_code',$item_id);
		$this->db->where('PID.is_captain','Y');
		$this->db->from('participant_item_details PID');
		$this->db->join('participant_details PD', 'PD.participant_id = PID.participant_id');	
		$this->db->order_by('PID.participant_id');
		$this->db->select('PD.admn_no, CONCAT(PD.admn_no, " - ",PD.participant_name) AS pname', FALSE);
		$cap_result = $this->db->get();
		if ($cap_result->num_rows() > 0)
		{
			
			$cap_array				=	$cap_result->result_array();
			$captains_array[0]		=   'Select Captain';
			$captains_array['ALL']  = 	'ALL';
			foreach($cap_array as $caps)
			{
				$admn						=	$caps['admn_no'];
				$name						=	$caps['pname'];
				$captains_array[$admn]		=	$name;
			}
		    //var_dump($captains_array);
		   
		}
		 return $captains_array;
	}
	function restore_database ($file_input_name, $file_name)
	{
		$upload_path				= $this->config->item('base_path').'uploads/csv/';
		$config['upload_path'] 		= $upload_path;
		$ext						= end(explode('.', $_FILES[$file_input_name]['name']));
		$config['file_name'] 		= $file_name.'.'.$ext;
		$config['allowed_types'] 	= 'csv|sql';
		$config['overwrite'] 		= TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($file_input_name))
		{
			return FALSE;
		}	
		else
		{
			return $config['file_name'];
		}
	}
	
}
?>
