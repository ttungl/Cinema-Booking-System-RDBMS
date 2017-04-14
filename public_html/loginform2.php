// Brian Okoye
//cmps 460 


<?php
//checks if email and password are set if they are not set user is told they most apply user name and password
if(isset($_POST['email'])&& isset($_POST['password'])){
    
  
///////variables set to input of user....
$usern= $_POST['email'];
   $pass= $_POST['password'];
   
            //if both variables are not empty program begins to query necessary dat.
         if(!empty($usern) && !empty($pass) ){
       
    
           //query member table where email is = to user input to get users account attribute
           $query= "SELECT `account_no` FROM `nwc_member` WHERE `email` = '$usern'";
          // qeuery member table where email is = to user input in usern variable to get user name attribute from row. 
          $query2= "SELECT `mb_name` FROM `nwc_member` WHERE `email` = '$usern'";
            
          
          
           if($query_run = mysql_query($query)){
           
            
                 // save in user variable account number of user
                     $user_id = mysql_result($query_run,0,'account_no');

                         
               
                // query table were user account is equal to user id variable and were the password is equal to user input 
               $accountcheck= "SELECT `account_no` FROM `nwc_member` WHERE `account_no` = '$user_id' AND `password` = '$pass' "; 

                      


                         //if query runs than continue with if statement.
                 if($query_runcheck=mysql_query($accountcheck)){
             
              

                     //checks how many rows the query returns 
                  $query_rows = mysql_num_rows($query_run);
           

//checks how many rows account check query returns
           $query_rowcheck= mysql_num_rows($query_runcheck);

         //runs query 2
          $query_run2= mysql_query($query2);
          
            //if query and accountcheck querys retun 0 rows proceed with if statement
            if($query_rows == 0 || $query_rowcheck == 0){
            
            // query employee table for id where the users input and password match the emp_email and emp_pass attributes. 
              $employequery= "SELECT `emp_id` FROM `nwc_employees` WHERE `emp_email`= '$usern' AND `emp_pass`= '$pass'";
              $employequery2= "SELECT `emp_name` FROM `nwc_employees` WHERE `emp_email`= '$usern' AND `emp_pass`= '$pass'";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               // if employeequery runs checks how many row are returned. 
              if ($queryrunEmp= mysql_query($employequery)){
           $query_rowcheckemp= mysql_num_rows($queryrunEmp);
                
                ///runs employequery2 query.   
              $queryrunEmp2= mysql_query($employequery2);

              //if 1 row is returned takes the attrubute optained from the query and saves it within a session. 
               if ($query_rowcheckemp == 1){

           // saves employee id in a variable from employeequery
             $emp_id= mysql_result($queryrunEmp,0,'emp_id');
            //session is set equal to emp_id variable
                  $_SESSION['empl_id']= $emp_id; 
              //gets employee name from employeequery2 saves in variable
                  $emp_name= mysql_result($queryrunEmp2,0,'emp_name');
              
// session variable set to emp_name variable. 
        $_SESSION['empl_name']= $emp_name; 
// page then jumps to empindex page 
            header('Location: EmpIndex.php');
}
else         {
                echo '<br>';
                echo '<br>';
                echo '<br>';
                 echo '<br>';
                  

                echo '<font size= "5"; color= "red">Your username and password is incorrect </font>';
   }         
}

            
        }
        
        // if query  returns a row and account check returns a row proceed with if else statement. 
      else if ($query_rows == 1 && $query_rowcheck == 1) {
        
           
               //sets variable to attribute obtained by query. 
            $user_name= mysql_result($query_run2,0,'mb_name');
         

////////////////////////Session variable is transfered to UserIndex.php it is equal to the user id.
 $_SESSION['account_no']= $user_id;
////////////////////////Session variable is transfered to UserIndex.php it is equal to the user name.
           


//session variable for user name 
//////////////////////////////////////////////////
 $_SESSION['user_name']= $user_name;
          ////////////////////////////////////////
////        jumps page to user index 
         header('Location: UserIndex.php');
       
           
        }
           
   
}

}
  
  else {
            echo 'did not enter database';
             die(mysql_error());
        }
        
    



} 
      else {
             
            echo '<br>';
                echo '<br>';
                echo '<br>';
                 echo '<br>'; 
          echo '<font color = "red"; size = "5" >YOU MUST APPLY USERNAME AND PASSWORD </font>';
      }
}


?>



<!DOCTYPE html>
  <head><title>New Wave Cinema: Log In</title>
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


</style>



</head>
<body>

 

<div class= "header">


<co><font size="12"> New Wave Cinema </font> </co>  



 </div>


<div align="center"; style="width: 500px; margin: 200px auto 0 auto;">



<login1><input type="submit" value="Log in"></login1>
<form action="<?php echo $current_file; ?> "  method="POST"> 

 



   Email :<input type="email" name="email">  
   Password :<input type="password" name="password"> 





<input type="submit" value="Log in">
 
 

   


  
</form>


</div>

<h2>
        <a href="signup.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-user"></span> Sign Up
        </a>
      
 </h2>

</body>





</html>




    





