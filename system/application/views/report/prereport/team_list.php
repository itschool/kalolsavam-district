<div align="center" class="heading_gray">
<h3>Team List</h3>
</div>
<br />
<?php echo form_open('report/prereportpdf/team_list', array('id' => 'part_reg','target'=>'_blank'));
echo blue_box_top();

	
?>

<input type="hidden" name="hiddtext" id="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>Participants in Group Items</strong></th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbFestType" onchange="javascript:fetch_team_item_from_festival(this.value)"'  );?></td>
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
    <td width="20%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Captain :</td>
    <td width="24%" align="left" class="table_row_first"><div id="cmbcap"><?php echo form_dropdown("cbo_cap",array('select'),'', 'class="input_box" id="cbo_cap" '  );?></div> </td>
    <td width="55%" class="table_row_first"><td width="1%">
  </tr>
  
  <tr>
  
  <tr>
    <td align="center" colspan="3"><?php echo form_submit('Report', 'Report'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    </td>
  </tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>