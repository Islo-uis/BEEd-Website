<?php
include "../db.php";


if ($_GET['action'] == "getLevels") {

    header('Content-Type: application/json');
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
    }

    $difficulty = $_POST['difficulty'];

    $sql = "SELECT questionID, levell from questiontable where difficulty = '$difficulty'";
    $result = mysqli_query($conn, $sql);

    $levelData = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $levelData[] = [
                "id" => $row['questionID'],
                "level" => $row['levell']
            ];
        }
    }

    mysqli_close($conn);
    echo json_encode($levelData);
}

if ($_GET['action'] == "addQuestion") {

    header('Content-Type: application/json');
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
    }

    $difficulty = $_POST['difficulty'];
    $level = $_POST['level'];
    $question = $_POST['question'];
    $choice1 = $_POST['choice1'];
    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];
    $choice4 = $_POST['choice4'];
    $correct = $_POST['correct'];

    $sql = "SELECT levell from questiontable where difficulty = '$difficulty' order by levell desc limit 1";
    $result = mysqli_query($conn, $sql);

    $lastLevel = 0;
    $levell = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $level = (int)$row['levell'];
        }
    }
    $lastLevel = $levell + 1;
    $stmt = $conn->prepare("INSERT INTO questiontable VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiii", $question, $choice1, $choice2, $choice3, $choice4, $correct, $difficulty, $lastLevel);
    $stmt->execute();
    $stmt->close();

    mysqli_close($conn);
    echo json_encode($lastLevel);
}


if ($_GET['action'] == "getLevelDetails") {

    header('Content-Type: application/json');
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
    }

    $questionID = $_POST['questionID'];

    $sql = "SELECT * from questiontable where questionID = '$questionID'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $question = $row['question'];
            $choice1 = $row['choice1'];
            $choice2 = $row['choice2'];
            $choice3 = $row['choice3'];
            $choice4 = $row['choice4'];
            $correct = $row['correctAnswer'];
            $difficulty = $row['difficulty'];
            $level = $row['levell'];
        }
    }

    mysqli_close($conn);
    echo json_encode([
        "question" => $question, 
        "choice1" => $choice1, 
        "choice2" => $choice2, 
        "choice3" => $choice3, 
        "choice4" => $choice4, 
        "correct" => $correct, 
        "difficulty" => $difficulty, 
        "level" => $level, 
    ]);
}
