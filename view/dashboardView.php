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

        <p>Email : <?= $_SESSION['email'] ?></p>         <button class="btn btn-md btn-dark mt-4 p-2" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyNameInfo">Modifier les informations</a>
        </button>
        <p>Prénom : <?= $_SESSION['name'] ?></p>
        <p>Nom de famille :<?= $_SESSION['surname'] ?></p>
        <p>Date de naissance : <?= $_SESSION['birth_date'] ?></p>
        <p>Sexe : <?= $_SESSION['sex'] ?></p>
        <p>Numéro de téléphone : +33<?= $_SESSION['phone_number'] ?></p>
        <p>Date d'inscription : <?= $_SESSION['creation_date'] ?></p>
        <p>Numéro de carte vitale : <?php if(empty($_SESSION['social_security_number'])) {echo 'A completer';} else { echo $_SESSION['social_security_number'];} ?></p>
        <p>Numéro de carte d'identité : <?php if(empty($_SESSION['id_number'])) {echo 'A completer';} else { echo $_SESSION['id_number'];} ?></p>

</div>

<!-- Modale de modifications. -->
<div class="modal fade" id="modifyInfos" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">

            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier les informations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">

                <p class="form-floating m-2">
                    <input type="text" name="modifyName" class="form-control" id="modifyName" placeholder="Prénom">
                    <label for="modifyName">Prénom</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="modifySurname" class="form-control" id="modifySurname" placeholder="Nom de famille">
                    <label for="modifySurname">Nom de famille</label>
                </p>
                <p class="form-floating m-2">
                    <input type="date" name="modifyBirth" class="form-control" id="modifyBirth" placeholder="Date de naissance">
                    <label for="modifyBirth">Date de naissance</label>
                </p>
                <p class="form-floating m-2">
                    <label for="modifySex"></label>
                    <select class="form-control" id="modifySex">
                        <option>Homme</option>
                        <option>Femme</option>
                    </select>
                </p>
                <p class="form-floating m-2">
                    <input type="phone" name="modifyPhone" class="form-control" id="modifyPhone" placeholder="Numéro de téléphone">
                    <label for="modifyPhone">Téléphone</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="cityBirthCity" class="form-control" id="cityBirthCity" placeholder="Ville de naissance">
                    <label for="cityBirthCity">Ville de naissance</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="cityBirthCountry" class="form-control" id="cityBirthCountry" placeholder="Pays de naissance">
                    <label for="cityBirthCountry">Pays de naissance</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="cityLivingNumber" class="form-control" id="cityLivingNumber" placeholder="Numéro de rue de résidence">
                    <label for="cityLivingNumber">Numéro de rue de résidence</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="cityLivingStreet" class="form-control" id="cityLivingStreet" placeholder="Rue de résidence">
                    <label for="cityLivingStreet">Rue de résidence</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="cityLivingCity" class="form-control" id="cityLivingCity" placeholder="Ville de résidence">
                    <label for="cityLivingCity">Ville de résidence</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="cityLivingCountry	" class="form-control" id="cityLivingCountry" placeholder="Pays de résidence">
                    <label for="cityLivingCountry">Pays de résidence</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="idNumber" class="form-control" id="idNumber" placeholder="Numéro de carte d'identité">
                    <label for="idNumber">Numéro de carte d'identité</label>
                </p>
                <p class="form-floating m-2">
                    <input type="text" name="idInsurance" class="form-control" id="idInsurance" placeholder="Numéro de carte vitale">
                    <label for="idInsurance">Numéro de carte vitale</label>
                </p>
                <p class="form-floating m-2">
                    <input type="file" name="modifyIdImg" class="form-control" id="modifyIdImg" placeholder="Photo d'identité">
                    <label for="modifyIdImg">Photo d'identité</label>
                </p>
                <p class="form-floating m-2">
                    <input type="file" name="modifyInsuranceFace" class="form-control" id="modifyIdImg" placeholder="Carte vitale (recto)">
                    <label for="modifyIdImg">Carte vitale (recto)</label>
                </p>
                <p class="form-floating m-2">
                    <input type="file" name="modifyInsuranceBack" class="form-control" id="modifyIdImg" placeholder="Carte vitale (verso)">
                    <label for="modifyIdImg">Carte vitale (verso)</label>
                </p>
                <p class="form-floating m-2">
                    <input type="file" name="modifyIdFace" class="form-control" id="modifyIdImg" placeholder="Carte d'identité (recto)">
                    <label for="modifyIdImg">Carte d'identité (recto)</label>
                </p>
                <p class="form-floating m-2">
                    <input type="file" name="modifyIdBack" class="form-control" id="modifyIdImg" placeholder="Carte d'identité (verso)">
                    <label for="modifyIdImg">Carte d'identité (verso)</label>
                </p>
                
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<?php 

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>