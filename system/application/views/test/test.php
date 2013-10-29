<?php //for ($i = 0; $i <400; $i++)
{?>

<table border="1">
<tr>
	<td colspan="9" >SM_DETAILS</td>
</tr>
<?php
	foreach ($school_master->result_array() as $school)
	{
?>
<tr>
	<td>
    	<?php echo $school['school_code']?>
    </td>
    <td>
    	<?php echo $school['sub_district_code']?>
    </td>
    <td>
    	<?php echo $school['edu_district_code']?>
    </td>
    <td>
    	<?php echo $school['rev_district_code']?>
    </td>
    <td>
    	<?php echo trim($school['school_name'])?>
    </td>
    
    <td>
    	<?php echo $school['school_type']?>
    </td>
    <td>
    	<?php echo $school['master_confirm']?>
    </td>
    <td>
    	<?php echo $school['school_status']?>
    </td>
    
    <td>
    	<?php echo get_encr_password($school['school_code'].$school['sub_district_code'].$school['rev_district_code'].$school['school_type'])?>
    </td>
</tr>

<?php }?>
</table>

<table border="1">
<tr>
	<td colspan="19" >SD_DETAILS</td>
</tr>
<?php
	foreach ($school_details->result_array() as $school)
	{
?>
<tr>
	<td>
    	<?php echo $school['school_code']?>
    </td>
    <td>
    	<?php echo $school['class_start']?>
    </td>
    <td>
    	<?php echo $school['class_end']?>
    </td>
    <td>
    	<?php echo $school['school_phone']?>
    </td>
    <td>
    	<?php echo $school['school_email']?>
    </td>
    <td>
    	<?php echo $school['hm_name']?>
    </td>
    <td>
    	<?php echo $school['hm_phone']?>
    </td>
    <td>
    	<?php echo $school['principal_name']?>
    </td>
    <td>
    	<?php echo $school['principal_phone']?>
    </td>
    <td>
    	<?php echo $school['teachers']?>
    </td>
    
    <td>
    	<?php echo $school['strength_lp']?>
    </td>
    <td>
    	<?php echo $school['strength_up']?>
    </td>
    <td>
    	<?php echo $school['strength_hs']?>
    </td>
    <td>
    	<?php echo $school['strength_hss']?>
    </td>
    
    <td>
    	<?php echo $school['strength_vhss']?>
    </td>
    <td>
    	<?php echo $school['total_strength']?>
    </td>
    <td>
    	<?php echo $school['is_create_report']?>
    </td>
    <td>
    	<?php echo $school['is_finalize']?>
    </td>
    <td>
    	<?php echo get_encr_password($school['school_code'].$school['class_start'].$school['class_end'].$school['total_strength'])?>
    </td>
</tr>

<?php }?>
</table>



<table border="1">
<tr>
	<td colspan="8" >PM_DETAILS</td>
</tr>
<?php
	foreach ($participant_details->result_array() as $participant)
	{
?>
<tr>
	<td>
    	<?php echo $participant['participant_id']?>
    </td>
    <td>
    	<?php echo $participant['school_code']?>
    </td>
    <td>
    	<?php echo $participant['sub_district_code']?>
    </td>
    <td>
    	<?php echo $participant['admn_no']?>
    </td>
    <td>
    	<?php echo $participant['participant_name']?>
    </td>
    
    <td>
    	<?php echo $participant['class']?>
    </td>
    <td>
    	<?php echo $participant['gender']?>
    </td>
    <td>
    	<?php echo get_encr_password($participant['participant_id'].$participant['school_code'].$participant['sub_district_code'].$participant['admn_no'].$participant['class'].$participant['gender'])?>
    </td>
</tr>

<?php }?>
</table>



<table border="1">
<tr>
	<td colspan="9" >PD_DETAILS</td>
</tr>
<?php
	foreach ($participant_item_details->result_array() as $participant)
	{
?>
<tr>
	<td>
    	<?php echo $participant['participant_id']?>
    </td>
    <td>
    	<?php echo $participant['school_code']?>
    </td>
    <td>
    	<?php echo $participant['admn_no']?>
    </td>
    <td>
    	<?php echo $participant['parent_admn_no']?>
    </td>
    <td>
    	<?php echo $participant['item_code']?>
    </td>
    
    <td>
    	<?php echo $participant['item_type']?>
    </td>
    <td>
    	<?php echo $participant['spo_id']?>
    </td>
    <td>
    	<?php echo $participant['spo_remarks']?>
    </td>
    <td>
    	<?php echo $participant['is_captain']?>
    </td>
    <td>
    	<?php echo get_encr_password($participant['participant_id'].$participant['school_code'].$participant['admn_no'].$participant['parent_admn_no'].$participant['item_code'].$participant['spo_id'].$participant['is_captain'])?>
    </td>
</tr>

<?php }?>
</table>
<?php }?>







