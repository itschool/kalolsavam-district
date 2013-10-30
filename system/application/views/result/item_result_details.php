<br/>
<?php echo form_open('', array('id' => 'formIWPq'));
echo blue_box_top();
?>
<input type="hidden" name="hidItemId" id="hidItemId" value=""  />
<table width="100%" border="0" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="<?php echo ($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W') ? 6 : 5?>" align="left"> 
    &nbsp;&nbsp;&nbsp;Festival  : 
	<?php echo (@$itempart[0]['fest_name']) ? @$itempart[0]['fest_name'] : @$single[0]['fest_name']; ?>&nbsp;&nbsp;</th>
	<th align="right">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
  </tr>
  <tr>
    <th width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;Item Code & Name  </th>
    <th align="center" width="10%" class="table_row_first">Item Type</th>
	<!-- <th align="center" width="10%" class="table_row_first">Stage</th> -->
    <th align="center" width="10%" class="table_row_first"> No of Students</th>
    <th align="center" width="15%" class="table_row_first">Result Entered</th>
	<th align="center" width="15%" class="table_row_first">Result Not Entered</th>
	<th align="center" width="10%" class="table_row_first">Confirmed</th>
	<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W'){;?>
    <th align="center" width="20%" class="table_row_first">Reset Confirmation</th>
	<?php }?>
  </tr>
  
  <?php
 	for($j = 0; $j < count ($single); $j++)
	{
			if($single[$j]['item_type']=='S')
				$itemtype='Single';
			else if($single[$j]['item_type']=='G')
				$itemtype='Group';
			else 
				$itemtype='';
		
		?>
		<tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<a href="javascript:void(0)" onClick="javascript:getItemResult('<?php echo $single[$j]['item_code'] ?>')">
				<?php echo $single[$j]['item_code'].'&nbsp;-&nbsp;'.$single[$j]['item_name']; ?></a>
			</td>
			<td align="center" class="table_row_first" ><?php echo $itemtype; ?></td>
			<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[$j]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[$j]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[$j]['cpt']-$single[$j]['participated_no']?></td>
			<td id="result_confirm_single<?php echo $j;?>_dis" align="center" class="table_row_first"><?php echo $single[$j]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W'){;?>
		 	<td id="result_confirm_single<?php echo $j;?>" align="center" class="table_row_first">
				<?php if($single[$j]['is_confirmed'] == 'Yes') { ?>
					<a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation('<?php echo $single[$j]['item_code'] ?>', 
						'<?php echo $single[$j]['item_code'].'&nbsp;-&nbsp;'.$single[$j]['item_name']; ?>',
						'result_confirm_single<?php echo $j;?>');">Reset</a>
				<?php } ?>
			</td>
			<?php }?>
	  </tr>

	<?php
	}
	?>
    
    
 <?php
 	for($j = 0; $j < count($itempart); $j++)
	{
			if($itempart[$j]['item_type']=='S')
				$itemtype='Single';
			else if($itempart[$j]['item_type']=='G')
				$itemtype='Group';
			else 
				$itemtype='';
		
	?>
		<tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<a href="javascript:void(0)" onClick="javascript:getItemResult('<?php echo $itempart[$j]['item_code'] ?>')">
				<?php echo $itempart[$j]['item_code'].'&nbsp;-&nbsp;'.$itempart[$j]['item_name']; ?></a>
			</td>
			<td align="center" class="table_row_first" ><?php echo $itemtype; ?></td>
			<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['participated_no']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['cpt']-$itempart[$j]['participated_no']; ?></td>
			<td id="result_confirm_group<?php echo $j;?>_dis"  align="center" class="table_row_first"><?php echo $itempart[$j]['is_confirmed'];?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W'){;?>
		 	<td id="result_confirm_group<?php echo $j;?>" align="center" class="table_row_first">
				<?php if($itempart[$j]['is_confirmed'] == 'Yes') { ?>
					<a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation('<?php echo $itempart[$j]['item_code'] ?>', 
						'<?php echo $itempart[$j]['item_code'].'&nbsp;-&nbsp;'.$itempart[$j]['item_name']; ?>',
						'result_confirm_group<?php echo $j;?>');">Reset</a>
				<?php } ?>
			</td>
			<?php }?>
		</tr>
	<?php
	}
	?>
</table>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >
	<?php
			//$this->load->view('report/report_header');
	?>
<table width="100%" border="1" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
    <th colspan="7" align="left"> 
    &nbsp;&nbsp;&nbsp;Festival  : 
	<?php echo $itempart[0]['fest_name']; ?>&nbsp;&nbsp;</th>
  </tr>
  <tr>
    <th width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;Item Code & Name  </th>
    <th align="center" width="10%" class="table_row_first">Item Type</th>
	<!-- <th align="center" width="10%" class="table_row_first">Stage</th> -->
    <th align="center" width="10%" class="table_row_first"> No of Students</th>
    <th align="center" width="15%" class="table_row_first">Result Entered</th>
	<th align="center" width="15%" class="table_row_first">Result Not Entered</th>
	<th align="center" width="10%" class="table_row_first">Confirmed</th>
  </tr>
  
  <?php
 	for($j = 0; $j < count ($single); $j++)
	{
			if($single[$j]['item_type']=='S')
				$itemtype='Single';
			else if($single[$j]['item_type']=='G')
				$itemtype='Group';
			else 
				$itemtype='';
		
		?>
		<tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<?php echo $single[$j]['item_code'].'&nbsp;-&nbsp;'.$single[$j]['item_name']; ?>
			</td>
			<td align="center" class="table_row_first" ><?php echo $itemtype; ?></td>
			<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[$j]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[$j]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[$j]['cpt']-$single[$j]['participated_no']?></td>
			<td id="result_confirm_single<?php echo $j;?>_dis" align="center" class="table_row_first"><?php echo $single[$j]['is_confirmed']; ?></td>
	  </tr>

	<?php
	}
	?>
    
    
 <?php
 	for($j = 0; $j < count($itempart); $j++)
	{
			if($itempart[$j]['item_type']=='S')
				$itemtype='Single';
			else if($itempart[$j]['item_type']=='G')
				$itemtype='Group';
			else 
				$itemtype='';
		
	?>
		<tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<?php echo $itempart[$j]['item_code'].'&nbsp;-&nbsp;'.$itempart[$j]['item_name']; ?>
			</td>
			<td align="center" class="table_row_first" ><?php echo $itemtype; ?></td>
			<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['participated_no']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['cpt']-$itempart[$j]['participated_no']; ?></td>
			<td id="result_confirm_group<?php echo $j;?>_dis"  align="center" class="table_row_first"><?php echo $itempart[$j]['is_confirmed'];?></td>
		</tr>
	<?php
	}
	?>
</table>
<?php
		//$this->load->view('report/report_footer');
?>
</div>
<!-- display content ends here --------------------------------------->
<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>