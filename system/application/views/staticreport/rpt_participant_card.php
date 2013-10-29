<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 12px;
	font-weight: bold;
	color: #660033;
}
.style9{
	font-size: 10px;
	font-weight: bold;
	color: black;
}
.style3 {
	font-size: 18px;
	font-weight: bold;
	color:black;
}
.style4 {
	font-size: 12px;
	font-weight: bold;
	color:black;
}
-->
</style>
<page backtop="10mm" backbottom="10mm ">
	<page_header>
		<table style="width: 100%;">
			<tr>
				<td style="text-align: right;width: 100%"></td>
			</tr>
			
		</table>
	</page_header>
   
		<?php
		 $partid="";$tdcount=5;
		for($i=0; $i<count($fees_details); $i++){
		if($partid!=$fees_details[$i]['participant_id']){
		$partid=$fees_details[$i]['participant_id'];
		$count=1;$tdcount--;
		if($i!=0){
		print("</table><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>");
		if(($i % 2) != 0){
		print("<table>");
		for($r=0;$r<$tdcount;$r++){
		print("<tr><td colspan=6 height=30></td></tr>");
		}
		print("</table>");
		}
		}
		$datt=datetophpmodel($fees_details[$i]['datee']);
		?>

<table width="112%"  border="1" align="center" style="width: 100%; height:700" cellpadding="0" cellspacing="0">
<tr bordercolor="#000000">
		<td height="30"  colspan="7" align="center" class="style1" style="border: 0 0px 1px 0 #000000;" >	
		<?php echo $fees_details[$i]['fest_name']; ?>			</td>
</tr>
          <tr>
          <td height="22" colspan="4" class="style4" style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;Venue : <?php echo $fees_details[$i]['stage_desc']; ?></td>
  <td colspan="3" style="border: 0 0px 1px 0 #000000;" class="style4">&nbsp;&nbsp;Date: <?php echo  $datt; ?></td>
  </tr>
            <tr>
            <td height="22" colspan="7" class="style4" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;Name of Participant: 
			<?php echo $fees_details[$i]['participant_name'] ; ?></td>
  </tr> 
            <tr>
              <td height="22" colspan="7" class="style4" style="border: 0 0px 1px 0 #000000;" > &nbsp;&nbsp;&nbsp;Register No.&nbsp;&nbsp;<?php echo $fees_details[$i]['participant_id'] ; ?></td>
  </tr>  
            <tr>
              <td width="7%" height="24" align="center" class="style2" style="border: 0 0px 1px 0 #000000;"  >&nbsp;&nbsp;Sl. no.&nbsp;&nbsp;</td> <td width="7%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;Item Code&nbsp;&nbsp;</td><td width="53%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;Item &nbsp;&nbsp;</td>
            <td width="7%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;Cluster&nbsp;&nbsp;</td>
  <td width="8%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;Stage No.&nbsp;&nbsp; </td>
  <td width="16%" align="center" class="style2" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;Date&nbsp;&nbsp;</td>
  </tr>
            <?php 
			} 
			$dat_itme=datetophpmodel($fees_details[$i]['datee']);
			
			?>
             <tr>
            <td  align="center" height="20" class="style9" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;<?php echo $count; ?>&nbsp; </td>
            <td  align="center" height="20" class="style9" style="border: 0 0px 1px 0 #000000;" > &nbsp;&nbsp;<?php echo $fees_details[$i]['item_code']; ?>&nbsp;</td>
            <td align="center" class="style9" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;<?php echo $fees_details[$i]['item_name']; ?> &nbsp;</td>
            <td align="center" height="20" class="style9" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;<?php echo $fees_details[$i]['cluster_no']; ?>&nbsp; </td>
            <td align="center" height="20" class="style9" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;<?php echo $fees_details[$i]['stage_name']; ?> &nbsp;</td>
            <td align="center" height="20" class="style9" style="border: 0 0px 1px 0 #000000;" >&nbsp;&nbsp;<?php echo $dat_itme; ?>&nbsp; </td>
            </tr>
              
            <?php
        $count++;
		}
		 ?>
        
        
      
        </table>
       
       
</page>
