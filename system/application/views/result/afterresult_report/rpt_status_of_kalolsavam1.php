<page backtop="20mm" backbottom="20mm ">
		<page_header>
    	<?php
			  $this->load->view('report/report_header');
		 ?>
	    </page_header>
         <page_footer>
	     <?php
		      $this->load->view('report/report_footer');
	     ?>
    </page_footer>  
<table width="100%" height="62" border="0" align="center">
  <tr>
    <td align="center"><h4 align="center">Status Of Kalolsavam</h4></td>
  </tr>
</table>

		<?php
		if(count($retvalue)>0){
		?>

<table width="559" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
     <?php
		if($ddt!='All'){
		?>
                <td  colspan="2" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center" >
                Completed Items on <?php echo datetophpmodel($ddt); ?>&nbsp;</td>
     <?php
	}
	else
	{
	?>
				 <td  colspan="2" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center" >
			Completed Items &nbsp;</td>
  <?php
	}
	?>
  </tr>
  <tr>
  <td width="47" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><strong>Sl No</strong></td>
    <td width="512" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><strong>Items </strong></td>
  </tr>
  <?php
  $count=0;
  $prevdata="";
  foreach($retvalue AS $data)
  {
  		if($prevdata!=$data['fest_id']){
		$count=0;
		$prevdata=$data['fest_id'];
		?>
        <tr><td align="center" colspan="2" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['fest_name']; ?></td></tr>
        
        
        <?php
		}
 		 $count++;
  ?>
  <tr>
    <td style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><?php echo $count; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;<?php echo $data['item_code'].' - '.$data['item_name']; ?></td>
  </tr>
  <?php
  }
  ?>
</table>

	<?php
	}
	else
	{
	?>
    <div align="center">Festival is started, Status will be available after some time</div>
    
    <?php
	}
	?>
    </page>
    <page backtop="20mm" backbottom="20mm ">
		<page_header>
    	<?php
			  $this->load->view('report/report_header');
		 ?>
	    </page_header>
         <page_footer>
	     <?php
		      $this->load->view('report/report_footer');
	     ?>
    </page_footer> 
    <?php
	if(count($retvalue1)>0){
	
	?>
<p>&nbsp;</p>
<table width="556" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td  colspan="2" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center" >
    Items Remaining to be Conducted &nbsp;</td>
  </tr>
  <tr>
  <td width="48" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><strong>Sl No</strong></td>
    <td width="508" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><strong>Items </strong></td>
  </tr>
  <?php
  $count1=0;
  $prevdata="";
  foreach($retvalue1 AS $data1)
  {
  
  		
		if($prevdata!=$data1['fest_id']){
		 $count1=0;
		 $prevdata=$data1['fest_id'];
		?>
        <tr><td align="center" colspan="2" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data1['fest_name']; ?></td></tr>
        
        
        <?php
		}
  $count1++;
  ?>
  <tr>
   <td style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><?php echo $count1; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;<?php echo $data1['item_code'].' - '.$data1['item_name']; ?></td>
  </tr>
  <?php
  }
  ?>
</table>

		<?php
            }
			else{
        ?>
        <div align="center">All Items are finished</div>
        
        
        <?php } ?>
        </page>
        
