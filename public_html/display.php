<!----------------------------------------------------------------------------------
	Author: Issa Samake
	Date:April 27th,2015
	Certificate of Authenticity: 
	I (Issa) certify that this php script is entirely my own work.
------------------------------------------------------------------------------------>
<html>
<style type = "text/css">

.header{
     height: 55px;
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
<head><title>Movie Reservation</title></head><body>
<h1 align="center">MOVIE RESERVATION</h1>
<body>
<div class= "header">

<co align="center"><font size="12">Movie Reservations</font> </co> 
</div>
</body>
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

// --------------------------
// Display errors to browser
error_reporting(E_ALL);
ini_set("display_errors", 1);
// --------------------------
$host="";
$user="groupE";
$password="cmps460";
$database="cs4601_groupE";
$table_name="acct";

// Connect to the database
$connect = mysql_connect($host,$user,$password)
	 or die("Unable to connect to database");
// Select the database - the @ supresses MySQL error output
@mysql_select_db($database) or die("Unable to select database");


$curAcct = $_SESSION['account_no'];
$curName = $_SESSION['user_name'];
echo '<form method="post" action="Display_showing_info.php">';
//Create movie dropdown menu
echo '<div style="float:left;width:25%;" align = "center">';
echo '<label for= "MOVIE">MOVIE<br>';
echo '<select name="MOVIE">';
echo '<option value = "">------select a movie------</option>';

//$query returns all the movies in the nwc_movie table 
$query = "select title from nwc_movie";

//Send the query stored in $query and stored the returned result in $result
$result = mysql_query($query);
if(!$result)
{
   // Display the query and the MySQL error message
   print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   die (mysql_error());
}

$i = 0;

//Fetch the result of the query and store it in $row .Do it recursively until 
//no more can be fetched 
while($row = mysql_fetch_row($result))
{
	$movies[] = $row[0];
	echo "<option value ='" .$movies[$i]."'>".$movies[$i]."</option>";
	$i++;
}

echo '</select>';
echo '</div>';
echo '</label>';

//Create location dropdown menu
echo '<div style="float:left;width:25%;" align = "center">';
echo '<label for= "LOCATION">LOCATION<br>';
echo '<select name="LOCATION">';
echo '<option value = "">----select a location----</option>';

//$query1 returns all the different complex name in the nwc_showing table 
$query1 = "select distinct complex_name from nwc_showing;";

//Send the query stored in $query1 and stored the returned result in $result
$result = mysql_query($query1);
if(!$result)
{
   // Display the query and the MySQL error message
   print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   die (mysql_error());
}

$a = 0;

//Fetch the result of the query1 and store it in $row .Do it recursively until 
//no more can be fetched 
while($row = mysql_fetch_row($result))
{
	$locations[] = $row[0];
	echo "<option value ='" .$locations[$a]."'>".$locations[$a]."</option>";
	$a++;
}
echo '</select>';
echo '</div>';
echo '</label>';



//Create date dropdown menu

echo '<label for= "" ><br>';

echo '<div style="float:left;width:3%;" align = "center">';
echo '<select name="DAY">';
echo '<option value = "">day</option>';

 for ($x=1;$x < 32;$x++)
 {
 	echo "<option value ='" .$x."'>".$x."</option>";

 }

echo '</select>';
echo '</div>';

echo '<div style="float:left;width:5%;" align = "center">';
echo '<select name="MONTH">';
echo '<option value = "">month</option>';

 for ($y=1;$y < 13;$y++)
 {
 	echo "<option value ='" .$y."'>".$y."</option>";
 }

echo '</select>';
echo '</div>';

echo '<div style="float:left;width:3%;" align = "center">';
echo '<select name="YEAR">';
echo '<option value = "">year</option>';

 for ($z=2015;$z < 2025;$z++)
 {
 	echo "<option value ='" .$z."'>".$z."</option>";
 }

echo '</select>';
echo '</div>';

echo '</label>';

if(isset($_GET['OlderDate'])){
    $error =  $_GET['OlderDate'];
	echo "<font color='red'><br>$error</font>";
}
if(isset($_GET['DateError'])){
    $error =  $_GET['DateError'];
	echo "<font color='red'><br>$error</font>";
}
//Create a submit button
echo '<div style="float:right;width:30%;" align = "left">';
echo '<label for= ""><br>';
echo '<input class="button" type="submit" value="submit">';
echo '</div>';
echo '</form>';
}
else {
	echo 'Your account has expired. Please renew it.<br><br>
	<a href="extendmembership.php" class="button">Extend</a><br><br>';
	
}
mysql_close($connect); //close database connection
?>
<br><br><br>
<a href="UserIndex.php" class="button">Main Menu</a> 
</body>
</html>

