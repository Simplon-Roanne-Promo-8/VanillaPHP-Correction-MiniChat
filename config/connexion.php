<?php

try {
    $connexion = new PDO('mysql:host=localhost;port=3306;dbname=mini_chat_p8;charset=utf8','root','', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (\Throwable $th) {
    die('erreur db');
}