<page backtop="20mm" backbottom="20mm ">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
	  </page_header>
    <page_footer>
	
	<table>
    <tr>
    <td><h5>To avoid clash,make the necessary changes in stage allotement</h5></td>
    </tr>
    </table>
    <?php
		$this->load->view('report/report_footer');
	?>
    
    </page_footer>   
<?php
$resarr=array(); $prevdata="";
$items="";
   $i=0;
  
      for($x=0;$x<count($retdata);$x++)
	  {
		//if($prevdata!=$retdata[$x]['participant_id'])
		//{
			//$prevdata=$retdata[$x]['participant_id'];
			$flag=0;
			$item[$x]=wordwrap($retdata[$x]['item_code'].' - '.$retdata[$x]['item_name'],20,'<br>').' ('.$retdata[$x]['stimer'].')<br>';
			//$time[$x]=$retdata[$x]['stimer'];
			for($k=$x+1;$k<count($retdata);$k++)
			{
				if(($retdata[$x]['participant_id'])==($retdata[$k]['participant_id']))
				{
				if((($retdata[$x]['end_time'])>($retdata[$k]['start_time']))&&($flag==0))
				{
				 
					//$flag=1;
					$item[$x]=$item[$x]. ''.wordwrap($retdata[$k]['item_code'].' - '.$retdata[$k]['item_name'],20,'<br>').' ('.$retdata[$k]['stimer'].')<br>';
					//$time[$x]=$time[$x].'' .$retdata[$k]['stimer'];
					$resarr[$x]=array("id"=>$retdata[$x]['participant_id'],"name"=>$retdata[$x]['participant_name'],"item"=>$item[$x],
					"code"=>$retdata[$x]['school_code'],"sname"=>$retdata[$x]['school_name']);
					   $i++;
					   
					}
				}
			}
   		}
   
   ?>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
.style10{
	font-size: 15px;
	font-weight: bold;

}
.style2 {color: #D4D0C8}
-->
</style>
        <table width="95%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
        <td width='200' colspan="2" align="center" class="style10"> Clashes Report</td>
        </tr>
        <tr>
        <td width='200' align="center">  Clashes Report on <?php echo date('d M Y',strtotime($date));?></td>
        <td width='200' align="center">  All Festivals</td> 
        </tr>
        </table>
        
<table width="100%" border="0" align="center"  cellpadding="0" cellspacing="0">
  
  <tr> 
    <td width='30' align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Sl.No</td>
    <td width='50' align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Reg No</td>
    <td width='175' align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;&nbsp;Name of Student</td>
    
    <td width='120' align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>School</td>
     <td width='175' align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>Clash Items</td>
   
    
  </tr>
<?php 
  $count = 1;
  $participant1=0;
  $partcipant2=0;
  $starting=0;
  $endtime=0;
  $startdate[0]=0;
  $enddate[0]=0;
  
  
  foreach($resarr as $data)
  { 
  
  	
						 
								?>                        
<tr> 
                                <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'> <?php echo $count++;?></td>
                                <td align="center" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo $data['id'];?></td>
                                <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'>&nbsp;&nbsp;<?php $name=$data['name'];$name2=wordwrap($name,30,"<br/>"); echo $name2;?></td>
                               
                                <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo wordwrap($data['code'].' - '.$data['sname'],20,'<br>');?></td>
                                 <td align="left" style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php echo wordwrap($data['item'],30,'<br>'); ?></td>
                                
                                
  </tr>
						   <?php
						   //$count++;
   					}

?>


</table>

	    </page>
