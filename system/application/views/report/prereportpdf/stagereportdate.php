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
<page backtop="30mm" backbottom="20mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
      <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
            <tr>
                <td align="center" class="style1">Stage Reports</td>
            </tr>
            <tr>
                <td align="center"><strong><?php echo $stagename[0]['stage_name'].' - '.$stagename[0]['stage_desc'];?> (<?php echo datetophpmodel($date);?>)</strong></td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>  



<table width="85%" border="1" cellpadding="5" cellspacing="0">
  <tr>
    <td class="tb" height="25" align="center" width='37' style="border-bottom:0px #000000; border-right:1px #000000; padding:0px;">Sl.No. </td>
    <td class="tb" height="25" align="left" width='196' style="border-bottom:0px #000000; border-right:1px #000000; padding:0px;">&nbsp;&nbsp;Item</td>
    <td  class="tb"height="25" align="center" width='110' style="border-bottom:0px #000000; border-right:1px #000000; padding:0px;"> No.of <br />
    Participants/<br/>Teams</td>
    <td  class="tb" height="25" align="center" width='70' style="border-bottom:0px #000000; border-right:1px #000000; padding:0px;"> Start Time<br>(Tentative) </td>
    <td  class="tb" height="25" align="center" width='80' style="border-bottom:0px #000000; border-right:1px #000000; padding:0px;"> Duration </td>
    <td class="tb"  height="25" align="center" width='99' style="border-bottom:0px #000000; border-left:0px #000000; padding:0px;">Remarks </td>
  </tr>
 	 <?php
		
            $count		=	0;
			$grandtotal =   0;
            foreach($stagedata as $data)
			{
					$count++;
					
					$time		=	$data['max_time'] * $data['no_of_participant'];
					$time		=	get_time_format($time);		
             ?>
  <tr>
   <td class="ety" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:0px;"><?php echo $count;?></td>
   <td class="ety"  align="left" style="border-top:1px #000000; border-right:1px #000000; padding:0px;">&nbsp;<?php echo $data['item_code'].' - '.$data['item_name'].' ('.$data['fest_name'].')';?></td>
   <td class="ety" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:0px;"><?php echo $data['no_of_participant'];?></td>
   <td class="ety" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:0px;"><?php /*$timer=explode(" ",$data['start_time']);  echo $timer[1];*/ echo $data['stime'];?></td>
   <td class="ety"  align="center" style="border-top:1px #000000; border-right:1px #000000; padding:0px;"><?php echo $time?></td>
   <td class="ety" style="border-top:1px #000000; border-left:0px #000000; padding:0px;">&nbsp;</td>
  </tr>
	  <?php } ?>
  
</table>

</page>    