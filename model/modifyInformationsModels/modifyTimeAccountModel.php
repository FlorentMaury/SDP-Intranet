<?php

// Vérification du formulaire de déclaration de retard.
if(
    !empty($_POST['userDelayInfo'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserDelayInfo = htmlspecialchars($_POST['userDelayInfo']);
    $userId              = $_SESSION['id'];
    $previousUserDelays  = $_SESSION['user_delay'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $totalsOfDelays = floatval($modifyUserDelayInfo) + floatval($previousUserDelays);

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET user_delay = ? WHERE id = ?');
    $req->execute([$totalsOfDelays, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
};

// Vérification du formulaire de déclaration d'absence.
if(
    !empty($_POST['userAbsenceInfo']) &&
    isset($_FILES['medicalJustification']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo  = htmlspecialchars($_POST['userAbsenceInfo']);
    $userId               = $_SESSION['id'];
    $previousUserAbsences = $_SESSION['user_absence'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $totalsOfAbsences = floatval($modifyUserAbsenceInfo) + floatval($previousUserAbsences);

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET user_absence = ? WHERE id = ?');
    $req->execute([$totalsOfAbsences, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
};

// Vérification du formulaire de déclaration d'heures supplémentaires.
if(
    !empty($_POST['userExtraTimeInfo'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserExtraTimeInfo = htmlspecialchars($_POST['userExtraTimeInfo']);
    $userId                  = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $r = $bdd->prepare("SELECT user_extra_time FROM `user` WHERE id = ?");
    $r->execute([$userModifiedId]);
    $previousUserExtraTime = $r->fetchColumn();

    $totalsOfExtraTime = floatval($modifyUserExtraTimeInfo) + floatval($previousUserExtraTime);

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET user_extra_time = ? WHERE id = ?');
    $req->execute([$totalsOfExtraTime, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
};

?>