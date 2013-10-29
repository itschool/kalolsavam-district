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
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
-->
</style>
<page >
	<page_header>
  <table style="width: 100%;">
			
  </table>
	</page_header>
<page_footer>
<table width="100%" align="center">
<tr><td><hr></td></tr>
			
			<tr>
				<td align="center" style="text-align: center;width: 100%" class="style4">		Report Generated From       on <?php echo date("F j, Y, g:i a");  	?>		</td>
	</tr>
  </table>
</page_footer>       
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
<tr>
        <td height="43" align="center" class="style1">Cluster Report</td>
  </tr>
  </table>
        <table width="245%" align="center" >	
        <tr>
          <td colspan="3" align="center" class="style2" height="20">Festival :&nbsp;&nbsp;<?php echo $retdata[0]['fest_name']; ?></td>
        </tr>
        <tr>
          <td  align="left" class="style2" height="20">Item Code  :&nbsp;&nbsp;&nbsp;<?php echo $retdata[0]['item_code']; ?>&nbsp;&nbsp;</td>
          
          <td colspan="2"  align="center" class="style2" height="20">Item Name &nbsp; :&nbsp;&nbsp;&nbsp;<?php echo $retdata[0]['item_name']; ?>&nbsp;&nbsp;</td>
          
          
        </tr>
        <tr>
		
    <td  align="left" colspan="2" class="style2" height="20">Stage: &nbsp;&nbsp;<?php echo $retdata[0]['stage_name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    '.$retdata[0]['stime'].'&nbsp;&nbsp;&nbsp; at &nbsp;&nbsp;'.$retdata[0]['ttime']; ?>&nbsp;</td>
		
    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maximum 
      Time for item :&nbsp;&nbsp;<?php echo $retdata[0]['max_time']; ?></td>
  </tr></table>
		 <?php
		 $prev_clustid=""; $i=0; $serial_no="";
  		 foreach($retdata as $value){
   		 if($prev_clustid!=$value['cluster_no']){
		 $prev_clustid=$value['cluster_no'];
		 if($i!=0){
		 print("</table>");
		 }
		 $i++;
        ?>
		<br><br><br>
       <table align="center" width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr>
   
    <td height="27" align="center" class="style2"  style="border: 0 0px 1px 0 #000000;">Cluster :<?php echo $value['cluster_no']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
    <td height="27"  align="center" class="style3"  style="border: 0 0px 1px 0 #000000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration No. of Participants&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     
    </tr>
    <tr>
    
    <td width="27%" align="center"  style="border: 0 0px 1px 0 #000000;" colspan="2"><?php echo $value['participant_id']; ?></td>
   
    </tr>
  <?php
   }
    
  	$serial_no=$serial_no.'  '.$value['participant_id'];
   
	} 
	?>
 	</table>	
        </page>
