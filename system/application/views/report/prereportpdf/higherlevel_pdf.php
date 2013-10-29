<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
</style>
	 <?php
		 $count=0;
		 $prevfestid="";
  	 	for($j=0;$j<count($retvalue);$j++){
			$count++;
			if($prevfestid!=$retvalue[$j]['fest_id']){
			
				$prevfestid=$retvalue[$j]['fest_id'];
				if($j!=0){
				print("</table></page>");
				
				}
	?>

<page backtop="20mm" backbottom="20mm">
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
<table width="100%"  border="0" align="center">
        <tr>
            <td  align="center" height="30" valign="top" class="style1">Participants Eligible For Higher Level Competition in <?php echo $retvalue[$j]['fest_name']; ?></td>
        </tr></table>
        
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
            
        
<tr>
      <td width="35" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Sl No </td>
      <td width="175" align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Item</td>
      <td width="210" align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Name of Participant</td>
       <td width="40" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Class</td>
      <td width="200" align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>School </td>
         </tr>
        <?php
		}
		
		?>
    
    
  
    <tr>
        <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $count; ?></td>
        <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo wordwrap($retvalue[$j]['item_code'].' - '.$retvalue[$j]['item_name'],30,'<br>');?></td>
        <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo wordwrap($retvalue[$j]['participant_name'],40,'<br>');?></td>
      <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo  $retvalue[$j]['class']; ?></td>
      <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo wordwrap($retvalue[$j]['school_code'].' - '.$retvalue[$j]['school_name'],40,'<br>'); ?></td>
        
  </tr>
	  <?php 
      
	   }
       ?>
         
</table>
</page>
