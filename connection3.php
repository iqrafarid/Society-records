<?php
$hostName = "localhost"; 
$dbUser = "root";
$dbPass = "F@iqr123";    // MySQL server username
$dbName = " Society_records";       // Database name
$conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM Owners WHERE Owner_ID = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Record deleted successfully');
                window.location.href = "C:\xampp\htdocs\sr\connection3.php";
              </script>";
    } else {
        // Handle error
        echo "Error deleting record: " . mysqli_error($conn);
    }
}