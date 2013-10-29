<?php echo form_open('itemreport/', array('id' => 'formPWD'));
echo blue_box_top();

		
		
?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>List  of Item details</strong></th>
  </tr>
 
  <tr>
   
    <td width="23%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival  :</td>
    <td width="77%" align="left" class="table_row_first"><?php echo form_dropdown("txtfestFrom", $retdat,'id="txtfestFrom"');?></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><?php echo form_submit('Get', 'Get', '');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>