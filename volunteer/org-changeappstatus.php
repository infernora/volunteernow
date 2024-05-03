<?php
session_start();

include("connection.php");
include("org-functions.php");

$user_data = check_login($con);  
$org_name = $user_data['name'] ;     

if(isset($_GET['change'])){
    $deets  = $_GET['change'];
    $info = explode('-',$deets);
    $status = $info[0];
    $appid = $info[1];

    if ($status == 'accepted'){
        $sql = "UPDATE application SET status = '$status' WHERE appid='$appid'";
        $result = $con->query($sql);
        if ($result) {
            $sql2 = "SELECT * FROM application WHERE appid = '$appid'";
            $result2 = $con->query($sql2);
            if ($result2->num_rows > 0){
                $row = $result2->fetch_assoc();
                $oppid = $row['oppid'];
                $sql3 = "UPDATE opportunity SET vol_found = vol_found + 1 WHERE oppid='$oppid'";
                $result3 = $con->query($sql3);
                if ($result3){
                    header("Location:org-pendingreq.php");
                }
            }
        }
    } else if ($status == 'rejected'){
        $sql = "UPDATE application SET status = '$status' WHERE appid='$appid'";
        $result = $con->query($sql);
        if ($result) {
            header("Location:org-pendingreq.php");
        }
    }
} 

?>