<style>
.style1{font-size:14px;
font-weight:bold;
color:#964B4B;
}
.style2{font-size:12px;
font-weight:bold;
color:#FFFFFF;
}
.style3{font-size:12px;
font-weight:bold;
color:black;
}


.style4{font-size:14px;
font-family:"Arial Narrow";
font-weight:bold;
color:black;
}
</style>
<body topmargin="0" bgcolor="#ECE2F1">
	<?php
	if(count($details)>0){

	?>
<marquee direction="up" height="500" scrollamount="3" onMouseOver="this.setAttribute('scrollamount', 0, 0);" onMouseOut="this.setAttribute('scrollamount', 3, 0);">
<table width="64%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
	 <tr bgcolor="#A2BDEA">
    	<td colspan="4" align="center" height="27" class="style1" > Kerala School Kalolsavam</td></tr>
     <?php
		//$prev_festid="";
		//foreach($details as $value){
			
			//if($prev_festid!=$value['fest_id']){
			//$prev_festid=$value['fest_id'];
			$count=0;
		
		 ?>
<tr bgcolor="#964B4B">
    	<td colspan="4" align="center" height="27" class="style2"> School Point <?php echo (@$details[0]['fest_name']) ? '( Festival&nbsp;:&nbsp;'.@$details[0]['fest_name'].')' : ''; ?></td>
  </tr>
     <tr>
     	<td width="11%" height="24" align="center" bgcolor="#B4B4B4" class="style3">Sl.No.</td>
       <td width="50%" align="center" bgcolor="#E5E5E5" class="style3">School Code & Name</td>
       <td width="40%" align="center" bgcolor="#E5E5E5" class="style3">Subdistrict Code & Name</td>
       <td width="15%" align="center" bgcolor="#B4B4B4" class="style3">Po<span class="style3">i</span>nt</td>
		
  <tr>
			 <? //} 
             foreach($details as $value){
			 $count++; 
             ?>
             <td width="11%" height="23" align="center" bgcolor="#B4B4B4" class="style4"><?php echo $count; ?></td>
             <td width="50%" height="23" align="left" bgcolor="#E5E5E5" class="style4">&nbsp;&nbsp;&nbsp;<?php echo wordwrap($value['school_code'].'&nbsp;&nbsp;&nbsp;'.$value['school_name'],65,'<br>'); ?></td>
             <td width="40%" height="23" align="left" bgcolor="#E5E5E5" class="style4">&nbsp;&nbsp;&nbsp;<?php echo wordwrap($value['sub_district_code'].' - '.$value['sub_district_name'],50,'<br>'); ?></td>
             <td width="15%" height="23" align="center" bgcolor="#B4B4B4" class="style4"><?php echo $value['spoint']; ?></td>
  </tr>
  		<?php } ?>
  
    </table>
</marquee>
    <?php }
		else {
		?>
        <table align="center" width="75%">
       	 <tr>
        	<td align="center">Try later...... Points are  Not Ready </td>
      	  </tr>
        </table>
      
        <? } ?>
        </body>
