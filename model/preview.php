<?php

//ob_start();
session_start();

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

$id = $_GET['user'];
$aboutyou = array();
$regiser = array();

$conn = connection();
$sql = "SELECT * FROM aboutyou WHERE id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($aboutyou, $row);
    }
}
$sql = "SELECT a.id,a.surname,a.othernames,a.department,a.unit,a.quote,a.* FROM aboutyou as a where a.id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($regiser, $row);
    }
}

function memberCount() {
    $conn = connection();
    $sql = "SELECT count(id) as membercount FROM aboutyou";
    $result = $conn->query($sql);
    return $result->num_rows;
}