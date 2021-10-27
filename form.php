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
  </head>
  <body>

  <form scroll>
        <input type="text" name="message" id="message">
        <button type="button" onclick="send()"><img src="./img/send-button.png"></button>
    </form>

<!-- Trigger/Open The Modal -->
  <button id="myBtn"><img src="./img/send-button.png"></button>
<!-- The Modal -->
  <div id="myModal" class="modal">
  <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <iframe src="./files/"></iframe>
    </div>
  </div>

    <script src="./js/form.js"></script>
</body>
</html>