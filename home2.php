<?php
header("Access-Control-Allow-Origin: *");
$hostName = "localhost"; 
$dbUser = "root";
$dbPass = "F@123iqr1211";    //mysql server username
$dbName = "societyrecords";       //database name

$conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql1 = "SELECT * FROM Meetings";
$sql2 = "SELECT * FROM Owners";
$sql3 = "SELECT * FROM Funds";
$sql4 = "SELECT NoticeID, NoticeTitle, DATE(NoticeDate) AS NoticeDate, NoticeDescription
FROM Notices;";
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);
$result4 = mysqli_query($conn, $sql4);

if (!$result1 || !$result2 || !$result3 || !$result4) {
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
</head>
<body>
    <h1>Society Records</h1>
    <div class="button-container">
        <button class="button" onclick="showContent('meeting')">Meetings</button>
        <button class="button" onclick="showContent('owners')">Apartment Owners</button>
        <button class="button" onclick="showContent('notices')">Notices</button>
        <button class="button" onclick="showContent('funds')">Funds</button> 
    </div>


    <div id="meeting" class="content-container">
        <h2>Meetings</h2>
        <div class="responsive-table">  
            <div class="container">
            <table> 
                <thead class="table-header">
                    <tr>
                    <td>Meeting ID</td>    
                    <td>Meeting Title</td>
                    <td>Meeting Date</td>
                    <td>Venue</td>
                    <td>Agenda</td>
                    <td>Minutes of Meeting</td>
                    </tr> 
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result1)) {
                    $id = $row["MeetingID"];
                    $name = $row["MeetingTitle"];
                    $date = $row["MeetingDate"];
                    $venue = $row["Venue"];
                    $agenda = $row["Agenda"];
                    $mom = $row["MinutesOfMeeting"];
                    echo "<tr class='table-row'>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$date</td>
                    <td>$venue</td>
                    <td>$agenda</td>
                    <td>$mom</td>
                
                    </tr>";
                    }
                    ?>
                </tbody>
            </table><br><br>
            <button class="button" onclick="document.getElementById('addform').style.display='block'">Add New Meeting</button>
            <div id="addform" style="display: none;">   
                <h3>Add New Meeting</h3>
                <form method="post" action="http://localhost:80/sr/add.php">
                    <label for="meeting_name">Meeting Name:</label><br>
                    <input type="text" id="meeting_name" name="meeting_name" required><br><br>
                    <label for="meeting_date">Meeting Date:</label><br>
                    <input type="date" id="meeting_date" name="meeting_date" required><br><br>
                    <label for="venue">Venue:</label><br>
                    <input type="text" id="venue" name="venue" required><br><br>
                    <label for="agenda">Agenda:</label><br>
                    <input type="text" id="agenda" name="agenda" required><br><br>
                    <label for="mom">Minutes of Meeting:</label><br>
                    <textarea id="mom" name="mom" rows="4" required></textarea><br><br>
                    <input name="add_meeting" type="submit" value="Add Meeting">
                </form>
            </div>
            </div>
        </div>
    </div>

    <div id="owners" class="content-container">
        <h2>Apartment Owners</h2>
        <div class="responsive-table">  
            <div class="container">
            <table> 
                <thead class="table-header">
                    <tr>
                    <td>Owner ID</td>
                    <td>Name</td>
                    <td>Room No.</td>
                    <td>Floor No.</td>
                    <td>Apartment Description</td>
                    <td>Date of purchase</td>
                    <td>Contact No.</td>
                    <td colspan="2">Action</td>
                    </tr> 
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_array($result2)) {
                $id = $row["OwnerID"];
                $name = $row["Name"];
                $room = $row["RoomNo"];
                $floor = $row["FloorNo"];
                $desc = $row["ApartmentDescription"];
                $date = $row["DateOfPurchase"];
                $contact = $row["ContactDetails"];
                echo "<tr class='table-row'>
                <td>$id</td>
                <td>$name</td>
                <td>$room</td>
                <td>$floor</td>
                <td>$desc</td>
                <td>$date</td>
                <td>$contact</td>
                <td>
                    <form name='update' action='update.php' method='post'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='submit' value='Edit'>
                    </form>
                </td>
                <td>
                    <form method='POST' action='delete.php' style='display:inline;'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='submit' name='delete' value='Delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>
                    </form>
                </td>
                </tr>";
                }
                ?>
                </tbody>
            </table><br><br>
            <button class="button" onclick="document.getElementById('addowner').style.display='block'">Add New Owners</button>
            <div id="addowner" style="display: none;">   
                <h3>Add New Owners</h3>
                <form method="post" action="http://localhost:80/sr/add.php">
                    <label for="oname">Owner Name:</label><br>
                    <input type="text" id="oname" name="oname" required><br><br>
                    <label for="room">Room No.:</label><br>
                    <input type="text" id="room" name="room" required><br><br>
                    <label for="floor">Floor No.:</label><br>
                    <input type="text" id="floor" name="floor" required><br><br>
                    <label for="desc">Apartment Description:</label><br>
                    <input type="text" id="desc" name="desc" required><br><br>
                    <label for="date_p">Date of Purchase:</label><br>
                    <input type="date" id="date_p" name="date_p"required><br><br>
                    <label for="contact">Contact No:</label><br>
                    <input type="text" id="contact" name="contact" required><br><br>
                    <input name="add_owners" type="submit" value="Add">
                </form>
            </div>
            </div>
        </div>
    </div>

    <div id="notices" class="content-container">
        <h2>Notices</h2>
    
