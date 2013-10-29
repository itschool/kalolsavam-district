<?php echo form_open('login/change_Pwd_insert', array('id' => 'formPWD'));
echo blue_box_top();

		
		$name="";
		$emailid="";
		$mobilenumber="";
		if(count($checkval)>0)
		{
		$name=$checkval[0]['name'];
		$emailid=$checkval[0]['email'];
		$mobilenumber=$checkval[0]['mobile'];
		}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;"><input type="hidden" name="extPWD" id="extPWD" value="<?php //echo $retvalue[0]['password'] ; ?>">
  <tr>
    <th colspan="4" align="left">Change Password</th>
  </tr>
 
  <tr>
   
    <td align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Old Password :</td>
    <td align="left" class="table_row_first"><?php echo form_password("txtOLDPassword",'', 'class="input_box" id="txtOLDPassword"' );?></td>
   
  </tr>
  <tr>
   
    <td align="left" class="table_row_first"> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;New&nbsp;&nbsp;Password : </td>
    <td align="left" class="table_row_first"><?php echo form_password("txtNewPassword",'', 'class="input_box" id="txtNewPassword"' );?></td>
    
  </tr>
  <tr>
   
    <td align="left" width="23%" class="table_row_first">&nbsp;&nbsp;Confirm Password :</td>
    <td align="left" width="77%" class="table_row_first"><?php echo form_password("txtCFMPassword",'', 'class="input_box" id="txtCFMPassword"' );?></td>
   
  </tr>
  <tr>
   
    <td align="left" width="23%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name :</td>
    <td align="left" width="77%" class="table_row_first"><?php echo form_input("Name",$this->input->post('Name') ? $this->input->post('Name') : $name, 'class="input_box" id="Name" onkeyup="javascript:this.value=this.value.toUpperCase();"' );?></td>
   
  </tr>
   <tr>
   
    <td align="left" width="23%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile Number :</td>
    <td align="left" width="77%" class="table_row_first"><?php echo form_input("Mobile_Number",$this->input->post('Mobile_Number') ? $this->input->post('Mobile_Number') : $mobilenumber, 'class="input_box" id="Mobile_Number" onkeypress="javascript:return numbersonly(this, event, false);"' );?></td>
   
  </tr>
  <tr>
   
    <td align="left" width="23%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email Id :</td>
    <td align="left" width="77%" class="table_row_first"><?php echo form_input("Email_id", $this->input->post('Email_id') ? $this->input->post('Email_id') :  ((@count($checkval)>0) ? @$checkval[0]['email'] : ''), 'class="input_box" id="Email_id"' );?></td>
   
  </tr>
  
  <tr>
    <td align="center" colspan="2"><?php echo
	 form_submit('Change Password', 'Change Password', 'onClick="javascript: return fnschgpwdAdd()"');
	 if($checkval[0]['is_change_password']=='Y')
	 {
	 echo ' &nbsp;&nbsp;&nbsp;&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript:gotohome()"');
	 }
	 ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
?>
