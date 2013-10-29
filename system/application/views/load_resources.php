<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th width="4%" align="left">Sl. No.</th>
		<th width="13%" align="left">Resource Name</th>
		<th width="10%" align="left">Availabiity</th>
		<th width="10%" align="left">Assign</th>
	</tr>
	<?php
	$count = 1;
	$total_records = count($resource_details);
	for($i=0; $i < $total_records; $i++){
	$style = ($count%2==0) ? 'table_row_first' : 'table_row_second';
	if($resource_assigned)
	{
		if($resource_assigned[0]["resource_id"]==$resource_details[$i]["resource_id"])
		{
			$checked	=	" checked ";
		}
		else
		{
			$checked	=	"";
		}
	}
	else
	{
		$checked	=	"";
	}
	?>
	<tr>
	<td align="left" class="<?php echo $style;?>"><?php echo $count ?></td>
	<td align="left" class="<?php echo $style;?>"><?php echo $resource_details[$i]["resource_first_name"]." ".$resource_details[$i]["resource_last_name"]; ?></td>
	<td align="left" class="<?php echo $style;?>"></td>
	<td align="left" class="<?php echo $style;?>"><input <?php echo $checked ?> onclick="javascript:document.FrmTasks.submit();return false;" type="radio" name="resource_id" id="resource_id" value="<?php echo $resource_details[$i]["resource_id"]?>"/></td>
	</tr>
	<?php
	$count++;
	}
	?>
</table>