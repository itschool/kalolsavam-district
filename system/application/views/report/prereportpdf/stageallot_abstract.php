<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 11px;
	font-weight: bold;
	color: black;
}
.style3 {
	font-size: 12px;
	color:black;
}
</style>

<page backtop="30mm" backbottom="20mm">
		<page_header>
    	<?php
			  $this->load->view('report/report_header');
		 ?>
         <table align="center" width="100%">
         <tr><td align="center" class="style1"> Stage Report(Abstract)</td></tr>
         </table>
	    </page_header>
        
         <page_footer>
	     <?php
		      $this->load->view('report/report_footer');
	     ?>
    </page_footer>  
    
    <table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50" rowspan="2" align="center" class="style2" style="border-bottom:0px #000000; border-right:1px #000000; padding:0px;">Stage</td>
    <td width="100" rowspan="2" align="center" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:0px;">Date</td>
    <td colspan="9" width="500" align="center" style="border-bottom:1px #000000; border-right:0px #000000; padding:0px;">Number of Items</td>
  </tr>
  <tr>
    <td width="50" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">LP General</td>
    <td width="50" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">UP General</td>
    <td width="50" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">HS General </td>
    <td width="50" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">HSS General</td>
    <td  width="50" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">UP Sanskrit</td>
     <td width="50" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">HS Sanskrit</td>
    <td width="50" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">LPArabic</td>
    <td width="50" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">UPArabic</td>
    <td width="50" class="style2" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">HS Arabic</td>
  </tr>
  
  		<?php
		$prev_stageid="";
		$prevdate="";
		$cnt=1;
		
		for($j=0;$j<count($abstract);$j++){
		//if($cnt==10)$cnt=1;
		
		
				$timet=datetophpmodel($abstract[$j]['dt']);
				
					if($prev_stageid!=$abstract[$j]['stage_id']){
					
						if(($j!=0)&&($cnt!=10)){
								for($i=$cnt;$i<10;$i++){
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
									}
							}
								
					
					if($cnt==10)$cnt=1;
							if($j!=0) print("</tr>");
					
							$prev_stageid=$abstract[$j]['stage_id'];
							$prevdate=$abstract[$j]['dt'];
							$stage_name=$abstract[$j]['stage_name'];
							
							print("<tr><td class='style3' valign='bottom'  align='center' style='border-top:1px #000000; border-right:1px #000000; padding:0px;'>$stage_name</td>
									  <td class='style3'  align='center' style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$timet</td>");
						  }
						  else{
						   if($prevdate!=$abstract[$j]['dt']){
						  		$prevdate=$abstract[$j]['dt'];
						  	if(($j!=0)&&($cnt!=10)){
								for($i=$cnt;$i<10;$i++){
							print("<td class='style3'  align='center' style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
									}
							}
							if($cnt==10) $cnt=1;
							
							if($j!=0)
							print("</tr>");
							
						  	print("<tr> <td class=style3  style='border-bottom:0px #000000; border-right:1px #000000; padding:0px;'></td>
							 <td  class=style3 align=center  style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$timet</td>");
						  }
						  }
						  
						 
						
						   		$itcode=$abstract[$j]['itcode'];
							
			
						if($abstract[$j]['fest_id']==1){
					
							print("<td class=style3 align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'> $itcode</td>");
							$cnt++;
					}
					if($abstract[$j]['fest_id']==2){
							if($cnt!=2){
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
							}
					print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$itcode</td>");
					$cnt++;
					}
					
					if($abstract[$j]['fest_id']==3){
							for($i=$cnt;$i<3;$i++){
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
							}
					
					print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$itcode</td>");
					$cnt++;
					}
					
					if($abstract[$j]['fest_id']==4){
							for($i=$cnt;$i<4;$i++){
							print("<td align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;

							}
					print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$itcode</td>");
					$cnt++;
					}
					
					if($abstract[$j]['fest_id']==5){
							for($i=$cnt;$i<5;$i++){
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
							
							}
					
					print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$itcode</td>");
					$cnt++;
					}
					
					if($abstract[$j]['fest_id']==6){
							for($i=$cnt;$i<6;$i++){
							
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
							}
					
					
					print("<td  class=style3 align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$itcode</td>");
						$cnt++;
					}
					if($abstract[$j]['fest_id']==7){
							for($i=$cnt;$i<7;$i++){
							
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
							}
					print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$itcode</td>");
						$cnt++;
					}
					
					if($abstract[$j]['fest_id']==8){
							for($i=$cnt;$i<8;$i++){
							
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
							}
					print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>$itcode</td>");
						$cnt++;
					}
					
					if($abstract[$j]['fest_id']==9){
							for($i=$cnt;$i<9;$i++){
							
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
							}
					print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:0px #000000; padding:0px;'>$itcode</td>");
					$cnt++;
					}
					
					
		
		}
		if(($j!=0)&&($cnt!=10)){
								for($i=$cnt;$i<10;$i++){
							print("<td class=style3  align=center style='border-bottom:1px #000000; border-right:1px #000000; padding:0px;'>0</td>");
							$cnt++;
									}
							}
		?>
  
  
  </tr>
 
</table>


</page>