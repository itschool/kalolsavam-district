<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
-->
</style>
<page >
	<page_header>

	</page_header>
<page_footer>
<table width="100%">
			<tr>
				<td style="width: 100%" height="1"></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">				</td>
			</tr>
  </table>
</page_footer>       
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
        <tr><td height="20"></td></tr>
<tr>
        <td height="30" align="center" class="style1">List of Eligible Schools</td>
  </tr>
  </table>
        <table width="100%" align="center" >
        
     <tr>
    <td height="21" align="center" class="style3">&nbsp;&nbsp;&nbsp;Sl.No&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="left" class="style3">School Name</td>
     
    </tr>
    <? $s=1;
	for($j=0;$j<count($school_details);$j++){
	
	?>
  	<tr>
    <td width="5%" align="center"><?php echo $s; ?></td>
    <td width="27%" align="center"><?php echo $school_details[$j]['school_code']; ?></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="14%" align="left"><?php echo $school_details[$j]['school_name']; ?></td>
    </tr>
 	 <? 
		 $s++;
 		}
	?>
</table>

        </page>
