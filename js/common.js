// JavaScript Document
function ltrim(str) { for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++); return str.substring(k, str.length);}
function rtrim(str) { for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ; return str.substring(0,j+1);}
function trim(str) {return ltrim(rtrim(str));}
function isAlphaNumeric(val){if (val.match(/^[a-zA-Z0-9]+$/)){ return true;}else{return false;} }
function isWhitespace(charToCheck) { var whitespaceChars = " \t\n\r\f"; return (whitespaceChars.indexOf(charToCheck) != -1);}
var delete_msg = 'Do you really want to delete?';
/*
*Fucntion for checking the field value having the valid email
*/
function isValidEmail(email){
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;if (filter.test(email)){ return true; }else{ return false; }
}
function fncCancel(url){window.location = url;}
function height_adjust(id){	if($(id).getHeight() < 500){ if (window.navigator.userAgent.indexOf('MSIE 6.0') != -1) $(id).style.height='500px'; $(id).style.minHeight='500px'; }}
function show_hide(ele){ if($(ele).style.display=='none'){ $(ele).appear(); }else{ $(ele).fade();}}
function show_menu(el) { el.getElementsByTagName('ul')[0].style.left='auto'; el.getElementsByTagName('ul')[0].style.display='block'; }
function hide_menu(el) { el.getElementsByTagName('ul')[0].style.left='-999em'; }
function ajax_loder(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader.gif">'; }
function ajax_loder2(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader2.gif">'; }
function compareDates(startDate,endDate){
	var point1=0;var point2=0;
	var arrDate1 = startDate.split("-");
	var useDate1 = new Date(arrDate1[2], arrDate1[1]-1, arrDate1[0]);
	var arrDate2 = endDate.split("-");
	var useDate2 = new Date(arrDate2[2], arrDate2[1]-1, arrDate2[0]);
	var year1=arrDate1[2];
	var month1=arrDate1[1];
	var day1=arrDate1[0];
	var year2=arrDate2[2];
	var month2=arrDate2[1];
	var day2=arrDate2[0];
	if(year1>year2){
		point1++;
	}else if(year1<year2){
		point2++;
	}else{
		point1++;point2++;
	}
	if(month1>month2 && point1>0) {
		point1++;
	}else if(month1<month2 && point2>0){
		point2++;
	}else {
		point1++;point2++;
	}if(day1>day2 && point1>1){
		point1++;
	}else if(day1<day2 && point2>1){
		point2++;
	}else {
		point1++;point2++;
	}
	if(point1>point2) return 0;
	else if(point1<=point2 ) return 1;
}
function isValidURLParse(url){
	var filterurl = /^[-a-zA-Z0-9@:%_\+.~#?&//=]+$/;
	if (filterurl.test(url)){ return true; }else{ return false; }
}
function delete_confirm(url, msg){ if(!confirm(msg)) return; window.location = url; }

function addteacher(){
	var id = parseInt($('hidTeachers').value)+1;
	var porow = document.createElement('div');
	var clear = document.createElement('div');
	clear.addClassName('clear_both');
	porow.addClassName('teachersTextBox');
	var teacher = new Element('input', { 'type':"text", 'id':"txtTeacher_"+id, 'name':"txtTeacher_"+id, 'class':"input_box",  'onkeyup':"javascript:this.value=this.value.toUpperCase();" });
	var phone = new Element('input', { 'type':"text", 'id':"txtPhone_"+id, 'name':"txtPhone_"+id, 'class':"input_box", 'maxlength':"11", 'onkeypress':"javascript:return numbersonly(this, event, false);" });
	var phone1 = new Element('label', { 'id':"txtPhone1_"+id });
	phone1.innerHTML = '&nbsp;&nbsp;&nbsp;Phone : ';
	porow.appendChild(teacher);
	porow.appendChild(phone1);
	porow.appendChild(phone);
	$("teachersRow").appendChild(clear);
	$("teachersRow").appendChild(porow);
	$('hidTeachers').value	=	id;
}

function addTotal()
{
	var total	=	0;
	if(trim($('txtTotalLP').value) != '')
		total+=parseInt($('txtTotalLP').value*1); 
	if(trim($('txtTotalUP').value) != '')
		total+=parseInt($('txtTotalUP').value*1);
	if(trim($('txtTotalHS').value) != '')
		total+=parseInt($('txtTotalHS').value*1) ; 
	if(trim($('txtTotalHSS').value) != '')
		total+=parseInt($('txtTotalHSS').value*1) ; 
	if(trim($('txtTotalVHSS').value) != '')
		total+=parseInt($('txtTotalVHSS').value*1);
	$('txtTotal').value	= total;
}


function numbersonly(myfield, e, dec){ 
		var key;
		var keychar;
		
		if (window.event)
			 key = window.event.keyCode;
		else if (e)
			 key = e.which;
		else
			 return true;
		keychar = String.fromCharCode(key);
		
		var val = myfield.value;
		if(val && keychar == '.'){
			if(val.split(".").length > 1){
				return false;
			}
		}
		
		// control keys
		if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
			 return true;
		
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
			 return true;
		
		// decimal point jump
		else if ((dec) && (keychar == "."))
			 {
			 //myfield.form.elements[dec].focus();
			 return true;
			 }
		else
			 return false;
}
function dummy_change_text_max_to_focus(frm_txt,to_txt,obj)
{
	
	var one = String(obj.value).charAt(0);
	if(one == 1 ) {
			max_chr = 4;			
		}
	else {
			max_chr =   3;
	}
	if ($(frm_txt).value.length >= max_chr)
	{
		obj.onblur();
		//$(to_txt).focus(); 
	}
}	
function change_text_max_to_focus(frm_txt,to_txt,obj)
{
	        var one = String(obj.value).charAt(0);
        if(one == 1 && $('txtClass').value > 10 ) {
				max_chr = 4;				
			}
        else {
		        max_chr =   3;
		}
	if ($(frm_txt).value.length >= max_chr)
	{
		$(to_txt).focus();
	}
}

function change_text_max_to_focus_jump(frm_txt,to_txt,max_chr)
{
	if ($(frm_txt).value.length >= max_chr)
	{
		$(to_txt).focus();
	}
}

function fetch_school_details()
{	
	var school_code	=	$('txtSchoolCode').value;
	ajax_loder2('divSchoolCode');
	var oOptions = {
		method: "post",
		parameters: { 'code': school_code},
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
	}, path+"schools/registration/get_school_details", oOptions);	
}


function fetch_special_order_school_details()
{
	var school_code	=	$('txtSchoolCode').value;
	ajax_loder2('divSchoolCode');
	var oOptions = {
		method: "post",
		parameters: { 'code': school_code},
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
	}, path+"schools/special_order_entry/get_school_details", oOptions);	
}


function fetch_item_code_details()
{
	
	if($('chkAddParticipant').checked == true && $('editEntry').style.display	!=	'block')
	{
		var item_code	=	$('txtItemCode_1').value;

		var sch_code	=	$('txtSchoolCode').value;
				//alert("--"+sch_code);
		//ajax_loder2('divSchoolCode');
		var oOptions = {
		method: "post",
		parameters: { 'code': item_code,'sch_code': sch_code},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
			
		   var response = transport.responseText;
		   $('newEntry').innerHTML = response;
		}
		};
		
		var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
		}, path+"schools/special_order_entry/get_itemcode_details", oOptions);	
	}
		
	
	
	/*
	
		
		var item_code	=	$('txtItemCode_1').value;
		var sch_code	=	$('txtSchoolCode').value;
		//ajax_loder2('divItemCode');
		var oOptions = {
			method: "post",
			parameters: { 'code': item_code, 'sch_code': sch_code},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $('newEntry').innerHTML = response;
		   }
		};
		alert("hiii"+path+"schools/special_order_entry/get_itemcode_details--");
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
			
		}, path+"schools/special_order_entry/get_itemcode_details", oOptions);	
				*/
		
	
}



