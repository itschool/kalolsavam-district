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
.tb{border: 0 0px 1px 0 #000000;
font-size: 10px;
	font-weight: bold;
	color:#000000;}
	
.ety{
border: 0 0px 1px 0 #000000;
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
        <td height="31" align="center" class="style1" valign="top">&nbsp;&nbsp;List of  participants &nbsp;&nbsp;</td>
        </tr>  </table>
       
  <table width="100%" border="0" align="center">
  <tr>
    <td width="37%" class="style9">School  Code:&nbsp;&nbsp;&nbsp;<?php echo $school_det[0]['school_code']; ?>&nbsp;&nbsp;&nbsp;</td>
    <td width="39%" class="style9">School Name:&nbsp;&nbsp;<?php echo $school_det[0]['school_name']; ?> &nbsp;&nbsp;&nbsp;</td>
    <td width="22%" class="style9">Festival: &nbsp;&nbsp;<?php echo $part_details[0]['fest_name']; ?> &nbsp;&nbsp;</td>
    <td width="2%">&nbsp;</td>
    </tr>
    <tr><td colspan="4" height="10"></td></tr>
</table>


 <table width="130%" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="9%" height="30" align="center"  class="tb">&nbsp;&nbsp;&nbsp;&nbsp;Sl.No&nbsp;&nbsp;</td>
    <td width="24%"align="center" class="tb">&nbsp;&nbsp;Item Code &amp; Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="22%" align="center" class="tb">&nbsp;&nbsp;&nbsp;Name of Participants&nbsp;&nbsp;&nbsp;</td>
    <td width="9%" align="center" class="tb">&nbsp;&nbsp;Boy/Girl&nbsp;&nbsp;</td>
    <td width="7%" align="center" class="tb">&nbsp;&nbsp;Standard&nbsp;&nbsp;</td>
    <td width="7%" align="center" class="tb">&nbsp;&nbsp;Cluster No&nbsp;&nbsp;&nbsp;</td>
    <td width="6%" align="center" class="tb">Stage No.</td>
    <td width="8%" align="center" class="tb">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="8%" align="center" class="tb">&nbsp;&nbsp;Tentative Time&nbsp;&nbsp;</td>
  </tr>
     <?php
	 
		  $count	=	0;
            for($j = 0; $j < count($part_details); $j++){
			$count++;
			if($part_details[$j]['gender']=='B') $gender='Boy'; 
			else if($part_details[$j]['gender']=='G') $gender='Girl';
		$time		=	$part_details[$j]['max_time'] * $part_details[$j]['no_of_participant'];
		$time		=	get_time_format($time);
		$datt=datetophpmodel($part_details[$j]['ddt']);
                ?>
  <tr>
    <td height="25"align="center" class="ety" >&nbsp;&nbsp;<?php echo $count;?></td>
    <td align="left" class="ety" >&nbsp;&nbsp;<?php echo $part_details[$j]['item_code'].'  '.$part_details[$j]['item_name'];?></td>
    <td align="left" class="ety" >&nbsp;&nbsp;<?php  echo $part_details[$j]['participant_name'];?></td>
    <td align="center" class="ety" >&nbsp;&nbsp;<?php echo $gender; ?></td>
    <td align="center" class="ety" >&nbsp;&nbsp;<?php echo $part_details[$j]['class']; ?></td>
    <td  align="center" class="ety" >&nbsp;&nbsp;<?php echo  $part_details[$j]['cluster_no']; ?></td>
    <td align="center" class="ety" >&nbsp;&nbsp;<?php echo $part_details[$j]['stage_name']; //stage_desc?></td>
    <td align="center" class="ety" >&nbsp;&nbsp;<?php echo $datt; ?></td>
    <td align="center" class="ety" >&nbsp;&nbsp;<?php echo $time; ?></td>
  </tr>
  		<?php
           
		    }
 		 ?>
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
       
		