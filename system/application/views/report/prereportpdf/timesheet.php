<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size:12px;
	font-weight:bold;
	color:#000000;
}
-->
</style>
<page backtop="40mm" backbottom="20mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            <tr>
                <td class="style1" align="center">Time Sheet </td>
            </tr>
            <tr>
            	<td class="style1" align="center"><?php echo @$itemtime[0]['item_code'].' - '.@$itemtime[0]['item_name']?> (<?php echo @$festname[0]['fest_name']?>)</td>
            </tr>
        </table>
        <table width="100%" border="0">
        	<tr>
            	<td align="center" width="518" class="style2">Stage : <?php echo @$itemtime[0]['stage_name'].' - '.@$itemtime[0]['stage_desc'].' on   '.datetophpmodel(@$itemtime[0]['ttime']);?></td>
                <td align="center" width="229" class="style2">Max Time : <?php $time_type = (@$itemtime[0]['time_type'] == 'M') ? 'Min' : 'Sec'; echo @$itemtime[0]['max_time'].' '.@$time_type; ?></td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>     

  <table width="100%" border="1" cellpadding="5" cellspacing="0">

  <tr> 
    <td width="50" align="center"  style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Sl.No.</td>
    <td width="100" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Code Number</td>
    <td width="150" align="center" style="border-bottom:1px  #000000; border-right:1px #000000; padding:2px;">Start Time</td>
    <td width="150" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">End Time</td>
    <td width="250" align="left" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">Remarks</td>
  </tr>
  <?php 
  
  for($i=1;$i<=$item_count+10;$i++)
  {
  ?>
  <tr>
      <td align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $i?></td>
      <td style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"></td>
      <td style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"></td>
      <td style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"></td>
      <td style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"></td>
  </tr>
 <?php
  }
   ?>
   
</table>
<table align="right"><tr><td height="50" valign="bottom"> Name & Signature of Time Keeper</td><td width="100"></td></tr></table>

</page> 