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
	font-size: 11px;
	font-weight: bold;
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
<style>
@media print
{
h1 {page-break-before:always}
}
</style>
	<?php
  				$s=0;
				$prev_ddt="";
				$prev_stageid="";
				for($j=0; $j<count($retdata); $j++){
				
				if($prev_ddt!=$retdata[$j]['ddt']){
					$prev_ddt=$retdata[$j]['ddt'];
					$prev_stageid="";
					if($j!=0){
						print("</table></page>");
					}
				$datt=datetophpmodel($retdata[$j]['ddt']);
		
			?>
<page backtop="25mm" backbottom="20mm " >
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
            <tr>
                <td align="center" class="style1">Stage Report</td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer> 
   

       
 

		 <table width="88%" align="center" border="1" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="7" align="center" class="style2" height="26" style="border-bottom:0px #000000; border-right:0px #000000; padding:2px;">&nbsp;&nbsp;Date:&nbsp;&nbsp;<?php  echo $datt; ; ?>
          </td>
        </tr>
        <?php
		}
		
		if($prev_stageid!=$retdata[$j]['stage_id']){
		$prev_stageid=$retdata[$j]['stage_id'];
		$s=0;
		?>
        <tr>
          <td colspan="7" align="center" class="style2" height="24" style="border-top:1px #000000; border-bottom:1px #000000; padding:2px;">
          Stage :&nbsp;<?php echo $retdata[$j]['stage_name'].' - '.$retdata[$j]['stage_desc']; ?>&nbsp;&nbsp;</td>
        </tr>
 
     <tr>
    <td width="40"  class="tb" align="center"  style="border-right:1px #000000; padding:2px;">Sl.No</td>
    <td width="300" class="tb" align="left"  style="border-right:1px #000000; padding:2px;">Item</td>
    <td width="100" class="tb" align="center"  style="border-right:1px #000000; padding:2px;">No. of Participants/Teams</td>
    <td width="150" class="tb" align="left" style="border-right:1px #000000; padding:2px;">Tentative Time</td>
    <td width="120" class="tb" align="center"  style="border-right:0px #000000; padding:2px;">Remarks</td>
    </tr>
    <?php
	}
				if($retdata[$j]['is_off_stage']=='N')
				{
					$time		=	$retdata[$j]['max_time'] * $retdata[$j]['no_of_participant'];
					$time		=	get_time_format($time);
				}
				else 
				{
						if($retdata[$j]['time_type']=='M')
						$timetye='Minite';
						else if($retdata[$j]['time_type']=='S')
						$timetye='Second';
				 		$time=$retdata[$j]['max_time'].'  '.$timetye;
				}
	$s++;
	?>
  	<tr>
    <td  class="ety" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $s; ?></td>
    <td  class="ety" align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php  echo $retdata[$j]['item_code'].' - '.$retdata[$j]['item_name'].' ('.$retdata[$j]['fest_name'].')'; ?></td>
    <td  class="ety" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo  $retdata[$j]['no_of_participant']; ?></td>
    <td   class="ety"align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $time; ?></td>
    <td  class="ety" style="border-top:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;</td>
    </tr>
 	 <? 
 	 } 
	?>
  
</table>
  </page>
