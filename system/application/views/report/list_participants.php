<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
-->
</style>
<page backtop="10mm" backbottom="10mm">
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
        <td><div align="center" class="style1">List of Participating Schools with School Code</div></td>
        </tr>
        </table>
	    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
          <tr height="30">
            <th align="center" width="79">Sl.No</th>
            <th  width="84" align="center">Item Code & Name          </th>
            <th align="left" width="119" >Name</th>
            <th align="center" width="95">B/G</th>
            <th width="326" colspan="10" align="left">Standard</th>
          </tr>
          <?php
		
            $count	=	0;
            for($j = 0; $j < count($part_details); $j++){
			for($k = 0; $k < count($school_det); $k++){
			if($part_details[$j]['school_code']==$school_det[$k]['school_code']){
			$school_name=$school_fest[$k]['school_name'];
			}
			}
			$count++;
                ?>
          <tr height="30">
            <td align="center" ><?php echo $count;?></td>
            <td align="center" ><?php echo $part_details[$j]['item_name'];?></td>
            <td align="left" ><?php  echo $part_details[$j]['participant_name'];?></td>
            <td align="center" ></td>
            <td align="left" ></td>
          </tr>
          <?php
            }
        ?>
        </table>
    
 </page>
	
    
    