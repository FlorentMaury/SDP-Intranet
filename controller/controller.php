<?php

    // Gestion des contenus dans chacunes des pages.
    
    // Dans la page d'accueil.
    function home() {
        require_once('model/connectionDBModel.php');
        require_once('view/homeView.php');
    };

    // Dans les tableaux de bord.
    function dashboard() {
        require_once('model/connectionDBModel.php');
        require_once('model/addNewUserModel.php');

            // Modifications des informations utilisateurs.
            require_once('model/modifyInformationsModels/modifyUserInformationsModel.php');
            require_once('model/modifyInformationsModels/modifySchoolModel.php');
            require_once('model/modifyInformationsModels/modifyJobModel.php');
            require_once('model/modifyInformationsModels/modifyTimeAccountModel.php');
            require_once('model/modifyInformationsModels/modifyHolidayRequestModel.php');
            require_once('model/modifyInformationsModels/modifyHolidayRequestFromMail.php');

        require_once('view/dashboardView.php');
        require_once('view/modalsView.php');
    };

    // Dans la page employée.
    function user() {
        require_once('model/connectionDBModel.php');
        require_once('model/modifyInformationsModels/modifyUserContractModel.php');
        require_once('view/getUserInfosView.php');
        require_once('view/modalsView.php');
        require_once('model/modifyInformationsModels/modifyHolidayRequestFromMail.php');
    };

    // Dans la fonction de déconnexion.
    function logOut() {
        require_once('model/logoutModel.php');
    };

    // En provenance d'email.
    function email() {
        require_once('model/connectionDBModel.php');
        require_once('model/modifyInformationsModels/modifyHolidayRequestFromMail.php');
        require_once('view/fromMailView.php');
    };

?>