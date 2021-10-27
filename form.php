<?php
// Inicializovat sezení
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./Auth");
    exit;
}
?>

<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="./styles/form.css">
  </head>
  <body>

    <form action="send_message.php" method="POST" scroll>
        <input type="text" name="message" id="message">
        <button type="button" action="send_message.php" method="POST" onclick="send()"><img src="./img/send-button.png"></button>
    </form>

    <script src="./js/form.js"></script>
</body>
</html>