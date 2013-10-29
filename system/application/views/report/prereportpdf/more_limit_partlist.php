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
<page >
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
   
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
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
		 <table width="245%" align="center" >
        <tr>
          <td colspan="6" align="center" class="style2" height="26">Festival :&nbsp;&nbsp;<?php echo $fees_details[$j]['fest_name']; ?></td>
        </tr>
     <tr>
    <td height="26" align="center" class="style3">&nbsp;&nbsp;Sl.No&nbsp;&nbsp;</td>
    <td align="center" class="style3">&nbsp;&nbsp;Registration No.&nbsp;&nbsp;</td>
      <td align="center" class="style3">&nbsp;&nbsp;No. of Item&nbsp;&nbsp;</td>
    <td align="center" class="style3">&nbsp;&nbsp;Name of Student&nbsp;&nbsp;</td>
    <td align="center" class="style3">&nbsp;&nbsp;School Code&nbsp;&nbsp;</td>
    <td width="23%" align="center" class="style3">&nbsp;&nbsp;School Name&nbsp;&nbsp;</td>
    </tr>
    <? 
	} 
	?>
  	<tr>
    <td width="5%" align="center">&nbsp;&nbsp;<?php echo $s; ?></td>
    <td width="27%" align="center">&nbsp;&nbsp;<?php echo $fees_details[$j]['participant_id']; ?></td>
    <td width="14%" align="center">&nbsp;&nbsp;<?php echo $fees_details[$j]['cnt']; ?></td>
    <td width="14%" align="left">&nbsp;&nbsp;<?php echo $fees_details[$j]['participant_name']; ?></td>
    <td width="17%" align="center">&nbsp;&nbsp;<?php echo $fees_details[$j]['school_code']; ?></td>
    <td>&nbsp;&nbsp;<?php echo $fees_details[$j]['school_name']; ?></td>
    </tr>
 	 <? 
 	 } 
	?>
  
</table>
        </page>
