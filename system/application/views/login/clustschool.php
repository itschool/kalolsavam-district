<?php echo form_open('', array('id' => 'clustschool'));
echo blue_box_top();
?>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="1">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
    	<th colspan="4">
        	<?php print('Name&nbsp;:&nbsp;&nbsp;'.$cluster[0]['name'].'&nbsp;&nbsp;&nbsp;&nbsp;Mobile&nbsp;:&nbsp;'.$cluster[0]['mobile'].'&nbsp;&nbsp;&nbsp;&nbsp;E-mail&nbsp;:&nbsp;'.$cluster[0]['email']);?>
        </th>
		<th align="center">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
    </tr>
    <tr>
		<th align="left" width="5%">SI.No</th>
		<th width="50%" align="left">School</th>
        <th width="15%" align="center">Data Entered</th>
        <th width="10%" align="center">Confirmed</th>
		<?php if ($this->session->userdata('USER_TYPE') <= 3){?>
        <th width="15%" align="center">Reset Confirmation</th>
        <?php }else{?>
        <th width="15%" align="center">&nbsp;</th>
         <?php }?>
	</tr>
        <?php
		for($j=0;$j<count($school);$j++){
		$flag=0;
		for($k=0;$k<count($part);$k++){
				
				if($school[$j]['school_code']==$part[$k]['school_code']){
				 $entry='Yes';
				 $flag=1;
				}
			}
				if($flag==0)
			 		 $entry='No';
				 if($school[$j]['is_finalize']=='Y')
				 	$finalize='Yes';
				else if($school[$j]['is_finalize']=='N')
					$finalize='No';
				else 
					$finalize='No';
				$status = (empty($school[$j]['is_finalize']))? 'N' : $school[$j]['is_finalize'];
		?>
        <tr>
			<td align="left" class="table_row_first"><?php echo ($j+1);?></td>
        	<td align="left" &nbsp;&nbsp;&nbsp; class="table_row_first">
				<a href="javascript:void(0)" onClick="javascript:goschooldet('<?php echo $school[$j]['school_code']?>')">
				<?php echo $school[$j]['school_code'];  ?>&nbsp;-&nbsp;
				<?php echo $school[$j]['school_name'];  ?></a></td>
			<td align="center" class="table_row_first"><?php echo $entry; ?></td>
			<td id="<?php echo 'confirm_'.($j+1);?>" align="center" class="table_row_first"><?php echo $finalize; ?></td>
			<?php if ($this->session->userdata('USER_TYPE') <= 3){?>
            <td id="<?php echo 'confirm_'.($j+1);?>_dis" align="center" class="table_row_first">
				<?php
				if('No' != $entry && 'Yes' == $finalize)
				{
				?>
					<a id="<?php echo ($j+1);?>" href="javascript:void(null);" 
						onClick="javascript:fnc_change_confirmation_status('<?php echo addslashes($school[$j]['school_name']).' - '.$school[$j]['school_code'];  ?>',<?php echo $school[$j]['school_code'];?>, '<?php echo 'confirm_'.($j+1);?>');return;">
						Reset 
					</a>
				<?php 
				}
				?>
			</td>
             <?php }else{?>
        	<td align="center" class="table_row_first">&nbsp;</td>
            <?php }?>
	  </tr>
        
        <?php
		$flag=0;
		}
		?>
        
</table>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >
	<table width="100%" border="1" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
		<tr>
			<th colspan="4">
				<?php print('Name&nbsp;:&nbsp;&nbsp;'.$cluster[0]['name'].'&nbsp;&nbsp;&nbsp;&nbsp;Username:&nbsp;&nbsp;'.$cluster[0]['user_name'].'&nbsp;&nbsp;&nbsp;&nbsp;Mobile&nbsp;:&nbsp;'.$cluster[0]['mobile'].'&nbsp;&nbsp;&nbsp;&nbsp;E-mail&nbsp;:&nbsp;'.$cluster[0]['email']);?>
			</th>
		</tr>
		<tr>
			<th width="5%" align="left">SI.No</th>
			<th width="55%" align="left">School</th>
			<th width="20%" align="center">Data Entered</th>
			<th width="20%" align="center">Confirmed</th>
		</tr>
			<?php
			for($j=0;$j<count($school);$j++){
			$flag=0;
			for($k=0;$k<count($part);$k++){
					
					if($school[$j]['school_code']==$part[$k]['school_code']){
					 $entry='Yes';
					 $flag=1;
					}
				}
					if($flag==0)
						 $entry='No';
					 if($school[$j]['is_finalize']=='Y')
						$finalize='Yes';
					else if($school[$j]['is_finalize']=='N')
						$finalize='No';
					else 
						$finalize='No';
			
			?>
			<tr>
				<td align="left" ><?php echo ($j+1);?></td>
				<td align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;
					<?php echo $school[$j]['school_code'];  ?>&nbsp;-&nbsp;
					<?php echo $school[$j]['school_name'];  ?></td>
				<td align="center" class="table_row_first"><?php echo $entry; ?>   </td>
				<td align="center" class="table_row_first"><?php echo $finalize; ?>  </td>
			</tr>
		<?php
			$flag=0;
			}
		?>
	</table>
</div>
<!-- display content ends here --------------------------------------->
<?php
echo blue_box_bottom();

echo form_close();

?>