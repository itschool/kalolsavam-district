<?php echo form_open('', array('id' => 'list_district'));
echo blue_box_top();
?>
<input type="hidden" name="sel_sub_district_id" id="sel_sub_district_id">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="6"><?php echo $district_name;?>&nbsp;District </th>
		<th align="center">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
	</tr>
	<tr>
		<th width="5%" align="center">Sl No</th>
        <th width="20%" align="left">Sub-District Name</th>
		<th width="15%" align="center">Total Schools</th>
        <th width="15%" align="center">Data Entered</th>
		<th width="15%" align="center">Data Not Entered</th>
        <th width="15%" align="center">Confirmed</th>
		<th width="15%" align="center">Not Confirmed</th>
	</tr>
        <?php
		$sub_district_details1 = $sub_district_details;
		if (is_array($sub_district_details) && count($sub_district_details) >0)
		{
			foreach ($sub_district_details as $key => $sub_district_details)
			{
				$sub_details		=	$this->login_model->get_sub_school_details($sub_district_details['sub_district_code']);
			?>
				<tr>
					<td align="center" class="table_row_first"><?php echo $key+1?></td>
					<td  align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;
						<a href="javascript:void(0)" onClick="javascript:fncListClustertDetails('<?php echo $sub_district_details['sub_district_code']?>');return false;">
						<?php echo $sub_district_details['sub_district_name'];?>
						</a>
					</td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['total_school']?></td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['data_entered']?></td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['total_school'] - $sub_details['data_entered']?></td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['confirmed']?></td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['total_school'] - $sub_details['confirmed']?></td>
				 </tr>
			
			<?php
			}
		}
		?>
        
</table>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >
<table width="100%" border="1" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="7"><?php echo $district_name;?>&nbsp;District </th>
	</tr>
	<tr>
		<th width="5%" align="center">Sl No</th>
        <th width="20%" align="left">Sub-District Name</th>
		<th width="15%" align="center">Total Schools</th>
        <th width="15%" align="center">Data Entered</th>
		<th width="15%" align="center">Data Not Entered</th>
        <th width="15%" align="center">Confirmed</th>
		<th width="15%" align="center">Not Confirmed</th>
	</tr>
        <?php
		if (is_array($sub_district_details1) && count($sub_district_details1) >0)
		{
			foreach ($sub_district_details1 as $key => $sub_district_details)
			{
				$sub_details		=	$this->login_model->get_sub_school_details($sub_district_details['sub_district_code']);
			?>
				<tr>
					<td align="center" class="table_row_first"><?php echo $key+1?></td>
					<td  align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;
						<?php echo $sub_district_details['sub_district_name'];?>
					</td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['total_school']?></td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['data_entered']?></td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['total_school'] - $sub_details['data_entered']?></td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['confirmed']?></td>
					<td  align="center" class="table_row_first"><?php echo $sub_details['total_school'] - $sub_details['confirmed']?></td>
				 </tr>
			
			<?php
			}
		}
		?>
        
</table>
</div>
<!-- display content ends here --------------------------------------->
<?php
echo blue_box_bottom();
echo form_close();
?>