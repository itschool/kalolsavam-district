<div align="center" class="heading_gray">
<h3>Participants in Group Items</h3>
</div>
<br />
<?php echo form_open('report/prereportpdf/list_of_participants_in_group', array('id' => 'part_reg','target'=>'_blank'));
echo blue_box_top();

	
?>

<input type="hidden" name="hiddtext" name="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>Participants in Group Items</strong></th>
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
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td width="20%" align="left" class="table_row_first"> &nbsp;Enter Register Number :</td>
    <td width="24%" align="left" class="table_row_first"><?php echo form_input("regno", '','class="input_box" id="regno" onkeypress="javascript:return numbersonly(this, event, false);" '); ?> </td>
    <td width="55%" class="table_row_first"><td width="1%">
  </tr>
  
  <tr>
  <tr>
    <td align="center" colspan="3"><?php echo form_submit('Card', 'Card'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>
