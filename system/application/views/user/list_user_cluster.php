<br />
<?php echo form_open('user/user_registration/userinsert', array('id' => 'editUser'));

echo blue_box_top();

?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left"> Existing Users </td>
  </tr>
  <tr>
    <th align="center" class="table_row_first">Sl.No.</th>
    <th align="left" class="table_row_first">User Name</th>
 	<th align="left" class="table_row_first">No of Schools</th>
    <th align="center" class="table_row_first">Edit</th>
    <!--<th align="center" class="table_row_first">Delete</th>-->
  </tr>
  <?php
$i=1;
foreach($retvalue as $value)
	{
	$class_name = ($i % 2 == 0) ? 'table_row_first' : 'table_row_second';
?>
  <tr>
    <td align="center" class="<?php echo $class_name;?>"><?php echo $i; ?></td>
    <td align="left" class="<?php echo $class_name;?>"><?php echo ($value['user_name']); ?></td>
	<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['total']); ?></td>
    <td align="center" class="<?php echo $class_name;?>" ><a href="javascript:void(0)" onClick="javascript:editUser('<?php echo $value['user_id']?>')"> <img src="<?php echo base_url(false)?>images/edit.gif" border="0"> </a> </td>
    <!--<td align="center" class="<?php echo $class_name;?>"><a href="javascript:void(0)" onClick="javascript:deleteUser('<?php echo $value['user_id']?>')"> <img src="<?php echo base_url(false)?>images/delete.gif" border="0"> </a> </td>-->
  </tr>
  <? $i++;} ?>
  <input type="hidden" name="UserIdty" id="UserIdty" value="">
</table>
<?php
echo blue_box_bottom();
?>
