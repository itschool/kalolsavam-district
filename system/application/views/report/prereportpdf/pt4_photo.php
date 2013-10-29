<style type="text/css">
<!--
.style1 {
	font-size: 20px;
	font-weight: bold;
	color: #660033;
}
.style56 {
	font-size: 12px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 13px;
	font-weight: bold;
	color: black;
}
.stylehy{
	font-size: 11px;
	font-weight: bold;
	color: black;
}
.style9{
	font-size: 11px;
	color: black;
	border-bottom:1px #000000; border-right:0px #000000; padding:1px;
}
.style55 {

font-size: 11px;
	color: black;
}
.style23{
		font-size: 11px;
		color: black;
}
.style3 {
	font-size: 15px;
	font-weight: bold;
	color:black;
}
.style4 {
	font-size: 11px;
	font-weight: bold;
	color:black;
}
-->
</style>
<?php

if ($this->session->userdata('SUB_DISTRICT'))
{
	/*$sub_dist_name		=	get_sub_dist_name($this->session->userdata('SUB_DISTRICT'));
	$label				=	$sub_dist_name;*/
	$title		=	wordwrap(get_sub_dist_name($this->session->userdata('SUB_DISTRICT')).' Sub District',40,'<br/>');
}
else if ($this->session->userdata('DISTRICT'))
{
	$title			=	wordwrap(get_dist_name($this->session->userdata('DISTRICT')).'  District',40,'<br/>');
}
$fest_master_details	=	$this->General_Model->get_fest_master_details();
if (count($fest_master_details) > 0)
{
	//$title		=	(@$fest_master_details[0]['sub_dist_kalolsavam_name']) ? @$fest_master_details[0]['sub_dist_kalolsavam_name'] : '';
	//$title		=	wordwrap(get_sub_dist_name($this->session->userdata('SUB_DISTRICT')).' Sub District',40,'<br/>');
	$venue		=	wordwrap(@$fest_master_details[0]['venue'],40,'<br/>');
	$logo		=	@$fest_master_details[0]['logo_name'];
	$file_path	=	'';
	if (file_exists($this->config->item('base_path').'uploads/district/'.$logo) and trim($logo) != '')
	{
		$file_path		=	base_url(false).'uploads/district/thumb_'.$logo;
	}
	else {
	
		$file_path="";
	}
}
					
?>

