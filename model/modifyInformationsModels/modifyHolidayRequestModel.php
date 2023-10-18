<?php

    // Fonction qui permet l'acceptation ou non d'une demande de CA.
    if(
        !empty($_POST['holiday1Request'])
    ) {

   // Connexion à la base de données.
   require('./model/connectionDBModel.php');

   // Variables.
   $holiday1Request = htmlspecialchars($_POST['holiday1Request']);
   $userId          = $_GET['id'];

   // Sélection de l'ID.
   $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
   $r->execute([$userId]);
   $userModifiedId = $r->fetchColumn();

   // Modification des modifications dans la base de données.
   $req = $bdd->prepare('UPDATE user SET holiday1_response = ? WHERE id = ?');
   $req->execute([$holiday1Request, $userModifiedId]);

   // Redirection.
   header('location: index.php?page=dashboard');
   exit();
    }

    // Fonction qui permet l'acceptation ou non d'une seconde demande de CA.
    if(
        !empty($_POST['holiday2Request'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holiday2Request = htmlspecialchars($_POST['holiday2Request']);
    $userId          = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday2_response = ? WHERE id = ?');
    $req->execute([$holiday2Request, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
    }

    // Fonction qui permet l'acceptation ou non d'une troisième demande de CA.
    if(
        !empty($_POST['holiday3Request'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holiday3Request = htmlspecialchars($_POST['holiday3Request']);
    $userId          = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday3_response = ? WHERE id = ?');
    $req->execute([$holiday3Request, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
    }

?>