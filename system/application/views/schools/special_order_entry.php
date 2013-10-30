<div id="divEntryForm">
<div align="center" class="heading_gray">
<h3>Special Order Entry </h3>
</div>
<br/>
<?php echo form_open('schools/special_order_entry', array('id' => 'formSchool'));
echo blue_box_top();
?>
<input type="hidden" name="hidTeachers" id="hidTeachers" value="1">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th width="4%" colspan="4" align="left">Special Order Entry.</th>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_first">School Code : </td>
		<td align="left" width="30%" class="table_row_first">
        <div id="divSchoolCode">
		<?php 
			echo form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="input_box" id="txtSchoolCode" maxlength = "6" onkeypress="javascript:return numbersonly(this, event, false);" onBlur="javascript:fetch_special_order_school_details()"');
		?>
        </div>
        </td>
		<td align="left" width="20%" class="table_row_first">School Name : </td>
		<td align="left" width="30%" class="table_row_first"><?php @print($school_details[0]['school_name'])?></td>
	</tr>
</table>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">
<?php 
echo blue_box_bottom();
echo form_close();
?>

<?php 
echo "<div style='height:10px;'></div><div class='clear_both'></div>";
echo form_open_multipart('schools/special_order_entry/save_participant', array('id' => 'formParticipant'));
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
		<th colspan="4" align="left">Participants</th>
	</tr>
    <tr>
		<td align="left" width="20%" class="table_row_first">Participant</td>
		<td align="left" width="80%" colspan="2" class="table_row_first">
		<?php 
		echo form_dropdown("cmbParticipant", $participants, @$selected_participant[0]['admn_no'], 'id="cmbParticipant" ');
		?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
		echo form_checkbox("chkAddParticipant", 'YES', @$selected_participant[0]['admn_no'], 'id="chkAddParticipant" onClick="javascript:add_special_order_participant()" ');
		echo form_label("Add Participant", "chkAddParticipant");
		?>
        </td>
		<td align="left"  class="table_row_first">&nbsp;</td>
	</tr>
    <tr>
		<td align="left" width="20%" class="table_row_first">Special Order</td>
		<td align="left" width="30%" class="table_row_first">
		<?php 
		echo form_dropdown("cmbOrder", $orders, @$selected_participant[0]['spo_id'], 'id="cmbOrder" ');
		?>
        </td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>
    
    <tr>
        <td align="left" width="20%" class="table_row_first">Item code</td>
        <td align="left" width="80%" colspan="3" class="table_row_first">
        <input type="hidden" name="sch_code" id="sch_code" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">

            <?php 
			
            //$items_selected	=	$this->Registration_Model->get_participant_item_details(@$selected_participant[0]['participant_id'], @$selected_participant[0]['admn_no'],'C');
            echo '<div class="clear_both"></div><div class="teachersTextBox">';
            echo '<div  id="divItemCode" style="margin-left:5px; float:left">'.form_input("txtItemCode_1", @$selected_participant[0]['item_code'],  'class="input_box_small" maxlength="4" id="txtItemCode_1" onkeypress="javascript:return numbersonly(this, event, false);" onKeyUp="javascript:dummy_change_text_max_to_focus(\'txtItemCode_1\',\'txtCaptionAdNo\',this);"').'</div>';
			echo '<div id="divCapPin">';
			echo '<div style="margin-left:5px; float:left"> &nbsp; &nbsp; &nbsp; Captain Admission No : ';
			
			echo form_input("txtCaptionAdNo", @$selected_participant[0]['parent_admn_no'], 'class="input_box" maxlength="6" id="txtCaptionAdNo" onkeypress="" onkeyup="javascript:this.value=this.value.toUpperCase();"').'</div>';
            ?>
            &nbsp; &nbsp; &nbsp;
            <?php 
			$checked =	'';
			if(@$selected_participant[0]['item_type'] == 'P') {
				$checked = 'TRUE';
			}
			echo form_checkbox("chkIsPinnany", 'YES', $checked, 'id="chkIsPinnany"');
			echo form_label("Is Pinnany", "chkIsPinnany");
			echo '</div>';
			
			
			?>
            
        </td>
        
    </tr>
    
    <tr>
    	<td colspan="4" style="padding:0; margin:0">
        	<div id="editEntry" style="display:<?php echo (@$show_edit == 'show')? 'block' : 'none';?>">
            	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
                    <tr>
                        <td align="left" width="17%" class="table_row_first">Admission No.</td>
                        <td align="left" width="33%" class="table_row_first"><?php echo form_input("txtADNO", @$selected_participant[0]['admn_no'], 'class="input_box" id="txtADNO" maxlength="6" onkeyup="javascript:this.value=this.value.toUpperCase();" onBlur="javascript:fetch_admision_no_details(this)"');?></td>
                        <td width="50%"  colspan="2" align="left" valign="top" class="table_row_first">&nbsp;
                        <div id="photo_div">
                        </div>                         
                      </td>
                    </tr>
                    <tr>
                        <td align="left" width="17%" class="table_row_first">Name</td>
                        <td align="left" width="33%" class="table_row_first"><?php echo form_input("txtParticipantName", @$selected_participant[0]['participant_name'], 'class="input_box" id="txtParticipantName"  onkeyup="javascript:this.value=this.value.toUpperCase();"');?></td>
                        <td align="left" colspan="2" class="table_row_first">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" width="17%" class="table_row_first">Class</td>
                        <td align="left" width="33%" class="table_row_first">
                        <?php 
                            $class_array	=	array();
                            for($i = @$school_details[0]['class_start']; $i <= @$school_details[0]['class_end']; $i++){
                                $class_array[$i]	=	$i;
                            }
                            echo form_dropdown("txtClass", $class_array, @$selected_participant[0]['class'],'id="txtClass"');
                        ?>                        </td>
                        <td align="left" colspan="2" class="table_row_first">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" width="17%" class="table_row_first">Gender</td>
                        <td align="left" width="33%" class="table_row_first">
                        <?php echo form_dropdown("txtGender", array('B' => 'Boy', 'G' => 'Girl'), @$selected_participant[0]['gender'],'id="txtGender"');?>                        </td>
                        <td align="left" colspan="2" class="table_row_first">&nbsp;</td>
                    </tr>
                    
                    
				</table>
            </div>
        </td>
    </tr>
    
     <!--<tr>
                        <td align="left" width="17%" class="table_row_first">Photo Upload</td>
                        <td align="left" width="33%" class="table_row_first">
                        <?php echo form_upload('userfile',''); ?><br />
                       [ Max Size : 200KB (600x600)]
                       </td>
                        <td align="left" colspan="2" class="table_row_first">&nbsp;
                        <div id="edit_photo_div">
                        <?
						
                        echo "<img src='".@$pic."' width='70' height='70'>";	
					    ?>
                        </div> 
                        
                        </td>
                    </tr>-->
    				<tr>
                        <td colspan="4" style="padding:0; margin:0">
                            <div id="newEntry" >
                                
                            </div>
                        </td>
                    </tr>
    <tr>
		<td align="left" width="20%" class="table_row_first">Remarks</td>
		<td align="left" width="30%" class="table_row_first">
		<?php 
		echo form_textarea("txtRemarks", @$selected_participant[0]['spo_remarks'], 'id="txtRemarks" style="width:450px; height:100px;" ');
		?>
        </td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<?php echo (count(@$selected_participant) > 0 ) ? form_button('update_participant', 'Update Details', 'id="update_participant" onClick="javascript:fncUpdateParticipant(\''.$selected_participant[0]['admn_no'].'\')"').'&nbsp;&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript:fncCancelSpecialOrderParticipant()"'): form_button('save_participant', 'Save Details', 'id="update_participant" onClick="javascript:fncSaveSpecialOrderParticipant()"');?>
		</td>
	</tr>
