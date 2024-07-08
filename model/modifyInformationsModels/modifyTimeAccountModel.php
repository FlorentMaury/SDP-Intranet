<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Vérification du formulaire de déclaration de retard.
if (
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
    $r = $bdd->prepare("SELECT user_delay FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userId]);
    $previousUserDelays = $r->fetchColumn();

    $totalsOfDelays = floatval($modifyUserDelayInfo) + floatval($previousUserDelays);

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_time_bank SET user_delay = ? WHERE user_time_bank_id = ?');
    $result = $req->execute([$totalsOfDelays, $userModifiedId]);

    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer ce retard.');
        exit();
    }
};

// Vérification du formulaire de déclaration d'absence.
if (
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

    // Sélection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userId]);
    $previousUserAbsences = $r->fetchColumn();

    // Gestion des variables.
    $r = $bdd->prepare("SELECT name, surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $user = $r->fetch(PDO::FETCH_ASSOC);

    $userName = $user['name'];
    $userSurname = $user['surname'];

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
    if (in_array($extension, $extensions) && $medicalJustificationSize <= $maxSize && $medicalJustificationError == 0) {
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId . "." . $extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif/' . $medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user_time_bank SET user_absence = ? WHERE user_time_bank_id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user_time_bank SET illness_justif = ? WHERE user_time_bank_id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user_time_bank SET illness_date = ? WHERE user_time_bank_id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, un arrêt de travail vient d'être déclaré de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = "pdana@free.fr,mrisler@sdp-paris.com";
        $subject       = "Arrêt de travail | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du contenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if ($result) {
            header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
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
if (
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

    // Gestion des variables.
    $r = $bdd->prepare("SELECT id, name, surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $user = $r->fetch(PDO::FETCH_ASSOC);

    $userModifiedId = $user['id'];
    $userName = $user['name'];
    $userSurname = $user['surname'];

    // Selection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM user_time_bank WHERE user_time_bank_id = ?");
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
    if (in_array($extension, $extensions) && $medicalJustificationSize <= $maxSize && $medicalJustificationError == 0) {
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId . "." . $extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif2'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif2/' . $medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user_time_bank SET user_absence2 = ? WHERE user_time_bank_id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user_time_bank SET illness_justif2 = ? WHERE user_time_bank_id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user_time_bank SET illness_date2 = ? WHERE user_time_bank_id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, un arrêt de travail vient d'être déclaré de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = "pdana@free.fr,mrisler@sdp-paris.com";
        $subject       = "Arrêt de travail | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du contenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if ($result) {
            header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
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
if (
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

    // Gestion des variables.
    $r = $bdd->prepare("SELECT id, name, surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $user = $r->fetch(PDO::FETCH_ASSOC);

    $userModifiedId = $user['id'];
    $userName = $user['name'];
    $userSurname = $user['surname'];

    // Selection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM user_time_bank WHERE user_time_bank_id = ?");
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
    if (in_array($extension, $extensions) && $medicalJustificationSize <= $maxSize && $medicalJustificationError == 0) {
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId . "." . $extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif3'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif3/' . $medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user_time_bank SET user_absence3 = ? WHERE user_time_bank_id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user_time_bank SET illness_justif3 = ? WHERE user_time_bank_id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user_time_bank SET illness_date3 = ? WHERE user_time_bank_id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, un arrêt de travail vient d'être déclaré de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = "pdana@free.fr,mrisler@sdp-paris.com";
        $subject       = "Arrêt de travail | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if ($result) {
            header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
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
if (
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

    // Gestion des variables.
    $r = $bdd->prepare("SELECT id, name, surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $user = $r->fetch(PDO::FETCH_ASSOC);

    $userModifiedId = $user['id'];
    $userName = $user['name'];
    $userSurname = $user['surname'];

    // Selection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM user_time_bank WHERE user_time_bank_id = ?");
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
    if (in_array($extension, $extensions) && $medicalJustificationSize <= $maxSize && $medicalJustificationError == 0) {
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId . "." . $extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif3'.
        move_uploaded_file($medicalJustificationTmpName, './public/assets/illnessJustif4/' . $medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user_time_bank SET user_absence4 = ? WHERE user_time_bank_id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user_time_bank SET illness_justif4 = ? WHERE user_time_bank_id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user_time_bank SET illness_date4 = ? WHERE user_time_bank_id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, un arrêt de travail vient d'être déclaré de la part de $userName $userSurname en date du $modifyDayOffRequest3.";
        // $to         = 'contact@florent-maury.fr';
        $to            = "pdana@free.fr,mrisler@sdp-paris.com";
        $subject       = "Arrêt de travail | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if ($result) {
            header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
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
if (
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

    $r = $bdd->prepare("SELECT user_extra_time FROM `user_time_bank` WHERE user_time_bank_id = ?");
    $r->execute([$userModifiedId]);
    $previousUserExtraTime = $r->fetchColumn();

    $totalsOfExtraTime = floatval($modifyUserExtraTimeInfo) + floatval($previousUserExtraTime);

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_time_bank SET user_extra_time = ? WHERE user_time_bank_id = ?');
    $result = $req->execute([$totalsOfExtraTime, $userModifiedId]);

    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer ces heures supplémentaires.');
        exit();
    };
};


// DEMANDE DE VACANCES.

// Vérification du formulaire de demande de CA.
if (
    !empty($_POST['holidayRequestStart']) &&
    !empty($_POST['holidayRequestEnd']) &&
    !empty($_POST['holidayRequestText'])
) {

    require 'vendor/autoload.php';
    require('./model/connectionDBModel.php');

    $userId = $_SESSION['id'];
    $holidayRequestStart = htmlspecialchars($_POST['holidayRequestStart']);
    $holidayRequestEnd   = htmlspecialchars($_POST['holidayRequestEnd']);
    $holidayRequestText  = htmlspecialchars($_POST['holidayRequestText']);

    // Vérification que la date de fin soit postérieure à la date de début.
    if ($holidayRequestEnd < $holidayRequestStart) {
        header('location: index.php?page=dashboard&error=1&message=La date de fin des vacances doit être postérieure à la date de début.');
        return;
    }

    // Vérification que la date de début soit postérieure à la date du jour.
    if ($holidayRequestStart < date('Y-m-d')) {
        header('location: index.php?page=dashboard&error=1&message=La date de début des vacances doit être postérieure à la date du jour.');
        return;
    }

    // Vérification que la date de fin soit postérieure à la date du jour.
    if ($holidayRequestEnd < date('Y-m-d')) {
        header('location: index.php?page=dashboard&error=1&message=La date de fin des vacances doit être postérieure à la date du jour.');
        return;
    }

    // Vérification que la date de début ne soit pas égale à la date de fin.
    // if ($holidayRequestStart == $holidayRequestEnd) {
    //     header('location: index.php?page=dashboard&error=1&message=La date de début des vacances ne peut pas être égale à la date de fin.');
    //     return;
    // }

    $userQuery = $bdd->prepare("SELECT id, email, name, surname FROM `user` WHERE id = ?");
    $userQuery->execute([$userId]);
    $user = $userQuery->fetch(PDO::FETCH_ASSOC);

    $userModifiedId = $user['id'];
    $userEmail = $user['email'];
    $userName = $user['name'];
    $userSurname = $user['surname'];

    $holidayRequestStart = new DateTime($holidayRequestStart);
    $holidayRequestEnd = new DateTime($holidayRequestEnd);

    // Vérification qu'il reste des jours de congés à poser.
    if ($holidaysTotal > ((strtotime($holidayEnd) - strtotime($holidayStart)) / 86400)) {
        header('location: index.php?page=dashboard&error=1&message=Il ne vous reste pas suffisament de jours de congés à poser.');
        return;
    }

    $interval = $holidayRequestStart->diff($holidayRequestEnd);

    $numberOfDays = $interval->days + 1;

    $holidayRequestQuery = $bdd->prepare('INSERT INTO user_holiday (user_holiday_id, holiday_start, holiday_end, holiday_request_text, holiday_response) VALUES (?, ?, ?, ?, 0)');
    $result = $holidayRequestQuery->execute([$userModifiedId, $holidayRequestStart->format('Y-m-d'), $holidayRequestEnd->format('Y-m-d'), $holidayRequestText]);

    // // Charger le fichier Excel existant
    // $filePath = './public/assets/fichier_vacances.xlsx';

    // if (!file_exists($filePath)) {
    //     $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    //     $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    //     $writer->save($filePath);
    // } else {
    //     $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
    // }$

    // // Obtenir la première feuille de calcul
    // $worksheet = $spreadsheet->getActiveSheet();

    // // Obtenir le numéro de la dernière ligne
    // $lastRow = $worksheet->getHighestRow();

    // // Ajouter la nouvelle demande de vacances à la dernière ligne
    // $worksheet->setCellValue('A' . ($lastRow + 1), $userModifiedId);
    // $worksheet->setCellValue('B' . ($lastRow + 1), $userName);
    // $worksheet->setCellValue('C' . ($lastRow + 1), $userSurname);
    // $worksheet->setCellValue('D' . ($lastRow + 1), $holidayRequest1Start);
    // $worksheet->setCellValue('E' . ($lastRow + 1), $holidayRequest1End);

    // // Sauvegarder le fichier Excel
    // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    // $writer->save('./public/assets/fichier_vacances.xlsx');

    if ($result) {
        $lastInsertId = $bdd->lastInsertId();

        // FONCTION MAILTO.

        // Variables pour le premier mail.
        $userMessage1 =
            "<html>
                <head>
                    <title>Demande de vacances | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, vous avez une demande de vacances de la part de $userName $userSurname 
                    du " . $holidayRequestStart->format('d-m-Y') . " au " . $holidayRequestEnd->format('d-m-Y') . " (soit $numberOfDays jours) pour le motif suivant : '$holidayRequestText'.</p>
                    <a 
                        href='https://sdp-paris.com/Intranet-SDP/index.php?page=user&holidayResponseMail=1&hid=$lastInsertId&user=$userModifiedId&id=$userModifiedId&action=userTimeBankButton'
                        style='padding: 10px 20px; background-color: green; color: white; text-decoration: none;'
                    >
                        Accepter
                    </a>
                    <a 
                        href='https://sdp-paris.com/Intranet-SDP/index.php?page=user&holidayResponseMail=2&hid=$lastInsertId&user=$userModifiedId&id=$userModifiedId&action=userTimeBankButton'
                        style='padding: 10px 20px; background-color: red; color: white; text-decoration: none;'
                    >
                        Refuser
                    </a>
                </body>
            </html>";
        // $to1      = 'contact@florent-maury.fr';
        $to1      = 'pdana@free.fr, mrisler@sdp-paris.com';
        $subject1 = "Demande de vacances | $userName $userSurname";
        $contentMessage1 = wordwrap($userMessage1, 70, "\r\n");
        $headers1 = "MIME-Version: 1.0" . "\r\n";
        $headers1 .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers1 .= "From: SDP - Vacances <$userEmail>" . "\r\n";
        $headers1 .= "Reply-To: $userEmail" . "\r\n";
        mail($to1, $subject1, $contentMessage1, $headers1);

        // Variables pour le deuxième mail.
        $userMessage2 =
            "<html>
                <head>
                    <title>Demande de vacances | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, votre demande de vacances du " . $holidayRequestStart->format('d-m-Y') . " au " . $holidayRequestEnd->format('d-m-Y') . " (soit $numberOfDays jours) pour le motif suivant : '$holidayRequestText' à été transmise.</p>
                </body>
            </html>";
        $to2          = $userEmail;
        $subject2     = "Demande de vacances | $userName $userSurname";
        $contentMessage2 = wordwrap($userMessage2, 70, "\r\n");
        $headers2 = "MIME-Version: 1.0" . "\r\n";
        $headers2 .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers2 .= "From: SDP - Vacances <$userEmail>" . "\r\n";
        $headers2 .= "Reply-To: $userEmail" . "\r\n";
        mail($to2, $subject2, $contentMessage2, $headers2);

        header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&messageMod=Impossible de déclarer cette demande de vacances.');
        exit();
    }
};

// DEMANDE DE JOUR SUPPLEMENTAIRE.

// Vérification du formulaire de déclaration de jours supplémentaires.
if (
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

    $r = $bdd->prepare("SELECT day_off_bank FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userModifiedId]);
    $previousAddDayOffBank = $r->fetchColumn();

    $totalsOfDayOffBank = floatval($modifyAddDayOffBank) + floatval($previousAddDayOffBank);

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_time_bank SET day_off_bank = ? WHERE user_time_bank_id = ?');
    $result = $req->execute([$totalsOfDayOffBank, $userModifiedId]);

    // Redirection.
    if ($result) {
        header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer ces jours supplémentaires.');
        exit();
    }
};


// Vérification du formulaire de demande de jour de repos.
if (
    !empty($_POST['dayOffRequestStart']) &&
    !empty($_POST['dayOffRequestDesc'])
) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyDayOffRequest = htmlspecialchars($_POST['dayOffRequestStart']);
    $dayOffRequestDesc   = htmlspecialchars($_POST['dayOffRequestDesc']);
    $userId              = $_SESSION['id'];

    // Gestion des variables.
    $r = $bdd->prepare("SELECT id, name, surname, email FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $user = $r->fetch(PDO::FETCH_ASSOC);

    $userModifiedId = $user['id'];
    $userName       = $user['name'];
    $userSurname    = $user['surname'];
    $userEmail      = $user['email'];

    $dayOffRequestQuery = $bdd->prepare('INSERT INTO user_day_off (user_day_off_id, day_off, day_off_request_text, day_off_response) VALUES (?, ?, ?, 0)');
    $result = $dayOffRequestQuery->execute([$userModifiedId, $modifyDayOffRequest, $dayOffRequestDesc]);

    // Redirection.
    if ($result) {
        $lastInsertId = $bdd->lastInsertId();

        // FONCTION MAILTO.

        // Variables.
        $userMessage1 =
            "<html>
                <head>
                    <title>Demande de journée de repos | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, vous avez une demande de repos de la part de $userName $userSurname 
                    au $modifyDayOffRequest.</p>
                    <p>Voici le motif de cette demande : $dayOffRequestDesc</p>
                    <a 
                        href='https://sdp-paris.com/Intranet-SDP/index.php?page=email&dayOffMail=1&id=$userId'
                        style='padding: 10px 20px; background-color: green; color: white; text-decoration: none;'
                    >
                        Accepter
                    </a>
                    <a 
                        href='https://sdp-paris.com/Intranet-SDP/index.php?page=email&dayOffMail=2&id=$userId'
                        style='padding: 10px 20px; background-color: red; color: white; text-decoration: none;'
                    >
                        Refuser
                    </a>
                </body>
            </html>";
        // $to1    = 'contact@florent-maury.fr';
        $to       = "pdana@free.fr,mrisler@sdp-paris.com";
        $subject1  = "Demande de repos | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage1 = wordwrap($userMessage1, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $headers1 = "MIME-Version: 1.0" . "\r\n";
        $headers1 .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers1 .= "From: SDP - Jour de repos <$userEmail>" . "\r\n";
        $headers1 .= "Reply-To: $userEmail" . "\r\n";

        mail($to1, $subject1, $contentMessage1, $headers1);

        // Variables.
        $userMessage2 =
            "<html>
                <head>
                    <title>Demande de journée de repos | $userName $userSurname</title>
                </head>
                <body>
                    <p>Bonjour, votre demande de repos au $modifyDayOffRequest pour le motif suivant : $dayOffRequest à bien été transmise</p>
                    <p>Voici le motif de cette demande : $dayOffRequestDesc</p>
                </body>
            </html>";
        // $to    = 'contact@florent-maury.fr';
        $to2       = "$userEmail";
        $subject2  = "Demande de repos | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage2 = wordwrap($userMessage2, 70, "\r\n");

        // Personnalisation du conatenu en fonction des variables.
        $headers2 = "MIME-Version: 1.0" . "\r\n";
        $headers2 .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers2 .= "From: SDP - Jour de repos <$userEmail>" . "\r\n";
        $headers2 .= "Reply-To: $userEmail" . "\r\n";

        mail($to2, $subject2, $contentMessage2, $headers2);

        header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de déclarer cette demande de repos.');
        exit();
    }
};


// Vérification du formulaire d'une première absence plannifiée.
if (
    !empty($_POST['plannedUserAbsenceInfo']) &&
    !empty($_POST['plannedUserAbsenceDate']) &&
    isset($_FILES['plannedMedicalJustification'])
) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo = htmlspecialchars($_POST['plannedUserAbsenceInfo']);
    $modifyUserAbsenceDate = htmlspecialchars($_POST['plannedUserAbsenceDate']);
    $userId                = $_SESSION['id'];

    // Sélection de l'ID, du nom et du prénom.
    $r = $bdd->prepare("SELECT id, name, surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $user = $r->fetch(PDO::FETCH_ASSOC);

    $userModifiedId = $user['id'];
    $userName = $user['name'];
    $userSurname = $user['surname'];

    // Sélection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userId]);
    $previousUserAbsences = $r->fetchColumn();

    // Document de l'arrêt maladie.
    $plannedMedicalJustificationName    = $_FILES['plannedMedicalJustification']['name'];
    $plannedMedicalJustificationTmpName = $_FILES['plannedMedicalJustification']['tmp_name'];
    $plannedMedicalJustificationSize    = $_FILES['plannedMedicalJustification']['size'];
    $plannedMedicalJustificationError   = $_FILES['plannedMedicalJustification']['error'];

    $totalsOfAbsences = floatval($modifyUserAbsenceInfo) + floatval($previousUserAbsences);

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $plannedMedicalJustificationName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if (in_array($extension, $extensions) && $plannedMedicalJustificationSize <= $maxSize && $plannedMedicalJustificationError == 0) {
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId . "." . $extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif'.
        move_uploaded_file($plannedMedicalJustificationTmpName, './public/assets/plannedIllnessJustif1/' . $medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user_time_bank SET planned_illness_1 = ? WHERE user_time_bank_id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user_time_bank SET planned_illness_1_justif = ? WHERE user_time_bank_id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user_time_bank SET planned_illness_1_date = ? WHERE user_time_bank_id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, une absence plannifié vient d'être déclaré de la part de $userName $userSurname en date du $modifyUserAbsenceDate.";
        // $to         = 'contact@florent-maury.fr';
        $to            = "pdana@free.fr,mrisler@sdp-paris.com";
        $subject       = "Absence prévue | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du contenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if ($result) {
            header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
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

// Vérification du formulaire d'une seconde absence plannifiée.
if (
    !empty($_POST['plannedUserAbsenceInfo2']) &&
    !empty($_POST['plannedUserAbsenceDate2']) &&
    isset($_FILES['plannedMedicalJustification2'])
) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo = htmlspecialchars($_POST['plannedUserAbsenceInfo2']);
    $modifyUserAbsenceDate = htmlspecialchars($_POST['plannedUserAbsenceDate2']);
    $userId                = $_SESSION['id'];

    // Sélection de l'ID, du nom et du prénom.
    $r = $bdd->prepare("SELECT id, name, surname FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $user = $r->fetch(PDO::FETCH_ASSOC);

    $userModifiedId = $user['id'];
    $userName = $user['name'];
    $userSurname = $user['surname'];

    // Sélection du retard précédent.
    $r = $bdd->prepare("SELECT user_absence FROM user_time_bank WHERE user_time_bank_id = ?");
    $r->execute([$userId]);
    $previousUserAbsences = $r->fetchColumn();

    // Document de l'arrêt maladie.
    $plannedMedicalJustificationName    = $_FILES['plannedMedicalJustification2']['name'];
    $plannedMedicalJustificationTmpName = $_FILES['plannedMedicalJustification2']['tmp_name'];
    $plannedMedicalJustificationSize    = $_FILES['plannedMedicalJustification2']['size'];
    $plannedMedicalJustificationError   = $_FILES['plannedMedicalJustification2']['error'];

    $totalsOfAbsences = floatval($modifyUserAbsenceInfo) + floatval($previousUserAbsences);

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $plannedMedicalJustificationName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if (in_array($extension, $extensions) && $plannedMedicalJustificationSize <= $maxSize && $plannedMedicalJustificationError == 0) {
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $medicalJustif = $uniqId . "." . $extension;
        // Enregistrement de l'image dans le dossier 'illnessJustif'.
        move_uploaded_file($plannedMedicalJustificationTmpName, './public/assets/plannedIllnessJustif2/' . $medicalJustif);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE user_time_bank SET planned_illness_2 = ? WHERE user_time_bank_id = ?');
        $req->execute([$totalsOfAbsences, $userModifiedId]);

        // Ajout de toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user_time_bank SET planned_illness_2_justif = ? WHERE user_time_bank_id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);

        // Ajout de la date de l'arrêt.
        $req = $bdd->prepare('UPDATE user_time_bank SET planned_illness_2_date = ? WHERE user_time_bank_id = ?');
        $result = $req->execute([$modifyUserAbsenceDate, $userModifiedId]);

        // FONCTION MAILTO.

        // Variables.
        $userMessage   = "Bonjour, une absence plannifié vient d'être déclaré de la part de $userName $userSurname en date du $modifyUserAbsenceDate.";
        // $to         = 'contact@florent-maury.fr';
        $to            = "pdana@free.fr,mrisler@sdp-paris.com";
        $subject       = "Absence prévue | $userName $userSurname";

        // Retour à la ligne en cas de dépassement des 70 caractères.
        $contentMessage = wordwrap($userMessage, 70, "\r\n");

        // Personnalisation du contenu en fonction des variables.
        $header = [
            "Name" => $userName
        ];

        mail($to, $subject, $contentMessage, $header);

        // Redirection avec message de validation.
        if ($result) {
            header('location: index.php?page=dashboard&timeBankModification=1&action=timeBankButton');
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
