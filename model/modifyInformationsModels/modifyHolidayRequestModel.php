<?php

// Fonction qui permet l'acceptation ou non d'une demande de CA.
    if(
        !empty($_POST['holiday1Request'])
    ) {

   // Connexion à la base de données.
   require('./model/connectionDBModel.php');

   // Variables.
   $holiday1Request = htmlspecialchars($_POST['holiday1Request']);
   $userId          = $_GET['id'];

   // Sélection de l'ID.
   $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
   $r->execute([$userId]);
   $userModifiedId = $r->fetchColumn();

   // Modification des modifications dans la base de données.
   $req = $bdd->prepare('UPDATE user SET holiday1_response = ? WHERE id = ?');
   $req->execute([$holiday1Request, $userModifiedId]);

   // Redirection.
   header('location: index.php?page=dashboard&holidayResponse=1');
   exit();
} else {
    header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
    exit();
};

// Fonction qui permet l'acceptation ou non d'une seconde demande de CA.
    if(
        !empty($_POST['holiday2Request'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holiday2Request = htmlspecialchars($_POST['holiday2Request']);
    $userId          = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday2_response = ? WHERE id = ?');
    $req->execute([$holiday2Request, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard&holidayResponse=1');
    exit();
} else {
    header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
    exit();
};

    // Fonction qui permet l'acceptation ou non d'une troisième demande de CA.
    if(
        !empty($_POST['holiday3Request'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holiday3Request = htmlspecialchars($_POST['holiday3Request']);
    $userId          = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday3_response = ? WHERE id = ?');
    $req->execute([$holiday3Request, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard&holidayResponse=1');
    exit();
} else {
    header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
    exit();
};

        // Fonction qui permet l'acceptation ou non d'une demande de RTT.

// Fonction qui permet l'acceptation ou non d'une première demande de RTT.
    if(
        !empty($_POST['dayOff1Request'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff1Request = htmlspecialchars($_POST['dayOff1Request']);
    $userId          = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if($dayOff1Request == '1') {
        $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user SET day_off_response1 = ? WHERE id = ?');
    $req->execute([$dayOff1Request, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard&dayOffResponse=1');
    exit();
} else {
    header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
    exit();
};

// Fonction qui permet l'acceptation ou non d'une seconde demande de RTT.
    if(
        !empty($_POST['dayOff2Request'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff2Request = htmlspecialchars($_POST['dayOff2Request']);
    $userId          = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if($dayOff2Request == '1') {
        $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user SET day_off_response2 = ? WHERE id = ?');
    $req->execute([$dayOff2Request, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard&dayOffResponse=1');
    exit();
} else {
    header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
    exit();
};

// Fonction qui permet l'acceptation ou non d'une troisième demande de RTT.
    if(
        !empty($_POST['dayOff3Request'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff3Request = htmlspecialchars($_POST['dayOff3Request']);
    $userId          = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if($dayOff3Request == '1') {
        $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user SET day_off_response3 = ? WHERE id = ?');
    $req->execute([$dayOff3Request, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard&dayOffResponse=1');
    exit();
} else {
    header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
    exit();
};

?>