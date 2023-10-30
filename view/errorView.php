<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

?>

    <h1 class="display-6 text-center">Une erreur est survenue</h1>

    <button class="btn btn-dark">
        <a href="index.php" class="text-decoration-none text-light">Retour à la page de connexion</a>
    </button>

<?php 

// Fin de l'enregistrement du HTML.
$content = ob_get_clean();

// Intégration à base.php.
require('base.php');

?>