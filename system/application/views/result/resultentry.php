<div id="divEntryForm">
<div align="center" class="heading_gray">
<h3>Result Entry</h3>
</div>
<br />
<?php echo form_open('', array('id' => 'resultEntry', 'name' => 'resultEntry'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="4" align="left">Result Entry.</th>
	</tr>
	<tr>
		<td align="left" width="20%" class="table_row_first">Item Code : </td>
		<td align="left" width="30%" class="table_row_first"><?php echo form_input("txtItemCode", @$selected_item[0]['item_code'], 'class="input_box_small_item_code" id="txtItemCode" onkeypress="javascript:return numbersonly(this, event, false);" onBlur="javascript:fetch_item_details_result()" onkeyup="javascript:dummy_change_text_max_to_focus(\'txtItemCode\',\'txt_reg_no\',this); " maxlength="4" ');?></td>
		<td align="left" width="20%" class="table_row_first">Item Name : </td>
		<td align="left" width="30%" class="table_row_first"><?php @print($selected_item[0]['item_name'])?></td>
	</tr>
    <tr>
		<td align="left" class="table_row_first">Number of participants: </td>
		<td align="left" class="table_row_first"><?php @print($selected_item[0]['total_participants'])?></td>

    	<td align="left" class="table_row_first">Number of Judges : </td>
		<td align="left" class="table_row_first"><?php @print((int)$selected_item[0]['no_of_judges']);// + ((int)@$interval_bw_items * @$selected_item[0]['total_participants']))?></td>
    </tr>
	
    <?php
		$cnt_judges		=	(int)@$selected_item[0]['no_of_judges'];
		if (count(@$selected_item) > 0 && $add_edit == 'yes' && count(@$selected_item_list) != @$selected_item[0]['total_participants'] or count(@$selected_result > 0)){
			//$cnt_judges		=	(int)@$selected_item[0]['no_of_judges'];
	?>
     <tr>
		<td align="left" class="table_row_first">Reg No: </td>
		<td align="left"  class="table_row_first"><?php echo form_input("txt_reg_no", @$selected_result[0]['participant_id'], 'class="input_box" id="txt_reg_no" maxlength="7" onkeypress="javascript:return numbersonly(this, event, false);"');?></td>

    	<td align="left" class="table_row_first">Code : </td>
		<td align="left"  class="table_row_first"><?php echo form_input("txt_code_no",  @$selected_result[0]['code_no'], 'class="input_box_small" id="txt_code_no" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"');?></td>
    </tr>
    
    <tr>
		<td align="left" class="table_row_second">Marks : </td>
		<td align="left" colspan="3"  class="table_row_second">
		<?php 
			$marks_array	=	explode('#$#', @$selected_result[0]['marks']);
			for($i = 1; $i <= $cnt_judges; $i++ ){
				echo 'Mark&nbsp;'.$i.'&nbsp;&nbsp;'.form_input("mark_".$i, @$marks_array[$i-1], 'class="input_box_small" id="mark_'.$i.'" maxlength="5" onkeypress="javascript:return numbersonly(this, event, true);"');?>&nbsp;&nbsp;&nbsp;
			<?php
			}
			echo 'Total&nbsp;&nbsp;'.form_input("totalMark", @$selected_result[0]['total_mark'], 'class="input_box_small" id="totalMark" maxlength="6" onkeypress="javascript:return numbersonly(this, event, true);"');
			?>
      	</td>
	</tr>
	<tr>
		<td align="center" colspan="4">
		<?php 
			if(count( @$selected_result) > 0){
				echo form_button('Update', 'Update', 'onClick="javascript:fncSaveResultEntry()"');
				echo '&nbsp;&nbsp;&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript:fncCancel()"');
			} else {
				echo form_button('Save', 'Save', 'onClick="javascript:fncSaveResultEntry()"');
			}
		?>
		</td>
	</tr>
    <?php }?>
</table>
<input type="hidden" name="hidItemId" id="hidItemId" value="<?php echo (@$selected_item[0]['item_code']) ? @$selected_item[0]['item_code'] : @$this->input->post('hidItemId');?>">
<input type="hidden" name="hidNoJudge" id="hidNoJudge" value="<?php echo (@$cnt_judges)?>">
<?php 
echo blue_box_bottom();
echo form_close();

if (count(@$selected_item_list) > 0){
?>
<br><br>
<?php 
if(isset($_POST['hidBlank']))
    $is_confirm_to_print	=	'_blank';
else
    $is_confirm_to_print	=	'_self';
	
echo form_open('', array('id' => 'resultEntryList', 'name' => 'resultEntryList','target'=>$is_confirm_to_print));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	
	<tr>
		<th align="left" width="6%">Sl No</th>
		<th align="left" width="10%">Reg No</th>
		<th align="left" width="8%">Code No</th>
        <?php for($i = 1; $i <= @$cnt_judges; $i++ ){?>
        	<th align="left" width="10%">Mark <?php echo $i?></th>
         <?php }?>
        <th align="left" width="8%">Total</th>
        <th align="left" width="8%">% Mark</th>
        <th align="center" width="8%">Rank</th>
        <th align="center" width="8%">Grade</th>
        <th align="center" width="8%">Point</th>
		
		<?php if($show_conirm_button == 'yes'){?>
        <th align="center" width="8%">Edit</th>
        <th align="center" width="8%">Delete</th>
		<?php }?>
	</tr>
    
    <?php 
		$cnt_item_list		=	count($selected_item_list);
		$count				=	1;
		$a_grade_count = $b_grade_count = $c_grade_count = $withheld_count = 0;

		for($i = 0; $i < $cnt_item_list; $i++)
		{
			if ($selected_item_list[$i]['grade'] == 'A') $a_grade_count++;
			else if ($selected_item_list[$i]['grade'] == 'B') $b_grade_count++;
			else if ($selected_item_list[$i]['grade'] == 'C') $c_grade_count++;
			
			$withheld_simbol	= '';
			if ($selected_item_list[$i]['is_withheld'] == 'Y')
			{
				$withheld_simbol	= '<span class="with_held"> * </span>';
				$withheld_count++;
			}
			
			$classname	=	($i%2 == 0)? 'table_row_second' : 'table_row_first'
	?>
    	<tr>
        	<td align="left" class="<?php echo $classname?>"><?php echo $count;?></td>
            <td align="left" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['participant_id'].$withheld_simbol;?></td>
            <td align="left" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['code_no'];?></td>
            <?php 
				//$cnt_mark	=	count($selected_item_list[$i]['mark'][$selected_item_list[$i]['participant_id']]);
				$marks_array	=	explode('#$#', $selected_item_list[$i]['marks']);
				for($j = 0; $j < @$cnt_judges; $j++ ){
			?>
            	<td align="left" class="<?php echo $classname?>">
					<?php 
                    echo @$marks_array[$j];
					//echo $selected_item_list[$i]['mark'][$selected_item_list[$i]['participant_id']][$j];
                    ?>
                </td>
            <?php }?>
            <td align="left" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['total_mark'];?></td>
            <td align="left" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['percentage'];?></td>
            <td align="center" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['rank'];?></td>
            <td align="center" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['grade'];?></td>
            <td align="center" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['point'];?></td>
            
			<?php if($show_conirm_button == 'yes'){?>
            <td align="center" class="<?php echo $classname?>">
                <a href="javascript:void(0)" onClick="javascript:editResult('<?php echo $selected_item_list[$i]['rm_id']?>')">
                    <img src="<?php echo base_url(false)?>images/edit.gif" border="0">
                </a>
            </td>
            <td align="center" class="<?php echo $classname?>"> 
                <a href="javascript:void(0)" onClick="javascript:deleteResult('<?php echo $selected_item_list[$i]['rm_id']?>')">
                    <img src="<?php echo base_url(false)?>images/delete.gif" border="0">
                </a>
            </td>
			<?php }?>
        </tr>
    <?php
		$count++; 
		}
		if($cnt_item_list > 0 && $show_conirm_button == 'yes')
		{
	?>
			<tr>
				<td align="left" colspan="7"><input type="button" value="Confirm Results" onClick="javascript:confirmResutlEntry ();return false;"/></td>
			</tr>
	<?php
		}
		else if (isset($show_conirm_button) && 'no' == $show_conirm_button)
		{
			if (isset($absentee_list) && !empty($absentee_list)) $absentee_array	= explode(',', $absentee_list);
			else $absentee_array = array();
			
	?>
			<tr>
				<td align="left" colspan="<?php echo ($show_conirm_button == 'yes')? @$cnt_judges+10: @$cnt_judges+8;?>">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="50%">
								<br/>
								<div><b>No of Absentees &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo count($absentee_array);?></b></div>
								<?php if(0 < count($absentee_array)){?>
								<div style="margin-top:7px;"><b>Absentee Reg.No&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $absentee_list;?></b></div>
								<?php }?>
								<div style="margin-top:7px;"><b><span class="with_held"> * </span> No of Withheld participants &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $withheld_count;?></b></div>
								<br/>
							</td>
							<td width="50%">
								<table width="100%" cellpadding="3"  cellspacing="0" border="0">
									<tr>
										<td width="40%">&nbsp;</td>
										<td align="center"><b>A Grade</b></th>
										<td align="center"><b>B Grade</b></th>
										<td align="center"><b>C Grade</b></th>
									</tr>
									<tr>
										<td width="10%">&nbsp;</td>
										<td align="center"><?php echo $a_grade_count;?></td>
										<td align="center"><?php echo $b_grade_count;?></td>
										<td align="center"><?php echo $c_grade_count;?></td>
									</tr>
									<tr>
										<td width="10%">&nbsp;</td>
										<td colspan="3">
											
										</td>
									</tr>
                                     <tr>
										<td width="10%"><input type="button" value="Print Confidential Report" onClick="javascript:printConfidentialReport ();return false;"/></td>
										<td colspan="3">
											
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
	<?php		
		}
	?>
	
</table>
<input type="hidden" name="hidItemId" id="hidItemId" value="<?php echo (@$selected_item[0]['item_code']) ? @$selected_item[0]['item_code'] : @$this->input->post('hidItemId');?>">
<input type="hidden" name="hidNoJudge" id="hidNoJudge" value="<?php echo (@$cnt_judges)?>">
<input type="hidden" name="hidResultId" id="hidResultId" value="">
<input type="hidden" name="hidBlank" id="hidBlank" value="_blank">
<?php 
echo blue_box_bottom();
echo form_close();
}
?>
</div>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >
<?php //$this->load->view('report/report_header'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
				<tr>
					<th width="4%" colspan="4" align="left">Result Entry.</th>
				</tr>
				<tr>
					<td align="left" width="20%" class="table_row_first">Item : </td>
					<td align="left" colspan="3" width="30%" class="table_row_first"><b><?php echo @$selected_item[0]['item_code'].' - '.$selected_item[0]['item_name'];?></b></td>
				</tr>
				<tr>
					<td align="left" width="20%" class="table_row_first">Number of participants: </td>
					<td align="left" width="30%" colspan="0" class="table_row_first"><?php @print($selected_item[0]['total_participants'])?></td>
			
					<td align="left" width="20%" class="table_row_first">Number of Judges : </td>
					<td align="left" width="30%" colspan="0" class="table_row_first"><?php @print((int)$selected_item[0]['no_of_judges']);// + ((int)@$interval_bw_items * @$selected_item[0]['total_participants']))?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
				<tr>
					<th align="left" width="6%">Sl No</th>
					<th align="left" width="10%">Reg No</th>
					<th align="left" width="8%">Code No</th>
					<?php // for($i = 1; $i <= @$cnt_judges; $i++ ){?>
						<!--<th align="left" width="10%">Mark <?php // echo $i?></th>-->
					 <?php // }?>
					<th align="left" width="8%">Total</th>
					<th align="left" width="8%">% Mark</th>
                    <th align="center" width="8%">Rank</th>
					<th align="center" width="8%">Grade</th>
					<th align="center" width="8%">Point</th>
					
				</tr>
				
				<?php 
					$cnt_item_list		=	count($selected_item_list);
					$count				=	1;
					for($i = 0; $i < $cnt_item_list; $i++)
					{
						$withheld_simbol	= '';
						if ($selected_item_list[$i]['is_withheld'] == 'Y')
						{
							$withheld_simbol	= '<span class="with_held"> * </span>';
						}
						$classname	=	($i%2 == 0)? 'table_row_second' : 'table_row_first'
				?>
					<tr>
						<td align="left" class="<?php echo $classname?>"><?php echo $count;?></td>
						<td align="left" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['participant_id'].$withheld_simbol;?></td>
						<td align="left" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['code_no'];?></td>
						<?php 
							//$cnt_mark	=	count($selected_item_list[$i]['mark'][$selected_item_list[$i]['participant_id']]);
						/*	$marks_array	=	explode('#$#', $selected_item_list[$i]['marks']);
							for($j = 0; $j < @$cnt_judges; $j++ )
							{*/
						?>
							<!-- <td align="left" class="<?php //echo $classname?>"> -->
								<?php 
							/*	echo @$marks_array[$j];*/
								//echo $selected_item_list[$i]['mark'][$selected_item_list[$i]['participant_id']][$j];
								?>
							<!-- </td> -->
						<?php // }?>
						<td align="left" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['total_mark'];?></td>
						<td align="left" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['percentage'];?></td>
						<td align="center" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['rank'];?></td>
                        <td align="center" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['grade'];?></td>
						<td align="center" class="<?php echo $classname?>"><?php echo $selected_item_list[$i]['point'];?></td>
						
					</tr>
				<?php
					$count++; 
					}
		if (isset($show_conirm_button) && 'no' == $show_conirm_button)
		{
			if (isset($absentee_list) && !empty($absentee_list)) $absentee_array	= explode(',', $absentee_list);
			else $absentee_array = array();
			
	?>
			<tr>
				<td align="left" colspan="<?php echo ($show_conirm_button == 'yes')? @$cnt_judges+10: @$cnt_judges+8;?>">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="50%">
								<br/>
								<div><b>No of Absentees &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo count($absentee_array);?></b></div>
								<?php if(0 < count($absentee_array)){?>
								<div style="margin-top:7px;"><b>Absentee Reg.No&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $absentee_list;?></b></div>
								<?php }?>
								<div style="margin-top:7px;"><b><span class="with_held"> * </span> No of Withheld participants &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $withheld_count;?></b></div>
								<br/>
							</td>
							<td width="50%">
								<table width="100%" cellpadding="3"  cellspacing="0" border="0">
									<tr>
										<td width="40%">&nbsp;</td>
										<td align="center"><b>A Grade</b></th>
										<td align="center"><b>B Grade</b></th>
										<td align="center"><b>C Grade</b></th>
									</tr>
									<tr>
										<td width="10%">&nbsp;</td>
										<td align="center"><?php echo $a_grade_count;?></td>
										<td align="center"><?php echo $b_grade_count;?></td>
										<td align="center"><?php echo $c_grade_count;?></td>
									</tr>
									<tr>
										<td width="10%">&nbsp;</td>
										<td colspan="3">
											
										</td>
									</tr>                                   
								</table>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
	<?php		
		}
	?>
			</table>
		</td>
	</tr>
</table>
<?php
		//$this->load->view('report/report_footer');
?>
</div>
<!-- display content ends here --------------------------------------->
<?php if (@$this->input->post('hidItemId') and $show_conirm_button == 'yes'){?>
<script language="JavaScript">
	window.onload = $('txt_reg_no').focus();;
</script>
<?php }?>
