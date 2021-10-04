<?php
// Ověření, jestli není jméno nebo zpráva prázdná
if (!empty($_POST["username"]) && !empty($_POST["message"])) {

    // Inicializovat sezení
    session_start();

    // Vytvořit spojení s databází ze souboru db.php
    require "db.php";

    // Připravit SQL dotaz
    $query = $pdo->prepare("INSERT INTO `messages` (`username`, `message`, `time`) VALUES (?, ?, ?)");

    // Vykonat dotaz s parametry
    $query->execute([
        $_POST["username"],
        $_POST["message"],
        time() // Aktuální čas v unixovém formátu
    ]);

    // Nastavit jméno do sezení pro zapamatování
    $_SESSION["username"] = htmlspecialchars($_POST["username"]);
}