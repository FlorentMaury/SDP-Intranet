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

    // Suppression de la carte d'identité de face du serveur.
    $r = $bdd->prepare("SELECT id_card_face FROM `user` WHERE id = ?");
    $r->execute([$id]);
    $idCardFace = $r->fetchColumn();
    unlink('../public/assets/idCardFace/'.$idCardFace);

    // Suppression de la carte d'identité de dos du serveur.
    $r = $bdd->prepare("SELECT id_card_back FROM `user` WHERE id = ?");
    $r->execute([$id]);
    $idCardBack = $r->fetchColumn();
    unlink('../public/assets/idCardBack/'.$idCardBack);

    // Suppression de la carte vitale de face du serveur.
    $r = $bdd->prepare("SELECT insurance_card_face FROM `user` WHERE id = ?");
    $r->execute([$id]);
    $insuranceCardFace = $r->fetchColumn();
    unlink('../public/assets/insuranceCardFace/'.$insuranceCardFace);

    // Suppression de la carte vitale de dos du serveur.
    $r = $bdd->prepare("SELECT insurance_card_back FROM `user` WHERE id = ?");
    $r->execute([$id]);
    $insuranceCardBack = $r->fetchColumn();
    unlink('../public/assets/insuranceCardBack/'.$insuranceCardBack);

    // Suppression du premier diplôme du serveur.
    $r = $bdd->prepare("SELECT school_1_doc FROM `user` WHERE id = ?");
    $r->execute([$id]);
    $school1Doc = $r->fetchColumn();
    unlink('../public/assets/school1Doc/'.$school1Doc);

    // Suppression du second diplôme du serveur.
    $r = $bdd->prepare("SELECT school_2_doc FROM `user` WHERE id = ?");
    $r->execute([$id]);
    $school2Doc = $r->fetchColumn();
    unlink('../public/assets/school2Doc/'.$school2Doc);

    // Suppression du troisième diplôme du serveur.
    $r = $bdd->prepare("SELECT school_3_doc FROM `user` WHERE id = ?");
    $r->execute([$id]);
    $school3Doc = $r->fetchColumn();
    unlink('../public/assets/school3Doc/'.$school3Doc);

    // Suppression des informations de la base de donnée.
    $req = $bdd->prepare('DELETE FROM user WHERE id = ?');
    $result = $req->execute([$id]);

    // Redirection.
    if($result) {
        header('location: ../index.php?page=dashboard&removal=1');
        exit();
    } else {
        header('location: ../index.php?page=dashboard&error=1&message=Impossible de supprimer ce compte.');
        exit();
    };
};

?>