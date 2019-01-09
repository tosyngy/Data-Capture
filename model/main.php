<?php

//ob_start();
session_start();

// Create connection
function connection() {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "yctcudatacapture";


    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

if (isset($_GET["save"])) {
    insertIntoDB();
}

function insertIntoDB() {
    $conn = connection();
    $uid = $_SESSION["id"];

    if ($_GET["save"] == "biodata") {
        $surname = $conn->real_escape_string($_POST["surname"]);
        $othernames = $conn->real_escape_string($_POST["othernames"]);
        $dob = $conn->real_escape_string($_POST["dob"]);
        $address = $conn->real_escape_string($_POST["address"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $department = $conn->real_escape_string($_POST["department"]);
        $level = $conn->real_escape_string($_POST["level"]);
        $quote = $conn->real_escape_string($_POST["quote"]);
        $mobileno = $conn->real_escape_string($_POST["mobileno"]);
        $unit = $conn->real_escape_string($_POST["unit"]);
        $img = $conn->real_escape_string($_POST["img"]);
        $id = $conn->real_escape_string($_POST["id"]);

        if ($img == "")
            $sql = "UPDATE `yctcudatacapture`.`aboutyou`  SET `user_id`='$uid', `surname`='$surname',`mobileno`='$mobileno', `othernames`='$othernames',`dob`='$dob', `department`='$department',`level`='$level', `email`='$email', `address`='$address', `unit`='$unit', `quote`='$quote' where id='$id'";
        else
            $sql = "UPDATE `yctcudatacapture`.`aboutyou`  SET `user_id`='$uid', `surname`='$surname',`mobileno`='$mobileno', `othernames`='$othernames',`dob`='$dob', `department`='$department',`level`='$level', `email`='$email', `address`='$address', `unit`='$unit', `quote`='$quote', `pix`='$img' where id='$id'";


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>


