<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

?>

<h1 class="text-center">Tableau de bord de <?= $_SESSION['name'] ?> <?= $_SESSION['surname'] ?></h1>

<?php

    if($_SESSION['id'] == 1) {
?>

<div class="border rounded p-3">
    <h2>Liste des collaborateurs</h2>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Supprimer</th>
            </thead>
            <tbody>
                <?php
                    require('./model/connectionDBModel.php');
                    while($user = $users->fetch()) {
                ?>
                <tr>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['surname'] ?></td>
                    <td>
                        <a 
                        href='./model/deleteUserModel.php?id=<?=$user["id"]?>' 
                        type="button" 
                        class="btn btn-danger">
                            <img 
                                style="width: 15px" 
                                src="./public/assets/cross.svg" 
                                alt="Image de suppression"
                            >
                        </a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

</div>

<div class="border rounded p-3 my-3">
    <h2>Nouveau collaborateur</h2>

    <!-- Formulaire d'enregistrement d'un nouvel employé. -->
    <form class="d-flex flex-column" method="POST" action="index.php?page=dashboard">

        <!-- Formulaire. -->
        <p class="form-floating m-2">
            <input type="text" name="surname" class="form-control" id="surname" placeholder="Nom de famille">
            <label for="surname">Nom de famille</label>
        </p>
        <p class="form-floating m-2">
            <input type="text" name="name" class="form-control" id="name" placeholder="Prénom">
            <label for="name">Prénom</label>
        </p>
        <p class="form-floating m-2">
            <input type="email" name="email" class="form-control" id="email" placeholder="dupont@email.com">
            <label for="email">Email</label>
        </p>
        <p class="form-floating m-2">
            <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe">
            <label for="password">Mot de passe</label>
        </p>
        <p class="form-floating m-2">
            <input type="password" name="passwordTwo" class="form-control" id="passwordTwo" placeholder="Confirmez votre mot de passe">
            <label for="passwordTwo">Confirmez le mot de passe</label>
        </p>
        
        <button class="btn btn-md btn-dark mt-4 p-2 align-self-end" type="submit">Enregister</button>

    </form>
</div>

<?php
    }
?>

<div class="border rounded p-3">
    <h2>Informations personnelles</h2>

        <p><?= $_SESSION['email'] ?></p>
        <p><?= $_SESSION['name'] ?></p>
        <p><?= $_SESSION['surname'] ?></p>
        <p><?= $_SESSION['birth_date'] ?></p>
        <p><?= $_SESSION['sex'] ?></p>
        <p><?= $_SESSION['phone_number'] ?></p>
        <p><?= $_SESSION['creation_date'] ?></p>

</div>

<?php 

// Fin de l'enregistrement du HTML.
$content = ob_get_clean();

// Intégration à base.php.
require('base.php');

?>