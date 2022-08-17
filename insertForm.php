<?php
include "db.php"; // Using database connection file here
$c_number =  $_REQUEST['c_number'];
$c_title =  $_REQUEST['c_title'];
$c_client =  $_REQUEST['c_client'];
$c_partner =  $_REQUEST['c_partner'];
$c_sp =  $_REQUEST['c_sp'];
$c_amount =  $_REQUEST['c_amount'];
$c_enddate=  $_REQUEST['c_enddate'];
$c_manager=  $_REQUEST['c_manager'];
$c_date =  $_REQUEST['c_date'];
//$c_attachment =  $_REQUEST['c_attachment'];

if (isset($_POST['submit'])) { 
    $filename = $_FILES['c_attachment']['name'];

    // destination of the file on the server
    $destination = 'myfile/' .$filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['c_attachment']['tmp_name'];
    $size = $_FILES['c_attachment']['size'];

    if (!in_array($extension, ['pdf','docx'])) {
        echo "You file extension must be .pdf only";
    } elseif ($_FILES['c_attachment']['size'] > 5000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO contractor (c_number, c_title, c_client,c_partner,c_sp,c_amount,c_enddate,c_manager,c_date,status,c_attachment)
VALUES ('$c_number', '$c_title', '$c_client', '$c_partner', '$c_sp', '$c_amount', '$c_enddate', '$c_manager', '$c_date','Going', '$filename');";

            if (mysqli_query($conn, $sql)) {
                header("Location: forms.php?st=success");
            }
        } else {
            header("Location: forms.php?st=Fail");
        }
    }
}
$conn->close();
?>