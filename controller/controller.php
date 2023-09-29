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
            require('model/modifyInformationsModels/modifyNameModel.php');
            require('model/modifyInformationsModels/modifySurnameModel.php');
            require('model/modifyInformationsModels/modifyBirthModel.php');
            require('model/modifyInformationsModels/modifyNumberModel.php');
            require('model/modifyInformationsModels/modifyInsuranceNumberModel.php');
            require('model/modifyInformationsModels/modifyIdNumberModel.php');

        require('view/dashboardView.php');
    };

    // Dans la fonction de déconnexion.
    function logOut() {
        require('model/logoutModel.php');
    };

?>