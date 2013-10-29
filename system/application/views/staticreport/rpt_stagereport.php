<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
-->
</style>
<page backtop="10mm" backbottom="10mm ">
	<page_header>
		<table style="width: 100%;">
			<tr>
				<td style="text-align: right;width: 100%"></td>
			</tr>
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
		</table>
	</page_header>
<page_footer>
<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">				</td>
			</tr>
		</table>
</page_footer>       

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
    <tr>
    	<td><div align="center" class="style1"> Stage Reports</div></td>
    </tr>
</table>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
  <tr>
    <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'><strong>Stage Id </strong></td>
	
    <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $stageid;?></td>      
    <td width='100' style='border: 0 1px 1px 0 #000000;  height:20px;'><strong>Stage Name</strong></td>
   
    <?php foreach ($stagename as $stage)
	      {
		  	$stage_name		=		$stage['stage_name'];
		  }
	 ?>
    <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $stage_name;?></td>
    <td width='80' style='border: 0 1px 1px 0 #000000;  height:20px;'><strong>Date</strong></td>
    
    <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $date;?></td>
  </tr>
</table>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
  <tr>
    <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'> Sl.No. </td>
    <td width='50' style='border: 0 1px 1px 0 #000000;  height:20px;'> Item code </td>
    <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;&nbsp;Item </td>
    <td width='120' style='border: 0 1px 1px 0 #000000;  height:20px;'> &nbsp;&nbsp;&nbsp;Festival </td>
    <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'> No.of teams </td>
    <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'> Exp time </td>
    <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'> &nbsp;&nbsp;&nbsp;Remarks </td>
  </tr>
  <?php
		
            $count		=	0;
			$grandtotal =   0;
            foreach($stagedata as $data)
			{
					$count++;
					
					$time		=	$data['item_time'] * $data['no_of_participant'];
					$time		=	get_time_format($time);
					
							
             ?>
  <tr>
   <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $count;?></td>
   <td width='50' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $data['item_code'];?></td>
   <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $data['item_name'];?></td>
   <td width='120' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $data['fest_name'];?></td>
   <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $data['no_of_participant'];?></td>
   <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $time?></td>
   <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;</td>
  </tr>
  <?php }?>
  <tr>
    <td height="31">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</page>    