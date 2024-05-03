<?php

include("connection.php");

$todaydate = date("Y-m-d");
$query = "SELECT appid, opportunity.oppid, application.status AS appstat, opportunity.status AS oppstat, enddate 
         FROM application, opportunity WHERE application.oppid = opportunity.oppid";
        //joined application and opportunity tables based on oppid
$res = mysqli_query($con, $query);
while ($row = $res->fetch_assoc()) {
    $oppstat = $row['oppstat'];
    $appstat = $row['appstat'];
    $oppid = $row['oppid'];
    $appid = $row['appid'];
    $end_date = $row['enddate'];

    if ($end_date < $todaydate){
        $query2 = "UPDATE opportunity SET status = 'closed' WHERE oppid = '$oppid'";
        $res2 = mysqli_query($con, $query2);
    }
    
    if ($appstat == 'accepted' && $end_date < $todaydate){
        $query3 = "UPDATE application SET status = 'completed' WHERE appid = '$appid'";
        $res3 = mysqli_query($con, $query3);
    } else if ($appstat == 'pending' && $end_date < $todaydate){
        $query3 = "UPDATE application SET status = 'date_passed' WHERE appid = '$appid'";
        $res3 = mysqli_query($con, $query3); 
    } else if ($end_date > $todaydate && $oppstat == 'closed' && $appstat == 'accepted'){
        $query2 = "UPDATE application SET status = 'accepted(event_closed)' WHERE appid = '$appid'";
        $res2 = mysqli_query($con, $query2);
    } else if ($end_date > $todaydate && $oppstat == 'closed' && $appstat == 'pending'){
        $query2 = "UPDATE application SET status = 'pending(event_closed)' WHERE appid = '$appid'";
        $res2 = mysqli_query($con, $query2);
    }
}

$query4 = "SELECT * FROM opportunity";
$res4 = mysqli_query($con, $query4);
while ($row = $res4->fetch_assoc()) {
    $oppid = $row['oppid'];
    $end_date = $row['enddate'];
    $status = $row['status'];

    if ($end_date < $todaydate){
        $status = 'closed';
        $query5 = "UPDATE opportunity SET status = '$status' where oppid = '$oppid'";
        $res5 = mysqli_query($con, $query5);
    }
}
