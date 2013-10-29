<div align="center" class="heading_gray">
	<h3>Import CSV Data</h3>
</div>
<br/>
<?php 
	if ($import_completed == 'NO'){
	echo form_open_multipart('import/import_data', array('id' => 'formKalolsavam'));
	echo blue_box_top();
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	  <tr>
		<th align="left" colspan="4">Import Kalolsavam CSV Data</th>
	  </tr>
	  <tr>
		<td align="left" class="table_row_first">Upload Kalolsavam CSV File</td>
		<td align="left" class="table_row_first">
			<?php echo form_upload("kalolsavamCSV", 'class="input_box" id="kalolsavamCSV" ');?>
			<span class="guide_line"></span>
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center" colspan="2">
			<?php echo form_button('save_kalolsavam', 'Save', 'id="save_kalolsavam" onClick="javascript:fncSaveKalolsavamCSV();"');?>
		</td>
	  </tr>
	</table>
	<?php
	echo blue_box_bottom();
	echo form_close();
	}
?>