<!-- -------------------------------------------------
Author name: Tung Thanh Le
CLID: ttl8614
Date: 04/27/2015
I (Tung Le) certify that this is my own code.
-------------------------------------------------- -->

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
<head><title>New Wave Cinema: Scheduling the shows</title></head>
<?php
//-------------------------------------
// Check the authentication of users
//-------------------------------------
include('connecttophp.php');
include('sessioncore.php');
if (isValidUser() && !loggedinEmp()){
	header("Location: UserIndex.php");
}
//---------------------------------------------------------------------------
// Interface of schedule movies: scheduling the shows page.
// - Input: 
//   + Movie title, complex name, theater, and start time.
// - Output:
//   + Display the table with the movie scheduled order by movie title, theater,
// complex name, and start time. 
// - Description: 
//   + Users can input the movie title, if the adding movie does not exist in 
// the database, it will leave a warning message that the adding movie is not
// available in the database. 
//   + If users add the same movie title, the same complex, the same theater, 
// the same time, it will return a warning message to let the users know that 
// specific movie show has already been scheduled.  
//   + Movie title field is required to input, other inputs include complex 
// name, theater, and start time, if users don't change, then the default values
// for complex, theater, and start time will be Lafayette, room1, and 8.00, 
// respectively.
//   + It can avoid the schedule conflict between two movies in the same theater 
// of a complex within 30 minutes.    
//---------------------------------------------------------------------------

echo"<html>";
echo"<head><title>New Wave Cinema: Schedule Movies Scheduling</title></head>";
echo"<body>";
echo'<form action="nwc_schedule_movies_scheduling.php" method="POST">';
echo"<h2>Schedule Movies: Scheduling the shows</h2>";
echo"<br>";
echo"Movie title:";
echo'<input type="text" name="Title" required>';
echo"<br>";
echo"<br>";
echo"Complex:";
echo'<select name="Complex">';
echo'<option value="Lafayette" selected>Lafayette</option>';
echo'<option value="New Orleans">New Orleans</option>';
echo'<option value="New York">New York</option>';
echo'<option value="Paris">Paris</option>';
echo'<option value="Los Angeles">Los Angeles</option>';
echo'</select>';
echo"<br>";
echo"<br>";
echo"Theater:"; 
echo'<select name="Theater">';
echo'<option text="room1" selected>room1</option>';
echo'<option text="room2">room2</option>';
echo'<option text="room3">room3</option>';
echo'<option text="room4">room4</option>';
echo'</select>';

echo"<br>";
echo"<br>";
echo"Start time:"; 
echo'<select name="Stime">';
echo'<option text="00:00" >00:00</option>';
echo'<option text="00:05" >00:05</option>';
echo'<option text="00:10" >00:10</option>';
echo'<option text="00:15" >00:15</option>';
echo'<option text="00:20" >00:20</option>';
echo'<option text="00:25" >00:25</option>';
echo'<option text="00:30" >00:30</option>';
echo'<option text="00:35" >00:35</option>';
echo'<option text="00:40" >00:40</option>';
echo'<option text="00:45" >00:45</option>';
echo'<option text="00:50" >00:50</option>';
echo'<option text="00:55" >00:55</option>';

echo'<option text="01:00" >01:00</option>';
echo'<option text="01:05" >01:05</option>';
echo'<option text="01:10" >01:10</option>';
echo'<option text="01:15" >01:15</option>';
echo'<option text="01:20" >01:20</option>';
echo'<option text="01:25" >01:25</option>';
echo'<option text="01:30" >01:30</option>';
echo'<option text="01:35" >01:35</option>';
echo'<option text="01:40" >01:40</option>';
echo'<option text="01:45" >01:45</option>';
echo'<option text="01:50" >01:50</option>';
echo'<option text="01:55" >01:55</option>';

