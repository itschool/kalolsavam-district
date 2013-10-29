<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.tb{
font-size: 11px;
	font-weight: bold;
	color:#000000;}
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
<page backtop="30mm" backbottom="20mm ">
	<page_header>
    	<?php
		    //echo "<br /><br />";
			//var_dump($partdata);
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            <tr>
                <td colspan="2" class="style1" align="center">Participants in Group Items </td>
            </tr>
             <tr>
        <td class="tb" align="left">Item  :&nbsp;&nbsp;
        <?php echo $partdata[0]['item_code'];?>&nbsp;-&nbsp;<?php echo $partdata[0]['item_name'];?>&nbsp;&nbsp;</td>
        <td class="tb" align="left">&nbsp;&nbsp;Festival :<?php echo $partdata[0]['fest_name'];?></td>
  </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer> 

        

    <?php
	$team_no=0;
    $count=0;
	$previous="";
	$pre_cap="";
	$j=0;
   
    foreach($partdata as $data)
    {	
		 
	  if($previous!=$data['school_code'] || $pre_cap!=$data['parent_admn_no'])
 	  {
	  		 $pre_cap	=	$data['parent_admn_no'];
			 $previous  =	$data['school_code'];
  			 $count		=	0;
			 if($j!=0)
			 {
			    print("</table><br />");			
			 }
            $team_no++;
		//$school	=	;?>
		
         <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            <tr>
            <td class="tb" align="left" >Team No : <strong><? echo $team_no; ?></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School  :&nbsp;&nbsp;
            <?php echo $data['school_code'];?>&nbsp;-&nbsp;<?php echo $data['school_name'];?>&nbsp;&nbsp;</td>
            
            </tr>
                    
        </table>
        
		<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
   
     
    <tr>
        <td class="tb" width='40' align="center" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">Sl.No.</td>
        <td  class="tb" width='60' align="center" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">Reg No.</td>
        <td class="tb" width='230' align="left" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;Name </td>
        
      <td class="tb" width='30' align="center" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">B/G</td>
        <td class="tb"  width='40' align="center" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">Class</td>
       
  </tr>	
	<?php
	}
		     //$count=0;
			// $pre=$data['item_code'];
   	$count++;
	$j++;
	?>	
    
    <tr>
        <td class="ety"  align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $count;?></td>
        <td  class="ety"  align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $data['participant_id'];?></td>
        <td class="ety"  align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($data['participant_name'],34,'<br>'); if($data['is_captain'] == 'Y'){ echo " (Captain)";}?></td>
      <td class="ety"  align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $data['gender'];?></td>                  
        <td  class="ety" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $data['class'];?></td>
        
  </tr>
    <?php 
    }
    ?>
</table>
</page>
		