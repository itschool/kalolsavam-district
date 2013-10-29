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


-->
</style>
<style>
@media print
{
h1 {page-break-before:always}
}
</style>
<page backtop="20mm" backbottom="20mm " >
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

   
<table width="77%" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr><td height="20"></td></tr>
<tr>
        <td height="43" align="center" class="style1">List of Students Participating More than One Items</td>
        </tr>
        </table>
       
 
<?php
  				$s=0;
				$prev_fest="";
				for($j=0; $j<count($fees_details); $j++){
				$s++;
				if($prev_fest!=$fees_details[$j]['fest_id']){
					if($j!=0){
					print("</table>");
					
				?>
				
			   <?Php 
						 }
		
			$prev_fest=$fees_details[$j]['fest_id'];
			$s=1;
		
			?>
		 <table width="84%" align="center" border="1" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="6" align="center" class="style2" height="26" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Festival :&nbsp;&nbsp;<?php echo $fees_details[$j]['fest_name']; ?></td>
        </tr>
     <tr>
    <td width=30 height="26" align="center" class="style3" style="border-right:1px #000000; padding:2px;"> &nbsp;&nbsp;Sl.No&nbsp;&nbsp;</td>
    <td width=65 align="center" class="style3" style="border-right:1px #000000; padding:2px;">&nbsp;&nbsp;Registration No.&nbsp;&nbsp;</td>
      <td width=35 align="center" class="style3" style="border-right:1px #000000; padding:2px;">&nbsp;&nbsp;No. of Item&nbsp;&nbsp;</td>
    <td width=250 align="center" class="style3" style="border-right:1px #000000; padding:2px;">&nbsp;&nbsp;Name of Student&nbsp;&nbsp;</td>
    <td width=50 align="center" class="style3" style="border-right:1px #000000; padding:2px;">&nbsp;&nbsp;School Code&nbsp;&nbsp;</td>
    <td width="250" align="center" class="style3" style="border-right:1px #000000; padding:2px;">&nbsp;&nbsp;School Name&nbsp;&nbsp;</td>
    </tr>
    <? 
	} 
	?>
  	<tr>
    <td width="30" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $s; ?></td>
    <td width="65" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $fees_details[$j]['participant_id']; ?></td>
    <td width="35" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $fees_details[$j]['cnt']; ?></td>
    <td width="250" align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($fees_details[$j]['participant_name'],20,'<br>'); ?></td>
    <td width="50" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $fees_details[$j]['school_code']; ?></td>
    <td width="250" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $fees_details[$j]['school_name']; ?></td>
    </tr>
 	 <? 
 	 } 
	?>
  
</table>
  </page>
