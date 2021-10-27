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
    <link rel="stylesheet" href="./css/messages.css">
</head>
<body>

    <div id="messages"></div> <p class></p>

    <script src="./js/messages.js"></script>
</body>
</html>