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
	color:black
}
.style3{
	font-size: 10px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
 
<page backtop="25mm" backbottom="20mm ">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" >
            <tr>
                <td align="center" class="style1">School Contacts</td>
            </tr>
           
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       
	    <table width="100%" border="1" bordercolor="#666666" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
          <tr >
            <th width="30" height="30" align="center" class="style2" style="border-bottom:1px #666666; border-right:1px #666666; padding:2px;">Sl.No</th>
            <th width="200" align="left" class="style2" style="border-bottom:1px #666666; border-right:1px #666666; padding:2px;">School</th>
            <th width="200" align="left" class="style2" style="border-bottom:1px #666666; border-right:1px #666666; padding:2px;">Principal</th>
            <th width="250" align="left" class="style2" style="border-bottom:1px #666666; border-right:1px #666666; padding:2px;">Headmster</th>
            <th width="250" align="left" class="style2" style="border-bottom:1px #666666;">Team Manager</th>
          </tr>
          <?php
		  	$count = 1;
			foreach($school_details as $school)
			{
			$team_manager		=	str_replace('"','',$school['teachers']);
			$team_manager		=	str_replace('#$#','PH : ',$team_manager);
			$team_manager		=	str_replace('#@#',' ',$team_manager);
            ?>
            <tr>
            	<td align="center" class="ety" style="border-bottom:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $count++;?></td>
                <td align="left" class="ety" style="border-bottom:1px #666666; border-right:1px #666666; padding:2px;"><?php echo wordwrap($school['school_code'].'-'.$school['school_name'],30,'<br>');?></td>
                <td align="left" class="ety" style="border-bottom:1px #666666; border-right:1px #666666; padding:2px;">
					<?php echo ($school['principal_name']) ? wordwrap($school['principal_name'],30,'<br>').'<br>PH : '.$school['principal_phone'] : '';?>
                </td>
                <td align="left" class="ety" style="border-bottom:1px #666666; border-right:1px #666666; padding:2px;">
					<?php echo ($school['hm_name']) ? wordwrap($school['hm_name'],40,'<br>').'<br>PH : '.$school['hm_phone'] : '';?>
                </td>
                
                <td align="left"  class="ety"style="border-bottom:1px #666666; padding:2px;">
					<?php echo wordwrap($team_manager,40,'<br>');?>
                </td>
            </tr>
            <?php
			}
        ?>
        </table>
    
 </page>
 