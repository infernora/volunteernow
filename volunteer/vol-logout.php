<?php
session_start();

if(isset($_SESSION['vid']))
{
    unset($_SESSION['vid']);
}


header("Location: index.php");
die;
?>