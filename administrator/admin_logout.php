<?php
session_start();
var_dump($_SESSION);
unset($_SESSION['privilegijea']);unset($_SESSION['administrator']);
var_dump($_SESSION);
session_destroy();


header('location:adminlogin.php');

?>


