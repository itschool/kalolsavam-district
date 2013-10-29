
<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
</style>

<?php      $k=0;
		   $withheldno=0;
		   $previtem="";
		   $Absent_count=0;
		  
		   $no=0;
		   for($j=0; $j<count($festresult); $j++){
			       
				   if($previtem!=$festresult[$j]['item_code']){
					$sl=0;
					 
					$temp=$previtem;
					$previtem=$festresult[$j]['item_code'];
					$this->load->model('report/timefest_model');
						$itemcount= $this->timefest_model->timeoffest_count($temp);
						$itemcount2= $this->timefest_model->timeoffest_count2($previtem);     
					 $this->Reg_no=array();
					
						   if($j!=0){
						       print("</table></page>");
						        
						   }
						
	?>   
<page backtop="30mm" backbottom="10mm ">
<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
          <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
            <td  align="left" width="400" class="style1"  style=" padding:2px;"height="25">&nbsp;&nbsp; <?php echo $festresult[$j]['item_code'];?>-<?php echo $festresult[$j]['item_name'];?>(<?php echo  $festresult[$j]['fest_name'];?>)  </td>
            <td  align="right" width="300" class="style1"  style=" padding:2px;"height="25">
               <?php echo $festresult[$j]['stage_name'].' on '.datetophpmodel($festresult[$j]['start_time']);	 ?> 
               
            </td>
          </tr>
         </table> 
  </page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');  
		 $ctt=  $festresult[$j]['no_of_judges'];
	?>
</page_footer>

          <table width="900" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
          <tr>
            <td width=20 height="25"  align="center"style='border:0 0 0.5px 0.5px 0#000000 ; height:20 px;'>Sl No</td>
            <td width=40    align="center"style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>Reg No </td>
            <td width=20    align="center"style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>Code No           </td>
            <td width=170   align="left" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>&nbsp;Name</td>
            <td width=170   align="left" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>&nbsp;School</td>
            <td align="center" width=20 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>R</td>
            <td align="center" width=20 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>G</td>
            <td align="center" width=20 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>P</td>
          </tr>
             <?php
		 	  $sl++;
		  } 
		 
		  
		 // if(($festresult[$j]['is_publish']!='N')&&($festresult[$j]['grade']!='')){
	 if(($retdat[$j]['is_publish']!='N')&&($retdat[$j]['grade']=='A'||$retdat[$j]['grade']=='B'||$retdat[$j]['grade']=='C')){
	
		   ?>
          
        <tr>
            <td  align="center" width=20 height="25" style='border:0 0 0.5px 0.5px 0#000000 ; height:20 px;'><?php echo $sl;?>&nbsp;</td>
          <td   align="center" width=39 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php
			  	    
			$withheld='';
			if($festresult[$j]['is_publish']=='N'){
			
			$withheld='*';
			$withheldno++;
			}
			echo $festresult[$j]['participant_id'].$withheld;
			
?>
&nbsp;</td>
          <td width=38 align="center"style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><p><?php echo $festresult[$j]['code_no'];?></p></td>
          <td width=121  align="left" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>&nbsp;<?php $name=$festresult[$j]['participant_name']; $name=wordwrap($name, 30, "<br />", 1); echo $name; ?></td>
          <td width=110  align="left" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>&nbsp;<?php      $text=$festresult[$j]['school_name'];
		   $text = wordwrap($text, 30, "<br />", 1);
		  	echo  $text; 
		  ?></td>
                             
          <td align="center" width=20 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo $festresult[$j]['rank'];?></td>
          <td align="center"width=20 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo $festresult[$j]['grade'];?></td>
          <td align="center" width=20 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo $festresult[$j]['point'];?></td>
      	</tr>
       
         <?php
			  $sl++;
			}
			}
		  
		  ?>
        </table>
               </page>
		