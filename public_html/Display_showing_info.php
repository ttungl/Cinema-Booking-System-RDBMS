<!----------------------------------------------------------------------------------
	Author: Issa Samake
	Date:April 27th,2015
	Certificate of Authenticity: 
	I (Issa) certify that this php script is entirely my own work.
------------------------------------------------------------------------------------>
<html><head>
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
<title>Movie Reservation</title>
<!--Set CSS style-->
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: center;
}
thead {
  background: #395870;
  color: #fff;
}
tbody tr:nth-child(even) {
  background: #f0f0f2;
}
th{
	background: #0099FF;
}
td {
  border-bottom: 1px solid #cecfd5;
  border-right: 1px solid #cecfd5;
}
td:first-child {
  border-left: 1px solid #cecfd5;
}
</style>
</head><body>

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

$curAcct = $_SESSION['account_no'];
$curName = $_SESSION['user_name'];
echo '<form method="post" action="Display_movie_selected.php">';
echo '<a href="display.php">Return to the main reservation page</a><br>
';
// Initialize global variables
   $movie =$_POST['MOVIE'];
   $location = $_POST['LOCATION'];
   $y = $_POST['YEAR'];
   $m = $_POST['MONTH'];
   $d = $_POST['DAY'];
	$date = $y.'-'.$m.'-'.$d;
	//list($y,$m,$d)=explode("-",$datestring);
	//echo "the date is ".$datestring.'<br>';
	$datestring=mktime(0,0,0,$m,$d,$y);
$curDate = date('Y-m-d');
$timestamp1 = strtotime($date);
$timestamp2 = strtotime($curDate);
	if (!checkdate($m,$d,$y))
	{
		$Message = urlencode("Invalid date. Please enter a valid date");
		header("Location: display.php?DateError=".$Message);
		die;
	}
	else if($timestamp1 < $timestamp2)
	{
		
		$Message = urlencode("Cannot reserved for a past date.Please reserved for a current or future date");
		header("Location: display.php?OlderDate=".$Message);
		die;
	}
	else if($movie == '')
	{   echo "No movie selected<br>";
		if($location=='')
			//$query returns all attibutes from the showing table
			$query = "select * from nwc_showing;";
		else
			//$query returns all attibutes from the showing table where complex_name =
			//location chosen
			$query = "select * from nwc_showing where complex_name = '$location';";}
	else if($location == '')
	{
		//set a default date if the user does not enter a specific date
		$date = date('Y-m-d');
		echo "No location selected<br>";

		//$query select all attributes from nwc_showing table where the title  = movie chosen
		$query = "select * from nwc_showing where title = '$movie';";
		//echo $query;
	}
	else if($date == '')
	{
		echo "No date selected<br>";
		//set a default date if the user does not enter a specific date
		$date = date('Y-m-d');
		//$query select all attributes from nwc_showing table where 
		//title and complex_name match user input
		$query = "select * from nwc_showing where title = '$movie' and complex_name = '$location';";
		//echo $query."<br>";
	}
	else if($date !='') 
	{
		//$query select all attributes from nwc_showing table where 
		//title and complex_name match user input
		$query = "select * from nwc_showing where title = '$movie' and complex_name = '$location';";
		//echo $query."<br>";
	}
    //Send the query stored in $query and stored the returned result in $result
	$result = mysql_query($query);
	if(!$result)
	{
	   // Display the query and the MySQL error message
	   print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
	   die (mysql_error());
	}

//returns number of rows in the $result variable
$r = mysql_num_rows($result);

if($r == 0)
{	echo "<br>No showing found !!!<br>";
	echo "But here are some alternatives";
//$query1 returns all the attributes of the showing table
if($movie !='')
{
	echo " for movie: '$movie'";
	$query1 = "select * from nwc_showing where title = '$movie'";
}
else if($location !='')
{
	echo "at location: '$location'";
	$query1 = "select * from nwc_showing where complex_name = '$location'";
}
else
	$query1 = "select * from nwc_showing ";

//Send the query stored in $query1 and stored the returned result in $result
$result = mysql_query($query1);
}

//set the table of resulting showing
echo '<table style="width:100%" align = "center">';
echo "<tr>";
echo "<th>Complex</th><th>Theater</th><th>Title</th><th>Time</th><th>Select</th>";
echo "</tr>";

$i =0;

//Fetch the result of the query1 and store it in $row .Do it recursively until 
//no more can be fetched 
while($row = mysql_fetch_row($result))
{
	
	echo "<tr>";
	echo "<td>".$row[2]."</td>"."<td>".$row[1]."</td>"."<td>".$row[0]."</td>"."<td>".$row[3]."</td>"."<td>".'<input type="radio" id= "$i" name="choice" value="'.$row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|'.$date.'">'."</td>";
	echo "</tr>";
	$i++;

}
echo '</table>';

//create a submit button
echo '<p style="text-align: center;"><input class="button" type="submit"  name="submit" value="submit" onclick = inputCheck() ></p>'; 

echo '</form>';
}
else {
	echo 'Your account has expired. Please renew it.<br><br>
	<a href="extendmembership.php" class="button">Extend</a><br><br>';
	
}
mysql_close($connect); //close database connection
   ?>
</body>
</html>
