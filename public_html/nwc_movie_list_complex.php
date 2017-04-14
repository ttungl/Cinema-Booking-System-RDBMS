<!-- -------------------------------------------------
Author name: Tung Thanh Le
CLID: ttl8614
Date: 04/27/2015
I (Tung Le) certify that this is my own code.
-------------------------------------------------- -->



<html><head>
<title>Movie List Complex</title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 

<style type = "text/css">
.header-cont{width= 100%;  }
.header{
     height: 75px;
     background: #0099CC;
     border:1px solid #CCC;
  position: fixed;
    width: 100%;
    top: 0px;
     margin: 0px auto;

}

.content{
width: 960px;
background: #F0F0F0;
border: 1px solid #CCC;
height:2000px;
margin:70px auto;

}

body {
    color: black;
}

h1 {
    color: #FFFFFF;
}

co {
    color: #FFFFFF;
}

p.ex {
    color: rgb(0,0,255);
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
  padding: 50px;	
  <!-- font-family:'Open Sans',sans-serif; -->
  background: white;
}

.col {
  width: 160px;
  float: left;
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

h2 {
    position: absolute;
    
    top: 0%;
    right: 10%;
}

p.italic {
    font-style: italic;
}

table tr.alt td {
    color: #ffffff;
    background-color: #000000;
}
</style>
</head><body>

<!-- <body> -->

<div class= "header">

<co align="center"><font size="12">Movie List</font> </co> 

<h2>
        <a href="#" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['empl_name'] ?>
        </a>
       <form action="loggout.php">
    <input type="submit" value="Log Out">
</form> </h2>

<!-- </body> -->

</div>
</body>
</html>




<?php



//-------------------------------------
// Check the authentication of users
//-------------------------------------
include('connecttophp.php');
include('sessioncore.php');

if (!loggedin() && isValidUser() && !loggedinEmp()){
	header("Location: UserIndex.php");
}


//---------------------------------------------------------------------------
// Interface of movie listing page.
// - Input: 
//   + Complex name.
// - Output:
//   + If a complex is selected: 
// 	* List of all movies, theaters, and start time of the complex selected.
//   + If list of all complexes is selected:
//	* List of all complexes name and its address, following by movies, 
// theaters and start time.
// - Description: 
//   + This interface is used to input the complex name,
// and then submit to see the result of all movies, theaters,
// and start time of that complex. If users select list all complexes,
// the result screen will display list of all complexes name and its address,
// following by movies, theaters, and start time of that complex. 
//---------------------------------------------------------------------------
echo"<html>";
echo"<head><title>New Wave Cinema: Movie Listing</title></head>";
echo"<body>";
echo"<br>";
echo"<br>";
//echo"<h2>Movie Listing</h2>";
//echo"<p>Notice: In order to request a list of movies from a specific complex or all complexes, you can select either a specific complex or all complexes option as below.</p>";
echo'<form action="nwc_movie_list_complex.php" method="POST">';
echo'<center>';
echo'<p>Select a complex:</p>';
echo'<select name="selectoptions">';
echo'<option value="lf" selected>Lafayette</option>';
echo'<option value="ns">New Orleans</option>';
echo'<option value="ny">New York</option>';
echo'<option value="pa">Paris</option>';
echo'<option value="la">Los Angeles</option>';
echo'<option value="lst">List all complexes</option>';
echo'</select>';
echo"<br>";
echo"<br>";
echo'<input class="button" type="submit" value="Submit">';
echo"</form>";
echo"<br>";
echo"<br>";
echo"</body>";
echo"</html>";
//echo'<form action="loggout.php">';
//echo'<input class="button" type="submit" value="Log Out">';
//echo"</form>";

if (loggedin() && isValidUser()){
echo'<form action="UserIndex.php">';
echo'<input class="button" type="submit" value="Main Menu">';
echo"</form>";		
} else if (isValidUser() && loggedinEmp()){
echo'<form action="EmpIndex.php">';
echo'<input class="button" type="submit" value="Main Menu">';
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
$table_complex="nwc_complex";

//-------------------------------------------------------------
// Access form variables 
//-------------------------------------------------------------
$selectoptions = $_POST['selectoptions'];

//-------------------------------------------------------------
// Connect to the database
//-------------------------------------------------------------
$connect = mysql_connect($host,$user,$password)
	 or die("Unable to connect to database");	 
// Select the database - the @ supresses MySQL error output
@mysql_select_db($database) or die("Unable to select database");

//-------------------------------------------------------------
// Select options
// - Input: $selectoptions
// - Output: rows that are matched to $selectoptions value.
// - Description: $selectoptions value is checked to switch to
// the right query for the input option. 
//-------------------------------------------------------------
if($selectoptions == "lst"){			
	$query="select c.complex_name, c.addr, s.title, s.t_id, s.start_time
        from $table_showing s, $table_complex c
        where s.complex_name = c.complex_name";

} else if($selectoptions == "lf"){
	$query="select s.title, s.t_id, s.start_time 
		from $table_showing s
		where s.complex_name = 'Lafayette' ";	

} else if($selectoptions == "ns"){
	$query="select s.title, s.t_id, s.start_time 
		from $table_showing s
		where s.complex_name = 'New Orleans' ";	

} else if($selectoptions == "ny"){
	$query="select s.title, s.t_id, s.start_time 
		from $table_showing s
		where s.complex_name = 'New York' ";	

}  else if($selectoptions == "pa"){
	$query="select s.title, s.t_id, s.start_time 
		from $table_showing s
		where s.complex_name = 'Paris' ";

}  else if($selectoptions == "la"){
	$query="select s.title, s.t_id, s.start_time 
		from $table_showing s
		where s.complex_name = 'Los Angeles' ";
}							
 			  
//-------------------------------------------------------------
// Check if error
//-------------------------------------------------------------
$results_id = mysql_query($query);
if(!$results_id)
{
   print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   die (mysql_error());
}

//-------------------------------------------------------------
// Recover the full name for corresponding $selectoptions 
// - Description: To show the status message (name of a complex) 
// on screen when a complex is choosen.
//-------------------------------------------------------------
if($selectoptions=="lf"){
	$select = "Lafayette";
} else if($selectoptions=="lst"){
	$select= "all complexes";
} else if($selectoptions=="ns"){
	$select= "New Orleans";
} else if($selectoptions=="ny"){
	$select= "New York";
} else if($selectoptions=="pa"){
	$select= "Paris";
} else if($selectoptions=="la"){
	$select= "Los Angeles";
}


if($results_id)
{
   //-------------------------------------------------------------
   // Display a message on screen. 
   //-------------------------------------------------------------
   if ($selectoptions=="lst"){
   	
	print '<center>';
   	print "<br>You are viewing $select.<br>";
	
   } else {
	
	print '<center>';
	print "<br>You are viewing $select complex.<br>";
	
   }

   //-------------------------------------------------------------
   // Display the table. 
   // - Input: $selectoptions
   // - Output: result table.
   // - Description: there are two options to display the table on 
   // screen. One type of table is for each complex, including movies,
   // theaters, and start time. Another type of table is for all complexes,
   // including complex name, its address, and following by movies, theaters,
   // and start time. 
   //-------------------------------------------------------------		  	
   print '<table border=1>';
   if($selectoptions=="lst"){

	print '<center>';
       print '<table>';
       print '<th style="width:300px">Complex name
    			<th style="width:300px">Address
  			<th style="width:300px">Movie title
  			<th style="width:300px">Theater
    			<th style="width:100px">Start time';

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
  } else {

	print '<center>';
       print '<table>';
       print '<th style="width:300px">Movie title
  			<th style="width:300px">Theater
    			<th style="width:100px">Start time';

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
}
else
{
   // Display the query and the MySQL error message
   print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   die (mysql_error());
}

//-------------------------------------------------------------
// Close the database.
//-------------------------------------------------------------
mysql_close($connect);
} 


?>

