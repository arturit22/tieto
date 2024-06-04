<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restod";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $kasutajanimi = $conn->real_escape_string($_POST["kasutajanimi"]);
    $hinnang = $conn->real_escape_string($_POST["hinnang"]);
    $kommentaar = $conn->real_escape_string($_POST["kommentaar"]);
    $errors = [];

    if (empty($kasutajanimi)) {
        $errors[] = "Kasutajanimi on kohustuslik.";
    }
    if (empty($hinnang)) {
        $errors[] = "Hinnang on kohustuslik.";
    }
    if (empty($kommentaar)) {
        $errors[] = "Kommentaar on kohustuslik.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO hinnangud (kasutajanimi, hinnang, kommentaar, restoran_id) VALUES ('$kasutajanimi', '$hinnang', '$kommentaar', '$id')";
        if ($conn->query($sql) === TRUE) {
            // Uuenda restoran tabelit
            $update_sql = "UPDATE restokad 
                           SET Keskmine_hinne = (SELECT AVG(hinnang) FROM hinnangud WHERE restoran_id = '$id'), 
                               Hinnatud_kordi = (SELECT COUNT(*) FROM hinnangud WHERE restoran_id = '$id') 
                           WHERE id = '$id'";
            if ($conn->query($update_sql) === TRUE) {
                header("Location: index.php");
                exit;
            } else {
                echo "Viga andmete uuendamisel: " . $conn->error;
            }
        } else {
            echo "Viga: " . $sql . "<br>" . $conn->error;
        }
    }
}

$id = $_GET["id"];
$sql = "SELECT Nimi FROM restokad WHERE id = '$id'";
$result = $conn->query($sql);
$resto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisa hinnang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
<h2>Lisa hinnang - <?php echo $resto['Nimi']; ?></h2>

<?php
if (!empty($errors)) {
    echo '<div class="error"><ul>';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul></div>';
}
?>

<form method="POST" action="rate.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="kasutajanimi">Kasutajanimi:</label><br>
    <input type="text" id="kasutajanimi" name="kasutajanimi" value="<?php echo isset($kasutajanimi) ? $kasutajanimi : ''; ?>"><br><br>
    <label for="hinnang">Hinnang:</label><br>
    <?php
    for ($i = 1; $i <= 10; $i++) {
        echo "<input type='radio' id='hinnang$i' name='hinnang' value='$i'" . (isset($hinnang) && $hinnang == $i ? " checked" : "") . "><label for='hinnang$i'>$i</label>";
    }
    ?><br><br>
    <label for="kommentaar">Kommentaar:</label><br>
    <textarea id="kommentaar" name="kommentaar"><?php echo isset($kommentaar) ? $kommentaar : ''; ?></textarea><br><br>
    <input type="submit" value="Saada">
</form>

<?php
$sql = "SELECT * FROM hinnangud WHERE restoran_id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h3>Teiste hinnangud</h3>";
    while ($row = $result->fetch_assoc()) {
        echo "<div><strong>" . $row["kasutajanimi"] . ":</strong> " . str_repeat('★', $row["hinnang"]) . str_repeat('☆', 10 - $row["hinnang"]) . "<br>" . $row["kommentaar"] . "<br><br></div>";
    }
} else {
    echo "<p>Hinnangud puuduvad</p>";
}
?>

<a href="index.php">Tagasi avalehele</a>

</div>
</body>
</html>