</table>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">
<input type="hidden" name="hidADNO" id="hidADNO" value="">
<input type="hidden" name="hidPiId" id="hidPiId" value="">
<input type="hidden" name="hidItemId" id="hidItemId" value="">
<?php
echo blue_box_bottom();
?>
</div>
<br />

<div style="display:<?php echo (count(@$participant_details) > 0 && @$school_show == 'show') ? 'block' : 'none';?>">
<?php
echo blue_box_top();
?>
<table width="100%" border="1" bgcolor="#FFFFFF" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th align="left" width="4%">Sl No</th>
        <th align="left" width="4%">Photo</th>
        <th align="left" width="20%">Item</th>
        <th align="left" width="10%">Captain</th>
		<th align="left" width="6%">AD No.</th>
        <th align="left" width="6%">Reg No.</th>
		<th align="left" width="25%">Name of participant</th>
		<th align="center" width="4%">Class</th>
		<th align="center" width="4%">B/G</th>
	    <th align="left" width="28%">Order</th>
		<?php if (isset($is_edit) and $is_edit != 'no'){?>
		<th align="center" width="16%">Edit </th>
		<th align="center" width="8%">Delete</th>
		<?php }?>
	</tr>
    <?php
		$count	=	1;
		$prev_item_code	=	'';
		$prev_parent_adno	=	'';
		for($j = 0; $j < count($participant_details); $j++){
			//$items	=	$this->Registration_Model->get_participant_item_details($participant_details[$j]['participant_id'], $participant_details[$j]['admn_no']);
			$classname	=	($j%2 == 0)? '' : '';
			$item_rowspan	=	1;
			$caption_rowspan	=	1;
			$captain_set		=	false;
			if($prev_parent_adno != $participant_details[$j]['parent_admn_no'] or $prev_item_code != $participant_details[$j]['item_code']) {
				$caption_rowspan	=	get_array_double_val_count($participant_details, 'parent_admn_no', $participant_details[$j]['parent_admn_no'], 'item_code', $participant_details[$j]['item_code']);
				$prev_parent_adno = $participant_details[$j]['parent_admn_no'];
				$captain_set		=	true;
			}
			
			?>
			<tr>
				<?php if ($captain_set){?>
                <td align="left" rowspan="<?php echo $caption_rowspan?>"  class="<?php echo $classname?>"><?php echo $count;?></td>
                
                <td align="left" rowspan="<?php echo $caption_rowspan?>"  class="<?php echo $classname?>"><?php 
				$reg	=	$participant_details[$j]['admn_no'];
				if(@$Photo['pic'][$reg])
				{
		   			 $pic_path	=	@$Photo['pic'][$reg];
	      			 echo "<img src='$pic_path' width='70' height='70'>";				 
				}
				else
				{
					//$document_root 	=	image_url(false)."photos";
					@$pic_path	=	image_url()."/img_user_nophoto.jpg";
					echo "<img src='".@$pic_path."'width='80' height='80'>";								
				}
				
				?></td>
                
                <?php 
				$count++;
				}
				?>
                <?php
				if($prev_item_code != $participant_details[$j]['item_code']) {
					$item_rowspan	=	get_array_val_count($participant_details, 'item_code', $participant_details[$j]['item_code']);
					$prev_item_code = $participant_details[$j]['item_code'];
					?>
                    <td align="left" rowspan="<?php echo $item_rowspan?>" class="<?php echo $classname?>" ><?php echo @$participant_details[$j]['item_code'].' - '.@$participant_details[$j]['item_name'];?></td>
                    <?php
				}
				?> 
			   <?php if ($captain_set){?>
				<td align="left" rowspan="<?php echo $caption_rowspan?>" class="<?php echo $classname?>"><?php echo $participant_details[$j]['parent_admn_no']?></td>
                <?php }?>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['admn_no']?></td>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['participant_id']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['participant_name']?></td>
				<td align="center" class="<?php echo $classname?>"><?php echo $participant_details[$j]['class']?></td>
				<td align="center" class="<?php echo $classname?>"><?php echo $participant_details[$j]['gender']?></td>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['spo_title']?></td>
				<?php if (isset($is_edit) and $is_edit != 'no'){?>
				<td align="center" class="<?php echo $classname?>">
					<a href="javascript:void(0)" onClick="javascript:editSpecialOrderParticipant('<?php echo $participant_details[$j]['pi_id']?>', '<?php echo $participant_details[$j]['admn_no']?>')">
						<img src="<?php echo base_url(false)?>images/edit.gif" border="0">
					</a>
				</td>
                <?php //if ($captain_set){?>
				<td align="center" class="<?php echo $classname?>" > 
					<a href="javascript:void(0)" onClick="javascript:deleteSpecialOrderParticipant('<?php echo $participant_details[$j]['admn_no']?>', '<?php echo $participant_details[$j]['item_code']?>')">
						<img src="<?php echo base_url(false)?>images/delete.gif" border="0">
					</a>
				</td>
                <?php 
				$captain_set = false;
				//}?>
				<?php }?>
			</tr>	
			<?php
			//$count++;
		}
	?>
    
    
    
    
    
    
    
	<?php
		/*$count	=	1;
		for($j = 0; $j < count($participant_details); $j++){
			//$items	=	$this->Registration_Model->get_participant_item_details($participant_details[$j]['participant_id'], $participant_details[$j]['admn_no']);
			$classname	=	($j%2 == 0)? 'table_row_second' : 'table_row_first'
			?>
			<tr>
				<td align="left" class="<?php echo $classname?>"><?php echo $count;?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['admn_no']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['participant_name']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['class']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo ($participant_details[$j]['gender'] == 'B') ? 'Boy' : 'Girl';?></td>
                <td align="center" class="<?php echo $classname?>" ><label style="cursor:pointer" title="<?php echo (@$participant_details[$j]['item_name']) ? @$participant_details[$j]['item_name'] :'';?>"><?php echo (@$participant_details[$j]['item_code']) ? @$participant_details[$j]['item_code'] :'';?></label></td>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['spo_title']?></td>
				<?php if (isset($is_edit) and $is_edit != 'no'){?>
				<!--<td align="center" class="<?php echo $classname?>">
					<a href="javascript:void(0)" onClick="javascript:editSpecialOrderParticipant('<?php echo $participant_details[$j]['pi_id']?>')">
						<img src="<?php echo base_url(false)?>images/edit.gif" border="0">
					</a>
				</td>
				<td align="center" class="<?php echo $classname?>"> 
					<a href="javascript:void(0)" onClick="javascript:deleteSpecialOrderParticipant('<?php echo $participant_details[$j]['pi_id']?>')">
						<img src="<?php echo base_url(false)?>images/delete.gif" border="0">
					</a>
				</td>-->
				<?php }?>
			</tr>	
			<?php
			$count++;
		}*/
	?>
    
    
    
    
</table>
<?php
echo blue_box_bottom();
?>
</div>

<?php
echo form_close();
?>
