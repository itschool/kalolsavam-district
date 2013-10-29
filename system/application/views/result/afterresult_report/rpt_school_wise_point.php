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
<table width="100%" border="0" align="center">
        <tr>
            <td  align="center" class="style1">Item Wise Point Report</td>
        </tr>
		 <?php
                $f=0;
                foreach($retvalue AS $data)
                if($f==0)
                { 
                $f=1;
                ?>
       <tr>
	 
     		<td  class="style2" align="center"><b>  <?php echo $data['school_code'];?>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $data['school_name'];?></b></td>
  		</tr>
	  	<?php
      	}
      	?>
</table>
<table width="93%" border="1" align="center" cellpadding="0" cellspacing="0">
    <?php
    $count=1;
    $total=0;
	$previous='';
	$j=0;
    foreach($retvalue AS $data)
    {
	if($previous!=$data['fest_name'])
	{
    $count=1;
	$previous=$data['fest_name'];
			
			 if($j!=0){
	 
	 ?>
	 <tr>
        
         <td align="center" style=' height:20px;'>&nbsp;</td>
        <td align="left" style='  height:20px;'>&nbsp;</td>
        <td colspan="2" align="right" style=' height:20px;'>Total Point :&nbsp;</td>
        <td align="center"  style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $total; ?></td>
    </tr>
		<?php 
            $total=0;
            }
        ?>
     <tr>
     <td width="43" colspan="7" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['fest_name'];?></td>
     </tr>
<tr>
      <td width="43" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Sl No</td>
      <td width="200" align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;Item</td>
      <td width="250" align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;Name </td>
     
      <td width="30" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>G      </td>
      <td width="30" align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>P      </td>
    </tr>
		   <?php 
           }
           $total=$total+$data['point'];
           $j++;
           ?>
    <tr>
        <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $count++; ?></td>
        <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;<?php echo $data['item_code'].' - '.$data['item_name'];?></td>
        <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;<?php echo $data['participant_name'];?></td>
        
        <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['grade'];?></td>
        <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['point'];?></td>
  </tr>
		<?php
            }
           ?>
            <tr>
        
         <td align="center" style=' height:20px;'>&nbsp;</td>
        <td align="left" style='  height:20px;'>&nbsp;</td>
        <td colspan="2" align="right"   style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Total Point :&nbsp;</td>
        <td align="center"><?php echo $total; ?></td>
    </tr>
</table>
</page>
