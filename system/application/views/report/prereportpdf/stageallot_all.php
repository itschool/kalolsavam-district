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
font-size: 11px;
	font-weight: bold;
	color:#000000;}
	
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
		
        <?php
			 
			  $prev_festid="";
			  for($j = 0; $j < count($allot); $j++){
			  
			   if($allot[$j]['time_type']=='M') $timetype='Min';
			   else  if($allot[$j]['time_type']=='S') $timetype='Sec';
			   
			   $total_time_for_item	=	($allot[$j]['time_type'] == 'S') ? ceil((int)$allot[$j]['max_time'] / 60) : (int)$allot[$j]['max_time'];	
			   
			   if($allot[$j]['is_off_stage']=='N'){
			   		$time		=	$total_time_for_item * $allot[$j]['pdcount'];
					$time		=	get_time_format($time);
			   }
			   else{
			   		$time		=		get_time_format($total_time_for_item);
			   }
			   
			   if($allot[$j]['item_type']=='S')
			  	 $tot_part=$allot[$j]['pdcount'];
				else  if($allot[$j]['item_type']=='G'){
					for($k=0;$k<count($groups);$k++){
						if($groups[$k]['item_code']==$allot[$j]['item_code']){
						$tot_part=$groups[$k]['cpid'];
						}
					}
				}
				 else
				  $tot_part="";
			   
	 			if($prev_festid!=$allot[$j]['fest_id']){
						$prev_festid=$allot[$j]['fest_id'];
						
							if($j!=0){
								print("</table></page>");
								}
				$count	=	0;
	  ?>
	
	 
<page backtop="37mm" backbottom="20mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="123%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td height="31" align="center" class="style1" valign="top">Number of Participants and duration for stage allotment<br /><?php echo $allot[$j]['fest_name']; ?></td>
        </tr>  
</table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       

 <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td width="30"  align="center"  class="tb" style="border-right:1px #666666; padding:2px;" >Sl.No.</td>
    <td width="220"  align="left"  class="tb" style="border-right:1px #666666; padding:2px;" >Item</td>
    <td width="60" align="center" class="tb" style="border-right:1px #666666; padding:2px;" >Time</td>
    <td width="60" align="center" class="tb" style="border-right:1px #666666; padding:2px;" >No. of Participants</td>
    <td width="70" align="left" class="tb" style="border-right:1px #666666; padding:2px;">Time for completion</td>
    <td width="50" align="center" class="tb" style="border-right:1px #666666; padding:2px;">Stage</td>
    <td width="100" align="center" class="tb" style="border-right:0px #666666; padding:2px;">Date Time</td>
   </tr>
		<?php
		}
		$count++;
		?>
		
  <tr>
    <td align="center" class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ><?php echo $count; ?></td>
  <td align="left" class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $allot[$j]['item_code'].' - '.$allot[$j]['item_name']; ?></td>
    <td align="center" class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ><?php echo $allot[$j]['max_time'].'  '.$timetype; ?></td>
    <td align="center" class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo  $tot_part; ?></td>
    <td align="left" class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ><?php echo $time; ?></td>
    <td align="left" class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ></td>
    <td align="left" class="ety" style="border-top:1px #666666; border-right:0px #666666; padding:2px;" ></td>
   </tr>
  		<?php
		    }
 		 ?>
</table>

</page>
       
		