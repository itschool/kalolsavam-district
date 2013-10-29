<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
.style4{
	font-size: 8px;
	font-weight: normal;
	color:#000000;
	border: 0 0.5px 0.5px 0 #000000 ;
	 height:25px;
	}
.style9{
	font-size: 12px;
	font-weight: bold;
	
	
}
.style10{
	font-size: 15px;
	font-weight: bold;
	
	
}	
-->
</style>
         <?php 
			foreach($retvalue as $data)
			{
			?>
        
<page backtop="35mm" backbottom="35mm">
        <page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="800" border="0" align="center" bordercolor="#D4D0C8">

    <tr>
    	<td colspan="4" class="style10" align="center">Tabulation Sheet</td></tr>
    <tr>
        <td width=50 height="32" class="style9">Item  :</td>
        <td width=300 height="32" class="style9"><?php echo $data['item_code']; ?>   -   <?php echo $data['item_name']; ?> (<?php echo $data['fest_name']; ?>)</td>
        <td width=50 height="32" class="style9">Date  :</td>
        <td width=80 height="30" class="style9"><?php echo datetophpmodel($data['date(sim.start_time)']); ?></td>
    </tr>
    </table>
    
	</page_header>
    <page_footer>
	 <table width="100%" align="right">
        <tr>
        <td align="right">Name and Signature of Stage Manager _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ </td>
       </tr>
       </table>
       <p>&nbsp;</p>
       <table width="100%" align="center">
       <tr>
            <td>Signature of Judge1 _ _ _ _ _ _ _ _ _ _ _</td>
             <td>&nbsp;</td>
            <td>Judge2 _ _ _ _ _ _ _ _ _ _ _</td>
             <td>&nbsp;</td>
            <td>Judge3 _ _ _ _ _ _ _ _ _ _ _</td>
      </tr>
    </table>
    <table width="100%" border="0" align="left" bordercolor="#D4D0C8">
        <tr>     
            <td  align="center" style="font-size:12px;">70% and above = 'A' Grade,&nbsp;&nbsp;60% to 69%    = 'B' Grade,&nbsp;&nbsp;50% to 59%    = 'C' Grade, &nbsp;&nbsp;Below 50%    =  No Grade </td>
        </tr>
    </table>
	<?php
		$this->load->view('report/report_footer');
	?>
    
</page_footer> 

    
<table width="62%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
    <tr>
            <td colspan="3" class="style4"><div align="left"></div>              
            <div align="center"></div></td>
            <td colspan="6" class="style4" align="center"><strong>Score </strong></td>
           <td colspan="3" class="style4"><div align="center">&nbsp;</div></td>
          </tr>
    <tr>
        <td width=35 class="style4" align="center"><strong>Sl.No</strong></td>
        <td width=50 class="style4"align="center"><strong>Reg No  </strong></td>
        <td width=50 class="style4"align="center"><strong>Code.No</strong></td>
        <td width=35 class="style4" align="center">J1</td>
        <td width=35 class="style4"align="center">J2</td>
        <td width=35 class="style4"align="center">J3</td>
        <td width=35 class="style4"align="center">J4</td>
        <td width=35 class="style4"align="center">J5</td>
        
        <td width=35 class="style4"align="center"><strong>Total</strong></td>
        <td width=35 class="style4"align="center"><strong>Grade</strong></td>
        <td width=35 class="style4"align="center"><strong>Rank</strong></td>
        <td width=150 class="style4"align="center"><strong> Remarks</strong></td>
    </tr>
    <?php 
    
    for($i=1;$i<=$data['cnt']+5;$i++)
    {
    
    
    ?>
    <tr>
        <td class="style4" align="center"><?php echo $i;?></td>
        <td class="style4" align="center">&nbsp;</td>
        <td class="style4"align="center">&nbsp;</td>
        <td  class="style4"align="center">&nbsp;</td>
        <td class="style4"align="center">&nbsp;</td>
        <td class="style4"align="center">&nbsp;</td>
        <td class="style4"align="center">&nbsp;</td>
        <td class="style4"align="center">&nbsp;</td>
        <td class="style4"align="center">&nbsp;</td>
        <td class="style4"align="center">&nbsp;</td>
        <td class="style4"align="center">&nbsp;</td>
         <td class="style4"align="center">&nbsp;</td>
  </tr>  

<?php }
?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>


</page> 
          <?php
	  
		  }
		  
		  ?> 
          

		