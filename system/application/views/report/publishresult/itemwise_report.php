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
		<?php
				$previtemcode="";
				$prev_festid="";
				$j=0;
				foreach($itemwise as $value){
				
				
					if($previtemcode!=$value['item_code']){
					$count=0;
						$previtemcode=$value['item_code'];
							if($j!=0){
							print("</table></page>");
							
							}
		?>
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
<tr>
        <td height="30" align="center" class="style1">Item Wise Participant Report Details</td>
  </tr>
</table>
       
	 <table width="91%" align="center" border="1" cellpadding="0" cellspacing="0" >
        
        <tr>
         <td colspan="7" align="center" class="style2" height="24" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">Item :&nbsp;&nbsp;<?php echo $value['item_code'].'  '.$value['item_name']; ?></td>
       </tr>
        
    		 <tr>
            <td width=41 height="19" align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;Sl.No&nbsp;</td>
            <td width=179 align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Name of Participant</td>
             
            <td width=238 align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">School Name</td>
             <td width="51" align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">% of Mark</td>
             <td width="40" align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Rank</td>
            <td width="62" align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Grade</td>
             <td width="49" align="center" class="style3" style=" border-bottom:1px #000000; border-right:0px #000000; padding:2px;">Point</td>
       </tr>
		<? 
		}
        
		$count++;
		$j++;
        ?>
            <tr>
            <td width="41" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $count; ?></td>
            <td width="179" align="left" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($value['participant_name'],25,'<br>'); ?></td>
            <td width="238" align="left" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($value['school_code'].' '.$value['school_name'],50,'<br>');   ?></td>
           <td width="51" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $value['percentage']; ?></td>
            <td width="40" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $value['rank']; ?> </td>
            <td width="62" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $value['grade']; ?></td>
            <td width="49" align="center" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $value['point']; ?></td>
       </tr>
		 <? 
         } 
        ?>
</table>
  </page>
