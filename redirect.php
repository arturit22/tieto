<?php
if(isset($_GET['name'])) {
    $restaurant_name = $_GET['name'];

    header("Location: hinnangu_lisamine.php?name=" . urlencode($restaurant_name));
    exit;
} else {
    echo "Restorani nimi puudub!";
}
?>