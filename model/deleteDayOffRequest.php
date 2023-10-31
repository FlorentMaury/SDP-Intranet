<?php

// Demande de suppression d'une demande de RTT.
if (isset($_GET['id']) && isset($_GET['dayOff1'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user SET day_off_response1 = ?, day_off1 = ?, day_off1_desc = ? WHERE id = ?');
    $result = $req->execute([null, null, null, $id]);

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&removal=1');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&error=1&message=Impossible de supprimer cette demande de RTT.');
        exit();
    };
    header('location: ../index.php?page=dashboard&removal=1');
    exit();
};


// Demande de suppression d'une demande de RTT.
if (isset($_GET['id']) && isset($_GET['dayOff2'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user SET day_off_response2 = ?, day_off2 = ?, day_off2_desc = ? WHERE id = ?');
    $result = $req->execute([null, null, null, $id]);

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&removal=1');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&error=1&message=Impossible de supprimer cette demande de RTT.');
        exit();
    };
};


// Demande de suppression d'une demande de RTT.
if (isset($_GET['id']) && isset($_GET['dayOff3'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user SET day_off_response3 = ?, day_off3 = ?, day_off1_desc = ? WHERE id = ?');
    $result = $req->execute([null, null, null, $id]);

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&removal=1');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&error=1&message=Impossible de supprimer cette demande de RTT.');
        exit();
    };
};

?>