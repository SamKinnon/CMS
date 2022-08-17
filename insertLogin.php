<?php
include "db.php"; // Using database connection file here
$name =  $_REQUEST['username'];
$password =  $_REQUEST['password'];
$email =  $_REQUEST['email'];

if (isset($_POST['submit'])) { 
    $filename = $_FILES['image']['name'];

    // destination of the file on the server
    $destination = 'img/' .$filename;

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];

    if ($_FILES['image']['size'] > 5000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO user (username, password, email, image)
VALUES ('$name', '$password','$email','$filename');";

            if (mysqli_query($conn, $sql)) {
                header("Location: profile.php?st=success");
            }
        } else {
            header("Location: profile.php?st=Fail");
        }
    }
}
$conn->close();

?>