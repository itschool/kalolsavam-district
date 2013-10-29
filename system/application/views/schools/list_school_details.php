<?php
if (!$this->Session_Model->check_user_permission(26)) { 
?>
<div align="center" class="heading_gray">
<h3>School Master </h3>
</div>
<?php }?>
<br/>

<?php 
echo form_open('schools/school_master/', array('id' => 'filter'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Schools</th>
	<th align="center">Print <img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
  </tr>
  <?php if ($this->Session_Model->check_user_permission(26)) {?>
  <tr>
    <td align="left" colspan="5">
        <?php if($this->session->userdata('USER_GROUP') == 'W') {?>
        <div style="float:left; padding-left:8px; display:block" id="divDistrictFilter">
			<?php 
            echo form_dropdown("cmbDistrictFilter", $districts, @$_POST['cmbDistrictFilter'], 'id="cmbDistrictFilter" class="select_box_medium"  onChange="javascript:loadSubDistrictFilter()"');
            ?>
    	</div> 
        <?php }?>
        <div style="float:left; padding-left:8px; display:<?php echo (isset($_POST['cmbDistrictFilter']) && trim($_POST['cmbDistrictFilter']) != 0)? 'block' : 'none';?>" id="divSubDistrictFilter">
			<?php 
            echo form_dropdown("cmbSubDistrictFilter", @$sub_districts, @$_POST['cmbSubDistrictFilter'], 'id="cmbSubDistrictFilter" class="select_box_medium" ');
            ?>
    	</div> 
       
        <div style="float:left; padding-left:8px; ">
        	<?php echo form_submit('filter', 'Go >>', '');?>
        </div>
    </td>
  </tr>
  
<?php
	} 
echo form_close();

echo form_open('schools/school_master/', array('id' => 'editUser'));?>
  <tr>
    <th align="center" width="10%" class="table_row_first">Sl.No.</th>
	<th align="left"  width="15%"  class="table_row_first">School Code</th>
    <th align="left"  width="45%"  class="table_row_first">School Name</th>
    <th align="left" width="20%"  class="table_row_first">School Type</th>
    <th align="center" width="10%"  class="table_row_first">Edit</th>
  </tr>
  <?php
$i=1;
foreach($retvalue as $value)
	{
	$class_name = ($i % 2 == 0) ? 'table_row_first' : 'table_row_second';
	$school_type	=	'';
	if ($value['school_type'] == 'G')
		$school_type	=	'Government';
	else if ($value['school_type'] == 'A') 
		$school_type	=	'Aided';
	else if ($value['school_type'] == 'U') 
		$school_type	=	'Unaided';
?>
  <tr>
    <td align="center" class="<?php echo $class_name;?>"><?php echo $i; ?></td>
	<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['school_code']); ?></td>
    <td align="left" class="<?php echo $class_name;?>"><?php echo ($value['school_name']); ?></td>
    <td align="left" class="<?php echo $class_name;?>"><?php echo $school_type ?></td>
    <td align="center" class="<?php echo $class_name;?>" ><a href="javascript:void(0)" onClick="javascript:editUser('<?php echo $value['school_code']?>')"> <img src="<?php echo base_url(false)?>images/edit.gif" border="0"> </a> </td>
  </tr>
  <? $i++;} ?>
  <input type="hidden" name="UserIdty" id="UserIdty" value="">
</table>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="1" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th align="center" width="10%" class="table_row_first">Sl.No.</th>
		<th align="left"  width="20%"  class="table_row_first">School Code</th>
		<th align="left"  width="55%"  class="table_row_first">School Name</th>
		<th align="left" width="30%"  class="table_row_first">School Type</th>
	  </tr>
	  <?php
	$i=1;
	foreach($retvalue as $value)
		{
		$class_name = ($i % 2 == 0) ? 'table_row_first' : 'table_row_second';
		$school_type	=	'';
		if ($value['school_type'] == 'G')
			$school_type	=	'Government';
		else if ($value['school_type'] == 'A') 
			$school_type	=	'Aided';
		else if ($value['school_type'] == 'U') 
			$school_type	=	'Unaided';
	?>
	  <tr>
		<td align="center" class="<?php echo $class_name;?>"><?php echo $i; ?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['school_code']); ?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['school_name']); ?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo $school_type ?></td>
	  </tr>
	  <?php
	  $i++;
	 }
?>
</table>
</body>
</div>
<!-- display content ends here --------------------------------------->
<?php
echo blue_box_bottom();
?>
