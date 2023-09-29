<?php

// Vérification du formulaire de modification du planning.
if(
    !empty($_POST['modifyName']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyName = htmlspecialchars($_POST['modifyName']);
    $userId     = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE marital_status SET name = ?');
        $req->execute([$modifyName]);

        // Redirection.
        header('location: index.php?page=dashboard');
        exit();
 } 

?>