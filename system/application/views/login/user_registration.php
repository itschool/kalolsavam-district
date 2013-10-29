<?php echo form_open('schools/registration/update', array('id' => 'formSchool'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	
	<tr>
		<th colspan="4" align="left">User Creation</th>
  </tr>
	<tr>
    <td width="23%">&nbsp;</td>
		<td align="left" width="32%" class="table_row_first">User Name : </td>
		<td align="left" width="45%" class="table_row_first"><?php echo form_input("txtUserName", class="input_box" id="txtUserName" );?></td>
  </tr><tr><td>&nbsp;</td>
        <td align="left" width="32%" class="table_row_first">Password : </td>
		<td align="left" width="45%" class="table_row_first"><?php echo form_password("txtPassword", class="input_box" id="txtPassword" );?></td>
	</tr>
    <tr><td>&nbsp;</td>
        <td align="left" width="32%" class="table_row_first">User Type : </td>
		<td align="left" width="45%" class="table_row_first"><?php form_dropdown("userType", array(0=>'--', 1 =>'Admin', 2 =>'User'),'id="userType"');?></td>
	</tr>
    
    <tr>
		<td align="center" colspan="3">
			<?php echo form_submit('Add User', 'Add User');?>
		</td>
	</tr>
    </table>
<?php
echo blue_box_bottom();
echo form_close();
?>
