<?php 

// En-têtes de sécurité HTTP
// header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
// header("Content-Security-Policy: default-src 'self'");
// header('X-Frame-Options: SAMEORIGIN');
// header('X-Content-Type-Options: nosniff');
// header('Referrer-Policy: no-referrer');
// header('Permissions-Policy: none');
// header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self';");


    // Traitement.
    session_start();

    // Intégration des connexions.
    require('./model/connectionDBModel.php');
    require('./model/connectionUserModel.php');

    // Routeur.
    require('./controller/controller.php');

    // Direction de l'utilisateur en fonction de la requête.
    try{
        if(isset($_GET['page']) && isset($_SESSION['id'])) {

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