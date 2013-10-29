<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
font:Verdana;
}
.style2 {font-size: 24px}
-->
</style>

<page backtop="25mm" backbottom="40mm">
	<page_header>
    	<?php
		    
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="heading_tab">
            <tr>
                <td align="center" class="style1">Score Sheet</td>
            </tr>
        </table>
	</page_header>
<page_footer>
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
                <tr>
                    <td  align="right" width="500" height="20" valign="top">Signature :</td>
                    <td align="left" width="200">&nbsp;</td>
                </tr>
                <tr>
                    <td   align="right" height="20" valign="top" >Name of judge:</td>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td width="190" align="right" height="40" valign="top">Addresss:</td>
                    <td align="left">&nbsp;</td>
                </tr>
  </table>
  

  <?php
		$this->load->view('report/report_footer');
	?>
   
</page_footer>  

        <table width="82%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
          <tr>
            <td height="32" align="center" colspan="11" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px; font:Georgia;'>Festival:<?php echo $start_time[0]['fest_name'];?></td>
          </tr>
          
          <tr>        
           	<td width="37" height="32" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><strong>Item </strong></td>
            	<td colspan="8" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><span class="style2"><?php  echo wordwrap( $itemcode." - ".$start_time[0]['item_name'],25,'<br>');?></span></td>
            	<td style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;' colspan="2"><strong>Date</strong><strong>:<?php  echo datetophpmodel($start_time[0]['start_time']);?>&nbsp;&nbsp;&nbsp;<?php echo $start_time[0]['stage_name'].' - '.$start_time[0]['stage_desc']; ?></strong></td>
          </tr>
          
          <!--<tr>
            <td width=49 height="32" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;font:Georgia;'><div align="left"><strong>Item</strong></div></td>
            <td colspan="9" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;font:Georgia; '><strong><span class="style2"><?php  echo wordwrap( $itemcode." - ".$start_time[0]['item_name'],25,'<br>');?></span></strong></td>
            <td align="left" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><strong>Date :<?php  echo datetophpmodel($start_time[0]['start_time']);?> </strong></td>
          </tr>-->
          <?php if (file_exists($this->config->item('base_path').'value_points/'.$itemcode.'.JPG')){ ?>
          
          <tr>
            	<td align="center" colspan="11" style='border:0 0 0.5px 0.5px 0 #000000 ; font:Georgia;'>
            	<img src="<?php echo base_url(false).'value_points/'.$itemcode.'.JPG' ?>" height="100" width="700" />            	</td>
          </tr>
          <!--<tr>
            <td align="center" colspan="11" style='border:0 0 0.5px 0.5px 0 #000000 ; font:Georgia;'>
            	<img src="<?php echo base_url(false).'value_points/'.$itemcode.'.JPG' ?>" height="100" width="700" />
            </td>
          </tr>-->
          <?php }?>
          <tr>
            <td colspan="2" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><div align="left"><strong>.</strong></div>              	</td>
                <td colspan="6" align="center"><strong>Score for each value points</strong></td>
                <td colspan="3" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><div align="center">&nbsp;</div></td>
            </tr>
          <tr>
            <td  align="center"width=37 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><strong>Sl.No</strong>							            </td>
                <td  align="center"width=63 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><strong>Code.No  </strong>                </td>
                <td align="center" width=40 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>A</td>
                <td align="center"width=40 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>B</td>
                <td align="center" width=40 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>C</td>
                <td align="center"width=40 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>D</td>
                <td align="center"width=40 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>E</td>
                <td align="center"width=40 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>F</td>
                <td colspan="2" align="center" style='border:0 0 0.5px 0.5px 0#000000 ; height:20 px;'><strong>Total out of 100</strong></td>
                <td  align="center"width=62 style='border:0 0 0.5px 0.5px 0#000000 ; height:20 px;'><strong> Remarks</strong>                </td>
            </tr>
          <tr>
            <td  height="24" colspan="8" align="center"  style='border:0 0 0.5px 0.5px 0 #000000 ; height:50 px;'>&nbsp;</td>
                <td align="center"  style='border:0 0 0.5px 0.5px 0 #000000 ; height:50 px;'><strong>In Figures</strong></td>
                <td align="center"  height="24"  style='border:0 0 0.5px 0.5px 0 #000000 ; height:50 px;'><strong>In Words</strong></td>
                <td align="center"  height="24"  style='border:0 0 0.5px 0.5px 0 #000000 ; height:50 px;'>&nbsp;</td>
            </tr>
          <?php 
     $count=$start_time[0]['no_of_participant'];
      $sl=0;
	  for($i=0;$i<$count+5;$i++)
       {
         $sl++;
       ?>
          <tr>
            <td align="center" width=37  height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; height:50 px;'><?php echo $sl;?></td>
                <td align="center"width=63   height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ;'>&nbsp;</td>
                <td align="center"width=27   height="46"   style='border:0 0 0.5px 0.5px 0 #000000 ; '>&nbsp;</td>
                <td align="center"width=26   height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; '>&nbsp;</td>
                <td align="center"width=27   height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; '>&nbsp;</td>
                <td align="center"width=27   height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; '>&nbsp;</td>
                <td align="center"width=26   height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; '>&nbsp;</td>
                <td align="center"width=33   height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; '>&nbsp;</td>
               <td align="center"width=33   height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; '>&nbsp;</td>
                <td align="center"width=200  height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; '>&nbsp;</td>
                <td align="center"width=62  height="46"  style='border:0 0 0.5px 0.5px 0 #000000 ; height:50 px;'>&nbsp;</td>
            </tr>          
          <?php }  ?>
        </table>
            </page >
		<p>&nbsp;</p>
		<p>&nbsp;</p>
        