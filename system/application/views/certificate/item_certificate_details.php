<br/>
<?php echo form_open('', array('id' => 'formIWPq'));
echo blue_box_top();
?>
<input type="hidden" name="hidItemId" id="hidItemId" value=""  />
<table width="100%" border="1" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="8" align="left"> 
    &nbsp;&nbsp;&nbsp;Festival  : 
	<?php echo $itempart[0]['fest_name']; ?>&nbsp;&nbsp;</th>
	<th align="right">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
  </tr>
  <tr>  
    <th width="5%" class="table_row_first">Printed ?</th>	
    <th width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;Item Code & Name  </th>
    <th align="center" width="10%" class="table_row_first">Item Type</th>
    <th align="center" width="10%" class="table_row_first"> No.Students</th>
    <th align="center" width="10%" class="table_row_first">Participation</th>
	<th align="center" width="10%" class="table_row_first">Non-Participation</th>
	<th align="center" width="10%" class="table_row_first">A Grade</th>
	<th align="center" width="10%" class="table_row_first">B Grade</th>
	<th align="center" width="10%" class="table_row_first">C Grade</th>
  </tr>
 <?php
 	for($j = 0; $j < count($itempart); $j++)
	{
			if($itempart[$j]['item_type']=='S')
				$itemtype='Single';
			else if($itempart[$j]['item_type']=='G')
				$itemtype='Group';
			else 
				$itemtype='';
		if($itempart[$j]['is_certificate_printed']==0)		
		   $printed	=	'No';
		else
			$printed	=	'Yes';		 			    
	?>
		<tr>            
            <td align="left" class="table_row_first" ><?php echo $printed; ?></td>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<a href="javascript:void(0)" onClick="javascript:getItemCertificate('<?php echo $itempart[$j]['item_code'] ?>')">
				<?php echo $itempart[$j]['item_code'].'&nbsp;-&nbsp;'.$itempart[$j]['item_name']; ?></a>
			</td>
			<td align="center" class="table_row_first" ><?php echo $itemtype; ?></td>
			<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['participated_no']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['cpt']-$itempart[$j]['participated_no']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['a_grade'];?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['b_grade'];?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['c_grade'];?></td>
		</tr>
	<?php
	}
	?>
</table>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >
	<?php
			//$this->load->view('report/report_header');
	?>
<table width="100%" border="1" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
    <th colspan="8" align="left"> 
    &nbsp;&nbsp;&nbsp;Festival  : 
	<?php echo $itempart[0]['fest_name']; ?>&nbsp;&nbsp;</th>
  </tr>
  <tr>    
    <th width="5%" class="table_row_first">Printed ? </th>
    <th width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;Item Code & Name  </th>
    <th align="center" width="10%" class="table_row_first">Item Type</th>
    <th align="center" width="10%" class="table_row_first"> No.Students</th>
    <th align="center" width="10%" class="table_row_first">Participation</th>
	<th align="center" width="10%" class="table_row_first">Non-Participation</th>
	<th align="center" width="10%" class="table_row_first">A Grade</th>
	<th align="center" width="10%" class="table_row_first">B Grade</th>
	<th align="center" width="10%" class="table_row_first">C Grade</th>
  </tr>
  <?php
 	for($j = 0; $j < count($itempart); $j++)
	{
			if($itempart[$j]['item_type']=='S')
				$itemtype='Single';
			else if($itempart[$j]['item_type']=='G')
				$itemtype='Group';
			else 
				$itemtype='';
			if($itempart[$j]['is_certificate_printed']==0)		
			   $printed	=	'No';
			else
				$printed	=	'Yes';	
	?>
		<tr>  
        	<td align="left" class="table_row_first" ><?php echo $printed; ?></td>      	
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<?php echo $itempart[$j]['item_code'].'&nbsp;-&nbsp;'.$itempart[$j]['item_name']; ?>
			</td>
			<td align="center" class="table_row_first" ><?php echo $itemtype; ?></td>
			<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['participated_no']; ?></td>
			<td align="center" class="table_row_first"><?php echo $itempart[$j]['cpt']-$itempart[$j]['participated_no']; ?></td>
			<td align="center" class="table_row_first">&nbsp;<?php echo $itempart[$j]['a_grade'];?></td>
			<td align="center" class="table_row_first">&nbsp;<?php echo $itempart[$j]['b_grade'];?></td>
			<td align="center" class="table_row_first">&nbsp;<?php echo $itempart[$j]['c_grade'];?></td>
		</tr>
	<?php
	}
	?>
</table>
<?php
		//$this->load->view('report/report_footer');
?>
</div>
<!-- display content ends here --------------------------------------->
<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>