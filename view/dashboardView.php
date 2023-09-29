<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

    require('view/modalsView.php');

    $req = $bdd->prepare('SELECT * FROM marital_status WHERE id = ?');
    $req->execute([$_SESSION['id']]);
    $data = $req->fetch();

?>

<h1 class="text-center my-5">Tableau de bord de <?= $data['name'] ?> <?= $data['surname'] ?></h1>

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
                    <th>Date d'inscription</th>
                    <th>Plus d'infos</th>
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
                        <td><?= $user['creation_date'] ?></td>
                        <td>
                            <a 
                            href='index.php?page=user&id=<?=$user["id"]?>' 
                            type="button" 
                            class="btn btn-info">
                                <img 
                                    style="width: 15px" 
                                    src="./public/assets/infos.svg" 
                                    alt="Informations"
                                >
                            </a>
                        </td>
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
    
    <div class="d-flex" id="usersInfos">
        <div class="1">
            <p>
                <img 
                    src="<?= './public/assets/usersImg/'.$data['profile_picture'] ?>" 
                    alt="Photo de profil à télécharger"
                    class="w-25"    
                >
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyProfilePicture">Télécharger une image de profil</a>
                </button>
            </p>
            <p>Email : <?= $data['email'] ?></p>
            <p>Prénom : <?= $data['name'] ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyNameInfo">Modifier le prénom</a>
                </button>
            </p>
            <p>Nom de famille : <?= $data['surname'] ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySurnameInfo">Modifier le nom</a>
                </button>
            </p>
            <p>Date de naissance : <?php if(empty($data['birth_date'])) {echo 'A completer';} else { echo $data['birth_date'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyBirthInfo">Modifier la date de naissance</a>
                </button>
            </p>
            <p>Numéro de téléphone : <?php if(empty($data['phone_number'])) {echo 'A completer';} else { echo $data['phone_number'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPhoneInfo">Modifier le numéro de téléphone</a>
                </button>
            </p>
            <p>Ville de naissance : <?php if(empty($data['birth_city'])) {echo 'A completer';} else { echo $data['birth_city'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#birthCity">Modifier la ville de naissance</a>
                </button>
            </p>
            <p>Pays de naissance : <?php if(empty($data['birth_country'])) {echo 'A completer';} else { echo $data['birth_country'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#birthCountry">Modifier le pays de naissance</a>
                </button>
            </p>
            <p>Numéro de rue actuelle : <?php if(empty($data['current_street_number'])) {echo 'A completer';} else { echo $data['current_street_number'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentStreetNumber">Modifier le numéro de rue actuelle</a>
                </button>
            </p>
            <p>Nom de rue actuelle : <?php if(empty($data['current_city_street'])) {echo 'A completer';} else { echo $data['current_city_street'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentStreetName">Modifier la rue actuelle</a>
                </button>
            </p>
            <p>Ville actuelle : <?php if(empty($data['current_city'])) {echo 'A completer';} else { echo $data['current_city'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentCity">Modifier la ville</a>
                </button>
            </p>
            <p>Code postal : <?php if(empty($data['current_zip_code'])) {echo 'A completer';} else { echo $data['current_zip_code'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyZipCode">Modifier le code postal</a>
                </button>
            </p>
            <p>Pays actuel : <?php if(empty($data['current_country'])) {echo 'A completer';} else { echo $data['current_country'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentCountry">Modifier le pays actuel</a>
                </button>
            </p>
        </div>
        <div class="2">
            <p>Numéro de carte vitale : <?php if(empty($data['social_security_number'])) {echo 'A completer';} else { echo $data['social_security_number'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#socialSecurityNumber">Modifier le numéro de carte vitale</a>
                </button>
            </p>
            <p>Numéro de carte d'identité : <?php if(empty($data['id_number'])) {echo 'A completer';} else { echo $data['id_number'];} ?>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#idNumber">Modifier le numéro de carte d'identité</a>
                </button>
            </p>
            <p>Date d'inscription : <?= $_SESSION['creation_date'] ?></p>
        </div>
    </div>
</div>


<?php 

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>