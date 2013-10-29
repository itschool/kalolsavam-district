<div id="divEntryForm">
<div align="center" class="heading_gray">
<h3>Stage Allotment</h3>
</div>
<br />
<?php echo form_open('stage/allotment/save_allotment', array('id' => 'formAllotment', 'name' => 'formAllotment'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th width="4%" colspan="4" align="left">Allotment Form.</th>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_first">Item Code : </td>
		<td align="left" width="30%" class="table_row_first">
			<div id="divSchoolCode">
				<?php echo form_input("txtItemCode", @$selected_item[0]['item_code'], 'class="input_box_small" id="txtItemCode" onkeypress="javascript:return numbersonly(this, event, false);" onBlur="javascript:fetch_item_details()" onkeyup="javascript:dummy_change_text_max_to_focus(\'txtItemCode\',\'cmbStage\',this);" maxlength="4" ');?>
        	</div>        
        </td>
		<td align="left" width="20%" class="table_row_first">Item Name : </td>
		<td align="left" width="30%" class="table_row_first"><?php @print($selected_item[0]['item_name'])?></td>
	</tr>
    <tr>
		<td align="left" width="20%" class="table_row_first">Number of participants: </td>
		<td align="left" width="30%" class="table_row_first"><?php @print($selected_item[0]['total_participants'])?></td>

    	<td align="left" width="20%" class="table_row_first">Approximate time taken : </td>
		<td align="left" width="30%" class="table_row_first"><?php @print(get_time_format((int)$selected_item[0]['total_time']));// + ((int)@$interval_bw_items * @$selected_item[0]['total_participants']))?></td>
    </tr>
	<tr>
		<td align="left" width="20%" class="table_row_second">Stage : </td>
		<td align="left" width="30%" class="table_row_second">
		<?php 
			$stage_array	=	array('0' => '-- Stage --');
			for($i = 0; $i < count($stages); $i++ ){
				$stage_array[$stages[$i]['stage_id']]	=	$stages[$i]['stage_name'];
			}
			echo form_dropdown("cmbStage", $stage_array, @$alloted_records[0]['stage_id'],'id="cmbStage" class="select_box_medium"');
			?>
      	</td>
        <td align="left" width="50%" colspan="2" class="table_row_second">
			<?php 
				if(@$alloted_records[0]['start_time'])
				{
					$explode_date	=	explode(' ', @$alloted_records[0]['start_time']);
					$date			=	$explode_date[0];
					$time_explode	=	explode(':',$explode_date[1]);
					$hour			=	$time_explode[0];
					$minute			=	$time_explode[1];				
				}
			?>
            Date :&nbsp;&nbsp;&nbsp;
            <?php echo form_dropdown("txtDate", @$date_array,(@$date != '') ? $date :'', 'class="select_box_medium" id="txtDate"' );?>
            <!--<input class="input_box date_field" type="text" onfocus="displayCalendar(document.formAllotment.txtDate,'yyyy-mm-dd',this)" name="txtDate" id="txtDate" value="<?php echo @$date; ?>" readonly="readonly">-->
          	<!--<input class="input_box date_field" type="text"   onFocus="javascript:vDateType='3'" onBlur="DateFormat(this,this.value,event,true,'3')" onKeyDown="DateFormat(this,this.value,event,false,'3')" onKeyUp="DateFormat(this,this.value,event,false,'3')" maxlength="10"  name="txtDate" id="txtDate" value="<?php //echo $start_date; ?>">-->
            <!--<img src="<?php echo image_url();?>calender.gif" onclick="displayCalendar(document.formAllotment.txtDate,'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" />-->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Time :
            <?php echo form_dropdown("txtHour", @$hour_array,(@$hour != '') ? $hour :'HH', 'class="input_box_medium" id="txtHour" maxlength="2" onfocus="javascript:clearText(\'txtHour\', \'HH\')" onBlur="javascript:clearText(\'txtHour\', \'HH\')" onkeyup="javascript:change_text_max_to_focus_jump(\'txtHour\', \'txtMin\', \'2\')"' );?>
            <?php echo form_dropdown("txtMin", @$min_array,(@$minute != '') ? @$minute : 'MM', 'class="input_box_medium" id="txtMin" maxlength="2" onfocus="javascript:clearText(\'txtMin\', \'MM\')" onBlur="javascript:clearText(\'txtMin\', \'MM\')" ' );?>
        </td>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_second">No of clusters : </td>
		<td align="left" width="30%" colspan="1" class="table_row_second">
			<?php 
			$value_array	=	array();
			$limit = (@$selected_item[0]['is_off_stage'] == 'Y') ? 1 : (($no_of_clusters > @$selected_item[0]['total_participants']) ? @$selected_item[0]['total_participants'] : $no_of_clusters);
			for($i = 1; $i <= $limit; $i++ )
				$value_array[$i]	=	$i;
			
			echo form_dropdown("cmbNoOfCluster", $value_array, @$alloted_records[0]['no_of_cluster'],'id="cmbNoOfCluster" class="input_box_small"');?>
        </td>
        <td align="left" width="20%" class="table_row_second">No of judges : </td>
		<td align="left" width="30%" colspan="1" class="table_row_second">
			<?php 
			$judge_array	=	array('0' => '0');
			for($i = 1; $i <= $no_of_judges; $i++ )
				$judge_array[$i]	=	$i;
			
			echo form_dropdown("cmbNoOfJudges", $judge_array, (@$alloted_records[0]['no_of_judges']) ? @$alloted_records[0]['no_of_judges'] : '3','id="cmbNoOfJudges" class="input_box_small"');?>
        </td>
		
		
	</tr>
	<tr>
		<td align="center" colspan="4">
		<?php 
			if (isset($is_edit) and $is_edit != 'no'){
				echo (@count($alloted_records) > 0) ? form_button('Update', 'Update', 'onClick="javascript:fncCheckAllotmentDeatils(1)"') : form_button('Save', 'Save', 'onClick="javascript:fncCheckAllotmentDeatils(0)"');
			}
		?>
		</td>
	</tr>
</table>
<input type="hidden" name="hidItemId" id="hidItemId" value="<?php echo (@$selected_item[0]['item_code']) ? @$selected_item[0]['item_code'] : @$this->input->post('hidItemId');?>">
<input type="hidden" name="hidMaxPartcipants" id="hidMaxPartcipants" value="<?php @print($selected_item[0]['total_participants'])?>">
<input type="hidden" name="hidMaxTime" id="hidMaxTime" value="<?php @print($selected_item[0]['max_time'])?>">
<input type="hidden" name="hidTimeType" id="hidTimeType" value="<?php @print($selected_item[0]['time_type'])?>">
<input type="hidden" name="hidNoOfCluster" id="hidNoOfCluster" value="<?php @print($alloted_records[0]['no_of_cluster'])?>">

<?php 
echo blue_box_bottom();
echo form_close();
?>
<br>
<?php 
if(count(@$cluster_master_details) > 0 ){
echo form_open('stage/allotment/edit_cluster_master', array('id' => 'formEditClusterMaster', 'name' => 'formEditClusterMaster'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="5" align="left">Cluster</th>
	</tr>
	<tr>
		<th align="center" width="15%">Cluster No</th>
		<th align="left" width="20%">Stage</th>
		<th align="center" width="15%">No of Participant</th>
		<th align="left" width="25%">Start time</th>
		<th align="left" width="25%">End time</th>
	</tr>
	<?php 
	$count		=	0;
	foreach($cluster_master_details as $cluster_master){
		$count++;
		$class_name = ($count % 2 == 0) ? 'table_row_second' : 'table_row_first';
	?>
	<tr>
		<td class="<?php echo $class_name?>" align="center"><?php echo $cluster_master['cluster_no']?></td>
		<td class="<?php echo $class_name?>" align="left"><?php echo $cluster_master['stage_name']?></td>
		<td class="<?php echo $class_name?>" align="center"><?php echo $cluster_master['no_of_participant']?></td>
		<td class="<?php echo $class_name?>" align="left"><?php echo datetophpmodel($cluster_master['start_time']).' '.timephpmodel($cluster_master['start_time'])?></td>
		<td class="<?php echo $class_name?>" align="left"><?php echo datetophpmodel($cluster_master['end_time']).' '.timephpmodel($cluster_master['end_time'])?></td>
	</tr>
	<?php }?>
</table>
	
<?php 
echo blue_box_bottom();
echo form_close();
}
?>
<br>
<?php 
if(count($alloted_records) > 0 ){
echo form_open('stage/allotment/update_cluster_participant', array('id' => 'formUpdateClusterParticipant', 'name' => 'formUpdateClusterParticipant'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th width="4%" colspan="4" align="left">Allotments</th>
	</tr>
	<tr>
		<th>Reg No</th>
		<th>School code</th>
		<th>Cluster no</th>
	</tr>
	<?php
	$value_array	=	array();
			$limit = $alloted_records[0]['no_of_cluster'];
			for($i = 1; $i <= $limit; $i++ )
				$value_array[$i]	=	$i;
			
	for($i = 0; $i < count($alloted_records); $i++)
	{
		$class_name = ($i % 2 == 0) ? 'table_row_second' : 'table_row_first';
		echo '<tr><td class="'.$class_name.'">';
		echo $alloted_records[$i]['participant_id'];
		echo '</td><td class="'.$class_name.'">';
		echo $alloted_records[$i]['school_code'];
		echo '</td><td class="'.$class_name.'">';
		echo form_dropdown("cmbClusterNo_".$alloted_records[$i]['cp_id'], $value_array, $alloted_records[$i]['cluster_no'],'id="cmbClusterNo_'.$alloted_records[$i]['cp_id'].'"	');
		echo '</td></tr>';
	}
	?>
	<input type="hidden" name="hidClusterItemCode" id="hidClusterItemCode" value="<?php @print($alloted_records[0]['item_code'])?>">
	<?php if($this->Session_Model->check_user_permission(3)){?>
    <tr>
		<td align="center" colspan="3">
		<?php 
		echo (@count($alloted_records) > 0) ? form_button('Update', 'Update', 'onClick="javascript:fncUpdateCluster()"') : '';
		?>
		</td>
	</tr>
    <?php }?>
</table>
<?php 
echo blue_box_bottom();
echo form_close();
}
?>
