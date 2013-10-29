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
				<td style="text-align: center;width: 100%">	</td>
			</tr>
		</table>
</page_footer>

          <div align="center" class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date wise participants list</div>
  
        <table width="87%" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><strong>Date</strong></td>
            <td colspan="4"><strong>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $date;?></strong></td>
          </tr>
          <tr>
            <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'> Sl.No. </td>
            <td width='50' style='border: 0 1px 1px 0 #000000;  height:20px;'> School Code </td>
            <td width='330' style='border: 0 1px 1px 0 #000000;  height:20px;'> School Name </td>
            <td width='100' style='border: 0 1px 1px 0 #000000;  height:20px;'> No. of Participants </td>
          </tr>
          <?php
		
            $count		=	0;
			$grandtotal =   0;
            foreach($partdata as $data)
			{
					$count++;
					$grandtotal	=	$grandtotal	+	$data['total'];
             ?>
          <tr>
            <td width='30' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $count;?></td>
            <td width='50' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['school_code'];?></td>
            <td width='330' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $data['school_name'];?></td>
            <td width='100' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $data['total'];?></td>
          </tr>
          <?php 
   }
  ?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td width="17">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div align="left"><strong>Total No of Participants:</strong></div></td>
            <td>&nbsp;</td>
            <td width='100' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php echo $grandtotal;?></td>
            <td>&nbsp;</td>
          </tr>
        </table>
</page>
