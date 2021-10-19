<?php
// Vytvořit spojení s databází ze souboru db.php
require "db.php";

// Připravit SQL dotaz
// Vybrat vše z tabulky "chat", řadit sestupně podle sloupce pro čas
$query = $pdo->prepare("SELECT * FROM `messages` ORDER BY `time` DESC");

// Vykonat připravený dotaz
$query->execute();

// Získat všechny řádky z dotazu
$messages = $query->fetchAll();

// Iterovat přes každý řádek a vypsat jej
foreach ($messages as $message) {
    echo "<p class='mess_date'>" . date("d. m. H:i:s", $message["time"]) . ") </p> <p class='mess_user'>" . htmlspecialchars($message["username"]) . "</p> <p class='mess'> " . htmlspecialchars($message["message"]) . "";
}