<div align="center" class="heading_gray">
<h3>Result Itemwise</h3>
</div>
<br />
<?php echo form_open('report/timefestreport/timefest_result_confidential', array('id' => 'timeoffest'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Declared &nbsp;Result </th>
  </tr>
  <tr>
    <td width="10%" class="table_row_first">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("resultFest",$fest,'', 'class="input_box" id="resultFest" ');?></td>
    <td width="18%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_row_first">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="GET">
        </label>       </td>
    <td width="18%" class="table_row_first">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />
<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>
