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
        <button type="button" action="send_message.php" method="POST"><img src="/img/send-button.png"></button>
    </form>

    <script>
        function send() {
            // Vytvořit AJAX požadavek metodou POST
            $.post("send_message.php", // URL pro požadavek
                {
                 // Objekt s hodnotami pro odeslání
                    "message" : $("#message").val()
                },
                function (data) { // Callback funkce při úspěchu
                    $("#message").val(""); // Smazat obsah pole pro zprávu
                }
            );
            reloadMessages(); // Ihned aktualizujeme právě odeslanou zprávu
        }
    </script>
</body>
</html>