echo'<option text="02:00" >02:00</option>';
echo'<option text="02:05" >02:05</option>';
echo'<option text="02:10" >02:10</option>';
echo'<option text="02:15" >02:15</option>';
echo'<option text="02:20" >02:20</option>';
echo'<option text="02:25" >02:25</option>';
echo'<option text="02:30" >02:30</option>';
echo'<option text="02:35" >02:35</option>';
echo'<option text="02:40" >02:40</option>';
echo'<option text="02:45" >02:45</option>';
echo'<option text="02:50" >02:50</option>';
echo'<option text="02:55" >02:55</option>';

echo'<option text="03:00" >03:00</option>';
echo'<option text="03:05" >03:05</option>';
echo'<option text="03:10" >03:10</option>';
echo'<option text="03:15" >03:15</option>';
echo'<option text="03:20" >03:20</option>';
echo'<option text="03:25" >03:25</option>';
echo'<option text="03:30" >03:30</option>';
echo'<option text="03:35" >03:35</option>';
echo'<option text="03:40" >03:40</option>';
echo'<option text="03:45" >03:45</option>';
echo'<option text="03:50" >03:50</option>';
echo'<option text="03:55" >03:55</option>';

echo'<option text="04:00" >04:00</option>';
echo'<option text="04:05" >04:05</option>';
echo'<option text="04:10" >04:10</option>';
echo'<option text="04:15" >04:15</option>';
echo'<option text="04:20" >04:20</option>';
echo'<option text="04:25" >04:25</option>';
echo'<option text="04:30" >04:30</option>';
echo'<option text="04:35" >04:35</option>';
echo'<option text="04:40" >04:40</option>';
echo'<option text="04:45" >04:45</option>';
echo'<option text="04:50" >04:50</option>';
echo'<option text="04:55" >04:55</option>';

echo'<option text="05:00" >05:00</option>';
echo'<option text="05:05" >05:05</option>';
echo'<option text="05:10" >05:10</option>';
echo'<option text="05:15" >05:15</option>';
echo'<option text="05:20" >05:20</option>';
echo'<option text="05:25" >05:25</option>';
echo'<option text="05:30" >05:30</option>';
echo'<option text="05:35" >05:35</option>';
echo'<option text="05:40" >05:40</option>';
echo'<option text="05:45" >05:45</option>';
echo'<option text="05:50" >05:50</option>';
echo'<option text="05:55" >05:55</option>';

echo'<option text="06:00" >06:00</option>';
echo'<option text="06:05" >06:05</option>';
echo'<option text="06:10" >06:10</option>';
echo'<option text="06:15" >06:15</option>';
echo'<option text="06:20" >06:20</option>';
echo'<option text="06:25" >06:25</option>';
echo'<option text="06:30" >06:30</option>';
echo'<option text="06:35" >06:35</option>';
echo'<option text="06:40" >06:40</option>';
echo'<option text="06:45" >06:45</option>';
echo'<option text="06:50" >06:50</option>';
echo'<option text="06:55" >06:55</option>';

echo'<option text="07:00" >07:00</option>';
echo'<option text="07:05" >07:05</option>';
echo'<option text="07:10" >07:10</option>';
echo'<option text="07:15" >07:15</option>';
echo'<option text="07:20" >07:20</option>';
echo'<option text="07:25" >07:25</option>';
echo'<option text="07:30" >07:30</option>';
echo'<option text="07:35" >07:35</option>';
echo'<option text="07:40" >07:40</option>';
echo'<option text="07:45" >07:45</option>';
echo'<option text="07:50" >07:50</option>';
echo'<option text="07:55" >07:55</option>';

echo'<option text="08:00" selected >08:00</option>';
echo'<option text="08:05" >08:05</option>';
echo'<option text="08:10" >08:10</option>';
echo'<option text="08:15" >08:15</option>';
echo'<option text="08:20" >08:20</option>';
echo'<option text="08:25" >08:25</option>';
echo'<option text="08:30" >08:30</option>';
echo'<option text="08:35" >08:35</option>';
echo'<option text="08:40" >08:40</option>';
echo'<option text="08:45" >08:45</option>';
echo'<option text="08:50" >08:50</option>';
echo'<option text="08:55" >08:55</option>';

