<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 11px;
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
<page >
	<page_header>
		<table width="100%" style="width: 100%;">
			
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
		</table>
	</page_header>
<page_footer>
<table width="102%" style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			 <tr>
				<td style="text-align: center;width: 100%" class="style4">Report Generated From       on <?php echo date("F j, Y, g:i a");  	?>			</td>
			</tr>
		</table>
</page_footer>       
        <table width="83%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td align="center" class="style1" height="30">Call sheet</td>
        </tr>
        </table>
        <table width="100%" align="center" >
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
         <td width="46%">&nbsp;</td>
         <td width="3%"></td>
       </tr>
       <?php
	   if($fees_details[0]['time_type']=='M') $timetype='Minite';
	   else  if($fees_details[0]['time_type']=='S') $timetype='Second';
	   
	   
	   ?>
       <tr>
    <td width="45%" class="style2" align="left">Venue : 
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fees_details[0]['stage_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </td>
       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td colspan="2" class="style2" align="left">Date &amp; Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fees_details[0]['start_time']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   </tr>
         <tr>
    <td class="style2" align="left">&nbsp;Item Code:&nbsp; <?php echo $fees_details[0]['item_code']; ?></td>
    <td >  </td>
    <td colspan="2"><span class="style2">&nbsp;Item Name:&nbsp;&nbsp; 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fees_details[0]['item_name']; ?></span></td>
    </tr>
        <tr>
    <td class="style2" align="left">Call sheet:&nbsp;&nbsp;&nbsp;<?php echo $fees_details[0]['fest_name']; ?></td>
    <td width="6%">  </td>
    <td align="left" colspan="2" class="style2">&nbsp;Maximum Time: &nbsp;&nbsp;<?php echo $fees_details[0]['max_time'].'  '.$timetype; ?></td>
  
        </tr>
         <tr>
    <td class="style2">&nbsp;Stage No.&nbsp;: &nbsp;&nbsp;<?php echo $fees_details[0]['stage_name']; ?></td>
    <td>  </td>
    <td align="left" class="style2">&nbsp;</td>
   
    <td align="left" class="style2">&nbsp;</td>
  </tr>
        </table><br><br>
       
        

        <table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" class="style2"  style="border: 0 0px 1px 0 #000000;" height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sl.No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="style2"  height="25" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="style2"  height="25" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cluster&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="style2"  height="25" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="23%" align="center" class="style2"  height="25" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature  of Participant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="14%" align="center" class="style2"  height="25" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remarks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
   <?php
   $s=0;
   if(count($fees_details)>0){
		for($j=0; $j<count($fees_details); $j++){
		$s++;
		
		
		?>
  <tr>
    <td  align="center" style="border: 0 0px 1px 0 #000000;"><?php echo $s; ?></td>
    <td  align="center" style="border: 0 0px 1px 0 #000000;"><?php echo $fees_details[$j]['participant_id']; ?> </td>
    <td  align="center" style="border: 0 0px 1px 0 #000000;"><?php echo $fees_details[$j]['cluster_no']; ?></td>
    <td width="17%"  style="border: 0 0px 1px 0 #000000;">&nbsp;</td>
    <td style="border: 0 0px 1px 0 #000000;">&nbsp;</td>
    <td style="border: 0 0px 1px 0 #000000;">&nbsp;</td>
  </tr>
  <? } 
	  }
	?>
 
</table>
<table width="100%" border="0" align="left">
<tr><td>&nbsp;</td><td></td><td></td><td></td></tr>
  <tr>
    <td colspan="2" class="style2"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;Total No. of Participants  Registered</td>
    <td colspan="2"><?php //echo ; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left" class="style2"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Total No. of Participants  Reported </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="2" align="left" class="style2">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    No of Participants staged the  item</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="254" height="21" class="style2" colspan="4">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Result Declared at&nbsp;&nbsp;&nbsp;&nbsp;
   on
    &nbsp;&nbsp;by Judges
  </td></tr>
  <tr>
   
    <td class="style2" align="right" colspan="3">&nbsp;&nbsp;&nbsp;</td>
    <td class="style2" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature of stage manager:</td>
  </tr>
</table>

        </page>
       
		
		