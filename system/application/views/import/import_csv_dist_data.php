<div align="center" class="heading_gray">
	<h3>Import CSV Data</h3>
</div>
<br/>
<?php 
	if (!is_import_data_finish ($this->session->userdata('DISTRICT')))
	{
	echo form_open_multipart('import/import_district_kalolsavam_data', array('id' => 'formKalolsavam'));
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
<br />

<?php
	echo form_open_multipart('', array('id' => 'formKalolsavamList'));
	echo blue_box_top();
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	  <tr>
		<th align="center" width="5%">Sl No</th>
        <th align="left" width="40%">Subdistrict</th>
        <th align="center" width="20%">Whether Import Data</th>
        <?php if (!is_import_data_finish ($this->session->userdata('DISTRICT'))){?>
        <th align="center" width="20%">Reset Import Data</th>
        <?php }?>
	  </tr>
      
      <?php
	  	$i = 1;
	  	foreach($sub_dist_list as $sub_dist)
		{
		?>
        <tr>
            <td align="center" class="table_row_first"><?php echo $i++?></td>
            <td align="left" class="table_row_first"><?php echo $sub_dist['sub_district_name']?></td>
             <td align="center" class="table_row_first" id="confirm_<?php echo $sub_dist['sub_district_code']?>"><?php echo ($sub_dist['confirm_data_entry'] == 'Y') ? 'Imported' : 'Not Imported'?></td>
            <?php if (!is_import_data_finish ($this->session->userdata('DISTRICT'))){?>
             <td align="center" class="table_row_first" id="confirm_dis_<?php echo $sub_dist['sub_district_code']?>">
            <?php 
            	if ($sub_dist['confirm_data_entry'] == 'Y'){
            ?>
            	<a href="javascript:void(0);" onclick="javascript:reset_sub_dist_import_data('<?php echo addslashes($sub_dist['sub_district_name'])?>','<?php echo $sub_dist['sub_district_code']?>');" >Reset</a>
            <?php }?>
            </td>
            <?php }?>
           
        </tr>
        
        
		<?php
		}
	  ?>
      </table>

<?php
	echo blue_box_bottom();
	echo form_close();
	
	echo '<br/>';

if (!is_import_data_finish ($this->session->userdata('DISTRICT'))){
echo form_open('import/confirm_dist_import_data/', array('id' => 'confirm_sub_dist'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th align="left">
			Confirm
        </th>
			<tr>
				<td class="table_row_first" align="left">
					<label style="color:#990000"><strong>Warning: Once confirmed You can't Import any other data</strong></label>
						<br /><br />
					<?php print(form_button('Confirm','Confirm','onClick="javascript:fncConfirnSubDistImportData();"'));?>
				</td>
			</tr>
</table>
<?php
echo blue_box_bottom();
echo form_close();
}
?>

