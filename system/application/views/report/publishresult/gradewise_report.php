<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	color:#000000;
}
.style3{ 
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}


-->
</style>
<style>
@media print
{
h1 {page-break-before:always}
}
</style>
		<?php
				$prevfestid="";
				$j=0;
				$h=1;
				$prev_itemcode="";
				
				
		foreach($gradewise as $value){
			if($value['is_publish']!='N'){
				
				
					if($prevfestid!=$value['fest_id']){
					$count=0;
						$prevfestid=$value['fest_id'];
						$prev_itemcode="";
						if($j!=0){
						
						print("</table></page>");
						
						}
		?>
<page backtop="20mm" backbottom="20mm " >
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
	</page_header>
<page_footer>
 <table width="91%" align="left" border="0" cellpadding="0" cellspacing="0" >  
            <tr> 
            		<td width="100" align="right" >*Appeal Entry</td>
            </tr>
         </table>
	<?php
		$this->load->view('report/report_footer');
	?>
     <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
      <tr> <td  align="left" width="80" height="20" valign="top"><?php echo $h++; ?></td></tr>
      </table>
</page_footer>       

   
<table width="77%" border="0" cellspacing="0" cellpadding="0" align="center" >
		
<tr>
        <td height="30" align="center" class="style1">Grade Wise Report&nbsp;&nbsp;<?php echo $value['fest_name']; ?></td>
  </tr>
  
</table>
       
	 <table width="91%" align="center" border="1" cellpadding="0" cellspacing="0" >
     <?php
		if($grade!='ALL'){
		?>
      
		<tr><td colspan="6" height="25" class="style1" align="center" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">List of Participants with <b><?php echo $value['grade']; ?> Grade</b> </td></tr>
       <?php
	   }
	   ?>
        
    		 <tr>
            <td height="30" width=30  align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;Sl.No&nbsp;</td>
            <td width=175 align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Name of Participant</td>
             
            <td width=190 align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">School Name</td>
             <td width=175 align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Item</td>
             <?php
				if($grade=='ALL'){
				?>
            <td width="40" align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Grade</td>
             <?php } ?>
             <td width="40" align="center" class="style3" style=" border-bottom:1px #000000; border-right:0px #000000; padding:2px;">Point</td>
            </tr>
            
		<? 
		}
		$count++;
		$j++;
				//if($value['is_taken']=='N')
				if($value['spo_id'] > 0)
				$withart='*';
				else
				$withart='';
				
        ?>
            <tr>
            <td height="30" width="30" align="center" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:0px;"><?php echo $count; ?></td>
            <td width="175" align="left" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:0px;">&nbsp;<?php echo $withart.wordwrap($value['participant_name'],33,'<br>'); ?></td>
            <td width="190" align="left" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:0px;">&nbsp;<?php echo wordwrap($value['school_code'].'-'.$value['school_name'].' ('.$value['sub_district_code'].' - '.$value['sub_district_name'],40,'<br>'); ?> )</td>
            <td width="175" align="left" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:0px;">&nbsp;<?php echo wordwrap($value['item_code'].'-'.$value['item_name'],30,'<br>');; ?></td>
           <?php
				if($grade=='ALL'){
				?>
            <td width="40" align="center" class="style2" style="border-bottom:1px #000000; border-right:1px #000000; padding:0px;"><?php echo $value['grade']; ?></td>
           <?php
		   }
		   ?>
            <td width="40" align="center" class="style2" style="border-bottom:1px #000000; border-right:0px #000000; padding:0px;"><?php echo $value['point']; ?></td>
            </tr>
            
            
         
            
		 <? 
        	 } 
		 }
		 ?>
</table>
         
            
  </page>
