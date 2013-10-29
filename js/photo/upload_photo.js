// JavaScript Document
function fetch_studdetails()
{
		//alert("kiiiiii");
		//var festid	=	$('txtSchoolCode').value;
		if(document.getElementById('txtSchoolCode').value == '')
		{
			alert("Please enter the School Code");
			document.getElementById('txtSchoolCode').focus();
			return false;				
		}
		if(document.getElementById('txtRegNum').value == '')
		{
			alert("Please enter the Register Number");
			document.getElementById('txtRegNum').focus();
			return false;				
		}		
		else
		{
			//var regno		=	document.getElementById('txtRegNum').value;
			var baseUrl		=	document.getElementById('baseurl').value;
			document.getElementById('formreg_photo').action	=baseUrl+"photos/photos/regnum_wise_photo_interface";
			document.getElementById('formreg_photo').submit();
		}

}

function check_upload()
{
	//alert("hiii");
	if(document.formreg_photo.userfile.value == '')
	{
		alert("Please select the file");
		document.formreg_photo.userfile.focus();
		return false;		
	}
	
}

function check_upload_schoolwise()
{	
	var sum	=	document.formschool_photo.hidtot.value;
	//alert("summmmm"+sum);
	var flag = 0;
	for(i=1;i<=sum;i++)
	{
		//alert("val->"+i+document.getElementById('userfile'+i).value);
		if(document.getElementById('userfile'+i).value != '')
		{
		   flag	=	1; break;  
		}		
	}
	
	if(flag == 0)
	{
		alert("Please select any file");
		return false;		
	}
	
}


function fetch_schoolwise_studdetails()
{
		//alert("hiiiiii");
		//var festid	=	$('txtSchoolCode').value;
		if(document.getElementById('txtSchoolCode').value == '')
		{
			alert("Please enter the School Code");
			document.getElementById('txtSchoolCode').focus();
			return false;				
		}
		
		else
		{			
			var baseUrl		=	document.getElementById('baseurl').value;
			document.getElementById('formschool_photo').action	=baseUrl+"photos/photos/school_wise_photo_interface";
			document.getElementById('formschool_photo').submit();
		}

}

