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

$id = $_GET["user"];
$aboutyou = array();
$regiser = array();

$conn = connection();
if(isset($_GET['clear']) && $_GET['clear']=="1"){
   $sql = "delete from aboutyou where dob='' ";
$result = $conn->query($sql); 
}

$sql = "SELECT * FROM aboutyou WHERE id='$id' ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        array_push($aboutyou, $row);
    }
}
//$sql = "SELECT a.id,a.surname,a.othernames,a.department,a.unit,a.quote,a.* FROM aboutyou as a order by a.othernames asc";
$sql = "SELECT a.id,a.surname,a.othernames,a.department,a.unit,a.quote,a.* FROM aboutyou as a order by a.unit,a.surname";
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
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row["membercount"];
        }
    }
}

if(isset($_GET['chk']) && $_GET['chk']=="true" ){
    if($_GET['surname']!="" && $_GET['othernames']!="")
 $identity= confirm($_GET['surname'], $_GET['othernames']);  
 echo json_encode($identity);
 return exit();
}

function confirm($param1, $param2) {
    $identity = array();
    $conn = connection();
    $sql = "SELECT a.* FROM aboutyou as a where (a.surname = '$param1' and othernames like '%$param2') or (a.surname = '$param2' and othernames like '%$param1') order by a.surname asc limit 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($identity, $row);
        }
    }
    return $identity;
}

