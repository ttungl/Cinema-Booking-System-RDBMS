<?php

//Brian Okoye
//cmps 460 

require 'sessioncore.php';
require 'connecttophp.php';


if(loggedinEmp()){
/////////////////////////////////////////
////////////////////////////////////////
///////Employee id is returned to this folder to link this infromation

    //if logged in sends user to employee page else back to login form 
    
   include 'Emplpage.php';
  


}


else{
include 'loginform2.php';

}





?>
