<!----------------------------------------------------------------------------------
	Author: Issa Samake
	Date:April 27th,2015
	Certificate of Authenticity: 
	I (Issa) certify that this php script is entirely my own work.
------------------------------------------------------------------------------------>
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
table td, table th {
    font-size: 1em;
    border: 2px solid #7575FF;
    padding: 3px 7px 2px 7px;
}

table th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #751975;
    color: #ffffff;
}

table tr.alt td {
    color: #ffffff;
    background-color: #000000;
}
</style>



<head><title>Movie Reservation</title></head>
<form action="loggout.php">
    <input type="submit" value="Log Out" align = right>
</form> 
<?php
//Resume the session
session_start();

include('sessioncore.php');

//Connect to the database
include('connecttophp.php');

if (!loggedin()){
	header("Location: UserIndex.php");
}
if (isValidUser()){

	$host="";
	$user="groupE";
	$password="cmps460";
	$database="cs4601_groupE";
	$table_name="acct";
	$connect = mysql_connect($host,$user,$password)
		 or die("Unable to connect to database");
	// Select the database - the @ supresses MySQL error output
	@mysql_select_db($database) or die("Unable to select database");
	session_start();
	$mb_name = $_SESSION['user_name'];
	$account_no =$_SESSION['account_no'];
	
	//$choice1 = $_POST['chair'];
	$choice = $_POST['seats'];
	
	//print "choice: $choice.<br>";
	//echo $choice."<br>";

	//the explode function split $choice string into an array of strings stored in $info
	$info = explode('|',$choice);
	//Initialize global variables
	$row = $info[0];
	$column = $info[1];
	$theater = $info[2];
	$complex = $info[3];
	$datestring = $info[5];
	$time = $info[4];
	$free_seats = $info[6];
	$movie =$info[7];
	list($y,$m,$d)=explode("-",$datestring);
	echo "the date is ".$datestring.'<br>';
	$date=mktime(0,0,0,$m,$d,$y);
	//echo "Date is:".$date."<br>";
	//echo date("Y-m-d h:i:sa", $date);
//$query 1 returns the count of numbers of members of a specific account who reserved
//for a specific showing
$query1 = "select count(*) from nwc_reserved where 
	mb_name = '$mb_name'
	and account_no = '$account_no'
	and t_id = '$theater'
	and complex_name = '$complex'
	and time = '$time'
	and day = '$datestring';";
//query 2 returns the number of member for that particular account number
$query2 ="select count(*) from nwc_member where account_no = '$account_no';";

//query3 returns the number of member for that particular account who reserved a seat for that particular showing
$query3 = "select count(*) from nwc_reserved 
	where account_no = '$account_no'
	and t_id = '$theater'
	and complex_name = '$complex'
	and time = '$time'
	and day = '$datestring';";

//query 4 returns member age
$query4 = "select age from nwc_member where account_no = '$account_no' and mb_name = '$mb_name';";

//query5 returns the rating of the movie
$query5 = "select rating from nwc_movie where title = '$movie';
";
//Send the query stored in $query# and stored the returned result in $result#
$result =  mysql_query($query1);
$result2 = mysql_query($query2);
$result3 = mysql_query($query3);
$result4 = mysql_query($query4);
$result5 = mysql_query($query5);

//Fetch the result of the queries
$q = mysql_fetch_row($result);
$q2 = mysql_fetch_row($result2);
$q3 = mysql_fetch_row($result3);
$q4 = mysql_fetch_row($result4);
$q5 = mysql_fetch_row($result5);

//initialize $user_age variable
$user_age = $q4[0];

//set $age_restrict based on the rating of a specific movie
if($q5[0] =='G' or $q5[0] =='PG')
	$age_restrict = 0;
else if($q5[0]== 'PG-13')
	$age_restrict = 13;
else 
	$age_restrict = 17;

//case handling
if($q[0] == 1)
{
	echo "$mb_name already has already reserved a seat for this showing";
}
else if($q3[0]==$q2[0])
{
	echo "The maximum number of reservations for account:".$account_no." has been reached.<br> No more reservation will be processed for that account";
}
else if($user_age < $age_restrict)
{
	echo "You are not allowed to reserved for this movie because of the age restriction:$q5[0]";
}
else
{

echo "Your reservation confirmation:<br>";
echo "MOVIE: $movie <br> TIME: $time <br> DATE: $datestring <br> COMPLEX: $complex <br> THEATER: $theater <br> SEAT: $row$column<br>";
echo "Number of allowed reservation remaining: ".($q2[0]-$q3[0]-1)."<br>";
	echo"Your seat choice is: ".$row.$column.'<br>';
$query = "insert into nwc_reserved(mb_name,account_no,t_id,complex_name,rowID,columnID,time,day)
values('$mb_name','$account_no','$theater','$complex', '$row', '$column','$time','$datestring'); ";

if($free_seats>0)
{
	 mysql_query($query);
	echo "your reservation has been successfully process";
}
else
{
	echo "Your reservation cannot be process because this showing is SOLD OUT!"; 
}
}
echo '<br><a href="display.php">Return to the main reservation page</a>
</br>';
}
else {
	echo 'Your account has expired. Please renew it.<br><br>
	<a href="extendmembership.php" class="button">Extend</a><br><br>';
	
}
mysql_close($connect); //close database connection

?>
