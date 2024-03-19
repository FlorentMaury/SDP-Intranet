<?php

if (isset($_GET['holidayResponseMail'], $_GET['id'], $_GET['user'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holidayRequest = htmlspecialchars($_GET['holidayResponseMail']);
    $userId         = $_GET['user'];
    $holidayId      = $_GET['id'];

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

    $stmt = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id 
        INNER JOIN user_holiday ON user.id = user_holiday.user_holiday_id
        WHERE id = ? AND holiday_id = ?
        ');
    $stmt->execute([$userId, $holidayId]);
    $user = $stmt->fetch();

    $userName     = $user['name'];
    $userSurname  = $user['surname'];
    $userEmail    = $user['email'];
    $holidayStart = $user['holiday_start'];
    $holidayEnd   = $user['holiday_end'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT holidays_taken FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userId]);
    $currentHolidaysTaken = $r->fetchColumn();

    if ($holidayRequest == 1) {
        $holidayRes = 'acceptée';
    } else if ($holidayRequest == 2) {
        $holidayRes = 'refusée';
    }

    if ($userModifiedId) {
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
                    du $holidayStart au $holidayEnd vient d'être $holidayRes.</p>
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
            header('location: index.php?page=email&holidayResponse=1');
            exit();
        } else {
            header('location: index.php?page=email&error=1&message=Impossible de répondre à cette demande.');
            exit();
        }
    } else {
        header('location: index.php?page=email&error=1&message=Utilisateur non trouvé.');
        exit();
    }
};



// REPONSE JOUR DE REPOS PAR MAIL.

if (isset($_GET['dayOff1Mail'], $_GET['id'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff1Mail  = htmlspecialchars($_GET['dayOff1Mail']);
    $holidayId       = $_GET['id'];

    if ($dayOff1Mail == 1) {
        $dayOffRes = 'Acceptée';
    } else if ($dayOff1Mail == 2) {
        $dayOffRes = 'Refusée';
    }

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$holidayId]);
    $userModifiedId = $stmt->fetchColumn();

    $stmt = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id 
        WHERE id = ?
        ');
    $stmt->execute([$holidayId]);
    $user = $stmt->fetch();

    $userName = $user['name'];
    $userSurname = $user['surname'];
    $userEmail = $user['email'];
    $modifyDayOffRequest1 = $user['day_off1'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$holidayId]);
    $previousDaysOffBank = $r->fetchColumn();

    if ($userModifiedId) {

        if ($dayOff1Mail == '1') {
            $req = $bdd->prepare('UPDATE user_time_bank SET day_off_bank = ? WHERE user_time_bank_id = ?');
            $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
        }

        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user_time_bank SET day_off_response1 = ? WHERE user_time_bank_id = ?');
        $result = $stmt->execute([$dayOff1Mail, $userModifiedId]);


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
            header('location: index.php?page=email&holidayResponse=1');
            exit();
        } else {
            header('location: index.php?page=email&error=1&message=Impossible de répondre à cette demande.');
            exit();
        }
    } else {
        header('location: index.php?page=email&error=1&message=Utilisateur non trouvé.');
        exit();
    }
};

if (isset($_GET['dayOff2Mail'], $_GET['id'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff2Mail  = htmlspecialchars($_GET['dayOff2Mail']);
    $holidayId       = $_GET['id'];

    if ($dayOff2Mail == 1) {
        $dayOffRes = 'Acceptée';
    } else if ($dayOff2Mail == 2) {
        $dayOffRes = 'Refusée';
    }

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$holidayId]);
    $userModifiedId = $stmt->fetchColumn();

    $stmt = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id 
        WHERE id = ?
        ');
    $stmt->execute([$holidayId]);
    $user = $stmt->fetch();

    $userName = $user['name'];
    $userSurname = $user['surname'];
    $userEmail = $user['email'];
    $modifyDayOffRequest2 = $user['day_off2'];

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$holidayId]);
    $previousDaysOffBank = $r->fetchColumn();

    if ($userModifiedId) {

        if ($dayOff2Mail == '1') {
            $req = $bdd->prepare('UPDATE user_time_bank SET day_off_bank = ? WHERE user_time_bank_id = ?');
            $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
        }

        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user_time_bank SET day_off_response2 = ? WHERE user_time_bank_id = ?');
        $result = $stmt->execute([$dayOff2Mail, $userModifiedId]);

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
            header('location: index.php?page=email&holidayResponse=1');
            exit();
        } else {
            header('location: index.php?page=email&error=1&message=Impossible de répondre à cette demande.');
            exit();
        }
        } else {
            header('location: index.php?page=email&error=1&message=Utilisateur non trouvé.');
            exit();
        }
    };

    if (isset($_GET['dayOff3Mail'], $_GET['id'])) {
        // Connexion à la base de données.
        require('./model/connectionDBModel.php');

        // Variables.
        $dayOff3Mail  = htmlspecialchars($_GET['dayOff3Mail']);
        $holidayId       = $_GET['id'];

        if ($dayOff3Mail == 1) {
            $dayOffRes = 'Acceptée';
        } else if ($dayOff3Mail == 2) {
            $dayOffRes = 'Refusée';
        }

        // Vérification de l'existence de l'utilisateur.
        $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
        $stmt->execute([$holidayId]);
        $userModifiedId = $stmt->fetchColumn();

        $stmt = $bdd->prepare('
            SELECT *
            FROM user 
            INNER JOIN user_exp ON user.id = user_exp.user_exp_id
            INNER JOIN user_role ON user.id = user_role.user_role_id
            INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id 
            WHERE id = ?
            ');
        $stmt->execute([$holidayId]);
        $user = $stmt->fetch();

        $userName = $user['name'];
        $userSurname = $user['surname'];
        $userEmail = $user['email'];
        $modifyDayOffRequest3 = $user['day_off3'];

        // Selection de la banque de repos.
        $r = $bdd->prepare("SELECT day_off_bank FROM user_time_bank_id WHERE user_time_bank_id = ?");
        $r->execute([$holidayId]);
        $previousDaysOffBank = $r->fetchColumn();

        if ($userModifiedId) {

            if ($dayOff3Mail == '1') {
                $req = $bdd->prepare('UPDATE user_time_bank SET day_off_bank = ? WHERE user_time_bank_id = ?');
                $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
            }

            // Modification de la réponse de l'utilisateur dans la base de données.
            $stmt = $bdd->prepare('UPDATE user_time_bank SET day_off_response3 = ? WHERE id = ?');
            $result = $stmt->execute([$dayOff3Mail, $userModifiedId]);

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

            // Personnalisation du conatenu en fonction des variables.
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
            $headers .= "From: $userName <$userEmail>" . "\r\n";
            $headers .= "Reply-To: $userEmail" . "\r\n";

            mail($to, $subject, $contentMessage, $headers);

            // Redirection.
            if ($result) {
                header('location: index.php?page=email&holidayResponse=1');
                exit();
            } else {
                header('location: index.php?page=email&error=1&message=Impossible de répondre à cette demande.');
                exit();
            }
        } else {
            header('location: index.php?page=email&error=1&message=Utilisateur non trouvé.');
            exit();
        }
    }
