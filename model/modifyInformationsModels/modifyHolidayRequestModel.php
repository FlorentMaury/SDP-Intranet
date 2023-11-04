<?php

// Fonction qui permet l'acceptation ou non d'une demande de CA.
if (
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

    $stmt = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName      = $user['name'];
    $userSurname   = $user['surname'];
    $userEmail     = $user['email'];
    $holiday1Start = $user['holiday1_start'];
    $holiday1End   = $user['holiday1_end'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT holidays_taken FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $currentHolidaysTaken = $r->fetchColumn();

    if ($holiday1Request == 1) {
        $holidayRes = 'Acceptée';

        $holiday1StartDateTime = new DateTime($user['holiday1_start']);
        $holiday1EndDateTime   = new DateTime($user['holiday1_end']);

        $diff = date_diff($holiday1EndDateTime, $holiday1StartDateTime)->days;
        $newHolidaysTaken = $currentHolidaysTaken + $diff;

        // Selection de la banque de repos.
        $r = $bdd->prepare("UPDATE `user` SET holidays_total = ? WHERE id = ?");
        $r->execute([$newHolidaysTaken, $userId]);

    } else if ($holiday1Request == 2) {
        $holidayRes = 'Refusée';
    }

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holidays_taken = ? WHERE id = ?');
    $result = $req->execute([$holiday1Request, $userModifiedId]);

    // FONCTION MAILTO.

    // Variables.
    $userMessage   =
        "<html>
                <head>
                    <title>Réponse à la demande de vacances | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, la demande de vacances de la part de $userName $userSurname 
                     du $holiday1Start au $holiday1End vient d'être $holidayRes.</p>
                </body>
            </html>";
    // $to         = 'contact@florent-maury.fr';
    $to            = "pdana@free.fr,mrisler@sdp-paris.com,$userEmail";
    $subject       = "Réponse à la demande de vacances | $userName $userSurname";

    // Retour à la ligne en cas de dépassement des 70 caractères.
    $contentMessage = wordwrap($userMessage, 70, "\r\n");

    // Personnalisation du contenu en fonction des variables.
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $userName <$userEmail>" . "\r\n";
    $headers .= "Reply-To: $userEmail" . "\r\n";

    mail($to, $subject, $contentMessage, $headers);

    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&holidayResponse=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
        exit();
    }
};

// Fonction qui permet l'acceptation ou non d'une seconde demande de CA.
if (
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

    $stmt = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName      = $user['name'];
    $userSurname   = $user['surname'];
    $userEmail     = $user['email'];
    $holiday2Start = $user['holiday2_start'];
    $holiday2End   = $user['holiday2_end'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT holidays_taken FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $currentHolidaysTaken = $r->fetchColumn();

    if ($holiday2Request == 1) {
        $holidayRes = 'Acceptée';

        $holiday2StartDateTime = new DateTime($user['holiday2_start']);
        $holiday2EndDateTime   = new DateTime($user['holiday2_end']);

        $diff = date_diff($holiday2EndDateTime, $holiday2StartDateTime)->days;
        $newHolidaysTaken = $currentHolidaysTaken + $diff;

        // Selection de la banque de repos.
        $r = $bdd->prepare("UPDATE `user` SET holidays_taken = ? WHERE id = ?");
        $r->execute([$newHolidaysTaken, $userId]);

    } else if ($holiday2Request == 2) {
        $holidayRes = 'Refusée';
    }

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday2_response = ? WHERE id = ?');
    $result = $req->execute([$holiday2Request, $userModifiedId]);

    // FONCTION MAILTO.

    // Variables.
    $userMessage   =
        "<html>
                <head>
                    <title>Réponse à la demande de vacances | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, la demande de vacances de la part de $userName $userSurname 
                     du $holiday2Start au $holiday2End vient d'être $holidayRes.</p>
                </body>
            </html>";
    // $to         = 'contact@florent-maury.fr';
    $to            = "pdana@free.fr,mrisler@sdp-paris.com,$userEmail";
    $subject       = "Réponse à la demande de vacances | $userName $userSurname";

    // Retour à la ligne en cas de dépassement des 70 caractères.
    $contentMessage = wordwrap($userMessage, 70, "\r\n");

    // Personnalisation du contenu en fonction des variables.
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $userName <$userEmail>" . "\r\n";
    $headers .= "Reply-To: $userEmail" . "\r\n";

    mail($to, $subject, $contentMessage, $headers);

    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&holidayResponse=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
        exit();
    }
};

