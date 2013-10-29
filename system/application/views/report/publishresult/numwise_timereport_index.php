
<br />

<?php echo form_open('report/afterresultreportpdf/numwise_timeresult_report', array('id' => 'rankwise','target'=>'_blank'));
echo blue_box_top();

		$rank[1]=1;
		$rank[2]=2;
		$rank[3]=3;
		$rank['ALL']='All Rank';
		/*$cur_date	=	date('Y-m-d');
		$date_array[$cur_date]	=	date('j M Y',strtotime($cur_date));
		echo "<br /><br /><br />".$date_array;*/
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="6" align="left">Result Number Wise</th>
  </tr>
  <tr>
    <td width="4%" class="">&nbsp;</td>
    <td align="left" width="22%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Result Number : </td>
    <td align="left" width="74%" class="table_row_first"><?php echo form_input("txtResultno", '','class="input_box" id="txtResultno"'); ?></td>
    
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="22%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="74%" class="table_row_first"><form name="form1" method="post" action="">
      <label>
      <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" >
      </label>
    </form>    </td>
    
  </tr>
  
  <tr>
    <td align="center" colspan="5">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />

<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>