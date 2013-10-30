<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{ 
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.tb{
font-size: 11px;
	font-weight: bold;
	color:#000000;}
	
.ety{
	font-size: 12px;
	color:#000000;
	}

p.page1 { page-break-after:always}
-->
</style>
<br />
<br /><br />

<?php
	  $count=0;
	  $previous="";
	  $pre="";
	  $j=0;
	  $this->load->view('report/report_header');
	  //echo "<br /><br /><br />".var_dump($timewise['values']);  
  foreach($timewise['values'] AS $data)
  {
  	  // echo "<br /><br /><br />".$data['item_code'];
	  $item_code	=	$data['item_code'];
		$flag	=	0;
	    foreach($timewise['disc_code'] AS $no_data)
  		{
			$no_code	=	$no_data['item_code'];
			//echo "<br />itemcode_disc".$no_code;
			if($data['item_code']	==	$no_code)
			{
				$flag	=	1;
			
			}
		
		}
	  //echo "<br /><br /><br />flag-value-->".count($timewise['parti_det'][$item_code]);
	  if($flag !=1)
	  {
  		if($previous!=$data['item_code'] && count($timewise['parti_det'][$item_code]) > 0)
 		 {  
		    $sql=mysql_query("update result_master set is_printed=1 where item_code=".$data['item_code']);
			 $previous=$data['item_code'];
  			 $count=0;
			if($j!=0){
			
			print("</table>");
			 echo "<br /><br />";   
			
			}	
							
			/*if($j%8==0)		
			{  echo '<page_break></page_break>';   }	*/
	   
			
  ?>



		

<table width="100%" height="62" border="0" cellpadding="0" cellspacing="0" align="center">
  
  <tr>
    <td align="left"><b>Festival : <?php echo $data['fest_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;<?php echo $data['item_code'];?> ( <?php echo $data['item_name'];?>)</b></td>
     <td align="right"><b>&nbsp;&nbsp;&nbsp;&nbsp; Result No. <?php echo $data['result_no'];?></b></td>
  </tr>
</table>
   
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="43" align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>Sl No</td>
    <td width="250" align="left" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;Name </td>
    <td width="250" align="left" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;School </td>
    <td width="40" align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;Rank</td>
    <td width="40" align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;Grade</td>
     <td width="40" align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;Point</td>
  </tr>
    <?php
	}
		     //$count=0;
			// $pre=$data['item_code'];
			
   	
	$j++;
	
	foreach($timewise['parti_det'][$item_code] AS $parti_data)
  		{
			
			//$no_code	=	$no_data['item_code'];
			if($parti_data['rank'] !=0){
			$count++;
	
	?>
  <tr>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $count; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;<?php echo wordwrap($parti_data['participant_name'],50,'<br>'); ?></td>
       <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;<?php echo wordwrap($parti_data['school_code'].' - '.$parti_data['school_name'],50,'<br>'); ?></td>
       <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $parti_data['rank']; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $parti_data['grade']; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $parti_data['point']; ?></td>
  </tr>
  
  <?php
         }
       }// for each
	   
	   foreach($timewise['parti_det'][$item_code] AS $parti_data)
  		{
			
			//$no_code	=	$no_data['item_code'];
			if($parti_data['rank'] ==0){
			$count++;
	
	?>
  <tr>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $count; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;<?php echo wordwrap($parti_data['participant_name'],50,'<br>'); ?></td>
       <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;<?php echo wordwrap($parti_data['school_code'].' - '.$parti_data['school_name'],50,'<br>'); ?></td>
       <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $parti_data['rank']; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $parti_data['grade']; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $parti_data['point']; ?></td>
  </tr>
  
  <?php
         }
       }// for each
	   
    } // end if($flag !=1)
	else
	{
		//echo "<br /><br /><br />item code not in list---->".$data['item_code'];
	
	}
  }
  
  ?>
</table>

<page_footer>
         
	     <?php
		      $this->load->view('report/report_footer');
	     ?>
    </page_footer>   