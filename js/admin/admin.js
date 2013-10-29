function fncUpdateKalolsavam($kalolsavam_type, id)
{
	if ($kalolsavam_type == 'state')
	{
		if(!trim($('txtKalolsavamName').value))
		{
			alert("Please Enter a Kalolsavam Name");
			$('txtKalolsavamName').value = ''
			$('txtKalolsavamName').focus();
			return false;
		}
		if(!trim($('txtKalolsavamYear').value))
		{
			alert("Please Enter Kalolsavam Year");
			$('txtKalolsavamYear').value = ''
			$('txtKalolsavamYear').focus();
			return false;
		}
	}
	if(!$('txtKalolsavamVenue').value)
		{
			alert("Please Enter a Venu");
			$('txtKalolsavamVenue').value = ''
			$('txtKalolsavamVenue').focus();
			return false;
	}
	$('formKalolsavam').action = path+'admin/kalolsavam/update_kalolsavam';
	$('formKalolsavam').submit();
	return true;
}
function fncEditKalolsavam(id)
{
	$('sel_kalolsavam_id').value = id;
	$('list_formKalolsavam').action = path+'admin/kalolsavam/edit_kalolsavam';
	$('list_formKalolsavam').submit();
}
function fncCancelKalolsavam()
{
	window.open(path+'admin/kalolsavam', '_parent');
}
function fncSaveKalolsavam()
{
	if(!trim($('txtKalolsavamName').value))
	{
		alert("Please Enter a Kalolsavam Name");
		$('txtKalolsavamName').value = ''
		$('txtKalolsavamName').focus();
		return false;
	}
	if(!trim($('txtKalolsavamYear').value))
	{
		alert("Please Enter Kalolsavam Year");
		$('txtKalolsavamYear').value = ''
		$('txtKalolsavamYear').focus();
		return false;
	}
	if(!$('txtKalolsavamVenue').value)
	{
		alert("Please Enter a Venu");
		$('txtKalolsavamVenue').value = ''
		$('txtKalolsavamVenue').focus();
		return false;
	}
	$('formKalolsavam').submit();
	return true;
}
function fncListSubDistrictDetails(id)
{
	$('sel_district_id').value = id;
	$('list_district').action = path+'welcome/sub_district_details';
	$('list_district').submit();
}
function fncListClustertDetails(id)
{
	$('sel_sub_district_id').value = id;
	$('list_district').action = path+'welcome/cluster_details';
	$('list_district').submit();
}
function fncSaveKalolsavamCSV ()
{
	$('formKalolsavam').submit();
}

function nonclusterschool(subdist)
{
	$('hidClusterId').value = subdist;
	$('clustschool').action = path+'welcome/nonclustdetails';
	$('clustschool').submit();

}
function fncExportSubDistrictData()
{
	$('confirm_sub_dist').action = path+'export/export_sub_district_data';
	$('confirm_sub_dist').submit();
}
function fncExportDistrictData()
{
	$('export_dist_data').action 	= path+'export/export_district_data';
	$('hidExport').value			= 'TRUE'; 
	$('export_dist_data').submit();
}
function fncExportStateData()
{
	$('export_state_data').action 	= path+'export/export_state_data';
	$('hidExport').value			= 'TRUE'; 
	$('export_state_data').submit();
}

function fncExportphotos()
{
	$('export_state_data').action 	= path+'zipfiles/zipfiles';
	$('export_state_data').submit();
}

function nonclustschooldet(shid) {
	$('hidSchoolId').value = shid;
	$('noncluster').action = path+'schools/registration/';
	$('noncluster').submit();
}

function printContentt(element_id)
{
	var DocumentContainer = document.getElementById(element_id);
	var WindowObject = window.open('', "TrackHistoryData", 
						  "width='100%',height='100%',top=10,left=10,toolbars=no,scrollbars=yes,status=no,resizable=no");
	WindowObject.document.writeln(DocumentContainer.innerHTML);
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
}

function reset_sub_dist_import_data(message, sub_dist_code)
{
	message = 'Do you really want to reset the import data status of '+message;
	if (confirm(message))
	{
		ajax_loder2('confirm_'+sub_dist_code);
		var oOptions = {
			method: "post",
			parameters: { 'sub_dist_code': sub_dist_code},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('confirm_'+sub_dist_code).innerHTML = response;
			   $('confirm_dis_'+sub_dist_code).innerHTML = '';
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/reset_sub_dist_import_data", oOptions);
	}	
}


function fncConfirnSubDistImportData()
{
	if (confirm("Do you want to confirm? \nOnce confirmed You can't Import any other data!!"))
	{
		$('confirm_sub_dist').action = path+'import/confirm_dist_import_data/';
		$('confirm_sub_dist').submit();
		
	}
	else
	{
		return false;
	}	
}
function fncrestoreKalolsavamdatabase(){	
	$('formKalolsavam').submit();
	return true;

}