<?php

// Connexion à la base de donnée : "intranet_SDP".
try {
        $bdd = new PDO('mysql:host=localhost;dbname=intranet_sdp;charset=utf8', 'root', '');
} catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
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
        ORDER BY surname
        ');
$usersValid = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
        WHERE active = 1
        ORDER BY surname
        ');
$usersDayOff = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
        INNER JOIN user_day_off ON user.id = user_day_off.user_day_off_id
        WHERE day_off_response = 0
        ');
$usersHoliday = $bdd->query('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
        INNER JOIN user_holiday ON user.id = user_holiday.user_holiday_id
        WHERE holiday_response = 0
        ');

// Accorder les privilèges EVENT et TRIGGER à l'utilisateur 'user' sur la base de données 'intranet_sdp'
// $bdd->query("GRANT EVENT, TRIGGER ON intranet_sdp.* TO '%'@'localhost';");

// $query = "CREATE EVENT resetUserTimeBank
// ON SCHEDULE EVERY 1 DAY
// STARTS '2023-10-13 00:00:0'
// DO
// UPDATE user SET user_extra_time = 0, user_delay = 0, user_absence = 0;";

// $bdd->query($query);
