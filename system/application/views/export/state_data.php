<div align="center" class="heading_gray">
	<h3>Export Result Data</h3>
</div>
<br/>
<?php
	echo form_open('', array('id' => 'export_state_data'));
	echo blue_box_top();
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
		<th align="left">
			Export Result Data for State Kalolsavam
        </th>
        <tr>
			<td class="table_row_second" align="left">
				The Exporting will be done in two levels . <br />
                1. Export the CSV file for State kalolsavam <br />
                2 Export the photos as a zip file
			</td>
		</tr>
		<tr>
			<td class="table_row_first" align="left"> I . Press this button to download state level csv &nbsp;
				<input type="hidden" name="hidExport" id="hidExport" />
				<?php print(form_button('data_export','Export CSV Data','onClick="javascript:fncExportStateData();return false;"'));?>
			</td>
		</tr>
        <tr>
			<td class="table_row_second" align="left"> II . Press this button to download state level photos &nbsp;
				<?php print(form_button('photo_export','Export Photos','onClick="javascript:fncExportphotos();return false;"'));?>
			</td>
		</tr>
	</table>
<?php
	echo blue_box_bottom();
	echo form_close();
?>