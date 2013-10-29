<div align="center" class="heading_gray">
<h3>Certificate School Wise</h3>
</div>
<br/>
<?php echo form_open('certificate/certificate/get_certificate_pdf_school_wise', array('id' => 'formIRL'));
echo blue_box_top();
?>
<input type="hidden" name="hidUservalue" id="hidUservalue"  value="SHOW" />
<input type="hidden" name="hidSchoolCode" id="hidSchoolCode"  value="<?php echo $school_details[0]['school_code']; ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><?php echo $school_details[0]['school_name']; ?>&nbsp;&nbsp;- Certificate Details</th>
  </tr>
  <?php if (is_array($fest) and count($fest) > 0){?>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFestType", $fest, '', 'class="input_box" id="cmbFestType" onchange="javascript:get_school_items(this.value)"'  );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr >
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item : </td>
    <td align="left" width="55%" class="table_row_first" ><div id="all_item_code"><select  class="input_box"  name="item_code" id="item_code" ><option value="0">All Items</option></select></div></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr >
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Participant / Captain : </td>
    <td align="left" width="55%" class="table_row_first" ><div id="all_captain_id"><select  class="input_box"  name="captain_id" id="captain_id" ><option value="0">All Participants</option></select></div></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr >
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Participant( Group / Pinnani) : </td>
    <td align="left" width="55%" class="table_row_first" ><div id="all_group_participant_id"><select  class="input_box"  name="participant_id" id="participant_id" ><option value="0">All Participants</option></select></div></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">      <label>
       <?php echo form_submit('GET', 'GET', '');?>
        </label>
    </form>    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  <?php }?>
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>


<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>