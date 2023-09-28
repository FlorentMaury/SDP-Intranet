<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

?>

<h1>Tableau De Bord</h1>

<div class="border rounded p-3">


    
    <?php
        require('./model/connectionUserModel.php');
        while($user = $users->fetch()) {
    ?>
        <p><?= $_SESSION['email'] ?></p>
        <p><?= $_SESSION['password'] ?></p>
        <p><?= $_SESSION['name'] ?></p>
        <p><?= $_SESSION['surname'] ?></p>
        <p><?= $_SESSION['birth_date'] ?></p>
        <p><?= $_SESSION['phone_number'] ?></p>
        <p><?= $_SESSION['creation_date'] ?></p>
    <?php
        }
    ?>
</div>

<?php 

// Fin de l'enregistrement du HTML.
$content = ob_get_clean();

// Intégration à base.php.
require('base.php');

?>