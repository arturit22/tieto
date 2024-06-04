<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restod";

// Ühenduse loomine andmebaasiga
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}

// Lehekülje numbrile vastavate ridade arvutamine
$records_per_page = 10;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $records_per_page;

// Andmebaasi päringu ettevalmistamine ja tegemine piiratud arvu ridade jaoks
$sql = "SELECT Nimi, Asukoht, Keskmine_hinne, Hinnatud_kordi FROM restokad LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

// Tabeli loomine
if ($result->num_rows > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>Nimi</th>
                    <th>Asukoht</th>
                    <th>Keskmine hinnang</th>
                    <th>Hinnatud kordi</th>
                </tr>
            </thead>
            <tbody>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Nimi"]. "</td>
                <td>" . $row["Asukoht"]. "</td>
                <td>" . $row["Keskmine_hinne"]. "</td>
                <td>" . $row["Hinnatud_kordi"]. "</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "Andmed puuduvad";
}




// Andmebaasi ühenduse sulgemine
$conn->close();
?>
