<div align="center" class="heading_gray">
<h3>Participating Schools</h3>
</div>
<br />

<?php echo form_open('report/prereportpdf/list_school/', array('id' => 'formPWD','target'=>'_blank'));
echo blue_box_top();

		
		
?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>List  of Participating Schools with School Code</strong></th>
  </tr>
 
  <tr>
   
    <td width="23%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival  :</td>
    <td width="77%" align="left" class="table_row_first"><?php echo form_dropdown("txtfestFrom", array($retdat[0]['fest_id']=>$retdat[0]['fest_name'],$retdat[1]['fest_id']=>$retdat[1]['fest_name'],
	$retdat[2]['fest_id']=>$retdat[2]['fest_name'],
	$retdat[3]['fest_id']=>$retdat[3]['fest_name'],
	$retdat[4]['fest_id']=>$retdat[4]['fest_name'],
	$retdat[5]['fest_id']=>$retdat[5]['fest_name'],
	$retdat[6]['fest_id']=>$retdat[6]['fest_name'],
	
	0=>'All Festival'
	),'id="txtfestFrom"');?></td>
  </tr>
   <tr>
   
    <td width="21%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subdistrict  :</td>
    <td width="23%" align="left" class="table_row_first"><?php echo form_dropdown("cboSubDistCode",$sub_dist_array,$this->input->post('cboSubDistCode'), 'class="input_box" id="cboSubDistCode"');?> </td>
    <td width="55%" class="table_row_first"><div id="cmbitem"> </div><td width="1%">
  </tr>
  <tr>
    <td align="center" colspan="2"><?php echo form_submit('Report', 'Report', 'onClick="javascript: return fnschgpwdAddrr()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>