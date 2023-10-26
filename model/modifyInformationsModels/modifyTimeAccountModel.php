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

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Selection du précédent retard.
    $r = $bdd->prepare("SELECT user_delay FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousUserDelays = $r->fetchColumn();

    $totalsOfDelays = floatval($modifyUserDelayInfo) + floatval($previousUserDelays);

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET user_delay = ? WHERE id = ?');
    $result = $req->execute([$totalsOfDelays, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer ce retard.');
        exit();
    }
};

// Vérification du formulaire de déclaration d'absence.
if(
    !empty($_POST['userAbsenceInfo']) &&
    !empty($_POST['userAbsenceDate']) &&
    isset($_FILES['medicalJustification']) 
    ) {

    // Pseudo-code pour ALTER TABLE d'ajout des déclarations d'absences.
    // ALTER TABLE user ADD user_absence2 FLOAT(5,2) NOT NULL DEFAULT 0 AFTER user_absence;
    // ALTER TABLE user ADD user_absence3 FLOAT(5,2) NOT NULL DEFAULT 0 AFTER user_absence2;
    // ALTER TABLE user ADD illness_justif2 VARCHAR(255) NOT NULL DEFAULT 'Aucun document' AFTER illness_justif;
    // ALTER TABLE user ADD illness_justif3 VARCHAR(255) NOT NULL DEFAULT 'Aucun document' AFTER illness_justif2;
    // ALTER TABLE user ADD illness_date2 VARCHAR(255) NOT NULL DEFAULT 'Aucune date' AFTER illness_date;
    // ALTER TABLE user ADD illness_date3 VARCHAR(255) NOT NULL DEFAULT 'Aucune date' AFTER illness_date2;


    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo = htmlspecialchars($_POST['userAbsenceInfo']);
    $modifyUserAbsenceDate = htmlspecialchars($_POST['userAbsenceDate']);
    $userId                = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Selection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousUserAbsences = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Document de l'arrêt maladie.
    $medicalJustificationName    = $_FILES['medicalJustification']['name'];
    $medicalJustificationTmpName = $_FILES['medicalJustification']['tmp_name'];
    $medicalJustificationSize    = $_FILES['medicalJustification']['size'];
    $medicalJustificationError   = $_FILES['medicalJustification']['error'];

    $totalsOfAbsences = floatval($modifyUserAbsenceInfo) + floatval($previousUserAbsences);

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $medicalJustificationName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if(in_array($extension, $extensions) && $medicalJustificationSize <= $maxSize && $medicalJustificationError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user SET user_absence = ? WHERE id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user SET illness_date = ? WHERE id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

                // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, un arrêt de travail vient d'être déclaré de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = 'pdana@free.fr';
        $subject       = "Arrêt de travail | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&timeBankModification=1');
            exit();
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer ce retard.');
            exit();
        }
    } else {
        // Redirection.
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le document doit être au format  \'jpg\', \'png\', \'jpeg\', \'webp\', \'pdf\', \'doc\', \'docx\', \'odt\', \'txt\' ou \'rtf\'.');
        exit();
    };
};

// Vérification du formulaire de déclaration d'une seconde absence.
if(
    !empty($_POST['userAbsenceInfo2']) &&
    !empty($_POST['userAbsenceDate2']) &&
    isset($_FILES['medicalJustification2']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo = htmlspecialchars($_POST['userAbsenceInfo2']);
    $modifyUserAbsenceDate = htmlspecialchars($_POST['userAbsenceDate2']);
    $userId                = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Selection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousUserAbsences = $r->fetchColumn();

    // Document de l'arrêt maladie.
    $medicalJustificationName    = $_FILES['medicalJustification2']['name'];
    $medicalJustificationTmpName = $_FILES['medicalJustification2']['tmp_name'];
    $medicalJustificationSize    = $_FILES['medicalJustification2']['size'];
    $medicalJustificationError   = $_FILES['medicalJustification2']['error'];

    $totalsOfAbsences = floatval($modifyUserAbsenceInfo) + floatval($previousUserAbsences);

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $medicalJustificationName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if(in_array($extension, $extensions) && $medicalJustificationSize <= $maxSize && $medicalJustificationError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif2'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif2/'.$medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user SET user_absence2 = ? WHERE id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif2 = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user SET illness_date2 = ? WHERE id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

                        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, un arrêt de travail vient d'être déclaré de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = 'pdana@free.fr';
        $subject       = "Arrêt de travail | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&timeBankModification=1');
            exit();
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette absence.');
            exit();
        }
    } else {
        // Redirection.
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le document doit être au format  \'jpg\', \'png\', \'jpeg\', \'webp\', \'pdf\', \'doc\', \'docx\', \'odt\', \'txt\' ou \'rtf\'.');
        exit();
    };
};


