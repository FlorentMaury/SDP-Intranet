<?php

// Vérification du formulaire d'ajout des véhicules.
if(
    isset($_FILES['profilePicture']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Sélection de l'ID.
    $userId = $_SESSION['id'];
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

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
    $extensions = ['jpg', 'png', 'jpeg'];
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
        $req = $bdd->prepare('UPDATE marital_status SET profile_picture = ? WHERE id = ?');
        $req->execute([$profilePicture, $userModifiedId]);
        // Redirection avec message de validation.
        header('location: index.php?page=dashboard');

    } else {
        header('location: index.php?page=dashboard');
    };
};

?>