<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
-->
</style>
<page backtop="10mm" backbottom="10mm ">
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
				<td style="text-align: center;width: 100%">				</td>
			</tr>
		</table>
</page_footer>       
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td><div align="center" class="style1">
          <div align="center">Registration Fee</div>
        </div></td>
        </tr>
        </table>
        <table width="83%" border="0" align="center">
  <tr>
    <td width="15%"><strong>School  Code:</strong></td>
                             
          <td width="59%"><strong>School/Sub dist:</strong></td>    </tr>
</table>

        <table width="83%" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
    <td><div align="center">Registration Fee</div></td>
    <td width="18%"><div align="center">Participation Fee</div></td>
    <td width="13%"><div align="center">Total</div></td>
  </tr>
  <?php 
  		if($fees_details['up_fee']['afliation']=="")
  		$fees_details['up_fee']['afliation']=0;
 		 
	?> 

  <tr>
    <td width="14%"><div align="center">U.P Section</div></td>
    <td width="17%">&nbsp;&nbsp;      <?php $fees_details['up_fee']['afliation'] ;?></td>
    <td width="36%"> <?php $fees_details['up_fee']['participant'] ;?></td>
    <td width="33%">&nbsp;</td>
    </tr>
  <tr>
    <td><div align="center">HS Section</div></td>
    <td> <?php $fees_details['hs_fee']['afliation'] ;?></td>
    <td> <?php $fees_details['hs_fee']['participant'] ;?></td>
    <td>&nbsp;</td>
    </tr>
  
  <tr>
    <td> <div align="center">HSS Section</div></td>
    <td> <?php $fees_details['hss_fee']['afliation'] ;?></td>
    <td> <?php $fees_details['hss_fee']['afliation'] ;?></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="29"><div align="center">VHSE Section</div></td>
    <td> <?php $fees_details['up_fee']['afliation'] ;?></td>
    <td> <?php $fees_details['up_fee']['afliation'] ;?></td>
    <td>Grand Total :</td>
  </tr>
</table>

	    </page>
       
		