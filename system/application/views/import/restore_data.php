<style type="text/css">
<!--
.style1 {
	color: #990000;
	font-size: 24px;
}
.style2 {
	color: #660000;
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
<div align="center" class="heading_gray">
	<h3>Restore kalolsavam Database</h3>
</div>
<br/>
<?php 
	echo form_open_multipart('import/restore_database', array('id' => 'formKalolsavam'));
	echo blue_box_top();
	?>
   
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	  <tr>
		<th align="left" colspan="4">Restore kalolsavam Database</th>
	  </tr>
    <tr>
    	<td colspan="4" align="left"><div align="center" class="style2">If you Restore the database all the data will be loss . Take a backup before you restore the database.</div>       </td>
    </tr>
     <tr>
    <td colspan="4" align="left"><div align="center" class="style2"><a href="<?php echo base_url();?>import/backup_data"><a href="<?php echo base_url();?>import/backup_data">To take a backup of your database . Please click here</a></a><strong></strong></div>       </td>
    </tr>
	  <tr>
		<td align="left" class="table_row_first">Upload Kalolsavam Database backup file (.sql)</td>
		<td align="left" class="table_row_first">
			<?php echo form_upload("kalolsavamdatabase", 'class="input_box" id="kalolsavamdatabase" ');?>
			<span class="guide_line"></span>
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center" colspan="2">
			<?php echo form_button('save_kalolsavamdatabase', 'Save', 'id="save_kalolsavamdatabase" onClick="javascript:fncrestoreKalolsavamdatabase();"');?>
		</td>
	  </tr>
	</table>
	<?php
	echo blue_box_bottom();
	echo form_close();
?>