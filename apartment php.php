<?php
$host = "localhost";
$username = "root";
$password = "F@123iqr";
$dbname = "ssrr";

$conn = new mysqli($localhost, $root, $F@123iqr, $ssrr);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Apartment";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Society Records</title>
    <link rel="stylesheet" href="http://localhost:80/sr/home.css"> 
    <link rel="stylesheet" href=" http://localhost:80/sr/home2.php">
</head>
<body>
    <h1>Society Records</h1>
    <div class="button-container">
        <button class="button" onclick="showContent('apartments')">Apartment</button>
</div>

<div id="apartments" class="content-container">
        <h2>Apartment</h2>
        <div class="responsive-table">  
            <div class="container">
            <table> 
                <thead class="table-header">
                    <tr>
                    <td>AP_ID</td>    
                    <td>Room_No</td>
                    <td>Floor_No</td>
                    <td> Room_Desc</td>
                    <td>Price</td>
                    </tr> 
                </thead>
                <tbody>
                <?php
                    while ($row = mysqli_fetch_array($result1)) {
                    $id = $row["AP_ID"];
                    $name = $row["Room_No"];
                    $date = $row["Floor_no"];
                    $venue = $row["Room_desc"];
                    $agenda = $row["Price"];
                    echo "<tr class='table-row'>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$date</td>
                    <td>$venue</td>
                    <td>$agenda</td>
                    </tr>";
                    }
                    ?>
                </tbody>
            </table><br><br>
            <button class="button" onclick="document.getElementById('addform').style.display='block'">Add Apartment Details</button>
            <div id="addform" style="display: none;">   
                <h3>Add New Meeting</h3>
                <form method="post" action="http://localhost:80/sr/add.php">
                    <label for="apartment_id">AP_ID:</label><br>
                    <input type="" id="" name="" required><br><br>
                    <label for="apartment_id">AP_ID:</label><br>
                    <input type="text" id="apartment_id" name="id" required><br><br>
                    <label for="room_no">Room_No:</label><br>
                    <input type="text" id="room_no" name="name" required><br><br>
                    <label for="room_desc">Room_desc:</label><br>
                    <input type="text" id="room_desc" name="venue" required><br><br>
                    <label for="price">Price:</label><br>
                    <input type="text" id="price" name="agenda" required><br><br>
                    
                    <input name="add_apartment_details" type="submit" value="Add Apartment Details">
                </form>
            </div>
            </div>
        </div>
    </div>


