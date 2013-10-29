<?php echo form_open_multipart('photos/photos/bulk_upload', array('id' => 'formschool_photo','name' => 'formschool_photo'));
echo blue_box_top();

	for($j=0;$j<count(@$retdat); $j++){
	$dat[@$retdat[$j]['school_code']] = @$retdat[$j]['school_name'];
	}
//var_dump(@$school_det);
	/*$j	=	0;	*/
	
	//echo "<br />first j>>>>>".uri_string(); 
		
?>
<input type="hidden" name="hiddtext" id="hiddtext" value="">
<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" /> 
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong>Photo Upload - School Wise</strong></th>
  </tr>
  <tr> 
   
    <td width="20%" align="left" class="table_row_first"><strong> &nbsp;Enter School Code  :</strong></td>
    <td width="24%" align="left" class="table_row_first"><?php echo form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="input_box" id="txtSchoolCode"  onkeypress="javascript:return numbersonly(this, event, false);"'); ?> </td>
    <td width="55%" class="table_row_first"><div id="cmbitem"> </div><td width="1%">
  </tr>
  <tr>
    <td align="center" colspan="3"><?php echo form_submit('Get Details', 'Get Details', 'onClick="javascript: return fetch_schoolwise_studdetails()"'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr> 
</table>

<br />


<? if(@$participant_det) {
 $i	=	0;  
  if(!is_numeric ($cur_num)) 
 {
 	$cur_num	=	0;
 }
  /* $j++;
   echo "<br />second j>>>>>".$j;*/
?>
<div class="paging"><?php echo @$pagination; ?></div> 
<? //echo "--->".$pagination; ?>
<div id="schcode_wise_upload" align="center"> 
  <table width="975" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
   <tr>
  <td align="center" class="table_row_first" colspan="3"><strong>School Code : <? echo @$school_det[0]['school_code'] ?></strong></td>
  <td align="left" class="table_row_first" colspan="5"><strong>School Name : <? echo @$school_det[0]['school_name'] ?></strong></td>
   </tr>
  <tr>
      <th colspan="8" align="center"><strong>Participant Details</strong></th>
  </tr>
  
  <tr>
   <td width="37" align="left" class="table_row_first"><strong>Sl.No</strong></td>
   <td width="57" align="left" class="table_row_first"><strong>Reg No</strong></td>
   <td width="94" align="left" class="table_row_first"><strong>Admission No</strong></td>
   <td width="167" align="left" class="table_row_first"><strong>Name</strong></td>
   <td width="51" align="left" class="table_row_first"><strong>Gender</strong></td>
   <td width="43" align="left" class="table_row_first"><strong>Class</strong></td>
   <td width="239" align="left" class="table_row_first"><strong>Upload Photo</strong><br />
	[ Max Size : 200KB (600x600)]</td>
   <td width="223" align="left" class="table_row_first"><strong>Photo</strong></td>
  </tr>
  <?  
  
  foreach(@$participant_det as $part_det)
   { 
    //echo "<br />".var_dump($part_det)."<br />";
   		$reg	=	@$part_det['admn_no'];
		$i++;
   ?>

  <tr>
   <td width="37" align="left" class="table_row_first">
	   <?php @$cur_num++; echo $cur_num;  ?>   </td>
      <td align="left" class="table_row_first">
	   <?php  echo @$part_det['participant_id'];  ?> 
    </td>
    <td width="94" align="left" class="table_row_first">
	   <?php echo @$part_det['admn_no']; ?>
        <input type="hidden" name="hidadmn<? echo $i?>" id="hidadmn<? echo $i?>" value="<?php echo @$part_det['admn_no'] ?>" /> 
       <input type="hidden" name="hidschcode<? echo $i?>" id="hidschcode<? echo $i?>" value="<?php echo @$part_det['school_code'] ?>" />  
    </td>
    <td align="left" class="table_row_first">
	   <?php  echo @$part_det['participant_name'];  ?> 
    </td>
    <td align="left" class="table_row_first">
	   <?php  echo @$part_det['gender'];  ?> 
    </td>
    <td align="left" class="table_row_first">
	   <?php  echo @$part_det['class'];  ?> 
    </td>
    <td align="left" class="table_row_first">
	   <?php 
	   //echo "-->".$i;
	   $userfile	=	'userfile'.$i;
	  
	   echo form_upload($userfile,'','id ="'.$userfile.'"'); ?>
	   <input type="hidden" value="<? echo $userfile; ?>"  />
    </td>
    <td width="223" align="left" class="table_row_first">&nbsp;
	<?php 
	//echo "<br /><br /><br />".var_dump(@$Photo)."<br /><br />";	  
		if(@$Photo['pic'][$reg])
		{
		   $pic_path	=	@$Photo['pic'][$reg];
	       echo "<img src='$pic_path' width='70' height='70'>";				 
		}
    ?>  </td>
  </tr>
  <? } ?>
  <tr>
  <td>
  <input type="hidden" name="hidtot" id="hidtot" value="<? echo $i; ?>" />
  <?

echo form_submit('upload', 'Upload','onClick="return check_upload_schoolwise();"'); 
?>

</td></tr>

</table>
</div>
<? 
 
} ?>

<div class="paging"><?php echo @$pagination; ?></div> 

<?

echo blue_box_bottom();
echo form_close();
?>