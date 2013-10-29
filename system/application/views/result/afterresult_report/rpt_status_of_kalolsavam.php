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
    <td align="center" ><strong>Status Of Kalolsavam</strong></td>
  </tr>
</table>

		<?php
		if(count($retvalue)>0){
		?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
 <?php
 $f=0;
  foreach($retvalue1 AS $data1)
  if($f==0)
  {
   $f=1;
  ?>
  <tr>
  <?php
  if($ddt!='All')
  {
  ?>
            <td align="center" >
            
           <strong><?php echo $data1['fest_name']; ?> on Date <?php echo datetophpmodel($ddt); ?></strong></td>
   <?php
   }else
   {
   ?>
        <td align="center" >
        
       <strong><?php echo $data1['fest_name']; ?> </strong></td>
   <?php 
   }
   ?>
  </tr>
  <?php } ?>
</table>
<table width="581" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td width="70" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><strong>Sl No</strong></td>
    <td width="511" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><strong>Items completed</strong></td>
  </tr>
  <?php
  $count=0;
  foreach($retvalue AS $data)
  {
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
		else{
		?>
       <table align="center" width="100%"><tr><td align="center" height="50" valign="bottom"> Festival is started, Completed Items Status will be available after some time
       </td></tr></table>
        
        
        <?php } ?>
<p>&nbsp;</p>
			<?php
		if(count($retvalue1)>0){
		?>

<table width="571" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td width="61" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><strong>Sl No</strong></td>
    <td width="510" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;' align="center"><strong>Items Remaining to be Conducted</strong></td>
  </tr>
  <?php
  $count1=0;
  foreach($retvalue1 AS $data1)
  {
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
		else if((count($retvalue))!=0){
		?>
        <table align="center" width="100%"><tr><td align="center" height="50" valign="bottom"> All Items are finished
       </td></tr></table>
        
        <?php
		}
		?>
</page>