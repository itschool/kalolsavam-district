<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
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
			<?php
			$prev_item_code="";
			
            for($j=0;$j<count($partdata);$j++){
				
				if($prev_item_code!=$partdata[$j]['item_code']){
				
						$prev_item_code=$partdata[$j]['item_code'];
						$count=0;
								if($j!=0){
								print("</table></page>");
								}
            
            
            ?>


<page backtop="30mm" backbottom="20mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            <tr>
                <td class="style1" align="center">Itemwise participants list : <?php echo $partdata[$j]['fest_name']; ?></td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer> 

        
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="6" class="tb" align="center" style=" border-bottom:1px #000000; border-right:0px #000000; padding:2px;">Item  :&nbsp;&nbsp;
      <?php echo $partdata[$j]['item_code'];?>&nbsp;-&nbsp;<?php echo $partdata[$j]['item_name'].'  on  '.$partdata[$j]['stage_name'].'('.$partdata[$j]['stage_desc'].')';?>&nbsp;&nbsp;</td>
       
    </tr>
    
    <tr>
        <td class="tb" width='40'  align="center" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Sl.No.</td>
        <td class="tb" width='60'  align="center" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Reg No.</td>
        <td class="tb" width='250'  align="left" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;Name</td>
      <td class="tb" width='30'  align="center" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">B/G</td>
        <td class="tb"  width='40'  align="center" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Class</td>
        <td class="tb" width='260'  align="left" style=" border-bottom:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;School</td>
  </tr>
    <?php
	}
    
   
        $count++;
		if($partdata[$j]['spo_id']!=0)
				{
				$quato_dash_flag=1;
					if($partdata[$j]['is_publish']=='Y'){
					$quato_dash='*';
					}
					else {
					$quato_dash='**';
					}
				}
				else{
				
			$quato_dash='';
				}
    ?>
    <tr>
        <td class="ety"  align="center" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $count;?></td>
        <td class="ety"  align="center" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $partdata[$j]['participant_id'].' '.$quato_dash;?></td>
        <td class="ety" align="left" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo wordwrap($partdata[$j]['participant_name'],30,'<br>');?></td>
        <td class="ety" align="center" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $partdata[$j]['gender'];?></td>                  
        <td class="ety" align="center" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $partdata[$j]['class'];?></td>
        <td  class="ety"align="left" style=" border-bottom:1px #000000; border-right:0px #000000; padding:2px;"'><?php echo wordwrap($partdata[$j]['school_code'].' - '.$partdata[$j]['school_name'].'('.$partdata[$j]['rev_district_name'].')',45,'<br>');?></td>
    </tr>
    <?php 
    }
    ?>
</table>
</page>
		