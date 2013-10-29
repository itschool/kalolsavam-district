<style>
.style1{
font-size:12px;
color:#FFFFFF;
font-weight:bold;
}
.style5{
font-size:10px;
color:black;
font-weight:bold;
}

</style>

<br />
<marquee direction="up" height="500" scrollamount="3" onMouseOver="this.setAttribute('scrollamount', 0, 0);" onMouseOut="this.setAttribute('scrollamount', 3, 0);">
<table width="87%" border="1" align="center" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
<tr>
    	<td bordercolor="#000000" colspan="7" align="center" class="style1" height="30" style=" border-top:1px black; border-left:1px black; border-right:1px black;" bgcolor="#999900">Items to be Finished in <?php echo $totitem[0]['fest_name']; ?></td>
        </tr>	
  <tr bgcolor="#A8B470">
        <td  height="27" align="center" class="style5">Item </td>
         <td height="27" align="center" class="style5">Stage</td>
        <td height="27" align="center" class="style5">No. of Cluster</td>
        <td height="27" align="center" class="style5">No. of Participants</td>
        <td  height="27" align="center" class="style5">Item Type</td>
        <td height="27" align="center" class="style5" >Maximum Time</td>
        <td height="27" align="center" class="style5" > Date of Item</td>
</tr>
	  <?php
	  $bg=0;
      foreach($totitem as $value){
	  		
				if($value['item_type']=='S')
			 	 $item='Single';
			 	 else $item='Group';
				 
				 if($bg==0){
						$bgcolor="#FFFFCC";
						$bg=1;
						}
					else{
						$bgcolor="#E8EABB";
						$bg=0;
					}
			
      
      ?>
      <tr bgcolor="<?php echo $bgcolor; ?>">
            <td height="25" >&nbsp;<?php echo $value['item_code'].'-'.$value['item_name']; ?> </td>
            <td height="27" align="center"><?php echo $value['stage_name']; ?></td>
            <td align="center"><?php echo $value['no_of_cluster']; ?></td>
            <td align="center"><?php  echo $value['no_of_participant'];?></td>
            <td align="center"><?php echo $item; ?></td>
            <td align="center"><?php echo $value['max_time'].' '.$value['time_type']; ?></td>
             <td align="center"><?php echo datetophpmodel($value['ddt']); ?></td>
</tr>
      <?php
	 	 }
	  
	  ?>
</table>
</marquee>