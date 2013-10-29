 	
    
    <style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size:12px;
	font-weight:bold;
	color:#000000;
}
.style3 {
	font-size:11px;
	font-weight:bold;
	color:#000000;
}
.style4 {
	font-size:12px;
	color:#000000;
}
-->
</style>
	<?php
	  
	  $previd="";$j=0;
	  
  	foreach($retvalue AS $data)
    {
		if($previd!=$data['fest_id']){
				
				$previd_temp=$previd;
				$previd=$data['fest_id'];
				$count=0;
				
				if($j!=0){
			   $ct=0;
			   for($j=0;$j<count($itemcomp);$j++)
			   {
			   		if($itemcomp[$j]['fest_id']==$previd_temp)
					{
					$ct++;
			   ?>
          <!-- 	<tr><td style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php //echo $ct; ?> </td><td style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php //echo $itemcomp[$j]['item_name']; ?></td></tr>-->
                <?php
					}
				}
					print("</table></page>");
					}
  ?>

<page backtop="20mm" backbottom="20mm">
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
<table width="94%" height="62" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" height="30" valign="top"><strong class="style1">Grade-Point Report of all schools</strong></td>
  </tr>
</table>
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
		<?php
		$pre='';
        for($i=0;$i<count($completed);$i++)
        {
         if ($completed[$i]['fest_id']==$previd)
           {
              for($k=0;$k<count($totalitems);$k++)
                { 
                   if ($totalitems[$k]['fest_id']==$previd)
                     {
					  if($pre!=$data['fest_id'])
	                       {
	                         $pre=$data['fest_id'];
                   
        ?>
<tr>

    <td colspan=6 align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['fest_name'];; ?></td>
  </tr>
    <tr>
     <td colspan=6 align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'   >Result Declared <?php echo $completed[$i]['cn'] ."/" . $totalitems[$k]['c']; ?> Items</td>
    </tr>
  <tr>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'width="50" rowspan="2" align="center" >Sl No</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'width="450" rowspan="2" align="left" >&nbsp;&nbsp;School</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'colspan="3" align="center" >Grade</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'width="50" rowspan="2" align="center">Point</td>
  </tr>
  <tr>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'width="30" align="center" >A</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'width="30" align="center">B</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'width="30" align="center" >C</td>
  </tr>
  
 
  
    <?php
	}
	}
	}
	}
	}
	}
	
	$count++;
	$j++;
	?>
  <tr>
    <td  class="style4" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'align="center" ><?php echo $count; ?></td>
    <td class="style4" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'align="left" >&nbsp;&nbsp;<?php echo $data['school_code'].' - '.$data['school_name']; ?></td>
    	<?php
		
		$agrade=0;
		$bgrade=0;
		$cgrade=0;
		for($h=0;$h<count($grade);$h++){
			if(($grade[$h]['school_code']==$data['school_code'])&&($grade[$h]['fest_id']==$data['fest_id'])){
					
					switch($grade[$h]['grade'])
					{
						case 'A':
						$agrade=$grade[$h]['grd'];
						break;
						
						case 'B':
						$bgrade=$grade[$h]['grd'];
						break;
						
						case 'C':
						$cgrade=$grade[$h]['grd'];
						break;
						
						default:
						$agrade=0;
						$bgrade=0;
						$cgrade=0;
						break;
						
					
					
					//if($grade[$h]['grade']=='A')
					//$agrade=$grade[$h]['grd'];
					// if($grade[$h]['grade']=='B')
					//$bgrade=$grade[$h]['grd']; 
					// if($grade[$h]['grade']=='C')
					//$cgrade=$grade[$h]['grd']; 
					}
				}
			}
		?>
    
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'align="center" ><?php echo $agrade; ?></td>
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'align="center" ><?php echo $bgrade; ?></td>
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'align="center" ><?php echo $cgrade; ?></td>
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'align="center" ><?php echo $data['cnt']; ?></td>
  </tr>
  <?php
  		$agrade=0;
		$bgrade=0;
		$cgrade=0;
   }
  
   
  ?>
</table>
</page>
