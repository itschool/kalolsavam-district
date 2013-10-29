<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}

-->
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
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
             
        <tr>
        <td> 
          <div align="center" class="style1">List of items</div>
        </td>
        </tr>
        </table>
 
        <p>&nbsp; </p>
        <table width="64%" border="1" align="center" cellpadding="0" cellspacing="0">

<p>&nbsp;</p>

   <?php 
    $flag=0;
    $count=0;  
  $check2='';
     foreach($festdata as  $data)
  {   
     $check=$data['fest_name'];
     
      
      if($check!=$check2)
	  
	  	{  
		$flag=1;
		
	    $count=0;

	  ?>
   
   
  <tr>
    <td height="33" bordercolor="#FFFFFF"><strong>Festival:</strong></td>
    <td colspan="2" bordercolor="#FFFFFF"><?php echo $data['fest_name'];?></td>
  </tr>
  <tr> 
    <td width=103 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center"><strong>Sl.No</strong></div></td>
    <td  align="center" width=162 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center"><strong>Item code</strong></div></td>
    <td width=351 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center"><strong>Item Name</strong></div></td>
  </tr>  
 <?php
       
       
     }
	 $count++;
	 ?>
  
  <tr> 
     <td width=103 height="22" style='border:0 1px 1px 0 #000000 ; height:20 px;'><?php echo $count;?></td>
    <td width=162 align="center" style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center"><?php echo $data['item_code'];?></div></td>
     <td width=351 style='border:0 1px 1px 0 #000000 ; height:20 px;'><?php echo $data['item_name'];?></td>
      
  </tr>
 
  
  <?php 
   
    $check2=$data['fest_name'];
	
	if($flag==1){
  
         }
	
  } 
 ?>
  
</table>

	    </page>
    	