<div id="section-to-fetch"> 
    <?php
    while ($row = mysqli_fetch_array($result4)) {
        $title = $row["NoticeTitle"];
        $date = date("d-m-Y", strtotime($row["NoticeDate"]));
        $desc = $row["NoticeDescription"];
        echo "<div class='notice'>
                <h3>$title</h3>
                <p>$date</p>
                <p>$desc</p>

              </div>";
    }
    ?>
</div>
        <button class="button" onclick="document.getElementById('addnotices').style.display='block'">Add New Notice</button>
            <div id="addnotices" style="display: none;">   
                <h3>Add New Notice</h3>
                <form method="post" action="http://localhost:80/sr/add.php">
                    <label for="title">Title:</label><br>
                    <input type="text" id="title" name="title" required><br><br>
                    <label for="desc">Description:</label><br>
                    <textarea type="text" id="desc" name="desc" rows="4" required></textarea><br><br>
                    <input name="add_notices" type="submit" value="Add">
                </form> </div>
    </div>

    <div id="funds" class="content-container">
        <h2>Funds</h2>
        <div class="responsive-table">  
            <div class="container">
            <table> 
                <thead class="table-header">
                    <tr>
                    <td>Transaction No</td>
                    <td>Owner ID</td>
                    <td>Payment Type</td>
                    <td>Payment Date</td>
                    <td>Amount</td>
                    </tr>    
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_array($result3)) {
                $no = $row["FundID"];
                $id = $row["OwnerID"];
                $type = $row["PaymentType"];
                $date = $row["PaymentDate"];
                $amount = $row["Amount"];
                echo "<tr class='table-row'>
                <td>$no</td>
                <td>$id</td>
                <td>$type</td>
                <td>$date</td>
                <td>$amount</td>
                
                </tr>";
                }
                ?>
                </tbody>
            </table><br><br>
            <button class="button" onclick="document.getElementById('addfunds').style.display='block'">Add Fund Records</button>
            <div id="addfunds" style="display: none;">   
                <h3>Add New Records</h3>
                <form method="post" action="http://localhost:80/sr/add.php">
                    <label for="o_id">Owner ID:</label><br>
                    <input type="text" id="o_id" name="o_id" required><br><br>
                    <label for="desc">Payment Type:</label><br>
                    <textarea type="text" id="desc" name="desc" rows="4" required></textarea><br><br>
                    <label for="pdate">Payment Date:</label><br>
                    <input type="date" id="pdate" name="pdate" required><br><br>
                    <label for="amt">Amount:</label><br>
                    <input type="text" id="amt" name="amt" required><br><br>
                    <input name="add_funds" type="submit" value="Add">
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function showContent(id) {
            // Hide all content containers
            const contents = document.querySelectorAll('.content-container');
            contents.forEach(content => content.style.display = 'none');

            // Show the selected content container
            document.getElementById(id).style.display = 'block';
        }
    </script>
</body>
</html>











<?php
// Check if the form was submitted and if the required fields are present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ownerID = isset($_POST['OwnerID']) ? $_POST['OwnerID'] : null;
    $amount = isset($_POST['Amount']) ? $_POST['Amount'] : null;

    if ($ownerID && $amount) {
        // Database connection
        $conn = new mysqli("localhost", "username", "password", "societyrecords");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if OwnerID exists in the owners table
        $result = $conn->query("SELECT * FROM owners WHERE OwnerID = '$ownerID'");

        if ($result->num_rows > 0) {
            // Proceed with inserting the record
            $query = "INSERT INTO funds (OwnerID, Amount) VALUES ('$ownerID', '$amount')";
            
            if ($conn->query($query) === TRUE) {
                echo "Record added successfully!";
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Invalid OwnerID. Please provide a valid owner.";
        }

        $conn->close();
    } else {
        echo "Error: Please provide both OwnerID and Amount.";
    }
} 
?>

