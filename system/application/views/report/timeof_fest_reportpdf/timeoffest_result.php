
<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.style8{
	font-size: 8px;
	color:#CC3300;
}
.style9 {
	font-size: 20px;
	font-weight: bold;
	color: #660033;
}
.style10{
	font-size: 12px;
	font-weight: bold;
	color: #660033;
}
-->
</style>

<page backtop="30mm" backbottom="20mm ">
	
<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
            <td align="left" width="400" class="style1"  style=" padding:2px;"height="25">&nbsp;&nbsp;<?php echo $itemcode;?>-<?php echo $retdat[0]['item_name'];?>(<?php echo  $retdat[0]['fest_name'];?>)   </td>
            <td  align="right" width="300" class="style1"  style=" padding:2px;"height="25">
                <?php echo $retdat[0]['stage_name'];  ?>&nbsp; on&nbsp;
                    <?php $date=explode(' ',$retdat[0]['start_time']);
                 echo datetophpmodel($date[0]);	  
                ?>
            </td>
          </tr>
         </table> 
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>

 
 <table width="900" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="20"  class="style2" height="25"  align="center" style="border-bottom:1px #000000; border-right:0px #000000;border-left:0px #000000; padding:2px;">Sl No</td>
          <td   class="style2" align="center" width="30" style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">Reg No</td>
            <td   class="style2" width="20" style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">Code No</td>
           <td  class="style2" width=200   align="leftr" style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">Name</td>                     
            <td  class="style2" width=200   align="left" style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">School</td>
         
            <td  class="style2" align="center" width=20  style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">R</td>
            <td  class="style2" align="center"width=20  style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">G</td>
            <td  class="style2" align="center"width=20  style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">P</td>
  </tr>
          <?php
		  $withheldno=0;
		  $sl=0;
		   for($j=0; $j<count($retdat); $j++){
		  
		  if($retdat[$j]['is_publish']=='N'){
			
			$withheldno++;
			}
		  
		      //if(($retdat[$j]['is_publish']!='N')&&($retdat[$j]['grade']!='')){
		      if(($retdat[$j]['is_publish']!='N')&&($retdat[$j]['grade']=='A'||$retdat[$j]['grade']=='B'||$retdat[$j]['grade']=='C')){
				$sl++;
		   ?>
          
        <tr>
       
            <td  align="center" width=20 height="25" style="border-bottom:1px #000000;,border-right:1px #000000;border-left:0px #000000; padding:2px;"><?php echo $sl;?>&nbsp;</td>
            <td  align="center" width=20 style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;"><?php       
            $withheld='';
            echo $retdat[$j]['participant_id'].$withheld;
            ?>&nbsp;</td>
            <td width=30 align="center" style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;"><p><?php echo $retdat[$j]['code_no'];?></p></td>
            <td width=170 align="left" style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">&nbsp;<?php $name=$retdat[$j]['participant_name']; $name=wordwrap($name, 30, "<br />", 1); echo $name; ?></td>
            <td width=170  align="left" style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;">&nbsp;<?php      $text=$retdat[$j]['school_name'];
            $text = wordwrap($text, 30, "<br />", 1);
            echo  $text; 
            ?></td>
         
            <td align="center"width=20 style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;"><?php echo $retdat[$j]['rank'];?></td>
            <td align="center" width=20 style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;"><?php echo $retdat[$j]['grade'];?></td>
            <td align="center" width=20 style="border-bottom:1px #000000;,border-right:1px #000000;border-left:1px #000000; padding:2px;"><?php echo $retdat[$j]['point'];?></td>
            </tr>
           
      <?php
         }
         
		 }?>
</table><br />
</page>
		