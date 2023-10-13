<?php

    // Connexion à la base de donnée : "garage_parrot".
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=intranet_sdp;charset=utf8', 'root', '');
    } catch(Exception $e) {
        die('Erreur : ' .$e->getMessage());
    };

    $users = $bdd->query('SELECT * FROM user');

    $resetA = $bdd('UPDATE user SET user_absence = 0 WHERE DAYOFMONTH(NOW()) = ?;');
    $resetA->execute([1]);

    $resetB = $bdd('UPDATE user SET user_delay = 0 WHERE DAYOFMONTH(NOW()) = ?;');
    $resetB->execute([1]);

    $resetC = $bdd('UPDATE user SET user_extra_time = 0 WHERE DAYOFMONTH(NOW()) = ?;');
    $resetC->execute([1]);

?>