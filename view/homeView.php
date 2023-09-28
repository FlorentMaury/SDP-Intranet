<?php

    // Modification du titre de la page.
    $title = 'Accueil';
    // Début d'enregistrement du HTML.
    ob_start();

?>

    <form class="text-center" method="POST" action="index.php?page=home">

        <p class="form-floating m-2">
            <input type="email" name="email" class="form-control" id="email">
            <label for="email">Email</label>
        </p>
        
        <p class="form-floating m-2">
            <input type="password" name="password" class="form-control" id="password">
            <label for="password">Mot de passe</label>
        </p>

        <button class="w-50 btn btn-lg btn-dark" type="submit">Connexion</button>

    </form>

    <div class="container my-4 d-flex">
        <button type="button" href="" class="btn btn-dark me-2">
            <a class="text-decoration-none text-white p-2" href="index.php?page=dashboard">Tableau de bord</a>
        </button>
    </div>

<?php 

// Fin de l'enregistrement du HTML.
$content = ob_get_clean();

// Intégration à base.php.
require('base.php');

?>