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
.style9{
	font-size: 15px;
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
		$sub_dist_name		=	get_sub_dist_name($this->session->userdata('SUB_DISTRICT'));
		$label				=	$sub_dist_name;
	}
	$fest_master_details	=	$this->General_Model->get_fest_master_details();
	if (count($fest_master_details) > 0)
	{
		$title		=	(@$fest_master_details[0]['sub_dist_kalolsavam_name']) ? @$fest_master_details[0]['sub_dist_kalolsavam_name'] : '';
		$title		=	wordwrap(get_sub_dist_name($this->session->userdata('SUB_DISTRICT')).' Sub District',40,'<br/>');
		$venue		=	wordwrap(@$fest_master_details[0]['venue'],40,'<br/>');
		$logo		=	@$fest_master_details[0]['logo_name'];
		$file_path	=	'';
		if (file_exists($this->config->item('base_path').'uploads/district/'.$logo))
		{
			$file_path		=	base_url(false).'uploads/district/'.$logo;
		}
	}
					$j=0;$i=0;$partarray=array();$prev_part="";
					for($j=0;$j<count($partcard);$j++)
					{
					if($prev_part!=$partcard[$j]['participant_id']){
					$prev_part=$partcard[$j]['participant_id'];
					$partarray[$i]=$partcard[$j]['participant_id'];
					$i++;
					}
					}
					$cnt=count($partarray);
					//echo $cnt;
					for($j=0;$j<count($partarray); $j++){
					//while($j<count($partcard)){
					//$j++;

			?>

		<page backtop="10mm" backbottom="10mm ">
			<page_header>
				<table style="width: 100%;">
					<tr>
						<td style="text-align: right;width: 100%"></td>
					</tr>
				</table>
			</page_header>

<table align="center" width="100%" border="0"><tr><td valign="top">
<?php
$prev_participant="";

for($k=0;$k<count($partcard);$k++){
if($partarray[$j]==$partcard[$k]['participant_id']){
if($prev_participant!=$partcard[$k]['participant_id']){
$prev_participant=$partcard[$k]['participant_id'];
$dat_itme=datetophpmodel($partcard[$k]['datee']);


?>


<table align="left" width="50%" border="1"><tr>
  <td class="style56" colspan="2" >Kerala School Kalolsavam 2013 - 2014</td></tr>
     <tr>
    	<td height="40">
        	<?php if ($file_path){?>
        	<img src="<?php echo $file_path?>" height="40">
            <?php }?>
         </td>
    	<td align="center"><?php echo $title.'<br> '.$venue; ?><br></td>
    </tr>

    <tr bgcolor="#CCCCCC">
    	<td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participants Card</td>
    </tr>
    <tr>
    	<td colspan="2">&nbsp;</td>
    </tr>

    <tr>
    	<td>Reg. No</td><td>&nbsp;</td>
    </tr>
    <tr>
    	<td  width="50"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;" align="center"><?php echo $partcard[$k]['participant_id']; ?></td>
    	<td style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><span class="style2"><?php echo $partcard[$k]['participant_name']; ?></span><br>
		<?php  echo $partcard[$k]['school_code'].'  '.$partcard[0]['school_name']; ?><br>
        <?php echo 'Class  :'.$partcard[$k]['class']; ?></td>
    </tr>
    <?php
    }


    ?>


    <tr>
        <td colspan="2" class="style9" valign="top"><?php echo $partcard[$k]['item_code'].'-'.$partcard[$k]['item_name']; ?></td>
    </tr>
    <tr>
        <td colspan="2" class="style9" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">
            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Cluster '.$partcard[$k]['cluster_no'].' :&nbsp;&nbsp; '.$partcard[$k]['stage_name'].' - '.$partcard[$k]['stage_desc'].'&nbsp; :  on  '.$dat_itme;?>
        </td>
    </tr>
    <?php
    }
    }
    $j++;


    ?>


</table>
</td>
<td>&nbsp;&nbsp;</td>
<td valign="top">



<?php

/*$prev_participant="";

for($k=0;$k<count($partcard);$k++){
if($partarray[$j]==$partcard[$k]['participant_id']){
if($prev_participant!=$partcard[$k]['participant_id']){
$prev_participant=$partcard[$k]['participant_id'];
$dat_itme=datetophpmodel($partcard[$k]['datee']);
*/
?>

<table align="left" width="50%" border="1"><tr>
  <td class="style56" colspan="2" >Kerala School Kalolsavam 2013 - 2014</td></tr>
<tr><td> <img src="<?php echo $file_path?>" height="40"></td>
<td align="center"><?php echo $title.'<br> '.$venue; ?><br></td></tr>


<tr bgcolor="#CCCCCC">
<td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participants Card</td>
</tr>
<tr><td colspan="2">&nbsp;</td>
</tr>
<tr><td>Reg. No</td><td>&nbsp;</td></tr>
<tr><td  width="50"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;" align="center"><?php //echo $partcard[$k]['participant_id']; ?></td>
<td style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"></td></tr>
<?php
//}

?>


<tr><td colspan="2" class="style9"><?php // echo $partcard[$k]['item_code'].'-'.$partcard[$k]['item_name']; ?></td>
</tr>
<tr><td colspan="2" class="style9" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">
&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo 'Cluster '.$partcard[$k]['cluster_no'].' :&nbsp;&nbsp; '.$partcard[$k]['stage_name'].' - '.$partcard[$k]['stage_desc'].'&nbsp; :  on  '.$dat_itme;?>
</td>  </tr>

<tr><td colspan="2" class="style9">&nbsp;</td>
</tr>
<tr><td colspan="2" class="style9">&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<?php
//}
//}
//}
$j++;

?>



</table>
</td><td>&nbsp;&nbsp;</td>

<td valign="top">



<table align="left" width="50%" border="1"><tr>
  <td class="style56" colspan="2" >Kerala School Kalolsavam 2013 - 2014</td></tr>
 	<tr>
    	<td height="40">
        	<?php if ($file_path){?>
        	<img src="<?php echo $file_path?>" height="40">
            <?php }?>
         </td>
    	<td align="center"><?php echo $title.'<br> '.$venue; ?><br></td>
    </tr>


<tr bgcolor="#CCCCCC">
<td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participants Card</td>
</tr>
<tr><td colspan="2">&nbsp;</td>
</tr>
<tr><td>Reg. No</td><td>&nbsp;</td></tr>
<tr><td  width="50"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;" align="center">
<?php //echo $partcard[0]['participant_id']; ?></td>
<td style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">


</td>
</tr>


<tr><td colspan="2" class="style9">&nbsp;</td>
</tr>
<tr><td colspan="2" class="style9" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<?php

?>
<tr><td colspan="2" class="style9">&nbsp;</td>
</tr>
<tr><td colspan="2" class="style9">&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>


<?php

?>


</table></td></tr></table></page>

        <?php

		}

		?>






