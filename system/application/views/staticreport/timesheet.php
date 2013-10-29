<?php echo form_open('staticreport/onstagereport/timeshhet_re_det', array('id' => 'formIWP'));
echo blue_box_top();
?>
<input type="hidden" name="hidUserId" id="hidUserId" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Time Sheet :</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbFestType" onchange="javascript:fetch_callsheet_festival(this.value)"'  );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="55%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">      <label>
       <?php echo form_submit('Report', 'Report', 'onClick="javascript: return callsheet()"');?>
        </label>
    </form>
    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>


<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>