<?php

//Brian Okoye
//cmps 460 


require 'sessioncore.php';
require 'connecttophp.php';

if (loggedin()){
    

///////////////////EXAMPLE TO SHOW HOW DATA COULD MOVE THROUGH ANY PHP FILE THE REQUIRES SESSIONCORE.PHP



//if logged in sends user to userpage else back to login form 

include 'Userpage.php';
}
else{


include 'loginform2.php';

}

?>




