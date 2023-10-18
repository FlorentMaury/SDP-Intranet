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
    !empty($_POST['userAbsenceDate']) &&
    isset($_FILES['medicalJustification']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo = htmlspecialchars($_POST['userAbsenceInfo']);
    $modifyUserAbsenceDate = htmlspecialchars($_POST['userAbsenceDate']);
    $userId                = $_SESSION['id'];
    $previousUserAbsences  = $_SESSION['user_absence'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $userName    = $userId['name'];
    $userSurname = $userId['surname'];

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
        // Enregistrement de l'image dans le dossier 'medicalJustif'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif/'.$medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user SET user_absence = ? WHERE id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user SET illness_date = ? WHERE id = ?');
        $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        // Redirection.
        header('location: index.php?page=dashboard');
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
    $previousUserAbsences  = $_SESSION['user_absence'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $userName    = $userId['name'];
    $userSurname = $userId['surname'];

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
        // Enregistrement de l'image dans le dossier 'medicalJustif'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif2/'.$medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user SET user_absence2 = ? WHERE id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif2 = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user SET illness_date2 = ? WHERE id = ?');
        $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        // Redirection.
        header('location: index.php?page=dashboard');
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
    $previousUserAbsences  = $_SESSION['user_absence'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $userName    = $userId['name'];
    $userSurname = $userId['surname'];

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
        // Enregistrement de l'image dans le dossier 'medicalJustif'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif3/'.$medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user SET user_absence3 = ? WHERE id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif3 = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user SET illness_date3 = ? WHERE id = ?');
        $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        // Redirection.
        header('location: index.php?page=dashboard');
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
    $req->execute([$totalsOfExtraTime, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday1_response = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday1_start = ? WHERE id = ?');
    $req->execute([$holidayRequest1Start, $userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday1_end = ? WHERE id = ?');
    $req->execute([$holidayRequest1End, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday2_response = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday2_start = ? WHERE id = ?');
    $req->execute([$holidayRequest2Start, $userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday2_end = ? WHERE id = ?');
    $req->execute([$holidayRequest2End, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET holiday3_response = 0 WHERE id = ?');
    $req->execute([$userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday3_start = ? WHERE id = ?');
    $req->execute([$holidayRequest3Start, $userModifiedId]);
    $req = $bdd->prepare('UPDATE user SET holiday3_end = ? WHERE id = ?');
    $req->execute([$holidayRequest3End, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
};

?>