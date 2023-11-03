<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="./src/design/reset.css">
    <link rel="stylesheet" href="./src/design/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="shortcut icon" href="./public/assets/favicon.ico" type="image/x-icon">
    <title><?= $title ?> | Intranet SDP</title>
</head>

<body class="container" id="output">

    <header class="text-center">
        <a href="<?php ($_SESSION) ? 'index.php?page=home' : 'index.php?page=dashboard' ?>">
            <img class="w-25 my-4" src="./public/assets/logo.webp" alt="Logo Studio Des Parfums">
        </a>
    </header>


    <!-- Message de validation de la connexion utilisateur. -->
    <?php
    if (isset($_GET['error']) && !empty($_GET['message'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-danger">' . htmlspecialchars($_GET['message']) . '</p></div>';
    }

    if (isset($_GET['newUser'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-success">Nouveau collaborateur enregistré avec succès.</p></div>';
    } else if (isset($_GET['errorAddnew']) && !empty($_GET['messageAddNew'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-danger">' . htmlspecialchars($_GET['messageAddNew']) . '</p></div>';
    }

    if (isset($_GET['holidayResponse'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-success">Réponse enregistrée avec succès.</p></div>';
    }

    if (isset($_GET['modification'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-success">Modification réalisée avec succès.</p></div>';
    } else if (isset($_GET['errorMod']) && !empty($_GET['messageMod'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-danger">' . htmlspecialchars($_GET['messageMod']) . '</p></div>';
    }

    if (isset($_GET['removal'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-success">Information supprimée avec succès.</p></div>';
    }

    if (isset($_GET['dayOffResponse'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-success">Réponse à la demande de repos enregistrée avec succès.</p></div>';
    }

    if (isset($_GET['timeBankModification'])) {
        echo '<div class=\'container\'><p class="mt-3 fw-bold text-success">Compte de temps ajusté avec succès.</p></div>';
    }

    if (isset($_GET['logout'])) {
        echo '<p class="mt-4 fw-bold text-success">Vous êtes maintenant déconnecté !</p>';
    }
    ?>

    <!-- Lien de retour en haut de page. -->
    <a class="rounded-circle d-flex justify-content-center shadow-sm" href="#" style="
                position: fixed;
                width: 3vw;
                height: 5vh;
                bottom: 70px;
                right: 30px;">
        <img src="./public/assets/arrow_up.svg" alt="Retour haut de page">
    </a>

    <!-- Contenu de la page. -->
    <main>
        <?= $content ?>
    </main>

    <!-- Switch mode sombre -->
    <label class="switch m-4">
        <input type="checkbox" id="darkModeSwitch">
        <span class="slider round"></span>
    </label>

    <footer>


        <!-- Condition de connexion pour permettre une déconnexion. -->
        <?php
        if ($_SESSION) {
        ?>

            <!-- Bouton de déconnexion. -->
            <div class="container my-4 d-flex justify-content-end">
                <button type="button" href="" class="btn btn-danger m-2">
                    <a class="text-decoration-none text-white p-2" href="index.php?page=logout">Déconnexion</a>
                </button>
            </div>

        <?php
        }
        ?>

    </footer>

</body>

</html>