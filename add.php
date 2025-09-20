<?php
$hostName = "localhost"; 
$dbUser = "root";
$dbPass = "F@123iqr1211"; // Database password
$dbName = "societyrecords"; // Database name
$conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql1 = "SELECT * FROM Meetings";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * FROM Funds";
$result2 = mysqli_query($conn, $sql2); 

$sql3 = "SELECT * FROM Owners";
$result3 = mysqli_query($conn, $sql3); 

$sql4 = "SELECT * FROM Notices";
$result4 = mysqli_query($conn, $sql4); 

// Insert new meeting into the database
if (isset($_POST['add_meeting'])) {
    // Retrieve form data from POST request
    $name = mysqli_real_escape_string($conn, $_POST["meeting_name"]);
    $date = mysqli_real_escape_string($conn, $_POST["meeting_date"]);
    $venue = mysqli_real_escape_string($conn, $_POST["venue"]);
    $agenda = mysqli_real_escape_string($conn, $_POST["agenda"]);
    $mom = mysqli_real_escape_string($conn, $_POST["mom"]);

    // Insert query without M_ID (since it will auto-increment)
    $sql_insert1 = "INSERT INTO Meetings (MeetingTitle, MeetingDate, Venue, Agenda, MinutesOfMeeting) 
                    VALUES ('$name', '$date', '$venue', '$agenda', '$mom')";

    if (mysqli_query($conn, $sql_insert1)) {
        echo "<script>alert('New meeting added successfully');
              window.location.href = 'http://localhost:80/sr/home2.php'; 
              </script>";
    } else {
        echo "Error: " . $sql_insert1 . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['add_funds'])) {
    // Retrieve form data from POST request
    $id = mysqli_real_escape_string($conn, $_POST["o_id"]);
    $type = mysqli_real_escape_string($conn, $_POST["desc"]);
    $date = mysqli_real_escape_string($conn, $_POST["pdate"]);
    $amt = mysqli_real_escape_string($conn, $_POST["amt"]);

    // Insert query without M_ID (since it will auto-increment)
    $sql_insert2 = "INSERT INTO Funds (OwnerID, PaymentType, PaymentDate, Amount) 
                    VALUES ('$id', '$type', '$date', '$amt')";

    if (mysqli_query($conn, $sql_insert2)) {
        echo "<script>alert('New record added successfully');
              window.location.href = 'http://localhost:80/sr/home2.php'; 
              </script>";
    } else {
        echo "Error: " . $sql_insert2 . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['add_owners'])) {
    // Retrieve form data from POST request
    $name = mysqli_real_escape_string($conn, $_POST["oname"]);
    $room = mysqli_real_escape_string($conn, $_POST["room"]);
    $floor = mysqli_real_escape_string($conn, $_POST["floor"]);
    $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
    $date = mysqli_real_escape_string($conn, $_POST["date_p"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);

    // Insert query without M_ID (since it will auto-increment)
    $sql_insert3 = "INSERT INTO Owners (Name, RoomNo, FloorNo, ApartmentDescription, DateOfPurchase, ContactDetails) 
                    VALUES ('$name', '$room', '$floor', '$desc', '$date', '$contact')";

    if (mysqli_query($conn, $sql_insert3)) {
        echo "<script>alert('New record added successfully');
              window.location.href = 'http://localhost:80/sr/home2.php'; 
              </script>";
    } else {
        echo "Error: " . $sql_insert3 . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['add_notices'])) {
    // Retrieve form data from POST request and escape to prevent SQL injection
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $desc = mysqli_real_escape_string($conn, $_POST["desc"]);

    // Validate and check the 'date' field, set current date if empty
    if (!empty($_POST["date"])) {
        // Convert the date format
        $date = mysqli_real_escape_string($conn, $_POST["date"]);
        $dateObject = DateTime::createFromFormat('d-m-Y', $date);
        if ($dateObject === false) {
            die("Invalid date format");
        }
        $formattedDate = $dateObject->format('Y-m-d');
    } else {
        // Set current date if no date is provided
        $formattedDate = date('Y-m-d'); // Use the correct format here
    }

    // Insert query without NoticeID (it will auto-increment)
    $sql_insert4 = "INSERT INTO Notices (NoticeTitle, NoticeDate, NoticeDescription) 
                    VALUES ('$title', '$formattedDate', '$desc')";

    // Execute query and check for success
    if (mysqli_query($conn, $sql_insert4)) {
        echo "<script>
                alert('New record added successfully');
                window.location.href = 'http://localhost:80/sr/home2.php'; 
              </script>";
    } else {
        echo "Error: " . $sql_insert4 . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);


