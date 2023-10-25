<?php

// Vérification du formulaire de modification de la première école.
if(
    !empty($_POST['school1']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool1 = htmlspecialchars($_POST['school1']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_1 = ? WHERE id = ?');
    $result = $req->execute([$modifySchool1, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier cette expérience scolaire.');
        exit();
    }
}

// Vérification du formulaire de modification des dates de début la première école.
if(
    !empty($_POST['school1Start']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool1Start = htmlspecialchars($_POST['school1Start']);
    $userId             = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_1_start = ? WHERE id = ?');
    $result = $req->execute([$modifySchool1Start, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ces dates.');
        exit();
    }
};

// Vérification du formulaire de modification des dates de fin la première école.
if(
    !empty($_POST['school1End']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool1End = htmlspecialchars($_POST['school1End']);
    $userId             = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_1_end = ? WHERE id = ?');
    $result = $req->execute([$modifySchool1End, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ces dates.');
        exit();
    }
};

// Vérification du formulaire de modification du diplôme de la première école.
if(
    isset($_FILES['school1Doc']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancien diplôme.
    $req = $bdd->prepare("SELECT school_1_doc FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $school1Doc = $req->fetchColumn();
    unlink('./public/assets/school1Doc/'.$school1Doc);

    // Pour le document.
    $school1DocName    = $_FILES['school1Doc']['name'];
    $school1DocTmpName = $_FILES['school1Doc']['tmp_name'];
    $school1DocSize    = $_FILES['school1Doc']['size'];
    $school1DocError   = $_FILES['school1Doc']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $school1DocName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille ddu document.
    if(in_array($extension, $extensions) && $school1DocSize <= $maxSize && $school1DocError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $school1Doc = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'school1Doc'.
        move_uploaded_file($school1DocTmpName, './public/assets/school1Doc/'.$school1Doc);

        // Ajout des informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET school_1_doc = ? WHERE id = ?');
        $result = $req->execute([$school1Doc, $userModifiedId]);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1');
            exit();
        } else {
            header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ce document.');
            exit();
        }
    } else {
        header('location: index.php?page=dashboard&error=1&message=Le document doit être au format  \'jpg\', \'png\', \'jpeg\', \'webp\', \'pdf\', \'doc\', \'docx\', \'odt\', \'txt\' ou \'rtf\'.');
        exit();
    };
};


// Vérification du formulaire de modification de la seconde école.
if(
    !empty($_POST['school2']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool2 = htmlspecialchars($_POST['school2']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_2 = ? WHERE id = ?');
    $result = $req->execute([$modifySchool2, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier cette expérience scolaire.');
        exit();
    }
};


// Vérification du formulaire de modification des dates de début la seconde école.
if(
    !empty($_POST['school2Start']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool2Start = htmlspecialchars($_POST['school2Start']);
    $userId             = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_2_start = ? WHERE id = ?');
    $result = $req->execute([$modifySchool2Start, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ces dates.');
        exit();
    }
};


// Vérification du formulaire de modification des dates de fin la seconde école.
if(
    !empty($_POST['school2End']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool2End = htmlspecialchars($_POST['school2End']);
    $userId             = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_2_end = ? WHERE id = ?');
    $result = $req->execute([$modifySchool2End, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ces dates.');
        exit();
    }
};

// Vérification du formulaire de modification du diplôme de la seconde école.
if(
    isset($_FILES['school2Doc']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancien diplôme.
    $req = $bdd->prepare("SELECT school_2_doc FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $school2Doc = $req->fetchColumn();
    unlink('./public/assets/school2Doc/'.$school2Doc);

    // Pour le document du diplôme.
    $school2DocName    = $_FILES['school2Doc']['name'];
    $school2DocTmpName = $_FILES['school2Doc']['tmp_name'];
    $school2DocSize    = $_FILES['school2Doc']['size'];
    $school2DocError   = $_FILES['school2Doc']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $school2DocName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if(in_array($extension, $extensions) && $school2DocSize <= $maxSize && $school2DocError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid.
        $school2Doc = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'school2Doc'.
        move_uploaded_file($school2DocTmpName, './public/assets/school2Doc/'.$school2Doc);

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET school_2_doc = ? WHERE id = ?');
        $result = $req->execute([$school2Doc, $userModifiedId]);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1');
            exit();
        } else {
            header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ce document.');
            exit();
        }
    } else {
        header('location: index.php?page=dashboard&error=1&message=Le document doit être au format  \'jpg\', \'png\', \'jpeg\', \'webp\', \'pdf\', \'doc\', \'docx\', \'odt\', \'txt\' ou \'rtf\'.');
        exit();
    };
};


// Vérification du formulaire de modification de la troisième école.
if(
    !empty($_POST['school3']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool3 = htmlspecialchars($_POST['school3']);
    $userId        = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_3 = ? WHERE id = ?');
    $result = $req->execute([$modifySchool3, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier cette expérience scolaire.');
        exit();
    }
};

    
// Vérification du formulaire de modification des dates de début la trosième école.
if(
    !empty($_POST['school3Start']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool3Start = htmlspecialchars($_POST['school3Start']);
    $userId             = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_3_start = ? WHERE id = ?');
    $result = $req->execute([$modifySchool3Start, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ces dates.');
        exit();
    };
};

    
// Vérification du formulaire de modification des dates de fin la troisième école.
if(
    !empty($_POST['school3End']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySchool3End = htmlspecialchars($_POST['school3End']);
    $userId             = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET school_3_end = ? WHERE id = ?');
    $result = $req->execute([$modifySchool3End, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1');
        exit();
    } else {
        header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ces dates.');
        exit();
    };
};

    
// Vérification du formulaire de modification du diplôme de la troisième école.
if(
    isset($_FILES['school3Doc']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancien diplôme.
    $req = $bdd->prepare("SELECT school_3_doc FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $school3Doc = $req->fetchColumn();
    unlink('./public/assets/school3Doc/'.$school2Doc);

    // Pour le document.
    $school3DocName    = $_FILES['school3Doc']['name'];
    $school3DocTmpName = $_FILES['school3Doc']['tmp_name'];
    $school3DocSize    = $_FILES['school3Doc']['size'];
    $school3DocError   = $_FILES['school3Doc']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $school3DocName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if(in_array($extension, $extensions) && $school3DocSize <= $maxSize && $school3DocError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid.
        $school3Doc = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'school3Doc'.
        move_uploaded_file($school3DocTmpName, './public/assets/school3Doc/'.$school3Doc);

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET school_3_doc = ? WHERE id = ?');
        $result = $req->execute([$school3Doc, $userModifiedId]);
        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1');
            exit();
        } else {
            header('location: index.php?page=dashboard&error=1&message=Impossible de modifier ce document.');
            exit();
        }
    } else {
        header('location: index.php?page=dashboard&error=1&message=Le document doit être au format  \'jpg\', \'png\', \'jpeg\', \'webp\', \'pdf\', \'doc\', \'docx\', \'odt\', \'txt\' ou \'rtf\'.');
        exit();
    };
};

?>