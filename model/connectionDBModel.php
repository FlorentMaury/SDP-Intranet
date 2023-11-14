<?php

    // Connexion à la base de donnée : "intranet_SDP".
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=intranet_sdp;charset=utf8', 'root', '');
    } catch(Exception $e) {
        die('Erreur : ' .$e->getMessage());
    };

    // Récupération des données de la table 'user'.
    // Création des différentes variables necessaires.
    $users = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
        WHERE active = 0
        ORDER BY surname
        ');
    $usersInvalid = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
        WHERE active = 0
        ');
    $usersValid = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
        WHERE active = 1
        ');
    $usersHoliday1 = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
         WHERE holiday1_response = 0
         ');
    $usersHoliday2 = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
         WHERE holiday2_response = 0
         ');
    $usersHoliday3 = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
         WHERE holiday3_response = 0
         ');
    $usersDayOff1  = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
         WHERE day_off_response1 = 0
         ');
    $usersDayOff2  = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
         WHERE day_off_response2 = 0
         ');
    $usersDayOff3  = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
         WHERE day_off_response3 = 0
         ');

    // Accorder les privilèges EVENT et TRIGGER à l'utilisateur 'user' sur la base de données 'intranet_sdp'
    // $bdd->query("GRANT EVENT, TRIGGER ON intranet_sdp.* TO '%'@'localhost';");

    // $query = "CREATE EVENT resetUserTimeBank
    // ON SCHEDULE EVERY 1 DAY
    // STARTS '2023-10-13 00:00:0'
    // DO
    // UPDATE user SET user_extra_time = 0, user_delay = 0, user_absence = 0;";
    
    // $bdd->query($query);
?>