<?php

// Vérification du formulaire de déclaration de retard.
if(
    !empty($_POST['userDelayInfo'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserDelayInfo = htmlspecialchars($_POST['userDelayInfo']);
    $userId = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET user_delay = ? WHERE id = ?');
    $req->execute([$modifyUserDelayInfo, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
};

?>