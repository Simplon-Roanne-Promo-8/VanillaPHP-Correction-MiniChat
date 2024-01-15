<?php

require_once "../../config/connexion.php";

$preparedRequest =  $connexion->prepare(
    "SELECT * FROM message 
    JOIN user
        ON user.id = message.user_id
    ORDER BY message.created_at ASC
    "
);
$preparedRequest->execute();
$messages = $preparedRequest->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($messages);