// Fonction qui permet l'acceptation ou non d'une troisième demande de CA.
if (
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

    $stmt = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName      = $user['name'];
    $userSurname   = $user['surname'];
    $userEmail     = $user['email'];
    $holiday3Start = $user['holiday3_start'];
    $holiday3End   = $user['holiday3_end'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT holidays_taken FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $currentHolidaysTaken = $r->fetchColumn();

    if ($holiday3Request == 1) {
        $holidayRes = 'Acceptée';

        $holiday3StartDateTime = new DateTime($user['holiday3_start']);
        $holiday3EndDateTime   = new DateTime($user['holiday3_end']);

        $diff = date_diff($holiday3EndDateTime, $holiday3StartDateTime)->days;
        $newHolidaysTaken = $currentHolidaysTaken + $diff;

        // Selection de la banque de repos.
        $r = $bdd->prepare("UPDATE `user` SET holidays_taken = ? WHERE id = ?");
        $r->execute([$newHolidaysTaken, $userId]);

    } else if ($holiday3Request == 2) {
        $holidayRes = 'Refusée';
    }

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday3_response = ? WHERE id = ?');
    $result = $req->execute([$holiday3Request, $userModifiedId]);

    // FONCTION MAILTO.

    // Variables.
    $userMessage   =
        "<html>
                <head>
                    <title>Réponse à la demande de vacances | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, la demande de vacances de la part de $userName $userSurname 
                     du $holiday3Start au $holiday3End vient d'être $holidayRes.</p>
                </body>
            </html>";
    // $to         = 'contact@florent-maury.fr';
    $to            = "pdana@free.fr,mrisler@sdp-paris.com,$userEmail";
    $subject       = "Réponse à la demande de vacances | $userName $userSurname";

    // Retour à la ligne en cas de dépassement des 70 caractères.
    $contentMessage = wordwrap($userMessage, 70, "\r\n");

    // Personnalisation du contenu en fonction des variables.
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $userName <$userEmail>" . "\r\n";
    $headers .= "Reply-To: $userEmail" . "\r\n";

    mail($to, $subject, $contentMessage, $headers);

    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&holidayResponse=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
        exit();
    }
};

// Fonction qui permet l'acceptation ou non d'une demande de RTT.

// Fonction qui permet l'acceptation ou non d'une première demande de RTT.
if (
    !empty($_POST['dayOff1Request'])
) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff1Request = htmlspecialchars($_POST['dayOff1Request']);
    $userId          = $_GET['id'];

    if ($dayOff1Request == 1) {
        $dayOffRes = 'Acceptée';
    } else if ($dayOff1Request == 2) {
        $dayOffRes = 'Refusée';
    }

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $stmt = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName = $user['name'];
    $userSurname = $user['surname'];
    $userEmail = $user['email'];
    $modifyDayOffRequest1 = $user['day_off1'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if ($dayOff1Request == '1') {
        $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user SET day_off_response1 = ? WHERE id = ?');
    $result = $req->execute([$dayOff1Request, $userModifiedId]);

    // FONCTION MAILTO.

    // Variables.
    $userMessage   =
        "<html>
                <head>
                    <title>Réponse à la demande de journée de repos | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, la demande de repos de la part de $userName $userSurname 
                    au $modifyDayOffRequest1 vient d'être $dayOffRes.</p>
                </body>
            </html>";
    // $to         = 'contact@florent-maury.fr';
    $to            = "pdana@free.fr,mrisler@sdp-paris.com,$userEmail";
    $subject       = "Réponse à la demande de repos | $userName $userSurname";

    // Retour à la ligne en cas de dépassement des 70 caractères.
    $contentMessage = wordwrap($userMessage, 70, "\r\n");

    // Personnalisation du conatenu en fonction des variables.
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $userName <$userEmail>" . "\r\n";
    $headers .= "Reply-To: $userEmail" . "\r\n";

    mail($to, $subject, $contentMessage, $headers);


    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&holidayResponse=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
        exit();
    }
};

