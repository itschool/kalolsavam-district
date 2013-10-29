<?
$num		=	@$item_det[0]['max_participants'];
$pin_num	=	@$item_det[0]['max_pinnani'];
//echo "----->".var_dump(@$item_det);
$cap_admn	=	@$capt_det[0]['admn_no'];
//echo "----->".@$cap_admn;
$type		=	@$item_det[0]['item_type'];
$limit		=	(int)$num + (int)$pin_num;

//echo "<br /><br />".$limit;
if($limit)
{


?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
                    <tr>
                        <td align="left" width="4%" class="table_row_first">&nbsp;</td>
                        <td align="left" width="19%" class="table_row_first">Admission No.</td>
                        <td align="left" width="22%" class="table_row_first">Name</td>
                        <td align="left" width="9%" class="table_row_first">Class</td>
                        <td align="left" width="9%" class="table_row_first">Gender</td>
                      
                        <td align="center" width="24%" class="table_row_first">Photo Upload [ Max Size : 200KB (600x600)]</td>
                        <td align="left" width="13%" class="table_row_first">&nbsp;</td>
  </tr>
                  
                  <?
				  
	
				 // echo "----->".@$num;
				     for($i=1;$i<=$limit;$i++)
						{
					    //echo "<br>--->".$i;
						//if($i==1 && $type == 'G'){$adm	=	@$cap_admn;} else {$adm	=	"";}
						$txtADNO			=	'txtADNO'.$i;
						$txtParticipantName	=	'txtParticipantName'.$i;
						$txtClass			=	'txtClass'.$i;
						$txtGender			=	'txtGender'.$i;
						$txtClass			=	'txtClass'.$i;
						$txtGender			=	'txtGender'.$i;
						$userfile			=	'userfile'.$i;
						$photo_div			=	'photo_div'.$i;
						$txt_pin			=	'txt_pin'.$i;
						if($i >  $num)
						{
						  $pin_val			=	1;
						 ?>
						 <tr>
							<td colspan="7" align="left"><strong>Pinnany</strong></td>
						 </tr>
						   <?
					   }
					   else
					   {
							$pin_val		=	0;	
						}
						  ?>
<tr>
                    	 <td align="left" width="4%" class="table_row_first"><? echo $i; ?>
                         <input type="hidden" id="<? echo $txt_pin;?>" name="<? echo $txt_pin;?>" value="<? echo $pin_val;?>" />
                         <input type="hidden" id="item_type" name="item_type" value="<? echo $type;?>" />
                         </td>
                     	 <td align="left" width="19%" class="table_row_first"><?php  echo form_input($txtADNO,'', 'size="4px" id="'.$txtADNO.'" maxlength="6" onkeyup="javascript:this.value=this.value.toUpperCase();" onBlur="javascript:fetch_admision_no_details_array('.$i.')"');?>                        </td>
                    
    <td align="left" width="22%" class="table_row_first"><?php echo form_input($txtParticipantName, @$selected_participant[0]['participant_name'], ' class="input_box" id="'.$txtParticipantName.'"onkeyup="javascript:this.value=this.value.toUpperCase();"');?></td>
                        
<td align="left" width="9%" class="table_row_first">
                        <?php 
				          $start	=	@$school_details[0]['class_start'];
						  $end		=	@$school_details[0]['class_end'];
                            $class_array	=	array();
                            for($j = $start; $j <= $end; $j++){
                                $class_array[$j]	=	$j;
                            }
                            echo form_dropdown($txtClass, $class_array, '','id="'.$txtClass.'"');
                        ?>                        </td>
                        
                        <td align="left" width="9%" class="table_row_first">
                        <?php 
							if(@$item_det[0]['gender'] == 'C')
							{						
								echo form_dropdown($txtGender, array('B' => 'Boy', 'G' => 'Girl'), '','id="'.$txtGender.'"');
							}
							else if(@$item_det[0]['gender'] == 'B')
							{
								echo form_dropdown($txtGender, array('B' => 'Boy'), '','id="'.$txtGender.'"');							
							}
							else if(@$item_det[0]['gender'] == 'G')
							{
								echo form_dropdown($txtGender, array('G' => 'Girl'), '','id="'.$txtGender.'"');							
							}?>
                            </td>                 
                       
<td align="left" width="24%" class="table_row_first">
<?
                         echo form_upload($userfile,'','id ="'.$userfile.'"'); ?><br />
                          <input type="hidden" value="<? echo $userfile; ?>"  />
                       
    </td>
                       
<td align="left" valign="top"  colspan="2" class="table_row_first">&nbsp;
                        <div id="<? echo $photo_div; ?>">
                        </div>                         
    </td>
                        
  </tr>
                  <?
				  } 
				  $i=$i-1;
				  
				  ?>
                  <input type="hidden" name="hidtot" id="hidtot" value="<? echo $i; ?>" />
				</table>
                
 <?
 
  }
  
  ?>