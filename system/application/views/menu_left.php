<div align="center">
	<a href="<?php echo base_url().'home'?>" title="" ><img src="<?php echo image_url();?>rain_concert_logo.gif" alt="Rain Concert Pvt. Ltd." /></a>
</div>
<div align="center" class="inner_logo"><img src="<?php echo image_url();?>pmrs_logo.gif" alt="PMRS" /><h3>Delivering Quality Management Solutions</h3></div>
<div class="curveme">
<h3><span>Quick Info</span></h3>
<div class="curverbox">
  <div class="inside">
    <p>
	<div align="center"><?php echo get_logged_user_image();?></div>
	<div align="center" style="margin-top:5px; margin-bottom:10px;">Welcome Back, <br /><strong><?php echo $this->session->userdata('FULLNAME');?></strong></div>
	</p>
  </div>
</div>
</div>
<!-- 
<div id="side_bar">
	<div class="head">
	Welcome Back,<br>
	<strong><?php echo $this->session->userdata('FULLNAME');?></strong>
	</div>
</div>
<div class="heading_gray"><h3>Control Panel</h3></div>
-->