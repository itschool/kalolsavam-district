// JavaScript Document
function fncAddCluster()
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
	return true;
	
}

function deleteUser(userId) {
	if(!confirm('Really want to delete the user?')){
		return false;
	}
	$('UserIdty').value = userId;
	$('editUser').action = path+'user/user_cluster/delete_user_cluster';
	$('editUser').submit();
}

function editUser(userId) {
	$('UserIdty').value = userId;
	$('editUser').action = path+'user/user_cluster/edit_user_cluster';
	$('editUser').submit();
}

function fncUpdateCluster(userId){
	$('hidUserId').value = userId;
	$('formUser').action = path+'user/user_cluster/update_user_cluster';
	$('formUser').submit();
}

function cancel()
{
	$('formUser').action = path+'user/admin_users/';
	$('formUser').submit();
}
function cancel_cluster()
{
	$('formUser').action = path+'user/user_cluster/';
	$('formUser').submit();
}



