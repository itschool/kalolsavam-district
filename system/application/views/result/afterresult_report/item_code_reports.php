<div align="center" class="heading_gray">
<h3>REPORT</h3>
</div>
<br />

<?php echo form_open('report/afterresultreportpdf/item_code_reports', array('id' => 'formIWP','target'=>'_blank'));
echo blue_box_top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Select Item</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Item Code : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_input("item", '','class="small_box" id="item" onkeypress="javascript:return numbersonly(this, event, false);" '); ?></td>
    <td width="18%">&nbsp;</td>
  </tr>
 <!-- <tr>
  <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    Tabulation <input type="checkbox" name="tabulation" value="1" id="1"> 
    Score <input type="checkbox" name="Score" value="2" id="2">
    Call <input type="checkbox" name="Call" value="3" id="3">
    Time <input type="checkbox" name="Time" value="4" id="4"></td>
    <td>&nbsp;</td>
  </tr>-->
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first"><form name="form1" method="post" action="">
      <label>
        <input type="submit" name="report" id="report" value="Report" onClick="">
       
        </label>
    </form>
    </td>
   
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