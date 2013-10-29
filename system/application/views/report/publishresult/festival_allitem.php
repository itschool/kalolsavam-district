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
<table width="92%" border="1" align="center" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
	<tr style="border-bottom:2px black; border-top:2px black; border-left:1px black; border-right:1px black;">
    	<td colspan="7" bgcolor="#AE5E5E" align="center" height="28" style="border-bottom:2px black; border-top:2px black; border-left:1px black; border-right:1px black;" class="style1"><?php echo $totitem[0]['fest_name']; ?> Festival Details</td>
    </tr>

  <tr bgcolor="#EFDEDE">
        <td width="160" height="27" align="center" class="style5">Item </td>
    <td width="40" height="27" align="center" class="style5">Stage No.</td>
    <td width="40" height="27" align="center" class="style5">No. of Cluster</td>
    <td width="40" height="27" align="center" class="style5">No. of Participants</td>
    <td width="39"  height="27" align="center" class="style5">Item Type</td>
    <td width="38" height="27" align="center" class="style5">Maximum Time</td>
        <td width="43" height="27" align="center" class="style5">Date of Item</td>
  </tr>
	  <?php
	  $bg=0;
      foreach($totitem as $value){
			  if($value['item_type']=='S')
			  $item='Single';
			  else $item='Group';
			  
			  	if($bg==0){
						$bgcolor="#E1C4C4";
						$bg=1;
						}
					else{
						$bgcolor="#FFF4F4";
						$bg=0;
					}
      
      ?>
      <tr bgcolor="<?php echo $bgcolor; ?>">
            <td height="25" >&nbsp;<?php echo $value['item_code'].' - '.$value['item_name']; ?> </td>
             <td align="center"><?php echo $value['stage_name']; ?></td>
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