echo'<option text="09:00" >09:00</option>';
echo'<option text="09:05" >09:05</option>';
echo'<option text="09:10" >09:10</option>';
echo'<option text="09:15" >09:15</option>';
echo'<option text="09:20" >09:20</option>';
echo'<option text="09:25" >09:25</option>';
echo'<option text="09:30" >09:30</option>';
echo'<option text="09:35" >09:35</option>';
echo'<option text="09:40" >09:40</option>';
echo'<option text="09:45" >09:45</option>';
echo'<option text="09:50" >09:50</option>';
echo'<option text="09:55" >09:55</option>';

echo'<option text="10:00" >10:00</option>';
echo'<option text="10:05" >10:05</option>';
echo'<option text="10:10" >10:10</option>';
echo'<option text="10:15" >10:15</option>';
echo'<option text="10:20" >10:20</option>';
echo'<option text="10:25" >10:25</option>';
echo'<option text="10:30" >10:30</option>';
echo'<option text="10:35" >10:35</option>';
echo'<option text="10:40" >10:40</option>';
echo'<option text="10:45" >10:45</option>';
echo'<option text="10:50" >10:50</option>';
echo'<option text="10:55" >10:55</option>';

echo'<option text="11:00" >11:00</option>';
echo'<option text="11:05" >11:05</option>';
echo'<option text="11:10" >11:10</option>';
echo'<option text="11:15" >11:15</option>';
echo'<option text="11:20" >11:20</option>';
echo'<option text="11:25" >11:25</option>';
echo'<option text="11:30" >11:30</option>';
echo'<option text="11:35" >11:35</option>';
echo'<option text="11:40" >11:40</option>';
echo'<option text="11:45" >11:45</option>';
echo'<option text="11:50" >11:50</option>';
echo'<option text="11:55" >11:55</option>';

echo'<option text="12:00" >12:00</option>';
echo'<option text="12:05" >12:05</option>';
echo'<option text="12:10" >12:10</option>';
echo'<option text="12:15" >12:15</option>';
echo'<option text="12:20" >12:20</option>';
echo'<option text="12:25" >12:25</option>';
echo'<option text="12:30" >12:30</option>';
echo'<option text="12:35" >12:35</option>';
echo'<option text="12:40" >12:40</option>';
echo'<option text="12:45" >12:45</option>';
echo'<option text="12:50" >12:50</option>';
echo'<option text="12:55" >12:55</option>';

echo'<option text="13:00" >13:00</option>';
echo'<option text="13:05" >13:05</option>';
echo'<option text="13:10" >13:10</option>';
echo'<option text="13:15" >13:15</option>';
echo'<option text="13:20" >13:20</option>';
echo'<option text="13:25" >13:25</option>';
echo'<option text="13:30" >13:30</option>';
echo'<option text="13:35" >13:35</option>';
echo'<option text="13:40" >13:40</option>';
echo'<option text="13:45" >13:45</option>';
echo'<option text="13:50" >13:50</option>';
echo'<option text="13:55" >13:55</option>';

echo'<option text="14:00" >14:00</option>';
echo'<option text="14:05" >14:05</option>';
echo'<option text="14:10" >14:10</option>';
echo'<option text="14:15" >14:15</option>';
echo'<option text="14:20" >14:20</option>';
echo'<option text="14:25" >14:25</option>';
echo'<option text="14:30" >14:30</option>';
echo'<option text="14:35" >14:35</option>';
echo'<option text="14:40" >14:40</option>';
echo'<option text="14:45" >14:45</option>';
echo'<option text="14:50" >14:50</option>';
echo'<option text="14:55" >14:55</option>';

