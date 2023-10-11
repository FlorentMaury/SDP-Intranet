<?php

// Demande de suppression d'un compte employé.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression de l'image de profil du serveur.
    $r = $bdd->prepare("SELECT profile_picture FROM `user` WHERE id = ?");
    $r->execute([$id]);
    $profilePicture = $r->fetchColumn();
    unlink('../public/assets/usersImg/'.$profilePicture);

    // Suppression des informations du véhicule de la base de donnée.
    $req = $bdd->prepare('DELETE FROM user WHERE id = ?');
    $req->execute([$id]);

    // Redirection.
    header('location: ../index.php?page=dashboard&deletedUser=1');
    exit();
}

?>