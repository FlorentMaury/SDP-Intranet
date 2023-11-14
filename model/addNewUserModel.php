<?php

// Vérification du formulaire d'ajout d'un employé.
if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordTwo'])) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $name        = htmlspecialchars($_POST['name']);
    $surname     = htmlspecialchars($_POST['surname']);
    $email       = htmlspecialchars($_POST['email']);
    $password    = htmlspecialchars($_POST['password']);
    $passwordTwo = htmlspecialchars($_POST['passwordTwo']);

    // Les mots de passe sont-ils identiques ?
    if($password != $passwordTwo) {
        header('location: index.php?errorAddNew=1&messageAddNew=Les mots de passe ne sont pas identiques.');
        exit();
    }

    // L'adresse email est-elle correcte ?
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: index.php?errorAddNew=1&messageAddNew=L\'adresse email est invalide.');
        exit();
    }

    // L'adresse email est-elle en doublon ?
    $req = $bdd->prepare('SELECT COUNT(*) as numberEmail FROM user WHERE email = ?');
    $req->execute([$email]);

    // Vérification d'un éventuel doublon.
    while($emailVerification = $req->fetch()) {
        if($emailVerification['numberEmail'] != 0) {
            header('location: index.php?page=dashboard&errorAddNew=1&messageAddNew=Cette adresse e-mail est déjà utilisée.');
            exit();
        }
    }

    // Chiffrement du mot de passe.
    $password = "zk32".sha1($password ."486")."345";

    // Secret.
    $secret = sha1($email).time();
    $secret = sha1($secret).time();

    // Ajouter un utilisateur.
    $req = $bdd->prepare('INSERT INTO user(active, name, surname, email, password, secret) VALUES(?, ?, ?, ?, ?, ?)');
    $result = $req->execute([1, $name, $surname, $email, $password, $secret]);

    $lastInsertId = $bdd->lastInsertId();

    // Ajouter l'utilisateurs aux tables périphériques.
    $req1 = $bdd->prepare('INSERT INTO user_exp(user_exp_id) VALUES(?)');
    $req1->execute([$lastInsertId]);
    
    $req2 = $bdd->prepare('INSERT INTO user_role(user_role_id) VALUES(?)');
    $req2->execute([$lastInsertId]);
    
    $req3 = $bdd->prepare('INSERT INTO user_time_bank(user_time_bank_id) VALUES(?)');
    $req3->execute([$lastInsertId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&newUser=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorAddNew=1&messageAddNew=Impossible d\'enregistrer ce collaborateur.');
        exit();
    };
};
