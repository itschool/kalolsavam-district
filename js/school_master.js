// JavaScript Document
function fncAddSchool(usertype)
{
	if(!document.getElementById('txtSchoolName').value)
	{
		alert("Please Enter School name");
		document.getElementById('txtSchoolName').focus();
		return false;
	}
	
	if(document.getElementById('cmbSchoolType').value==0)
	{
		alert("Please select School type");
		document.getElementById('cmbSchoolType').focus();
		return false;
	}
	
	if(usertype	< 2) {
		if(document.getElementById('cmbDistrict').value==0)
		{
			alert("select District");
			document.getElementById('cmbDistrict').focus();
			return false;
		}
	}
	if(usertype	< 3) {
		if(document.getElementById('cmbEduDistrict').value==0)
		{
			alert("select Education District");
			document.getElementById('cmbEduDistrict').focus();
			return false;
		}
	
		if(document.getElementById('cmbSubDistrict').value==0)
		{
			alert("select Sub-District");
			document.getElementById('cmbSubDistrict').focus();
			return false;
		}
		
		
	}
	return true;
	
}

function fncUpdateSchool(userId, usertype){
	if(!document.getElementById('txtSchoolName').value)
	{
		alert("Please Enter School name");
		document.getElementById('txtSchoolName').focus();
		return false;
	}
	
	if(document.getElementById('cmbSchoolType').value==0)
	{
		alert("Please select School type");
		document.getElementById('cmbSchoolType').focus();
		return false;
	}
	if(usertype	< 2) {
		
		if(document.getElementById('cmbDistrict').value==0)
		{
			alert("select District");
			document.getElementById('cmbDistrict').focus();
			return false;
		}
	}
	if(usertype	< 3) {
		if(document.getElementById('cmbEduDistrict').value==0)
		{
			alert("select Education District");
			document.getElementById('cmbEduDistrict').focus();
			return false;
		}
	
		if(document.getElementById('cmbSubDistrict').value==0)
		{
			alert("select Sub-District");
			document.getElementById('cmbSubDistrict').focus();
			return false;
		}
	}
	$('hidUserId').value = userId;
	$('formUser').action = path+'schools/school_master/update_school_detials';
	$('formUser').submit();
}


function deleteUser(userId) {
	if(!confirm('Really want to delete the user?')){
		return false;
	}
	$('UserIdty').value = userId;
	$('editUser').action = path+'schools/school_master/delete_school_detials';
	$('editUser').submit();
}

function editUser(userId) {
	$('UserIdty').value = userId;
	$('editUser').action = path+'schools/school_master/edit_school_detials';
	$('editUser').submit();
}


function cancel()
{
	$('formUser').action = path+'schools/school_master/';
	$('formUser').submit();
}

function loadEduDistrict()
{
	if($('cmbDistrict').value > 0)	
	{
		$('divEduDistrict').style.display = 'block';	
		ajax_loder2('divEdudistrictCombo');
		if($('cmbEduDistrict'))
			$('cmbEduDistrict').selectedIndex  = 0;
		
		var district_code	=	$('cmbDistrict').value;
		var oOptions = {
			method: "post",
			parameters: { 'district': district_code},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('divEdudistrictCombo').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/get_edu_district_details", oOptions);	
	}
}

function loadSubDistrict()
{
	if($('cmbEduDistrict').value > 0)	
	{
		$('divSubdistrict').style.display = 'block';	
		ajax_loder2('divSubdistrictCombo');
		if($('cmbSubDistrict'))
			$('cmbSubDistrict').selectedIndex  = 0;
		
		//var district_code	=	$('cmbDistrict').value;
		var edu_district	=	$('cmbEduDistrict').value;
		var oOptions = {
			method: "post",
			parameters: {  'edu_district': edu_district },
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
		}, path+"ajax/loadajax/get_subdistrict_details_of_edu_district", oOptions);	
	}
}

function loadSchool()
{
	return;
}

function loadSubDistrictFilter()
{
	if($('cmbDistrictFilter').value > 0)	
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

