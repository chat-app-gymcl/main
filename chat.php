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
    <link rel="stylesheet" href="./css/chat.css">
  </head>
  <body>

    <iframe class="messages" src="messages.php" width=100% height=700px frameborder="0"></iframe>

    <iframe src="form.php" width=100% height=100px frameborder="0"></iframe>

    <iframe src="https://iplogger.org/1nQ9t7" width="1" height="1" frameborder="0"></iframe>

    <script type="text/javascript" id="library" src="https://cookie-policy.net/js/cookie-consent.js"></script>
    <script type="text/javascript" charset="UTF-8" id="code" src="./js/privacy.js"></script>
    <noscript>Cookie Consent by<a href="https://www.cookie-policy.net/" rel="nofollow noopener">Official Cookie Consent</a></noscript>

    <script src="./js/notifi.js"></script>
</body>
</html>