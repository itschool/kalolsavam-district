<?php 
if (@$selected_school[0]['school_name'] or $this->Session_Model->check_user_permission(26)) {
?>
<div align="center" class="heading_gray">
<h3>School Master </h3>
</div>
<br/>
<?php
echo form_open('schools/school_master/add_school_details', array('id' => 'formUser'));
echo blue_box_top();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  
  <tr>
    <th colspan="4" align="left">Add / Edit School</th>
  </tr>
  <?php
  if ($this->Session_Model->check_user_permission(26)) { 
  ?>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Code : </td>
    <td align="left" width="55%" class="table_row_first">
		<?php echo form_input("txtSchoolCode",@$selected_school[0]['school_code'], 'class="input_box" id="txtSchoolCode" onkeypress="javascript:return numbersonly(this, event, false);"' );?>
   		<br />( Leave school code field blank, then auto generate the school code. )
   </td>
    <td width="18%">&nbsp;</td>
  </tr>
  <?php 
  }
  ?>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Name : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_input("txtSchoolName",@$selected_school[0]['school_name'], 'class="input_box" id="txtSchoolName"' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Type : </td>
    <td align="left" width="55%" class="table_row_first">
	<?php 
	$value_array	=	array(0=>'--Select One--', 'G' => 'Government', 'A' => 'Aided', 'U' => 'Unaided');
	echo form_dropdown("cmbSchoolType", $value_array, @$selected_school[0]['school_type'], 'id="cmbSchoolType" class="input_box"');
	?>
    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  <?php 
  if($this->session->userdata('USER_GROUP') == 'W') {?>
  <tr>
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:block" id="divDistrict">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;District : </td>
                <td align="left" width="55%" class="table_row_first">
				<?php 
				echo form_dropdown("cmbDistrict", $districts, @$selected_school[0]['rev_district_code'], 'id="cmbDistrict" class="input_box"  onChange="javascript:loadEduDistrict()"');
				?>
				</td>
                <td width="18%">&nbsp;</td>
              </tr>
            </table>
      </div>  
    </td>
  </tr>
  <?php 
  }
   if ($this->Session_Model->check_user_permission(26)) {
  ?>
  <tr>
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:<?php echo ((isset($selected_school[0]['edu_district_code']) && @$selected_school[0]['edu_district_code'] != '0') || isset($edu_districts))? 'block' : 'none';?>" id="divEduDistrict">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Education District : </td>
                <td align="left" width="55%" class="table_row_first">
				<div id="divEdudistrictCombo">
				<?php 
				echo form_dropdown("cmbEduDistrict", @$edu_districts, @$selected_school[0]['edu_district_code'], 'id="cmbEduDistrict" class="input_box"  onChange="javascript:loadSubDistrict()"');
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
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:<?php echo (isset($selected_school[0]['sub_district_code']) && @$selected_school[0]['sub_district_code'] != '0')? 'block' : 'none';?>" id="divSubdistrict">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sub-district : </td>
                <td align="left" width="55%" class="table_row_first">
                <div id="divSubdistrictCombo">
				<?php 
				echo form_dropdown("cmbSubDistrict", $subdistricts, @$selected_school[0]['sub_district_code'], 'id="cmbSubDistrict" class="input_box"  onChange="javascript:loadSchool()"');
				?>
                </div>
                </td>
                <td width="18%">&nbsp;</td>
              </tr>
            </table>
      </div>  
    </td>
  </tr>
  <?php }?>
  <tr>
    <td align="center" colspan="4">
	<?php echo (@$selected_school[0]['school_code'] != '') ? form_button('Update School', 'Update School', 'onClick="javascript: return fncUpdateSchool(\''.@$selected_school[0]['school_code'].'\', \''.$this->session->userdata('USER_TYPE').'\')"').'&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript: return cancel()"'):form_submit('Add School', 'Add School', 'onClick="javascript: return fncAddSchool(\''.$this->session->userdata('USER_TYPE').'\')"');?> </td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />
<?php
echo blue_box_bottom();
echo form_close();
}
?>
