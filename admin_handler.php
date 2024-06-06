<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restod";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kasutajanimi = $conn->real_escape_string($_POST['kasutajanimi']);
    $parool = $conn->real_escape_string($_POST['parool']);

    $sql = "SELECT id FROM admins WHERE kasutajanimi = '$kasutajanimi' AND parool = PASSWORD('$parool')";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $kasutajanimi;
        header("Location: logitud.php");
    } else {
        $_SESSION['error'] = "Vale kasutajanimi või parool";
        header("Location: admin.php");
    }
    exit();
}

$conn->close();
?>