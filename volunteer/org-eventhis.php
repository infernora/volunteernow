<?php




$sql1 = "SELECT * FROM opportunity WHERE org_name = '$org_name'";
$result1 = mysqli_query($con, $sql1);
while ($row = $result1->fetch_assoc()) {
    $oppid = $row['oppid'];
    $name = $row['name'];
    $location = $row['location'];
    $skill = $row['skill'];
    $description = $row['description'];
    $vol_num = $row['vol_num'];
    $start_date = $row['startdate'];
    $end_date = $row['enddate'];
    $status = $row['status'];
    $today = date('Y-m-d');
    $vol_found = $row['vol_found'];

    if ($end_date < $today){
        $status = 'closed';
        $sql2 = "UPDATE opportunity SET status = '$status' where oppid = '$oppid'";
        $res2 = mysqli_query($con, $sql2);
    }
}

?>