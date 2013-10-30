
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}.style2 {
	font-size: 11px;
	font-weight: 100;
	
}
.style3 {
	font-size: 10px;
	font-weight: 100;
	height:9px;
	border:0 0 0.5px 0.5px 0 #000000 ; 
}
</style>

<?php      $k=0;
           $h=1;
           $appeal=0;
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
						//$itemcount2= $this->timefest_model->timeoffest_count2($previtem);     
					    $absentee_list= $this->timefest_model->timeoffest_result_absentee($temp);
					    $absentee	= explode(',', $absentee_list);
					 $this->Reg_no=array();
					
						   if($j!=0){
						   				$rt=0;
								for($ty=0;$ty<count($absentee);$ty++){
										 //if($temp==$absenteeall[$ty]['item_code']){
											 $this->Reg_no[$ty]=$absentee[$ty];	
											 $rt++;
									 	// }
								 }
						 $Absent_reg_no=(count($absentee) and (trim($absentee[0]))) ? count($absentee) : '0';
						  $no_reg_tot=$itemcount[0]['picount'];
						  
						  $withheldcount=$withheldno-$appeal;
						  
						  //	if($Absent_reg_no>0){
							   print(" </table><br /><table  align='center'  width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
        <td width='150' align='left'>**No of Withheld :&nbsp;&nbsp;$appeal</td>
        <td width='150'>No.of Registered :&nbsp;&nbsp;$no_reg_tot</td>
        <td width='150'>No of Absentee :&nbsp;&nbsp;$Absent_reg_no</td>
		 <td width='150'>*No of Appeal Entry :&nbsp;&nbsp;$withheldcount</td>
        </tr><tr><td colspan='4'><table width='100%'><tr><td valign='top'>Absentee Reg No :</td><td>");
						       for($i=1;$i<=$Absent_reg_no;$i++){
							   		echo $this->Reg_no[$i-1].'&nbsp;';
									
							   		 if(($i%12==0)&&($i!=0)){
				   							 print("<br>");
									  }
						         
							      
							      }
							   print("</td></tr>");	
							   print("</table>");	
							   print("</td></tr>");						   
						       print("</table></page>");
						         $withheldno=0;
						   }
						
	?>   
<page backtop="25mm" backbottom="25mm">
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
	    ?> <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
                <tr>
                    <td  align="right" width="80" height="20" valign="top">Entered by :</td>
                    <td  align="right" width="500" height="20" valign="top">Signature :</td>
                    <td align="left" width="100">&nbsp;</td>
                </tr>
                <tr>
                    <td  align="right" width="80" height="20" valign="top">Checked by :</td>
                    <td   align="right" height="20" valign="top" >Program Convenor</td>
                    <td align="left">&nbsp;</td>
                </tr>
                
  </table><?php
		$this->load->view('report/report_footer');  
		 $ctt=  $festresult[$j]['no_of_judges'];
	?>
<table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
      <tr> <td  align="left" width="80" height="20" valign="top"><?php echo $h++; ?></td></tr>
      </table>
</page_footer>
          <table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
          <tr>
            <td width=20 height="10" rowspan="2" align="center"style='border:0 0 0.5px 0.5px 0#000000 ; '>Sl No</td>
            <td width=40  height="10" rowspan="2" align="center"style='border:0 0 0.5px 0.5px 0 #000000 ;'>Reg No </td>
            <td width=27  height="10"rowspan="2" align="center"style='border:0 0 0.5px 0.5px 0 #000000 ; '>Code No</td>
            <td width=170  height="10"rowspan="2"  align="left" style='border:0 0 0.5px 0.5px 0 #000000 ;  px;'>&nbsp;Name</td>
            <td width=170  height="10"rowspan="2"  align="left" style='border:0 0 0.5px 0.5px 0 #000000 ;'>&nbsp;School</td>
            <td align="center" colspan="<?php echo $ctt+1; ?>" width=20  height="10"style='border:0 0 0.5px 0.5px 0 #000000; '>Marks</td>       <td align="center" rowspan="2" width=20 height="10" style='border:0 0 0.5px 0.5px 0 #000000 ; '> %</td>
            <td align="center" rowspan="2" width=20 height="10" style='border:0 0 0.5px 0.5px 0 #000000 ; '>R</td>
            <td align="center" rowspan="2"width=20  height="10"style='border:0 0 0.5px 0.5px 0 #000000 ; '>G</td>
            <td align="center" rowspan="2" width=20  height="10"style='border:0 0 0.5px 0.5px 0 #000000 ; '>P</td>
          </tr>
          <tr>
          <?php
		 
		  $ct=  $festresult[$j]['no_of_judges'];
		  for($k =0; $k <$ct; $k++ ){ 
		  
		   $appeal=0;
		  ?>
          
            <td  align="center" height="10"width=20 style='border:0 0 0.5px 0.5px 0 #000000 ;'><?php echo $k+1;?></td>
           <?php  } ?>
          
          <td  align="center" height="10" width=30 style='border:0 0 0.5px 0.5px 0 #000000 ; '>Total</td>
          </tr>
          <?php
		 	  $sl++;
		  } 
	
		   ?>
          <tr>
            <td  align="center" width=20 class="style3"><?php echo $sl;?>&nbsp;</td>
          <td   align="center" width=39  class="style3"><?php
			  	    
			$symbol = '';
			if($festresult[$j]['is_publish']=='N'){
			
			$symbol .= '*';
			}
			
			if($festresult[$j]['spo_id'] > 0){
			
			$symbol .= '*';
			if($symbol=='**'){
			  $appeal++;}
			 $withheldno++;
			 
			}
			
			echo $festresult[$j]['participant_id'].$symbol;
			
