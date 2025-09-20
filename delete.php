<?php
$hostName = "localhost"; 
$dbUser = "root";
$dbPass = "F@123iqr1211";    // MySQL server username
$dbName = "societyrecords";       // Database name
$conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);
if (!$conn) {
    die("Connection is not successful!");
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM Owners WHERE OwnerID = '$id'";


    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Record deleted successfully');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
              </script>";
    } else {
        // Handle error
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
