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
	color:black
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
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
<?php
if(count($festtype)>0){
	for($j = 0; $j < count($festtype); $j++){
		for($l = 0; $l < count($festmaster); $l++){
			if($festtype[$j]['fest_id']==$festmaster[$l]['fest_id']){
				$fest_name=$festmaster[$l]['fest_name'];
				$sub_dist=$festtype[$j]['sub_district_name'];
			}
		}
	}
}
else {
	$fest_name="";

}


?>   
<page backtop="30mm" backbottom="20mm ">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" >
            <tr>
                <td align="center" class="style1">List of Participating Schools with School Code</td>
            </tr>
           <?php
		   if($fest!=0)
		   {
		   ?>
            <tr>
                <td align="center" valign="bottom" class="style2">Festival:&nbsp;<?php echo $fest_name; ?></td>
            </tr>
            <?php
			}
			else
			{
			?>
            <tr>
                <td align="center" valign="bottom" class="style2"> All Festival</td>
            </tr>
            <?php
			}
			if($subdistrict=='All')
			{
			?>
             <tr>
                <td align="center" valign="bottom" class="style2">All Subdistricts</td>
            </tr>
            <?php
			}
			else
			{
			?>
             <tr>
                <td align="center" valign="bottom" class="style2"><?php echo @$sub_dist; ?></td>
            </tr>
            <?php
			}
			?>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       

			

	    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
          <tr >
            <th width="79" height="30" align="center" class="style2">Sl.No</th>
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
          <tr>
            <td align="center" class="ety"  ><?php echo $count;?></td>
            <td align="center" class="ety" ><?php echo $festtype[$j]['school_code']; ?></td>
            <td align="left" class="ety"><?php echo $festtype[$j]['school_name']; ?></td>
          </tr>
          <?php
            }
        ?>
        </table>
    
 </page>
	
    
    