// Vérification du formulaire de déclaration d'une troisème absence.
if(
    !empty($_POST['userAbsenceInfo3']) &&
    !empty($_POST['userAbsenceDate3']) &&
    isset($_FILES['medicalJustification3']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo = htmlspecialchars($_POST['userAbsenceInfo3']);
    $modifyUserAbsenceDate = htmlspecialchars($_POST['userAbsenceDate3']);
    $userId                = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Selection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousUserAbsences = $r->fetchColumn();

    // Document de l'arrêt maladie.
    $medicalJustificationName    = $_FILES['medicalJustification3']['name'];
    $medicalJustificationTmpName = $_FILES['medicalJustification3']['tmp_name'];
    $medicalJustificationSize    = $_FILES['medicalJustification3']['size'];
    $medicalJustificationError   = $_FILES['medicalJustification3']['error'];

    $totalsOfAbsences = floatval($modifyUserAbsenceInfo) + floatval($previousUserAbsences);

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $medicalJustificationName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if(in_array($extension, $extensions) && $medicalJustificationSize <= $maxSize && $medicalJustificationError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif3'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif3/'.$medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user SET user_absence3 = ? WHERE id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif3 = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user SET illness_date3 = ? WHERE id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

            // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, un arrêt de travail vient d'être déclaré de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = 'pdana@free.fr';
        $subject       = "Arrêt de travail | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&timeBankModification=1');
            exit();
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette absence.');
            exit();
        }
    } else {
        // Redirection.
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le document doit être au format  \'jpg\', \'png\', \'jpeg\', \'webp\', \'pdf\', \'doc\', \'docx\', \'odt\', \'txt\' ou \'rtf\'.');
        exit();
    };
};

// Vérification du formulaire de déclaration d'une quatrième absence.
if(
    !empty($_POST['userAbsenceInfo4']) &&
    !empty($_POST['userAbsenceDate4']) &&
    isset($_FILES['medicalJustification4']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo = htmlspecialchars($_POST['userAbsenceInfo4']);
    $modifyUserAbsenceDate = htmlspecialchars($_POST['userAbsenceDate4']);
    $userId                = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Selection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $previousUserAbsences = $r->fetchColumn();

    // Document de l'arrêt maladie.
    $medicalJustificationName    = $_FILES['medicalJustification4']['name'];
    $medicalJustificationTmpName = $_FILES['medicalJustification4']['tmp_name'];
    $medicalJustificationSize    = $_FILES['medicalJustification4']['size'];
    $medicalJustificationError   = $_FILES['medicalJustification4']['error'];

    $totalsOfAbsences = floatval($modifyUserAbsenceInfo) + floatval($previousUserAbsences);

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $medicalJustificationName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if(in_array($extension, $extensions) && $medicalJustificationSize <= $maxSize && $medicalJustificationError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif3'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif4/'.$medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user SET user_absence4 = ? WHERE id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif4 = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user SET illness_date4 = ? WHERE id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

            // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, un arrêt de travail vient d'être déclaré de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = 'pdana@free.fr';
        $subject       = "Arrêt de travail | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&timeBankModification=1');
            exit();
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette absence.');
            exit();
        }
    } else {
        // Redirection.
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le document doit être au format  \'jpg\', \'png\', \'jpeg\', \'webp\', \'pdf\', \'doc\', \'docx\', \'odt\', \'txt\' ou \'rtf\'.');
        exit();
    };
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
    $result = $req->execute([$totalsOfExtraTime, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer ces heures supplémentaires.');
        exit();
    };
};


// DEMANDE DE VACANCES.

