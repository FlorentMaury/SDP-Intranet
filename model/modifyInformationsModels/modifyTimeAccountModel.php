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
    $previousUserAbsences  = $_SESSION['user_absence'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    $userName    = $userId['name'];
    $userSurname = $userId['surname'];

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
        // Enregistrement de l'image dans le dossier 'medicalJustif'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif4/'.$medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user SET user_absence4 = ? WHERE id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif4 = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user SET illness_date4 = ? WHERE id = ?');
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