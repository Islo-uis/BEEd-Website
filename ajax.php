<?php
header('Content-Type: application/json');
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palengkeGame";
// Create connection

if (isset($_GET["action"])) {
    if ($_GET["action"] == 'getLevel') {
        header('Content-Type: application/json');
        $conn = new mysqli($servername, $username, $password, $dbname);

        if (!$conn) {
            die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
        }
        $difficulty = $_POST['difficulty'];

        $sql = "SELECT COUNT(questionID) as 'count' from questiontable where difficulty = '$difficulty';";
        $result = mysqli_query($conn, $sql);

        $count = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $count = $row["count"];
            }
        }

        mysqli_close($conn);
        echo json_encode([
            "count" => $count,
        ]);
    }


    if ($_GET["action"] == 'getCreds') {
        header('Content-Type: application/json');
        $conn = new mysqli($servername, $username, $password, $dbname);

        if (!$conn) {
            die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT 1 as 'status' from admin where username = '$username' and password = '$password'";
        $result = mysqli_query($conn, $sql);

        $exists = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $exists = $row["status"];
            }
        }

        mysqli_close($conn);
        echo json_encode([
            "exists" => $exists,
        ]);
    }
}
