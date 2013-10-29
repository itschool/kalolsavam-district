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
				<td style="text-align: center;width: 100%">				</td>
			</tr>
		</table>
</page_footer>       
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td><div align="center" class="style1"> Time Sheet</div></td>
        </tr>
        </table>
        <table>
        <tr>
        <?php 
        foreach($festname as $fest)
       {?>
        <td width="150"><div align="left"><strong>Festival</strong></div></td>
        <td width="10"><div align="left"><strong>:</strong></div></td>
        <td width="350"><div align="left"><strong><?php echo $fest['fest_name']?></strong></div></td>
        <?php } ?>
        </tr>
        </table>
        <table width="100%" border="1" cellpadding="5" cellspacing="0">

         <?php 
  foreach($itemtime as $item)
  {
  ?>
         <tr>
           <td><strong>Stage Number </strong></td>
           <td><strong>:</strong></td>
           <td><strong><?php echo $item['stage_name']?></strong></td>
           <td><strong>&nbsp;Item Name</strong></td>
           <td><strong> :</strong></td>
           <td><strong><?php echo $item['Item']?></strong></td>
         </tr>
         <tr>
    <td width="104"><strong>Item Code </strong></td>
    <td width="6"><strong>:</strong></td>
    <td width="210"><strong><?php echo $item['ItemCode']?></strong></td>
     <td width="144"><strong>Max. Time</strong></td>    
    <td width="9"><strong> : </strong></td>
    <td width="196">&nbsp;<strong><?php echo $item['MaxTime']?></strong></td>
    </tr>
    <?php }?>
</table>
      
  <table width="100%" border="1" cellpadding="5" cellspacing="0">
  <tr> 
    <td width="50" style="border: 0 1px 1px 0 #000000;">Sl.No.</td>
    <td width="100" style="border: 0 1px 1px 0 #000000;">Code Number</td>
    <td width="150" style="border: 0 1px 1px 0 #000000;">Start Time</td>
    <td width="150" style="border: 0 1px 1px 0 #000000;">End Time</td>
    <td width="250" style="border: 0 1px 1px 0 #000000;">Remarks</td>
  </tr>
  <?php 
  
  for($i=1;$i<=30;$i++)
  {
  echo "<tr> ";
  echo "<td width='50' style='border: 0 1px 1px 0 #000000; height:20px;'>&nbsp;&nbsp;".$i."</td>";
  echo "<td width='100' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;</td>";
  echo "<td width='150'style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;</td>";
  echo "<td width='150' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;</td>";
  echo "<td width='250' style='border: 0 1px 1px 0 #000000;  height:20px;'>&nbsp;</td>";
  echo "</tr>";
  }
   ?>
</table>
</page> 