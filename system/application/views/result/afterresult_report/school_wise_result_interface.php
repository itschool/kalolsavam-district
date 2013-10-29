<div align="center" class="heading_gray">
<h3>Item Wise Point Result</h3>
</div>
<br />
<?php echo form_open('report/afterresultreportpdf/school_wise_result', array('id' => 'formPWD','target'=>'_blank'));
echo blue_box_top();
  
	//for($j=0;$j<count($retdat); $j++){
	//$dat[$retdat[$j]['school_code']] = $retdat[$j]['school_name'];
	//}

		
		
?>
<input type="hidden" name="hiddtext" id="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>List of Participant Details - School wise</strong></th>
  </tr>
  <tr>
   
    <td width="21%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Code  :</td>
    <td width="23%" align="left" class="table_row_first"><?php echo form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="input_box" id="txtSchoolCode"
	onkeypress="javascript:return numbersonly(this, event, false);"  onBlur="javascript:fetch_schooldetails(this.value)"');?> </td>
    <td width="55%" class="table_row_first"><div id="cmbitem"> </div><td width="1%">
  </tr>
 
    <td align="center" colspan="3"><?php echo form_submit('Report', 'Report', 'onClick="javascript: return fnschgpwdAddrr()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
   <tr><td colspan="3" align="center"><a href="../afterresultreportpdf/allschool_points_result" target="_blank"><strong>All School </strong></a></td>
  </tr>
  <tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>