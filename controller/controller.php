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
            require('model/modifyInformationsModels/modifyBirthCityModel.php');
            require('model/modifyInformationsModels/modifyBirthCountryModel.php');
            require('model/modifyInformationsModels/modifyCurrentStreetNumberModel.php');
            require('model/modifyInformationsModels/modifyCurrentStreetName.php');
            require('model/modifyInformationsModels/modifyCurrentCity.php');
            require('model/modifyInformationsModels/modifyZipCode.php');
            require('model/modifyInformationsModels/modifyCurrentCountry.php');

            // Images.
            require('model/modifyInformationsModels/modifyProfilePictureModel.php');

        require('view/dashboardView.php');
    };

    // Dans la page employée.
    function user() {
        require('model/connectionDBModel.php');
        require('view/getUserInfosView.php');
    };

    // Dans la fonction de déconnexion.
    function logOut() {
        require('model/logoutModel.php');
    };

?>