<div align="center" class="heading_gray">
<h3>Certificate Participant Wise</h3>
</div>
<br/>
<?php echo form_open('certificate/certificate/get_certificate_pdf_participant_wise', array('id' => 'formIRL'));
echo blue_box_top();
?>
<div id="content_id">
<?php $this->load->view('certificate/participant_item_details',$this->Contents); ?>
</div>
<?php
//itemwise_report_interface
echo blue_box_bottom();
echo form_close();
?>