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