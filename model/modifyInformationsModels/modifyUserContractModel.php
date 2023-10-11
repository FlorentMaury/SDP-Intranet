<?php

// Vérification du formulaire de modification de la première expérience professionelle.
if(
    !empty($_POST['userContract']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContract = htmlspecialchars($_POST['userContract']);
    $userId             = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET contract_type = ? WHERE id = ?');
    $req->execute([$modifyUserContract, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=user');
    exit();
};

?>