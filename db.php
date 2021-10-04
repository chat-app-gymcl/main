<?php

// Údaje pro připojení k databázi
$host = "localhost";
$db = "chat";
$user = "root";
$password = "";

// Vytvoření MySQL připojení přes PDO,
// bude nastaveno kódování UTF-8 a při chybě se vyvolá výjimka
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);