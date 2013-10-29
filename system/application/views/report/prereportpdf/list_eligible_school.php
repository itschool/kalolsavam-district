<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	color:#000000;
}
.style3{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
-->
</style>
<page  backtop="20mm" backbottom="20mm" >
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
   
   
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
        <tr><td height="20"></td></tr>
<tr>
        <td height="30" align="center" class="style1">List of Eligible Schools</td>
  </tr>

  </table>
        <table width="100%" align="center" >
        
     <tr>
    <td width="100">&nbsp;</td>
    <td width="70" height="21" align="center" class="style3">Sl.No</td>
    <td width="150" align="center" class="style3">School code</td>
      <td width="500" align="left" class="style3">School Name</td>
     
    </tr>
		<?php
		 $s=1;
         for($j=0;$j<count($school_details);$j++){
        
        ?>
  	<tr>
    <td>&nbsp;</td>
    <td class="style2" align="center"><?php echo $s; ?></td>
    <td class="style2" align="center"><?php echo $school_details[$j]['school_code']; ?></td>
    <td class="style2" align="left"><?php echo $school_details[$j]['school_name']; ?></td>
    </tr>
 		 <? 
			 $s++;
 			}
		 ?>
</table>

        </page>
