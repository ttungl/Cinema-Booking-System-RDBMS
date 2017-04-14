<?php
//Brian Okoye cmps 460 
///////connects to mysql 
$host = "";
$user = "groupE";
$password = "cmps460";
$database = "cs4601_groupE";


$resourcc= mysql_connect($host,$user,$password);


if(!mysql_connect($host,$user,$password) || !mysql_select_db($database)){
    
    die(mysql_error());
    
}


?>
