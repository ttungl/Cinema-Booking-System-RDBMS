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


<head>
<title>Movie Reservation</title>
<!--Set CSS style-->
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th
thead {
  background: #395870;
  color: #fff;
}
tbody tr:nth-child(even) {
  background: #f0f0f2;
}
td {
   	 padding: 5px;
    	text-align: center;
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
echo '<form method="post" action="reservtion_confirmation.php">';

$curAcct = $_SESSION['account_no'];
$curName = $_SESSION['user_name'];

$result = $_POST['choice'];

//Display error in the event no radio button was not selected in the previous page
//and provide a link to the main reservation page
if($result=="")
{
	echo "Please select an option<br>";
	echo '<a href="display.php">Return to the main reservation page</a><br>
';
}
else
{	
//the explode function split $result string into an array of strings stored in $choice
$choice = explode('|',$result);

//Initialize global variables 
$movie = $choice[0];
$theater = $choice[1];
$complex = $choice[2];
$time = $choice[3];
$datestring = $choice[4];
list($y,$m,$d)=explode("-",$datestring);
echo "the date is ".$datestring.'<br>';
$date=mktime(0,0,0,$m,$d,$y);
//echo date("Y-m-d h:i:sa", $date);
//$query returns distinct rowID from seating chart where complex_name matches user input
$query = "select count(distinct rowID) from nwc_seatingchart where complex_name ='$complex';";

//$query1 returns the capacity of the specific theater in a complex inputed by the user 
$query1 = "select capacity from nwc_theatre where complex_name = '$complex' and t_id = '$theater';";

//$query2 returns the count of all the free seats for a specific showing
$query2 = "select count(*)
		from nwc_reserved r,nwc_showing s
		where s.t_id  = r.t_id
		and s.complex_name = r.complex_name
		and r.complex_name = '$complex'
		and s.start_time = r.time
		and r.day = '$datestring';";

//$query3 returns the rowID and columnID of all the free seats for a specific showing
$query3 = "select st.rowID, st.columnID
from nwc_seatingchart st, nwc_showing sh
where sh.t_id = st.t_id
and sh.complex_name = '$complex'
and sh.complex_name = st.complex_name
and sh.title = '$movie'
and sh.start_time = '$time'
and sh.t_id = '$theater'
and not exists
(select *
from nwc_reserved r
where sh.t_id=r.t_id
and sh.complex_name = st.complex_name
and r.complex_name = '$complex'
and st.rowID = r.rowID
and st.columnID = r.columnID
and r.day = '$datestring');";

//$query4 returns the count of the number of rows
$query4 = "select count(distinct rowID) from nwc_seatingchart;";

//$query5 returns the count of the number of columns
$query5 = "select count(distinct columnID) from nwc_seatingchart;";

//$query6 returns the distinct rows in the nwc_seatingchart table
$query6 = "select distinct rowID from nwc_seatingchart;";

//$query7 returns the distinct rows in the nwc_seatingchart table
$query7 = "select distinct columnID from nwc_seatingchart;";


//Send the query stored in $query# and stored the returned result in $r#
$r = mysql_query($query);
$r1 = mysql_query($query1);
$r2 = mysql_query($query2);
$r3 = mysql_query($query3);
$r4 = mysql_query($query4);
$r5 = mysql_query($query5);
$r6 = mysql_query($query6);
$r7 = mysql_query($query7);

//Fetch the result of the queries
$q4 = mysql_fetch_row($r4);
$q5 = mysql_fetch_row($r5);
while($q6[]= mysql_fetch_row($r6));
while($q7[] = mysql_fetch_row($r7));
$capacity = mysql_fetch_row($r1);
$occupancy = mysql_fetch_row($r2);
$num_rows = mysql_fetch_row($r);

//initialize variables
$numRows = $q4[0];
$numColumns = $q5[0];
$free_seats = $capacity[0] - $occupancy[0];
//echo "Number of free seats:".$free_seats."<br>";

//create drop down menu for free seats 
echo '<table style="width:100%" align = "center">';

//$num_aval_seats = mysql_num_rows($r3);
//echo "Number of avalaible seats:".$num_aval_seats."<br>";
echo '<select name="chair">';
echo '<option value = "">----select a seat----</option>';
$i =0;
while($row[] = mysql_fetch_row($r3))
{
	
	echo "<option value ='" .$row[$i][0].'|'.$row[$i][1].'|'.$theater.'|'.$complex.'|'.$time.'|'.$datestring.'|'.$free_seats.'|'.$movie."'>".$row[$i][0].$row[$i][1]."</option>";
	
	$freeSeats[$i]=$row[$i][0].$row[$i][1];
	$i++;

}

echo '</select>';

//create and initialize seating chart
echo '<table style="width:100%" align = "center">';
echo "<tr>";
echo "<th></th>";
for($e = 0;$e<$numColumns;$e++)
{
	$index = $e+1;
	echo "<th>$index</th>";
}
if($free_seats==0)
{
	echo"<h1 align=center>This showing is SOLD OUT!</h1>";
}
 $numRow = mysql_num_rows($r3);
$y = -$numColumns;
for($i = 0;$i<$numRows;$i++)
{
$y = $y+$numColumns;
echo "<tr>";
echo '<td bgcolor ="#FFFF00" >'.''.'</td>';
for($x = 0; $x<$numColumns;$x++)
{
 $free = FALSE;
	for($r = 0;$r< count($freeSeats);$r++)
{
		if($freeSeats[$r] == ($q6[$i][0].$q7[$x][0]))
		{
			echo"<td bgcolor='#00FF00'>";
			echo "<input type = 'radio' name = 'seats' value ='".$row[$r][0].'|'.$row[$r][1].'|'.$theater.'|'.$complex.'|'.$time.'|'.$datestring.'|'.$free_seats.'|'.$movie."'>".$q6[$i][0].$q7[$x][0]."</td>";
			$free = TRUE;
		}

}
if(!$free)
{
			echo"<td bgcolor='#FF0000 '>".$q6[$i][0].$q7[$x][0]."</td>";
}
	
}
echo "</tr>";
}
echo '</table>';
echo '<a href="display.php">Return to the main reservation page</a><br>
';

//create the submit button
echo '<input type="submit" value="select">';
echo "</form>";
}
}
else {
	echo 'Your account has expired. Please renew it.<br><br>
	<a href="extendmembership.php" class="button">Extend</a><br><br>';
	
}
mysql_close($connect); //close database connection
?>
</body>
</html>
