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


-->
</style>
<style>
@media print
{
h1 {page-break-before:always}
}
</style>
	
	
		<?php
		
				$prevrankcode="";
				$previtem_code="";
				$j=0;
				$h=1;
			foreach($rankwise as $value){
				if($value['is_publish']!='N'){
				
				
					if($prevrankcode!=$value['fest_id']){
						$count=0;
						$prevrankcode=$value['fest_id'];
						
							if($j!=0){
							print("</table></page>");
							}
		?>
<page backtop="20mm" backbottom="20mm " >
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
     <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
      <tr> <td  align="left" width="80" height="20" valign="top"><?php echo $h++; ?></td></tr>
      </table>
</page_footer>       

   
<table width="77%" border="0" cellspacing="0" cellpadding="0" align="center" >
	<tr>
        <td height="30" align="center" class="style1">Rank  Wise Participants Details&nbsp;
		<?php echo $value['fest_name']; ?> </td>
  </tr>
</table>
       
	 <table width="93%" align="center" border="1" cellpadding="0" cellspacing="0" >
        <?php
		if($rank!='ALL'){
				
				switch($rank)
				{
					case 1:
						$r_rank='First Rank';
						break;
					case 2:
						$r_rank='Second Rank';
						break;
					case 3:
						$r_rank='Third Rank';
						break;
					default:
						$r_rank='';
						break;
				}
				
		?>
        <tr>
         <td colspan="7" align="center" class="style1" height="24" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">List of&nbsp;<?php echo $r_rank; ?> holders</td>
       </tr>
       <? } ?>
        
    		 <tr>
            <td width=41  align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"> &nbsp;Sl.No&nbsp;</td>
            <?php
			 if($rank!='ALL'){
			 ?>
            <td width="164"  align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">item</td>
              <?php
			  }
			 if($rank=='ALL'){
			 ?>
             <td width="42" align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Rank</td>
             <?php  } ?>
      
            <td width=170  align="left" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;Name</td>
             
            <td width=250  align="left" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;School </td>
            
            
            
            <td width="36" height="25" align="center" class="style3" style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;">Grade</td>
             <td width="34" height="25" align="center" class="style3" style=" border-bottom:1px #000000; border-right:0px #000000; padding:2px;">Point</td>
      		<td></td>
       </tr>
		<? 
		}
		 if($rank=='ALL'){
			if($previtem_code!=$value['item_code'])
			{
			$previtem_code=$value['item_code'];
			
			?>
            <tr><td align="left" colspan="7" style=" border-bottom:1px #000000; border-right:0px #000000; padding:2px;">
			<?php echo $value['item_code'].'-'.$value['item_name']; ?> </td></tr>
            
            <?php
			}
			}
        
		$count++;
		$j++;
        ?>
            <tr>
            <td width="41" height="22" align="center" class="style3" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $count; ?></td>
            <?php
			 if($rank!='ALL'){
			 ?>
           <td width="164" class="style3" align="left" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo $value['item_code'].' - '.$value['item_name']; ?></td>
           
            <?php
			}
			 if($rank=='ALL'){
			 ?>
             <td width="42" class="style3" align="center"  style=" border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $value['rank']; ?></td>
             <?php  } ?>
            <td width="150" class="style3" align="left" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;<?php echo wordwrap($value['participant_name'],25,'<br>'); ?></td>
            <td width="208" class="style3" align="left" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($value['school_code'].' - '.$value['school_name'].' ( '.$value['sub_district_code'].'-'.$value['sub_district_name'],50,'<br>');   ?> )</td>
             
        
           <td width="36" class="style3" align="center" style="border-bottom:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $value['grade']; ?></td>
            <td width="34" class="style3" align="center" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $value['point']; ?></td>
       		 
       </tr>
		 <? 
       		 } 
		 }
        ?>
</table>
  </page>
