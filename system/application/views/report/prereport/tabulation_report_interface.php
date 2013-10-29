<br />
<?php echo form_open('report/prereport/rpt_tabulation_sheet', array('id' => 'formTabItem','target'=>'_blank'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Tabulation Sheet(Item Wise)</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbFestType" onchange="javascript:fetch_item_from_festival(this.value)"'  );?></td>
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
    <td align="left" class="table_row_first"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No of Participants :</div></td>
    <td align="left" class="table_row_first"><?php 
			 echo form_input("txtParticipantNum",'', 'class="input_box_small" id="txtParticipantNum" onkeypress="javascript:return numbersonly(this, event, false);"');
		
		?>    (No of rows to be printed)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first"><form name="form1" method="post" action="" >
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onclick="javascript: return tabulationitemsubmit()">
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
