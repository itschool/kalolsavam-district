<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style9{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.style5{
	font-size: 10px;
	color:#000000;
}
.tb{
font-size: 12px;
	font-weight: bold;
	color:#000000;}
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
	  
<page backtop="30mm" backbottom="25mm ">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
            <tr>
                <td align="center" class="style1" valign="top">Top Scorers</td>
            </tr>  
        </table>
        
        
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       

 <table width="130%" border="1" align="center" cellpadding="0" cellspacing="0" >
 <?php
    $count=1;
    $pre='';
    foreach($retvalue as $data)
    {
	$count++;
	
    if($pre!=$data['fest_id'])
    {
    $pre=$data['fest_id'];
    $count=1;
	$first_mark=$data['total_point'];
    ?>
        <tr>
        <td width="23%" colspan="7" align="center" class="style9">&nbsp;&nbsp;&nbsp;<span class="style3"> &nbsp;&nbsp;<?php echo $data['fest_name'] ?> &nbsp;&nbsp;</span></td>
        
        </tr>
       <tr>
        <td colspan="7">
        </td>
        </tr>
  <tr>
    <td width="20" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Sl.No</td>
    <td width="50"align="center" class="style2" style="border-right:1px #666666; padding:2px;">Reg No</td>
    <td width="170"align="center" class="style2" style="border-right:1px #666666; padding:2px;">Participant name</td>
    <td width="50"align="center" class="style2" style="border-right:1px #666666; padding:2px;">Class</td>
    <td width="190" align="center" class="style2" style="border-right:1px #666666; padding:2px;">School</td>
    <td width="50" align="center" class="style2" style="border-right:1px #666666; padding:2px;">No of items</td>
     <td width="50" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Total Points</td>
     
  </tr>
  <?php 
  }
  if($data['total_point']==$first_mark)
  {
  ?>
    
  <tr>
    <td class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ><?php echo $count;?></td>
    <td  class="ety"align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;<?php echo $data['participant_id'];?></td>
    <td class="ety" align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;" >&nbsp;<?php echo $data['participant_name'];?></td>
  
    <td  class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $data['class']; ?></td>
    <td  class="ety" align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;<?php echo wordwrap($data['school_name'],30,"<br />"); ?></td>
    <td  class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $data['item_count']; ?></td>
    <td  class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $data['total_point']; ?></td>

  </tr>
  
<?php
}
        }
        ?>
        <tr>
        <td colspan="7">
        </td>
        </tr>
</table>

</page>
       
		