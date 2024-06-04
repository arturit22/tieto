<?php
// Kontrollime, kas restorani nimi on URL-i parameetrina saadud
if(isset($_GET['name'])) {
    // Restorani nimi URL-parameetrist
    $restaurant_name = $_GET['name'];

    // Võime suunata teid hinnangu lisamise lehele, kasutades restorani nime
    header("Location: hinnangu_lisamine.php?name=" . urlencode($restaurant_name));
    exit;
} else {
    // Kui restorani nime pole saadud, kuvatakse teade
    echo "Restorani nimi puudub!";
}
?>