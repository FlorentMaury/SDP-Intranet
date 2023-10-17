<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

?>

    <h1 class="display-6 text-center">Une erreur est survenue</h1>

<?php 

// Fin de l'enregistrement du HTML.
$content = ob_get_clean();

// Intégration à base.php.
require('base.php');

?>