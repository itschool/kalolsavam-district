// JavaScript Document
function fnsUserAdd()
{
	if(!document.getElementById('txtNewUserName').value)
	{
		alert("Please Enter User name");
		document.getElementById('txtNewUserName').focus();
		return false;
	}
	if(!document.getElementById('txtNewPassword').value)
	{
		alert("Please Enter Password");
		document.getElementById('txtNewPassword').focus();
		return false;
	}
	if(document.getElementById('userType').value==0)
	{
		alert("select User type");
		document.getElementById('userType').focus();
		return false;
	}
	if(document.getElementById('userType').value > 1)
	{
		if(document.getElementById('cmbDistrict').value==0)
		{
			alert("select District");
			document.getElementById('cmbDistrict').focus();
			return false;
		}
	}
	if(document.getElementById('userType').value > 2)
	{
		if(document.getElementById('cmbSubDistrict').value==0)
		{
			alert("select Sub-District");
			document.getElementById('cmbSubDistrict').focus();
			return false;
		}
	}
	if(document.getElementById('userType').value > 3)
	{
		if(document.getElementById('cmbSchool').value==0)
		{
			alert("select School");
			document.getElementById('cmbSchool').focus();
			return false;
		}
	}
	
	
	return true;
	
}

function deleteUser(userId,UserType,UserName) {
	if(!confirm('Are you really want to delete the ' + UserType + ' ' + UserName+ '?')){
		return false;
	}
	$('UserIdty').value = userId;
	$('editUser').action = path+'user/admin_users/delete_admin_detials';
	$('editUser').submit();
}

function editUser(userId) {
	$('UserIdty').value = userId;
	$('editUser').action = path+'user/admin_users/edit_admin_detials';
	$('editUser').submit();
}

function fnsUserUpdate(userId){
	$('hidUserId').value = userId;
	$('formUser').action = path+'user/admin_users/update_admin_detials';
	$('formUser').submit();
}

function cancel()
{
	$('formUser').action = path+'user/admin_users/';
	$('formUser').submit();
}