function fncCheckSchoolDeatils(){
	if (!isValidEmail($('txtSchoolEmail').value) && $('txtSchoolEmail').value != '')
	{
		alert('Please Enter a Valid E-mail!!');
		$('txtSchoolEmail').focus();
		return false;
		
	}
	
	
	if((parseInt($('txtStandardFrom').value) > parseInt($('txtStandardTo').value)) || (parseInt($('txtStandardFrom').value) == 0  ||  parseInt($('txtStandardTo').value) == 0)){
		alert('Please select valid standards');
		$('txtStandardFrom').focus();
		return false;
	}
	if (check_div('LP')){
		if($('txtTotalLP').value == '' || trim($('txtTotalLP').value) <= 0){
			alert('Please enter number of LP students');
			$('txtTotalLP').focus();
			return false;
		} 
	}else{
		if(trim($('txtTotalLP').value) != '' && trim($('txtTotalLP').value) != 0 ){
			alert('You are not selected LP standards. Please clear the number of LP students');
			$('txtTotalLP').focus();
			return false;
		} 
	}
	if (check_div('UP')){
		if($('txtTotalUP').value == '' || trim($('txtTotalUP').value) <= 0){
			alert('Please enter number of UP students');
			$('txtTotalUP').focus();
			return false;
		} 
	}else{
		if(trim($('txtTotalUP').value) != ''  && trim($('txtTotalUP').value) != 0){
			alert('You are not selected UP standards. Please clear the number of UP students');
			$('txtTotalUP').focus();
			return false;
		} 
	}
	
	if (check_div('HS')){
		if($('txtTotalHS').value == '' || trim($('txtTotalHS').value) <= 0){
			alert('Please enter number of HS students');
			$('txtTotalHS').focus();
			return false;
		} 
	}else{
		if(trim($('txtTotalHS').value) != ''  && trim($('txtTotalHS').value) != 0){
			alert('You are not selected HS standards. Please clear the number of HS students');
			$('txtTotalHS').focus();
			return false;
		} 
	}
	
	if (check_div('HSS')){
		if($('txtTotalHSS').value == '' || trim($('txtTotalHSS').value) <= 0){
			if($('txtTotalVHSS').value == '' || trim($('txtTotalVHSS').value) <= 0){
				alert('Please enter number of HSS or VHSS students');
				$('txtTotalHSS').focus();
				return false;
			}
		} 
	}else{
		if((trim($('txtTotalHSS').value) != '' || trim($('txtTotalVHSS').value) != '') && (trim($('txtTotalHSS').value) != 0 || trim($('txtTotalVHSS').value) != 0)){
			alert('You are not selected HSS or VHSS standards. Please clear the number of HSS or VHSS students');
			$('txtTotalHSS').focus();
			return false;
		} 
	}
	if (trim($('txtPrincipal').value) == '' && trim($('txtHeadmaster').value) == '')
	{
		alert('Please enter Principal/Headmaster');	
		$('txtPrincipal').focus();
		return false;
	}
	if (trim($('txtPrincipal').value) != '' && trim($('txtPrincipalPhone').value) == '')
	{
		alert('Please enter Principal Phone number');
		$('txtPrincipalPhone').focus();
		return false;
	}
	if (trim($('txtHeadmaster').value) != '' && trim($('txtHeadmasterPhone').value) == '')
	{
		alert('Please enter Headmaster Phone number');	
		$('txtHeadmasterPhone').focus();
		return false;
	}
	var name	=	'';
	var phone	=	'';
	var phone_con	=	false;
	var name_con	=	false;
	for(var j = 1; j<= $('hidTeachers').value; j++){
		name	=	'txtTeacher_'+j;
		phone	=	'txtPhone_'+j;
		if(trim($(name).value) != ''){
			name_con = true;
		}
		if(trim($(phone).value) != ''){
			if(trim($(name).value) == '')
			{
				alert('Please enter the Team Manager name');
				$(name).focus();
				return false;	
			}
			phone_con = true;
			/*else if(trim($(phone).value) == '')
			{
				alert('Please enter the Team Manager phone');
				$(phone).focus();
				return false;	
			}*/
		}
		
	}
	if (!name_con)
	{
		alert('Please enter atleast one Team Manager');
		$('txtTeacher_1').focus();
		return false;
	}
	if (!phone_con)
	{
		alert('Please enter atleast one Team Manager phone');
		$('txtPhone_1').focus();
		return false;
	}
	$('formSchool').submit();
}