<page backtop="0mm" backbottom="0mm" >
<table align="left" border="0">
<?php
for($i = 0; $i < count($participant_details); ){

?>
	<tr>
    	<td width="366" height="515" valign="top">
        	<?php if (@$participant_details[$i]['participant_id']){
			
			$reg	=	@$participant_details[$i]['admn_no'];
			?>
        <table border="1" width="366" >
           	  <tr>
                <?php
              	  if($file_path!=""){
				  ?>
                 <td rowspan="2"> <img src="<?php echo $file_path?>" height="40"  /></td>
                 <?php } 
				 else {?>
                  <td width="74" rowspan="2">&nbsp; </td>
            <?php } ?>
                  <td width="243"  class="style56" align="right">Kerala School Kalolsavam 2012 - 2013</td>
              </tr>
                <tr>
                   
                    <td align="right" class="stylehy"><?php echo $title.'<br> '.$venue; ?><br></td>
                </tr>
            
                <tr bgcolor="#CCCCCC">
                    <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participant's Card</td>
                </tr>
                <tr>
                    <td align="center">Reg. No</td> 
                    <td rowspan="2" style="border-bottom:1px #000000; border-left:1px #000000; padding:1px;">
                    <table>
                	<tr>
                	<td>  
                    
                    <span class="style2">&nbsp;<?php echo wordwrap($participant_details[$i]['participant_name'],30,'<br/>'); ?></span><br>
                        &nbsp;<?php  echo wordwrap($participant_details[$i]['school_code'].'  '.@$participant_details[$i]['school_name'],30,'<br/>'); ?><br>
                        &nbsp;<?php echo 'Class  :'.$participant_details[$i]['class']."<br>&nbsp;".$participant_details[$i]['sub_district_name']." - Sub-District"; ?>
                    </td>
                    
                    <td align="left">&nbsp;&nbsp;
                 <?
				   //echo "<br /><br />-->".var_dump($Photo['pic'][$reg]);
                    if(@$Photo['pic'][$reg])
					{
					   @$pic_path	=	@$Photo['pic'][$reg];
					   echo "<img src='".@$pic_path."'width='80' height='80'>";				 
					}
					else
					{
						//$document_root 	=	image_url(false)."photos";
						@$pic_path	=	image_url()."/img_user_nophoto.jpg";
					    echo "<img src='".@$pic_path."'width='80' height='80'>";								
					}
					?>
                 
                 </td>
                 </tr>
                 </table>
                 </td>
              </tr>
                <tr>
                    <td  width="51"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:1px;" align="center"><?php echo $participant_details[$i]['participant_id']; ?></td>
     
              </tr>
                <?php
					$item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id']);
					$cnt=count($item_details);
					$l=1;
					foreach($item_details as $item)
					{
						if($l==$cnt)
							$style="style23";
						else 
							$style="style9";
							$dat_itme=datetophpmodel($item['start_time']);
							$timer=explode(" ",$item['start_time']);
						
				?>
               	<tr>
                    <td colspan="2" class="style55" valign="top" align="left">&nbsp;<?php echo $item['item_code'].'&nbsp;&nbsp;&nbsp;'.$item['item_name']; ?></td>
              </tr>
                <tr>
                    <td colspan="2" class="<?php echo $style; ?>" valign="top" align="right">
                        <?php echo ($item['cluster_no']) ? 'Cluster '.$item['cluster_no'].' :&nbsp;&nbsp; ' : '' ; echo $item['stage_name'].' - '.$item['stage_desc'].'&nbsp; :  on  '.$dat_itme .' at '.$timer[1];?>
                   &nbsp;&nbsp;&nbsp; </td>
                </tr>
                <?php
				$l++;
					}
				?>
            </table>
          <?php }?>
      </td><td width="1">&nbsp;</td>
         <?php $i++;?>
         <td width="448" height="515" valign="top">
         	<?php if (@$participant_details[$i]['participant_id']){
			
			$reg	=	@$participant_details[$i]['admn_no'];
			?>
        	<table border="1" width="419" >
           	  <tr>
                <?php
              	  if($file_path!=""){
				  ?>
                  
                 <td rowspan="2"> <img src="<?php echo $file_path?>" height="40"></td>
                 <?php 
				 }
				 else {
				 ?>
                <td width="82" rowspan="2">&nbsp;</td>
                 
            <?php
                 }
                 ?>
                    <td width="263" class="style56" align="right">Kerala School Kalolsavam 2012 - 2013</td>
              </tr>
                <tr>
                   
                    <td align="right" class="stylehy"><?php echo $title.'<br> '.$venue; ?><br></td>
                </tr>
            
                <tr bgcolor="#CCCCCC">
                    <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participant's Card</td>
                </tr>
                
                <tr>
                    <td align="center">Reg. No</td>
                    <td rowspan="2" style="border-bottom:1px #000000; border-left:1.5px #000000; padding:2px;">
                     <table>
                	<tr>
                	<td> 
                    <span class="style2"><?php echo wordwrap($participant_details[$i]['participant_name'],30,'<br/>'); ?></span><br>
                        &nbsp;<?php  echo wordwrap($participant_details[$i]['school_code'].'  '.@$participant_details[$i]['school_name'],30,'<br/>'); ?><br>
                        &nbsp;<?php echo 'Class  :'.$participant_details[$i]['class']."<br>&nbsp;".$participant_details[$i]['sub_district_name']." - Sub-District"; ?>
                  </td>
                   <td align="left">&nbsp;&nbsp;
                 <?
				   //echo "<br /><br />-->".var_dump($Photo['pic'][$reg]);
                    if(@$Photo['pic'][$reg])
					{
					   @$pic_path	=	@$Photo['pic'][$reg];
					   echo "<img src='".@$pic_path."'width='80' height='80'>";				 
					}
					else
					{
						//$document_root 	=	image_url(false)."photos";
						@$pic_path	=	image_url()."/img_user_nophoto.jpg";
					    echo "<img src='".@$pic_path."'width='80' height='80'>";								
					}
					?>
                 
                 </td>
                 </tr>
                 </table>
                 </td>
                  
                </tr>
                <tr>
                    <td  width="52"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;" align="center"><?php echo $participant_details[$i]['participant_id']; ?></td>
                    
              </tr>
                <?php
					$item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id']);
					$cnt=count($item_details);
					$l=1;
					
					foreach($item_details as $item)
					{
						if($l==$cnt)
							$style="style23";
						else 
							$style="style9";
							$dat_itme=datetophpmodel($item['start_time']);							
							$timer=explode(" ",$item['start_time']);
				?>
               	<tr>
                    <td colspan="2" class="style55" valign="top" align="left">&nbsp;<?php echo $item['item_code'].'&nbsp;&nbsp;&nbsp;'.$item['item_name']; ?></td>
              </tr>
                <tr>
                    <td colspan="2" class="<?php echo $style; ?>" valign="top" align="right" >
                       <?php echo ($item['cluster_no']) ? 'Cluster '.$item['cluster_no'].' :&nbsp;&nbsp; ' : '' ; echo $item['stage_name'].' - '.$item['stage_desc'].'&nbsp; :  on  '.$dat_itme .' at '. $timer[1];?>
                   &nbsp;&nbsp;&nbsp; </td>
                </tr>
                <?php
				$l++;
					}
				?>
            </table>
           <?php }?>
      </td>
      <?php $i++;?>
         
  </tr>
      <tr>
      	<td colspan="3" height="20"></td>
      </tr>
     
      
<?php
}
?>
  </table>
  
</page>