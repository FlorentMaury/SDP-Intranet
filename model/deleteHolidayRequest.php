<?php

// Demande de suppression d'un compte employé.
if (isset($_GET['id']) && isset($_GET['holiday1'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user SET holiday1_response = ?, holiday1_start = ?, holiday1_end = ? WHERE id = ?');
    $req->execute([null, null, null, $id]);

    // Redirection.
    header('location: ../index.php?page=dashboard');
    exit();
}

// Demande de suppression d'un compte employé.
if (isset($_GET['id']) && isset($_GET['holiday2'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user SET holiday2_response = ?, holiday2_start = ?, holiday2_end = ? WHERE id = ?');
    $req->execute([null, null, null, $id]);

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
    $req = $bdd->prepare('UPDATE user SET holiday3_response = ?, holiday3_start = ?, holiday3_end = ? WHERE id = ?');
    $req->execute([null, null, null, $id]);

    // Redirection.
    header('location: ../index.php?page=dashboard');
    exit();
}

?>