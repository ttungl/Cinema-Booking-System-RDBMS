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
<head><title>New Wave Cinema: Adding of movies</title></head>

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
// Interface of schedule movies: adding page.
// - Input: 
//   + Movie title, stars, rating, description, and runtime (format: hh:mm).
// - Output:
//   + Display the table with the movie added.
// - Description: 
//   + Users can add a movie with all information such as title, stars, rating,
// description, and runtime. Notice that runtime has to follow the format hh.mm 
// All fields are required to fill out. If one of the fields leaves empty, users
// can see a warning message "Please fill out this field". 
//---------------------------------------------------------------------------

echo"<html>";
echo"<head><title>New Wave Cinema: Schedule Movies Adding</title></head>";
echo"<body>";
echo'<form action="nwc_schedule_movies_adding.php" method="POST">';
echo"<h2>Schedule Movies: Adding the movies</h2>";
echo"<br>";

echo"Movie title:";
echo'<input type="text" name="Title" required>';
echo"<br>";
echo"<br>";
echo"Stars:";
echo'<input type="text" name="Stars" required>';
echo"<br>";
echo"<br>";
echo"Rating:"; 
echo'<select name="Rating">';
echo'<option value="PG-13" selected>PG-13</option>';
echo'<option value="PG">PG</option>';
echo'<option value="G">G</option>';
echo'<option value="R">R</option>';
echo'</select>';
echo"<br>";
echo"<br>";
echo"Description:";
echo'<input type="text" name="Description" required>';
echo"<br>";
echo"<br>";
echo"Runtime:";
echo'<input type="text" name="Runtime" required>';
echo"<br>";
echo"<br>";
echo'<input type="submit" value="Submit">';


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
// Check runtime validation (HH:MM)
//-------------------------------------------------------------
$time_valid = preg_match("/(9[0-9]|[01][0-9]):[0-5][0-9]/", $_POST['Runtime']); // max:~100hrs
	
if($time_valid){
	//print "Runtime is valid. ";
	$flag_time_invalid="0";
} else {
	print '<center>';
	print "Runtime is invalid. <br>Format is HH:MM ";
	$flag_time_invalid="1";
}

if($flag_time_invalid=='0'){

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
// Define variables for table used.
//-------------------------------------------------------------
$table_movie="nwc_movie";

//-------------------------------------------------------------
// Access form variables 
//-------------------------------------------------------------
$movietitle = $_POST['Title'];
$moviestars = $_POST['Stars'];
$movierating = $_POST['Rating'];
$movieruntime = $_POST['Runtime'];
$moviedescription = $_POST['Description'];

//-------------------------------------------------------------
// Flags for checking whether the adding movie is available in
// the database or not. 
// 1: movie does not exist in the database, otherwise 0.
//-------------------------------------------------------------
$flag_movie_avail="0"; 

//-------------------------------------------------------------
// Connect to the database
//-------------------------------------------------------------
// Connect to the database
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
//	+ If $flag_movie_avail=1: The adding movie does not exist 
// in the database, then the adding movie will be added into the
// database, 
//     + Otherwise, if $flag_movie_avail=0, the adding movie
// has already been added in the database, then the adding movie
// will not be added into the database, and this prints a warning
// message to let the users try again.
//-------------------------------------------------------------
$query10="select * 
	from $table_movie m
	where m.title = '$movietitle' ";
$checktitle=mysql_query($query10);
if($checktitle){
	if(mysql_num_rows($checktitle)==0){
		//print "<br>- The movie is not in the database.";
		$flag_movie_avail = "1";
	} else {
		print '<center>';
		print "<br>$movietitle is available in the database.<br>";
		$flag_movie_avail = "0";
	}
}

//-------------------------------------------------------------
// Check whether the adding movie is available in the database 
// or not (based on $flag_movie_avail status). 
// - If the adding movie does not exist in the database, 
// it goes ahead to insert the movie into the database 
// (in table_movie). 
// - Otherwise, it skips this and let the users to check again.   
//-------------------------------------------------------------
if($flag_movie_avail=='1' ){
	
	// insert 	
	$query="INSERT INTO $table_movie VALUES ('$movietitle','$moviestars','$movierating','$moviedescription','$movieruntime')";
	mysql_query($query);

	$query="select m.title, m.stars, m.rating, m.description, m.runtime
  		from $table_movie m ";
		  
	// Run the query
	$results_id = mysql_query($query);
	if(!$results_id)
	{
   		print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   		die (mysql_error());
	}

	if($results_id)
	{
		print '<center>';
       	print '<table>';
	       print '<th style="width:300px">Title
    			<th style="width:300px">Stars
  			<th style="width:300px">Rating
  			<th style="width:300px">Description
    			<th style="width:100px">Run Time';

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
   	print "<br>*Please go back to check again.<br>";
}

//-------------------------------------------------------------
// Close the database.
//-------------------------------------------------------------
mysql_close($connect);

} // runtime invalid	


} // !empty $_POST

?>

</body></html>