function check_div(std)
{
	if(std == 'LP'){
		if( $('txtStandardFrom').value == 1){
			return true;
		} else {
			return false;
		}
	}
	
	if(std == 'UP'){
		if( $('txtStandardTo').value > 4 && $('txtStandardFrom').value <= 5){
			return true;
		} else {
			return false;
		}
	}
	if(std == 'HS'){
		if( $('txtStandardTo').value > 7 && $('txtStandardFrom').value <= 8){
			return true;
		} else {
			return false;
		}
	}
	if(std == 'HSS'){
		if( $('txtStandardTo').value > 10){
			return true;
		} else {
			return false;
		}
	}
}

function fncEditSchoolDeatils(){
	$('formSchool').action = path+'schools/registration/edit_school_details';
	$('formSchool').submit();
}

function fncSaveParticipant(){
	if(trim($('txtADNO').value) == ''){
		alert('Please enter the admission number');
		$('txtADNO').focus();
		return false;
	}
	var admn_no		=	trim($('txtADNO').value);
	if (trim($('txtClass').value) > 10)
	{
		var hss_vhse_chr	=	trim($('txtADNO').value).substring(0,1);	
		if ( !( (hss_vhse_chr == 'V' && $('hidVHSSNo').value > 0) || (hss_vhse_chr == 'H' &&  $('hidHSSNo').value > 0) ) )
		{
			alert('Invalid admission number');	
			$('txtADNO').focus();
			return false;
		}
		admn_no		=	trim($('txtADNO').value).substring(1);
	}
	
	if (isNaN(admn_no))
	{
		alert('Invalid admission number');	
		$('txtADNO').focus();
		return false;	
	}
	
	if(trim($('txtParticipantName').value) == ''){
		alert('Please enter the participant name');
		$('txtParticipantName').focus();
		return false;
	}
	var items	=	0;
	var fieldId	=	'';
	for(var i=1; i<=10; i++){
		fieldId = 'txtItemCode_'+i;
		if(trim($(fieldId).value) != ''){
			items++;
		}
	}
	var pinnani=0;
	for(var i=1; i<=5; i++){
		pinnanyId='txtPinnanyCode_'+i;
		if(trim($(pinnanyId).value) != ''){
			pinnani++;
		}
	}
	
	if((items == 0)&&(pinnani==0)){
		alert('Please enter the item code');
		$('txtItemCode_1').focus();
		return false;
	}
	$('formParticipant').submit();
}

