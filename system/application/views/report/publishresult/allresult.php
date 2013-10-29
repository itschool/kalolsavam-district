
<br><br>
<marquee direction="up" height="500" scrollamount="3" onMouseOver="this.setAttribute('scrollamount', 0, 0);" onMouseOut="this.setAttribute('scrollamount', 3, 0);">
	<?php
	if(count($details)>0){
	?>
  <table width="80%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
        <?php
		$prev_itemcode="";
		$prev_festid="";
		foreach($details as $value){
		
			if($prev_festid!=$value['fest_id']){
		?>

	

		<tr bgcolor="#C6D6EA"><td colspan="9" align="center" height="27"> Result:<?php echo $details[0]['fest_name']; ?></td></tr>
		<?php
		}
		if($prev_itemcode!=$value['item_code']){
				$prev_itemcode=$value['item_code'];
		?>
 	 <tr>
   		 <td width="18" colspan="9" align="center" height="25"><?php echo $value['item_code'].'  '.$value['item_name']; ?></td>
 	 </tr>
     <tr>
       <td align="center">&nbsp;</td> 
             <td align="center" height="25">Reg. No</td>
             <td align="center" height="25">Code No.</td>
             <td align="center" height="25">Name</td>
             <td align="center" height="25">STD</td>
             <td align="center" height="25">School Name</td>
             <td align="center" height="25">Rank</td>
             <td align="center" height="25">Grade</td>
             <td align="center" height="25">Point</td>
      </tr>
 		 <?php } 
		 @$pic_path	=	image_url()."/img_user_nophoto.jpg";
		 ?>
 	 <tr>
 	   <td align="center"><?php  echo "<img src='".@$pic_path."'width='80' height='80'>"?></td>
             <td align="center" height="25"><?php echo $value['participant_id']; ?></td>
             <td align="center" height="25"><?php echo $value['code_no']; ?></td>
             <td height="25">&nbsp;<?php echo wordwrap($value['participant_name'],25,'<br>'); ?></td>
             <td align="center" height="25"><?php echo $value['class']; ?></td>
             <td height="25">&nbsp;<?php echo  wordwrap($value['school_name'],35,'<br>'); ?></td>
             <td height="25" align="center"><?php echo $value['rank']; ?></td>
             <td height="25" align="center"><?php echo $value['grade']; ?></td>
             <td height="25" align="center"><?php echo $value['point']; ?></td>
  	</tr>
  		<?php } ?>
  
    </table>
</marquee>
    <?php }
		else {
		?>
        <table align="center" width="75%">
       	 <tr>
        	<td align="center">Please Wait....... Result Not Prepared</td>
      	  </tr>
        </table>
        <? } ?>
