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
	font-size: 10px;
	font-weight: bold;
	color:#000000;
}
.style
-->
</style>
<page >
	
<page_footer>
<table width="100%">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">				</td>
			</tr>
  </table>
</page_footer>       
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
        <tr><td height="20"></td></tr>
<tr>
        <td height="43" align="center" class="style1">Time Sheet </td>
  </tr>
  </table>
  
        <table width="245%" align="center"  border="0" cellspacing="0">
 
        <tr>
          <td style="border: 0 1px 1px 0 #000000;" colspan="5" align="center" class="style2" height="20">Festival :&nbsp;&nbsp;
		  <?php echo $retdata[0]['fest_name']; ?></td>
        </tr>
          <tr>
          <td style="border: 0 1px 1px 0 #000000;" colspan="2" align="center" class="style2" height="20">Item :&nbsp;&nbsp;
		  <?php echo $retdata[0]['item_code']; ?></td>
          <td style="border: 0 1px 1px 0 #000000;" colspan="3" align="center" class="style2" height="20">Item :&nbsp;&nbsp;
		  <?php echo $retdata[0]['item_name']; ?></td>
        </tr>
     <tr>
    <td height="21" align="center" style="border: 0 1px 1px 0 #000000;" class="style3">&nbsp;&nbsp;&nbsp;Sl.No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" style="border: 0 1px 1px 0 #000000;" class="style3">&nbsp;&nbsp;&nbsp;&nbsp;Code   Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="center" style="border: 0 1px 1px 0 #000000;" class="style3">&nbsp;&nbsp;&nbsp;&nbsp;Start   Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="center" style="border: 0 1px 1px 0 #000000;" class="style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End   Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="center" style="border: 0 1px 1px 0 #000000;" class="style3">&nbsp;&nbsp;&nbsp;&nbsp;Remarks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <?php
    for($j=0;$j<=20;$j++){
	?>
    <tr  height="50">
    <td height="25" width="20%" style="border: 0 0px 1px 0 #000000;" >&nbsp;</td>
    <td height="25" width="20" style="border: 0 0 1px 0 #000000;">&nbsp;</td>
    <td  height="25"width="20" style="border: 0 0px 1px 0 #000000;">&nbsp;</td>
    <td height="25" width="20" style="border: 0 0px 1px 0 #000000;">&nbsp;</td>
    <td  height="25"width="20" style="border: 0 0px 1px 0 #000000;">&nbsp;</td></tr>
    <? 
	}
	 ?>
  <tr><td colspan="5" height="50">&nbsp;</td></tr>
  	<tr><td colspan="5" align="right">Name and Signature of Stage Manager</td></tr>
 	
</table>
        </page>
