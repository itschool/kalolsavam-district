<?php
class Tabulation_model extends Model{
	function Tabulation_model()
	{
		parent::Model();
	}
    
	function tabulation_details($itemcode)
	{
	    
		//echo $itemcode;
		$query="SELECT IM.item_code, IM.item_name FROM (`item_master` AS IM) LEFT JOIN participant_item_details AS PD ON IM.item_code =PD.item_code GROUP BY IM.item_code HAVING IM.item_code =$itemcode";
 
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
	}
	
	
?>