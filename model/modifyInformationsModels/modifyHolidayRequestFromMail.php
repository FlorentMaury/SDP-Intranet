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
    $userId          = $_GET['id'];

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

    if($userModifiedId) {
        // Modification de la réponse de l'utilisateur dans la base de données.
        $stmt = $bdd->prepare('UPDATE user SET day_off_response1 = ? WHERE id = ?');
        $result = $stmt->execute([$dayOff1Mail, $userModifiedId]);

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

    if($userModifiedId) {
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
    $dayOff1Mail  = htmlspecialchars($_GET['dayOff3Mail']);
    $userId          = $_GET['id'];

    // Vérification de l'existence de l'utilisateur.
    $stmt = $bdd->prepare('SELECT id FROM user WHERE id = ?');
    $stmt->execute([$userId]);
    $userModifiedId = $stmt->fetchColumn();

    if($userModifiedId) {
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