?>
&nbsp;</td>
          <td width=27  align="center"class="style3"><p><?php echo $festresult[$j]['code_no'];?></p></td>
          <td width=170 align="left" class="style3"><?php $name=$festresult[$j]['participant_name']; $name=wordwrap($name, 30, "<br />", 1); echo $name; ?></td>
          <td width=170 align="left" class="style3"><?php $text=$festresult[$j]['school_code'].'-'.$festresult[$j]['school_name'].'('.$festresult[$j]['sub_district_code'].'-'.$festresult[$j]['sub_district_name'];
		   $text = wordwrap($text, 50, "<br />", 1);
		  	echo  $text; 
		  ?>)</td>
           <?php 
		   $marks	=	explode('#$#',$festresult[$j]['marks']);
		   $cnt=count($festresult[$j]['no_of_judges']);
		   for($k =0; $k<$ct; $k++ ){ 
		   ?>
          <td  width="20" align="center" class="style3" >
		  <?php 
		   echo  $marks[$k];
		   ?>
          </td>         
<?php 
		  }
		  ?>
          
            
          <td  align="center"  width=20 class="style3"><?php echo $festresult[$j]['total_mark'];?></td>
          <td  align="center"  width=20 class="style3"><?php
			  $percentage=$festresult[$j]['percentage'];
		      $prnt= round( $percentage,2);
			  echo $prnt;
			  ?></td>
          <td align="center" width=20 class="style3"><?php echo $festresult[$j]['rank'];?></td>
          <td align="center" width=20 class="style3"><?php echo $festresult[$j]['grade'];?></td>
          <td align="center" width=20 class="style3"><?php echo $festresult[$j]['point'];?></td>
      	</tr>
       
         <?php
			  $sl++;
			}
		  
		  ?>
        </table>
            <?php
		     $temp=$festresult[$j-1]['item_code'];
			 $itemcount= $this->timefest_model->timeoffest_count($festresult[$j-1]['item_code']);
		  	 $absentee_list= $this->timefest_model->timeoffest_result_absentee($temp);
			 $absentee	= explode(',', $absentee_list);
			
			
			 $this->Reg_no=array();$rt=0;
			 for($ty=0;$ty<count($absentee);$ty++){
						//if($temp==$absenteeall[$ty]['item_code']){
							$this->Reg_no[$ty]=$absentee[$ty];	
							$rt++;
							// }
						}
						  $Absent_reg_no=(count($absentee) and (trim($absentee[0]))) ? count($absentee) : '0';
						  $no_reg_tot=$itemcount[0]['picount'];
						  $withheldcount=$withheldno-$appeal;
			 
                    print("<br /><table  align='center'  width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
					<td width='150' align='left'>**No of Withheld :&nbsp;&nbsp;$appeal</td>
					<td width='150' >No.of Registered :&nbsp;&nbsp;$no_reg_tot</td>
					<td width='150' >No of Absentee :&nbsp;&nbsp;$Absent_reg_no</td>
					 <td width='150' >*No of Appeal Entry :&nbsp;&nbsp;$withheldcount</td>
					</tr><tr><td colspan='4'><table width='100%'><tr> <td valign='top'>Absentee Reg No :</td><td>");
						            for($i=1;$i<=$Absent_reg_no;$i++){
							         echo $this->Reg_no[$i-1].'&nbsp;';
														   		 
									 if(($i%12==0)&&($i!=0)){
				   							 print("<br>");
									  }
						          
							      
							      }
							   print("</td></tr>");	
							   print("</table>");	
							   print("</td></tr>");						   
						       print("</table>");
       ?>
        </page>
		
