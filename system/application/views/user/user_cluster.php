<?php echo form_open('user/user_cluster/save_user_cluster', array('id' => 'formUser'));
echo blue_box_top();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="2" align="left">User Creation</th>
  </tr>
  <tr>
    <td align="left" width="20%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name : </td>
    <td align="left" width="80%" class="table_row_first"><?php echo form_input("txtNewUserName",@$selected_cluster[0]['user_name'], 'class="input_box" id="txtNewUserName"' );?></td>
  </tr>
  <tr>
    <td align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password : </td>
    <td align="left" class="table_row_first">
		<?php echo form_password("txtNewPassword",'', 'class="input_box" id="txtNewPassword"' );?>
    	<?php echo (@$selected_cluster[0]['user_name']) ? "<br>( Leave password field blank, if you don't want to change the password. )" : '';?>
    </td>
  </tr>
  <?php 
  if(count(@$schools) > 0 || count(@$selected_cluster_schools) > 0){?>
  <tr>
    <td align="left" class="table_row_first" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Schools : </td>
    <td align="left" class="table_row_first" >
		<table cellpadding="3" cellspacing="2" border="0">
			<tr>
				<?php
				$newTR	=	0;
				for($j=0; $j<count(@$selected_cluster_schools); $j++){
					
					$data = array();
					if (in_array($selected_cluster_schools[$j]['school_code'],$entered_school))
					{
						$data = array(
								'name'        => $selected_cluster_schools[$j]['school_code'].'chk',
								'id'          => $selected_cluster_schools[$j]['school_code'].'chk',
								'value'       => $selected_cluster_schools[$j]['school_code'],
								'disabled'     => 'TRUE',
								'checked'     => 'TRUE',
								
								);
						?>
                        <input type="hidden" name="<?php echo $selected_cluster_schools[$j]['school_code'];?>" id="<?php echo $selected_cluster_schools[$j]['school_code'];?>" value="<?php echo $selected_cluster_schools[$j]['school_code'];?>" />
                        <?php
					}
					else
					{
						$data = array(
								'name'        => $selected_cluster_schools[$j]['school_code'],
								'id'          => $selected_cluster_schools[$j]['school_code'],
								'value'       => $selected_cluster_schools[$j]['school_code'],
								'checked'     => 'TRUE',
								);
					}
					if($newTR%2 == 0){?>
					</tr>
					<tr>
					
					<?php
					}
							
					echo '<td>'.form_checkbox($data);
					echo form_label($selected_cluster_schools[$j]['school_code'].' - '.$selected_cluster_schools[$j]['school_name'], $selected_cluster_schools[$j]['school_code']).'</td>';
					?>
					</div>
					<?php
					$newTR++;
				}
				
				
				
				
				
				for($i=0; $i<count(@$schools); $i++){
					if(count(@$selected_schools) > 0 && @$selected_schools[0] != 0){
						$checked	=	(in_array($user_rights[$i]['rf_id'], @$selected_user_rights)) ? 'TRUE' : '';
					} else {
						$checked	=	'';
					}
					$data = array(
								'name'        => $schools[$i]['school_code'],
								'id'          => $schools[$i]['school_code'],
								'value'       => $schools[$i]['school_code'],
								'checked'     => $checked,
								);
					if($newTR%2 == 0){?>
					</tr>
					<tr>
					
					<?php
					}
							
					echo '<td>'.form_checkbox($data);
					echo form_label($schools[$i]['school_code'].' - '.$schools[$i]['school_name'], $schools[$i]['school_code']).'</td>';
					?>
					</div>
					<?php
					$newTR++;
				}
				?>
			</tr>
		</table>
    </td>
  </tr>
  <?php  }?>
  <tr>
    <td align="center" colspan="2">
	<?php echo (@$selected_cluster[0]['user_id'] != '') ? form_button('Update Cluster', 'Update Cluster', 'onClick="javascript: return fncUpdateCluster(\''.@$selected_cluster[0]['user_id'].'\')"').'&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript: return cancel_cluster()"'):form_submit('Add Cluster', 'Add Cluster', 'onClick="javascript: return fncAddCluster()"');?> </td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />
<?php
echo blue_box_bottom();
echo form_close();
?>