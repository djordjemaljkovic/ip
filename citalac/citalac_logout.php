<?php
session_start();
var_dump($_SESSION);
unset($_SESSION['privilegijec']);unset($_SESSION['citalac']);
var_dump($_SESSION);
session_destroy();

?>

<a href='../index.php'>Vratite se na index stranu!</a>

