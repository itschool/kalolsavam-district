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
.style6{
	font-size: 12px;
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
				$prevschoolcode="";
				$prev_festid="";
				$j=0;
				$arraypoint=array();
				
		foreach($grade as $value){
				
				if($value['is_publish']!='N'){
				
					if($prevschoolcode!=$value['school_code']){
						$count=0;
						$prev_festid="";
						$prevschoolcode=$value['school_code'];
						
							if($j!=0){
							
								$tot_point=0;
								$tot_point=array_sum($arraypoint);
								$arraypoint=array();
								
		?>
    <tr>
         <td colspan="5" align="right" class="style3"  style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Total Point</td>
         <td align="center" class="style3" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $tot_point; ?></td>
    </tr>
    
                        <?php
						
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
        <?php
            $this->load->view('report/report_footer');
        ?>
    </page_footer>       

   
<table width="77%" border="0" cellspacing="0" cellpadding="0" align="center" >
	<tr>
        <td height="30" align="center" class="style1">Grade Wise Report</td>
  </tr>
</table>
       
	 <table width="91%" align="center" border="1" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="6" align="center" class="style6" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $value['school_name'].' ('.$value['school_code'].')'; ?></td>
        </tr>
        <?php
		} 
		
		if($prev_festid!=$value['fest_id']){
		
				$tot_point=0;
				$prev_festid=$value['fest_id'];
				$tot_point=array_sum($arraypoint);
				$arraypoint=array();
				if(($j!=0)&&($count!=0)){
		?>
        <tr>
        	 <td colspan="5" align="right" class="style3"  style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Total Point</td>
         	<td align="center" class="style3" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $tot_point; ?></td>
       </tr>
       <?php
	   }
	   ?>
        <tr>
         	<td bgcolor="#EEEEEE" colspan="6" align="center" class="style2"  style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">Festival :<?php echo $value['fest_name']; ?></td>
       </tr>
        
    		 <tr>
           	 <td width=38  align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Sl.No</td>
          	  <td width=200 align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Item</td>
             
          	  <td width=276 align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Participant Name</td>
            
          	  <td width="52" align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Rank</td>
           	 <td width="46" align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Grade</td>
           	  <td width="50" align="center" class="style3" style=" border-bottom:1px #000000; border-right:0px #000000; padding:2px;">Point</td>
      </tr>
      
		<?php
		}
		array_push($arraypoint,$value['point']);
        
		$count++;
		$j++;
				if($value['rank']==0) $rank="--"; else $rank=$value['rank'];
        ?>
        
            <tr> 
            <td width="38"  class="style2" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $count; ?></td>
            <td width="200" class="style2" align="left" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $value['item_code'].'-'.$value['item_name']; ?></td>
            <td width="276" class="style2" align="left" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $value['participant_name']; ?></td>
            <td width="52" class="style2" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $rank; ?> </td>
            <td width="46" class="style2" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $value['grade']; ?></td>
            <td width="50" class="style2" align="center" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $value['point']; ?></td>
            </tr>
            
			 <?php
			 
       		  } 
		 }
		 
		 		$tot_point=0;
				$tot_point=array_sum($arraypoint);
				$arraypoint=array();
        ?>
          <tr>
         <td colspan="5" align="right" class="style3" height="20" style="border-bottom:0px #000000; border-right:1px #000000; padding:2px;">Total Point</td>
         <td align="center" class="style3"><?php echo $tot_point; ?></td>
       </tr>
</table>
  </page>
