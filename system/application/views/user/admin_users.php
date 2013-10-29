<br />
<?php echo form_open('user/admin_users/', array('id' => 'filter'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left">Admin Users </th>
  </tr>
  
  <tr>
    <td align="left" colspan="5">
    	<div style="float:left;" id="divDistrict" >
			<?php 
			//$user_tupes	=	array(0=>'--Select One--', 1 => 'State Admin', '2' => 'District Admin', '3' => 'Sub-district Admin', 4 => 'School Admin');
			echo form_dropdown("userTypeFilter", $user_types, @$_POST['userTypeFilter'], 'id="userTypeFilter" class="select_box_medium" onChange="javascript:loadDistrictFilter()"');
			?>
    	</div>  
        <div style="float:left; padding-left:8px; display:<?php echo (isset($_POST['cmbDistrictFilter']) && trim($_POST['cmbDistrictFilter']) != 0)? 'block' : 'none';?>" id="divDistrictFilter">
			<?php 
            echo form_dropdown("cmbDistrictFilter", $states, @$_POST['cmbDistrictFilter'], 'id="cmbDistrictFilter" class="select_box_medium"  onChange="javascript:loadSubDistrictFilter()"');
            ?>
    	</div> 
        <div style="float:left; padding-left:8px; display:<?php echo (isset($_POST['cmbSubDistrictFilter']) && trim($_POST['cmbSubDistrictFilter']) != 0)? 'block' : 'none';?>" id="divSubDistrictFilter">
			<?php 
            echo form_dropdown("cmbSubDistrictFilter", @$sub_districts, @$_POST['cmbSubDistrictFilter'], 'id="cmbSubDistrictFilter" class="select_box_medium"  onChange="javascript:loadSchoolFilter()"');
            ?>
    	</div> 
        <div style="float:left; padding-left:8px; display:<?php echo (isset($_POST['cmbSchoolFilter']) && trim($_POST['cmbSchoolFilter']) != 0)? 'block' : 'none';?>" id="divSchoolFilter">
			<?php 
            echo form_dropdown("cmbSchoolFilter", $schools, @$_POST['cmbSchoolFilter'], 'id="cmbSchoolFilter" class="select_box_medium"');
            ?>
    	</div> 
        <div style="float:left; padding-left:8px; ">
        	<?php echo form_submit('filter', 'Go >>', '');?>
        </div>
		 <div style="float:right; padding-left:8px; ">
		 	<input type="hidden" name="generate_pdf" id="generate_pdf"  />
        	<?php echo '<input value="Generate pdf" type="button" onclick="javascript:generate_sub_dist_admin_pdf();return false;"/>';?>
        </div>
    </td>
  </tr>
<?php 
echo form_close();
echo form_open('user/user_registration/userinsert', array('id' => 'editUser'));?>
<input type="hidden" name="userTypeFilter" id="userTypeFilter" value="<?php echo @$_POST['userTypeFilter']?>" />
<input type="hidden" name="cmbDistrictFilter" id="cmbDistrictFilter" value="<?php echo @$_POST['cmbDistrictFilter']?>" />
<input type="hidden" name="cmbSubDistrictFilter" id="cmbSubDistrictFilter" value="<?php echo @$_POST['cmbSubDistrictFilter']?>" />
<input type="hidden" name="cmbSchoolFilter" id="cmbSchoolFilter" value="<?php echo @$_POST['cmbSchoolFilter']?>" />


  <tr>
    <th align="center" width="10%" class="table_row_first">Sl.No.</th>
    <th align="left"  width="50%"  class="table_row_first">User Name</th>
    <th align="left" width="20%"  class="table_row_first">User Type</th>
    <th align="center" width="10%"  class="table_row_first">Edit</th>
    <th align="center" width="10%"  class="table_row_first">Delete</th>
  </tr>
  
  <?php
$i=1;
foreach($retvalue as $value)
	{
	$class_name = ($i % 2 == 0) ? 'table_row_first' : 'table_row_second';
	if($value['user_type'] == 1)
		$user_type	=	'State Admin';
	else if($value['user_type'] == 2)
		$user_type	=	'District Admin';
	else if($value['user_type'] == 3)
	 	$user_type	=	'Sub-district Admin' ;
	else
		$user_type	=	 'School Admin';
?>
  <tr>
    <td align="center" class="<?php echo $class_name;?>"><?php echo $i; ?></td>
    <td align="left" class="<?php echo $class_name;?>"><?php echo ($value['user_name']); ?></td>
    <td align="left" class="<?php echo $class_name;?>"><?php echo $user_type ?></td>
    <td align="center" class="<?php echo $class_name;?>" ><a href="javascript:void(0)" onClick="javascript:editUser('<?php echo $value['user_id']?>')"> <img src="<?php echo base_url(false)?>images/edit.gif" border="0"> </a> </td>
    <td align="center" class="<?php echo $class_name;?>"><a href="javascript:void(0)" onClick="javascript:deleteUser('<?php echo $value['user_id']?>','<?php echo $user_type ?>','<?php echo ($value['user_name']); ?>')"> <img src="<?php echo base_url(false)?>images/delete.gif" border="0"> </a> </td>
  </tr>
  <? $i++;} ?>
  <input type="hidden" name="UserIdty" id="UserIdty" value="">
</table>
<?php
echo blue_box_bottom();
?>
