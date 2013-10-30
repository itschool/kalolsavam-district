<div align="center" class="heading_gray">
<h3>List of participants for team manager</h3>
</div>
<br />
<?php echo form_open('report/prereportpdf/list_participants', array('id' => 'formPWD','target'=>'_blank'));
echo blue_box_top();

	for($j=0;$j<count($retdat); $j++){
	$dat[$retdat[$j]['school_code']] = $retdat[$j]['school_name'];
	}

		
		
?>
<input type="hidden" name="hiddtext" id="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>List of Participant Details - Subdistrict wise</strong></th>
  </tr>
  <tr>
   
    <td width="21%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subdistrict  :</td>
    <td width="23%" align="left" class="table_row_first"><?php echo form_dropdown("cboSubDistCode",$sub_dist_array,$this->input->post('cboSubDistCode'), 'class="input_box" id="cboSubDistCode"');?> </td>
    <td width="55%" class="table_row_first"><div id="cmbitem"> </div><td width="1%">
  </tr>
  <tr>
  		<td width="21%" align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival :</td>
        <td width="23%" align="left" class="table_row_first"><?php echo form_dropdown("Festpart",$pfest,'', 'class="input_box" id="Festpart"'  );?></td>
        <td class="table_row_first"></td>
   </tr>
  <tr>
    <td align="center" colspan="3"><?php echo form_submit('Report', 'Report', 'onClick="javascript: return fnschgpwdAddrr()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>