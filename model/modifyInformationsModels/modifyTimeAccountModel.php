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
    isset($_FILES['medicalJustification']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserAbsenceInfo = htmlspecialchars($_POST['userAbsenceInfo']);
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

        // Ajout de l'image avec toutes les informations si le document a été validé.
        $req = $bdd->prepare('UPDATE user SET illness_justif = ? WHERE id = ?');
        $req->execute([$medicalJustif, $userModifiedId]);
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

?>