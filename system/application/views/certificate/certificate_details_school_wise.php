<div align="center" class="heading_gray">
<h3>Certificate School Wise</h3>
</div>
<br/>
<?php echo form_open('', array('id' => 'formIWPq'));
echo blue_box_top();
?>
<input type="hidden" name="hidSchoolCode" id="hidSchoolCode" value=""  />
<table width="100%" border="0" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left"> 
    &nbsp;&nbsp;&nbsp; Certificate - School Wise: 
	<th align="right">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
  </tr>
  <tr>
  	<th width="5%" class="table_row_first">SI.No </th>
    <th width="37%" class="table_row_first">&nbsp;&nbsp;&nbsp;School Name & Code </th>
    <!--<th align="center" width="8%" class="table_row_first">Total Item</th>
    <th align="center" width="8%" class="table_row_first">No.Students</th>-->
    <th align="center" width="8%" class="table_row_first">Participation</th>
	<th align="center" width="8%" class="table_row_first">A Grade</th>
	<th align="center" width="8%" class="table_row_first">B Grade</th>
	<th align="center" width="8%" class="table_row_first">C Grade</th>
	<!--<th align="center" width="8%" class="table_row_first">Total Points</th>-->
  </tr>
 <?php
 	for($j = 0; $j < count($school_details); $j++)
	{
	?>
		<tr>
			<td align="center" class="table_row_first" ><?php echo $j+1; ?></td>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<a href="javascript:void(0)" onClick="javascript:getSchoolWiseCertificate(<?php echo $school_details[$j]['school_code'];?>)">
				<?php echo $school_details[$j]['school_code'].'&nbsp;-&nbsp;'.$school_details[$j]['school_name']; ?></a>
			</td>
			<!--<td align="center" class="table_row_first" ><?php //echo $itemtype; ?></td>
			<td align="center" class="table_row_first"><?php // echo $itempart[$j]['cpt']; ?></td>-->
			<td align="center" class="table_row_first"><?php echo $school_details[$j]['no_participation']; ?></td>
			<td align="center" class="table_row_first"><?php echo $school_details[$j]['a_grade'];?></td>
			<td align="center" class="table_row_first"><?php echo $school_details[$j]['b_grade'];?></td>
			<td align="center" class="table_row_first"><?php echo $school_details[$j]['c_grade'];?></td>
			<!--<td align="center" class="table_row_first"><?php echo $school_details[$j]['total_point'];?></td>-->
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
    <th colspan="6" align="left"> 
    &nbsp;&nbsp;&nbsp; Certificate - School Wise: 
	</td>
  </tr>
  <tr>
  	<th width="5%" class="table_row_first">SI.No </th>
    <th width="37%" class="table_row_first">&nbsp;&nbsp;&nbsp;School Name & Code </th>
    <!--<th align="center" width="8%" class="table_row_first">Total Item</th>
    <th align="center" width="8%" class="table_row_first">No.Students</th>-->
    <th align="center" width="8%" class="table_row_first">Participation</th>
	<th align="center" width="8%" class="table_row_first">A Grade</th>
	<th align="center" width="8%" class="table_row_first">B Grade</th>
	<th align="center" width="8%" class="table_row_first">C Grade</th>
	<!--<th align="center" width="8%" class="table_row_first">Total Points</th>-->
  </tr>
 <?php
 	for($j = 0; $j < count($school_details); $j++)
	{
	?>
		<tr>
			<td align="center" class="table_row_first" ><?php echo $j+1; ?></td>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<?php echo $school_details[$j]['school_code'].'&nbsp;-&nbsp;'.$school_details[$j]['school_name']; ?>
			</td>
			<!--<td align="center" class="table_row_first" >&nbsp;<?php //echo $itemtype; ?></td>
			<td align="center" class="table_row_first">&nbsp;<?php // echo $itempart[$j]['cpt']; ?></td>-->
			<td align="center" class="table_row_first">&nbsp;<?php echo $school_details[$j]['no_participation']; ?></td>
			<td align="center" class="table_row_first">&nbsp;<?php echo $school_details[$j]['a_grade'];?></td>
			<td align="center" class="table_row_first">&nbsp;<?php echo $school_details[$j]['b_grade'];?></td>
			<td align="center" class="table_row_first">&nbsp;<?php echo $school_details[$j]['c_grade'];?></td>
			<!--<td align="center" class="table_row_first">&nbsp;<?php echo $school_details[$j]['total_point'];?></td>-->
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