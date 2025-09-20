<?php
                $hostName = "localhost"; 
                $dbUser = "root";
                $dbPass = "F@123iqr1211";    //mysql server username
                $dbName = "societyrecords";       //database name
                $conn = mysqli_connect($hostName, $dbUser, $dbPass, $dbName);
                if (!$conn) {
                    die("Connection is not successful!");
                }
                $sql = "SELECT * FROM Owners";
                $result = mysqli_query($conn, $sql);
?>
