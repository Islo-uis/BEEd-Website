<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "palengkeGame";

try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass);
} catch (mysqli_sql_exception) {
    echo "Could not Connect!";
}

//db creeattioonnn    
$dbName = "CREATE DATABASE IF NOT EXISTS palengkeGame";
if (mysqli_query($conn, $dbName)) {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} else {
    echo "Error creating database: " . mysqli_error($conn);
}


//CREAATEEE ADDMEEN TIBOOL
$admin = "CREATE TABLE IF NOT EXISTS admin (
        username VARCHAR(750) NOT NULL PRIMARY KEY,
        password VARCHAR(750) NOT NULL
        )";

if (mysqli_query($conn, $admin)) {
    adminAccount();
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$question = "CREATE TABLE IF NOT EXISTS questionTable (
    questionID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    question TEXT NOT NULL,
    choice1 TEXT NOT NULL,
    choice2 TEXT NOT NULL,
    choice3 TEXT NOT NULL,
    choice4 TEXT NOT NULL,
    correctAnswer VARCHAR(2),
    difficulty INT NOT NULL,
    levell INT NOT NULL
)";


if (mysqli_query($conn, $question)) {
} else {
    echo "Error creating table: " . mysqli_error($conn);
}



//CREAATEEE LOGSSS TIBOOL
$logs = "CREATE table if not exists logs (action varchar(500), actionType varchar(500) , clientID int, actionMade DATETIME) ";
if (mysqli_query($conn, $logs)) {
} else {
    echo "Error creating table: " . mysqli_error($conn);
}


function adminAccount()
{
    global $conn;
    
    // Query to check if admin account exists
    $sql = "SELECT * FROM admin";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 0) {
        $createAdmin = "INSERT INTO admin values ('admin', 'password') ";
        if (mysqli_query($conn, $createAdmin)) {
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
