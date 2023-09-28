<?php

// Demande de suppression d'un compte employé.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression des informations du véhicule de la base de donnée.
    $req = $bdd->prepare('DELETE FROM marital_status WHERE id = ?');
    $req->execute([$id]);

    // Redirection.
    header('location: ../index.php?page=dashboard&deletedUser=1');
    exit();
}

?>