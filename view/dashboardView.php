<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

?>

<h1><?= $_SESSION['id']; ?></h1>

<h1 class="text-center my-5">Tableau de bord de <?= $_SESSION['name'] ?> <?= $_SESSION['surname'] ?></h1>

<?php

    if($_SESSION['id'] == 1) {
?>

<div class="border rounded p-3">
    <img 
        id="arrow1"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Image de suppression"
    >
    <h2>Liste des collaborateurs</h2>

    <div id="employeesList">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Prénom</th>
                    <th>Nom</th>
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

</div>

<div class="border rounded p-3 my-3">
    <img 
        id="arrow2"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Image de suppression"
    >
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
    <img 
        id="arrow3"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Image de suppression"
    >
    <h2>Informations personnelles</h2>

        <p>Email : <?= $_SESSION['email'] ?></p>
        <p>Prénom : <?= $_SESSION['name'] ?>
            <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyNameInfo">Modifier le prénom</a>
            </button>
        </p>
        <p>Nom de famille : <?= $_SESSION['surname'] ?>
            <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySurnameInfo">Modifier le nom</a>
            </button>
        </p>
        <p>Date de naissance : <?= $_SESSION['birth_date'] ?>
            <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyBirthInfo">Modifier la date de naissance</a>
            </button>
        </p>
        <p>Numéro de téléphone : 0<?= $_SESSION['phone_number'] ?></p>
        <p>Date d'inscription : <?= $_SESSION['creation_date'] ?></p>
        <p>Numéro de carte vitale : <?php if(empty($_SESSION['social_security_number'])) {echo 'A completer';} else { echo $_SESSION['social_security_number'];} ?></p>
        <p>Numéro de carte d'identité : <?php if(empty($_SESSION['id_number'])) {echo 'A completer';} else { echo $_SESSION['id_number'];} ?></p>

</div>

<!-- Modale de modification du Prénom. -->
<div class="modal fade" id="modifyNameInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le prénom</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="modifyName" class="form-control" id="modifyName" placeholder="<?= $_SESSION['name'] ?>">
                    <label for="modifyName">Prénom</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du Nom. -->
<div class="modal fade" id="modifySurnameInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le nom</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="modifySurname" class="form-control" id="modifySurname" placeholder="<?= $_SESSION['surname'] ?>">
                    <label for="modifySurname">Nom</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la date de naissance. -->
<div class="modal fade" id="modifyBirthInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier la date de naissance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="modifyBirth" class="form-control" id="modifyBirth" placeholder="<?= $_SESSION['birth_date'] ?>">
                    <label for="modifyBirth">Date de naissance</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>
</div>

<?php 

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>