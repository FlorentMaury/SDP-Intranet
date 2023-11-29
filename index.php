<?php 

    // Traitement.
    session_start();

    // Intégration des connexions.
    require('./model/connectionDBModel.php');
    require('./model/connectionUserModel.php');

    // Routeur.
    require('./controller/controller.php');

    // Direction de l'utilisateur en fonction de la requête.
    try{
        if(isset($_GET['page'])) {

            // Page d'accueil.
            if($_GET['page'] == 'home') {
                home();
            }
            // tableau de bord.
            else if ($_GET['page'] == 'dashboard') {
                dashboard();
            }
            // Page employé.
            else if ($_GET['page'] == 'user') {
                user();
            }
            // Provenance d'email.
            else if ($_GET['page'] == 'email') {
                email();
            }
            // Deconnexion.
            else if ($_GET['page'] == 'logout') {
                logOut();
            }
            // En cas de demande de page inconnue.
            else {
                throw new Exception("Cette page n'existe pas ou a été supprimée.");
            }

        }
        else {
            // Retour accueil.
            home();
        };
    }

    // En cas d'erreur.
    catch(Exception $e) {
        $error = $e->getMessage();
        require('view/errorView.php');
    };

?>