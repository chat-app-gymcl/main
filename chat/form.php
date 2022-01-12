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
    <link rel="stylesheet" href="./css/form.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  </head>
  <body>

  <form scroll>
        <input type="text" name="message" id="message">
        <button type="button" onclick="send()"><img src="./img/send-button.png"></button>
    </form>

    <script src="./js/form.js"></script>
</body>
</html>