<?php

// Demande de suppression d'un compte employé.
if (isset($_GET['id']) && isset($_GET['holiday1'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user(holiday1_response = 0, holiday1_start = NULL, holiday1_end = NULL) WHERE id = ?');
    $req->execute([$id]);

    // Redirection.
    header('location: ./index.php?page=dashboard');
    exit();
}

// Demande de suppression d'un compte employé.
if (isset($_GET['id']) && isset($_GET['holiday2'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE FROM user(holiday2_response = 0, holiday2_start = NULL, holiday2_end = NULL) WHERE id = ?');
    $req->execute([$id]);

    // Redirection.
    header('location: ../index.php?page=dashboard');
    exit();
}

// Demande de suppression d'un compte employé.
if (isset($_GET['id']) && isset($_GET['holiday3'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE FROM user(holiday3_response = 0, holiday3_start = NULL, holiday3_end = NULL) WHERE id = ?');
    $req->execute([$id]);

    // Redirection.
    header('location: ../index.php?page=dashboard');
    exit();
}

?>