echo'<option text="15:00" >15:00</option>';
echo'<option text="15:05" >15:05</option>';
echo'<option text="15:10" >15:10</option>';
echo'<option text="15:15" >15:15</option>';
echo'<option text="15:20" >15:20</option>';
echo'<option text="15:25" >15:25</option>';
echo'<option text="15:30" >15:30</option>';
echo'<option text="15:35" >15:35</option>';
echo'<option text="15:40" >15:40</option>';
echo'<option text="15:45" >15:45</option>';
echo'<option text="15:50" >15:50</option>';
echo'<option text="15:55" >15:55</option>';

echo'<option text="16:00" >16:00</option>';
echo'<option text="16:05" >16:05</option>';
echo'<option text="16:10" >16:10</option>';
echo'<option text="16:15" >16:15</option>';
echo'<option text="16:20" >16:20</option>';
echo'<option text="16:25" >16:25</option>';
echo'<option text="16:30" >16:30</option>';
echo'<option text="16:35" >16:35</option>';
echo'<option text="16:40" >16:40</option>';
echo'<option text="16:45" >16:45</option>';
echo'<option text="16:50" >16:50</option>';
echo'<option text="16:55" >16:55</option>';

echo'<option text="17:00" >17:00</option>';
echo'<option text="17:05" >17:05</option>';
echo'<option text="17:10" >17:10</option>';
echo'<option text="17:15" >17:15</option>';
echo'<option text="17:20" >17:20</option>';
echo'<option text="17:25" >17:25</option>';
echo'<option text="17:30" >17:30</option>';
echo'<option text="17:35" >17:35</option>';
echo'<option text="17:40" >17:40</option>';
echo'<option text="17:45" >17:45</option>';
echo'<option text="17:50" >17:50</option>';
echo'<option text="17:55" >17:55</option>';

echo'<option text="18:00" >18:00</option>';
echo'<option text="18:05" >18:05</option>';
echo'<option text="18:10" >18:10</option>';
echo'<option text="18:15" >18:15</option>';
echo'<option text="18:20" >18:20</option>';
echo'<option text="18:25" >18:25</option>';
echo'<option text="18:30" >18:30</option>';
echo'<option text="18:35" >18:35</option>';
echo'<option text="18:40" >18:40</option>';
echo'<option text="18:45" >18:45</option>';
echo'<option text="18:50" >18:50</option>';
echo'<option text="18:55" >18:55</option>';

echo'<option text="19:00" >19:00</option>';
echo'<option text="19:05" >19:05</option>';
echo'<option text="19:10" >19:10</option>';
echo'<option text="19:15" >19:15</option>';
echo'<option text="19:20" >19:20</option>';
echo'<option text="19:25" >19:25</option>';
echo'<option text="19:30" >19:30</option>';
echo'<option text="19:35" >19:35</option>';
echo'<option text="19:40" >19:40</option>';
echo'<option text="19:45" >19:45</option>';
echo'<option text="19:50" >19:50</option>';
echo'<option text="19:55" >19:55</option>';

echo'<option text="20:00" >20:00</option>';
echo'<option text="20:05" >20:05</option>';
echo'<option text="20:10" >20:10</option>';
echo'<option text="20:15" >20:15</option>';
echo'<option text="20:20" >20:20</option>';
echo'<option text="20:25" >20:25</option>';
echo'<option text="20:30" >20:30</option>';
echo'<option text="20:35" >20:35</option>';
echo'<option text="20:40" >20:40</option>';
echo'<option text="20:45" >20:45</option>';
echo'<option text="20:50" >20:50</option>';
echo'<option text="20:55" >20:55</option>';

echo'<option text="21:00" >21:00</option>';
echo'<option text="21:05" >21:05</option>';
echo'<option text="21:10" >21:10</option>';
echo'<option text="21:15" >21:15</option>';
echo'<option text="21:20" >21:20</option>';
echo'<option text="21:25" >21:25</option>';
echo'<option text="21:30" >21:30</option>';
echo'<option text="21:35" >21:35</option>';
echo'<option text="21:40" >21:40</option>';
echo'<option text="21:45" >21:45</option>';
echo'<option text="21:50" >21:50</option>';
echo'<option text="21:55" >21:55</option>';

