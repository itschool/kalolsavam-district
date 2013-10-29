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


<br /><br />
<table width="71%" border="1" align="center" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">

<tr>
        <td height="30" align="center" class="style1" bgcolor="#666600">Finished Items </td>
  </tr>
	  <?php
      foreach($totitem as $value){
      
      ?>
      <tr>
            <td height="25" bgcolor="#B8CDCF" >&nbsp;&nbsp;<?php echo $value['item_code'].' - '.$value['item_name']; ?> </td>
  </tr>
      <?php
	  }
	  ?>
</table>
