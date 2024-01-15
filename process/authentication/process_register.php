<?php
session_start();

if (!empty($_POST['email'])
    && !empty($_POST['pseudo'])
    && !empty($_POST['password']) ) {
        
        require_once '../../config/connexion.php';

        $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $preparedRequestCreateUser = $connexion->prepare(
            "INSERT INTO user (`pseudo`, `password`, `email`) VALUES (?,?,?)"
        );
        // Execute la requete pour inserer le user 
        $preparedRequestCreateUser->execute([
            $_POST["pseudo"],
            $hashed_password,
            $_POST["email"]
        ]);

        $_SESSION['id'] = $connexion->lastInsertId();
        $_SESSION['pseudo'] = $_POST["pseudo"];
        $_SESSION['email'] = $_POST["email"];

        header('Location: ../../index.php?success=Votre compte a bien été créé !');
}else{
    header('Location: ../../register.php?error=Erreur dans la création du compte');

}