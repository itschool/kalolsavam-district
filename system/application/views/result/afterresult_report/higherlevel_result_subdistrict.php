<br/>
<?php echo form_open('report/afterresultreportpdf/higherlevel_result_subdistrict/', array('id' => 'formPW','target'=>'_blank'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>Select Sub District</strong></th>
  </tr>
   <tr>
   
    <td width="21%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subdistrict  :</td>
    <td width="23%" align="left" class="table_row_first"><?php echo form_dropdown("cboSubDistCode",$sub_dist_array,$this->input->post('cboSubDistCode'), 'class="input_box" id="cboSubDistCode"');?> </td>
    <td width="55%" class="table_row_first"><div id="cmbitem"> <?php echo form_submit('Report', 'Report', 'onClick=""');?></div><td width="1%">
  </tr>
  <tr>
    <td align="center" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>