echo'<option text="22:00" >22:00</option>';
echo'<option text="22:05" >22:05</option>';
echo'<option text="22:10" >22:10</option>';
echo'<option text="22:15" >22:15</option>';
echo'<option text="22:20" >22:20</option>';
echo'<option text="22:25" >22:25</option>';
echo'<option text="22:30" >22:30</option>';
echo'<option text="22:35" >22:35</option>';
echo'<option text="22:40" >22:40</option>';
echo'<option text="22:45" >22:45</option>';
echo'<option text="22:50" >22:50</option>';
echo'<option text="22:55" >22:55</option>';

echo'<option text="23:00" >23:00</option>';
echo'<option text="23:05" >23:05</option>';
echo'<option text="23:10" >23:10</option>';
echo'<option text="23:15" >23:15</option>';
echo'<option text="23:20" >23:20</option>';
echo'<option text="23:25" >23:25</option>';
echo'<option text="23:30" >23:30</option>';
echo'<option text="23:35" >23:35</option>';
echo'<option text="23:40" >23:40</option>';
echo'<option text="23:45" >23:45</option>';
echo'<option text="23:50" >23:50</option>';
echo'<option text="23:55" >23:55</option>';
echo'</select>';
echo"<br>";
echo"<br>";
echo'<input type="submit" value="Submit">';
echo"<br>";
echo"</form>";
echo"</body>";
echo"</html>";
echo'<form action="loggout.php">';
echo'<input type="submit" value="Log Out">';
echo"</form>";
if (isValidUser() && loggedinEmp()){
echo'<form action="EmpIndex.php">';
echo'<input type="submit" value="Main Menu">';
echo"</form>";
}



