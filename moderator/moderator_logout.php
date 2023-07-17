<?php
session_start();
var_dump($_SESSION);
unset($_SESSION['privilegijem']);unset($_SESSION['moderator']);
var_dump($_SESSION);
session_destroy();

?>

<a href='../index.php'>Vratite se na index stranu!</a>
