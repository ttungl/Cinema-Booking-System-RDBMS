

<?php
include('connecttophp.php');
include('sessioncore.php');
if (isValidUser() && !loggedinEmp()){
	header("Location: UserIndex.php");
}
echo "<head>";
echo "<title>Admin Mode: Database Maintenance</title>";
echo "</head>";
echo "<body>";

echo "<br>";
echo '<a href="EmpIndex.php">Return to the main admin page</a><br>';
echo '<form action="nwc_maintenance.php" method="POST">';
echo "<br><br>";
echo "<br>";
echo "<br>";
echo "Action: ";
echo '<select name="Action">';
echo '<option value="Add" selected>Add</option>';
echo '<option value="Delete">Delete</option>';
echo '<option value="Update">Update</option>';
echo "</select>";
echo "<br>";
echo "<br>";
echo "Table: ";
echo '<select name="Table">';
echo '<option value="Complex" selected>Complex</option>';
echo '<option value="Employees">Employees</option>';
echo '<option value="Member">Member</option>';
echo '<option value="Membership">Membership</option>';
echo '<option value="Movie">Movie</option>';
echo '<option value="Reservation">Reservation</option>';
echo '<option value="Seating Chart">Seating Chart</option>';
echo '<option value="Showing">Showing</option>';
echo '<option value="Theater">Theater</option>';
echo "</select>";
echo "<br>";
echo "<br>";
echo '<input type="submit" value="Submit">';
echo "<br><br>";
echo "</form>";
echo "</body>";

echo"</form>";
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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

body {
  padding: 50px;
  background: white;
}

.col {
  width: 160px;
  float: left;
}

h2 {
    position: absolute;
    
    top: 0%;
    right: 10%;
}
p.italic {
    font-style: italic;
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
</head>
<body>
<div class= "header">

<co><font size="12">Admin Mode: Database Maintenance</font> </co> 

<h2>
        <a href="UserStats.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user_name'] ?>
        </a>
       <form action="loggout.php">
    <input type="submit" value="Log Out">
</form> </h2>

 </div>
</body>
</html>

