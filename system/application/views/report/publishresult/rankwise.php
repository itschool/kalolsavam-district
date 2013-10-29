<div align="center" class="heading_gray">
<h3>Rank Wise Participants Result Details</h3>
</div>
<br />

<?php echo form_open('report/resultindex/rankwise_report', array('id' => 'rankwise','target'=>'_blank'));
echo blue_box_top();

		$rank[1]=1;
		$rank[2]=2;
		$rank[3]=3;
		$rank['ALL']='All Rank';
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Select Item &amp; Rank</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbFestType" onchange="javascript:fetch_higherlevel_participant(this.value)"'  );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="55%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rank :</td>
  
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("rank",$rank,'', 'class="input_box" id="rank" '  );?>&nbsp;</td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
      <td>&nbsp;</td>
      <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:</td>
      <td align="left" width="55%" class="table_row_first">
      	<?php echo form_dropdown('txtDate',$date_array,'','id="txtDate" class="select_box_medium"');?>
        <!--<input class="input_box date_field" type="text" onfocus="displayCalendar($('txtDate'),'yyyy-mm-dd',this)" name="txtDate" id="txtDate" value="<?php echo @$date; ?>">-->
          	<!--<input class="input_box date_field" type="text"   onFocus="javascript:vDateType='3'" onBlur="DateFormat(this,this.value,event,true,'3')" onKeyDown="DateFormat(this,this.value,event,false,'3')" onKeyUp="DateFormat(this,this.value,event,false,'3')" maxlength="10"  name="txtDate" id="txtDate" value="<?php //echo $start_date; ?>">-->
           <!-- <img src="<?php //echo image_url();?>calender.gif" onclick="displayCalendar($('txtDate'),'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" /></td>-->
      <td width="18%">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first"><form name="form1" method="post" action="">
      <label>
      <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onClick="return rankwise();">
      </label>
    </form>    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />

<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>