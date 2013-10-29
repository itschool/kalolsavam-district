<input type="hidden" name="hidUservalue" id="hidUservalue"  value="SHOW" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Participant &nbsp;&nbsp;- Certificate Details</th>
  </tr>
  <tr>
    <td width="5%" class="">&nbsp;</td>
    <td align="left" width="20%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Register Number : </td>
    <td align="left" width="65%" class="table_row_first">
		<input type="text" onkeyup="javascript:fetch_participant_details_result();" onblur="javascript:fetch_participant_details_result();" 
				onkeypress="javascript:return numbersonly(this, event, false);" id="txtParticipantId" class="input_box_small" value="<?php echo (isset($participant_id) && !empty($participant_id)) ? $participant_id:'';?>" name="txtParticipantId"/>
		<span id="participant_detail_id"><?php echo (isset($participant_details) && !empty($participant_details)) ? $participant_details:'';?></span>
	</td>
    <td width="20%"></td>
  </tr>
  <?php if(isset($item_drop_down) && !empty($item_drop_down)){?>
  <tr >
    <td class="">&nbsp;</td>
    <td align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item : </td>
    <td align="left" class="table_row_first" ><?php echo $item_drop_down;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" class="table_row_first">
		<label>
       	<?php echo form_submit('GET', 'GET', '');?>
        </label>
   </td>
    <td >&nbsp;</td>
  </tr>
  <?php }?>
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>