<?php

// Demande de suppression d'une demande de RTT.
if (isset($_GET['id']) && isset($_GET['dayOff1'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user SET day_off_response1 = ?, day_off1 = ? WHERE id = ?');
    $req->execute([null, null, $id]);

    // Redirection.
    header('location: ../index.php?page=dashboard');
    exit();
}

// Demande de suppression d'une demande de RTT.
if (isset($_GET['id']) && isset($_GET['dayOff2'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user SET day_off_response2 = ?, day_off2 = ? WHERE id = ?');
    $req->execute([null, null, $id]);

    // Redirection.
    header('location: ../index.php?page=dashboard');
    exit();
}

// Demande de suppression d'une demande de RTT.
if (isset($_GET['id']) && isset($_GET['dayOff3'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user SET day_off_response3 = ?, day_off3 = ? WHERE id = ?');
    $req->execute([null, null, $id]);

    // Redirection.
    header('location: ../index.php?page=dashboard');
    exit();
}

?>