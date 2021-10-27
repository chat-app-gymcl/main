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

// Get the modal
var modal = document.getElementById("myModal");
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}