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
        <table width="95%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td><div align="center" class="style1">List of Participants with More 
        Number of Items</div></td>
        </tr>
        </table>
        
<table width="58%" border="2" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="4%"><div align="left"><strong>Sl.No</strong>.</div></td>
    <td width="9%"><div align="left"><strong>Reg. No </strong></div></td>
    <td width="32%"><div align="left"><strong>Name of Student </strong></div></td>
    <td width="10%"><div align="left"><strong>School Code</strong></div></td>
    <td width="45%"><div align="left"><strong>School</strong></div></td>
  </tr>
  <?php 
  $count = 0;
  foreach($retdata as $data)
  {
  $count++;
  ?>
  <tr> 
    <td><?php echo $count;?></td>
    <td><?php echo $data['participant_id'];?></td>
    <td><?php echo $data['participant_name'];?></td>
    <td><?php echo $data['school_code'];?></td>
    <td><?php echo $data['school_name'];?></td>
  </tr>
<?php 
}
?>
</table>

	    </page>
       
		