<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style3{
	font-size: 12px;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.style5{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
-->
</style>

<page backtop="20mm" backbottom="20mm" pageleft="50mm" >
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"  >
   <tr>
        <td height="43" align="center" class="style1">Cluster Report</td>
  </tr>
  
  <tr>
    <td align="center" class="style2" height="20">Festival :&nbsp;&nbsp;<?php echo $retdata[0]['fest_name']; ?></td>
  </tr>
  </table>
  <?php
  		
        	$prev_cluster="";$clustarray=""; $item_code="";$prev_array="";
			
			for($j=0;$j<count($retdata); $j++){
			
			
			if(($prev_cluster!=$retdata[$j]['cluster_no'])||($item_code!=$retdata[$j]['item_code'])){
				$prev_cluster=$retdata[$j]['cluster_no'];
				$prev_array=$clustarray;
				$clustarray="";
				$clustarray=$retdata[$j]['participant_id'];
					if($j!=0){
				?>
				<table align="left" style="width:100%;" ><tr><td width="50"></td><td class="style3" height="25" valign="top" >
               <span class="style5"> Cluster &nbsp;&nbsp; <?php echo $retdata[$j-1]['cluster_no']; ?>:</span>&nbsp;&nbsp;&nbsp;<?php echo wordwrap($prev_array,120,'<br>'); ?>  </td></tr></table>
               
				<?php
						}
				}
				else {
				$clustarray=$clustarray.',  '.$retdata[$j]['participant_id'];
				?>	
				


			<?php
					}
			
			if($item_code!=$retdata[$j]['item_code']){
				$item_code=$retdata[$j]['item_code'];
				
			?>
             <table width="100%" style="width: 100%;">
			
			<tr><td style="width: 100%" height="10"><hr/></td></tr></table>
   							 
 
<table  align="center" width="100%"  >
  <tr>
    <td  align="left" class="style2" height="20">Item:&nbsp;&nbsp;&nbsp;<?php echo $retdata[$j]['item_code'].' -  '.$retdata[$j]['item_name']; ?>&nbsp;&nbsp;</td>
    <td colspan="2"  align="center" class="style2" height="20"><?php //echo $retdata[$j]['item_name']; ?>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td  align="left" colspan="2" class="style2" height="20"><?php echo $retdata[$j]['stage_name'].' - '.$retdata[0]['stage_desc'].'  on  '.datetophpmodel($retdata[$j]['stime']).'  at  '.timephpmodel($retdata[$j]['stime']); ?>&nbsp;</td>
    <td class="style2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maximum 
      Time for item :&nbsp;&nbsp;<?php echo $retdata[$j]['max_time']; ?></td>
  </tr>
  
</table>
		<?php
		}
					}
			$prev_array=$clustarray;
			?>
          <table align="left" width="100%">  <tr><td width="50"></td><td class="style3" ><span class="style5">Cluster &nbsp;&nbsp; <?php echo $retdata[$j-1]['cluster_no']; ?>:</span>&nbsp;&nbsp;&nbsp;<?php echo wordwrap($prev_array,120,'<br>'); ?>  </td></tr></table>

        </page>
       
		
		