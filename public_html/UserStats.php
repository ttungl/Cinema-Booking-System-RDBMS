<html>
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

.

body {
    color: red;
}

co {
    color: #FFFFFF;
}

p.ex {
    color: rgb(0,0,255);
}

@import url(http://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

*{margin:0;padding:0;}

body{
  background: #E0E0E0; 
  font-family:'Open Sans',sans-serif;
}

.button{
  width:100px;
  background:#3399cc;
  display:block;
  margin:0 auto;
  margin-top:1%;
  padding:10px;
  text-align:center;
  text-decoration:none;
  color:#fff;
  cursor:pointer;
  transition:background .3s;
  -webkit-transition:background .3s;
}

.button:hover{
  background:#2288bb;
}

login1{
  width:400px;
  margin:0 auto;
  margin-top:8px;
  margin-bottom:2%;
  transition:opacity 1s;
  -webkit-transition:opacity 1s;
}

#triangle{
  width:0;
  border-top:12x solid transparent;
  border-right:12px solid transparent;
  border-bottom:12px solid #3399cc;
  border-left:12px solid transparent;
  margin:0 auto;
}

#login h1{
  background:#3399cc;
  padding:20px 0;
  font-size:140%;
  font-weight:300;
  text-align:center;
  color:#fff;
}

form{
  
background:#f0f0f0;
  padding:6% 4%;
}

input[type="email"],input[type="password"]{
  width:92%;
  background:#fff;
  margin-bottom:4%;
  border:1px solid #ccc;
  padding:4%;
  font-family:'Open Sans',sans-serif;
  font-size:95%;
  color:#555;
}

input[type="submit"]{
  width:100%;
  background:#3399cc;
  border:0;
  padding:4%;
  font-family:'Open Sans',sans-serif;
  font-size:100%;
  color:#fff;
  cursor:pointer;
  transition:background .3s;
  -webkit-transition:background .3s;
}

input[type="submit"]:hover{
  background:#2288bb;
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
    background-color: #7575FF;
    color: #ffffff;
}

table tr.alt td {
    color: #ffffff;
    background-color: #000000;
}

tbody tr:nth-child(even) {
  background: #f0f0f2;
}
</style>
<head>
<title>User Information</title>
</head>
<body>
<?php
session_start();
include('connecttophp.php');
include('sessioncore.php');



$query = "
	SELECT * 
	FROM nwc_membership m, nwc_member n
	WHERE m.account_no = '" . $_SESSION['account_no'] . "' 
		AND n.account_no = m.account_no  
		AND n.mb_name = '" . $_SESSION['user_name'] . "'";
$results = mysql_fetch_assoc(mysql_query($query));
if ($results['main_mb']) $primary = 'Yes';
else $primary = 'No';

if ($results) {
	echo "
	
	<br><br><center>
		<table id='customers'>
		<th width='150px'>TITLE
		<th width='200px'>INFO
		<tr>
			<td width='150px'>Account</td>
			<td width='200px'>" . $results['account_no'] . "</td>
		</tr>
		<tr>
			<td width='150px'>Start Date</td>
			<td width='200px'>" . $results['start_date'] . "</td>
		</tr>
		<tr>
			<td width='150px'>Expiration Date</td>
			<td width='200px'>" . $results['expire_date'] . "</td>
		</tr>
		<tr>
			<td width='150px'>Member</td>
			<td width='200px'>" . $results['mb_name'] . "</td>
		</tr>
		<tr>
			<td width='150px'>Phone Number</td>
			<td width='200px'>" . $results['phone_no'] . "</td>
		</tr>
		<tr>
			<td width='150px'>Email</td>
			<td width='200px'>" . $results['email'] . "</td>
		</tr>
		<tr>
			<td width='150px'>Age</td>
			<td width='200px'>" . $results['age'] . "</td>
		</tr>
		<tr>
			<td width='150px'>Address</td>
			<td width='200px'>" . $results['addr'] . "</td>
		</tr>
		<tr>
			<td width='150px'>Primary Member</td>
			<td width='200px'>" . $primary . "</td>
		</tr>
		</table>
		</center><br><br>
	";
}
else {
	echo 'There was an error';
}

?>

<a href="javascript:history.back()" class="button">Back</
</body>
</html>
