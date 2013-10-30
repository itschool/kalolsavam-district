<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 12px;
	color: black;
}
.style3 {
	font-size: 11px;
	font-weight: bold;
	color: black;
}
.style9 {
	font-size: 12px;
	font-weight: bold;
	color: black;
}
-->
</style>
<page backtop="25mm" backbottom="10mm">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       
     
        <table width="103%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td align="center" class="style1" height="27">Registration Fee Details </td>
</tr> 
 
 </table>

<table align="center" width="100%" border="1" cellpadding="0" cellspacing="0">
<tr>
    <td width="25" align="center" class="style3" style="border-right:1px #000000; padding:2px;" height="30">Sl.No.</td>
    <td width="240" align="left" class="style3" style="border-right:1px #000000; padding:2px;" height="30">School</td>
    <td width="65" align="left" class="style3" style="border-right:1px #000000; padding:2px;">UP section<br />(Amt in Rs)</td>
    <td width="65" align="left" class="style3" style="border-right:1px #000000; padding:2px;">HS section<br />(Amt in Rs)</td>
    <td width="65" align="left" class="style3" style="border-right:1px #000000; padding:2px;">HSS section<br />(Amt in Rs)</td>
    <td width="70" align="left" class="style3" style="border-right:1px #000000; padding:2px;">VHSE section<br />(Amt in Rs)</td>
    <td width="65" align="left" class="style3" style="border-right:1px #000000; padding:2px;">Total <br />(Amt in Rs)</td>
    <td width="80" align="left" class="style3" style="border-right:0px #000000; padding:2px;">Remarks</td>

</tr>
		<?php
		
		
		$tot_grand=array();
		$up_grand=array();
		$hs_grand=array();
		$hss_grand=array();
		$vhss_grand=array();
		$count=0;
		
		for($j=0; $j<count($fees_details); $j++){
		
		$tot=(($fees_details[$j]['up_afli'])+($fees_details[$j]['up_part']))+
		(($fees_details[$j]['hs_afli'])+($fees_details[$j]['hs_part']))+
		(($fees_details[$j]['hss_afli'])+($fees_details[$j]['hss_part']))+
		(($fees_details[$j]['vhss_afli'])+($fees_details[$j]['vhss_part']));
		
		if($tot!=0){
		
		$up=(($fees_details[$j]['up_afli'])+($fees_details[$j]['up_part']));
		$hs=(($fees_details[$j]['hs_afli'])+($fees_details[$j]['hs_part']));
		$hss=(($fees_details[$j]['hss_afli'])+($fees_details[$j]['hss_part']));
		$vhss=(($fees_details[$j]['vhss_afli'])+($fees_details[$j]['vhss_part']));
		array_push($tot_grand,$tot);
		array_push($up_grand,$up);
		array_push($hs_grand,$hs);
		array_push($hss_grand,$hss);
		array_push($vhss_grand,$vhss);
		$count++;
		
		
	?> 


  <tr>
   <td class="style2"  align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $count; ?></td>
    <td class="style2"  align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo(wordwrap($fees_details[$j]['schoolcode'].' - '.$fees_details[$j]['schoolname'],40,'<br>')); ?></td>
    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo (($fees_details[$j]['up_afli'])+($fees_details[$j]['up_part'])); ?></td>
    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo (($fees_details[$j]['hs_afli'])+($fees_details[$j]['hs_part'])); ?></td>
    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo  (($fees_details[$j]['hss_afli'])+($fees_details[$j]['hss_part'])); ?> </td>
    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo (($fees_details[$j]['vhss_afli'])+($fees_details[$j]['vhss_part'])); ?></td>
 <td  align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $tot; ?></td>
 <td style="border-top:1px #000000; border-right:0px #000000; padding:2px;"></td></tr>

	<? 
		}
			} 
			$grand_tot=array_sum($tot_grand);
			$up_tot=array_sum($up_grand);
			$hs_tot=array_sum($hs_grand);
			$hss_tot=array_sum($hss_grand);
			$vhss_tot=array_sum($vhss_grand);
	?>
    <tr>
    <td class="style3" height="27" colspan="2" align="right" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"> Grand Total  </td> 
    <td class="style3" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $up_tot; ?></td> 
    <td class="style3" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $hs_tot; ?></td> 
    <td class="style3" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $hss_tot; ?></td>
     <td class="style3" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $vhss_tot; ?></td> 
    <td  class="style3"style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $grand_tot; ?></td><td style="border-top:1px #000000; border-right:0px #000000; padding:2px;"></td></tr>
    </table>
	


</page>
