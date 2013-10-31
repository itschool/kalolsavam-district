<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(false); ?>style/template.css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url(false); ?>js/prototype.js"></script>
<!--<script language="javascript" type="text/javascript" src="<?php //echo base_url(false); ?>js/drag.js"></script>
<script language="javascript" type="text/javascript" src="<?php //echo base_url(false); ?>js/effects.js"></script>-->
<script language="javascript" type="text/javascript" src="<?php echo base_url(false); ?>js/common.js"></script>
<!--<script language="javascript" type="text/javascript" src="<?php //echo base_url(false); ?>js/dragdrop.js"></script>
<script language="javascript" type="text/javascript" src="<?php //echo base_url(false); ?>js/popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php //echo base_url(false); ?>js/checkdate.js"></script>-->
<?php echo (isset($_styles)) ? $_styles : ''; ?>
<script language="javascript" type="text/javascript">
//<![CDATA[
	var path 		= '<?php echo base_url();?>';
	var docpath		= '<?php echo base_url(false)."student"?>';
	var photo_path	= '<?php echo base_url(false)."photos/"?>'
	var image_path 	= '<?php echo image_url();?>';
//]]>
</script>
<?php echo (isset($_scripts)) ? $_scripts : ''; ?>
<title><?php echo (isset($title) and trim(@$title) !='') ? $title : 'Kalolsavam 2013 - 2014'; ?></title>
</head>
<body>
<div id="mainContainer">
<?php
if(isset($header) && trim($header)!=''){ echo $header; }
if(isset($menu) && trim($menu)!=''){ echo $menu; } ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
	 <?php if(isset($left_panel) && trim($left_panel)!=''){ ?>
      <td width="250" valign="top" align="left" class="left_bar_bg">
	  	<div id="leftpanel"><?php echo $left_panel; ?></div>
	  </td>
	  <?php } ?>
      <td valign="top" align="left" class="left_bar_bg">
	  <div style="padding-left:2px; padding-bottom:20px;">
	  <?php
		if(isset($message) && trim($message)!=''){ ?>
        <div style="margin:15px;" align="center">
          <?php box_top(); ?>
          <div class="message_image" style="padding:10px;">
            <div style="font-size:16px" class="label_blue"><?php echo @$message; ?></div>
          </div>
          <?php box_bottom(); ?>
        </div>
        <?php
		}
		?>
        <?php
		if(isset($error) && trim($error) !='' ){ ?>
        <div style="margin:15px;" align="center">
          <?php box_top(); ?>
          <div class="error_image">
            <div style="margin:10px;margin-bottom:0px; font-size:16px;text-align:left" id="error_display" class="alert_display"><br>
              <?php echo @$error; ?></div>
          </div>
          <?php box_bottom(); ?>
        </div>
        <?php
		}
		?>
        <?php print $content ?> </div></td>
    </tr>
  </table>
</div>
<div id="footer_bar">&copy; <?php echo date('Y'); ?> <a href="http://itschool.gov.in/">IT@school</a> project all rights reserved</div>
<script language="javascript" type="text/javascript">
	height_adjust('mainContainer');
</script>
</body>
</html>
