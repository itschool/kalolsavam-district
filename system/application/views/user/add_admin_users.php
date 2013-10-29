<?php echo form_open('user/admin_users/add_admin', array('id' => 'formUser'));
echo blue_box_top();
?>
<input type="hidden" name="show_generate_admin" id="show_generate_admin" value="<?php echo (@$show_generate_admin) ? 0 : 1;?>" />
<input type="hidden" name="userTypeFilter" id="userTypeFilter" value="<?php echo @$_POST['userTypeFilter']?>" />
<input type="hidden" name="cmbDistrictFilter" id="cmbDistrictFilter" value="<?php echo @$_POST['cmbDistrictFilter']?>" />
<input type="hidden" name="cmbSubDistrictFilter" id="cmbSubDistrictFilter" value="<?php echo @$_POST['cmbSubDistrictFilter']?>" />
<input type="hidden" name="cmbSchoolFilter" id="cmbSchoolFilter" value="<?php echo @$_POST['cmbSchoolFilter']?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Add Admin</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_input("txtNewUserName",@$selected_user[0]['user_name'], 'class="input_box" id="txtNewUserName"' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_password("txtNewPassword",'', 'class="input_box" id="txtNewPassword"' );?><?php if (@$selected_user[0]['user_name']){?><br>( Leave password field blank, if you don't want to change the password. )<?php }?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Type : </td>
    <td align="left" width="55%" class="table_row_first">
		<div class="float_left">
			<?php
			//$value_array	=	array(0=>'--Select One--', 1 => 'State Admin', '2' => 'District Admin', '3' => 'Sub-district Admin', 4 => 'School Admin');
			echo form_dropdown("userType", $user_types, @$selected_user[0]['user_type'], 'id="userType" class="input_box" onChange="javascript:loadDistrict()"');
			?>
		</div>
		<div id="divGenerateSubDistAdmin_user_type" class="float_left" ></div>
    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:<?php echo (isset($selected_user[0]['rev_district_code']) && @$selected_user[0]['rev_district_code'] != '0')? 'block' : 'none';?>" id="divDistrict">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;District : </td>
                <td align="left" width="55%" class="table_row_first">
					<div class="float_left">
						<?php 
						echo form_dropdown("cmbDistrict", $states, @$selected_user[0]['rev_district_code'], 'id="cmbDistrict" class="input_box"  onChange="javascript:loadSubDistrict()"');
						?>
					</div>
					<div id="divGenerateSubDistAdmin_dist" class="float_left" ></div>
				</td>
                <td width="18%">&nbsp;</td>
              </tr>
            </table>
      </div>  
    </td>
  </tr>
  <tr>
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:<?php echo (isset($selected_user[0]['sub_district_code']) && @$selected_user[0]['sub_district_code'] != '0')? 'block' : 'none';?>" id="divSubdistrict">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sub-district : </td>
                <td align="left" width="55%" class="table_row_first">
					<div class="float_left">
						<div id="divSubdistrictCombo">
						<?php 
						echo form_dropdown("cmbSubDistrict", $subdistricts, @$selected_user[0]['sub_district_code'], 'id="cmbSubDistrict" class="input_box"  onChange="javascript:loadSchool()"');
						?>
						</div>
					</div>
					<div id="divGenerateSubDistAdmin_sub_dist" class="float_left" ></div>
                </td>
                <td width="18%">&nbsp;</td>
              </tr>
            </table>
      </div>  
    </td>
  </tr>
  <tr>
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:<?php echo (isset($selected_user[0]['school_code']) && @$selected_user[0]['school_code'] != '0')? 'block' : 'none';?>" id="divSchool">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School : </td>
                <td align="left" width="55%" class="table_row_first">
                <div id="divSchoolCombo">
				<?php
				echo form_dropdown("cmbSchool", $schools, @$selected_user[0]['school_code'], 'id="cmbSchool" class="input_box"');
				 ?>
                 </div>
                 </td>
                <td width="18%">&nbsp;</td>
              </tr>
            </table>
      </div>  
    </td>
  </tr>
  <tr>
    <td align="center" colspan="4">
	<?php echo (@$selected_user[0]['user_id'] != '') ? form_button('Update User', 'Update User', 'onClick="javascript: return fnsUserUpdate(\''.@$selected_user[0]['user_id'].'\')"').'&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript: return cancel()"'):form_submit('Add User', 'Add User', 'onClick="javascript: return fnsUserAdd()"');?> </td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />
<?php
echo blue_box_bottom();
echo form_close();
?>
