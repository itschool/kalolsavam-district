<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
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
<page backtop="20mm" backbottom="20mm ">
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

         <!-- <div align="center" class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date wise participants list</div>-->
 
  <table align="center" width="100%"><tr>
    <td align="center" class="style1">Total  participants list <?php if($date!=""){ echo ' on '.datetophpmodel($date); } ?></td>
  </tr></table>
        
         <br /><table width="87%" border="1" align="center" cellpadding="0" cellspacing="0">
       
          <tr>
            <td class="tb" width='30'  style="border-top:0px #666666; border-right:1px #666666; padding:2px;" align="center" rowspan="2"> Sl.No. </td>
            <td class="tb" width='170' style="border-top:0px #666666; border-right:1px #666666; padding:2px;" align="left" rowspan="2"> &nbsp;&nbsp;School</td>
            <td  class="tb"width='70' style="border-top:0px #666666; border-right:1px #666666; padding:2px;" colspan="2" align="center" > LP </td>
           <td class="tb" width='70' style="border-top:0px #666666; border-right:1px #666666; padding:2px;" colspan="2" align="center" > UP</td>
           <td  class="tb"width='70' style="border-top:0px #666666; border-right:1px #666666; padding:2px;" colspan="2" align="center" > HS </td>
           <td  class="tb"width='80' style="border-top:0px #666666; border-right:1px #666666; padding:2px;" colspan="2" align="center" > HSS</td>
            <td class="tb" width='80' style="border-top:0px #666666; border-right:1px #666666; padding:2px;" colspan="2" align="center" > Total </td>
            <td class="tb" width='70' style="border-top:0px #666666; border-right:0px #666666; padding:2px;" rowspan="2" align="center" >Grand Total </td>
          
          </tr>
          <tr><td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">B</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">G</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">B</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">G</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">B</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">G</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">B</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">G</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">B</td>
          <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center">G</td></tr>
          <?php
		
            $count		 =	  0;
			$grandtotal  =    0;
			$no_lp_boys  =    0;
			$no_lp_girls =    0;
			$no_up_boys  =    0; 
			$no_up_girls =    0;
			$no_hs_boys  =    0; 
			$no_hs_girls =    0;
			$no_hss_boys =    0;
			 $no_hss_girls =  0;
			
			$lptotalboys        =	array();
			$lptotalgirls		=	array();
			$uptotalboys		=	array();
			$uptotalgirls		=	array();
			$hstotalboys		=	array();
			$hstotalgirls		=	array();
			$hsstotalboys		=	array();
			$hsstotalgirls		=	array();
			$school_tot_boys	=	array();
			$school_tot_girls	=	array();
			$school_boygirl_tot =	array();
			
			
			for($j=0;$j<count($school); $j++){
			
			$no_lp_boys=0;$no_lp_girls=0;
			$no_up_boys=0; $no_up_girls=0;
			$no_hs_boys=0; $no_hs_girls=0;
			$no_hss_boys=0; $no_hss_girls=0;
			$school_sum_boys=0;
			$school_sum_girls=0;
			$total_school_sum=0;
			
				for($k=0;$k<count($lp);$k++){
				if(($lp[$k]['school_code']==$school[$j]['school_code'])&&($lp[$k]['gender']=='B')){
					$no_lp_boys=$lp[$k]['cntlp'];
				}
				else if(($lp[$k]['school_code']==$school[$j]['school_code'])&&($lp[$k]['gender']=='G')){
				$no_lp_girls=$lp[$k]['cntlp'];
				}
				}
				
				for($k=0;$k<count($up);$k++){
				if(($up[$k]['school_code']==$school[$j]['school_code'])&&($up[$k]['gender']=='B')){
					$no_up_boys=$up[$k]['upid'];
				}
				else if(($up[$k]['school_code']==$school[$j]['school_code'])&&($up[$k]['gender']=='G')){
				$no_up_girls=$up[$k]['upid'];
				}
				}
				for($k=0;$k<count($hs);$k++){
				if(($hs[$k]['school_code']==$school[$j]['school_code'])&&($hs[$k]['gender']=='B')){
					$no_hs_boys=$hs[$k]['hsid'];
				}
				else if(($hs[$k]['school_code']==$school[$j]['school_code'])&&($hs[$k]['gender']=='G')){
				$no_hs_girls=$hs[$k]['hsid'];
				}
				}
				for($k=0;$k<count($hss);$k++){
				if(($hss[$k]['school_code']==$school[$j]['school_code'])&&($hss[$k]['gender']=='B')){
					$no_hss_boys=$hss[$k]['hssid'];
				}
				else if(($hss[$k]['school_code']==$school[$j]['school_code'])&&($hss[$k]['gender']=='G')){
				$no_hss_girls=$hss[$k]['hssid'];
				}
				}
           
					$count++;
					//$grandtotal	=	$grandtotal	+	$partdata[$j]['total'];
				
					array_push($lptotalboys,$no_lp_boys);
					array_push($lptotalgirls,$no_lp_girls);
					
					array_push($uptotalboys,$no_up_boys);
					array_push($uptotalgirls,$no_up_girls);
					
					array_push($hstotalboys,$no_hs_boys);
					array_push($hstotalgirls,$no_hs_girls);
					
					array_push($hsstotalboys,$no_hss_boys);
					array_push($hsstotalgirls,$no_hss_girls);
					
					$school_sum_boys=$no_lp_boys+$no_up_boys+$no_hs_boys+$no_hss_boys;
					$school_sum_girls=$no_lp_girls+$no_up_girls+$no_hs_girls+$no_hss_girls;
					
					$total_school_sum=$school_sum_boys+$school_sum_girls;
					
					array_push($school_tot_boys,$school_sum_boys);
					array_push($school_tot_girls,$school_sum_girls);
					
					array_push($school_boygirl_tot,$total_school_sum);
					
					
             ?>
          <tr>
            <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $count;?></td>
            <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="left"><?php echo wordwrap($school[$j]['school_code'].' - '.$school[$j]['school_name'].'-'.$school[$j]['sub_district_name'],30,'<br/>');?></td>
            <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $no_lp_boys; ?></td>
            <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $no_lp_girls; ?></td>
            <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $no_up_boys; ?></td>
          <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $no_up_girls; ?></td>
          <td class="ety"  style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $no_hs_boys; ?></td>
          <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $no_hs_girls; ?></td>
          <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $no_hss_boys; ?></td>
          <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $no_hss_girls; ?></td>
          <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $school_sum_boys; ?></td>
          <td class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:0px;" align="center"><?php echo $school_sum_girls; ?> </td>
            <td class="ety" style="border-top:1px #666666; border-right:0px #666666; padding:2px;" align="center"><?php echo $total_school_sum; ?> </td>
          </tr>
          <?php 
   }
    $school_tot_boys_total=0;
	 $school_tot_girls_total=0;
	  $grand_total_allschool=0;
 		 $lpsumboys= array_sum($lptotalboys);
		  $lpsumgirls= array_sum($lptotalgirls);
		  
		  $upsumboys= array_sum($uptotalboys);
		  $upsumgirls= array_sum($uptotalgirls);
		  
		  $hssumboys= array_sum($hstotalboys);
		  $hssumgirls= array_sum($hstotalgirls);
		  
		   $hsssumboys= array_sum($hsstotalboys);
		  $hsssumgirls= array_sum($hsstotalgirls);
		  
		 $school_tot_boys_total=array_sum($school_tot_boys);
		   $school_tot_girls_total=array_sum($school_tot_girls);
		   
		   $grand_total_allschool=array_sum($school_boygirl_tot);
		  
   
  ?>		 <tr>
            <td class="tb"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"  align="right" colspan="2">Grand Total</td>
             <td class="tb" style="border-top:1px #666666;  border-right:1px #666666; padding:2px;" align="center"><?php echo $lpsumboys; ?></td>
            <td class="tb" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $lpsumgirls; ?></td>
            <td class="tb" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $upsumboys; ?></td>
          <td class="tb" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $upsumgirls; ?></td>
          <td class="tb" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $hssumboys; ?></td>
          <td  class="tb"style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $hssumgirls; ?></td>
          <td class="tb" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $hsssumboys; ?></td>
          <td class="tb"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $hsssumgirls; ?></td>
          <td class="tb" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $school_tot_boys_total; ?></td>
          <td class="tb" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" align="center"><?php echo $school_tot_girls_total; ?></td>
          <td class="tb" style="border-top:1px #666666; border-right:0px #666666; padding:2px;" align="center"><?php echo $grand_total_allschool; ?></td>
          </tr>
        </table>
</page>