function editParticipant(adno) {
	$('hidADNO').value = adno;
	$('formParticipant').action = path+'schools/registration/edit_participant_detials';
	$('formParticipant').submit();
}

function deleteParticipant(adno) {
	if(!confirm('Do you really want to delete the participant?')){
		return false;
	}
	$('hidADNO').value = adno;
	$('formParticipant').action = path+'schools/registration/delete_participant_detials';
	$('formParticipant').submit();
}

function fncCancelParticipant() {
	$('formParticipant').action = path+'schools/registration';
	$('formParticipant').submit();
}

function fncUpdateParticipant(adno) {
	if(trim($('txtADNO').value) == ''){
		alert('Please enter the admission number');
		$('txtADNO').focus();
		return false;
	}
	
	var admn_no		=	trim($('txtADNO').value);
	if (trim($('txtClass').value) > 10)
	{
		var hss_vhse_chr	=	trim($('txtADNO').value).substring(0,1);	
		if ( !( (hss_vhse_chr == 'V' && $('hidVHSSNo').value > 0) || (hss_vhse_chr == 'H' &&  $('hidHSSNo').value > 0) ) )
		{
			alert('Invalid admission number');	
			$('txtADNO').focus();
			return false;
		}
		admn_no		=	trim($('txtADNO').value).substring(1);
	}
	
	
	
	if (isNaN(admn_no))
	{
		alert('Invalid admission number');	
		$('txtADNO').focus();
		return false;	
	}
	
	if(trim($('txtParticipantName').value) == ''){
		alert('Please enter the participant name');
		$('txtParticipantName').focus();
		return false;
	}
	
	if(trim($('txtItemCode_1').value) == ''){
		alert('Please enter the item code');
		$('txtItemCode_1').focus();
		return false;
	}
	
	/*var items	=	0;
	var fieldId	=	'';
	for(var i=1; i<=10; i++){
		fieldId = 'txtItemCode_'+i;
		if(trim($(fieldId).value) != ''){
			items++;
		}
	}*/
	//alert("entereddd");
	/*var pinnani=0;
	for(var i=1; i<=5; i++){
		pinnanyId='txtPinnanyCode_'+i;
		if(trim($(pinnanyId).value) != ''){
			pinnani++;
		}
	}
	
	if((items == 0)&&(pinnani==0)){
		alert('Please enter the item code');
		$('txtItemCode_1').focus();
		return false;
	}*/
	
	
	$('hidADNO').value = adno;
	$('formParticipant').action = path+'schools/registration/update_participant_detials';
	$('formParticipant').submit();
}
function fnschgpwdAdd(){
	
	if($('txtOLDPassword').value==""){
	 alert("please enter current password");
	 $('txtOLDPassword').focus();
	 return false;
	 }
	
	 if($('txtNewPassword').value==""){
		 alert("please enter password");
		 $('txtNewPassword').focus();
		 return false;
	 }
	 if($('txtCFMPassword').value==""){
		 alert("please Re-Type your password");
		 $('txtCFMPassword').focus();
		 return false;
	 }
	 if(($('txtNewPassword').value)!=($('txtCFMPassword').value)){
		 alert("Your reentered  password is not correct");
		 $('txtCFMPassword').focus();
		 return false;
	 }
	 
	 if(($('txtOLDPassword').value)==($('txtNewPassword').value))
	 {
		 alert("Old Password and New Password are Same!!! Please enter a new one");
		 $('txtNewPassword').focus();
		 return false;
	 }
	
	  if($('Name').value==""){
		 alert("please enter Your Name");
		 $('Name').focus();
		 return false;
	 }
	 if($('Mobile_Number').value==""){
		 alert("please enter Your Mobile Number or Contact Number");
		 $('Mobile_Number').focus();
		 return false;
	 }
	  if($('Email_id').value==""){
		 alert("please enter your email  id ");
		 $('Email_id').focus();
		 return false;
	 }
	 else{ var email=($('Email_id').value);
		 var rt=isValidEmail(email);
		 if(rt==false) { 
		 alert("please enter a valid  email id ");
		 return false; 
		 }
		 else {
			 return true;
		 }
		 
	 }
	 
 }
 
 function gotohome()
 {
	$('formPWD').action = path;
	$('formPWD').submit(); 
 }
 
 function confirm_school_data()
 {
 	if (confirm("Do you want to confirm school entry details? \nOnce confirmed the entry details cannot be modified!!"))
	{
		$('formFinalize').action = path+'schools/registration/finalize_data';
		$('formFinalize').submit();
	}
	else
	{
		return false;
	}
	
 }
 function create_csv_school_data()
 {
 	$('formFinalize').action = path+'schools/registration/create_csv_generation';
	$('formFinalize').submit();
	$('formFinalize').action = path+'schools/registration/finalize_data';
 }
 function create_school_report()
 {
 	$('formFinalize').action = path+'schools/registration_report/';
	$('formFinalize').target = '_blank';
	$('formFinalize').submit();
	$('formFinalize').target = '_self';
 }
 
