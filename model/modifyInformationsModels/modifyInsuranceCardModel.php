<?php

// Vérification du formulaire d'ajout des véhicules.
if(
    isset($_FILES['insuranceCardFace']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

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
        $req = $bdd->prepare('UPDATE marital_status SET insurance_card_face = ? WHERE id = ?');
        $req->execute([$insuranceCardFacePicture, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
    };
};

?>