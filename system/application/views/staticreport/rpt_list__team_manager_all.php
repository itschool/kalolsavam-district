<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 10px;
	font-weight: bold;
	color:#000000;
}
.style9{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.style5{
	font-size: 10px;
	color:#000000;
}
-->
</style>
<page backtop="10mm" backbottom="10mm">
	<page_header>
	</page_header>
<page_footer>
<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
            <tr>
				<td style="text-align: center;width: 100%" class="style4">Report Generated From       on <?php echo date("F j, Y, g:i a");  	?>			</td>
			</tr>
  </table>
</page_footer>  


  
  
        <table width="103%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td height="33" align="center" class="style1" valign="top">List of  participants </td>
        </tr>  </table>
        <?php
      		$pre_school="";
			$pre_festval="";
            for($j =0; $j<count($part_details); $j++){
			if($pre_school!=$part_details[$j]['school_code']){
			if($j!=0){
			print("</table><br><br><br>");
			}
			$pre_school=$part_details[$j]['school_code'];
			$pre_festval="";
			$count	=0;
			?>
       
  <table width="100%" border="0" align="center">
  <tr bgcolor="#E5E5E5">
    <td bgcolor="#E5E5E5" width="37%" class="style9" align="left">School  Code:&nbsp;&nbsp;&nbsp;<?php echo $part_details[$j]['school_code']; ?>&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#E5E5E5" width="39%" class="style9" align="center">&nbsp;&nbsp;&nbsp;School Name:&nbsp;&nbsp;<?php echo $part_details[$j]['school_name']; ?> &nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#E5E5E5" width="22%" class="style9" align="right">&nbsp;&nbsp;&nbsp;Festival: &nbsp;&nbsp;<?php echo $part_details[$j]['fest_name']; ?> &nbsp;&nbsp;</td>
   
    </tr>
    <tr><td colspan="3ssss" height="10"></td></tr>
</table>

		<?php
		}
       
		if($pre_festval!=$part_details[$j]['fest_id']){
		$count	=0;
		$pre_festval=$part_details[$j]['fest_id'];
		
        ?>
		 <table width="121%" border="1" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td width="13%" height="30" align="right" class="style2" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;Sl.No&nbsp;&nbsp;</td>
    <td width="19%"align="center" class="style2" style="border: 0 0px 1px 0 #000000;">Item Code &amp; Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="23%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;Name of Participants&nbsp;&nbsp;&nbsp;</td>
    <td width="7%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;Boy/Girl&nbsp;</td>
    <td width="5%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;Standard&nbsp;</td>
    <td width="7%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;">&nbsp;Cluster No&nbsp;&nbsp;&nbsp;</td>
    <td width="6%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;Stage No.&nbsp;&nbsp;</td>
    <td width="8%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="12%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;Tentative Time&nbsp;&nbsp;</td>
  </tr>
     <?php
	   	 }
		 $count++;
			if($part_details[$j]['gender']=='B') $gender='Boy'; 
			else if($part_details[$j]['gender']=='G') $gender='Girl';
			
		$time		=	$part_details[$j]['max_time'] * $part_details[$j]['no_of_participant'];
		$time		=	get_time_format($time);
		$datt=datetophpmodel($part_details[$j]['ddt']);
                ?>
  <tr>
    <td height="25"align="right" class="style5" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;<?php echo $count;?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" class="style5" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;<?php echo $part_details[$j]['item_code'].'  '.$part_details[$j]['item_name'];?></td>
    <td align="left" class="style5" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;<?php  echo $part_details[$j]['participant_name'];?></td>
    <td align="center" class="style5" style="border: 0 0px 1px 0 #000000;"><?php echo $gender; ?></td>
    <td align="center" class="style5" style="border: 0 0px 1px 0 #000000;"><?php echo $part_details[$j]['class']; ?></td>
    <td class="style5" align="center" style="border: 0 0px 1px 0 #000000;"><?php echo  $part_details[$j]['cluster_no']; ?></td>
    <td align="center" class="style5" style="border: 0 0px 1px 0 #000000;"><?php echo $part_details[$j]['stage_name']; //stage_desc?></td>
    <td align="center" class="style5" style="border: 0 0px 1px 0 #000000;"><?php echo $datt; ?></td>
    <td align="center" class="style5" style="border: 0 0px 1px 0 #000000;">&nbsp;<?php echo $time; ?></td>
  </tr>
  <?php
            }
        ?>
		</table>
     
        <table>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</page>
       
		