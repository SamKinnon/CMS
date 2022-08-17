<?php
include"db.php";
$c_number = $_GET['c_number'];
$sql = mysqli_query($conn,"delete from contractor WHERE c_number IN(
    SELECT c_number FROM contracts WHERE c_number = '$c_number'"
  ); 
if($sql)
{
    mysqli_close($conn);
    header("location:tables.php");
    exit;
}
else
{
    echo"error deleting records";
}
?>