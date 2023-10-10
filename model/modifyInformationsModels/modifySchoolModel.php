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
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE marital_status SET school_1 = ? WHERE id = ?');
    $req->execute([$modifySchool1, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE marital_status SET school_1_start = ? WHERE id = ?');
    $req->execute([$modifySchool1Start, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

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
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE marital_status SET school_1_end = ? WHERE id = ?');
    $req->execute([$modifySchool1End, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

if(
    isset($_FILES['school1Doc']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image de profil.
    $req = $bdd->prepare("SELECT school_1_doc FROM `marital_status` WHERE id = ?");
    $req->execute([$userId]);
    $school1Doc = $req->fetchColumn();
    unlink('./public/assets/school1Doc/'.$school1Doc);

    // Pour les images du véhicule de face.
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

    // Vérification de l'extension et de la taille de l'image de profil.
    if(in_array($extension, $extensions) && $school1DocSize <= $maxSize && $school1DocError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $school1Doc = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'school1Doc'.
        move_uploaded_file($school1DocTmpName, './public/assets/school1Doc/'.$school1Doc);

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE marital_status SET school_1_doc = ? WHERE id = ?');
        $req->execute([$school1Doc, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
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
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE marital_status SET school_2 = ? WHERE id = ?');
    $req->execute([$modifySchool2, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

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
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE marital_status SET school_2_start = ? WHERE id = ?');
    $req->execute([$modifySchool2Start, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

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
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE marital_status SET school_2_end = ? WHERE id = ?');
    $req->execute([$modifySchool2End, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

if(
    isset($_FILES['school2Doc']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image de profil.
    $req = $bdd->prepare("SELECT school_1_doc FROM `marital_status` WHERE id = ?");
    $req->execute([$userId]);
    $school2Doc = $req->fetchColumn();
    unlink('./public/assets/school2Doc/'.$school2Doc);

    // Pour les images du véhicule de face.
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

    // Vérification de l'extension et de la taille de l'image de profil.
    if(in_array($extension, $extensions) && $school2DocSize <= $maxSize && $school2DocError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid.
        $school2Doc = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'school1Doc'.
        move_uploaded_file($school2DocTmpName, './public/assets/school2Doc/'.$school2Doc);

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE marital_status SET school_2_doc = ? WHERE id = ?');
        $req->execute([$school2Doc, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
    };
};

?>