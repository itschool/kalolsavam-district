<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
-->
</style>
<page backtop="20mm" backbottom="20mm ">
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
        <td align="center" class="style1" height="35">Registration Fee Details</td>
</tr>  </table>


  <table width="100%" border="0" align="center">
  <tr>
    <td width="59%"><strong>School  :&nbsp;<?php echo  $fees_details['school']['code'].' - '.$fees_details['school']['name']; ?></strong></td>
    <td width="39%"><strong> </strong></td>
    <td width="1%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    </tr>
</table><br />
<table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="40" class="style2" style="border-right:1px #000000; padding:2px;">Section </td>
    <td align="center" class="style2" style="border-right:1px #000000; padding:2px;">Registration Fee</td>
    <td width="26%"align="center" class="style2" style="border-right:1px #000000; padding:2px;">Participation Fee</td>
    <td width="22%" align="center" class="style2" style="border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <?php 
      
  
  		if($fees_details['up_fee']['afliation']=="")
  		$fees_details['up_fee']['afliation']=0;
		
	$hssect_total_sum=(( $fees_details['up_fee']['participant'])+($fees_details['up_fee']['afliation']))+
	(($fees_details['hs_fee']['afliation'])+($fees_details['hs_fee']['participant']));
	
	$higher_total_sum_hssect=(($fees_details['hss_fee']['afliation'])+($fees_details['hss_fee']['participant'] ));
	
	$vochigher_total_sum_hssect=(($fees_details['vhss_fee']['afliation'])+($fees_details['vhss_fee']['participant']));
 		 
	?> 

  <tr>
    <td width="32%" align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">U.P Section </td>
    <td width="20%" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;      <?php echo $fees_details['up_fee']['afliation'] ;?></td>
    <td width="26%" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;&nbsp;<?php echo $fees_details['up_fee']['participant']; ?></td>
    <td width="22%" style="border-top:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;<?php echo(( $fees_details['up_fee']['participant'])+($fees_details['up_fee']['afliation'])); ?></td>
  </tr>
  <tr>
    <td align="left" style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;">HS Section</td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;&nbsp;&nbsp;<?php echo $fees_details['hs_fee']['afliation'] ;?></td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;&nbsp;<?php echo $fees_details['hs_fee']['participant'] ;?></td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;<?php echo(($fees_details['hs_fee']['afliation'])+($fees_details['hs_fee']['participant'])); ?></td>
  </tr>
   <tr><td height="30" colspan="3" align="right" class="style2" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">Grand Total :&nbsp;</td>
  <td style="border-top:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;<?php echo $hssect_total_sum ; ?></td>
  </tr></table>
  
  
  <table width="100%" align="center"><tr><td>Office Seal</td><td  align="right" width="400" height="100"> Signature of AEO</td></tr>
   <tr><td colspan="2">-------------------------------------------------------------------------------------------------------------------------------------------</td></tr>
  </table>
  
  
  <?php
  		if($higher_total_sum_hssect!=0){
  ?>
    <table width="103%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td align="center" class="style1" height="35">Registration Fee Details </td>
</tr>  </table>


  <table width="100%" border="0" align="center">
  <tr>
    <td width="59%"><strong>School :&nbsp;<?php echo  $fees_details['school']['code'].' - '.$fees_details['school']['name']; ?></strong></td>
    <td width="39%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    </tr>
</table>
  <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="40" class="style2" style="border-right:1px #000000; padding:2px;">Section </td>
    <td align="center" class="style2" style="border-right:1px #000000; padding:2px;">Registration Fee</td>
    <td width="26%"align="center" class="style2" style="border-right:1px #000000; padding:2px;">Participation Fee</td>
    <td width="22%" align="center" class="style2" style="border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;">HSS Section</td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;&nbsp;&nbsp;<?php echo $fees_details['hss_fee']['afliation'] ;?></td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;&nbsp;<?php echo $fees_details['hss_fee']['participant'] ;?></td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;<?php echo (($fees_details['hss_fee']['afliation'])+($fees_details['hss_fee']['participant'] )); ?></td>
  </tr>
   <tr><td height="30" colspan="3" align="right" class="style2" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">Grand Total :&nbsp;</td>
  <td style="border-top:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;<?php echo $higher_total_sum_hssect ; ?></td>
  </tr>
  </table>
  
    <table width="100%" align="center"><tr><td>Office Seal</td><td  align="right" width="400" height="101"> Signature of AEO</td>
    </tr>
    <tr><td colspan="2">-------------------------------------------------------------------------------------------------------------------------------------------</td></tr>
  </table>
  
			<?php
            }
			if($vochigher_total_sum_hssect!=0){
            ?>
              <table width="103%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td align="center" class="style1" height="35">Registration Fee Details</td>
</tr>  </table>


  <table width="100%" border="0" align="center">
  <tr>
    <td width="59%"><strong>School : <?php echo  $fees_details['school']['code'].' - '.$fees_details['school']['name']; ?></strong></td>
    <td width="39%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    </tr>
</table>
  <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="40" class="style2" style="border-right:1px #000000; padding:2px;">Section </td>
    <td align="center" class="style2" style="border-right:1px #000000; padding:2px;">Registration Fee</td>
    <td width="26%"align="center" class="style2" style="border-right:1px #000000; padding:2px;">Participation Fee</td>
    <td width="22%" align="center" class="style2" style="border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td  align="left" style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;">VHSE Section</td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;&nbsp;&nbsp;<?php echo $fees_details['vhss_fee']['afliation'] ;?></td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;&nbsp;<?php echo  $fees_details['vhss_fee']['participant'] ;?></td>
    <td style=" border-bottom:0px #000000; border-top:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;<?php echo (($fees_details['vhss_fee']['afliation'])+($fees_details['vhss_fee']['participant'])); ?></td>
  </tr>
  <tr><td height="30" colspan="3" align="right" class="style2" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">Grand Total :&nbsp;</td>
  <td style="border-top:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;&nbsp;<?php echo $vochigher_total_sum_hssect ; ?></td>
  </tr></table>
  
   <table width="100%" align="center" ><tr><td>Office Seal</td><td align="right" width="400" height="50"> Signature of AEO</td></tr>
 <tr><td colspan="2">-------------------------------------------------------------------------------------------------------------------------------------------</td></tr>
</table>
		<?php
		}
		?>


</page>
