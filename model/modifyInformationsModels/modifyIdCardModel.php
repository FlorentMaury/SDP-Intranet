<?php

// Vérification du formulaire d'ajout ou de modification de la carte d'identité de face.
if(
    isset($_FILES['idCardFace']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image.
    $req = $bdd->prepare("SELECT id_card_face FROM `marital_status` WHERE id = ?");
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
        $req = $bdd->prepare('UPDATE marital_status SET id_card_face = ? WHERE id = ?');
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
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Suppression de l'ancienne image.
    $req = $bdd->prepare("SELECT id_card_back FROM `marital_status` WHERE id = ?");
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
        $req = $bdd->prepare('UPDATE marital_status SET id_card_back = ? WHERE id = ?');
        $req->execute([$idCardBackPicture, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
    };
};

?>