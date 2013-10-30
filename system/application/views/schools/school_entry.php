<div id="divEntryForm">
<div align="center" class="heading_gray">
<h3>School Entry </h3>
</div>
<br/>
<?php echo form_open('schools/registration/update', array('id' => 'formSchool'));
echo blue_box_top();
?>
<input type="hidden" name="hidTeachers" id="hidTeachers" value="1">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th width="4%" colspan="4" align="left">Entry Form.</th>
	</tr>
	<tr>
		<td align="left" width="24%" class="table_row_first">School Code : </td>
		<td align="left" width="30%" class="table_row_first">
        <div id="divSchoolCode">
		<?php 
		if(trim($this->session->userdata('SCHOOL_CODE')) != 0 or @$school_show == 'edit')
		{
			echo @$school_details[0]['school_code'];
		}
		else
		{
			echo form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="input_box" id="txtSchoolCode" onkeypress="javascript:return numbersonly(this, event, false);" onBlur="javascript:fetch_school_details()"');
		}
		?>
        </div>
        </td>
		<td align="left" width="18%" class="table_row_first">School Name : </td>
		<td align="left" width="28%" class="table_row_first"><strong><?php @print($school_details[0]['school_name'])?></strong></td>
	</tr>
    <tr>
		<td align="left"  class="table_row_first">School Phone(with STD code) : </td>
		<td align="left" colspan="3" class="table_row_first">
			<?php echo (@$school_show == 'show') ? @$school_details[0]['school_phone'] : form_input("txtSchoolPhone", @$school_details[0]['school_phone'], 'class="input_box" id="txtSchoolPhone" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?>
        	<br />(eg;- 04872448276)
        </td>
	</tr>
    <tr>
		<td align="left"  class="table_row_first">E-mail : </td>
		<td align="left" colspan="3" class="table_row_first"><?php echo (@$school_show == 'show') ? @$school_details[0]['school_email'] : form_input("txtSchoolEmail", @$school_details[0]['school_email'], 'class="input_box" id="txtSchoolEmail" maxlength="100" ');?></td>
	</tr>
	<tr>
		<td align="left" class="table_row_second">Standard : </td>
		<td align="left" class="table_row_second">From : <?php echo (@$school_show == 'show') ? @$school_details[0]['class_start'] : form_dropdown("txtStandardFrom", array(0=>'', 1 => 1, 5 => 5, 8 => 8, 11 => 11), @$school_details[0]['class_start'],'id="txtStandardFrom" class="input_box_medium" onChange="javascript:fncShowHideStd()"');?></td>
		<td align="left" colspan="2" class="table_row_second">To : <?php echo (@$school_show == 'show') ? @$school_details[0]['class_end'] : form_dropdown("txtStandardTo", array( 0=>'', 4 => 4, 5 => 5, 7 => 7, 10 => 10, 12 => 12), @$school_details[0]['class_end'],'id="txtStandardTo" class="input_box_medium"  onChange="javascript:fncShowHideStd()"');?></td>
	</tr>
	<tr>
		<td align="left"  class="table_row_first">School Type : </td>
		<td align="left" colspan="3" class="table_row_first">
		<?php 
		if(@$school_details[0]['school_type'] == 'G') 
			$type	=	'Government';
		else if(@$school_details[0]['school_type'] == 'A') 
			 $type	= 	'Aided';
		else if(@$school_details[0]['school_type'] == 'U') 
			$type	= 	'Unaided' ;
		else
			$type	= '';
		echo $type;?>
		</td>
	</tr>
	
	<tr>
		<td align="left" class="table_row_first">Principal : </td>
        
        
		<td align="left" colspan="3" class="table_row_first">
			<?php echo (@$school_show == 'show') ? @$school_details[0]['principal_name'] : form_input("txtPrincipal", @$school_details[0]['principal_name'], 'class="input_box" id="txtPrincipal" onkeyup="javascript:this.value=this.value.toUpperCase();"');?>
        	&nbsp;
            Phone : 
            <?php echo (@$school_show == 'show') ? @$school_details[0]['principal_phone'] : form_input("txtPrincipalPhone", @$school_details[0]['principal_phone'], 'class="input_box" id="txtPrincipalPhone"  maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?>
        </td>
		
        <!--<td align="left" width="20%" class="table_row_first">Phone : </td>
		<td align="left" width="30%" class="table_row_first"><?php echo (@$school_show == 'show') ? @$school_details[0]['principal_phone'] : form_input("txtPrincipalPhone", @$school_details[0]['principal_phone'], 'class="input_box" id="txtPrincipalPhone"  maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?></td>-->
	</tr>
    <tr>
		<td align="left" class="table_row_first">Headmaster : </td>
		<td align="left" colspan="3" class="table_row_first">
			<?php echo (@$school_show == 'show') ? @$school_details[0]['hm_name'] : form_input("txtHeadmaster", @$school_details[0]['hm_name'], 'class="input_box" id="txtHeadmaster" onkeyup="javascript:this.value=this.value.toUpperCase();"');?>
        	&nbsp;
            Phone : 
            <?php echo (@$school_show == 'show') ? @$school_details[0]['hm_phone'] : form_input("txtHeadmasterPhone", @$school_details[0]['hm_phone'], 'class="input_box" id="txtHeadmasterPhone"  maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?>
        </td>
		<!--<td align="left" width="20%" class="table_row_first">Phone : </td>
		<td align="left" width="30%" class="table_row_first"><?php echo (@$school_show == 'show') ? @$school_details[0]['hm_phone'] : form_input("txtHeadmasterPhone", @$school_details[0]['hm_phone'], 'class="input_box" id="txtHeadmasterPhone"  maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?></td>-->
	</tr>
	
	<tr>
		<td align="left" class="table_row_first"  valign="top">Team Managers : </td>
		<td align="left" colspan="3" class="table_row_first">
        	<div id="teachersRow">
			<?php 
			if (@$school_show == 'show'){
				if(@$school_details[0]['teachers'] != ''){
					$teachers	=	explode("#@#", $school_details[0]['teachers']);
					echo '<table cellpadding="2" cellspacing="2" border="0">';
					for($i=0; $i < count($teachers); $i++){
						$teachers_details	=	explode('#$#', $teachers[$i]);
						if(count($teachers_details) > 1){
							echo '<tr><td>'.@$teachers_details[0].'</td><td>&nbsp;&nbsp;&nbsp;Phone : </td><td>'.@$teachers_details[1].'</td></tr>';
						}
					}
					echo '</table>';
				}
			?>
			</div>
			<div class="clear"></div>
			<?php
			} else if (@$school_show == 'edit'){
				if(@$school_details[0]['teachers'] != ''){
					$teachers	=	explode("#@#", $school_details[0]['teachers']);
					for($i=1; $i < count($teachers); $i++){
						$teachers_details	=	explode('#$#', $teachers[$i-1]);
						?>
						<div class="clear_both"></div>
						<div class="teachersTextBox">
						<?php
						$name	=	'txtTeacher_'.$i;
						$phone	=	'txtPhone_'.$i;
						echo form_input($name, $teachers_details[0], 'class="input_box" id="'.$name.'"  onkeyup="javascript:this.value=this.value.toUpperCase();"').'&nbsp;&nbsp;&nbsp;Phone : '.form_input($phone, @$teachers_details[1], 'class="input_box" id="'.$phone.'" onkeypress="javascript:return numbersonly(this, event, false);" maxlength="11"')."</div>";
					}
					$teachersCount	=	(int)count($teachers)-1;
					echo "<script>$('hidTeachers').value=".$teachersCount."</script>";
					?>
					</div>
					<div class="clear"></div>
					<a href="javascript:void(0)" onclick="javascript:addteacher(); return false;">Add New</a>	
					<?php
				}else{
					echo "<script>$('hidTeachers').value=0</script>";
					?>
					</div>
					<div class="clear"></div>
					<a href="javascript:void(0)" onclick="javascript:addteacher(); return false;">Add New</a>	
					<?php
				}
				
			}else{
				echo form_input("txtTeacher_1", '', 'class="input_box" id="txtTeacher_1" onkeyup="javascript:this.value=this.value.toUpperCase();"').'&nbsp;&nbsp;&nbsp;Phone : '.form_input("txtPhone_1", '', 'class="input_box" id="txtPhone_1" onkeypress="javascript:return numbersonly(this, event, false);" maxlength="11"');?>
				</div>
                <div class="clear"></div>
				<a href="javascript:void(0)" onclick="javascript:addteacher(); return false;">Add New</a>
			<?php
			}		
			?>
			
		</td>
	</tr>
	<tr>
		<td align="left" class="table_row_first">Total number of students : </td>
		<td align="left" class="table_row_first" colspan="3">
			<?php 
				$LPDiv		=	(@$school_details[0]['strength_lp'] != 0 && @$school_details[0]['strength_lp'] != '') ? 'block' : 'none';
				$UPDiv		=	(@$school_details[0]['strength_up'] != 0 && @$school_details[0]['strength_up'] != '') ? 'block' : 'none';
				$HSDiv		=	(@$school_details[0]['strength_hs'] != 0 && @$school_details[0]['strength_hs'] != '') ? 'block' : 'none';
				$HSSDiv		=	(@$school_details[0]['strength_hss'] || @$school_details[0]['strength_vhss']) ? 'block' : 'none';
				$VHSCDiv	=	(@$school_details[0]['strength_vhss'] || @$school_details[0]['strength_hss']) ? 'block' : 'none';	
			?>
			<div style="float:left; display:<?php echo $LPDiv?>;" id="divLP">LP <?php echo (@$school_show == 'show') ? @$school_details[0]['strength_lp'] : form_input("txtTotalLP", @$school_details[0]['strength_lp'], 'class="input_box_small" id="txtTotalLP" maxlength="5" onkeypress="javascript:return numbersonly(this, event, false);" onkeyup="javascript:addTotal()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div style="float:left; display:<?php echo $UPDiv?>;" id="divUP">UP <?php echo (@$school_show == 'show') ? @$school_details[0]['strength_up'] : form_input("txtTotalUP", @$school_details[0]['strength_up'], 'class="input_box_small" id="txtTotalUP" maxlength="5" onkeypress="javascript:return numbersonly(this, event, false);" onkeyup="javascript:addTotal()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div style="float:left; display:<?php echo $HSDiv?>;" id="divHS">HS <?php echo (@$school_show == 'show') ? @$school_details[0]['strength_hs'] : form_input("txtTotalHS", @$school_details[0]['strength_hs'], 'class="input_box_small" id="txtTotalHS" maxlength="5" onkeypress="javascript:return numbersonly(this, event, false);" onkeyup="javascript:addTotal()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div style="float:left; display:<?php echo $HSSDiv?>;" id="divHSS">HSS <?php echo (@$school_show == 'show') ? @$school_details[0]['strength_hss'] : form_input("txtTotalHSS", @$school_details[0]['strength_hss'], 'class="input_box_small" id="txtTotalHSS" maxlength="5" onkeypress="javascript:return numbersonly(this, event, false);" onkeyup="javascript:addTotal()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			<div style="float:left; display:<?php echo $VHSCDiv?>;" id="divVHSC">VHSE <?php echo (@$school_show == 'show') ? @$school_details[0]['strength_vhss'] : form_input("txtTotalVHSS", @$school_details[0]['strength_vhss'], 'class="input_box_small" id="txtTotalVHSS" maxlength="5" onkeypress="javascript:return numbersonly(this, event, false);" onkeyup="javascript:addTotal()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
			Total <?php echo (@$school_show == 'show') ? @$school_details[0]['total_strength'] : form_input("txtTotal", @$school_details[0]['total_strength'], 'class="input_box_small" id="txtTotal" maxlength="5" onkeypress="javascript:return numbersonly(this, event, false);" readonly="readonly" ');?>
			<input type="hidden" name="hidHSSNo" id="hidHSSNo" value="<?php print((@$school_details[0]['strength_hss']) ? @$school_details[0]['strength_hss'] : 0);?>" />
			<input type="hidden" name="hidHSSNo" id="hidVHSSNo" value="<?php print((@$school_details[0]['strength_vhss']) ? @$school_details[0]['strength_vhss'] : 0);?>" />
        </td>
	</tr>
	<tr>
		<td align="center" colspan="4">
		<?php 
			if (isset($is_edit) and $is_edit != 'no'){
				echo (@$school_show == 'show') ? form_button('Edit', 'Edit', 'onClick="javascript:fncEditSchoolDeatils()"') : form_button('Continue', 'Continue', 'onClick="javascript:fncCheckSchoolDeatils()"');
			}
		?>
		</td>
	</tr>
</table>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">
<?php 
echo blue_box_bottom();
echo form_close();
?>

<?php 
echo "<div style='height:10px;'></div><div class='clear_both'></div>";
echo form_open('schools/registration/save_participant', array('id' => 'formParticipant'));
if (isset($is_edit) and $is_edit != 'no'){
?>
<div id="divAddParticipants" style="display:<?php echo (@$school_show == 'show')? 'block' : 'none';?>">
<?php
echo blue_box_top();

if (isset($save_update) and count($save_update) > 0)
{
	foreach ($save_update as $err)
	{
		print($err.'<br>');
	}
}
?>


<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="4" align="left">Add Participants</th>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_first">Admission No.</td>
		<td align="left" width="30%" class="table_row_first"><?php echo form_input("txtADNO", @$selected_participant[0]['admn_no'], 'class="input_box" id="txtADNO" maxlength="6" onkeyup="javascript:this.value=this.value.toUpperCase();"');?></td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_first">Name</td>
		<td align="left" width="30%" class="table_row_first"><?php echo form_input("txtParticipantName", @$selected_participant[0]['participant_name'], 'class="input_box" id="txtParticipantName"  onkeyup="javascript:this.value=this.value.toUpperCase();"');?></td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_first">Class</td>
		<td align="left" width="30%" class="table_row_first">
		<?php 
			$class_array	=	array();
			for($i = @$school_details[0]['class_start']; $i <= @$school_details[0]['class_end']; $i++){
				$class_array[$i]	=	$i;
			}
			echo form_dropdown("txtClass", $class_array, @$selected_participant[0]['class'],'id="txtClass" class="input_box_medium"');
		?>
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_first">Gender</td>
		<td align="left" width="30%" class="table_row_first">
		<?php echo form_dropdown("txtGender", array('B' => 'Boy', 'G' => 'Girl'), @$selected_participant[0]['gender'],'id="txtGender" class="input_box_medium"');?>
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_first">Item codes</td>
		<td align="left" width="30%" class="table_row_first">
			<?php 
			$items_selected	=	$this->Registration_Model->get_participant_item_details(@$selected_participant[0]['participant_id'], @$selected_participant[0]['admn_no'],'C','N');
			echo '<div class="clear_both"></div><div class="teachersTextBox">';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_1", @$items_selected[0]['item_code'], 'class="input_box_small" id="txtItemCode_1" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_1\',\'txtItemCode_2\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_2", @$items_selected[1]['item_code'], 'class="input_box_small" id="txtItemCode_2" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_2\',\'txtItemCode_3\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_3", @$items_selected[2]['item_code'], 'class="input_box_small" id="txtItemCode_3" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_3\',\'txtItemCode_4\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_4", @$items_selected[3]['item_code'], 'class="input_box_small" id="txtItemCode_4" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_4\',\'txtItemCode_5\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_5", @$items_selected[4]['item_code'], 'class="input_box_small" id="txtItemCode_5" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_5\',\'txtItemCode_6\',this);" maxlength="4"').'</div></div>';
			echo '<div class="clear_both"></div><div class="teachersTextBox" style=" float:left">';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_6", @$items_selected[5]['item_code'], 'class="input_box_small" id="txtItemCode_6" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_6\',\'txtItemCode_7\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_7", @$items_selected[6]['item_code'], 'class="input_box_small" id="txtItemCode_7" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_7\',\'txtItemCode_8\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_8", @$items_selected[7]['item_code'], 'class="input_box_small" id="txtItemCode_8" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_8\',\'txtItemCode_9\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_9", @$items_selected[8]['item_code'], 'class="input_box_small" id="txtItemCode_9" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_9\',\'txtItemCode_10\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtItemCode_10", @$items_selected[9]['item_code'], 'class="input_box_small" id="txtItemCode_10" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:change_text_max_to_focus(\'txtItemCode_10\',\'txtPinnanyCode_1\',this);" maxlength="4"').'</div></div>';
			?>
		</td>
		<td align="left" width="20%" class="table_row_first">Pinnany Item codes</td>
		<td align="left" width="30%" class="table_row_first">
			<?php
			$pinnany_selected	=	$this->Registration_Model->get_participant_item_details(@$selected_participant[0]['participant_id'], @$selected_participant[0]['admn_no'],'P');
			echo '<div class="clear_both"></div><div class="teachersTextBox">';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtPinnanyCode_1", @$pinnany_selected[0]['item_code'], 'class="input_box_small" id="txtPinnanyCode_1" onKeyUp="javascript:change_text_max_to_focus(\'txtPinnanyCode_1\',\'txtPinnanyCode_2\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtPinnanyCode_2", @$pinnany_selected[1]['item_code'], 'class="input_box_small" id="txtPinnanyCode_2" onKeyUp="javascript:change_text_max_to_focus(\'txtPinnanyCode_2\',\'txtPinnanyCode_3\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtPinnanyCode_3", @$pinnany_selected[2]['item_code'], 'class="input_box_small" id="txtPinnanyCode_3" onKeyUp="javascript:change_text_max_to_focus(\'txtPinnanyCode_3\',\'txtPinnanyCode_4\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtPinnanyCode_4", @$pinnany_selected[3]['item_code'], 'class="input_box_small" id="txtPinnanyCode_4" onKeyUp="javascript:change_text_max_to_focus(\'txtPinnanyCode_4\',\'txtPinnanyCode_5\',this);" maxlength="4"').'</div>';
			echo '<div style="margin-left:5px; float:left">'.form_input("txtPinnanyCode_5", @$pinnany_selected[4]['item_code'], 'class="input_box_small" id="txtPinnanyCode_5" onKeyUp="javascript:change_text_max_to_focus(\'txtPinnanyCode_5\',\'update_participant\',this);" maxlength="4"').'</div></div>'
			?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<?php echo (count(@$selected_participant) > 0 ) ? form_button('update_participant', 'Update Participant', 'id="update_participant" onClick="javascript:fncUpdateParticipant(\''.$selected_participant[0]['admn_no'].'\')"').'&nbsp;&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript:fncCancelParticipant()"'): form_button('save_participant', 'Save Participant', 'id="update_participant" onClick="javascript:fncSaveParticipant()"');?>
		</td>
	</tr>
</table>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">
<input type="hidden" name="hidADNO" id="hidADNO" value="">
<?php
echo blue_box_bottom();
?>
</div>
<?php }?>
<br />

<div style="display:<?php echo (count(@$participant_details) > 0 && @$school_show == 'show') ? 'block' : 'none';?>">
<?php
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th align="left" width="6%">Sl No</th>
		<th align="left" width="6%">AD No.</th>
        <th align="left" width="6%">Reg No.</th>
		<th align="left" width="20%">Name of participant</th>
		<th align="left" width="6%">Class</th>
		<th align="left" width="8%">Boy / Girl </th>
		<th align="center" width="54%" colspan="10">Item code (Place the cursor above the item code to view item name)</th>
		<?php if (isset($is_edit) and $is_edit != 'no'){?>
		<th align="center" width="8%">Edit </th>
		<th align="center" width="8%">Delete</th>
		<?php }?>
	</tr>
	<?php
		$count	=	1;
		for($j = 0; $j < count($participant_details); $j++){
			$items	=	$this->Registration_Model->get_participant_item_details($participant_details[$j]['participant_id'], $participant_details[$j]['admn_no']);
			$classname	=	($j%2 == 0)? 'table_row_second' : 'table_row_first'
			?>
			<tr>
				<td align="left" class="<?php echo $classname?>"><?php echo $count;?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['admn_no']?></td>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['participant_id']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['participant_name']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['class']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo ($participant_details[$j]['gender'] == 'B') ? 'Boy' : 'Girl';?></td>
				<?php
				for($k=0; $k < 10; $k++){
					?>
						<td width="4%" align="center" class="<?php echo $classname?>" style="border-left:1px solid #CCCCCC;"><label style="cursor:pointer; <?php echo (@$items[$k]['spo_id'] != 0) ? 'color:#FF0000;' : '' ?>" title="<?php echo (@$items[$k]['item_name']) ? ((@$items[$k]['item_type'] == 'P') ? @$items[$k]['item_name'].'(Pinnany)' : @$items[$k]['item_name']) :'';?>"><?php echo (@$items[$k]['item_code']) ? @$items[$k]['item_code'].'('.@$items[$k]['item_type'].')' :'';?></label></td>
					<?php
				}
				?>
				<?php if (isset($is_edit) and $is_edit != 'no'){?>
				<td align="center" class="<?php echo $classname?>"style="border-left:1px solid #CCCCCC;">
					<a href="javascript:void(0)" onClick="javascript:editParticipant('<?php echo $participant_details[$j]['admn_no']?>')">
						<img src="<?php echo base_url(false)?>images/edit.gif" border="0">
					</a>
				</td>
				<td align="center" class="<?php echo $classname?>"> 
					<a href="javascript:void(0)" onClick="javascript:deleteParticipant('<?php echo $participant_details[$j]['admn_no']?>')">
						<img src="<?php echo base_url(false)?>images/delete.gif" border="0">
					</a>
				</td>
				<?php }?>
			</tr>	
			<?php
			$count++;
		}
	?>
</table>
<?php
echo blue_box_bottom();
?>
</div>

<?php
echo form_close();

?>
<?php 
if (count(@$group_details['group_array']) > 0){

echo form_open('schools/registration/update_group_captain', array('id' => 'formGroupLeader'));
?>
<div style="display:<?php echo (count(@$group_details['group_array']) > 0 && @$school_show == 'show') ? 'block' : 'none';?>; padding:10px 0 10px; 0">
<?php
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th align="left" colspan="2">Captain</th>
	</tr>
	<?php
		$count	=	1;
		$group_array				=	$group_details['group_array'];
		$group_leader				=	$group_details['group_leader'];
		$group_participant_array	=	$group_details['group_participant_array'];
		foreach($group_array as $groups){
			$classname	=	($j%2 == 0)? 'table_row_second' : 'table_row_first'
			?>
			<tr>
				<td align="left" width="20%" class="<?php echo $classname?>">
					<?php echo $groups['item_name']?>
					<input type="hidden" name="hidGrpItemCode_<?php echo $count?>" id="hidGrpItemCode_<?php echo $count?>" value="<?php echo $groups['item_code']?>">
				</td>
				<td align="left" width="80%" class="<?php echo $classname?>">
				<?php
					if (isset($is_edit) and $is_edit != 'no'){
						print(form_dropdown('cmbGrpParticipant_'.$count,$group_participant_array[$groups['item_code']],@$group_leader[$groups['item_code']],'id="cmbGrpParticipant_"'.$count.' class="input_box" onChange="javascript:$(\'divCaptainSubmit\').style.display = \'block\'"'));
					}
					else
					{
						print(@$group_participant_array[$groups['item_code']][@$group_leader[$groups['item_code']]]);
					}
				?>
				</td>
			</tr>	
			<?php
			$count++;
		}
	?>
	<input type="hidden" name="hidGrpCount" id="hidGrpCount" value="<?php echo $count ?>">
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left"><div id="divCaptainSubmit" style="display:none">
			<?php
				if (isset($is_edit) and $is_edit != 'no'){
					echo form_submit('group_submit','Submit');
				}
			?>
		</div></td>
	</tr>
	
</table>
<?php
echo blue_box_bottom();
?>
</div>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">
<?php 
echo form_close();
}?>

<?php if (count(@$participant_item_list) > 0){?>
<div style="display:<?php echo (@$school_show == 'show') ? 'block' : 'none';?>; padding:10px 0 10px; 0">
<?php
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th align="left" colspan="6">List Item</th>
	</tr>
	<tr>
		<th align="center" width="5%">SL No</th>
		<th align="left" width="10%">Item Code</th>
		<th align="left" width="20%">Item Name</th>
		<th align="center" width="15%">No of Participants</th>
		<th align="center" width="10%">No of Pinnany</th>
		
      <th align="left" width="20%">Name of Participant</th>
	</tr>
	<?php
		$count = 0;
		foreach($participant_item_list as $item_list)
		{
		$count++;
		$class_name = ($count % 2 == 0) ? 'table_row_second' : 'table_row_first';
	?>
	<tr>
		<td  align="center" class="<?php echo $class_name;?>"><?php echo $count;?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo $item_list['item_code']?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo $item_list['item_name']?></td>
		<td align="center" class="<?php echo $class_name;?>"><?php echo $item_list['cnt_participant']?></td>
		<td align="center" class="<?php echo $class_name;?>"><?php echo $item_list['cnt_pinnany']?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo @$item_list['captian']?></td>
	</tr>
	<?php
	}
	?>
	
</table>
<?php
echo blue_box_bottom();
?>
</div>
<?php }?>



<!--
<?php 
echo form_open('schools/registration/finalize_data', array('id' => 'formFinalize'));
?>
<div style="display:<?php echo (@$school_show == 'show') ? 'block' : 'none';?>; padding:10px 0 10px; 0">
<?php
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th align="left" colspan="2">Report</th>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td align="left">
			<?php
				
				if (isset($is_edit) and $is_edit != 'no' and @$school_details[0]['is_create_report'] == 'Y'){
					?>
                    
                    <label style="color:#990000"><strong>Warning: Once confirmed the entry details cannot be modified. Before confirming ensure the report has been certified by the Headmaster/Principal.</strong></label>
                    <br /><br />
					<?php
					echo form_button('finalize_submit','Confirm','onClick="javascript:confirm_school_data();"');
					
				}
				echo '&nbsp;&nbsp;'.form_button('create_report','Create Report','onClick="javascript:create_school_report();"');
				/*else
				{
					echo form_button('create_csv_submit','Export Data','onClick="javascript:create_csv_school_data();"');
					echo form_hidden('create_csv','create_csv','id="create_csv"');
				}
				
				if (@$school_details[0]['is_csv_taken'] == 'Y')
				{
					echo form_button('create_report','Create Report','onClick="javascript:create_school_report();"');
				}*/
				
			?>
		</td>
	</tr>
	
</table>
<?php
echo blue_box_bottom();
?>
</div>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">
<?php 
echo form_close();
?>
</div>
--><?php if (@$error_msg){?>
<script language="JavaScript">
	window.onload = alert('<?php echo @$error_msg;?>');
</script>
<?php }?>
