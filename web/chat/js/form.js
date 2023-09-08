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
}