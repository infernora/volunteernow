<?php
session_start();

include("connection.php");
include("vol-functions.php");


$user_data = check_vollogin($con);  
$email = $user_data['email'] ;     

if(isset($_GET['apply'])){
    $oppid = $_GET['apply'];
    $sql = "SELECT * FROM opportunity WHERE oppid='$oppid'";
    $result = $con->query($sql);
  
    if ($result->num_rows > 0){
  
        $row = $result->fetch_assoc();

        $org_name = $row["org_name"];

        $sql1 = "INSERT INTO application (vol_email, org_name, status, oppid) VALUES ('$email','$org_name','pending','$oppid')";
        $result1 = $con->query($sql1);
        if ($result1){
            header("Location:vol-opp.php");
            die;
        }
    } else {
      echo "Not Found";
    }
} 

?>