function add_special_order_participant ()
{
	if($('chkAddParticipant').checked == true){
		$('newEntry').style.display		=	'block';
		$('cmbParticipant').value		=	'0';
		$('cmbParticipant').disabled	=	true;
		$('chkIsPinnany').disabled 		= true;
		if($('txtItemCode_1').value		!=	'')
			fetch_item_code_details();
		
		//$('cmbParticipant').style.display	=	'none';
	} else {
		$('newEntry').style.display		=	'none';
		$('cmbParticipant').disabled	=	false;
		$('chkIsPinnany').disabled 		= 	false;
		$('divCapPin').style.visibility = 'visible';
		//$('cmbParticipant').style.display	=	'block';
	}
}


function fncSaveSpecialOrderParticipant ()
{
	if(trim($('cmbOrder').value) == '0'){
		alert('Please select the order type');
		$('cmbOrder').focus();
		return false;
	}
	//alert($('txtItemCode_1').value);
	if(trim($('txtItemCode_1').value) == ''){
		alert('Please enter the item code');
		$('txtItemCode_1').focus();
		return false;
	}
	
	if($('chkAddParticipant').checked == false){		
		if(trim($('cmbParticipant').value) == '0'){
			alert('Please select the participant');
			$('cmbParticipant').focus();
			return false;
		}
	}
	
	else {
			if(trim($('item_type').value) == 'G'){
				if(trim($('txtCaptionAdNo').value) == ''){
				alert('Please type the captain admission number');
				$('txtCaptionAdNo').focus();
				return false;
				}
	        }	
	}	
	
	/*if($('chkAddParticipant').checked == true){
		if(trim($('txtADNO1').value) != '') && ($('txtADNO1').value != $('txtCaptionAdNo').value))
		{
			alert('Please enter the admission number');
			$('txtADNO').focus();
			return false;
		}
		if(trim($('txtParticipantName').value) == ''){
			alert('Please enter the participant name');
			$('txtParticipantName').focus();
			return false;
		}
	}*/
	
	/*else{
		if(trim($('cmbParticipant').value) == '0'){
			alert('Please select the participant');
			$('cmbParticipant').focus();
			return false;
		}	
	}
	if(trim($('txtItemCode_1').value) == ''){
		alert('Please enter the item code');
		$('txtItemCode_1').focus();
		return false;
	}
	
	if($('chkAddParticipant').checked == true){
		if(trim($('txtADNO').value) == ''){
			alert('Please enter the admission number');
			$('txtADNO').focus();
			return false;
		}
	}*/
	//alert("yesssssss");
	$('formParticipant').submit();
}

