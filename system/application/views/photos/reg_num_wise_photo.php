<?php echo form_open_multipart('photos/photos/upload', array('id' => 'formreg_photo','name' => 'formreg_photo'));
echo blue_box_top();

   //echo "<br /><br /><br />";
   //var_dump(@$item_det);

	for($j=0;$j<count(@$retdat); $j++){
	$dat[@$retdat[$j]['school_code']] = @$retdat[$j]['school_name'];
	}
		
		
?>
 <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" /> 
<input type="hidden" name="hiddtext" value="" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="3" align="left"><strong>Admission Number Wise Photo Upload</strong></th>
  </tr>
  <tr>
   
    <td width="22%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Code  :</td>
    <td width="78%" align="left" class="table_row_first"><?php echo form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="input_box" id="txtSchoolCode"  onkeypress="javascript:return numbersonly(this, event, false);" '); ?> </td>
  </tr>
    <tr>
   
    <td width="22%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admission Number  :</td>
    <td align="left" class="table_row_first"><?php echo form_input("txtRegNum", @$school_details[0]['school_code'], 'class="input_box" id="txtRegNum" '); ?> </td>
    </tr>
  
  <tr>
    <td align="center" colspan="2"><?php echo form_submit('GetDetails', 'GetDetails', 'onClick="javascript: return fetch_studdetails()"'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<br />

<? if(@$participant_det) {?>
<div id="regnum_wise_upload" align="center"> 
   <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="3" align="center"><strong>Participant Details</strong></th>
  </tr>
  <tr>
   
    <td width="23%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Code </td>
    <td width="67%" align="left" class="table_row_first">&nbsp; :&nbsp;<?php echo @$participant_det[0]['school_code']." - ".@$participant_det[0]['school_name']; ?> 
    <input type="hidden" name="hidschcode" id="hidschcode" value="<?php echo @$participant_det[0]['school_code'] ?>" />    </td>
    <td width="10%" rowspan="2" align="left" class="table_row_first">
      <?php 
	  
	  if(@$Photo)
		{
			  echo "<img src='$Photo' width='100' height='100'>";
                 
		}
	  ?>    </td>
  </tr>
  <tr>
   
    <td width="23%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admission Number </td>
    <td width="67%" align="left" class="table_row_first">&nbsp; :&nbsp;<?php echo @$participant_det[0]['admn_no']; ?>
 <input type="hidden" name="hidadmn" id="hidadmn" value="<?php echo @$participant_det[0]['admn_no'] ?>" />  </td>
   </tr>
    <tr>
   
    <td width="23%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Participant Name </td>
    <td colspan="2" align="left" class="table_row_first">&nbsp; :&nbsp;<?php  echo @$participant_det[0]['participant_name'];  ?> </td>
    </tr>
        
    <tr>
   
    <td width="23%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name </td>
    <td colspan="2" align="left" class="table_row_first">&nbsp; :&nbsp;<?php  
	
	foreach(@$item_det as $item)
	{			
		echo @$item['item_name']."<br />&nbsp;&nbsp;&nbsp;&nbsp;";		  
	}
	//echo wordwrap(@$item['item_name'],30,"<br />\n");
	?> </td>
     </tr>
    
    <tr>
   
    <td width="23%" align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Photo Upload </td>
    <td colspan="2" align="left" class="table_row_first">&nbsp; : &nbsp;<?php echo form_upload('userfile',''); ?> [ Max Size : 200KB (600x600)] </td>
     </tr>
    
    <tr>
   
    <td width="23%" align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td colspan="2" align="left" class="table_row_first">&nbsp;  &nbsp;
    <? echo form_submit('upload', 'Upload','onClick="return check_upload()"'); ?>
    </td>
     </tr>
</table>
</div>
<? } ?>

<?php
echo blue_box_bottom();
echo form_close();
?>