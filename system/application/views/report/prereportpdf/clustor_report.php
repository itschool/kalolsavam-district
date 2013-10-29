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
	font-size: 12px;
	color:#000000;
}
.style4{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style5{
	font-size: 13px;
	font-weight: bold;
	color:#000000;
}
-->
</style>
<page backtop="20mm" backbottom="20mm" pageleft="50mm">
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
  
<table width="100%" align="center" >
<tr>
    <td colspan="3" align="center" class="style1" >Cluster Report
    </td>
    </tr>
  <tr>
    <td colspan="3" align="center" class="style4" height="25" valign="middle" >Festival :&nbsp;&nbsp;<?php echo $retdata[0]['fest_name']; ?></td>
  </tr>
  <tr>
    <td  align="left" class="style2" >Item :&nbsp;&nbsp;&nbsp;<?php echo $retdata[0]['item_code'].' - '.$retdata[0]['item_name']; ?>&nbsp;&nbsp;</td>
    <td colspan="2"  align="center" class="style2" ></td>
  </tr>
  <tr>
    <td  align="left" colspan="2" class="style2"> <?php echo $retdata[0]['stage_name'].' - '.$retdata[0]['stage_desc'].' on  '.datetophpmodel($retdata[0]['stime']).' at '.timephpmodel($retdata[0]['stime']); ?>&nbsp;</td>
    <td class="style2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Maximum 
      Time for item :&nbsp;&nbsp;<?php echo $retdata[0]['max_time']; ?></td>
  </tr>
</table>
<br />
<table align="left" >
		<?php
		$prev_cluster="";$clustarray="";
			for($j=0;$j<count($retdata); $j++){
				if(($prev_cluster!=$retdata[$j]['cluster_no'])){
				$prev_cluster=$retdata[$j]['cluster_no'];
				$prev_array=$clustarray;
				$clustarray="";
				$clustarray=$retdata[$j]['participant_id'];
					if($j!=0){
				?>
				<tr><td width="50"></td><td class="style3" >
              <span class="style5"> Cluster &nbsp;&nbsp; <?php echo $retdata[$j-1]['cluster_no']; ?>:</span>&nbsp;&nbsp;&nbsp;<?php echo wordwrap($prev_array,120,'<br>'); ?>  </td></tr>
				<?php
						}
				}
				else {
				$clustarray=$clustarray.',  '.$retdata[$j]['participant_id'];
				?>	
				


			<?php
					}
			}
			$prev_array=$clustarray;
			?>
            <tr><td width="50"></td><td class="style3" ><span class="style5">Cluster &nbsp;&nbsp; <?php echo $retdata[$j-1]['cluster_no']; ?>:</span>&nbsp;&nbsp;&nbsp;<?php echo wordwrap($prev_array,120,'<br>'); ?>  </td></tr></table>

        </page>
       
		
		