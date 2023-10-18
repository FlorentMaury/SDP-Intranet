<?php

    // Connexion à la base de donnée : "garage_parrot".
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=intranet_sdp;charset=utf8', 'root', '');
    } catch(Exception $e) {
        die('Erreur : ' .$e->getMessage());
    };

    $users         = $bdd->query('SELECT * FROM user ORDER BY surname');
    $usersInvalid  = $bdd->query('SELECT * FROM user WHERE active = 0');
    $usersValid    = $bdd->query('SELECT * FROM user WHERE active = 1');
    $usersHoliday1 = $bdd->query('SELECT * FROM user WHERE holiday1_response = 0');
    $usersHoliday2 = $bdd->query('SELECT * FROM user WHERE holiday2_response = 0');
    $usersHoliday3 = $bdd->query('SELECT * FROM user WHERE holiday3_response = 0');

    // Accorder les privilèges EVENT et TRIGGER à l'utilisateur 'user' sur la base de données 'intranet_sdp'
    // $bdd->query("GRANT EVENT, TRIGGER ON intranet_sdp.* TO '%'@'localhost';");

    // $query = "CREATE EVENT resetUserTimeBank
    // ON SCHEDULE EVERY 1 DAY
    // STARTS '2023-10-13 00:00:0'
    // DO
    // UPDATE user SET user_extra_time = 0, user_delay = 0, user_absence = 0;";
    
    // $bdd->query($query);

?>