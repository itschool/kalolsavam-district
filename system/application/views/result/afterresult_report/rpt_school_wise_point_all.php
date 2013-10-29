<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 12px;
	font-weight: bold;
	color: #660033;
}
.style3 {
	font-size: 12px;
	font-weight: 100;
	
}
</style>

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
<table width="750" height="62" border="0">
        <tr>
            <td width="750" align="center" class="style1">School Wise Point Report</td>
        </tr>
</table>
<table width="93%" border="1" align="center" cellpadding="0" cellspacing="0">
  <?php
		 
		 
   		  $total=0;
		  $prev_school_code="";
		  $prev_festid="";
		  $first=0;
		  
    foreach($retvalue AS $data)
    {
		if($prev_school_code!=$data['school_code']){
				 $count=0;
				$prev_school_code=$data['school_code'];
				$prev_festid="";
					if($first!=0){
			?>
  <tr>
    <td colspan="4" align="right" height="25" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Total Point:&nbsp; </td>
    <td  align="center" height="25" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $total; ?> </td>
  </tr>
  <?php
			}
			?>
  <tr>
    <td colspan="6" align="center" height="25"  class="style2" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['school_code'].' - '.$data['school_name']; ?> </td>
  </tr>
  <tr>
    <td width="40" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Sl No</td>
    <td width="175" align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;Item</td>
    <td width="210" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Name of Participant</td>
   
    <td width="50" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Grade</td>
    <td width="45" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Point</td>
  </tr>
  <?php
	}
		
		if($prev_festid!=$data['fest_id']){
		
			$prev_festid=$data['fest_id'];
			
				if($count!=0){
	?>
  <tr>
    <td width="40" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;</td>
    <td width="175" align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;</td>
    <td colspan="2" align="right" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Total&nbsp;:</td>
   
    <td width="45" align="center"  class="style3"style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $total; ?></td>
  </tr>
  <?php
	}
	?>
  <tr>
    <td colspan="6" align="center" height="25" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['fest_name']; ?> </td>
  </tr>
  <?php
			$total=0;
			}
			//echo $value['fest_id'];
		 $total=$total+$data['point'];
	 	$count++;
		$first++;
	?>
  <tr>
    <td align="center" class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $count; ?></td>
    <td align="left" class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;<?php echo $data['item_code'].' - '.$data['item_name'];?></td>
    <td align="left"  class="style3"style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;<?php echo $data['participant_name'];?></td>
   
    <td align="center"  class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['grade'];?></td>
    <td align="center" class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['point'];?></td>
  </tr>
  <?php 
        }
       ?>
  <tr>
    <td colspan="4" align="right" height="25" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Total Point :&nbsp; </td>
    <td  align="center" height="25"  class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $total; ?> </td>
  </tr>
</table>
</page>
