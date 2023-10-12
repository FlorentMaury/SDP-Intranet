<?php

// Vérification du formulaire de connexion.
if(!empty($_POST['email']) && !empty($_POST['password']) && empty($_SESSION)) {

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

    // Connexion si le mot de passe est le bon.
    $req = $bdd->prepare('SELECT * FROM user WHERE email = ?');
    $req->execute([$email]);

    while($user = $req->fetch()) {
        // Si le mot de passe est le bon création d'une session.
        if($password == $user['password']) {
            $_SESSION['connect'] = 1;
            $_SESSION['email']   = $user['email'];
            $_SESSION['id']      = $user['id'];
            $_SESSION['surname'] = $user['surname'];
            $_SESSION['name']    = $user['name'];
            $_SESSION['sex']     = $user['sex'];
            $_SESSION['password']       = $user['password'];
            $_SESSION['birth_date']     = $user['birth_date'];
            $_SESSION['phone_number']   = $user['phone_number'];
            $_SESSION['birth_city']     = $user['birth_city'];
            $_SESSION['birth_country']  = $user['birth_country'];
            $_SESSION['current_street_number']  = $user['current_street_number'];
            $_SESSION['current_city_street']    = $user['current_city_street'];
            $_SESSION['current_city']           = $user['current_city'];
            $_SESSION['current_country']        = $user['current_country'];
            $_SESSION['id_number']              = $user['id_number'];
            $_SESSION['social_security_number'] = $user['social_security_number'];
            $_SESSION['creation_date']          = $user['creation_date'];
            $_SESSION['contract_level']         = $user['contract_level'];
            $_SESSION['contract_coef']          = $user['contract_coef'];
            $_SESSION['contract_remuneration']  = $user['contract_remuneration'];
            $_SESSION['contract_weekly']        = $user['contract_weekly'];
            $_SESSION['user_absence']    = $user['user_absence'];
            $_SESSION['user_delay']      = $user['user_delay'];
            $_SESSION['user_illness']    = $user['user_illness'];
            $_SESSION['user_extra_time'] = $user['user_extra_time'];

            // Validation de la connexion.
            header('location: index.php?page=dashboard');
            exit();
        } else {
            // Erreur dans le mot de passe.
            header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
            exit();
        }
    }
}
    
?>