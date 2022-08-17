
<?php
$c_number = $_REQUEST['c_number'];
include "db.php";
if($conn->connect_errno > 0){
    die('Unable to connect to database [' . $conn->connect_error . ']');
}

$sql =   "INSERT INTO contracts SELECT * FROM contractor WHERE c_number='$c_number';";
$sql .=  "DELETE FROM contractor WHERE c_number='$c_number'; ";
$sql .=  "UPDATE contracts SET status ='Ended' WHERE c_number='$c_number'; "; 


if (!$conn->multi_query($sql)) {
    echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
}
else{
    header("Location:dashboard.php");
}

mysqli_multiquery($sql,$conn);
?>