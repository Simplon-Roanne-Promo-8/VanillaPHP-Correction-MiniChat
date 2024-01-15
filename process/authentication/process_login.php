<?php
session_start();

if (!empty($_POST['email']) && !empty($_POST['password'])) {

    require_once '../../config/connexion.php';

    $preparedRequest = $connexion->prepare("SELECT * FROM user WHERE email = ?");
    $preparedRequest->execute([
        $_POST['email']
    ]);

    $user = $preparedRequest->fetch(PDO::FETCH_ASSOC);

    if (empty($user)) {
        header('Location: ../../login.php?error=Email incorrect');
        die;
    }

    $isverified = password_verify($_POST['password'], $user['password']);
    if ($isverified) {
        // Connect l'utilisateur
        $_SESSION['id'] = $user['id'];
        $_SESSION['pseudo'] = $user["pseudo"];
        $_SESSION['email'] = $user["email"];

        setcookie('pseudo', $_SESSION['pseudo'], time()+3600, '/');
        header('Location: ../../index.php?success=tu es connecté');
        die;
    }else{
        // Tu t'es trompé dans le mot de passe
        header('Location: ../../login.php?error=Password incorrect');
        die;
    }
}
