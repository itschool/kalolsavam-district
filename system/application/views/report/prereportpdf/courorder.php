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
.tb{
font-size: 10px;
	font-weight: bold;
	color:#000000;}
	
.ety{
	font-size: 10px;
	color:#000000;
	}
-->
</style>
	
	 
<page backtop="20mm" backbottom="20mm ">
	<page_header>
	</page_header>
<page_footer>
<table style="width: 100%;">
	<tr><td style="width: 100%"><hr/></td></tr>
    <tr>
	<td style="text-align: center;width: 100%" class="style4">Report Generated From       on <?php echo date("F j, Y, g:i a");  	?>			</td>
  </tr></table>
</page_footer>       
        <table width="103%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td height="31" align="center" class="style1" valign="top">&nbsp;&nbsp;List of  participants &nbsp;&nbsp;With Court Order</td>
        </tr>  
        <tr><td align="center" class="style9"><?php echo $subdistrict[0]['sub_dist']; ?>&nbsp; </td></tr>
        </table>
        
        
       
  <table width="100%" border="0" align="center">
  <tr>
    <td width="23%" class="style9" align="right" colspan="4">&nbsp;&nbsp;&nbsp;<span class="style3">Festival: &nbsp;&nbsp;<?php echo $appeal[0]['fest_name']; ?> &nbsp;&nbsp;</span></td>
    
    </tr>
    <tr><td colspan="4" height="10"></td></tr>
</table>


 <table width="130%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="9%" height="30" align="center"  class="tb" style="border-right:1px #000000; padding:2px;" >&nbsp;&nbsp;&nbsp;&nbsp;Sl.No&nbsp;&nbsp;</td>
    <td width="24%"align="center" class="tb" style="border-right:1px #000000; padding:2px;" >&nbsp;Register Number&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="22%" align="center" class="tb" style="border-right:1px #000000; padding:2px;" >&nbsp;&nbsp;&nbsp;Name of Participant</td>
    <td width="9%" align="center" class="tb" style="border-right:1px #000000; padding:2px;" >&nbsp;Item Code</td>
    <td width="7%" align="center" class="tb" style="border-right:1px #000000; padding:2px;">&nbsp;&nbsp;Item Name&nbsp;&nbsp;</td>
    <td width="7%" align="center" class="tb" style="border-right:0px #000000; padding:2px;">Date of Item </td>
    
   </tr>
     <?php
			$count	=	0;
		 for($j = 0; $j < count($appeal); $j++){
		 if(($appeal[$j]['spo_id']!=1)||($appeal[$j]['spo_id']!=2)||($appeal[$j]['spo_id']!=3)||($appeal[$j]['spo_id']!=9)||($appeal[$j]['spo_id']!=10)){
	 		$count++;
			$datt=datetophpmodel($appeal[$j]['sdt']);
      ?>
  <tr>
    <td height="25"align="center" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;" >&nbsp;&nbsp;<?php echo $count;?></td>
    <td align="left" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $appeal[$j]['participant_id']; ?></td>
    <td align="left" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;" >&nbsp;&nbsp;<?php echo wordwrap($appeal[$j]['participant_name'],20,"<br/>"); ?></td>
    <td align="center" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $appeal[$j]['item_code']; ?></td>
    <td align="left" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;" >&nbsp;&nbsp;<?php echo $appeal[$j]['item_name']; ?></td>
   <td align="left" class="ety" style="border-top:1px #000000; border-right:0px #000000; padding:2px;" >&nbsp;&nbsp;<?php echo $datt; ?></td>
   </tr>
  		<?php
		    }
			}
 		 ?>
</table>

</page>
       
		