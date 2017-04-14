<!--
Description: Creates a random account number and uses the information from signup.php to attach a member to it. That member is marked as the primary user.
Author: Brandin Jefferson
CLID: bej0843
-->
<html>
<style type = "text/css">

.header{
     height: 75px;
     background: #0099CC;
     border:1px solid #CCC;
  position: fixed;
    width: 100%;
    top: 0px;
     margin: 0px auto;
     



}

body {
    color: black;
}

co {
    color: #FFFFFF;
}

button, button, button,.button, input[type=submit] {
  border: 0;
  background: #6633CC;
  color: white;
  padding: 8px 14px;
  font-weight: bold;
  font-size: 18px;
  text-decoration: none;
  display: inline-block;
  /* needed for anchors */
  position: relative;
  box-shadow: 1px 0px #3a587f, 0px 1px #4171ae, 2px 1px #3a587f, 1px 2px #4171ae, 3px 2px #3a587f, 2px 3px #4171ae, 4px 3px #3a587f, 3px 4px #4171ae, 5px 4px #3a587f, 4px 5px #4171ae, 6px 5px #3a587f, 5px 6px #4171ae;
}
button:hover, button:focus, button.hover, button.focus, .button:hover, .button:focus, .button.hover, .button.focus, input[type=submit]:hover, input[type=submit]:focus, input[type=submit].hover, input[type=submit].focus {
  transform: translate(2px, 2px);
  box-shadow: 1px 0px #3a587f, 0px 1px #4171ae, 2px 1px #3a587f, 1px 2px #4171ae, 3px 2px #3a587f, 2px 3px #4171ae, 4px 3px #3a587f, 3px 4px #4171ae;
}
button:active, button.active, .button:active, .button.active, input[type=submit]:active, input[type=submit].active {
  transform: translate(4px, 4px);
  box-shadow: 1px 0px #3a587f, 0px 1px #4171ae, 2px 1px #3a587f, 1px 2px #4171ae;
}



body{
  background: #E0E0E0; 
  font-family:'Open Sans',sans-serif;
}

</style>
<head><title>New Wave Cinema: Account Information</title>
</head>
<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
//Setup variables
$host = "";
$user = "groupE";
$password = "cmps460";
$database = "cs4601_groupE";

//Get Variables from signup.html
$mmbrName = $_POST['mmbrName'];
$mmbrAge = $_POST['mmbrAge'];
$mmbrAddr = $_POST['mmbrAddr'];
$mmbrPhone = $_POST['mmbrPhone'];
$mmbrEmail = $_POST['mmbrEmail'];
$mmbrPass = $_POST['mmbrPass'];
$mmbrLength = $_POST['mmbrLength'];
$mmbrPrice = intval(substr($mmbrLength,0,3));

//connect to database
$connect = mysql_connect($host,$user,$password)
	 or die("Unable to connect to database");
@mysql_select_db($database) or die("Unable to select database");

//Create new account number
function generateAccount(){
	$characters = '0123456789';
	$char_len = strlen($characters);
	$acct = '';
	for ($i =0;$i<9;$i++){
		$acct .= $characters[rand(0,$char_len-1)]; 
	}
	return $acct;
}
$mmbrAcct = generateAccount();
$query = 'SELECT account_no
			FROM nwc_membership
			WHERE account_no = $mmbrAcct';
$acctCheck = mysql_query($query);

if ($acctCheck){
    	while (mysql_num_rows($acctCheck) > 0){
    	$mmbrAcct = generateAccount();
    	$acctCheck = mysql_query($query);
    	if (!$acctCheck){
    		break;
    	}
    }
}


//Get start(current) date and expiration date
$start_date = date('Y-m-d');
$expire_date = date('Y-m-d',strtotime('+'. $mmbrLength));

//Add account to database
$query = "INSERT INTO nwc_membership (account_no,start_date,expire_date)
			values('$mmbrAcct','$start_date','$expire_date')";
$exec_query1 = mysql_query($query);

//Add member to database and attach to account
$query = "INSERT INTO nwc_member (mb_name,account_no,phone_no,email,age,addr,main_mb,password)
			values('$mmbrName', '$mmbrAcct',$mmbrPhone,'$mmbrEmail',$mmbrAge,'$mmbrAddr',1,'$mmbrPass')";
if (!empty($mmbrPass) && !empty($mmbrName)){
    $exec_query2 = mysql_query($query);
}
else $exec_query2 = false;

//Send email containing account information.
/*$subject = "New Wave Cinema Account Information";
$msg = "
<html><head>
<title>Account Information</title>
</head>
<body>
<p>Thank you for registering with the New Wave Cinema!<br>
Your account information is listed below.<br><br> </p>
<table>
<tr>
<th>Account Number</th>
<th>Password</th>
<th>Expiration Date</th>
<th>Price</th>
</tr>
<tr>
<td>$mmbrAcct</td>
<td>$mmbrPass</td>
<td>$expire_date</td>
<td>$mmbrPrice</td>
<td>
</tr></table>
</body></html>
";

$headers = "MIME-Version: 1.0" . "\r\n" . "Content-type:text/html;charset=UTF-8" . "\r\n";
//See if you can use a fake email for immersion.
$headers .= "From: brandinui@gmail.com" . "\r\n";
mail($mmbrEmail,$subject,$msg,$headers);*/

//Final information
if ($exec_query1 && $exec_query2){
	print("Account successfully created.<br>");
	print("Your credentials have been sent to the e-mail you provided. <br>");
	print("Account Number: $mmbrAcct <br>");
	print("User Name: $mmbrName <br>");
	print("Password: $mmbrPass <br> <br>");
	print("$mmbrName is the primary user for this account.<br>");
	print("Please keep track of these, as they are required in order to use our services.<br><br>");
	//print('<input type="button" value="Log In" onclick="location.href=' . "'UserIndex.php'" . '">');
	print("<a href='UserIndex.php' class='button'>Log In</a>");
}
else {
	print("There was an error creating your information. Please ensure you've filled everything out.<br><br>");
	//print("<input type='button' value='Back' onclick='javascript:history.back()'>");
	print("<a href='javascript:history.back()' class='button'>Back</a>");
}
mysql_close($connect);
?>

</body></html>
