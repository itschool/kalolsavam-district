<?php
// db properties
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass ='itschool';
$dbname = 'kalolsavam_2013';

$conn = mysql_connect ($dbhost, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ($dbname);


$i=0;
$Q			=	"SELECT *
FROM participant_details
WHERE class > 4 AND (
sub_district_code =372
OR sub_district_code =373
OR sub_district_code =374
OR sub_district_code =375
OR sub_district_code =376
OR sub_district_code =382
OR sub_district_code =383
OR sub_district_code =384
OR sub_district_code =385
OR sub_district_code =386
OR sub_district_code =387
)
ORDER BY school_code";
print $Q;
$query1			=	mysql_query($Q);
while($result	=	mysql_fetch_array($query1)){
	$i++;
	$schoolCode	=	$result['school_code'];
	$admno		=	$result['admn_no'];
	$name		=	$result['participant_name'];
	$class		=	$result['class'];
	$gender		=	$result['gender'];

	$myFile = "student/".$schoolCode."_".$admno.".txt";

	$fh = fopen($myFile, 'w') or die("can't open file");

	$stringData =	$name."\n".$class."\n".$gender."\n";

	fwrite($fh, $stringData);
	fclose($fh);


	echo "<br>".$i." - file write sucessfull : <br> Name : $myFile <br>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
