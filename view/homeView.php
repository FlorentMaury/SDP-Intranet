<?php

// Modification du titre de la page.
$title = 'Accueil';
// Début d'enregistrement du HTML.
ob_start();

// Script pour réinitialiser les données
// $sql = file_get_contents('../src/resetSQL/reset_weekly.sql');
// $conn->query($sql);

?>

<div class="d-flex justify-content-center connection">
    <form class="w-75 text-center" method="POST" action="index.php?page=dashboard" style="max-width: 600px;">
        <p class="form-floating m-2">
            <input type="email" name="email" class="form-control" id="email">
            <label for="email">Email</label>
        </p>

        <p class="form-floating m-2">
            <input type="password" name="password" class="form-control" id="password">
            <label for="password">Mot de passe</label>
        </p>

        <!-- Champs cachés pour les variables $_GET -->
        <input type="hidden" name="user" value="<?php echo isset($_GET['user']) ? htmlspecialchars($_GET['user'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        <input type="hidden" name="hid" value="<?php echo isset($_GET['hid']) ? htmlspecialchars($_GET['hid'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        <input type="hidden" name="action" value="<?php echo isset($_GET['action']) ? htmlspecialchars($_GET['action'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        <input type="hidden" name="holidayResponseMail" value="<?php echo isset($_GET['holidayResponseMail']) ? htmlspecialchars($_GET['holidayResponseMail'], ENT_QUOTES, 'UTF-8') : ''; ?>">

        <button class="btn btn-lg btn-dark" type="submit">Connexion</button>
    </form>
</div>


<?php
if ($_SESSION) {
?>

    <div class="container my-4 d-flex">
        <button type="button" href="" class="btn btn-dark me-2">
            <a class="text-decoration-none text-white p-2" href="index.php?page=dashboard">Tableau de bord</a>
        </button>
    </div>

<?php
}
?>

<?php

// Fin de l'enregistrement du HTML.
$content = ob_get_clean();

// Intégration à base.php.
require('base.php');

?>