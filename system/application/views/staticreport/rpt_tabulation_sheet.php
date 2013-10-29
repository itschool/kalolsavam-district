<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
-->
</style>
<page backtop="10mm" backbottom="10mm ">
	<page_header>
		<table style="width: 100%;">
			<tr>
				<td style="text-align: right;width: 100%"></td>
			</tr>
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
		</table>
	</page_header>
<page_footer>
<table style="width: 100%;">
<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%"></td>
			</tr>
		</table>
</page_footer>       
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
          <td height="37" align="center" class="style1">Tabulation Sheet</td>
        </tr>
        </table>
        <table width="69%" border="0" align="center" bordercolor="#D4D0C8">
          
          <?php
	
		  foreach($retdata as $data)
		  {
		  
		  
		  ?>
          <tr>
           <td width=35 height="32" style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="left">Item Code</div></td>
            <td width=50 height="32" style='border:0 1px 1px 0 #000000 ; height:20 px;'><?php echo $data['item_code']; ?></td>
            
            <td width=50 height="32" style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="left">Item Name</div></td>
            <td width=200 height="32" style='border:0 1px 1px 0 #000000 ; height:20 px;'><?php echo $data['item_name']; ?></td>
            <td width=60 height="32" style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="left">Festival</div></td><?php } 
						foreach($retdata1 as $datum)
			{
			?>
            <td width=150 height="32" style='border:0 1px 1px 0 #000000 ; height:20 px;'><?php echo $datum['fest_name']; ?></td>
          </tr>
		  <?php 
		  }
		  ?>
        </table>
          
        <table width="62%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
          <tr>
            <td colspan="2" style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="left"></div>              
            <div align="center"></div></td>
            <td colspan="6" align="center"><strong>Score </strong></td>
           <td colspan="3" style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center">&nbsp;</div></td>
          </tr>
          <tr>
            <td width=35 height="25" style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center"><strong>Sl.No</strong></div></td>
            <td width=61 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center"><strong>Code.No  </strong></div></td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center">J1</div></td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center">J2</div></td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center">J3</div></td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center">J4</div></td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center">J5</div></td>
          
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:20 px;'><strong>Total</strong></td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:20 px;'><strong>%</strong></td>
            <td width=40 style='border:0 1px 1px 0 #000000 ; height:20 px;'><strong>Grade</strong></td>
            <td width=150 style='border:0 1px 1px 0 #000000 ; height:20 px;'><div align="center"><strong> Remarks</strong></div></td>
          </tr>
          <?php 
     $count=0;
      for($i=0;$i<30;$i++)
       {
	   
         $count++;
       ?>
          <tr>
            <td width=35 height="85" style='border:0 1px 1px 0 #000000 ; height:30 px;'><?php echo $count;?></td>
            <td width=61 style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=35  style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=35  style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=35  style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=35 style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=40 style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=150 style='border:0 1px 1px 0 #000000 ; height:30 px;'>&nbsp;</td>
          </tr>
          <?php }  ?>
        </table>
        </page>
		