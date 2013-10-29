<style>
.style1{
font-size:12px;
font-weight:bold;
color:#AC3C0B;

}
.style2{
font-size:12px;
font-weight:bold;
color:#A76830;
}

.style4{
font-size:12px;
color:#A76830;
}
.style5{
font-size:16px;
color:#0033FF;
}
</style>
<br><br><br>
<?php echo form_open('', array('id' => 'festrep','name'=>'festrep','target'=>'_blank'));

?>
<div align="center" class="style5"><b>RESULT</b></div> 
<br>
	<table width="70%"  align="center" border="1">
  
  <input type="hidden" id="hidfestId" name="hidfestId" value="">
  
  		<?php
		$bg=0;
		foreach($fest as $key){
		
		if($bg==0){
						$bgcolor="#CFE4EB";
						$bg=1;
						}
					else{
						$bgcolor="#E6EFF7";
						$bg=0;
					}
		
		?>
  <tr bgcolor=" <?php echo $bgcolor; ?> ">
			
        <td width="100" height="25" class="style2">&nbsp;&nbsp;<?php echo $key['fest_name']; ?></td>
        <td width="149" align="center" class="style1">
       		<a href="javascript:void(0)"  onClick="javascript:clickresultdeclered('<?php echo $key['fest_id']; ?>')">Result - Declared</a>
       	</td>
        <td width="134" align="center" class="style1">
        	<a href="javascript:void(0)" onClick="javascript:return cickpointdeclared('<?php echo $key['fest_id']; ?>')" >Points - School</a>
        </td>
        <td width="134" align="center" class="style1">
        	<a href="javascript:void(0)" onClick="javascript:return cicksubpointdeclared('<?php echo $key['fest_id']; ?>')" >Points - Subdistrict</a>
        </td>
        
  </tr>
  
  		<?php
		}
		?>
    <!--<tr bgcolor="#FCDCF5">
    
        <td width="100" height="25" class="style2">&nbsp;&nbsp;All Festival </td>
        <td width="149" align="center" class="style1">
        	<a href="../allresults" target="_blank">Result - Declared</a>
        </td>
        <td width="134" align="center" class="style1">
        	<a href="../allfestschools" target="_blank">Points - School</a>
        </td>
        <td width="134" align="center" class="style1">
        	<a href="../allfestsubdistrict" target="_blank">Points - Subdistrict</a>
        </td>
    </tr>-->
        
 </table>
 <br>
	<table width="70%" align="center" border="1">
        	<tr bgcolor="#D5E1A8">
        		<td colspan="4" height="29" align="center" valign="bottom" class="style4"><a href="../allresults" target="_blank"> All Results </a></td>
 			 </tr>
      	   <tr bgcolor="#D5E1A8">
        		<td colspan="4" height="37" align="center" class="style4"><a href="../festval_status" target="_blank"> Status of Festival </a></td>
  			</tr>
	</table>
	<?php
	echo form_close();
	?>