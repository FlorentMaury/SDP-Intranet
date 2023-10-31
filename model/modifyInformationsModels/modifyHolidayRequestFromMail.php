<?php 

if(isset($_GET['holiday1ResponseMail'], $_GET['id'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holiday1Request = htmlspecialchars($_GET['holiday1ResponseMail']);
    $userId          = $_GET['id'];

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

    if($userModifiedId) {
        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user SET holiday1_response = ? WHERE id = ?');
        $result = $stmt->execute([$holiday1Request, $userModifiedId]);

        // Redirection.
        if($result) {
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


if(isset($_GET['holiday2ResponseMail'], $_GET['id'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holiday2Request = htmlspecialchars($_GET['holiday2ResponseMail']);
    $userId          = $_GET['id'];

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

    if($userModifiedId) {
        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user SET holiday2_response = ? WHERE id = ?');
        $result = $stmt->execute([$holiday2Request, $userModifiedId]);

        // Redirection.
        if($result) {
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

if(isset($_GET['holiday3ResponseMail'], $_GET['id'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holiday3Request = htmlspecialchars($_GET['holiday3ResponseMail']);
    $userId          = $_GET['id'];

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

    if($userModifiedId) {
        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user SET holiday3_response = ? WHERE id = ?');
        $result = $stmt->execute([$holiday3Request, $userModifiedId]);

        // Redirection.
        if($result) {
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

if(isset($_GET['dayOff1Mail'], $_GET['id'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff1Mail  = htmlspecialchars($_GET['dayOff1Mail']);
    $userId       = $_GET['id'];

    if($dayOff1Mail == 1) {
        $dayOffRes = 'Acceptée';
    } else if($dayOff1Mail == 2) {
        $dayOffRes = 'Refusée';
    }

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

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

    if($userModifiedId) {

        if($dayOff1Mail == '1') {
            $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
            $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
        }

        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user SET day_off_response1 = ? WHERE id = ?');
        $result = $stmt->execute([$dayOff1Mail, $userModifiedId]);


               // FONCTION MAILTO.

        // Variables.
        $userMessage   = 
            "<html>
                <head>
                    <title>REéponse à la demande de journée de repos | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, la demande de repos de la part de $userName $userSurname 
                    au $modifyDayOffRequest1 vient d'être $dayOffRes.</p>
                </body>
            </html>";
        $to         = 'contact@florent-maury.fr';
        // $to            = 'pdana@free.fr';
        $subject       = "Demande de repos | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: $userName <$userEmail>" . "\r\n";
        $headers .= "Reply-To: $userEmail" . "\r\n";

        mail($to, $subject, $contentMessage, $headers);


        // Redirection.
        if($result) {
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

if(isset($_GET['dayOff2Mail'], $_GET['id'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff2Mail  = htmlspecialchars($_GET['dayOff2Mail']);
    $userId          = $_GET['id'];

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

        // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    if($userModifiedId) {

        if($dayOff2Mail == '1') {
            $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
            $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
        }

        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user SET day_off_response2 = ? WHERE id = ?');
        $result = $stmt->execute([$dayOff2Mail, $userModifiedId]);

        // Redirection.
        if($result) {
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

if(isset($_GET['dayOff3Mail'], $_GET['id'])) {
    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $dayOff3Mail  = htmlspecialchars($_GET['dayOff3Mail']);
    $userId          = $_GET['id'];

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

    // Selection de la banque de repos.
    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousDaysOffBank = $r->fetchColumn();

    if($userModifiedId) {

        if($dayOff3Mail == '1') {
            $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
            $req->execute([($previousDaysOffBank - 1), $userModifiedId]);
        }

        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user SET day_off_response3 = ? WHERE id = ?');
        $result = $stmt->execute([$dayOff3Mail, $userModifiedId]);

        // Redirection.
        if($result) {
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
};3


?>