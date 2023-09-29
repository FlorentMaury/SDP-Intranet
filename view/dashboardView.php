<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

    include "./modalsView.php";

?>

<h1><?= $_SESSION['id']; ?></h1>

<h1 class="text-center my-5">Tableau de bord de <?= $_SESSION['name'] ?> <?= $_SESSION['surname'] ?></h1>

<?php

    if($_SESSION['id'] == 1) {
?>

<div class="border rounded p-3">
    <img 
        id="arrowUp1"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Fléche vers le haut"
    >
    <img 
        id="arrowDown1"
        style="width: 15px" 
        src="./public/assets/arrow_down.svg" 
        alt="Fléche vers le bas"
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
        id="arrowUp2"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Fléche vers le haut"
    >
    <img 
        id="arrowDown2"
        style="width: 15px" 
        src="./public/assets/arrow_down.svg" 
        alt="Fléche vers le bas"
    >
    <h2>Nouveau collaborateur</h2>

    <div id="newUser">
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
</div>

<?php
    }
?>

<div class="border rounded p-3">
    <img 
        id="arrowUp3"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Fléche vers le haut"
    >
    <img 
        id="arrowDown3"
        style="width: 15px" 
        src="./public/assets/arrow_down.svg" 
        alt="Fléche vers le bas"
    >
    <h2>Informations personnelles</h2>
    
    <div id="userInfos">

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
        <p>Numéro de téléphone : 0<?= $_SESSION['phone_number'] ?>
            <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPhoneInfo">Modifier le numéro de téléphone</a>
            </button>
        </p>
        <p>Numéro de carte vitale : <?php if(empty($_SESSION['social_security_number'])) {echo 'A completer';} else { echo $_SESSION['social_security_number'];} ?>
            <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#socialSecurityNumber">Modifier le numéro de carte vitale</a>
            </button>
        </p>
        <p>Numéro de carte d'identité : <?php if(empty($_SESSION['id_number'])) {echo 'A completer';} else { echo $_SESSION['id_number'];} ?>
            <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#idNumber">Modifier le numéro de carte d'identité</a>
            </button>
        </p>
        <p>Date d'inscription : <?= $_SESSION['creation_date'] ?></p>
    </div>
</div>

<?php 

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>