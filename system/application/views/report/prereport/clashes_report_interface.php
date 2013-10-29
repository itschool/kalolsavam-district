<div align="center" class="heading_gray">
<h3>Clash Report</h3>
</div>
<br />
<?php echo form_open('report/prereportpdf/clashes_details', array('id' => 'formIWP','target'=>'_blank'));
echo blue_box_top();
?>

<form name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Select Festival</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    <div align="right">Festival Type : </div></td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbFestType"');?></td>
    <td width="18%">&nbsp;</td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left" class="table_row_first"><div align="right">Date</div></td>
      <td align="left" class="table_row_first">
      	<?php echo form_dropdown('txtDate',$date_array,'','id="txtDate" class="select_box_medium"');?>
        <!--<input class="input_box date_field" type="text" onfocus="displayCalendar($('txtDate'),'yyyy-mm-dd',this)" name="txtDate" id="txtDate" value="<?php echo @$date; ?>">-->
          	<!--<input class="input_box date_field" type="text"   onFocus="javascript:vDateType='3'" onBlur="DateFormat(this,this.value,event,true,'3')" onKeyDown="DateFormat(this,this.value,event,false,'3')" onKeyUp="DateFormat(this,this.value,event,false,'3')" maxlength="10"  name="txtDate" id="txtDate" value="<?php //echo $start_date; ?>">-->
           <!-- <img src="<?php //echo image_url();?>calender.gif" onclick="displayCalendar($('txtDate'),'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" /></td>-->
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onclick="javascript: return clureport()">
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