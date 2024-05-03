<?php
session_start();

if(isset($_SESSION['org_id']))
{
    unset($_SESSION['org_id']);
}


header("Location: index.php");
die;
?>