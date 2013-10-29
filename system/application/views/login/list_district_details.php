<?php echo form_open('', array('id' => 'list_district'));
echo blue_box_top();
?>
<input type="hidden" name="sel_district_id" id="sel_district_id" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="6">District List</th>
		<th align="right">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
	</tr>
	<tr>
		<th width="5%" align="center">Sl No</th>
        <th width="20%" align="left">District Name</th>
		<th width="15%" align="center">Total Schools</th>
        <th width="15%" align="center">Data Entered</th>
		<th width="15%" align="center">Data Not Entered</th>
        <th width="15%" align="center">Confirmed</th>
		<th width="15%" align="center">Not Confirmed</th>
        <?php
		$district_details1 = $district_details;
		if (is_array($district_details) && count($district_details) >0)
		{
			foreach ($district_details as $key => $district_details)
			{
				$dist_details		=	$this->login_model->get_district_school_details($district_details['rev_district_code']);
			?>
				<tr>
					<td align="center" class="table_row_first"><?php echo $key+1?></td>
					<td  align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;
						<a href="javascript:void(0)" onClick="javascript:fncListSubDistrictDetails('<?php echo $district_details['rev_district_code']?>');return false;">
						<?php echo $district_details['rev_district_name'];?>
						</a>
					</td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['total_school']?></td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['data_entered']?></td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['total_school'] - $dist_details['data_entered']?></td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['confirmed']?></td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['total_school'] - $dist_details['confirmed']?></td>
				 </tr>
			
			<?php
			}
		}
		
		?>
        
</table>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >
<?php //$this->load->view('report/report_header'); ?>
<table width="100%" border="1" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="7">District List</th>
	</tr>
	<tr>
		<th width="5%" align="center">Sl No</th>
        <th width="20%" align="left">District Name</th>
		<th width="15%" align="center">Total Schools</th>
        <th width="15%" align="center">Data Entered</th>
		<th width="15%" align="center">Data Not Entered</th>
        <th width="15%" align="center">Confirmed</th>
		<th width="15%" align="center">Not Confirmed</th>
        <?php
		
		if (is_array($district_details1) && count($district_details1) >0)
		{
			foreach ($district_details1 as $key => $district_details)
			{
				$dist_details		=	$this->login_model->get_district_school_details($district_details['rev_district_code']);
			?>
				<tr>
					<td align="center" class="table_row_first"><?php echo $key+1?></td>
					<td  align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;
						<?php echo $district_details['rev_district_name'];?>
					</td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['total_school']?></td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['data_entered']?></td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['total_school'] - $dist_details['data_entered']?></td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['confirmed']?></td>
					<td  align="center" class="table_row_first"><?php echo $dist_details['total_school'] - $dist_details['confirmed']?></td>
				 </tr>
			
			<?php
			}
		}
		?>
        
</table>
<?php
		//$this->load->view('report/report_footer');
?>
</div>
<!-- display content ends here --------------------------------------->
<?php
echo blue_box_bottom();
echo form_close();
?>