function showNotification() {
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