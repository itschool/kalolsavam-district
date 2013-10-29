
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #000033;
}
.style2 {
	font-size: 18px;
	font-weight: bold;
	color: #003333;
}
-->
</style>

<?php

     $flag=0;
     $count=0;
    $check2=''; $i=0;
     foreach($fest_details as  $data)
   {
     $check=$data['fest_name'];
     $count=$data['no_of_participant'];


		if($i!=0){
			print("</page>");
			}
			 $i++;


	  ?>

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
        <table width="89%" border="0" cellspacing="0" cellpadding="0" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
          <td height="18" colspan="3" align="center" class="style2"><p>Kerala School Kalolsavam 2013 - 2014</p>

          </td>
        </tr>
        <tr>
          <td width="68%" height="20"  align="left"  class="style1"> Venue </td>
          <td width="28%" align="center" class="style1"><div align="left">Date</div></td>
          </tr>
        </table>
        <table width="67%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">




	           <tr>
            <td  align="left" height="32" colspan="15" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item:<?php echo $itemcode;?>-<?php echo $retdat[0]['item_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>

          <tr>
            <td height="32" colspan="15" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><p align="left"><strong>Festival:<?php echo  $festname[0]['fest_name']; ?>&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No of Registered &nbsp;&nbsp; :<?php echo $participated[0]['no_of_participant'];?></p>
              <p align="left"><strong>Date&nbsp;&nbsp;&nbsp; &nbsp;:<?php $date=explode(' ',$retdat[0]['start_time']);echo @$date[0];
		?>&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;Time:<?php echo @$date[1];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No.of Participated :&nbsp;<?php echo(count($retdat));?></p></td>
          </tr>
          <tr>
            <td colspan="5" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><div align="left"><strong>.</strong> </div>              <div align="center"></div></td>
            <td colspan="6" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><div align="center"><strong>Marks</strong></div></td>
            <td colspan="4" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>&nbsp;</td>
          </tr>
          <tr>
            <td width=33 height="25" style='border:0 0 0.5px 0.5px 0#000000 ; height:20 px;'><strong>SlNo</strong></td>
          <td width=36 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><p>Reg No</p> </td>
            <td width=38 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><p>Code No</p>            </td>
            <td width=141  align="center" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>Name</td>
            <td width=96  align="center" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>School</td>
            <td  align="center" width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>1</td>
            <td  align="center" width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>2</td>
            <td  align="center" width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>3</td>
            <td  align="center" width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>4</td>
            <td  align="center" width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>5</td>
            <td  align="center" width=44 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>Total</td>
            <td  align="center" width=25 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'> %</td>
            <td align="center" width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>G</td>
            <td align="center"width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>R</td>
            <td align="center" width=54 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'>P</td>
          </tr>
          <?php

		  $sl=0;
		   for($j=0; $j<count($retdat); $j++){
		   $sl++;
		   ?>

        <tr>
            <td  align="center" width=33 height="25" style='border:0 0 0.5px 0.5px 0#000000 ; height:20 px;'><?php echo $sl;?>&nbsp;</td>
          <td   width=36 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo $retdat[$j]['participant_id'];?>&nbsp;</td>
          <td width=38 align="center"style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><p><?php echo $retdat[$j]['code_no'];?></p></td>
          <td width=141  align="left" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php $name=$retdat[$j]['participant_name']; $name=wordwrap($name, 20, "<br />", 1); echo $name; ?></td>
          <td width=96  align="center" style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php      $text=$retdat[$j]['school_name'];
		   $text = wordwrap($text, 20, "<br />", 1);
		  	echo  $text;
		  ?></td>
          <td  align="center" width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php $marks	=	explode('#$#',$retdat[$j]['marks'])

		  ?><?php echo @$marks[0];?></td>

          <td  align="center" width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo @$marks[1];?></td>
          <td  align="center" width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo @$marks[2];?></td>
          <td  align="center" width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo @$marks[3];?></td>
          <td  align="center" width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo @$marks[4];?></td>
          <td  align="center" width=44 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo $retdat[$j]['total_mark'];?></td>
          <td  align="center" width=25 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php


			$percentage=$retdat[$j]['percentage'];
			 $percentage = wordwrap($percentage, 4, "<br />", 1);
			echo $percentage;?></td>
          <td align="center" width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo $retdat[$j]['grade'];?></td>
          <td align="center"width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo $retdat[$j]['rank'];?></td>
          <td align="center" width=54 style='border:0 0 0.5px 0.5px 0 #000000 ; height:20 px;'><?php echo $retdat[$j]['point'];?></td>
          </tr>
         <?php }?>

          <tr>
            <td width=33 height="37" style='border:0 0 0.5px 0.5px 0 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=26 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=44 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=25 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td width=27 style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
            <td style='border:0 0 0.5px 0.5px 0 #000000 ; height:30 px;'>&nbsp;</td>
          </tr>

        </table>
        </page>

