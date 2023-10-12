<?php

    // Gestion des contenus dans chacunes des pages.
    
    // Dans la page d'accueil.
    function home() {
        require('model/connectionDBModel.php');
        require('view/homeView.php');
    };

    // Dans le tableau de bord, pour les employés.
    function dashboard() {
        require('model/connectionDBModel.php');
        require('model/addNewUserModel.php');

            // Modifications des informations utilisateurs.
            require('model/modifyInformationsModels/modifyUserInformationsModel.php');
            require('model/modifyInformationsModels/modifySchoolModel.php');
            require('model/modifyInformationsModels/modifyJobModel.php');
            require('model/modifyInformationsModels/modifyTimeAccountModel.php');

        require('view/dashboardView.php');
        require('view/modalsView.php');
    };

    // Dans la page employée.
    function user() {
        require('model/connectionDBModel.php');
        require('model/modifyInformationsModels/modifyUserContractModel.php');
        require('view/getUserInfosView.php');
        require('view/modalsView.php');
    };

    // Dans la fonction de déconnexion.
    function logOut() {
        require('model/logoutModel.php');
    };

?>