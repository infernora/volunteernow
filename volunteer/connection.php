<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "volunteernow";


if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("Failed to connect to the servers!");
}