function editSpecialOrderParticipant (adno,admn_no) {
	//alert("hii"+$('editEntry').style.display);
	alert("yess");
	$('hidPiId').value = adno;
		
	regno		=	admn_no;
	scholCode	=	$('hidSchoolId').value;	
		
	
  	fileName	=	scholCode+"_"+regno;
	//alert("hii"+fileName);
	var oOptions = {
		method: "post",
		parameters: { 'fileName': fileName},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
		   var response = transport.responseText;
		   
		   $(edit_photo_div).innerHTML = response;
	   }
	};
	var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
	}, path+"schools/special_order_entry/get_parti_photo",oOptions);	
    
	$('editEntry').style.display		=	'block';
	//alert("hii"+$('editEntry').style.display);
	$('formParticipant').action = path+'schools/special_order_entry/edit_participant_detials';
	$('formParticipant').submit();
}

function deleteSpecialOrderParticipant(adno, itemcode) {
	if(!confirm('Do you really want to delete the participant?')){
		return false;
	}
	$('hidADNO').value = adno;
	$('hidItemId').value = itemcode;
	$('formParticipant').action = path+'schools/special_order_entry/delete_participant_detials';
	$('formParticipant').submit();
}

function fncCancelSpecialOrderParticipant () {
	$('formParticipant').action = path+'schools/special_order_entry/';
	$('formParticipant').submit();	
}

function fncShowHideStd () {
	if(check_div('LP')){
		$('divLP').style.display	=	'block';
	} else {
		$('divLP').style.display	=	'none';
		$('txtTotalLP').value	=	0;
	}
	if(check_div('UP')){
		$('divUP').style.display	=	'block';
	} else {
		$('divUP').style.display	=	'none';
		$('txtTotalUP').value	=	0;
	}
	if(check_div('HS')){
		$('divHS').style.display	=	'block';
	} else {
		$('divHS').style.display	=	'none';
		$('txtTotalHS').value	=	0;
	}
	if(check_div('HSS')){
		$('divHSS').style.display	=	'block';
		$('divVHSC').style.display	=	'block';
	} else {
		$('divHSS').style.display	=	'none';
		$('divVHSC').style.display	=	'none';
		$('txtTotalHSS').value	=	0;
		$('txtTotalVHSS').value	=	0;
	}
	addTotal();
}

