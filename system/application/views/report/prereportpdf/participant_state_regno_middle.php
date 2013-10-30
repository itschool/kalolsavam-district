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
	font-size: 17px;
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
		$title 			=	'';
	}
	$fest_master_details	=	$this->General_Model->get_fest_master_details();
	if (count($fest_master_details) > 0)
	{
		//$title		=	(@$fest_master_details[0]['sub_dist_kalolsavam_name']) ? @$fest_master_details[0]['sub_dist_kalolsavam_name'] : '';
		//$title		=	wordwrap(get_sub_dist_name($this->session->userdata('SUB_DISTRICT')).' Sub District',40,'<br/>');
		$venue		=	wordwrap(@$fest_master_details[0]['venue'],40,'<br/>');
		$logo		=	@$fest_master_details[0]['logo_name'];
		$file_path	=	'';
		if (file_exists($this->config->item('base_path').'uploads/state/'.$logo))
		{
			$file_path		=	base_url(false).'uploads/state/'.$logo;
		}
		else{
			$file_path="";
		}
	}
	?>

<page backtop="5mm" backbottom="0mm">
<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <table width="550" align="left" border="0" style='table-layout:fixed'>
 <tr>
 <td valign="top" width="550"> 
 <table width="540" height="339" border="1" align="left" style='table-layout:fixed'>
   <tr bgcolor="#CCCCCC">
     <td bgcolor="#E5E5E5" colspan="2" align="center" class="style3" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participant's Card</td>
   </tr>
   <tr>
     <td align="center" bordercolor="#000000"></td>
     <td rowspan="2" style="border-bottom:1px #000000; border-left:1px #000000; padding:0px;">&nbsp;<span class="style2"><?php echo $partcard[0]['participant_name']; ?></span><br />
       &nbsp;<?php echo $partcard[0]['school_code'].'  '.$partcard[0]['school_name']; ?><br />
       &nbsp;<?php echo 'Class  :'.$partcard[0]['class'].'<br /> .'; ?></td>
   </tr>
   <tr>
     <td  width="54"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:1px;" align="center">
     <span class="style1"><?php echo $partcard[0]['participant_id'];?></span>
     </td>
   </tr>
   <?php 
			
			$count=1; $cnt=count($partcard);
			$rowcount	=	0;
			for($j=0;$j<count($partcard);$j++){
			$rowcount++;
			$dat_itme=datetophpmodel($partcard[$j]['datee']);
			$timer=explode(" ",$partcard[$j]['datee']);		
			if($cnt!=($j+1)){
			
			?>
   <tr>
     <td align="left" colspan="2" class="style23">&nbsp;<?php echo $partcard[$j]['item_code'].'&nbsp;&nbsp;&nbsp;'.$partcard[$j]['item_name']; ?></td>
   </tr>
   <tr>
     <td align="right" colspan="2" class="style9" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo 'Cluster '.$partcard[$j]['cluster_no'].' :&nbsp;&nbsp; '.$partcard[$j]['stage_name'].'&nbsp; :  on  '.$dat_itme .' at '.$timer[1];?>&nbsp;&nbsp;&nbsp;</td>
   </tr>
   <?php
			}
			else{
			?>
   <tr>
     <td colspan="2" class="style23" align="left">&nbsp;<?php echo $partcard[$j]['item_code'].'&nbsp;&nbsp;&nbsp;'.$partcard[$j]['item_name']; ?></td>
   </tr>
   <tr>
     <td colspan="2" class="style23" align="right"><?php echo 'Cluster '.@$partcard[$j]['cluster_no'].' :&nbsp;&nbsp; '.@$partcard[$j]['stage_name'].'&nbsp; ('.@$partcard[$j]['stage_desc'].' ) : on '.$dat_itme.' at '.@$timer[1];?>&nbsp;&nbsp;&nbsp;</td>
   </tr>
   <?php
			}
			$count++;
			}?>			
 </table></td>
</tr>
</table>
</page>