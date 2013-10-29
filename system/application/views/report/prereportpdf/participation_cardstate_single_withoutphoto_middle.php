<style type="text/css">
<!--
.style1 {
	font-size: 25px;
	font-weight: bold;
	color: #660033;
}
.style56 {
	font-size: 20px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 15px;
	font-weight: bold;
	color: black;
}
.stylehy{
	font-size: 12px;
	font-weight: bold;
	color: black;
}
.style9{
	font-size: 12px;
	color: black;
	border-bottom:1px #000000; border-right:0px #000000; padding:1px;
}
.style55 {

font-size: 12px;
	color: black;
}
.style23{
		font-size: 12px;
		color: black;
}
.style3 {
	font-size: 18px;
	font-weight: bold;
	color:black;
}
.style4 {
	font-size: 12px;
	font-weight: bold;
	color:black;
}
-->
</style>
<?php

if ($this->session->userdata('SUB_DISTRICT'))
{
	/*$sub_dist_name		=	get_sub_dist_name($this->session->userdata('SUB_DISTRICT'));
	$label				=	$sub_dist_name;*/
	$title		=	wordwrap(get_sub_dist_name($this->session->userdata('SUB_DISTRICT')).' Sub District',40,'<br/>');
}
else if ($this->session->userdata('DISTRICT'))
{
	$title			=	wordwrap(get_dist_name($this->session->userdata('DISTRICT')).'  District',40,'<br/>');
}
else
{
	$title = '';
}
$fest_master_details	=	$this->General_Model->get_fest_master_details();
if (count($fest_master_details) > 0)
{
	//$title		=	(@$fest_master_details[0]['sub_dist_kalolsavam_name']) ? @$fest_master_details[0]['sub_dist_kalolsavam_name'] : '';
	//$title		=	wordwrap(get_sub_dist_name($this->session->userdata('SUB_DISTRICT')).' Sub District',40,'<br/>');
	$venue		=	wordwrap(@$fest_master_details[0]['venue'],40,'<br/>');
	$logo		=	@$fest_master_details[0]['logo_name'];
	$file_path	=	'';
	if (file_exists($this->config->item('base_path').'uploads/state/'.$logo) and trim($logo) != '')
	{
		$file_path		=	base_url(false).'uploads/state/thumb_'.$logo;
	}
	else {
	
		$file_path="";
	}
}
			



for($i = 0; $i < count($participant_details); ){
 		?>
<page backtop="2mm" backbottom="0mm"> 
<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        
<table border="1" width="550" >        
        <tr bgcolor="#CCCCCC">
            <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participant's Card</td>
        </tr>
        <tr>
            <td align="center"></td> 
            <td rowspan="2" style="font-size: 14px; border-bottom:1px #000000; border-left:1px #000000; padding:1px;">                  
            &nbsp;<strong><?php echo $participant_details[$i]['participant_name']; ?></strong><br>
            &nbsp;<?php  echo $participant_details[$i]['school_code'].' - '.@$participant_details[$i]['school_name']; ?><br>
            &nbsp;<?php echo 'Class  :'.$participant_details[$i]['class'].'<br />.'; ?>                        
            </td>
        </tr>
        <tr>
            <td  width="54"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:1px;" align="center">
            <span class="style1">
            	<?php echo $participant_details[$i]['participant_id']; ?>
            </span>
            </td>
            
        </tr>
        <?php
        $item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id']);
        $cnt=count($item_details);
        $l=1;
		$rowcount	=	0;
        foreach($item_details as $item)
        {
		$rowcount++;
        if($l==$cnt)
        $style="style23";
        else 
        $style="style9";
        $dat_itme=datetophpmodel($item['start_time']);
		$timer=explode(" ",$item['start_time']);
        
        ?>
        <tr>
        	<td colspan="2" class="style55" valign="top" align="left">&nbsp;<?php echo $item['item_code'].'&nbsp;&nbsp;&nbsp;'.$item['item_name']; ?></td>
        </tr>
        <tr>
        	<td colspan="2" class="<?php echo $style; ?>" valign="top" align="right">
        <?php echo ($item['cluster_no']) ? 'Cluster '.$item['cluster_no'].' :&nbsp;&nbsp; ' : '' ; echo $item['stage_name'].'&nbsp; ('.$item['stage_desc'].' ) :  on  '.$dat_itme .' at '.$timer[1];?>
        &nbsp;&nbsp;&nbsp; </td>
        </tr>
<?php		
}
?>
</table>
</page>
<?php					
$i++;   

}
?>
