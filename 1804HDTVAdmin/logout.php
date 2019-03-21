<?php
session_start();

// remove all session variables
//session_unset(); 

// destroy the session 
//session_destroy(); 

unset($_SESSION["uID"]);
unset($_SESSION["uName"]);
unset($_SESSION["sRole"]);
unset($_SESSION["sRight"]);
unset($_SESSION["loggedin"]);

header("Location: index.php");
?>