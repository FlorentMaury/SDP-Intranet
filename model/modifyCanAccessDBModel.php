<?php

// Demande de modification du status d'un employé.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Récupération des informations de l'utilisateur.
    $req = $bdd->prepare('SELECT can_access_db FROM user_role WHERE user_role_id = ?');
    $req->execute([$id]);
    $canAccessDB = $req->fetch()['can_access_db'];

    if($canAccessDB == 0) {
        $req = $bdd->prepare('UPDATE user_role SET can_access_db = 1 WHERE user_role_id = ?');
        $result = $req->execute([$id]);
    } else {
        $req = $bdd->prepare('UPDATE user_role SET can_access_db = 0 WHERE user_role_id = ?');
        $result = $req->execute([$id]);
    }

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier cette autorisation.');
        exit();
    };
};
