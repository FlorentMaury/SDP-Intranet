<?php


// Fonction qui permet l'acceptation ou non d'une demande de CA.
if (
    !empty($_POST['holidayRequest']) &&
    !empty($_POST['holiday_id']) // Assurez-vous que holiday_id est envoyé
) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holidayRequest = htmlspecialchars($_POST['holidayRequest']);
    $holidayId = htmlspecialchars($_POST['holiday_id']); // Récupérez holiday_id
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Sélection de l'utilisateur et des informations de vacances
    $stmt = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id 
        INNER JOIN user_holiday ON user.id = user_holiday.user_holiday_id
        WHERE id = ? AND user_holiday.user_holiday_id = ?
    ');
    $stmt->execute([$userId, $holidayId]); // Passez holiday_id ici
    $user = $stmt->fetch();

    $userName      = $user['name'];
    $userSurname   = $user['surname'];
    $userEmail     = $user['email'];
    $holidayStart  = $user['holiday_start'];
    $holidayEnd    = $user['holiday_end'];

    if ($holidayRequest == 1) {
        $holidayRes = 'Acceptée';

    } else if ($holidayRequest == 2) {
        $holidayRes = 'Refusée';
    }

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_holiday SET holiday_response = ?, holiday_response_text = ? WHERE holiday_id = ?');
    $result = $req->execute([$holidayRequest, $holidayRes, $holidayId]);

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

    $stmt = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id 
        WHERE id = ?
    ');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName = $user['name'];
    $userSurname = $user['surname'];
    $userEmail = $user['email'];
    $modifyDayOffRequest1 = $user['day_off1'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if ($dayOff1Request == '1') {
        $req = $bdd->prepare('UPDATE user_time_bank SET day_off_bank = ? WHERE user_time_bank_id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user_time_bank SET day_off_response1 = ? WHERE user_time_bank_id = ?');
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

    $stmt = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id 
        WHERE id = ?
        ');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName = $user['name'];
    $userSurname = $user['surname'];
    $userEmail = $user['email'];
    $modifyDayOffRequest2 = $user['day_off2'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if ($dayOff2Request == '1') {
        $req = $bdd->prepare('UPDATE user_time_bank SET day_off_bank = ? WHERE user_time_bank_id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user_time_bank SET day_off_response2 = ? WHERE user_time_bank_id = ?');
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

    $stmt = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id 
        WHERE id = ?
        ');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $userName = $user['name'];
    $userSurname = $user['surname'];
    $userEmail = $user['email'];
    $modifyDayOffRequest3 = $user['day_off3'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    if ($dayOff3Request == '1') {
        $req = $bdd->prepare('UPDATE user_time_bank SET day_off_bank = ? WHERE user_time_bank_id = ?');
        $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
    }

    $req = $bdd->prepare('UPDATE user_time_bank SET day_off_response3 = ? WHERE user_time_bank_id = ?');
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
