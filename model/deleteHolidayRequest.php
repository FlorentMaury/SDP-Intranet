<?php

// Demande de suppression d'une demande de vacances.
if (isset($_GET['id']) && isset($_GET['holiday1'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user_time_bank SET holiday1_response = ?, holiday1_start = ?, holiday1_end = ? WHERE user_time_bank_id  = ?');
    $result = $req->execute([null, null, null, $id]);

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&removal=1&action=timeBankButton');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&error=1&message=Impossible de supprimer cette demande de vacances.');
        exit();
    };
};


// Demande de suppression d'une demande de vacances.
if (isset($_GET['id']) && isset($_GET['holiday2'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user_time_bank_id SET holiday2_response = ?, holiday2_start = ?, holiday2_end = ? WHERE user_time_bank_id = ?');
    $result = $req->execute([null, null, null, $id]);

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&removal=1&action=timeBankButton');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&error=1&message=Impossible de supprimer cette demande de vacances.');
        exit();
    };
};


// Demande de suppression d'une demande de vacances.
if (isset($_GET['id']) && isset($_GET['holiday3'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('UPDATE user_time_bank_id SET holiday3_response = ?, holiday3_start = ?, holiday3_end = ? WHERE user_time_bank_id = ?');
    $result = $req->execute([null, null, null, $id]);

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&removal=1&action=timeBankButton');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&error=1&message=Impossible de supprimer cette demande de vacances.');
        exit();
    };
};


?>