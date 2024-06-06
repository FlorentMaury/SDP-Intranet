<?php

// Demande de suppression d'une demande de vacances.
if (isset($_GET['id']) && isset($_GET['holiday'])) {

    $id = $_GET['id'];
    $holiday_start = $_GET['holiday'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('DELETE FROM user_holiday WHERE user_holiday_id = ? AND holiday_start = ?');
    $result = $req->execute([$id, $holiday_start]);

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