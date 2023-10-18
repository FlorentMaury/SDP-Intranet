<?php

    // Fonction qui permet l'acceptation d'une demande de CA.
    if(
        !empty($_POST['holiday1Request'])
    ) {

   // Connexion à la base de données.
   require('./model/connectionDBModel.php');

   // Variables.
   $holiday1Request = htmlspecialchars($_POST['holiday1Request']);
   $userId          = $_GET['id'];

   // Sélection de l'ID.
   $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
   $r->execute([$userId]);
   $userModifiedId = $r->fetchColumn();

   // Modification des modifications dans la base de données.
   $req = $bdd->prepare('UPDATE user SET holiday1_response = ? WHERE id = ?');
   $req->execute([$holiday1Request, $userModifiedId]);

   // Redirection.
   header('location: index.php?page=dashboard');
   exit();

}

?>