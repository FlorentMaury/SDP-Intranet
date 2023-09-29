<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
        crossorigin="anonymous"
    >
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
        crossorigin="anonymous">
    </script>
    <title><?= $title ?> | Intranet SDP</title>
</head>

<body class="container" id="output">

    <header class="text-center">
        <a href="index.php?page=home">
            <img style="width: 30vh; height: 13vh; margin: 2% 0" src="./public/assets/logo.webp" alt="Logo Studio Des Parfums">
        </a>
    </header>  

    <main>
        <?= $content ?>
    </main>

    <footer>

        <?php
            if($_SESSION) {
        ?>

        <!-- Bouton de déconnexion. -->
        <div class="container my-4 d-flex justify-content-end">
            <button type="button" href="" class="btn btn-dark m-2">
                <a class="text-decoration-none text-white p-2" href="index.php?page=logout">Déconnexion</a>
            </button>
        </div>

        <?php
            }
        ?>  

    </footer>

    <script src="../src/script.js"></script>
</body>
</html>