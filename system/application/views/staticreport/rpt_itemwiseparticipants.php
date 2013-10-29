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
        <td><div align="center" class="style1">Itemwise participants list</div></td>
        </tr>
        </table>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <?php 
  foreach($itemdet as $det)
  {
  ?>
<tr>
      <td width='100' style='border: 0 1px 1px 0 #000000;  height:20px;'><strong>Item Code :</strong>&nbsp;&nbsp;</td>
    <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $det['ItemCode'];?>&nbsp;&nbsp;</td>
    <td width='100' style='border: 0 1px 1px 0 #000000;  height:20px;'><strong>Item Name :</strong></td>
    <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $det['Item'];?>&nbsp;&nbsp;</td>
    <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'><strong>Festival :</strong></td>
    <td width='100' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $det['fest_name'];?></td>
    </tr>
    <?php 
	}
	?>
</table>

        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'>Sl.No.</td>
    <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center">Register No</div></td>
    <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center">Name of Participant</div></td>
    <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center">Gender</div></td>
    <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center">Class</div></td>
    <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center">School Code</div></td>
    <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center">School Name</div></td>
  </tr>
  <?php
		
            $count	=	0;
            foreach($partdata as $data)
			{
					$count++;
             ?>
                <tr>
                <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $count;?></td>
                <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $data['participant_id'];?></td>
                <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'><?php echo $data['participant_name'];?></td>
                <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center"><?php echo $data['gender'];?></div></td>                  
                <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center"><?php echo $data['class'];?></div></td>
                <td width='60' style='border: 0 1px 1px 0 #000000;  height:20px;'><div align="center"><?php echo $data['school_code'];?></div></td>
                <td width='200' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $data['school_name'];?></td>
          </tr>
  <?php 
   }
  ?>
</table>
</page>
		