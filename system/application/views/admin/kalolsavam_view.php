<div align="center" class="heading_gray">
	<h3>Kalolsavam Details</h3>
</div>
<?php 
if (@$add_edit_kalolsavam != 'no'){
	echo '<br/>';
	echo form_open_multipart('admin/kalolsavam/add_kalolsavam', array('id' => 'formKalolsavam'));
	echo blue_box_top();
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	  <tr>
		<th align="left" colspan="4">Kalolsavam</th>
	  </tr>
	  <tr>
		<td align="left" width="20%" class="table_row_first">Kalolsavam Logo</td>
		<td align="left" width="50%" class="table_row_first"><?php display_kalolsavam_logo ('state', @$selected_kalolsavam[0]['logo_name']);?></td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" class="table_row_first">Kalolsavam Name</td>
		<td align="left" class="table_row_first"><?php echo form_input("txtKalolsavamName", @$selected_kalolsavam[0]['kalolsavam_name'], 'class="input_box" id="txtKalolsavamName" ');?></td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" class="table_row_first">Kalolsavam Year</td>
		<td align="left" class="table_row_first"><?php echo form_input("txtKalolsavamYear", @$selected_kalolsavam[0]['kalolsavam_year'], 'class="input_box" id="txtKalolsavamYear" ');?></td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	   <tr>
		<td align="left" class="table_row_first">Venue</td>
		<td align="left" class="table_row_first"><?php echo form_input("txtKalolsavamVenue", @$selected_kalolsavam[0]['venue'], 'class="input_box" id="txtKalolsavamVenue" ');?></td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left"  class="table_row_first">Start Date</td>
		<td align="left" class="table_row_first">
			<?php if($selected_kalolsavam[0]['start_date'] == '0000-00-00') $start_date = '';else $start_date = $selected_kalolsavam[0]['start_date'];?>
			<?php echo form_input("txtStartDate", @$start_date, 'class="input_box" id="txtStartDate"  onfocus="javascript:displayCalendar($(\'txtStartDate\'),\'yyyy-mm-dd\',this);" ');?>
			 <img src="<?php echo image_url();?>calender.gif" onclick="displayCalendar($('txtStartDate'),'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" />
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left"  class="table_row_first">End Date</td>
		<td align="left" class="table_row_first">
			<?php if($selected_kalolsavam[0]['end_date'] == '0000-00-00') $end_date = '';else $end_date = $selected_kalolsavam[0]['end_date'];?>
			<?php echo form_input("txtEndDate", @$end_date, 'class="input_box" id="txtEndDate" ');?>
			<img src="<?php echo image_url();?>calender.gif" onclick="displayCalendar($('txtEndDate'),'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" />
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" class="table_row_first">Upload Logo</td>
		<td align="left" class="table_row_first">
			<?php echo form_upload("kalolsavamLogo", 'class="input_box" id="kalolsavamLogo" ');?>
			<span class="guide_line">(.jpg, .gif, .png)</span>
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center" colspan="2">
			<?php echo (count(@$selected_kalolsavam) > 0 ) ? form_button('update_kalolsavam', 'Update', 
					'id="update_kalolsavam" onClick="javascript:fncUpdateKalolsavam(\'state\',\''.$selected_kalolsavam[0]['kalolsavam_id'].'\');return false;"').'&nbsp;&nbsp;'.
					form_button('Cancel', 'Cancel', 'onClick="javascript:fncCancelKalolsavam();return false;"'): form_button('save_kalolsavam', 'Save', 'id="save_kalolsavam" onClick="javascript:fncSaveKalolsavam();"');?>
		</td>
	  </tr>
	</table>
	<?php if (isset($kalolsavam_id) && !empty($kalolsavam_id)) {?>
		<input type="hidden" name="kalolsavam_id" id="kalolsavam_id" value="<?php echo  $kalolsavam_id;?>" />
	<?php }?>
	<?php
	echo blue_box_bottom();
	echo form_close();
}
?>
<br/>
<?php echo form_open('user/admin_users/add_admin', array('id' => 'list_formKalolsavam'));
echo blue_box_top();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th width="5%">Sl No.</th>
	<th width="30%">Kalolsavam Name</th>
	<th width="15%">Kalolsavam Year</th>
	<th width="20%">Date</th>
	<th width="35%">Venue</th>
	<th width="10%">Edit</th>
  </tr>
  <?php 
  $count = 0;
  foreach($kalolsavam_details as $kalolsavam){
  	$count++;
  	$class_name = ($count % 2 == 0) ? 'table_row_second' : 'table_row_first';
  ?>
  	<tr>
		<td align="left" class="<?php echo $class_name;?>" ><?php echo $count;?></td>
		<td align="left" class="<?php echo $class_name;?>" ><?php echo $kalolsavam['kalolsavam_name'];?></td>
		<td align="left" class="<?php echo $class_name;?>" ><?php echo $kalolsavam['kalolsavam_year'];?></td>
		<td align="left" class="<?php echo $class_name;?>" ><?php echo $kalolsavam['venue'];?></td>
		<td align="left" class="<?php echo $class_name;?>" >
			<?php
				if($kalolsavam['start_date'] == '0000-00-00') echo 'NULL';else echo date("j M Y", strtotime($kalolsavam['start_date']));
				echo '&nbsp; - &nbsp;';
				if($kalolsavam['end_date'] == '0000-00-00') echo 'NULL';else echo date("j M Y", strtotime($kalolsavam['end_date']));
			?>
		</td>
		<td align="left" class="<?php echo $class_name;?>">
			<?php if ($kalolsavam['status'] == 'O'){?>
			<a href="javascript:void(0)" onClick="javascript:fncEditKalolsavam('<?php echo $kalolsavam['kalolsavam_id']?>');return false;">
				<img src="<?php echo base_url(false)?>images/edit.gif" border="0">
			</a>
			<?php }?>
		</td>
	</tr>
  <?php }?>
</table>
<input type="hidden" name="sel_kalolsavam_id" id="sel_kalolsavam_id" />
<?php
echo blue_box_bottom();
echo form_close();
?>
