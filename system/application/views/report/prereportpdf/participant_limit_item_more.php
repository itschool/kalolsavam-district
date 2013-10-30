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
.style9{ 
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}

.tb{
font-size: 12px;
	font-weight: bold;
	color:#000000;}
.ety{
	font-size: 12px;
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

   
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
    <tr>
        <td height="43" align="center" class="style1">List of Students Participating More than One Items</td>
    </tr>
</table>
       
 
   <?php         
                $items=" ";
  				$s=0;
				$prev_fest="";
				for($j=0; $j<count($fees_details); $j++){
				$s++;
				for($k=0;$k<count($item_names);$k++)
				{
				   if(($fees_details[$j]['participant_id']==$item_names[$k]['participant_id']) && ($fees_details[$j]['school_code']==$item_names[$k]['school_code']) && ($fees_details[$j]['fest_id']==$item_names[$k]['fest_id'])) 
				   {
				      $items = $items.' <br/>'.$item_names[$k]['item_code'].'-'.$item_names[$k]['item_name'];
					}
			   }
				if($prev_fest!=$fees_details[$j]['fest_id']){
					if($j!=0){
					print("</table>");
					
				?>
				
			   <?Php 
						 }
		
			$prev_fest=$fees_details[$j]['fest_id'];
			$s=1;
		
			?>
<table width="245%" align="center" border="1" cellpadding="0" cellspacing="0" >
    <tr>
    	<td colspan="6" align="center" class="style2" height="26" style="border-bottom:1px #666666; border-right:0px #666666; padding:2px;">Festival :&nbsp;&nbsp;<?php echo $fees_details[$j]['fest_name']; ?></td>
    </tr>
    <tr>
        <td width="30" align="center" class="style3" style="border-right:1px #666666; padding:2px;" height="26">Sl.No</td>
        <td width="50" align="center" class="style3" style="border-right:1px #666666; padding:2px;">Reg No.</td>
        <td width="180" align="center" class="style3" style="border-right:1px #666666; padding:2px;">Items</td>
        <td width="150" align="left" class="style3" style="border-right:1px #666666; padding:2px;">&nbsp;Name </td>
        <td width="150" align="left" class="style3" style="border-right:1px #666666; padding:2px;">School</td>
    </tr>
    <? 
    } 
    ?>
    <tr>
        <td class="ety"  align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $s; ?></td>
        <td class="ety"  align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $fees_details[$j]['participant_id']; ?></td>
        <td class="ety"  align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo wordwrap($items,35,'<br/>'); ?></td>
        <td class="ety"  align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo wordwrap($fees_details[$j]['participant_name'],20,'<br>'); ?></td>
        <td class="ety"  align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo wordwrap($fees_details[$j]['school_code'].' - '.$fees_details[$j]['school_name'],40,'<br>'); ?></td>
    </tr>
<? 
$items=" ";
} 
?>

</table>
        </page>
