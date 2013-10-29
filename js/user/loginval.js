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
	/*if(document.getElementById('userType').value==0)
	{
		alert("select User type");
		document.getElementById('userType').focus();
		return false;
	}*/
	return true;
	
}

function deleteUser(userId) {
	if(!confirm('Really want to delete the user?')){
		return false;
	}
	$('UserIdty').value = userId;
	$('editUser').action = path+'user/user_registration/delete_user_detials';
	$('editUser').submit();
}

function editUser(userId) {
	$('UserIdty').value = userId;
	$('editUser').action = path+'user/user_registration/edit_user_detials';
	$('editUser').submit();
}

function fnsUserUpdate(userId){
	$('hidUserId').value = userId;
	$('formUser').action = path+'user/user_registration/update_user_detials';
	$('formUser').submit();
}

function cancel()
{
	$('formUser').action = path+'user/user_registration/';
	$('formUser').submit();
}