// Fonction qui permet l'acceptation ou non d'une seconde demande de RTT.
if (
    !empty($_POST['dayOff2Request'])
) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff2Request = htmlspecialchars($_POST['dayOff2Request']);
    $userId          = $_GET['id'];

    if ($dayOff2Request == 1) {
        $dayOffRes = 'Acceptée';
    } else if ($dayOff2Request == 2) {
        $dayOffRes = 'Refusée';
    }

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $stmt = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName = $user['name'];
    $userSurname = $user['surname'];
    $userEmail = $user['email'];
    $modifyDayOffRequest2 = $user['day_off2'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if ($dayOff2Request == '1') {
        $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user SET day_off_response2 = ? WHERE id = ?');
    $result = $req->execute([$dayOff2Request, $userModifiedId]);

    // FONCTION MAILTO.

    // Variables.
    $userMessage   =
        "<html>
                <head>
                    <title>Réponse à la demande de journée de repos | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, la demande de repos de la part de $userName $userSurname 
                    au $modifyDayOffRequest2 vient d'être $dayOffRes.</p>
                </body>
            </html>";
    // $to         = 'contact@florent-maury.fr';
    $to            = "pdana@free.fr,mrisler@sdp-paris.com,$userEmail";
    $subject       = "Réponse à la demande de repos | $userName $userSurname";

    // Retour à la ligne en cas de dépassement des 70 caractères.
    $contentMessage = wordwrap($userMessage, 70, "\r\n");

    // Personnalisation du conatenu en fonction des variables.
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $userName <$userEmail>" . "\r\n";
    $headers .= "Reply-To: $userEmail" . "\r\n";

    mail($to, $subject, $contentMessage, $headers);

    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&holidayResponse=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
        exit();
    }
};

// Fonction qui permet l'acceptation ou non d'une troisième demande de RTT.
if (
    !empty($_POST['dayOff3Request'])
) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff3Request = htmlspecialchars($_POST['dayOff3Request']);
    $userId         = $_GET['id'];

    if ($dayOff3Request == 1) {
        $dayOffRes = 'Acceptée';
    } else if ($dayOff3Request == 2) {
        $dayOffRes = 'Refusée';
    }

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $stmt = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName = $user['name'];
    $userSurname = $user['surname'];
    $userEmail = $user['email'];
    $modifyDayOffRequest3 = $user['day_off3'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if ($dayOff3Request == '1') {
        $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user SET day_off_response3 = ? WHERE id = ?');
    $result = $req->execute([$dayOff3Request, $userModifiedId]);

    // FONCTION MAILTO.

    // Variables.
    $userMessage   =
        "<html>
                <head>
                    <title>Réponse à la demande de journée de repos | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, la demande de repos de la part de $userName $userSurname 
                    au $modifyDayOffRequest3 vient d'être $dayOffRes.</p>
                </body>
            </html>";
    // $to         = 'contact@florent-maury.fr';
    $to            = "pdana@free.fr,mrisler@sdp-paris.com,$userEmail";
    $subject       = "Réponse à la demande de repos | $userName $userSurname";

    // Retour à la ligne en cas de dépassement des 70 caractères.
    $contentMessage = wordwrap($userMessage, 70, "\r\n");

    // Personnalisation du contenu en fonction des variables.
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $userName <$userEmail>" . "\r\n";
    $headers .= "Reply-To: $userEmail" . "\r\n";

    mail($to, $subject, $contentMessage, $headers);

    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&holidayResponse=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de répondre à cette demande.');
        exit();
    }
};
