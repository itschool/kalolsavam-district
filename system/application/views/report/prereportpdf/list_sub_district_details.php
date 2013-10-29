<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 15px;
	font-weight: bold;
	color:#000000;
}
.style3{
	font-size: 10px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.pdf_list_table td
{
	height:25px;
}
.pdf_list_table th
{
	height:30px;
}
-->
</style>
<page backtop="20mm" backbottom="10mm">
	<page_header>
		<table style="width: 100%;">
			<tr>
				<td style="text-align: left;width: 100%;height:35px;">
					<h3>
					<?php
						$heading = '';
						if(!empty($user_type_name)) $heading	.=  $user_type_name;
						$heading		.= ' List ';
						if(!empty($sub_district_name)) $heading	.=  ' - '.$sub_district_name.' Sub-District.';
						else if(!empty($district_name) ) $heading	.=  ' - '.$district_name.' District.';
						echo $heading;
					 ?>
					 </h3>
				</td>
			</tr>
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
		</table>
	</page_header>
<page_footer>
		<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%" class="style4">Report Generated From  on <?php echo date("F j, Y, g:i a");  	?>			</td>
			</tr>
		</table>
</page_footer>    
	<table width="100%" class="pdf_list_table">
	  <tr>
		<th align="center" width="50" class="table_row_first">Sl.No.</th>
		<th align="left"  width="180"  class="table_row_first">User Name</th>
		<th align="left"  width="120"  class="table_row_first">Gen. Password</th>
		<?php if(empty($user_type_name)) { ?>
		<th align="left"  width="100"  class="table_row_first">User Type</th>
		<?php }?>
		<?php if(empty($district_name)) { ?>
		<th align="left" width="170"  class="table_row_first">District</th>
		<?php }?>
		<?php if(empty($sub_district_name)) { ?>
		<th align="left" width="150"  class="table_row_first">Sub-District</th>
		<?php }?>
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
		<td height="100" align="center" class="<?php echo $class_name;?>"><?php echo $i; ?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['user_name']); ?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['generated_password']); ?></td>
		<?php if(!isset($_POST['userTypeFilter']) || trim($_POST['userTypeFilter']) == 0) { ?>
		<td align="left" class="<?php echo $class_name;?>"><?php echo $user_type ?></td>
		<?php }?>
		<?php if(!isset($_POST['cmbDistrictFilter']) || trim($_POST['cmbDistrictFilter']) == 0) { ?>
			<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['rev_district_name']); ?></td>
		<?php }?>
		<?php if(!isset($_POST['cmbSubDistrictFilter']) || trim($_POST['cmbSubDistrictFilter']) == 0) {?>
			<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['sub_district_name']); ?></td>
		<?php }?>
	  </tr>
	  <? $i++;} ?>
	</table>
</page>