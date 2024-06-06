<?php
//andmebaasi andmed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restod";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}

//võtab infot väljadest
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];

    //sisestab andmed sqli
    $sql = "INSERT INTO hinnangud (kasutajanimi, hinnang, kommentaar) VALUES ('$username', '$rating', '$comment')";
    if ($conn->query($sql) === TRUE) {
        echo "Hinnang edukalt lisatud. <a href='index.php'>Tagasi avalehele</a>";
    } else {
        echo "Viga: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
