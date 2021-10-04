<?php
// Inicializovat sezení
session_start();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Chat 2AV</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="/favicon.png">
</head>
<body>

    <div class="wrapper">
        <form>
            <label for="username">Jméno:</label>
            <input type="text" name="username" id="username" value="<?= $_SESSION["username"] ?? "" ?>">
            <label for="message">Zpráva:</label>
            <input type="text" name="message" id="message">
            <button type="button" onclick="send()">Odeslat</button>
        </form>
    </div>

    <div id="messages"></div>


    <script>
        function send() {
            // Vytvořit AJAX požadavek metodou POST
            $.post("send_message.php", // URL pro požadavek
                {
                    "username" : $("#username").val(), // Objekt s hodnotami pro odeslání
                    "message" : $("#message").val()
                },
                function (data) { // Callback funkce při úspěchu
                    $("#message").val(""); // Smazat obsah pole pro zprávu
                }
            );
            reloadMessages(); // Ihned aktualizujeme právě odeslanou zprávu
        }

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
        setInterval(reloadMessages, 3000);
    </script>
</body>
</html>