<?php

//Brian Okoye cmps 460 
////////////////LOG OUT KILLS SESSION......Any time session has to be terminated send link to this file......

require 'sessioncore.php';
session_destroy();
//header('Location: ' .$http_referer);
header('Location: UserIndex.php');

?>
