<br />
<?php echo form_open('stage/stage_details/add_stage', array('id' => 'editStage'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left">Stages </td>
  </tr>
  <tr>
    <th align="center" width="10%" class="table_row_first">Sl.No.</th>
    <th align="left"  width="40%"  class="table_row_first">Stage Name</th>
    <th align="left" width="40%"  class="table_row_first">Stage description</th>
    <th align="center" width="10%"  class="table_row_first">Edit</th>
    <!--<th align="center" width="10%"  class="table_row_first">Delete</th>-->
  </tr>
  <?php
$i=1;
foreach($stages as $value)
	{
	$class_name = ($i % 2 == 0) ? 'table_row_first' : 'table_row_second';
?>
  <tr>
    <td align="center" class="<?php echo $class_name;?>"><?php echo $i; ?></td>
    <td align="left" class="<?php echo $class_name;?>"><?php echo ($value['stage_name']); ?></td>
    <td align="left" class="<?php echo $class_name;?>"><?php echo ($value['stage_desc']); ?></td>
    <td align="center" class="<?php echo $class_name;?>" ><a href="javascript:void(0)" onClick="javascript:editStage('<?php echo $value['stage_id']?>')"> <img src="<?php echo base_url(false)?>images/edit.gif" border="0"> </a> </td>
    <!--<td align="center" class="<?php echo $class_name;?>"><a href="javascript:void(0)" onClick="javascript:deleteStage('<?php echo $value['stage_id']?>')"> <img src="<?php echo base_url(false)?>images/delete.gif" border="0"> </a> </td>-->
  </tr>
  <? $i++;} ?>
  <input type="hidden" name="hidStageId" id="hidStageId" value="">
</table>
<?php
echo blue_box_bottom();
?>
