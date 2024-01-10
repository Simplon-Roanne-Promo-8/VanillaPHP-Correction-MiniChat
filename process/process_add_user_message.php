<?php

date_default_timezone_set('Europe/Paris');


if (!empty($_POST['pseudo'])
    && !empty($_POST['message'])
    && !empty($_POST['adress_ip'])) {

        // Connexion BDD
        require_once '../config/connexion.php';
        
        // Récuperer l'utilisateur
        $preparedRequestGetUser = $connexion->prepare(
            "SELECT * FROM user WHERE pseudo = ?"
        );
        $preparedRequestGetUser->execute([
            $_POST["pseudo"]
        ]);
        $user = $preparedRequestGetUser->fetch(PDO::FETCH_ASSOC);

        // SI il existe je le récupère 
        if ($user) {
            $user_id = $user['id'];
            // SINON je le créer
        }else{
            // Préparer la requête d'insertion dans la table user
            $preparedRequestCreateUser = $connexion->prepare(
                "INSERT INTO user (`pseudo`) VALUES (?)"
            );
            // Execute la requete pour inserer le user 
            $preparedRequestCreateUser->execute([
                $_POST["pseudo"]
            ]);
            // Récuperer l'id de l'utilisateur que je viens de créer
            $user_id = $connexion->lastInsertId();
        }

        // Préparer la requête d'insertion dans la table message
        $preparedRequestCreateMessage = $connexion->prepare(
            "INSERT INTO message (user_id, content, ip_adress, created_at) VALUES(?,?,?,?)"
        );
        // Execute la requete pour inserer le message 
        $preparedRequestCreateMessage->execute([
            $user_id,
            $_POST['message'],
            $_POST['adress_ip'],
            date("Y-m-d H:i:s")
        ]);

        header('Location: ../index.php?success=Le message à bien été enregistré');
}else{
    header('Location: ../index.php?error=Problème lors de l\'enregistrement du message');
}