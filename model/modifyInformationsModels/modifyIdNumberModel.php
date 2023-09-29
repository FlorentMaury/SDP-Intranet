<?php

// Vérification du formulaire de modification du numéro de téléphone.
if(
    !empty($_POST['idNumber']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $idNumber = htmlspecialchars($_POST['idNumber']);
    $userId   = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE marital_status SET id_number = ? WHERE id = ?');
    $req->execute([$idNumber, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
    } 

?>