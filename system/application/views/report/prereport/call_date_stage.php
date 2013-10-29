<?php echo form_open('report/prereportpdf/call_date_stage', array('id' => 'clu','target'=>'_blank'));
echo blue_box_top();
$fest['All']	=	'All Festivals';
?>
<input type="hidden" name="hidUserId" id="hidUserId" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Call Sheet:(Date & Stage wise)</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date : </td>
  
    <td align="left" class="table_row_first">
            <?php echo form_dropdown("txtDate", @$date_array,(@$date != '') ? $date :'', 'class="select_box_medium" id="txtDate"' );?>
            <!--<input class="input_box date_field" type="text" onfocus="displayCalendar(document.formAllotment.txtDate,'yyyy-mm-dd',this)" name="txtDate" id="txtDate" value="<?php echo @$date; ?>" readonly="readonly">-->
          	<!--<input class="input_box date_field" type="text"   onFocus="javascript:vDateType='3'" onBlur="DateFormat(this,this.value,event,true,'3')" onKeyDown="DateFormat(this,this.value,event,false,'3')" onKeyUp="DateFormat(this,this.value,event,false,'3')" maxlength="10"  name="txtDate" id="txtDate" value="<?php //echo $start_date; ?>">-->
            <!--<img src="<?php echo image_url();?>calender.gif" onclick="displayCalendar(document.formAllotment.txtDate,'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" />-->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
     <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stage : </td>
  
    <td align="left" width="55%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cmbstage",$stage,'', 'class="input_box" id="cmbstage" '  );?></div></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">      <label>
       <?php echo form_submit('Report', 'Report', 'onClick=""');?>
        </label>
    </form>
    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>


<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>