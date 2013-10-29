<?php 
	function box_top(){
		$CI =& get_instance();
		$CI->load->view('box/box_white_top');
		//include(base_path().'system/application/views/box/box_white_top.php');
	}
	
	function box_bottom(){
		$CI =& get_instance();
		$CI->load->view('box/box_white_bottom');
		//include(base_path().'system/application/views/box/box_white_bottom.php');
	}
	function blue_box_top(){
		$CI =& get_instance();
		$CI->load->view('box/box_blue_top');
		//include(base_path().'system/application/views/box/box_blue_top.php');
	}
	
	function blue_box_bottom(){
		$CI =& get_instance();
		$CI->load->view('box/box_blue_bottom');
		//include(base_path().'system/application/views/box/box_blue_bottom.php');
	}
	
	function get_encr_password($password)
	{
		$pass	=	md5($password);
		return substr(md5($pass.'kalolsavam'),0,50);
	}
	function array_remove($arr,$value) {
	   return array_values(array_diff($arr,array($value)));
	}
	
	function dateFormat_Ymd($date)
	{
		list($d,$m,$y)		=	explode('/',$date);
		return $y.'-'.$m.'-'.$d;
	}
	function dateFormat_dmY($date)
	{
		list($d,$m,$y)		=	explode('-',$date);
		return $d.'/'.$m.'/'.$y;
	}
	function get_time_format($minute)
	{
		$time_format	=	'';
		$hour		=	floor((int)$minute / 60);
		$minutes	=	(int)$minute % 60;
		$time_format	.=	((int)$hour != 0)? (int)$hour.' Hours ' : '';
		$time_format	.=	((int)$minutes != 0)? (int)$minutes.' Minutes ' : '';
		return $time_format;
	}
	
	//define('__NO_PERMISSION__', 'Sorry %s, you don\'t have enough permission to do this operation. If you want to know more about, please contact your administrator. <a href="%s" style="text-decoration:underline">Click Here</a> to go back. <br><br>');
	//define('__NO_PERMISSION_AJAX__', 'Sorry %s, you don\'t have enough permission to do this operation. If you want to know more about, please contact your administrator.<br><br>');
	function permission_warning($is_ajax_call = false){
		/*$CI =& get_instance();
		if($is_ajax_call){
			return sprintf(__NO_PERMISSION_AJAX__, $CI->session->userdata("FIRSTNAME"));
		}else{
			return sprintf(__NO_PERMISSION__, $CI->session->userdata("FIRSTNAME"), @$_SERVER['HTTP_REFERER']);
		}
		*/
		//return 'Sorry, you don\'t have enough permission to do this operation. If you want to know more about, please contact your administrator. <a href="'.@$_SERVER['HTTP_REFERER'].'" style="text-decoration:underline">Click Here</a> to go back. <br><br>';
		return 'Sorry, you don\'t have enough permission to do this operation. If you want to know more about, please contact your administrator. <br><br>';
	}
	
	function get_array_val_count($array, $key, $val){ 
		$total_records = count($array);
		$count = 0;
		for($i=0; $i<$total_records; $i++){
			if($array[$i][$key]==$val) $count++;
		}
		return $count;
	}
	function get_array_double_val_count($array, $key1, $val1, $key2, $val2){ 
		$total_records = count($array);
		$count = 0;
		for($i=0; $i<$total_records; $i++){
			if($array[$i][$key1]==$val1 and $array[$i][$key2]==$val2) $count++;
		}
		return $count;
	}
	
	function fncUuid(){
		return sprintf(
				 '%08x-%04x-%04x-%02x%02x-%012x', mt_rand(), mt_rand(0, 65535),
				 bindec(substr_replace(sprintf('%016b', mt_rand(0, 65535)), '0100', 11, 4)),
				 bindec(substr_replace(sprintf('%08b', mt_rand(0, 255)), '01', 5, 2)),
				 mt_rand(0, 255), mt_rand()
			 );
	}
	function error_box($error){ ?>
		<div style="margin:5px;" align="center"> 
			<?php box_top(); ?>
				<div class="error_image" style="padding:10px;">
				<div style="margin:10px;margin-bottom:0px; font-size:16px" id="error_display" class="alert_display"><?php echo @$error; ?></div>
				</div>
			<?php box_bottom(); ?>
		</div>
		<?php 
	}
	function display_kalolsavam_logo ($kalolsavam_type, $image_name, $size='small')
	{
		$CI =& get_instance();
		if ('small' == $size)
		{
			$width	= '75px';
			$height	= '75px';
		}
		
		if($kalolsavam_type == 'state')
		{
			$image_url	=	$CI->config->item('base_url').'uploads/state/'.'thumb_'.$image_name;
			$image_path	=	$CI->config->item('base_path').'uploads/state/'.'thumb_'.$image_name;
		}
		else if($kalolsavam_type == 'dist')
		{
			$image_url	=	$CI->config->item('base_url').'uploads/district/'.'thumb_'.$image_name;
			$image_path	=	$CI->config->item('base_path').'uploads/district/'.'thumb_'.$image_name;
		}
		else if($kalolsavam_type == 'sub_dist')
		{
			$image_url	=	$CI->config->item('base_url').'uploads/sub_district/'.'thumb_'.$image_name;
			$image_path	=	$CI->config->item('base_path').'uploads/sub_district/'.'thumb_'.$image_name;
		}
		if (file_exists($image_path))
		{
			$image_properties = array(
					  'src' => $image_url,
					  'alt' => 'Logo',
					  'width' => $width,
					 // 'height' => $height,
					  'title' => 'kalolsavam logo',
			);
			echo img($image_properties);
		}

	}
	
	function get_sub_dist_name($sub_dist_code)
	{
		$CI =& get_instance();
		$CI->db->where('sub_district_code',$sub_dist_code);
		$sub_district_master		=	$CI->db->get('sub_district_master');
		if ($sub_district_master->num_rows() > 0)
		{
			$sub_district		=	$sub_district_master->result_array();
			return $sub_district[0]['sub_district_name'];
		}
	}
	function get_dist_name($dist_code)
	{
		$CI =& get_instance();
		$CI->db->where('rev_district_code',$dist_code);
		$district_master		=	$CI->db->get('rev_district_master');
		if ($district_master->num_rows() > 0)
		{
			$district		=	$district_master->result_array();
			return $district[0]['rev_district_name'];
		}
	}
	
	function is_import_data_finish($district_code)
	{
		$CI =& get_instance();
		$CI->db->where('rev_district_code', $district_code);
		$CI->db->where('is_import_finish', 'Y');
		$district_master		=	$CI->db->get('rev_district_master');
		
		if ($district_master->num_rows() > 0)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	function is_define_kalolsavam($district_code)
	{
		$CI =& get_instance();
		$CI->db->where('rev_district_code', $district_code);
		$CI->db->where('venue !=', '');
		$CI->db->where('start_date !=', '');
		$CI->db->where('end_date !=', '');
		$dist_kalolsavam_master		=	$CI->db->get('dist_kalolsavam_master');
		if ($dist_kalolsavam_master->num_rows() > 0)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	
	function datetophpmodel($date)
	{
		if ($date)
			return date('d M Y',strtotime($date));
		else
			return '';
	}
	function timephpmodel($date)
	{
		if ($date)
			return date('h:i A',strtotime($date));
		else
			return '';
	}

?>