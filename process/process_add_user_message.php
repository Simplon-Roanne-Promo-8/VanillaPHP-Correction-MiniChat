<?php
session_start();
date_default_timezone_set('Europe/Paris');

if (empty($_SESSION)) {
    echo json_encode(['success'=> false, 'message'=>'tu n\'es pas conncté', 'status'=>401]);
    die;
}

if (!empty($_POST['pseudo'])
    && !empty($_POST['message'])
    && !empty($_POST['adress_ip'])) {

        // Connexion BDD
        require_once '../config/connexion.php';
        
      

        // Préparer la requête d'insertion dans la table message
        $preparedRequestCreateMessage = $connexion->prepare(
            "INSERT INTO message (user_id, content, ip_adress, created_at) VALUES(?,?,?,?)"
        );
        // Execute la requete pour inserer le message 
        $preparedRequestCreateMessage->execute([
            $_SESSION['id'],
            $_POST['message'],
            $_POST['adress_ip'],
            date("Y-m-d H:i:s")
        ]);

        // Créer un cookie pour engegistrer le pseudode l'utilisateur

        setcookie('pseudo', $_SESSION['pseudo'], time()+3600, '/');
        echo "Le message a été enregistré!";

        // header('Location: ../index.php?success=Le message à bien été enregistré');
}else{
    // header('Location: ../index.php?error=Problème lors de l\'enregistrement du message');
}
