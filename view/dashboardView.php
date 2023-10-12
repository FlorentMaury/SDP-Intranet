<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

    $req = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $req->execute([$_SESSION['id']]);
    $data = $req->fetch();
?>

<h1 class="text-center">
    Tableau de bord de <?= $_SESSION['name'].' '.$_SESSION['surname'] ?>
</h1>

<nav>
    <ul>
        <?php
            if($_SESSION['id'] == 1) {
        ?>
        <li id="managerViewGridButton">
                Ajouter / Voir collaborateurs
        </li>
        <?php
            }
        ?>
        <li id="generalInfosButton">
                Informations personnelles
        </li>
        <li id="experiencesButton">
                Expériences
        </li>
        <li id="contractButton">
                Poste au studio
        </li>
        <li id="timeBankButton">
                Compte de temps
        </li>
    </ul>
</nav>

<?php
    if($_SESSION['id'] == 1) {
?>

<!-- Grille administrateur -->
<div id="managerViewGrid">
    <div class="border rounded p-3">

        <h2 id="collabList">Liste des collaborateurs</h2>

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

    <div class="border rounded p-3">
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
</div>

<?php
    }
?>

<!-- Grille générale -->

<!-- Informations personnelles -->
<div id="generalInfos" class="border rounded mt-3 p-3">
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
    <h2 id="userInfos">Informations personnelles</h2>
    
    <div class="userInfosGrid">
        <div class="1" id="userInfos1">

            <!-- Image de profil -->
            <div class="dashboardItems">
                <p>
                    <img 
                        src="<?= './public/assets/usersImg/'.$data['profile_picture'] ?>" 
                        alt="Photo de profil à télécharger"
                        class="w-25"    
                    >
                </p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyProfilePicture">Modifier</a>
                </button>
            </div>

            <!-- Email -->
            <p>Email : <?= $data['email'] ?></p>

            <!-- Prénom -->
            <div class="dashboardItems">
                <p>Prénom : <?= $data['name'] ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyNameInfo">Modifier</a>
                </button>
            </div>

            <!-- Nom de famille -->
            <div class="dashboardItems">
                <p>Nom de famille : <?= $data['surname'] ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySurnameInfo">Modifier</a>
                </button>
            </div>

            <!-- Date de naissance -->
            <div class="dashboardItems">
                <p>Date de naissance : <?php if(empty($data['birth_date'])) {echo 'A completer';} else { echo $data['birth_date'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyBirthInfo">Modifier</a>
                </button>
            </div>

            <!-- Numéro de téléphone -->
            <div class="dashboardItems">
                <p>Numéro de téléphone : <?php if(empty($data['phone_number'])) {echo 'A completer';} else { echo $data['phone_number'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPhoneInfo">Modifier</a>
                </button>
            </div>

            <!-- Ville de naissance -->
            <div class="dashboardItems">
                <p>Ville de naissance : <?php if(empty($data['birth_city'])) {echo 'A completer';} else { echo $data['birth_city'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#birthCity">Modifier</a>
                </button>
            </div>

            <!-- Pays de naissance -->
            <div class="dashboardItems">
                <p>Pays de naissance : <?php if(empty($data['birth_country'])) {echo 'A completer';} else { echo $data['birth_country'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#birthCountry">Modifier</a>
                </button>
            </div>

            <!-- Numéro de rue actuelle -->
            <div class="dashboardItems">
                <p>Numéro de rue actuelle : <?php if(empty($data['current_street_number'])) {echo 'A completer';} else { echo $data['current_street_number'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentStreetNumber">Modifier</a>
                </button>
            </div>

            <!-- Nom de rue actuelle -->
            <div class="dashboardItems">
                <p>Nom de rue actuelle : <?php if(empty($data['current_city_street'])) {echo 'A completer';} else { echo $data['current_city_street'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentStreetName">Modifier</a>
                </button>
            </div>

            <!-- Ville actuelle -->
            <div class="dashboardItems">
                <p>Ville actuelle : <?php if(empty($data['current_city'])) {echo 'A completer';} else { echo $data['current_city'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentCity">Modifier</a>
                </button>
            </div>

            <!-- Code postal -->
            <div class="dashboardItems">
                <p>Code postal : <?php if(empty($data['current_zip_code'])) {echo 'A completer';} else { echo $data['current_zip_code'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyZipCode">Modifier</a>
                </button>
            </div>

            <!-- Pays actuel -->
            <div class="dashboardItems">
                <p>Pays actuel : <?php if(empty($data['current_country'])) {echo 'A completer';} else { echo $data['current_country'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentCountry">Modifier</a>
                </button>
            </div>
        </div>

        <div class="2" id="userInfos2">

            <!-- Numéro de sécurité sociale -->
            <div class="dashboardItems">
            <p>Numéro de carte vitale : <?php if(empty($data['social_security_number'])) {echo 'A completer';} else { echo $data['social_security_number'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#socialSecurityNumber">Modifier</a>
                </button>
            </div>

            <!-- Carte vitale de face -->
            <div class="dashboardItems">
                <p>
                    <img 
                        src="<?= './public/assets/insuranceCardFace/'.$data['insurance_card_face'] ?>" 
                        alt="Carte vitale de face à télécharger"
                        class="w-25"    
                    >
                </p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyInsuranceCardFace">Modifier</a>
                </button>
            </div>

            <!-- Carte vitale de dos -->
            <div class="dashboardItems">
                <p>
                    <img 
                        src="<?= './public/assets/insuranceCardBack/'.$data['insurance_card_back'] ?>" 
                        alt="Carte vitale de dos à télécharger"
                        class="w-25"    
                    >
                </p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyInsuranceCardBack">Modifier</a>
                </button>
            </div>

            <!-- Numéro de carte d'identité -->
            <div class="dashboardItems">
                <p>Numéro de carte d'identité : <?php if(empty($data['id_number'])) {echo 'A completer';} else { echo $data['id_number'];} ?></p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#idNumber">Modifier</a>
                </button>
            </div>

            <!-- Carte d'identité de face -->
            <div class="dashboardItems">
                <p>
                    <img 
                        src="<?= './public/assets/idCardFace/'.$data['id_card_face'] ?>" 
                        alt="Carte d'identité de face à télécharger"
                        class="w-25"    
                    >
                </p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyIdCardFace">Modifier</a>
                </button>
            </div>

            <!-- Carte d'identité de dos -->
            <div class="dashboardItems">
                <p>
                    <img 
                        src="<?= './public/assets/idCardBack/'.$data['id_card_back'] ?>" 
                        alt="Carte d'identité de dos à télécharger"
                        class="w-25"    
                    >
                </p>
                <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyIdCardBack">Modifier</a>
                </button>
            </div>

            <!-- Date d'inscription -->
            <div class="dashboardItems">
                <p>Date d'inscription : <?= $_SESSION['creation_date'] ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Expériences -->
<div id="experiences" class="border rounded mt-3 p-3">
    <img 
        id="arrowUp4"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Fléche vers le haut"
    >
    <img 
        id="arrowDown4"
        style="width: 15px" 
        src="./public/assets/arrow_down.svg" 
        alt="Fléche vers le bas"
    >
    <h2 id="experiences">Diplômes</h2>
    
    <div class="schoolsGrid">

        <div class="school1 border rounded mt-3 p-3">
            <div class="expItems">
                <p>Ecole : <?php if(empty($data['school_1'])) {echo 'A completer';} else { echo $data['school_1'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['school_1_start'])) {echo 'A completer';} else { echo $data['school_1_start'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1Start">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['school_1_end'])) {echo 'A completer';} else { echo $data['school_1_end'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1End">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>
                    <?php 
                        if(empty($data['school_2_doc'])) {
                            echo 'Diplôme obtenu à télécharger';
                        } else {
                    ?>
                    <img 
                        src="<?= './public/assets/school1Doc/'.$data['school_1_doc'] ?>" 
                        alt="Diplôme obtenu à télécharger"
                        class="w-25"    
                    >
                    <?php 
                        }
                    ?>
                </p>            
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1Doc">Modifier</a>
                </button>
            </div>
        </div>

        <?php
            if($data['school_1']) {
        ?>

        <div class="school2 border rounded mt-3 p-3">
            <div class="expItems">
                <p>Seconde école : <?php if(empty($data['school_2'])) {echo 'A completer';} else { echo $data['school_2'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['school_2_start'])) {echo 'A completer';} else { echo $data['school_2_start'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2Start">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['school_2_end'])) {echo 'A completer';} else { echo $data['school_2_end'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2End">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>
                    <?php 
                        if(empty($data['school_2_doc'])) {
                            echo 'Diplôme obtenu à télécharger';
                        } else {
                    ?>
                    <img 
                        src="<?= './public/assets/school2Doc/'.$data['school_2_doc'] ?>" 
                        alt="Second diplôme obtenu à télécharger"
                        class="w-25"    
                    >
                    <?php 
                        }
                    ?>
                </p>            
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2Doc">Modifier</a>
                </button>
            </div>
        </div>

        <!-- <div class="schoolButtons">
            <div id="addSchool" class="expItems">
                <button type="button" class="btn btn-dark me-2">
                    Ajouter un diplôme scolaire
                </button>
            </div>

            <div id="cancel" class="expItems">
                <button type="button" href="" class="btn btn-dark me-2">
                    Annuler
                </button>
            </div>  
        </div> -->

        <?php
            }
        ?>

        <?php
            if($data['school_2']) {
        ?>

        <div class="school3 border rounded mt-3 p-3">
            <div class="expItems">
                <p>Troisième école : <?php if(empty($data['school_3'])) {echo 'A completer';} else { echo $data['school_3'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['school_3_start'])) {echo 'A completer';} else { echo $data['school_3_start'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2Start">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['school_3_end'])) {echo 'A completer';} else { echo $data['school_3_end'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2End">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>
                    <?php 
                        if(empty($data['school_3_doc'])) {
                            echo 'Diplôme obtenu à télécharger';
                        } else {
                    ?>
                    <img 
                        src="<?= './public/assets/school3Doc/'.$data['school_3_doc'] ?>" 
                        alt="Second diplôme obtenu à télécharger"
                        class="w-25"    
                    >
                    <?php 
                        }
                    ?>
                </p>            
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool3Doc">Modifier</a>
                </button>
            </div>
        </div>

        <?php
            }
        ?>

    </div>

    <h2 id="experiences">Expérience professionelle</h2>

    <div class="schoolsGrid">

        <div class="job1 border rounded mt-3 p-3">
            <div class="expItems">
                <p>Expérience professionelle : <?php if(empty($data['job_1'])) {echo 'A completer';} else { echo $data['job_1'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['job_1_start'])) {echo 'A completer';} else { echo $data['job_1_start'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1Start">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['job_1_end'])) {echo 'A completer';} else { echo $data['job_1_end'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1End">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Missions : <?php if(empty($data['job_1_exp'])) {echo 'A completer';} else { echo $data['job_1_exp'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1Exp">Modifier</a>
                </button>
            </div>
        </div>

        <?php
            if($data['job_1']) {
        ?>

        <div class="job2 border rounded mt-3 p-3">
            <div class="expItems">
                <p>Seconde expérience professionelle : <?php if(empty($data['job_2'])) {echo 'A completer';} else { echo $data['job_2'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['job_2_start'])) {echo 'A completer';} else { echo $data['job_2_start'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2Start">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['job_2_end'])) {echo 'A completer';} else { echo $data['job_2_end'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2End">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Missions : <?php if(empty($data['job_2_exp'])) {echo 'A completer';} else { echo $data['job_2_exp'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2Exp">Modifier</a>
                </button>
            </div>
        </div>

        <!-- <div class="jobButtons">
            <div id="addJob" class="expItems">
                <button type="button" class="btn btn-dark me-2">
                    Ajouter une expérience professionelle
                </button>
            </div>

            <div id="cancel" class="expItems">
                <button type="button" href="" class="btn btn-dark me-2">
                    Annuler
                </button>
            </div>  
        </div> -->

        <?php
            }
        ?>

        <?php
            if($data['job_2']) {
        ?>

        <div class="job3 border rounded mt-3 p-3">
            <div class="expItems">
                <p>Troisième expérience professionelle : <?php if(empty($data['job_3'])) {echo 'A completer';} else { echo $data['job_3'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['job_3_start'])) {echo 'A completer';} else { echo $data['job_3_start'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3Start">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['job_3_end'])) {echo 'A completer';} else { echo $data['job_3_end'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3End">Modifier</a>
                </button>
            </div>
            <div class="expItems">
                <p>Missions : <?php if(empty($data['job_3_exp'])) {echo 'A completer';} else { echo $data['job_3_exp'];} ?></p>
                <button class="btn btn-md btn-dark p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3Exp">Modifier</a>
                </button>
            </div>
        </div>

        <div class="jobButtons">
            <div id="addJob" class="expItems">
                <button type="button" class="btn btn-dark me-2">
                    Ajouter une expérience professionelle
                </button>
            </div>

            <div id="cancel" class="expItems">
                <button type="button" href="" class="btn btn-dark me-2">
                    Annuler
                </button>
            </div>  
        </div>

        <?php
            }
        ?>

    </div>
</div>


<!-- CONTRAT CHEZ STUDIO DES PARFUMS -->

<div id="contract" class="border rounded mt-3 p-3">
    <img 
        id="arrowUp4"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Fléche vers le haut"
    >
    <img 
        id="arrowDown4"
        style="width: 15px" 
        src="./public/assets/arrow_down.svg" 
        alt="Fléche vers le bas"
    >

    <h2 id="statut">Studio des parfums</h2>

    <div class="contract border rounded mt-3 p-3">

    <!-- Type de contrat -->
    <div>
        <p>Type de contrat : <?php if(empty($data['contract_type'])) {echo 'En attente';} else { echo $data['contract_type'];} ?></p>
    </div>

    <!-- Date de début -->
    <div>
        <p>Date de début du contrat : <?php if(empty($data['contract_start'])) {echo 'En attente';} else { echo $data['contract_end'];} ?></p>
    </div>

    <!-- Date de fin -->
    <div>
        <p>Date de fin du contrat : <?php if(empty($data['contract_end'])) {echo 'En attente';} else { echo $data['contract_end'];} ?></p>
    </div>

    <!-- Niveau -->
    <div>
        <p>Niveau : <?php if(empty($data['contract_level'])) {echo 'En attente';} else { echo $data['contract_level'];} ?></p>
    </div>

    <!-- Coef -->
    <div>
        <p>Coef : <?php if(empty($data['contract_coef'])) {echo 'En attente';} else { echo $data['contract_coef'];} ?></p>
    </div>

    <!-- Rémunération -->
    <div>
        <p>Rémunération : <?php if(empty($data['contract_remuneration'])) {echo 'En attente';} else { echo $data['contract_remuneration'];} ?></p>
    </div>

    <!-- Mutuelle -->
    <div>
        <p>Mutuelle : <?php if(empty($data['contract_insurance'])) {echo 'En attente';} else { echo $data['contract_insurance'];} ?></p>
    </div>

    <!-- Numéro de mutuelle -->
    <div>
        <p>Numéro de mutuelle : <?php if(empty($data['contract_insurance_number'])) {echo 'En attente';} else { echo $data['contract_insurance_number'];} ?></p>
    </div>

    <!-- Heures hebdomadaires -->
    <div>
        <p>Heures hebdomadaires : <?php if(empty($data['contract_weekly'])) {echo 'En attente';} else { echo $data['contract_weekly'];} ?></p>
    </div>

    <!-- Navigo -->
    <div>
        <p>Navigo : <?php if(empty($data['contract_transports'])) {echo 'En attente';} else { echo $data['contract_transports'];} ?></p>
    </div>
</div>


<!-- COMPTE DE TEMPS -->

<div id="timeBank" class="border rounded mt-3 p-3">
    <img 
        id="arrowUp4"
        style="width: 15px" 
        src="./public/assets/arrow_up.svg" 
        alt="Fléche vers le haut"
    >
    <img 
        id="arrowDown4"
        style="width: 15px" 
        src="./public/assets/arrow_down.svg" 
        alt="Fléche vers le bas"
    >

    <h2 id="events">Compte de temps</h2>

    <div class="contract border rounded mt-3 p-3">

    <?php
        require('./model/timeAccountModel.php')
    ?>

    <div class="dashboardItems">
        <p>Déclarer un retard</p>
        <button class="btn btn-md btn-dark p-2" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDelayInfo">Modifier</a>
        </button>
    </div>

    <div class="dashboardItems">
        <p>Déclarer une absence</p>
        <button class="btn btn-md btn-dark p-2" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAbsenceInfo">Modifier</a>
        </button>
    </div>

    <div class="dashboardItems">
        <p>Déclarer des heures supplémentaires</p>
        <button class="btn btn-md btn-dark p-2" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyExtraTimeInfo">Modifier</a>
        </button>
    </div>

</div>

<?php 

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>