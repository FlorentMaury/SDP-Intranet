<?php

// Vérification du formulaire de modification du type de contrat.
if(
    !empty($_POST['userContract'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContract = htmlspecialchars($_POST['userContract']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_type = ? WHERE user_role_id  = ?');
    $result = $req->execute([$modifyUserContract, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier le type de ce contrat.');
        exit();
    };
};


// Vérification du formulaire de modification du début de contrat.
if(
    !empty($_POST['userContractStart'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContractStart = htmlspecialchars($_POST['userContractStart']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_start = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyUserContractStart, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier le début de ce contrat.');
        exit();
    };
};


// Vérification du formulaire de modification de fin de contrat.
if(
    !empty($_POST['userContractEnd'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContractEnd = htmlspecialchars($_POST['userContractEnd']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_end = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyUserContractEnd, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier la fin de ce contrat.');
        exit();
    };
};


// Vérification du formulaire de modification de niveau du contrat.
if(
    !empty($_POST['userContractLevel'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContractLevel = htmlspecialchars($_POST['userContractLevel']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_level = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyUserContractLevel, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier le niveau de ce contrat.');
        exit();
    };
};


// Vérification du formulaire de modification du coefficient du contrat.
if(
    !empty($_POST['userContractCoef'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContractCoef = htmlspecialchars($_POST['userContractCoef']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_coef = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyUserContractCoef, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier le coefficient de ce contrat.');
        exit();
    };
};

// Vérification du formulaire de modification de rémunération du contrat.
if(
    !empty($_POST['userContractRemuneration'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContractRemuneration = htmlspecialchars($_POST['userContractRemuneration']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_remuneration = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyUserContractRemuneration, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier la rémunération de ce contrat.');
        exit();
    };
};


// Vérification du formulaire de modification de la mutuelle du contrat.
if(
    !empty($_POST['userContractInsurance'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContractInsurance = htmlspecialchars($_POST['userContractInsurance']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_insurance = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyUserContractInsurance, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier la mutuelle de ce contrat.');
        exit();
    };
};


// Vérification du formulaire de modification du numéro de la mutuelle du contrat.
if(
    !empty($_POST['userContractInsuranceNumber'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContractInsuranceNumber = htmlspecialchars($_POST['userContractInsuranceNumber']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_insurance_number = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyUserContractInsuranceNumber, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier le numéro de la mutuelle de ce contrat.');
        exit();
    };
};


// Vérification du formulaire de modification des heures hebdomadaires du contrat.
if(
    !empty($_POST['userContractWeekly'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyUserContractWeekly = htmlspecialchars($_POST['userContractWeekly']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET contract_weekly = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyUserContractWeekly, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier les heures hebdomadaires de ce contrat.');
        exit();
    };
};

// Vérification du formulaire de modification de la date de la visite médicale.
if(
    !empty($_POST['modifyWorkMedicine'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyWorkMedicine = htmlspecialchars($_POST['modifyWorkMedicine']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_role SET work_medicine = ? WHERE user_role_id = ?');
    $result = $req->execute([$modifyWorkMedicine, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=userContractButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier la date de la visite médicale.');
        exit();
    };
};

// Vérification du formulaire de modification de la carte Navigo.
if(
    !empty($_POST['userContractTransports'])
    ) {

    // Connexion à la base de données.
    require('./model/connectionDBModel.php');

    // Variables.
    $modifyContractTransports = htmlspecialchars($_POST['userContractTransports']);
    $userId = $_GET['id'];

    // Sélection de l'ID.
    $r = $bdd->prepare("SELECT id FROM `user` WHERE id = ?");
    $r->execute([$userId]);
    $userModifiedId = $r->fetchColumn();

    // Modification des modifications dans la base de données.
    $req = $bdd->prepare('UPDATE user_time_bank SET contract_transports = ? WHERE user_time_bank_id = ?');
    $result = $req->execute([$modifyContractTransports, $userModifiedId]);

    // Redirection.
    if($result) {
        header('location: index.php?page=user&id=' . $userModifiedId .'&modification=1&action=timeBankButton');
        exit();
    } else {
        header('location: index.php?page=user&errorMod=1&messageMod=Impossible de modifier la carte Navigo de ce contrat.');
        exit();
    };
};

?>