//-------------------------------------------------------------
// Check if $_POST is empty.
//-------------------------------------------------------------
if (!empty($_POST)){

//-------------------------------------------------------------
// Display errors to browser 
//-------------------------------------------------------------
error_reporting(E_ALL);
ini_set("display_errors", 1);

//-------------------------------------------------------------
// Define variables for accessing to the database.
//-------------------------------------------------------------
$host="";
$user = "groupE";
$password = "cmps460";
$database = "cs4601_groupE";

//-------------------------------------------------------------
// Define variables for tables used.
//-------------------------------------------------------------
$table_showing="nwc_showing";
$table_movie="nwc_movie";
$table_theater="nwc_theatre";

//-------------------------------------------------------------
// Access form variables 
//-------------------------------------------------------------
$movietitle = $_POST['Title'];
$movietheater = $_POST['Theater'];
$moviecomplex = $_POST['Complex'];
$moviestarttime = $_POST['Stime'];


//-------------------------------------------------------------
// flags for checking statuses.
//-------------------------------------------------------------
$flag_time_interval = "0";
$flag_movie_avail="0";
$flag_conflict="0";
$flag_all_avail="0";

//-------------------------------------------------------------
// Connect to the database
//-------------------------------------------------------------
$connect = mysql_connect($host,$user,$password)
    or die("Unable to connect to database");
// Select the database - the @ supresses MySQL error output
@mysql_select_db($database) or die("Unable to select database");



//-------------------------------------------------------------
// Checking whether the adding movie is available in the database
// (table_movie) or not.
// - Input: $movietitle.
// - Output: status of $flag_movie_avail.
// - Description:
//	+ If $flag_movie_avail=0: The adding movie does not exist 
// in the database, then the adding movie will be added into the
// database, 
//     + Otherwise, if $flag_movie_avail=1, the adding movie
// has already been added in the database, then the adding movie
// will not be added into the database, and this prints a warning
// message to let the users try again.
//-------------------------------------------------------------

$query="select m.title
  from $table_movie m
  where m.title = '$movietitle' ";

$checkquery = mysql_query($query);
if($checkquery){
  if(mysql_num_rows($checkquery)>0){
     // print "<br>The movie does exist in the database.";
     $flag_movie_avail= "1";

  } else {
	print '<center>';
     	print "<br>The movie does NOT exist in the database.";
     	$flag_movie_avail = "0";
  }  
}  

//-------------------------------------------------------------
// Checking whether the inputted movie has been scheduled in the
// database or not. If yes, a message is returned to notify that
// the show has already been scheduled in the database.  
//-------------------------------------------------------------
if($flag_all_avail=='0'){
$query="select * 
        from $table_showing s
        where s.title = '$movietitle' and 
              s.t_id = '$movietheater' and
              s.complex_name = '$moviecomplex' and 
              s.start_time = '$moviestarttime' ";
$checkallavail=mysql_query($query);
if($checkallavail){
  if(mysql_num_rows($checkallavail)>0){
    $flag_all_avail="1";
	print '<center>';
    	print "<br>$movietitle has already been scheduled in $movietheater at $moviecomplex at $moviestarttime in the database.<br>";
    // all available.
  } else {
    $flag_all_avail="0";
    // not all available.
  }

} 

}

//-------------------------------------------------------------
// Check whether the start time of two shows at the same theater 
// of a complex is conflicted within 30 minutes or not. If yes,
// it returns the schedule conflicted message.  
//-------------------------------------------------------------
if($flag_movie_avail=='1' && $flag_all_avail =='0'){

//----------------
$query1="select s.start_time
   	from $table_showing s
   	where s.t_id='$movietheater' and 
	s.complex_name ='$moviecomplex' "; 

	$mvstarttime = strtotime("$moviestarttime");

      	$results_id0 = mysql_query($query1);
      	if($results_id0)
      	{
		$i='0';	
             	// Get rows of the result
            while ($row = mysql_fetch_row($results_id0))
            {		
				$attrib = strtotime("$row[$i]");
						
				$timediff = round(abs($mvstarttime-$attrib)/60,2);
				if($timediff <= 30){
					print '<center>';
					print '<table>';
					print "<br>Schedule conflicted.<br>";			
					$flag_conflict="1";
					break;
				} else {			
					$flag_conflict="0";
					
				}
            }           
       }
}

//----------------


//-------------------------------------------------------------
// If all conditions are satisfied, it will add the show into 
// the database, otherwise, a warning message returns to let 
// the users check again. 
//-------------------------------------------------------------
if($flag_conflict=='0' && $flag_movie_avail=='1' && $flag_all_avail =='0'){
      // insert
      $query="INSERT INTO $table_showing VALUES ('$movietitle','$movietheater','$moviecomplex','$moviestarttime')";
      mysql_query($query);

      //$query3="select s.title, s.t_id, s.complex_name, s.start_time
      $query="select s.title, s.t_id, s.complex_name, s.start_time 
              from $table_showing s";

      $results_id = mysql_query($query);
      if($results_id)
      {

            	print '<center>';
		print "<br>$movietitle has been scheduled in $movietheater at complex $moviecomplex at $moviestarttime in the database.<br>";


		print '<center>';
      		print '<table>';
       	print '<th style="width:300px">Title
    			<th style="width:300px">Theater
  			<th style="width:300px">Complex
    			<th style="width:100px">Start Time';

            // Get each row of the result
            while ($row = mysql_fetch_row($results_id))
            {
               print '<tr>';
               // Get each attribute in the row
               foreach($row as $attribute)
               {
                  print "<td>$attribute</td> ";
               }
               print '</tr>';
            }
           
       }
       else
       {
            // Display the query and the MySQL error message
            print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
            die (mysql_error());
       }
         

} else {
 	print '<center>';	
	print "<br>*Please check all stuffs again.";
}

//-------------------------------------------------------------
// Close the database.
//-------------------------------------------------------------
mysql_close($connect);

} 

?>






</body>
</html>

