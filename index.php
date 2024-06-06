<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoranide nimekiri</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            cursor: pointer;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
            overflow-x: auto;
        }
        .pagination a {
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            border: 1px solid #dddddd;
            margin-right: 5px;
            background-color: #fff;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
        .pagination a:hover {
            background-color: #f2f2f2;
        }
        .pagination a.active {
            background-color: #e5e5e5;
        }
        @media only screen and (max-width: 600px) {
            .pagination a {
                max-width: 50px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
        .logi:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="admin.php" class="logi">Logi sisse</a>

<?php
//andmebaasi andmed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restod";

//andmebaasiga ühendamine
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}

//restoranide hulk ühel leheküljel
$records_per_page = 10;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $records_per_page;

//restoranide sorteerimine
$order_by = "";
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'name_asc':
            $order_by = " ORDER BY Nimi ASC";
            break;
        case 'name_desc':
            $order_by = " ORDER BY Nimi DESC";
            break;
        case 'location_asc':
            $order_by = " ORDER BY Asukoht ASC";
            break;
        case 'location_desc':
            $order_by = " ORDER BY Asukoht DESC";
            break;
        case 'rating_asc':
            $order_by = " ORDER BY Keskmine_hinne ASC";
            break;
        case 'rating_desc':
            $order_by = " ORDER BY Keskmine_hinne DESC";
            break;
        case 'rated_asc':
            $order_by = " ORDER BY Hinnatud_kordi ASC";
            break;
        case 'rated_desc':
            $order_by = " ORDER BY Hinnatud_kordi DESC";
            break;
        default:
            $order_by = "";
            break;
    }
}

//kas otsingus on midagi sisestatud
$search = "";
$search_condition = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $search_condition = "WHERE Nimi LIKE '%$search%'";
}

//andmebaasi päring
$sql = "SELECT id, Nimi, Asukoht, Keskmine_hinne, Hinnatud_kordi FROM restokad $search_condition $order_by LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

//tabel
if ($result->num_rows > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th><a href='?sort=name_asc'>Nimi ▲</a> / <a href='?sort=name_desc'>Nimi ▼</a></th>
                    <th><a href='?sort=location_asc'>Asukoht ▲</a> / <a href='?sort=location_desc'>Asukoht ▼</a></th>
                    <th><a href='?sort=rating_asc'>Keskmine hinnang ▲</a> / <a href='?sort=rating_desc'>Keskmine hinnang ▼</a></th>
                    <th><a href='?sort=rated_asc'>Hinnatud kordi ▲</a> / <a href='?sort=rated_desc'>Hinnatud kordi ▼</a></th>
                </tr>
            </thead>
            <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr onclick=\"location.href='rate.php?id=" . $row['id'] . "'\" style=\"cursor:pointer;\">";
        echo "<td>" . $row["Nimi"] . "</td>";
        echo "<td>" . $row["Asukoht"] . "</td>";
        echo "<td>" . str_repeat('★', round($row["Keskmine_hinne"])) . str_repeat('☆', 10 - round($row["Keskmine_hinne"])) . "</td>";
        echo "<td>" . $row["Hinnatud_kordi"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "Andmed puuduvad";
}

//leheküljed
echo "<div class='pagination'>";
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "&search=" . urlencode($search) . "'>Eelmised</a>";
}
$sql = "SELECT COUNT(*) AS total FROM restokad $search_condition";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $records_per_page);
if ($page < $total_pages) {
    echo "<a href='?page=" . ($page + 1) . "&search=" . urlencode($search) . "'>Järgmised</a>";
}
echo "</div>";

$conn->close();
?>

<div>
    <form method="GET">
        <input type="text" name="search" placeholder="Otsi ettevõtet..." value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Otsi">
    </form>
</div>

</div>
</body>
</html>
