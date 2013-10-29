<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
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


  <table width="100%" border="0">
  <tr>
    <td width="59%"><strong>School  Code:&nbsp;<?php echo $fees_details['school']['code']; ?></strong></td>
    <td width="39%"><strong>School Name:<?php echo $fees_details['school']['name']; ?> </strong></td>
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
  <?php 
  
  		if($fees_details['up_fee']['afliation']=="")
  		$fees_details['up_fee']['afliation']=0;
		
	$total_sum=(( $fees_details['up_fee']['participant'])+($fees_details['up_fee']['afliation']))+
	(($fees_details['hs_fee']['afliation'])+($fees_details['hs_fee']['participant']))+
	(($fees_details['hss_fee']['afliation'])+($fees_details['hss_fee']['participant'] ))+
	(($fees_details['vhss_fee']['afliation'])+($fees_details['vhss_fee']['participant']));
 		 
	?> 

  <tr>
    <td width="32%" align="left">U.P Section </td>
    <td width="20%">&nbsp;&nbsp;      <?php echo $fees_details['up_fee']['afliation'] ;?></td>
    <td width="26%"> &nbsp;&nbsp;<?php echo $fees_details['up_fee']['participant']; ?></td>
    <td width="22%"><?php echo(( $fees_details['up_fee']['participant'])+($fees_details['up_fee']['afliation'])); ?></td>
  </tr>
  <tr>
    <td align="left">HS Section</td>
    <td> &nbsp;&nbsp;&nbsp;<?php echo $fees_details['hs_fee']['afliation'] ;?></td>
    <td> &nbsp;&nbsp;<?php echo $fees_details['hs_fee']['participant'] ;?></td>
    <td><?php echo(($fees_details['hs_fee']['afliation'])+($fees_details['hs_fee']['participant'])); ?></td>
  </tr>
  
  <tr>
    <td align="left">HSS Section</td>
    <td> &nbsp;&nbsp;&nbsp;<?php echo $fees_details['hss_fee']['afliation'] ;?></td>
    <td> &nbsp;&nbsp;<?php echo $fees_details['hss_fee']['participant'] ;?></td>
    <td><?php echo (($fees_details['hss_fee']['afliation'])+($fees_details['hss_fee']['participant'] )); ?></td>
  </tr>
  <tr>
    <td height="29" align="left">VHSE Section</td>
    <td> &nbsp;&nbsp;&nbsp;<?php echo $fees_details['vhss_fee']['afliation'] ;?></td>
    <td> &nbsp;&nbsp;<?php echo  $fees_details['vhss_fee']['participant'] ;?></td>
    <td><?php echo (($fees_details['vhss_fee']['afliation'])+($fees_details['vhss_fee']['participant'])); ?></td>
  </tr>
  <tr><td colspan="4" align="right">Grand Total :&nbsp;<?php echo $total_sum ; ?></td></tr>
</table>



</page>
