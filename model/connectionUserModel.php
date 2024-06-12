<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérification du formulaire de connexion si venant d'un email.
if(!empty($_POST['email']) && !empty($_POST['password']) && empty($_SESSION)) {

    require_once('./model/connectionDBModel.php');

    // Sécurisation des variables.
    $email     = htmlspecialchars($_POST['email']);
    $password  = htmlspecialchars($_POST['password']);

    // L'adresse email est-elle correcte ?
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: index.php?error=1&Votre adresse email est invalide.');
        exit();
    }

    // Chiffrement du mot de passe.
    $password = "zk32".sha1($password ."486")."345";

    // L'adresse email est-elle bien utilisée ?
    $req = $bdd->prepare('SELECT COUNT(*) as numberEmail FROM user WHERE email = ?');
    $req->execute([$email]);

    // Si l'email n'est pas reconnu.
    while($emailVerification = $req->fetch()) {
        if($emailVerification['numberEmail'] != 1) {
            header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
            exit();
        }
    }

    // Récupérer l'ID de l'utilisateur avec l'email
    $req = $bdd->prepare('SELECT id FROM user WHERE email = ?');
    $req->execute([$email]);
    $user = $req->fetch();

    // Récuperer les données de l'utilisateur avec l'ID.
    $req = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
        WHERE user.id = ?
    ');
    $req->execute([$user['id']]);

    while($user = $req->fetch()) {

        // Si le mot de passe est le bon création d'une session.
        if($password == $user['password']) {

            $_SESSION['connect'] = 1;
            $_SESSION['email']   = $user['email'];
            $_SESSION['id']      = $user['id'];

            if(isset($_GET['user'] ) && isset($_GET['id']) && isset($_GET['hid']) && isset($_GET['action']) && isset($_GET['holidayResponseMail'])) {
                $user   = $_GET['user'];
                $id     = $_GET['id'];
                $hid    = $_GET['hid'];
                $action = $_GET['action'];
                $holidayResponseMail = $_POST['holidayResponseMail'];
                            
                // Créez le lien
                $link = "https://sdp-paris.com/Intranet-SDP/index.php?page=user&holidayResponseMail={$holidayResponseMail}&hid={$hid}&user={$user}&id={$user}&action=userTimeBankButton";
                            
                // Redirigez vers le lien
                header("Location: {$link}");
                exit();
            } else {
                // Validation de la connexion.
                header('location: index.php?page=dashboard&connexion=1&action=generalInfosButton');
                exit();
            }
        } else {
            // Erreur dans le mot de passe.
            header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
            exit();
        }
    }
}