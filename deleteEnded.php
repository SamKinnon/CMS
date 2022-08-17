
<?php
$c_number = $_REQUEST['c_number'];
include "db.php";
if($conn->connect_errno > 0){
    die('Unable to connect to database [' . $conn->connect_error . ']');
}
$sql =  "DELETE FROM contracts WHERE c_number='$c_number'; "; 

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
  header("Location:dashboard.php");
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>