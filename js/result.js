// JavaScript Document
function fetch_item_details_result()
{
	if($('txtItemCode').value.length >= 3){
		var item_code	=	$('txtItemCode').value;
		
		var oOptions = {
			method: "post",
			parameters: { 'code': item_code},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('divEntryForm').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"result/resultentry/get_item_details_result", oOptions);	
		//alert("succ");
	}else{
		return false;	
	}
}

function fncSaveResultEntry()
{
	if (trim($('txt_reg_no').value) == '')
	{
		alert('Please enter the register number');
		$('txt_reg_no').focus();
		return;
	}
	
	if (trim($('txt_code_no').value) == '')
	{
		alert('Please enter the code');
		$('txt_code_no').focus();
		return;
	}
	var mark_id	=	'';
	var total_marks	=	0;
	for(var i = 1; i <= $('hidNoJudge').value; i++) {
		mark_id	=	'mark_'+i;
		if (trim($(mark_id).value) == '')
		{
			alert('Please enter the mark '+i);
			$(mark_id).focus();
			return;
		}
		if (trim($(mark_id).value)*1 > 100)
		{
			alert('Please enter valid mark '+i);
			$(mark_id).focus();
			return;
		}
		
		total_marks	+=	$(mark_id).value*1;
	}
	if (trim($('totalMark').value) == '')
	{
		alert('Please enter the total marks');
		$('totalMark').focus();
		return;
	}
	
	if (total_marks != $('totalMark').value)
	{
		alert('Please check the total marks entered');
		$('totalMark').focus();
		return;
	}
	
	$('resultEntry').action =	path+'result/resultentry/save_result_entry/';
	$('resultEntry').submit();
}

function editResult (id) {
	$('hidResultId').value	=	id;
	$('resultEntryList').action	=	path+'result/resultentry/edit_result_entry/';
	$('resultEntryList').submit();
}

function deleteResult (id) {
	if(!confirm('Do you want to delete result ? ')){
		return;	
	}
	$('hidResultId').value	=	id;
	$('resultEntryList').action	=	path+'result/resultentry/delete_result_entry/';
	$('resultEntryList').submit();	
}

function fncCancel () {
	$('resultEntryList').action	=	path+'result/resultentry/';
	$('resultEntryList').submit();	
}
function confirmResutlEntry ()
{
	if(confirm('Do you really want to confirm the results?'))
	{
		$('resultEntryList').action	=	path+'result/resultentry/confirm_result_entry';
		$('resultEntryList').submit();
	}
}
function getItemResult(itemcode)
{
	$('hidItemId').value = itemcode;
	$('formIWPq').action = path+'result/resultentry/';
	$('formIWPq').submit();
}
function resetResultConfirmation (itemcode, message, element_id)
{
	//alert('---'+itemcode+'----'+message+'----'+element_id);
	message = 'Do you really want to reset the Result confirmation status of '+message;
	if (confirm(message))
	{
		ajax_loder2(element_id);
		var oOptions = {
			method: "post",
			parameters: { 'item_code': itemcode},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $(element_id).innerHTML = '';
			   $(element_id+'_dis').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/reset_result_confirmation_status", oOptions);
	}
}


function resultcommon(itm)
{
	$('hiditemcode').value = itm;
	//alert($('hiditemcode').value);
	$('common_report').action=path+"report/timefestreportpdf/common_report";
	$('common_report').submit();
}
function resultallcommon()
{
	$('hiditemcode').value='ALL';
	$('common_report').action=path+"report/timefestreportpdf/common_report";
	$('common_report').submit();
}

function resultprintout(itm)
{
	$('hiditemcode').value = itm;
	//alert($('hiditemcode').value);
	$('resreport').action=path+"report/timefestreportpdf/confidential";
	$('resreport').submit();
}
function resultallprint()
{
	$('hiditemcode').value='ALL';
	$('resreport').action=path+"report/timefestreportpdf/confidential";
	$('resreport').submit();
}
function printConfidentialReport ()
{

		$('resultEntryList').action	=	path+'result/resultentry/printConfidentialReport';
		$('resultEntryList').submit();	
}