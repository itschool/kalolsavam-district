<div align="center" class="heading_gray">
<h3>Status of Kalolsavam</h3>
</div>
<br />
<?php echo form_open('report/afterresultreportpdf/status_of_kalolsavam1', array('id' => 'formIWP','target'=>'_blank'));
echo blue_box_top();
?>

<form name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Select Festival</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    Festival Type :</td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbFestType"');?></td>
    <td width="18%">&nbsp;</td>
  </tr>
   <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    Date :</td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("festdate",$date_array,'', 'class="input_box" id="festdate"');?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onclick="return notSelected()">
        </label>
    </form>    </td>
    <td width="18%">&nbsp;</td>
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