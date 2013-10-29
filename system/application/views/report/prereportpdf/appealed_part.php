<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 10px;
	font-weight: bold;
	color:#000000;
}
.style9{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.style5{
	font-size: 10px;
	color:#000000;
}
.tb{
font-size: 10px;
	font-weight: bold;
	color:#000000;}
	
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
	
	 
<page backtop="28mm" backbottom="20mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="103%" border="0" cellspacing="0" cellpadding="4" align="center">
            <tr>
                <td align="center" class="style1" valign="top">List of Participants by Appeal</td>
            </tr>  
            <tr>
                <td class="style9" align="center" width="700">Festival: &nbsp;&nbsp;<?php echo $appeal[0]['fest_name']; ?></td>
            </tr>
        </table>
	</page_header>
    
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>   
    


 <table width="130%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="18"  align="center"  class="tb" style="border-right:1px #000000; padding:2px;" >Sl No</td>
    <td width="35" align="center" class="tb" style="border-right:1px #000000; padding:2px;" >Register Number</td>
    <td width="150" align="left" class="tb" style="border-right:1px #000000; padding:2px;" >&nbsp;Name </td>
     <td width="160" align="left" class="tb" style="border-right:1px #000000; padding:2px;" >&nbsp;School </td>
    
    <td width="150" align="left" class="tb" style="border-right:1px #000000; padding:2px;">&nbsp;Item &nbsp;&nbsp;</td>
    <td width="150" align="center" class="tb" style="border-right:0px #000000; padding:2px;"> Type of Appeal </td>
    
   </tr>
     <?php
	  		$prev_festid="";
			$count	=	0;
		 for($j = 0; $j < count($appeal); $j++){
	 		$count++;
			//$datt=datetophpmodel($appeal[$j]['sdt']);
      ?>
  <tr>
    <td align="center" width="18" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;" >&nbsp;<?php echo $count;?></td>
    <td align="center" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $appeal[$j]['participant_id']; ?></td>
    <td align="left" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;" >&nbsp;<?php echo wordwrap($appeal[$j]['participant_name'],30,"<br/>"); ?></td>
    <td align="left" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;" >&nbsp;<?php echo wordwrap($appeal[$j]['school_name'],40,"<br/>"); ?></td>
    <td align="left" class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:2px;" >&nbsp;<?php echo  wordwrap($appeal[$j]['item_code'].'-'.$appeal[$j]['item_name'],35,'<br>'); ?></td>
   <td align="left" class="ety" style="border-top:1px #000000; border-right:0px #000000; padding:2px;" >&nbsp;<?php echo wordwrap($appeal[$j]['spo_title'],30,'<br>'); ?></td>
   </tr>
  		<?php
		    }
 		 ?>
</table>

</page>
       
		