<?php

    // Connexion à la base de donnée : "garage_parrot".
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=intranet_sdp;charset=utf8', 'root', '');
    } catch(Exception $e) {
        die('Erreur : ' .$e->getMessage());
    };

    $users = $bdd->query('SELECT * FROM user ORDER BY surname');

    // Accorder les privilèges EVENT et TRIGGER à l'utilisateur 'user' sur la base de données 'intranet_sdp'
    $bdd->query("GRANT EVENT, TRIGGER ON intranet_sdp.* TO '%'@'localhost';");

    $query = "CREATE EVENT resetUserTimeBank
    ON SCHEDULE EVERY 1 MONTH
    STARTS '2023-10-14 00:00:0'
    DO
    UPDATE user SET user_extra_time = 0, user_delay = 0, user_absence = 0;";
    
// $bdd->query($query);

?>