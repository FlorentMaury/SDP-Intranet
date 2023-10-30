<?php

// Demande de suppression d'un compte employé.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Connexion à la base de données.
    require('../model/connectionDBModel.php');

    // Suppression de l'image de profil du serveur.
    if(isset($id['profile_picture'])) {
        $r = $bdd->prepare("SELECT profile_picture FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $profilePicture = $r->fetchColumn();
        unlink('../public/assets/usersImg/'.$profilePicture);
    };

    // Suppression de la carte d'identité de face du serveur.
    if(isset($id['id_card_face'])) {
        $r = $bdd->prepare("SELECT id_card_face FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $idCardFace = $r->fetchColumn();
        unlink('../public/assets/idCardFace/'.$idCardFace);
    };

    // Suppression de la carte d'identité de dos du serveur.
    if(isset($id['id_card_back'])) {
        $r = $bdd->prepare("SELECT id_card_back FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $idCardBack = $r->fetchColumn();
        unlink('../public/assets/idCardBack/'.$idCardBack);
    };

    // Suppression de la carte vitale de face du serveur.
    if(isset($id['insurance_card_face'])) {
        $r = $bdd->prepare("SELECT insurance_card_face FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $insuranceCardFace = $r->fetchColumn();
        unlink('../public/assets/insuranceCardFace/'.$insuranceCardFace);    
    };

    // Suppression de la carte vitale de dos du serveur.
    if(isset($id['insurance_card_back'])) {
        $r = $bdd->prepare("SELECT insurance_card_back FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $insuranceCardBack = $r->fetchColumn();
        unlink('../public/assets/insuranceCardBack/'.$insuranceCardBack);
    };

    // Suppression du premier diplôme du serveur.
    if(isset($id['school_1_doc'])) {
        $r = $bdd->prepare("SELECT school_1_doc FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $school1Doc = $r->fetchColumn();
        unlink('../public/assets/school1Doc/'.$school1Doc);
    };

    // Suppression du second diplôme du serveur.
    if(isset($id['school_2_doc'])) {
        $r = $bdd->prepare("SELECT school_2_doc FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $school2Doc = $r->fetchColumn();
        unlink('../public/assets/school2Doc/'.$school2Doc);
    };

    // Suppression du troisième diplôme du serveur.
    if(isset($id['school_3_doc'])) {
        $r = $bdd->prepare("SELECT school_3_doc FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $school3Doc = $r->fetchColumn();
        unlink('../public/assets/school3Doc/'.$school3Doc);
    };

    // Suppression des documents d'arrêts maladie du serveur.
    if(isset($id['illness_justif'])) {
        $r = $bdd->prepare("SELECT illness_justif FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $sickNote = $r->fetchColumn();
        unlink('../public/assets/illnessJustif/'.$sickNote);
    };

    if(isset($id['illness_justif_2'])) {
        $r = $bdd->prepare("SELECT illness_justif2 FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $sickNote2 = $r->fetchColumn();
        unlink('../public/assets/illnessJustif2/'.$sickNote2);
    };

    if(isset($id['illness_justif_3'])) {
        $r = $bdd->prepare("SELECT illness_justif3 FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $sickNote3 = $r->fetchColumn();
        unlink('../public/assets/illnessJustif3/'.$sickNote3);
    };

    if(isset($id['illness_justif_4'])) {
        $r = $bdd->prepare("SELECT illness_justif4 FROM `user` WHERE id = ?");
        $r->execute([$id]);
        $sickNote4 = $r->fetchColumn();
        unlink('../public/assets/illnessJustif4/'.$sickNote4);
    };

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