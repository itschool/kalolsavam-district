<?php echo form_open('', array('id' => 'noncluster'));
echo blue_box_top();
?>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="1">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
    	<th colspan="4">Non Cluster Schools
        	</th>
		<th align="center">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
    </tr>
    <tr>
		<th align="left" width="5%">SI.No</th>
		<th width="50%" align="left">School</th>
        <th width="15%" align="center">Data Entered</th>
        <th width="10%" align="center">Confirmed</th>
		<?php if ($this->session->userdata('USER_TYPE') <= 3){?>
        <th width="15%" align="center">Reset Confirmation</th>
        <?php }else{?>
        <th width="15%" align="center">&nbsp;</th>
         <?php }?>
	</tr>
        <?php
		$countt=0;
		for($j=0;$j<count($val);$j++){
		$countt++;
		
				
				$entry='Yes';
				 if($val[$j]['is_finalize']=='Y')
				 	$finalize='Yes';
				else if($val[$j]['is_finalize']=='N')
					$finalize='No';
				else 
					$finalize='No';
				$status = (empty($school[$j]['is_finalize']))? 'N' : $school[$j]['is_finalize'];
		?>
        <tr>
			<td align="left" class="table_row_first"><?php echo $countt;?></td>
        	<td align="left" &nbsp;&nbsp;&nbsp; class="table_row_first">
				<a href="javascript:void(0)" onClick="javascript:nonclustschooldet('<?php echo $val[$j]['school_code']?>')">
				<?php echo $val[$j]['school_code'];  ?>&nbsp;-&nbsp;
				<?php echo $val[$j]['school_name'];  ?></a></td>
			<td align="center" class="table_row_first"><?php echo $entry; ?></td>
			<td id="<?php echo 'confirm_'.($j+1);?>" align="center" class="table_row_first"><?php echo $finalize; ?></td>
			<?php if ($this->session->userdata('USER_TYPE') <= 3){?>
            <td id="<?php echo 'confirm_'.($j+1);?>_dis" align="center" class="table_row_first">
				<?php
				if('Yes' == $finalize)
				{
				?>
					<a id="<?php echo ($j+1);?>" href="javascript:void(null);" 
						onClick="javascript:fnc_change_confirmation_status('<?php echo addslashes($val[$j]['school_name']).' - '.$val[$j]['school_code'];  ?>',<?php echo $val[$j]['school_code'];?>, '<?php echo 'confirm_'.($j+1);?>');return;">
						Reset 
					</a>
				<?php 
				}
				?>
			</td>
             <?php }else{?>
        	<td align="center" class="table_row_first">&nbsp;</td>
            <?php }?>
	  </tr>
        
        <?php
		$flag=0;
		}
		if(count($nonschool)>0){
			for($k=0;$k<count($nonschool);$k++){
				$fgflag=0;
			
				for($l=0;$l<count($val);$l++){
					if($val[$l]['school_code']==$nonschool[$k]['school_code']){
						$fgflag=1;
						break;
					}
				}
				if($fgflag==0){
			
					$countt++;
        			$entry='No';
					$finalize='No';
					
				//$status = (empty($school[$j]['is_finalize']))? 'N' : $school[$j]['is_finalize'];
		?>
        <tr>
			<td align="left" class="table_row_first"><?php echo $countt;?></td>
        	<td align="left" &nbsp;&nbsp;&nbsp; class="table_row_first">
				<a href="javascript:void(0)" onClick="javascript:nonclustschooldet('<?php echo $nonschool[$k]['school_code']?>')">
				<?php echo $nonschool[$k]['school_code'];  ?>&nbsp;-&nbsp;
				<?php echo $nonschool[$k]['school_name'];  ?></a></td>
			<td align="center" class="table_row_first"><?php echo $entry; ?></td>
			<td id="<?php echo 'confirm_'.($k+1);?>" align="center" class="table_row_first"><?php echo $finalize; ?></td>
			<?php if ($this->session->userdata('USER_TYPE') <= 3){?>
            <td id="<?php echo 'confirm_'.($k+1);?>_dis" align="center" class="table_row_first">
				<?php
				if('Yes' == $finalize)
				{
				?>
					<a id="<?php echo ($k+1);?>" href="javascript:void(null);" 
						onClick="javascript:fnc_change_confirmation_status('<?php echo addslashes($nonschool[$k]['school_name']).' - '.$nonschool[$k]['school_code'];  ?>',<?php echo $nonschool[$k]['school_code'];?>, '<?php echo 'confirm_'.($k+1);?>');return;">
						Reset 
					</a>
				<?php 
				}
				?>
			</td>
             <?php }else{?>
        	<td align="center" class="table_row_first">&nbsp;</td>
            <?php }?>
	  </tr>
    
        <?php } }}?>
        
</table>
<input type="hidden" name="sel_sub_district_id" id="sel_sub_district_id" value="<?php //echo $this->input->post('sel_sub_district_id'); ?>"/>
	<?php
    echo blue_box_bottom();
    echo form_close();
    ?>
	<!-- print content start here -->
 <div id="print_content" class="display_none" >
  
  <table width="100%" border="1" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
    	<th colspan="5">Non Cluster Schools
   	  
    <tr>
		<th align="left" width="5%">SI.No</th>
		<th width="50%" align="left">School</th>
        <th width="15%" align="center">Data Entered</th>
        <th width="10%" align="center">Confirmed</th>
	</tr>
        <?php
		$countt=0;
		for($j=0;$j<count($val);$j++){
		$countt++;
		
				
				$entry='Yes';
				 if($val[$j]['is_finalize']=='Y')
				 	$finalize='Yes';
				else if($val[$j]['is_finalize']=='N')
					$finalize='No';
				else 
					$finalize='No';
				$status = (empty($school[$j]['is_finalize']))? 'N' : $school[$j]['is_finalize'];
		?>
        <tr>
			<td align="center" class="table_row_first"><?php echo $countt;?></td>
        	<td align="left" &nbsp;&nbsp;&nbsp; class="table_row_first">
				
				<?php echo $val[$j]['school_code'];  ?>&nbsp;-&nbsp;
				<?php echo $val[$j]['school_name'];  ?></td>
			<td align="center" class="table_row_first"><?php echo $entry; ?></td>
			<td id="<?php echo 'confirm_'.($j+1);?>" align="center" class="table_row_first"><?php echo $finalize; ?></td>
	
		
	  </tr>
        
        <?php
		$flag=0;
		}
		if(count($nonschool)>0){
			for($k=0;$k<count($nonschool);$k++){
				$fgflag=0;
			
				for($l=0;$l<count($val);$l++){
					if($val[$l]['school_code']==$nonschool[$k]['school_code']){
						$fgflag=1;
						break;
					}
				}
				if($fgflag==0){
					$countt++;
        			$entry='No';
					$finalize='No';
					
				//$status = (empty($school[$j]['is_finalize']))? 'N' : $school[$j]['is_finalize'];
		?>
        <tr>
			<td align="center" class="table_row_first"><?php echo $countt;?></td>
        	<td align="left" &nbsp;&nbsp;&nbsp; class="table_row_first">
				<?php echo $nonschool[$k]['school_code'];  ?>&nbsp;-&nbsp;
				<?php echo $nonschool[$k]['school_name'];  ?></td>
			<td align="center" class="table_row_first"><?php echo $entry; ?></td>
			<td id="<?php echo 'confirm_'.($k+1);?>" align="center" class="table_row_first"><?php echo $finalize; ?></td>
	  </tr>
    
        <?php } }}?>
        
</table>
</div>
	<!-- print content end here -->