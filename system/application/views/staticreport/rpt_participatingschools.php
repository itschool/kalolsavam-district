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
	font-size: 10px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
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
				<td style="text-align: center;width: 100%" class="style4">Report Generated From       on <?php echo date("F j, Y, g:i a");  	?>			</td>
			</tr>
		</table>
</page_footer>       
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td align="center" class="style1">List of Participating Schools with School Code</td>
        </tr>
        </table>
	    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
          <tr height="30">
            <th width="79" height="30" align="center" class="style2">Sl.No</th>
            <th  width="84" align="center" class="style2">Section           </th>
            <th width="94" align="center" class="style2" >Festival<br/></th>
            <th width="120" align="center" class="style2">School code</th>
            <th width="326" colspan="10" align="left" class="style2">School Name</th>
          </tr>
          <?php
		
            $count	=	0;
            for($j = 0; $j < count($festtype); $j++){
			for($l = 0; $l < count($festmaster); $l++){
			if($festtype[$j]['fest_id']==$festmaster[$l]['fest_id']){
			$fest_name=$festmaster[$l]['fest_name'];
			}
			}
			$section=explode(" ",$fest_name); 
			$count++;
                ?>
          <tr height="30">
            <td align="center" height="25" ><?php echo $count;?></td>
            <td align="center" height="25" ><?php echo $section[0]; ?></td>
            <td align="center" height="25" ><?php echo $fest_name; ?></td>
            <td align="center" height="25" ><?php echo $festtype[$j]['school_code']; ?></td>
            <td align="left" height="25" ><?php echo $festtype[$j]['school_name']; ?></td>
          </tr>
          <?php
            }
        ?>
        </table>
    
 </page>
	
    
    