<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 11px;
	font-weight: bold;
	color: black;
}
-->
</style>
<page backtop="10mm" backbottom="10mm">
	<page_header>
    
<table style="width: 100%;">
			<tr>
				<td style="text-align: right;width: 100%"></td>
			</tr>
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
		</table>
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
        <td align="center" class="style1">Registration Fee Details</td>
</tr>  </table>
		<?php
		$tot_grand=array();
		
		for($j=0; $j<count($fees_details); $j++){
		
		$tot=(($fees_details[$j]['up_afli'])+($fees_details[$j]['up_part']))+
		(($fees_details[$j]['hs_afli'])+($fees_details[$j]['hs_part']))+
		(($fees_details[$j]['hss_afli'])+($fees_details[$j]['hs_part']))+
		(($fees_details[$j]['vhss_afli'])+($fees_details[$j]['vhss_part']));
		
		if($tot!=0){
		array_push($tot_grand,$tot);
	?> 

  <table width="100%" border="0">
  <tr>
    <td width="59%" class="style2">School Code:&nbsp;&nbsp;<?php echo($fees_details[$j]['schoolcode']); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="39%" class="style2">School Name:&nbsp; 
      <?php  echo($fees_details[$j]['schoolname']); ?>
      &nbsp;&nbsp;&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    </tr>
</table>
<table width="95%" border="0" align="center">
  <tr>
    <td height="40">&nbsp;</td>
    <td><div align="center">Registration Fee</div></td>
    <td width="26%"align="left">Participation Fee</td>
    <td width="22%" align="left">Total</td>
  </tr>
 

  <tr>
    <td width="32%" align="left">U.P Section </td>
    <td width="20%">&nbsp;&nbsp;   <?php echo ($fees_details[$j]['up_afli']); ?></td>
    <td width="26%"> <?php echo ($fees_details[$j]['up_part']); ?></td>
    <td width="22%"><?php echo (($fees_details[$j]['up_afli'])+($fees_details[$j]['up_part'])); ?></td>
  </tr>
  <tr>
    <td align="left">HS Section</td>
    <td> &nbsp;&nbsp;&nbsp;<?php echo ($fees_details[$j]['hs_afli']); ?></td>
    <td> <?php echo ($fees_details[$j]['hs_part']); ?></td>
    <td><?php echo (($fees_details[$j]['hs_afli'])+($fees_details[$j]['hs_part'])); ?></td>
  </tr>
  
  <tr>
    <td align="left">HSS Section</td>
    <td> &nbsp;&nbsp;<?php echo ($fees_details[$j]['hss_afli']); ?></td>
    <td>  <?php echo ($fees_details[$j]['hs_part']); ?></td>
    <td><?php echo  (($fees_details[$j]['hss_afli'])+($fees_details[$j]['hs_part'])); ?> </td>
  </tr>
  <tr>
    <td height="29" align="left">VHSE Section</td>
    <td> &nbsp;&nbsp;<?php echo ($fees_details[$j]['vhss_afli']); ?></td>
    <td>  <?php echo ($fees_details[$j]['vhss_part']); ?></td>
    <td><?php echo (($fees_details[$j]['vhss_afli'])+($fees_details[$j]['vhss_part'])); ?></td>
  </tr>
  <tr><td colspan="4" align="right">Grand Total :&nbsp;<?php echo $tot; ?></td></tr>
</table>
	<? 
		}
			} 
			$grand_tot=array_sum($tot_grand);
	?>
	<table align="center" width="100%"><tr><td align="center" class="style1" bgcolor="#999999" height="25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grand Total : &nbsp;<?php echo $grand_tot; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td></tr></table>


</page>
