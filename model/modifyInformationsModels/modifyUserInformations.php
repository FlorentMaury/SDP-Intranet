<?php

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
    $req->execute([$modifyBirthCity, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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
    $req->execute([$modifyBirthCountry, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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
    $req->execute([$modifyBirth, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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
    $req->execute([$currentCity, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

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
    $req->execute([$currentCountry, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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
    $req->execute([$currentStreetName, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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
    $req->execute([$currentStreetNumber, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
} 

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

    // Pour les images du véhicule de face.
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
        $req->execute([$idCardFacePicture, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
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

    // Pour les images du véhicule de face.
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
        $req->execute([$idCardBackPicture, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
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
    $req->execute([$idNumber, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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

    // Pour les images du véhicule de face.
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
        $req->execute([$insuranceCardFacePicture, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
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

    // Pour les images du véhicule de face.
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
        $req->execute([$insuranceCardBackPicture, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
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
    $req->execute([$socialSecurityNumber, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
};

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
    $req->execute([$modifyName, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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

    // Pour les images du véhicule de face.
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

        // Ajout d'un véhicule avec toutes les informations si les images ont étés validées.
        $req = $bdd->prepare('UPDATE user SET profile_picture = ? WHERE id = ?');
        $req->execute([$profilePicture, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
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
    $req->execute([$modifySurname, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
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
    $req->execute([$currentZipCode, $userModifiedId]);

    // Redirection.
    header('location: index.php?page=dashboard');
    exit();
};

?>