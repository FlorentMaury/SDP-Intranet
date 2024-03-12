<?php

// Vérification du formulaire de modification du mot de passe.
if(
    !empty($_POST['modifyPassword1']) &&
    !empty($_POST['modifyPassword2'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyPassword1 = htmlspecialchars($_POST['modifyPassword1']);
    $modifyPassword2 = htmlspecialchars($_POST['modifyPassword2']);
    $userId          = $_SESSION['id'];

    // Les mots de passe sont-ils identiques ?
    if($modifyPassword1 != $modifyPassword2) {
        header('location: index.php?page=dashoard&errorMod=1&messageMod=Les mots de passe ne sont pas identiques.');
        exit();
    }

    // Chiffrement du mot de passe.
    $modifyPassword1 = "zk32".sha1($modifyPassword1 ."486")."345";

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET password = ? WHERE id = ?');
    $result = $req->execute([$modifyPassword1, $userModifiedId]);

    if($result) {
        // Redirection.
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {    
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le mot de passe.');
        exit();
    }
}

// Vérification du formulaire de modification de la ville de naissance.
if(
    !empty($_POST['birthCity']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyBirthCity = htmlspecialchars($_POST['birthCity']);
    $userId          = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET birth_city = ? WHERE id = ?');
    $result = $req->execute([$modifyBirthCity, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la ville de naissance.');
        exit();
    }
}

// Vérification du formulaire de modification du pays de naissance.
if(
    !empty($_POST['birthCountry']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyBirthCountry = htmlspecialchars($_POST['birthCountry']);
    $userId          = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET birth_country = ? WHERE id = ?');
    $result = $req->execute([$modifyBirthCountry, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le pays de naissance.');
        exit();
    }
}

// Vérification du formulaire de modification de la date de naissance.
if(
    !empty($_POST['modifyBirth']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyBirth = htmlspecialchars($_POST['modifyBirth']);
    $userId      = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET birth_date = ? WHERE id = ?');
    $result = $req->execute([$modifyBirth, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la date de naissance.');
        exit();
    }
}

// Vérification du formulaire de modification de la ville actuelle.
if(
    !empty($_POST['currentCity']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $currentCity = htmlspecialchars($_POST['currentCity']);
    $userId              = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET current_city = ? WHERE id = ?');
    $result = $req->execute([$currentCity, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la ville actuelle.');
        exit();
    };
};

// Vérification du formulaire de modification du pays actuel.
if(
    !empty($_POST['currentCountry']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $currentCountry = htmlspecialchars($_POST['currentCountry']);
    $userId         = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET current_country = ? WHERE id = ?');
    $result = $req->execute([$currentCountry, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le pays actuel.');
        exit();
    };
}

// Vérification du formulaire de modification de la rue actuelle.
if(
    !empty($_POST['currentStreetName']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $currentStreetName = htmlspecialchars($_POST['currentStreetName']);
    $userId              = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET current_city_street = ? WHERE id = ?');
    $result = $req->execute([$currentStreetName, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la rue actuelle.');
        exit();
    };
}

// Vérification du formulaire de modification du numéro de la rue actuelle.
if(
    !empty($_POST['currentStreetNumber']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $currentStreetNumber = htmlspecialchars($_POST['currentStreetNumber']);
    $userId              = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET current_street_number = ? WHERE id = ?');
    $result = $req->execute([$currentStreetNumber, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le numéro de la rue actuelle.');
        exit();
    };
};

// Vérification du formulaire d'ajout ou de modification de la carte d'identité de face.
if(
    isset($_FILES['idCardFace']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image.
    $req = $bdd->prepare("SELECT id_card_face FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $idCardFaceImg = $req->fetchColumn();
    unlink('./public/assets/idCardFace/'.$idCardFaceImg);

    // Pour l'images de face.
    $idFacePictureName    = $_FILES['idCardFace']['name'];
    $idFacePictureTmpName = $_FILES['idCardFace']['tmp_name'];
    $idFacePictureSize    = $_FILES['idCardFace']['size'];
    $idFacePictureError   = $_FILES['idCardFace']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $idFacePictureName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille de l'image.
    if(in_array($extension, $extensions) && $idFacePictureSize <= $maxSize && $idFacePictureError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $idCardFacePicture = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'idCardFace'.
        move_uploaded_file($idFacePictureTmpName, './public/assets/idCardFace/'.$idCardFacePicture);

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET id_card_face = ? WHERE id = ?');
        $result = $req->execute([$idCardFacePicture, $userModifiedId]);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
            exit;
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la carte d\'identité.');
            exit();
        };
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le fichier doit être au format \'jpg\', \'png\', \'jpeg\' ou \'webp\'.');
        exit();
    };
};


// Vérification du formulaire d'ajout ou de modification de la carte vitale de dos.
if(
    isset($_FILES['idCardBack']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image.
    $req = $bdd->prepare("SELECT id_card_back FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $idCardBackImg = $req->fetchColumn();
    unlink('./public/assets/idCardBack/'.$idCardBackImg);

    // Pour l'image de dos.
    $idBackPictureName    = $_FILES['idCardBack']['name'];
    $idBackPictureTmpName = $_FILES['idCardBack']['tmp_name'];
    $idBackPictureSize    = $_FILES['idCardBack']['size'];
    $idBackPictureError   = $_FILES['idCardBack']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $idBackPictureName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille de l'image.
    if(in_array($extension, $extensions) && $idBackPictureSize <= $maxSize && $idBackPictureError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $idCardBackPicture = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'idCardBack'.
        move_uploaded_file($idBackPictureTmpName, './public/assets/idCardBack/'.$idCardBackPicture);

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET id_card_back = ? WHERE id = ?');
        $result = $req->execute([$idCardBackPicture, $userModifiedId]);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
            exit;
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la carte d\'identité.');
            exit();
        };
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le fichier doit être au format \'jpg\', \'png\', \'jpeg\', \'webp\'.');
        exit();
    };
};

// Vérification du formulaire de modification du numéro de carte d'identité.
if(
    !empty($_POST['idNumber']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $idNumber = htmlspecialchars($_POST['idNumber']);
    $userId   = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET id_number = ? WHERE id = ?');
    $result = $req->execute([$idNumber, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le numéro de carte d\'identité.');
        exit();
    };
};

// Vérification du formulaire d'ajout ou de modification de la carte vitale de face.
if(
    isset($_FILES['insuranceCardFace']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image.
    $req = $bdd->prepare("SELECT insurance_card_face FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $insuranceCardFaceImg = $req->fetchColumn();
    unlink('./public/assets/insuranceCardFace/'.$insuranceCardFaceImg);

    // Pour l'image de face.
    $insuranceFacePictureName    = $_FILES['insuranceCardFace']['name'];
    $insuranceFacePictureTmpName = $_FILES['insuranceCardFace']['tmp_name'];
    $insuranceFacePictureSize    = $_FILES['insuranceCardFace']['size'];
    $insuranceFacePictureError   = $_FILES['insuranceCardFace']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $insuranceFacePictureName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille de l'image.
    if(in_array($extension, $extensions) && $insuranceFacePictureSize <= $maxSize && $insuranceFacePictureError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $insuranceCardFacePicture = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'insuranceCardFace'.
        move_uploaded_file($insuranceFacePictureTmpName, './public/assets/insuranceCardFace/'.$insuranceCardFacePicture);

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET insurance_card_face = ? WHERE id = ?');
        $result = $req->execute([$insuranceCardFacePicture, $userModifiedId]);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
            exit;
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la carte vitale.');
            exit();
        };
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le fichier doit être au format \'jpg\', \'png\', \'jpeg\', \'webp\'.');
        exit();
    };
};


// Vérification du formulaire d'ajout ou de modification de la carte vitale de dos.
if(
    isset($_FILES['insuranceCardBack']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image.
    $req = $bdd->prepare("SELECT insurance_card_back FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $insuranceCardBackImg = $req->fetchColumn();
    unlink('./public/assets/insuranceCardBack/'.$insuranceCardBackImg);

    // Pour l'image de dos.
    $insuranceBackPictureName    = $_FILES['insuranceCardBack']['name'];
    $insuranceBackPictureTmpName = $_FILES['insuranceCardBack']['tmp_name'];
    $insuranceBackPictureSize    = $_FILES['insuranceCardBack']['size'];
    $insuranceBackPictureError   = $_FILES['insuranceCardBack']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $insuranceBackPictureName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille de l'image.
    if(in_array($extension, $extensions) && $insuranceBackPictureSize <= $maxSize && $insuranceBackPictureError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $insuranceCardBackPicture = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'insuranceCardBack'.
        move_uploaded_file($insuranceBackPictureTmpName, './public/assets/insuranceCardBack/'.$insuranceCardBackPicture);

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET insurance_card_back = ? WHERE id = ?');
        $result = $req->execute([$insuranceCardBackPicture, $userModifiedId]);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
            exit;
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la carte vitale.');
            exit();
        };
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le fichier doit être au format \'jpg\', \'png\', \'jpeg\', \'webp\'.');
        exit();
    };
};

// Vérification du formulaire de modification du numéro de carte vitale.
if(
    !empty($_POST['socialSecurityNumber']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $socialSecurityNumber = htmlspecialchars($_POST['socialSecurityNumber']);
    $userId               = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET social_security_number = ? WHERE id = ?');
    $result = $req->execute([$socialSecurityNumber, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le numéro de carte vitale.');
        exit();
    };
}

// Vérification du formulaire de modification du prénom.
if(
    !empty($_POST['modifyName']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyName = htmlspecialchars($_POST['modifyName']);
    $userId     = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET name = ? WHERE id = ?');
    $result = $req->execute([$modifyName, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {    
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le prénom.');
        exit();
    };
};

// Vérification du formulaire de modification de la photo de profil.
if(
    isset($_FILES['profilePicture']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image de profil.
    $req = $bdd->prepare("SELECT profile_picture FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $profileImg = $req->fetchColumn();
    unlink('./public/assets/usersImg/'.$profileImg);

    // Images de la photo de profil.
    $profilePictureName    = $_FILES['profilePicture']['name'];
    $profilePictureTmpName = $_FILES['profilePicture']['tmp_name'];
    $profilePictureSize    = $_FILES['profilePicture']['size'];
    $profilePictureError   = $_FILES['profilePicture']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $profilePictureName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille de l'image de profil.
    if(in_array($extension, $extensions) && $profilePictureSize <= $maxSize && $profilePictureError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $profilePicture = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'usersImg'.
        move_uploaded_file($profilePictureTmpName, './public/assets/usersImg/'.$profilePicture);

        // Ajout de l'image avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET profile_picture = ? WHERE id = ?');
        $result = $req->execute([$profilePicture, $userModifiedId]);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
            exit;
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier la photo de profil.');
            exit();
        };
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le fichier doit être au format \'jpg\', \'png\', \'jpeg\' ou \'webp\'.');
        exit();
    };
};

// Vérification du formulaire de modification du nom de famille.
if(
    !empty($_POST['modifySurname']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifySurname = htmlspecialchars($_POST['modifySurname']);
    $userId     = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET surname = ? WHERE id = ?');
    $result = $req->execute([$modifySurname, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {    
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le nom de famille.');
        exit();
    };
};

// Vérification du formulaire de modification du numéro de téléphone.
if(
    !empty($_POST['modifyPhone']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyPhone = htmlspecialchars($_POST['modifyPhone']);
    $userId     = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET phone_number = ? WHERE id = ?');
    $result = $req->execute([$modifyPhone, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {    
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le numéro de téléphone.');
        exit();
    };
};

// Vérification du formulaire de modification du code postal.
if(
    !empty($_POST['currentZipCode']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $currentZipCode = htmlspecialchars($_POST['currentZipCode']);
    $userId         = $_SESSION['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user SET current_zip_code = ? WHERE id = ?');
    $result = $req->execute([$currentZipCode, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
        exit();
    } else {    
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le code postal.');
        exit();
    };
};


// Vérification du formulaire de modification du CV.
if(
    isset($_FILES['userCV']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image de profil.
    $req = $bdd->prepare("SELECT curriculum_vitae FROM `user` WHERE id = ?");
    $req->execute([$userId]);
    $cvImg = $req->fetchColumn();
    unlink('./public/assets/curriculumVitae/'.$cvImg);

    // Images du CV.
    $userCVName    = $_FILES['userCV']['name'];
    $userCVTmpName = $_FILES['userCV']['tmp_name'];
    $userCVSize    = $_FILES['userCV']['size'];
    $userCVError   = $_FILES['userCV']['error'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $userCVName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    //Tableau des extensions que l'on accepte pour les images.
    $extensions = ['jpg', 'png', 'jpeg', 'webp', 'pdf', 'doc', 'docx', 'odt', 'txt', 'rtf'];
    //Taille max que l'on accepte pour les images.
    $maxSize = 50000000;

    // Vérification de l'extension et de la taille du document.
    if(in_array($extension, $extensions) && $userCVSize <= $maxSize && $userCVError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $cvImg = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'usersImg'.
        move_uploaded_file($userCVTmpName, './public/assets/curriculumVitae/'.$cvImg);

        // Ajout de l'image avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET curriculum_vitae = ? WHERE id = ?');
        $result = $req->execute([$cvImg, $userModifiedId]);

        // Redirection avec message de validation.
        if($result) {
            header('location: index.php?page=dashboard&modification=1&action=generalInfosButton');
            exit;
        } else {
            header('location: index.php?page=dashboard&errorMod=1&messageMod=Impossible de modifier le CV.');
            exit();
        };
    } else {
        header('location: index.php?page=dashboard&errorMod=1&messageMod=Le fichier doit être au format \'jpg\', \'png\', \'jpeg\', \'webp\', \'pdf\', \'doc\', \'docx\', \'odt\', \'txt\' ou \'rtf\'.');
        exit();
    };
};

?>