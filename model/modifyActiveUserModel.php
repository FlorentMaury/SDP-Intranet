<?php

// Demande de modification du status d'un employé.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Récupération des informations de l'utilisateur.
    $req = $bdd->prepare('SELECT active FROM user WHERE id = ?');
    $req->execute([$id]);
    $userActive = $req->fetch()['active'];

    if($userActive == 0) {
        $req = $bdd->prepare('UPDATE user SET active = 1 WHERE id = ?');
        $result = $req->execute([$id]);
    } else {
        $req = $bdd->prepare('UPDATE user SET active = 0 WHERE id = ?');
        $result = $req->execute([$id]);
    }

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le status de ce compte.');
        exit();
    };
};
