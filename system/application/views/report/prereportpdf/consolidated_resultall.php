<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
</style>
<page backtop="30mm" backbottom="20mm" >
		<page_header >
    	<?php
			  $this->load->view('report/report_header'); 
			  ?>
		<table width="100%" height="62" border="0" align="center">
        <tr>
            <td  align="center" class="style1" height="30" valign="top">Consolidated Report for Higher Level Competition </td>
        </tr>
       </table>
	    </page_header >
         <page_footer>
	     <?php
		      $this->load->view('report/report_footer');
	     ?>
        </page_footer>  

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
       <tr>
       <td width="250" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>School </td>
      <td width="100" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Fest Name </td>
      <td width="70" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>No Of Boys</td>
      <td width="70" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>No Of Girls</td>
      <td width="70" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>No Of Participants</td>
       </tr>
         
    <?php
	$pre='';
	$boys=0;
	$girls=0;
	foreach($retvalue AS $data)
	{
	for($i=0;$i<count($retdata);$i++)
	{
	  if(($retdata[$i]['school_code']==$data['school_code']) && ($retdata[$i]['fest_id']==$data['fest_id']))
	  {
	     $boys=$retdata[$i]['cnt_boys'];
		 $girls=$data['cnt'] - $boys;
	  } 
	  if($boys==0)
	     $girls=$data['cnt'];
	}
	
	?>
  
    <tr>
    <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>   <?php
	if($pre!=$data['school_code'])
	{
	  echo $data['school_code'] . ' - '. $data['school_name']; 
	  }?></td>
        <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['fest_name'];?></td>
         <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $boys;?></td>
         <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $girls;?></td>
        <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['cnt'];?></td>
  </tr>
	  <?php 
	  $pre=$data['school_code'];
	  $boys=0;
	  $girls=0;
       }
       ?>
     
</table>
<table>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>
</tr>
</table>

<table width="70%" border="1" align="center" cellpadding="0" cellspacing="0">
       <tr>
        <td width="350" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Total No Of Boys</td>
        <td width="70" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php  echo $retboys_total[0]['counter_boys_total'];?></td>
        </tr>
        <tr>
        <td width="350" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Total No Of Girls</td>
        <td width="70" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php  echo $retgirls_total[0]['counter_girls_total'];?></td>
        </tr>
        <tr>
        <td width="350" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Total No Of Participants</td>
        <td width="70" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php  echo $retval[0]['counter_total'];?></td>
        </tr>
        
   
  </table> 
</page>