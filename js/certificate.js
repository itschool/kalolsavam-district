function getItemCertificate(itemcode)
{
	$('hidItemId').value = itemcode;
	$('formIWPq').action = path+'certificate/certificate/get_certificate_itemwise/';
	$('formIWPq').submit();
}
function getPinnaniParticipant (element_value)
{
	ajax_loder2('all_participant_id');
	var oOptions = {
		method: "post",
		parameters: { 'item_code': $('hidItemId').value, 'captain_id': element_value},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
		   var response = transport.responseText;
		   $('all_participant_id').innerHTML = '';
		   $('all_participant_id').innerHTML = response;
	   }
	};
	var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
	}, path+"ajax/loadajax/get_all_group_participants", oOptions);
}
function getSchoolWiseCertificate (schoolCode)
{
	$('hidSchoolCode').value = schoolCode;
	$('formIWPq').action = path+'certificate/certificate/get_certificate_school_wise/';
	$('formIWPq').submit();
}
function get_school_items (element_value)
{
	ajax_loder2('all_item_code');
	$('all_item_code').innerHTML	= '<select  class="input_box"  name="item_code" id="item_code" ><option vlaue="0">All Items</option></select>';
	$('all_captain_id').innerHTML	= '<select  class="input_box"  name="captain_id" id="captain_id" ><option vlaue="0">All Participants</option></select>';
	$('all_group_participant_id').innerHTML	= '<select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participants</option></select>';
	
	var oOptions = {
		method: "post",
		parameters: { 'school_code': $('hidSchoolCode').value, 'fest_id': element_value},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
		   var response = transport.responseText;
		   $('all_item_code').innerHTML = '';
		   $('all_item_code').innerHTML = response;
	   }
	};
	var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
	}, path+"ajax/loadajax/get_school_items", oOptions);
}
function get_school_captains (element_value)
{
	$('all_captain_id').innerHTML	= '<select  class="input_box"  name="captain_id" id="captain_id" ><option vlaue="0">All Participants</option></select>';
	$('all_group_participant_id').innerHTML	= '<select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participants</option></select>';
	ajax_loder2('all_captain_id');
	var oOptions = {
		method: "post",
		parameters: { 'school_code': $('hidSchoolCode').value, 'item_code': element_value},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
		   var response = transport.responseText;
		   $('all_captain_id').innerHTML = '';
		   $('all_captain_id').innerHTML = response;
	   }
	};
	var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
	}, path+"ajax/loadajax/get_school_captains", oOptions);
}
function get_school_group_participants(element_value)
{
	ajax_loder2('all_group_participant_id');
	var oOptions = {
		method: "post",
		parameters: { 'school_code': $('hidSchoolCode').value, 'item_code' : $('item_code').value ,'captain_id': element_value},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
		   var response = transport.responseText;
		   $('all_group_participant_id').innerHTML = '';
		   $('all_group_participant_id').innerHTML = response;
	   }
	};
	var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
	}, path+"ajax/loadajax/get_all_group_participants", oOptions);
}
function fetch_participant_details_result ()
{
	if($('txtParticipantId').value.length >= 4){
		var participant_id	=	$('txtParticipantId').value;
		var oOptions = {
			method: "post",
			parameters: { 'participant_id': participant_id},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('content_id').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/get_participant_details", oOptions);	
		//alert("succ");
	}else{
		return false;	
	}
}


