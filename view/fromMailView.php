<?php

    // Modification du titre de la page.
    $title = 'Réponse à la demande';
    // Début d'enregistrement du HTML.
    ob_start();

?>

    <h1 class="display-6 text-center">Réponse à la demande</h1>

    <?php
        if($_SESSION) {
    ?>
            <a href="index.php?page=dashboard" class="btn btn-dark">Accéder au tableau de bord</a>
    <?php
        } else {
    ?>
            <a href="index.php" class="btn btn-dark">Se connecter</a>
    <?php
        };
    ?>

<?php 

// Fin de l'enregistrement du HTML.
$content = ob_get_clean();

// Intégration à base.php.
require('base.php');

?>