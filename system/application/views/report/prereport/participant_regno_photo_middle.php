<!--<div align="center" class="heading_gray">
<h3>Participant Card(single)</h3>
</div>-->
<br />
<?php echo form_open('report/prereportpdf/participant_regnowithphoto', array('id' => 'part_reg','target'=>'_blank'));
echo blue_box_top();

	for($j=0;$j<count($retdat); $j++){
	$dat[$retdat[$j]['school_code']] = $retdat[$j]['school_name'];
	}	
?>

<input type="hidden" name="hiddtext" name="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>Participants Cards - Reg No Wise</strong></th>
  </tr>
  <tr>
   
    <td width="20%" align="left" class="table_row_first"><strong> &nbsp;Enter Register Number :</strong></td>
    <td width="24%" align="left" class="table_row_first"><?php echo form_input("regno", '','class="input_box" id="regno" onkeypress="javascript:return numbersonly(this, event, false);" '); ?> </td>
    <td width="55%" class="table_row_first"><td width="1%">
  </tr>
  <tr>
    <td align="center" colspan="3"><?php echo form_submit('Card', 'Card'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>