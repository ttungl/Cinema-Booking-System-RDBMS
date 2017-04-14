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


<head><title>Reservation Maintenance</title></head>
<?php
include('connecttophp.php');
include('sessioncore.php');
if (isValidUser() && !loggedinEmp()){
	header("Location: UserIndex.php");
}
// --------------------------
// Display errors to browser
error_reporting(E_ALL);
ini_set("display_errors", 1);
// --------------------------
$host="";
$user="groupE";
$password="cmps460";
$database="cs4601_groupE";

// Access form variables
$reservationName= $_POST['Name'];
$reservationAccount = $_POST['Acct'];
$reservationID = $_POST['ID'];
$reservationComplex = $_POST['Complex'];
$reservationTime = $_POST['Time'];
$reservationDate = $_POST['Date'];
$action = $_POST['Action'];
// Connect to the database
$connect = mysql_connect($host,$user,$password)
	 or die("Unable to connect to database");
	 
// Select the database - the @ supresses MySQL error output
@mysql_select_db($database) or die("Unable to select database");

echo '<a href="maintenance.php">Return to the main maintenance page</a><br>';
echo "<br><br>";

if(strlen($reservationAccount) < 9)
{
    print 'Account Number must be 9 digits!';
    exit;

}

switch($action) {

    case "Delete":
	$query="select *
  		from nwc_reserved r
		where r.mb_name = '$reservationName' and
		      r.account_no = '$reservationAccount' and
		      r.t_id = '$reservationID' and
		      r.complex_name = '$reservationComplex' and
		      r.time = '$reservationTime' and
		      r.day = '$reservationDate'";
	$check = mysql_query($query);
	if($check)
	{
	    $row = mysql_fetch_row($check);
	    if(!$row)
	    {
		print 'Reservation not found!';
		exit;
	    }
	}
	else
	{
   	    // Display the query and the MySQL error message
   	    print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   	    die (mysql_error());
	}
	break;
	
    case "Update":
	$query="select *
  		from nwc_reserved r
		where r.mb_name = '$reservationName' and
		      r.account_no = '$reservationAccount' and
		      r.t_id = '$reservationID' and
		      r.complex_name = '$reservationComplex' and
		      r.time = '$reservationTime' and
		      r.day = '$reservationDate'";
	$check = mysql_query($query);
	if($check)
	{
	    $row = mysql_fetch_row($check);
	    if(!$row)
	    {
		print 'Reservation not found!';
		exit;
	    }
	}
	else
	{
   	    // Display the query and the MySQL error message
   	    print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   	    die (mysql_error());
	}
	break;

    default:
	$query="select *
  		from nwc_reserved r
		where r.mb_name = '$reservationName' and
		      r.account_no = '$reservationAccount' and
		      r.t_id = '$reservationID' and
		      r.complex_name = '$reservationComplex' and
		      r.time = '$reservationTime' and
		      r.day = '$reservationDate'";
	$check = mysql_query($query);
	if($check)
	{
	    $row = mysql_fetch_row($check);
	    if($row)
	    {
		print 'Reservation already exist!';
		exit;
	    }
	}
	else
	{
   	    // Display the query and the MySQL error message
   	    print "<br><br>QUERY FAILED !!! <br><br>QUERY = $query <br><br>ERROR = ";
   	    die (mysql_error());
	}
}

print "<br>-------------------------------------<br>";
print "BEFORE";
print "<br>-------------------------------------<br>";

$query="select *
		from nwc_reserved";
$results_id = mysql_query($query);

if($results_id)
{   	
   //print '<table border=1>';
   //print '<th>Name<th>Account No.<th>Theater<th>Complex<th>Row<th>Column<th>Time<th>Date<th>';

	print '<table>';
       print '<th style="width:300px">Name
    			<th style="width:300px">Account No.
  			<th style="width:300px">Theater
  			<th style="width:300px">Complex
  			<th style="width:300px">Row
  			<th style="width:300px">Column
  			<th style="width:300px">Time
    			<th style="width:100px">Date';

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

switch ($action) {

    case "Add":
	$reservationRow = $_POST['Row'];
	$reservationCol = $_POST['Col'];
	$query="INSERT INTO nwc_reserved VALUES ('$reservationName','$reservationAccount','$reservationID','$reservationComplex','$reservationRow','$reservationCol','$reservationTime','$reservationDate')";
	break;
	
    case "Delete":
	$query="DELETE FROM nwc_reserved
		       WHERE mb_name = '$reservationName' and
			     account_no = '$reservationAccount' and
			     t_id = '$reservationID' and
			     complex_name = '$reservationComplex' and
			     time = '$reservationTime' and
			     day = '$reservationDate'";
	break;
	
    default:
	$reservationNewName = $_POST['newName'];
	$reservationNewAccount = $_POST['newAcct'];
	$reservationNewID = $_POST['newID'];
	$reservationNewComplex = $_POST['newComplex'];
	$reservationNewRow = $_POST['newRow'];	
	$reservationNewCol = $_POST['newCol'];	
	$reservationNewTime = $_POST['newTime'];	
	$reservationNewDate = $_POST['newDate'];
	$query="UPDATE nwc_reserved
			SET mb_name = '$reservationNewName', account_no = '$reservationNewAccount', t_id = '$reservationNewID', complex_name = '$reservationNewComplex', rowID = '$reservationNewRow', columnID = '$reservationNewCol', time = '$reservationNewTime', day = '$reservationNewDate'
			WHERE mb_name = '$reservationName' and
				  account_no = '$reservationAccount' and
				  t_id = '$reservationID' and
				  complex_name = '$reservationComplex' and
			     	  time = '$reservationTime' and
			     	  day = '$reservationDate'";
}
mysql_query($query);

$query="select *
        from nwc_reserved";		  
$results_id = mysql_query($query);

if($results_id)
{ 	
    	//print '<table border=1>';

	//print '<th>Name<th>Account No.<th>Theater<th>Complex<th>Row<th>Column<th>Time<th>Date<th>';

	print '<table>';
    	print "<br>-------------------------------------<br>";
	print "AFTER";
	print "<br>-------------------------------------<br>";
       print '<th style="width:300px">Name
    			<th style="width:300px">Account No.
  			<th style="width:300px">Theater
  			<th style="width:300px">Complex
  			<th style="width:300px">Row
  			<th style="width:300px">Column
  			<th style="width:300px">Time
    			<th style="width:100px">Date';

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

mysql_close($connect);
?>
</body></html>
