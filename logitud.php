<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restod";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}

//restorani lisamine andmebaasi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nimi = $conn->real_escape_string($_POST['nimi']);
    $asukoht = $conn->real_escape_string($_POST['asukoht']);
    $sql = "INSERT INTO restokad (Nimi, Asukoht) VALUES ('$nimi', '$asukoht')";
    if (!$conn->query($sql)) {
        echo "Error: " . $conn->error;
    }
    header("Location: logitud.php");
    exit();
}

//restorani kustutamine andmebaasist
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $sql = "DELETE FROM restokad WHERE ID='$id'";
    if (!$conn->query($sql)) {
        echo "Error: " . $conn->error;
    }
    header("Location: logitud.php");
    exit();
}

//restorani muutmine andmebaasis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $nimi = $conn->real_escape_string($_POST['nimi']);
    $asukoht = $conn->real_escape_string($_POST['asukoht']);
    $sql = "UPDATE restokad SET Nimi='$nimi', Asukoht='$asukoht' WHERE ID='$id'";
    if (!$conn->query($sql)) {
        echo "Error: " . $conn->error;
    }
    header("Location: logitud.php");
    exit();
}

$sql = "SELECT * FROM restokad";
$result = $conn->query($sql);

if (!$result) {
    die("Päring ebaõnnestus: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admini leht</title>
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
            position: relative;
        }
        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px 20px;
            background: linear-gradient(45deg, #007bff, #00c6ff);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
            font-weight: bold;
        }
        .logout-button:hover {
            background: linear-gradient(45deg, #00c6ff, #007bff);
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .form-container form {
            width: 48%;
        }
        .form-container input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Tere tulemast admin</h1>
    <a href="logout.php" class="logout-button">Logi välja</a>

    <h2>Restoranide haldamine</h2>

    <div class="form-container">
        <form method="POST" action="logitud.php">
            <h3>Lisa restoran</h3>
            <input type="text" name="nimi" placeholder="Restorani nimi" required>
            <input type="text" name="asukoht" placeholder="Asukoht" required>
            <input type="submit" name="add" value="Lisa">
        </form>

        <form method="POST" action="logitud.php">
            <h3>Muuda restorani</h3>
            <input type="text" name="id" placeholder="Restorani ID" required>
            <input type="text" name="nimi" placeholder="Restorani nimi" required>
            <input type="text" name="asukoht" placeholder="Asukoht" required>
            <input type="submit" name="update" value="Muuda">
        </form>

        <form method="POST" action="logitud.php">
            <h3>Kustuta restoran</h3>
            <input type="text" name="id" placeholder="Restorani ID" required>
            <input type="submit" name="delete" value="Kustuta">
        </form>
    </div>

    <h2>Olemasolevad restoranid</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nimi</th>
            <th>Asukoht</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['id'] . "</td><td>" . $row['Nimi'] . "</td><td>" . $row['Asukoht'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Ei leitud tulemusi</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
<?php
$conn->close();
?>