// Vérification du formulaire de première demande de CA.
if(
    !empty($_POST['holidayRequest1Start']) &&
    !empty($_POST['holidayRequest1End'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holidayRequest1Start = htmlspecialchars($_POST['holidayRequest1Start']);
    $holidayRequest1End   = htmlspecialchars($_POST['holidayRequest1End']);
    $userId               = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday1_response = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday1_start = ? WHERE id = ?');
    $req->execute([$holidayRequest1Start, $userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday1_end = ? WHERE id = ?');
    $result = $req->execute([$holidayRequest1End, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage = "Bonjour, vous avez une demande de vacances de la part de $userName $userSurname du $holidayRequest1Start au $holidayRequest1End.";
        // $to       = 'contact@florent-maury.fr';
        $to          = 'pdana@free.fr';
        $subject     = "Demande de vacances | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du contenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);


    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette demande de vacances.');
        exit();
    }
};


// Vérification du formulaire de seconde demande de CA.
if(
    !empty($_POST['holidayRequest2Start']) &&
    !empty($_POST['holidayRequest2End'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holidayRequest2Start = htmlspecialchars($_POST['holidayRequest2Start']);
    $holidayRequest2End   = htmlspecialchars($_POST['holidayRequest2End']);
    $userId               = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday2_response = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday2_start = ? WHERE id = ?');
    $req->execute([$holidayRequest2Start, $userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday2_end = ? WHERE id = ?');
    $result = $req->execute([$holidayRequest2End, $userModifiedId]);

            // FONCTION MAILTO.

        // Variables.
        $userMessage = "Bonjour, vous avez une demande de vacances de la part de $userName $userSurname du $holidayRequest1Start au $holidayRequest1End.";
        // $to       = 'contact@florent-maury.fr';
        $to          = 'pdana@free.fr';
        $subject     = "Demande de vacances | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du contenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette demande de vacances.');
        exit();
    }
};


// Vérification du formulaire de troisième demande de CA.
if(
    !empty($_POST['holidayRequest3Start']) &&
    !empty($_POST['holidayRequest3End'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $holidayRequest3Start = htmlspecialchars($_POST['holidayRequest3Start']);
    $holidayRequest3End   = htmlspecialchars($_POST['holidayRequest3End']);
    $userId               = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday3_response = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday3_start = ? WHERE id = ?');
    $req->execute([$holidayRequest3Start, $userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday3_end = ? WHERE id = ?');
    $result = $req->execute([$holidayRequest3End, $userModifiedId]);

                // FONCTION MAILTO.

        // Variables.
        $userMessage = "Bonjour, vous avez une demande de vacances de la part de $userName $userSurname du $holidayRequest1Start au $holidayRequest1End.";
        // $to       = 'contact@florent-maury.fr';
        $to          = 'pdana@free.fr';
        $subject     = "Demande de vacances | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du contenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette demande de vacances.');
        exit();
    }
};


    // DEMANDE DE JOUR SUPPLEMENTAIRE.

// Vérification du formulaire de déclaration de jours supplémentaires.
if(
    !empty($_POST['addDayOffBank'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyAddDayOffBank = htmlspecialchars($_POST['addDayOffBank']);
    $userId              = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $r = $bdd->prepare("SELECT day_off_bank FROM `user` WHERE id = ?");
    $r->execute([$userModifiedId]);
    $previousAddDayOffBank = $r->fetchColumn();

    $totalsOfDayOffBank = floatval($modifyAddDayOffBank) + floatval($previousAddDayOffBank);

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET day_off_bank = ? WHERE id = ?');
    $result = $req->execute([$totalsOfDayOffBank, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer ces jours supplémentaires.');
        exit();
    }
};


// Vérification du formulaire de première demande de jour de repos.
if(
    !empty($_POST['dayOffRequest1Start'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyDayOffRequest1 = htmlspecialchars($_POST['dayOffRequest1Start']);
    $userId               = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET day_off_response1 = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET day_off1 = ? WHERE id = ?');
    $result = $req->execute([$modifyDayOffRequest1, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, vous avez une demande de repos de la part de $userName $userSurname en date du $modifyDayOffRequest1.";
        // $to         = 'contact@florent-maury.fr';
        $to            = 'pdana@free.fr';
        $subject       = "Demande de repos | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);


    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette demande de repos.');
        exit();
    }
};


// Vérification du formulaire de seconde demande de jour de repos.
if(
    !empty($_POST['dayOffRequest2Start'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyDayOffRequest2 = htmlspecialchars($_POST['dayOffRequest2Start']);
    $userId               = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET day_off_response2 = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET day_off2 = ? WHERE id = ?');
    $result = $req->execute([$modifyDayOffRequest2, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, vous avez une demande de repos de la part de $userName $userSurname en date du $modifyDayOffRequest2.";
        // $to         = 'contact@florent-maury.fr';
        $to            = 'pdana@free.fr';
        $subject       = "Demande de repos | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette demande de repos.');
        exit();
    }
};


// Vérification du formulaire de troisième demande de jour de repos.
if(
    !empty($_POST['dayOffRequest3Start'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyDayOffRequest3 = htmlspecialchars($_POST['dayOffRequest3Start']);
    $userId               = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userName = $r->fetchColumn();

    $r = $bdd->prepare("SELECT surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userSurname = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET day_off_response3 = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET day_off3 = ? WHERE id = ?');
    $result = $req->execute([$modifyDayOffRequest3, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, vous avez une demande de repos de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = 'pdana@free.fr';
        $subject       = "Demande de repos | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);


    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&timeBankModification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette demande de repos.');
        exit();
    };
};



    // EN COURS DE REALISATION 


// // Vérification du formulaire de déclaration d'absence.
// if(
//     !empty($_POST['userAddAbsenceInfo']) &&
//     !empty($_POST['userAddAbsenceDate']) &&
//     isset($_FILES['medicalAddJustification']) 
//     ) {

//     // Pseudo-code pour ALTER TABLE d'ajout des déclarations d'absences.
//     // ALTER TABLE user ADD user_absence2 FLOAT(5,2) NOT NULL DEFAULT 0 AFTER user_absence;
//     // ALTER TABLE user ADD user_absence3 FLOAT(5,2) NOT NULL DEFAULT 0 AFTER user_absence2;
//     // ALTER TABLE user ADD illness_justif2 VARCHAR(255) NOT NULL DEFAULT 'Aucun document' AFTER illness_justif;
//     // ALTER TABLE user ADD illness_justif3 VARCHAR(255) NOT NULL DEFAULT 'Aucun document' AFTER illness_justif2;
//     // ALTER TABLE user ADD illness_date2 VARCHAR(255) NOT NULL DEFAULT 'Aucune date' AFTER illness_date;
//     // ALTER TABLE user ADD illness_date3 VARCHAR(255) NOT NULL DEFAULT 'Aucune date' AFTER illness_date2;

//     // Connexion à la base de données.
//     require('./model/connectionDBModel.php');

//     // Variables.
//     $userAddAbsenceInfo = htmlspecialchars($_POST['userAddAbsenceInfo']);
//     $userAddAbsenceDate = htmlspecialchars($_POST['userAddAbsenceDate']);
//     $userId                = $_SESSION['id'];
//     $previousUserAbsences  = $_SESSION['user_absence'];

//     // Sélection de l'ID.
//     $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
//     $r->execute([$userId]);
//     $userModifiedId = $r->fetchColumn();

//     $userName    = $_SESSION['name'];
//     $userSurname = $_SESSION['surname'];

//     // Document de l'arrêt maladie.
//     $medicalAddJustificationName    = $_FILES['medicalAddJustification']['name'];
//     $medicalAddJustificationTmpName = $_FILES['medicalAddJustification']['tmp_name'];
//     $medicalAddJustificationSize    = $_FILES['medicalAddJustification']['size'];
//     $medicalAddJustificationError   = $_FILES['medicalAddJustification']['error'];

//     $totalsOfAbsences = floatval($userAddAbsenceInfo) + floatval($previousUserAbsences);

//     // Récupérer l'extension des images.
//     $tabExtension = explode('.', $medicalAddJustificationName);

//     // Mise en minuscule de cette extendion.
//     $extension = strtolower(end($tabExtension));

//     //Tableau des extensions que l'on accepte pour les images.
//     $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
//     //Taille max que l'on accepte pour les images.
//     $maxSize = 50000000;

//     if($_SESSION['user_absence']) {
//         if($_SESSION['user_absence2']) {
//             if($_SESSION['user_absence3']) {
//                 if($_SESSION['user_absence4']) {
//                     if($_SESSION['user_absence5']) {
//                         if($_SESSION['user_absence6']) {
//                             if($_SESSION['user_absence7']) {
//                                 if($_SESSION['user_absence8']) {
//                                     if($_SESSION['user_absence9']) {
//                                         if($_SESSION['user_absence10']) {
//                                                 // Vérification de l'extension et de la taille du document.
//                                                 if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                                                     $uniqId = uniqid('', true);
//                                                     // Création d'un uniqid
//                                                     $medicalJustif = $uniqId.".".$extension;
//                                                     // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                                                     move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                                                     // Modification des modifications dans la base de données.
//                                                     $req = $bdd->prepare('ALTER TABLE user ADD user_absence11 FLOAT(5,2) AFTER user_absence10');
//                                                     $req->execute();
//                                                     $req = $bdd->prepare('UPDATE user SET user_absence11 = ? WHERE id = ?');
//                                                     $req->execute([$totalsOfAbsences, $userModifiedId]);

//                                                     // Ajout de toutes les informations si le document a été validé.
//                                                     $req = $bdd->prepare('ALTER TABLE user ADD illness_justif11 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif10');
//                                                     $req->execute();
//                                                     $req = $bdd->prepare('UPDATE user SET illness_justif11 = ? WHERE id = ?');
//                                                     $req->execute([$medicalJustif, $userModifiedId]);

//                                                     // Ajout de la date de l'arrêt.
//                                                     $req = $bdd->prepare('ALTER TABLE user ADD illness_date11 NULL AFTER illness_date10');
//                                                     $req->execute();
//                                                     $req = $bdd->prepare('UPDATE user SET illness_date11 = ? WHERE id = ?');
//                                                     $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                                                     // Redirection avec message de validation.
//                                                     header('location: index.php?page=dashboard');

//                                                 } else {
//                                                     // Redirection.
//                                                     header('location: index.php?page=dashboard');
//                                                 };
//                                         } else {
//                                             // Vérification de l'extension et de la taille du document.
//                                             if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                                                 $uniqId = uniqid('', true);
//                                                 // Création d'un uniqid
//                                                 $medicalJustif = $uniqId.".".$extension;
//                                                 // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                                                 move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                                                 // Modification des modifications dans la base de données.
//                                                 $req = $bdd->prepare('ALTER TABLE user ADD user_absence10 FLOAT(5,2) AFTER user_absence9');
//                                                 $req->execute();
//                                                 $req = $bdd->prepare('UPDATE user SET user_absence10 = ? WHERE id = ?');
//                                                 $req->execute([$totalsOfAbsences, $userModifiedId]);

//                                                 // Ajout de toutes les informations si le document a été validé.
//                                                 $req = $bdd->prepare('ALTER TABLE user ADD illness_justif10 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif9');
//                                                 $req->execute();
//                                                 $req = $bdd->prepare('UPDATE user SET illness_justif10 = ? WHERE id = ?');
//                                                 $req->execute([$medicalJustif, $userModifiedId]);

//                                                 // Ajout de la date de l'arrêt.
//                                                 $req = $bdd->prepare('ALTER TABLE user ADD illness_date10 NULL AFTER illness_date9');
//                                                 $req->execute();
//                                                 $req = $bdd->prepare('UPDATE user SET illness_date10 = ? WHERE id = ?');
//                                                 $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                                                 // Redirection avec message de validation.
//                                                 header('location: index.php?page=dashboard');

//                                             } else {
//                                                 // Redirection.
//                                                 header('location: index.php?page=dashboard');
//                                             };
//                                         }
//                                     } else {
//                                         // Vérification de l'extension et de la taille du document.
//                                         if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                                             $uniqId = uniqid('', true);
//                                             // Création d'un uniqid
//                                             $medicalJustif = $uniqId.".".$extension;
//                                             // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                                             move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                                             // Modification des modifications dans la base de données.
//                                             $req = $bdd->prepare('ALTER TABLE user ADD user_absence9 FLOAT(5,2) AFTER user_absence8');
//                                             $req->execute();
//                                             $req = $bdd->prepare('UPDATE user SET user_absence9 = ? WHERE id = ?');
//                                             $req->execute([$totalsOfAbsences, $userModifiedId]);

//                                             // Ajout de toutes les informations si le document a été validé.
//                                             $req = $bdd->prepare('ALTER TABLE user ADD illness_justif9 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif8');
//                                             $req->execute();
//                                             $req = $bdd->prepare('UPDATE user SET illness_justif9 = ? WHERE id = ?');
//                                             $req->execute([$medicalJustif, $userModifiedId]);

//                                             // Ajout de la date de l'arrêt.
//                                             $req = $bdd->prepare('ALTER TABLE user ADD illness_date9 NULL AFTER illness_date8');
//                                             $req->execute();
//                                             $req = $bdd->prepare('UPDATE user SET illness_date9 = ? WHERE id = ?');
//                                             $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                                             // Redirection avec message de validation.
//                                             header('location: index.php?page=dashboard');

//                                         } else {
//                                             // Redirection.
//                                             header('location: index.php?page=dashboard');
//                                         };
//                                     }
//                                 } else {
//                                     // Vérification de l'extension et de la taille du document.
//                                     if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                                         $uniqId = uniqid('', true);
//                                         // Création d'un uniqid
//                                         $medicalJustif = $uniqId.".".$extension;
//                                         // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                                         move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                                         // Modification des modifications dans la base de données.
//                                         $req = $bdd->prepare('ALTER TABLE user ADD user_absence8 FLOAT(5,2) AFTER user_absence7');
//                                         $req->execute();
//                                         $req = $bdd->prepare('UPDATE user SET user_absence8 = ? WHERE id = ?');
//                                         $req->execute([$totalsOfAbsences, $userModifiedId]);

//                                         // Ajout de toutes les informations si le document a été validé.
//                                         $req = $bdd->prepare('ALTER TABLE user ADD illness_justif8 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif7');
//                                         $req->execute();
//                                         $req = $bdd->prepare('UPDATE user SET illness_justif8 = ? WHERE id = ?');
//                                         $req->execute([$medicalJustif, $userModifiedId]);

//                                         // Ajout de la date de l'arrêt.
//                                         $req = $bdd->prepare('ALTER TABLE user ADD illness_date8 NULL AFTER illness_date7');
//                                         $req->execute();
//                                         $req = $bdd->prepare('UPDATE user SET illness_date8 = ? WHERE id = ?');
//                                         $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                                         // Redirection avec message de validation.
//                                         header('location: index.php?page=dashboard');

//                                     } else {
//                                         // Redirection.
//                                         header('location: index.php?page=dashboard');
//                                     };
//                                 }
//                             } else {
//                                 // Vérification de l'extension et de la taille du document.
//                                 if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                                     $uniqId = uniqid('', true);
//                                     // Création d'un uniqid
//                                     $medicalJustif = $uniqId.".".$extension;
//                                     // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                                     move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                                     // Modification des modifications dans la base de données.
//                                     $req = $bdd->prepare('ALTER TABLE user ADD user_absence7 FLOAT(5,2) AFTER user_absence6');
//                                     $req->execute();
//                                     $req = $bdd->prepare('UPDATE user SET user_absence7 = ? WHERE id = ?');
//                                     $req->execute([$totalsOfAbsences, $userModifiedId]);

//                                     // Ajout de toutes les informations si le document a été validé.
//                                     $req = $bdd->prepare('ALTER TABLE user ADD illness_justif7 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif6');
//                                     $req->execute();
//                                     $req = $bdd->prepare('UPDATE user SET illness_justif7 = ? WHERE id = ?');
//                                     $req->execute([$medicalJustif, $userModifiedId]);

//                                     // Ajout de la date de l'arrêt.
//                                     $req = $bdd->prepare('ALTER TABLE user ADD illness_date7 NULL AFTER illness_date6');
//                                     $req->execute();
//                                     $req = $bdd->prepare('UPDATE user SET illness_date7 = ? WHERE id = ?');
//                                     $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                                     // Redirection avec message de validation.
//                                     header('location: index.php?page=dashboard');

//                                 } else {
//                                         // Redirection.
//                                         header('location: index.php?page=dashboard');
//                                     };
//                             }
//                             } else {
//                                 // Vérification de l'extension et de la taille du document.
//                                 if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                                     $uniqId = uniqid('', true);
//                                     // Création d'un uniqid
//                                     $medicalJustif = $uniqId.".".$extension;
//                                     // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                                     move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                                     // Modification des modifications dans la base de données.
//                                     $req = $bdd->prepare('ALTER TABLE user ADD user_absence6 FLOAT(5,2) AFTER user_absence5');
//                                     $req->execute();
//                                     $req = $bdd->prepare('UPDATE user SET user_absence6 = ? WHERE id = ?');
//                                     $req->execute([$totalsOfAbsences, $userModifiedId]);

//                                     // Ajout de toutes les informations si le document a été validé.
//                                     $req = $bdd->prepare('ALTER TABLE user ADD illness_justif6 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif5');
//                                     $req->execute();
//                                     $req = $bdd->prepare('UPDATE user SET illness_justif6 = ? WHERE id = ?');
//                                     $req->execute([$medicalJustif, $userModifiedId]);

//                                     // Ajout de la date de l'arrêt.
//                                     $req = $bdd->prepare('ALTER TABLE user ADD illness_date6 NULL AFTER illness_date5');
//                                     $req->execute();
//                                     $req = $bdd->prepare('UPDATE user SET illness_date6 = ? WHERE id = ?');
//                                     $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                                     // Redirection avec message de validation.
//                                     header('location: index.php?page=dashboard');

//                                 } else {
//                                     // Redirection.
//                                     header('location: index.php?page=dashboard');
//                                 };
//                             }
//                         } else {
//                             // Vérification de l'extension et de la taille du document.
//                             if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                                 $uniqId = uniqid('', true);
//                                 // Création d'un uniqid
//                                 $medicalJustif = $uniqId.".".$extension;
//                                 // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                                 move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                                 // Modification des modifications dans la base de données.
//                                 $req = $bdd->prepare('ALTER TABLE user ADD user_absence5 FLOAT(5,2) AFTER user_absence4');
//                                 $req->execute();
//                                 $req = $bdd->prepare('UPDATE user SET user_absence5 = ? WHERE id = ?');
//                                 $req->execute([$totalsOfAbsences, $userModifiedId]);

//                                 // Ajout de toutes les informations si le document a été validé.
//                                 $req = $bdd->prepare('ALTER TABLE user ADD illness_justif5 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif4');
//                                 $req->execute();
//                                 $req = $bdd->prepare('UPDATE user SET illness_justif5 = ? WHERE id = ?');
//                                 $req->execute([$medicalJustif, $userModifiedId]);

//                                 // Ajout de la date de l'arrêt.
//                                 $req = $bdd->prepare('ALTER TABLE user ADD illness_date5 NULL AFTER illness_date4');
//                                 $req->execute();
//                                 $req = $bdd->prepare('UPDATE user SET illness_date5 = ? WHERE id = ?');
//                                 $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                                 // Redirection avec message de validation.
//                                 header('location: index.php?page=dashboard');

//                             } else {
//                                 // Redirection.
//                                 header('location: index.php?page=dashboard');
//                             };
//                         }
//                     } else {
//                         // Vérification de l'extension et de la taille du document.
//                         if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                             $uniqId = uniqid('', true);
//                             // Création d'un uniqid
//                             $medicalJustif = $uniqId.".".$extension;
//                             // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                             move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                             // Modification des modifications dans la base de données.
//                             $req = $bdd->prepare('ALTER TABLE user ADD user_absence4 FLOAT(5,2) AFTER user_absence3');
//                             $req->execute();
//                             $req = $bdd->prepare('UPDATE user SET user_absence4 = ? WHERE id = ?');
//                             $req->execute([$totalsOfAbsences, $userModifiedId]);

//                             // Ajout de toutes les informations si le document a été validé.
//                             $req = $bdd->prepare('ALTER TABLE user ADD illness_justif4 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif3');
//                             $req->execute();
//                             $req = $bdd->prepare('UPDATE user SET illness_justif4 = ? WHERE id = ?');
//                             $req->execute([$medicalJustif, $userModifiedId]);

//                             // Ajout de la date de l'arrêt.
//                             $req = $bdd->prepare('ALTER TABLE user ADD illness_date4 NULL AFTER illness_date3');
//                             $req->execute();
//                             $req = $bdd->prepare('UPDATE user SET illness_date4 = ? WHERE id = ?');
//                             $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                             // Redirection avec message de validation.
//                             header('location: index.php?page=dashboard');

//                         } else {
//                             // Redirection.
//                             header('location: index.php?page=dashboard');
//                         };
//                     }
//                 } else {
//                     // Vérification de l'extension et de la taille du document.
//                     if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                         $uniqId = uniqid('', true);
//                         // Création d'un uniqid
//                         $medicalJustif = $uniqId.".".$extension;
//                         // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                         move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                         // Modification des modifications dans la base de données.
//                         $req = $bdd->prepare('ALTER TABLE user ADD user_absence3 FLOAT(5,2) AFTER user_absence2');
//                         $req->execute();
//                         $req = $bdd->prepare('UPDATE user SET user_absence3 = ? WHERE id = ?');
//                         $req->execute([$totalsOfAbsences, $userModifiedId]);

//                         // Ajout de toutes les informations si le document a été validé.
//                         $req = $bdd->prepare('ALTER TABLE user ADD illness_justif3 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif2');
//                         $req->execute();
//                         $req = $bdd->prepare('UPDATE user SET illness_justif3 = ? WHERE id = ?');
//                         $req->execute([$medicalJustif, $userModifiedId]);

//                         // Ajout de la date de l'arrêt.
//                         $req = $bdd->prepare('ALTER TABLE user ADD illness_date3 NULL AFTER illness_date2');
//                         $req->execute();
//                         $req = $bdd->prepare('UPDATE user SET illness_date3 = ? WHERE id = ?');
//                         $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                         // Redirection avec message de validation.
//                         header('location: index.php?page=dashboard');

//                     } else {
//                         // Redirection.
//                         header('location: index.php?page=dashboard');
//                     };
//             }
//         } else {
//             // Vérification de l'extension et de la taille du document.
//             if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//                 $uniqId = uniqid('', true);
//                 // Création d'un uniqid
//                 $medicalJustif = $uniqId.".".$extension;
//                 // Enregistrement de l'image dans le dossier 'medicalJustif'.
//                 move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//                 // Modification des modifications dans la base de données.
//                 $req = $bdd->prepare('ALTER TABLE user ADD user_absence2 FLOAT(5,2) AFTER user_absence1');
//                 $req->execute();
//                 $req = $bdd->prepare('UPDATE user SET user_absence2 = ? WHERE id = ?');
//                 $req->execute([$totalsOfAbsences, $userModifiedId]);

//                 // Ajout de toutes les informations si le document a été validé.
//                 $req = $bdd->prepare('ALTER TABLE user ADD illness_justif2 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif1');
//                 $req->execute();
//                 $req = $bdd->prepare('UPDATE user SET illness_justif2 = ? WHERE id = ?');
//                 $req->execute([$medicalJustif, $userModifiedId]);

//                 // Ajout de la date de l'arrêt.
//                 $req = $bdd->prepare('ALTER TABLE user ADD illness_date2 NULL AFTER illness_date1');
//                 $req->execute();
//                 $req = $bdd->prepare('UPDATE user SET illness_date2 = ? WHERE id = ?');
//                 $req->execute([$userAddAbsenceDate, $userModifiedId]);

//                 // Redirection avec message de validation.
//                 header('location: index.php?page=dashboard');

//             } else {
//                 // Redirection.
//                 header('location: index.php?page=dashboard');
//             };
//         }
//     } else {
//         // Vérification de l'extension et de la taille du document.
//         if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//             $uniqId = uniqid('', true);
//             // Création d'un uniqid
//             $medicalJustif = $uniqId.".".$extension;
//             // Enregistrement de l'image dans le dossier 'medicalJustif'.
//             move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//             // Modification des modifications dans la base de données.
//             $req = $bdd->prepare('ALTER TABLE user ADD user_absence1 FLOAT(5,2) AFTER user_absence');
//             $req->execute();
//             $req = $bdd->prepare('UPDATE user SET user_absence1 = ? WHERE id = ?');
//             $req->execute([$totalsOfAbsences, $userModifiedId]);

//             // Ajout de toutes les informations si le document a été validé.
//             $req = $bdd->prepare('ALTER TABLE user ADD illness_justif1 TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER illness_justif');
//             $req->execute();
//             $req = $bdd->prepare('UPDATE user SET illness_justif1 = ? WHERE id = ?');
//             $req->execute([$medicalJustif, $userModifiedId]);

//             // Ajout de la date de l'arrêt.
//             $req = $bdd->prepare('ALTER TABLE user ADD illness_date1 NULL AFTER illness_date');
//             $req->execute();
//             $req = $bdd->prepare('UPDATE user SET illness_date1 = ? WHERE id = ?');
//             $req->execute([$userAddAbsenceDate, $userModifiedId]);

//             // Redirection avec message de validation.
//             header('location: index.php?page=dashboard');

//         } else {
//             // Redirection.
//             header('location: index.php?page=dashboard');
//         };
//     }
// } else {
//     // Vérification de l'extension et de la taille du document.
//     if(in_array($extension, $extensions) && $medicalAddJustificationSize <= $maxSize && $medicalAddJustificationError == 0){
//         $uniqId = uniqid('', true);
//         // Création d'un uniqid
//         $medicalJustif = $uniqId.".".$extension;
//         // Enregistrement de l'image dans le dossier 'medicalJustif'.
//         move_uploaded_file($medicalAddJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

//         // Modification des modifications dans la base de données.
//         $req = $bdd->prepare('ALTER TABLE user ADD user_absence FLOAT(5,2) AFTER user_extra_time');
//         $req->execute();
//         $req = $bdd->prepare('UPDATE user SET user_absence = ? WHERE id = ?');
//         $req->execute([$totalsOfAbsences, $userModifiedId]);

//         // Ajout de toutes les informations si le document a été validé.
//         $req = $bdd->prepare('ALTER TABLE user ADD illness_justif TEXT(255) NOT NULL DEFAULT "Aucun document" AFTER user_absence');
//         $req->execute();
//         $req = $bdd->prepare('UPDATE user SET illness_justif = ? WHERE id = ?');
//         $req->execute([$medicalJustif, $userModifiedId]);

//         // Ajout de la date de l'arrêt.
//         $req = $bdd->prepare('ALTER TABLE user ADD illness_date NULL AFTER illness_justif');
//         $req->execute();
//         $req = $bdd->prepare('UPDATE user SET illness_date = ? WHERE id = ?');
//         $req->execute([$userAddAbsenceDate, $userModifiedId]);

//         // Redirection avec message de validation.
//         header('location: index.php?page=dashboard');

//     } else {
//         // Redirection.
//         header('location: index.php?page=dashboard');
//     };
// };

?>