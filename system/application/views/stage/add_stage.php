<div align="center" class="heading_gray">
<h3>Define Stages</h3>
</div>
<br />
<?php echo form_open('stage/stage_details/add_stage', array('id' => 'formStage'));
echo blue_box_top();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><?php echo (@$selected_stage[0]['stage_id'] != '') ? 'Edit Stage' : 'Add Stage';?></th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stage Name : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("txtStageName",@$stage_array,@$selected_stage[0]['stage_name'], 'class="input_box" id="txtStageName"' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Discription : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_input("txtStageDescription",@$selected_stage[0]['stage_desc'], 'class="input_box" id="txtStageDescription"' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="4">
	<?php echo (@$selected_stage[0]['stage_id'] != '') ? form_button('Update', 'Update', 'onClick="javascript: return fnsUpdateStage(\''.@$selected_stage[0]['stage_id'].'\')"').'&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript: return cancel()"'):form_submit('Add Stage', 'Add Stage', 'onClick="javascript: return fnsAddStage()"');?> </td>
  </tr>
</table>
<input type="hidden" name="hidStId" id="hidStId" />
<?php
echo blue_box_bottom();
echo form_close();
?>
