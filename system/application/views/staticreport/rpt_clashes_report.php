<?php

$resarr=array(); $prevdata="";
//$items="";
     for($j=0;$j<count($retdata);$j++)
   {
    if($prevdata!=$retdata[$j]['participant_id']) 
   {
   $prevdata=$retdata[$j]['participant_id'];
    $flag=0;
    for($k=$j+1;$k<count($retdata);$k++)
   {
  if(($retdata[$j]['participant_id'])==($retdata[$k]['participant_id']))
   {
   if((($retdata[$j]['end_time'])>($retdata[$k]['start_time']))&&($flag==0))
   {
  $flag=1;
 
 // $items=$items.'-'.$retdata[$k]['item_name'];
   $resarr[]=array("id"=>$retdata[$j]['participant_id'],"name"=>$retdata[$j]['participant_name'],"code"=>$retdata[$j]['school_code'],"sname"=>$retdata[$j]['school_name']);
   }
   }
   }
   }
   }
   
   
   ?>




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
    border: 0 1px 1px 0 #000000;
	font-size: 10px;
	font-weight: normal;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
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
        <td width='200' ><div align="center" class="style1">Clashes Report</div></td>
        </tr>
        </table>
        
<table width="85%" border="2" align="center" cellpadding="0" cellspacing="0">
  
  <tr> 
    <td width='30' class="style3"><strong>Sl.No</strong>.</div></td>
    <td width='50' class="style3" ><strong>Reg No</strong></div></td>
    <td width='175' class="style3"><strong>Name of Student </strong></div></td>
    <td width='50' class="style3"><div align="left"><strong>School Code</strong></div></td>
    <td width='200' class="style3"><div align="left"><strong>School </strong></div></td>
  </tr>
<?php 
  $count = 1;
  foreach($resarr as $data)
  { 
  
  	
						 
								?>                        
<tr> 
                                <td width='30' class="style3"> <?php echo $count++;?></td>
                                <td width='50' class="style3"><?php echo $data['id'];?></td>
                                <td width='175' class="style3"><?php echo $data['name'];?></td>
                                <td width='50' class="style3"><?php echo $data['code'];?></td>
                                <td width='200' class="style3"><?php echo $data['sname'];?><span class="style3"></span></td>
  </tr>
						   <?php
						   
   					}

?>


</table>

	    </page>
       
		