function goschooldet(shid) {
	$('hidSchoolId').value = shid;
	$('clustschool').action = path+'schools/registration/';
	$('clustschool').submit();
}

function fncShowClusterSchools(shid) {
	$('hidClusterId').value = shid;
	$('clustschool').action = path+'welcome/cluster_schools/';
	$('clustschool').submit();
}

function fncConfirnSubDistAdmin()
{
	if (confirm("Do you want to confirm? \nOnce confirmed the entry details cannot be modified or add any school!!"))
	{
		$('confirm_sub_dist').action = path+'welcome/confirm_sub_dist_schools';
		$('confirm_sub_dist').submit();
	}
	else
	{
		return false;
	}	
}
function printContent(element_id)
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
function fnc_change_confirmation_status (message, school_code, element_id)
{
	message = 'Do you really want to reset the confirmation status of '+message;
	if (confirm(message))
	{
		ajax_loder2(element_id);
		var oOptions = {
			method: "post",
			parameters: { 'school_code': school_code},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   $(element_id).innerHTML = response;
			   $(element_id+'_dis').innerHTML = '';
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"ajax/loadajax/change_confirmation_status", oOptions);
	}
}
function fetch_admision_no_details() {
	
	regno		=	$('txtADNO').value;
	scholCode	=	$('hidSchoolId').value;
  	fileName	=	scholCode+"_"+regno;

	var oOptions = {
		method: "post",
		parameters: { 'fileName': fileName},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
		   var response = transport.responseText;
		   
		   $('photo_div').innerHTML = response;
	   }
	};
	var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
	}, path+"schools/special_order_entry/get_parti_photo",oOptions);	


	if (window.XMLHttpRequest) 
	{    
      req = new XMLHttpRequest();    
	}    
	else if (window.ActiveXObject) 
	{    
      req = new ActiveXObject("Microsoft.XMLHTTP");    
	}    
	req.open('GET', docpath+'/'+fileName+".txt");

	req.onreadystatechange = function()
	{  
		  if (req.readyState == 4) 
		{    
			 var str=req.responseText;	
			 var strArray=str.split("\n");		 
			 var len	=	strArray[1].length;
			 if(len < 3)
			 {
				 $("txtParticipantName").value		=	strArray[0];
				 $("txtClass").value				=	parseInt(strArray[1]);
				 $("txtGender").value				=	strArray[2];
			 }	 
		} 
	}
	req.send("");
	
}


function fetch_admision_no_details_array(val)
{	
	
	regno		=	$('txtADNO'+val).value;
	scholCode	=	$('hidSchoolId').value;	
	photo_div	=	'photo_div'+val;
	
	
  	fileName	=	scholCode+"_"+regno;

	var oOptions = {
		method: "post",
		parameters: { 'fileName': fileName},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
		   var response = transport.responseText;
		   
		   $(photo_div).innerHTML = response;
	   }
	};
	var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
	}, path+"schools/special_order_entry/get_parti_photo",oOptions);	


	if (window.XMLHttpRequest) 
	{    
      req = new XMLHttpRequest();    
	}    
	else if (window.ActiveXObject) 
	{    
      req = new ActiveXObject("Microsoft.XMLHTTP");    
	}    
	
	req.open('GET', docpath+'/student/'+fileName+".txt");

	req.onreadystatechange = function()
	{  
		  if (req.readyState == 4) 
		{    
			 var str=req.responseText;	
			 var strArray=str.split("\n");		 
			 var len	=	strArray[1].length;
			 if(len < 3)
			 {
				 $("txtParticipantName"+val).value		=	strArray[0];
				 $("txtClass"+val).value				=	parseInt(strArray[1]);
				 $("txtGender"+val).value				=	strArray[2];
			 }	 
		} 
	}
	
	req.send("");	
}

