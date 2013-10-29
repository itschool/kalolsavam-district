<?php echo form_open(base_url().'login', array('name'=>'loginform', 'id'=>'loginform', 'style'=>'margin:0px; display:inline' )); ?>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td class="template_login_meesage_bg">&nbsp;
			<?php
			 if(isset($result))
			{
				if($result==0)
				{
					error_box('Sorry, we can\'t identify your login details. Did you make a mistake when typing the User name / Password?');	
				}
				
			}	
			 ?>
		</td>
	</tr>
	<tr>
		<td  width="100%">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="42%" align="right" height="350"><img width="364" height="350"  border=0  src="../images/login_page_left_image.jpg" /></td>
					<td width="42%" valign="top">
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="140" height="107" valign="top" class="keys_padding">
									<img border=0 width="140" height="107" src="../images/login_page_keys_image.jpg" />
								</td>
								<td style="padding-top:35px;">
									<table cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td colspan="3"><div class="login_heading">Login</div><div></div></td>
										</tr>
										<tr>
											<td width="65" align="left" class="field_title">Username</td>
											<td width="100" align="left" class="field_input_td">
												<?php echo form_input("txtUserName", (isset($_POST['txtUserName']) and trim($_POST['txtUserName']) != '' and trim($_POST['txtUserName']) != 'E-mail') ? $_POST['txtUserName'] :  get_cookie('username') ,'class="login_control" id="txtUserName" maxlength="40" style="width:160px;" '); ?>
											</td>
											<td width=""></td>
										</tr>
										<tr>
											<td align="left" class="field_title">Password</td>
											<td class="field_input_td"><?php echo form_password("txtPassword", get_cookie('password'), 'class="login_control" id="txtPassword" maxlength="40" style="width:160px;"'); ?></td>
											<td width=""></td>
										</tr>
										<tr>
											<td></td>
											<td align="center"  class="field_input_td"><?php echo form_submit('login', '', 'onclick="javascript:return checkLogin();" class="login_button"' ); ?></td>
											<td width=""></td>
										</tr>
										<tr>
											<td colspan="2" class="emblem_container" align="center"><img border=0 width="102" height="72" src="../images/login_page_emblem_image.jpg" /></td>
											<td width=""></td>
										</tr>
										<tr>
											<td colspan="2" align="center"><div>Government of Kerala</div><div>General Education Department</div></td>
											<td width=""></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php echo form_close(); ?>
<script language="javascript">
	window.onload = $('txtUserName').focus();
</script>
<script type="text/javascript">
	function checkLogin ()
	{
		$('loginform').submit();
	}
</script>