<?php echo form_open('', array('id' => 'formIWPq'));
echo blue_box_top();
?>
<input type="hidden" name="txtItemCode" id="txtItemCode" value=""  />
<table width="100%" border="0" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="6" align="left"> 
    &nbsp;&nbsp;&nbsp;Festival  : 
	<?php echo $itempart[0]['fest_name']; ?>&nbsp;&nbsp;</th>
  </tr>
  <tr>
    <td width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;Item Code & Name  </td>
    <td align="center" width="15%" class="table_row_first">Item Type</td>
    <td align="center" width="10%" class="table_row_first"> No of Students</td>
    <td align="center" width="20%" class="table_row_first">Date & Time</td>
     <td align="center" width="10%" class="table_row_first">Stage</td>
     <td align="center" width="20%" class="table_row_first">No. of Cluster</td>
  </tr>
  
  <?php
 	for($j=0;$j<count($single);$j++){
			if($single[$j]['item_type']=='S')
				$itemtype='Single';
			else if($single[$j]['item_type']=='G')
				$itemtype='Group';
			else 
				$itemtype='';
		
	?>
     <tr>
    <td width="27%" class="table_row_first">
	&nbsp;&nbsp;
    <a href="javascript:void(0)" onClick="javascript:getitemstagedet('<?php echo $single[$j]['item_code'] ?>')">
	<?php echo $single[$j]['item_code'].'&nbsp;-&nbsp;'.$single[$j]['item_name']; ?></a> </td>
    <td align="center" width="15%" class="table_row_first" >
	<?php echo $itemtype; ?></td>
    <td align="center" width="10%" class="table_row_first">
     <?php echo $single[$j]['cpt']; ?></td>
    <td align="center" width="20%" class="table_row_first">
     <?php echo $single[$j]['start_time']; ?></td>
       <td align="center" width="10%" class="table_row_first"> 
	   <?php echo $single[$j]['stage_name']; ?></td>
     <td align="center" width="20%" class="table_row_first">
      <?php echo $single[$j]['no_of_cluster']; ?></td>
  </tr>
    
    	
	
	<?php
	}
	?>
    
    
 <?php
 	for($j=0;$j<count($itempart);$j++){
			if($itempart[$j]['item_type']=='S')
				$itemtype='Single';
			else if($itempart[$j]['item_type']=='G')
				$itemtype='Group';
			else 
				$itemtype='';
		
	?>
     <tr>
    <td width="27%" class="table_row_first">
	&nbsp;&nbsp;
    <a href="javascript:void(0)" onClick="javascript:getitemstagedet('<?php echo $itempart[$j]['item_code'] ?>')">
	<?php echo $itempart[$j]['item_code'].'&nbsp;-&nbsp;'.$itempart[$j]['item_name']; ?></a> </td>
    <td align="center" width="15%" class="table_row_first" >
	<?php echo $itemtype; ?></td>
    <td align="center" width="10%" class="table_row_first">
     <?php echo $itempart[$j]['cpt']; ?></td>
    <td align="center" width="20%" class="table_row_first">
     <?php echo $itempart[$j]['start_time']; ?></td>
       <td align="center" width="10%" class="table_row_first"> 
	   <?php echo $itempart[$j]['stage_name']; ?></td>
     <td align="center" width="20%" class="table_row_first">
      <?php echo $itempart[$j]['no_of_cluster']; ?></td>
  </tr>
    
    	
	
	<?php
	}
	?>
</table>


<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>