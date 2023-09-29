<?php

// Vérification du formulaire de modification du planning.
if(
    !empty($_POST['modifyName']) && 
    !empty($_POST['modifySurname']) && 
    !empty($_POST['modifyBirth']) && 
    !empty($_POST['modifySex']) && 
    !empty($_POST['modifyPhone']) && 
    isset($_FILES['modifyIdImg']) &&
    isset($_FILES['modifyInsuranceFace']) &&
    isset($_FILES['modifyInsuranceBack']) &&
    isset($_FILES['modifyIdFace']) &&
    isset($_FILES['modifyIdBack']) 
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyName    = htmlspecialchars($_POST['modifyName']);
    $modifySurname = htmlspecialchars($_POST['modifySurname']);
    $modifyBirth   = htmlspecialchars($_POST['modifyBirth']);
    $modifySex     = htmlspecialchars($_POST['modifySex']);
    $modifyPhone   = htmlspecialchars($_POST['modifyPhone']);
    $imgName       = $_FILES['modifyIdImg']['name'];
    $imgTmpName    = $_FILES['modifyIdImg']['tmp_name'];
    $imgSize       = $_FILES['modifyIdImg']['size'];
    $imgError      = $_FILES['modifyIdImg']['error'];
    $userId        = $_SESSION['id'];

    // Récupérer l'extension des images.
    $tabExtension = explode('.', $imgName);

    // Mise en minuscule de cette extendion.
    $extension = strtolower(end($tabExtension));

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `marital_status` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    //Tableau des extensions acceptée pour les images.
    $extensions = ['jpg', 'png', 'jpeg'];
    //Taille max acceptée.
    $maxSize = 50000000;

     // Vérification de l'extension et de la taille de l'image de profil.
     if(in_array($extension, $extensions) && $imgSize <= $maxSize && $imgError == 0){
        $uniqId = uniqid('', true);
        // Création d'un uniqid
        $modifyIdImg = $uniqId.".".$extension;
        // Enregistrement de l'image dans le dossier 'usersImg'.
        move_uploaded_file($imgTmpName, './public/assets/usersImg/'.$modifyIdImg);

        // Modification des modifications dans la base de données.
        $req = $bdd->prepare('UPDATE marital_status SET name = ?, surname = ?, birth_date = ?, sex = ? , phone_number = ?, profile_picture WHERE id = ?');
        $req->execute([$modifyName, $modifySurname, $modifyBirth, $modifySex, $modifyPhone, $modifyIdImg, $userModifiedId]);

        // Redirection.
        header('location: index.php?page=dashboard');
        exit();
     } 
 } 

?>