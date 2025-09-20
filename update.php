<?php
    $hostName = "localhost"; 
    $dbUser = "root";
    $dbPass = "F@123iqr";    //mysql server username
    $dbName = "societyrecords";       //database name
    $conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);

    if (!$conn) {
        die("Connection is not successful!");
    }

    // Check if ID is provided
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Fetch the record to be updated
        $sql = "SELECT * FROM Owners WHERE OwnerID = '$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "No record found!";
            exit();
        }
    }

    // If the form is submitted to update the record
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $room = $_POST['room'];
        $floor = $_POST['floor'];
        $desc = $_POST['desc'];
        $date = $_POST['date'];
        $contact = $_POST['contact'];

        // Update the record in the database
        $sql = "UPDATE Owners SET Name='$name', RoomNo='$room', FloorNo='$floor', ApartmentDescription='$desc', DateOfPurchase='$date', ContactDetails='$contact' WHERE OwnerID='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
            alert('Record updated successfully');
            window.location.href = 'http://localhost:80/sr/home2.php'; 
          </script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Owner Record</title>
    <link rel="stylesheet" href="http://localhost:80/sr/home.css"> 
    <style>
    form {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    max-width: 600px;
    margin: 20px auto;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: left;
    }
</style>
</head>
<body>
    <h2>Update Owner Record</h2>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?php echo $row['OwnerID']; ?>">
        <label for="name"> Owner Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="room"> Room No:</label><br>
        <input type="text" id="room" name="room" required><br><br>
        <label for="floor"> Floor No:</label><br>
        <input type="text" id="floor" name="floor" required><br><br>
        <label for="desc"> Apartment Description:</label><br>
        <input type="text" id="desc" name="desc" required><br><br>
        <label for="date">Date of Purchase:</label><br>
        <input type="date" id="date" name="date" required><br><br>
        <label for="contact">Contact No:</label><br>
        <input type="text" id="contact" name="contact" required><br><br>
       <input type="submit" name="update" value="Update">
    </form>
</body>
</html>