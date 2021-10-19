<?php
// Inicializovat sezení
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: Auth");
    exit;
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Zprávy</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="./styles/messages.css">
</head>
<body>

    <div id="messages"></div> <p class></p>

    <script>
        function reloadMessages() {
            // Vytvořit AJAX požadavek metodou GET
            $.get("get_messages.php", function(data) {
                $("#messages").html(data); // Nastavit obsah zpráv na výstup požadavku
            });
        }

        // Prvotně načíst zprávy
        reloadMessages();

        // Vykonat funkci v určeném intervalu
        // 3000 ms = 3 sekundy
        setInterval(reloadMessages, 100);
    </script>
</body>
</html>