function loadDistrict()
{
	$('divDistrict').style.display = 'none';	
	$('divSubdistrict').style.display = 'none';	
	$('divSchool').style.display = 'none';	

	if($('cmbDistrict'))
		$('cmbDistrict').selectedIndex  = 0;
	if($('cmbSubDistrict'))
		$('cmbSubDistrict').selectedIndex  = 0;
	if($('cmbSchool'))
	$('cmbSchool').selectedIndex  = 0;
	
	if($('userType').value != 1){
		$('divDistrict').style.display = 'block';	
	}
	if($('userType').value == 3 && $('show_generate_admin').value == 1)
	{
		$('divGenerateSubDistAdmin_user_type').innerHTML = '';
		$('divGenerateSubDistAdmin_dist').innerHTML = '';
		$('divGenerateSubDistAdmin_sub_dist').innerHTML = '';
		ajax_loder2 ('divGenerateSubDistAdmin_user_type');
		var user_type	= $('userType').value;
		var oOptions = {
			method: "post",
			parameters: { 'user_type': user_type},
			onFailure: function (oXHR, oJson) {
				$('divGenerateSubDistAdmin_user_type').innerHTML ='';
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('divGenerateSubDistAdmin_user_type').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/check_sub_dist_admin_exist", oOptions);
	
		//$('divGenerateSubDistAdmin').style.display = 'block';
	}
}

function loadSubDistrict()
{
	if($('userType').value > 2)	
	{
		$('divSubdistrict').style.display = 'block';	
		ajax_loder2('divSubdistrictCombo');
		if($('cmbSubDistrict'))
			$('cmbSubDistrict').selectedIndex  = 0;
		if($('cmbSchool'))
			$('cmbSchool').selectedIndex  = 0;
		
		var district_code	=	$('cmbDistrict').value;
		var oOptions = {
			method: "post",
			parameters: { 'district': district_code},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('divSubdistrictCombo').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/get_subdistrict_details", oOptions);	
	}
	if ($('userType').value==3 &&  $('cmbDistrict').value != 0 && $('show_generate_admin').value == 1)
	{
		$('divGenerateSubDistAdmin_user_type').innerHTML = '';
		$('divGenerateSubDistAdmin_dist').innerHTML = '';
		$('divGenerateSubDistAdmin_sub_dist').innerHTML = '';
		ajax_loder2 ('divGenerateSubDistAdmin_dist');
		var district_code	=	$('cmbDistrict').value;
		//var sub_district_code	=	$('cmbSubDistrict').value;
		var oOptionsDetail = {
			method: "post",
			parameters: { 'district': district_code},
			onFailure: function (oXHR, oJson) {
				 $('divGenerateSubDistAdmin_dist').innerHTML = '';
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('divGenerateSubDistAdmin_dist').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/check_sub_dist_admin_exist", oOptionsDetail);
	}
}

function loadSchool()
{
	if($('userType').value > 3)	
	{
		$('divSchool').style.display = 'block';	
		ajax_loder2('divSchoolCombo');
		if($('cmbSchool'))
			$('cmbSchool').selectedIndex  = 0;
		
		var subdistrict_code	=	$('cmbSubDistrict').value;
		var oOptions = {
			method: "post",
			parameters: { 'subdistrict': subdistrict_code},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('divSchoolCombo').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/get_school_details", oOptions);	
	}
	if ($('userType').value==3 &&  $('cmbDistrict').value != 0 &&  $('cmbSubDistrict').value != 0 && $('show_generate_admin').value == 1)
	{
		$('divGenerateSubDistAdmin_user_type').innerHTML = '';
		$('divGenerateSubDistAdmin_dist').innerHTML = '';
		$('divGenerateSubDistAdmin_sub_dist').innerHTML = '';
		ajax_loder2 ('divGenerateSubDistAdmin_sub_dist');
		var district_code	=	$('cmbDistrict').value;
		var sub_district_code	=	$('cmbSubDistrict').value;
		var oOptionsDetail = {
			method: "post",
			parameters: {'sub_district':sub_district_code},
			onFailure: function (oXHR, oJson) {
				 $('divGenerateSubDistAdmin_sub_dist').innerHTML = '';
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   
			   $('divGenerateSubDistAdmin_sub_dist').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/check_sub_dist_admin_exist", oOptionsDetail);
	}
}






function loadDistrictFilter()
{

		$('divDistrictFilter').style.display = 'none';	
		$('divSubDistrictFilter').style.display = 'none';	
		$('divSchoolFilter').style.display = 'none';	
		
		if($('cmbDistrictFilter'))
			$('cmbDistrictFilter').selectedIndex  = 0;
		if($('cmbSubDistrictFilter'))
			$('cmbSubDistrictFilter').selectedIndex  = 0;
		if($('cmbSchoolFilter'))
		$('cmbSchoolFilter').selectedIndex  = 0;
	if($('userTypeFilter').value != 1){
		$('divDistrictFilter').style.display = 'block';	
	}
}

function loadSubDistrictFilter()
{
	if($('userTypeFilter').value > 2)	
	{
		$('divSubDistrictFilter').style.display = 'block';	
		ajax_loder2('divSubDistrictFilter');
		if($('cmbSubDistrictFilter'))
			$('cmbSubDistrictFilter').selectedIndex  = 0;
		if($('cmbSchoolFilter'))
			$('cmbSchoolFilter').selectedIndex  = 0;
		
		var district_code	=	$('cmbDistrictFilter').value;
		var oOptions = {
			method: "post",
			parameters: { 'district': district_code, 'name':'cmbSubDistrictFilter', 'function':'loadSchoolFilter'},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('divSubDistrictFilter').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/get_subdistrict_details_small", oOptions);	
	}
}

function loadSchoolFilter()
{
	if($('userTypeFilter').value > 3)	
	{
		$('divSchoolFilter').style.display = 'block';	
		ajax_loder2('divSchoolFilter');
		if($('cmbSchoolFilter'))
			$('cmbSchoolFilter').selectedIndex  = 0;
		
		var subdistrict_code	=	$('cmbSubDistrictFilter').value;
		var oOptions = {
			method: "post",
			parameters: { 'subdistrict': subdistrict_code, 'name':'cmbSchoolFilter'},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('divSchoolFilter').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/get_school_details_small", oOptions);	
	}
}
function generateSubDistAdmin ()
{
	$('formUser').action = path+'user/admin_users/generate_sub_dist_admins';
	$('formUser').submit();
}
function generate_sub_dist_admin_pdf()
{
	$('generate_pdf').value=1;
	$('filter').action = path+'user/admin_users/sub_district_admin_list_pdf_creation';
	$('filter').target = '_blank'; 
	$('filter').submit();
	$('filter').target = '_self'; 
	$('filter').action = path+'user/admin_users/';
}
