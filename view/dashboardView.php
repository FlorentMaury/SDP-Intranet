<?php

    // Modification du titre de la page.
    $title = 'Tableau De Bord';
    // Début d'enregistrement du HTML.
    ob_start();

    $req = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $req->execute([$_SESSION['id']]);
    $data = $req->fetch();
?>

<h1 class="text-center display-4 mt-3">
    Bienvenue <?= $_SESSION['name']?>
</h1>

<nav class="m-3 my-5">
    <ul class="d-flex justify-content-between flex-column flex-md-row">
        <?php
            if($_SESSION['id'] == 1) {
        ?>
        <li id="managerViewGridButton">
            <img src="./public/assets/add.svg" alt="Ajouter">
            <p>
                Collaborateurs
            </p>
        </li>
        <?php
            }
        ?>
        <li id="generalInfosButton">
            <img src="./public/assets/infosUser.svg" alt="Informations">
            <p>
                Informations personnelles
            </p>
        </li>
        <li id="experiencesButton">
            <img src="./public/assets/work.svg" alt="Experiences">
            <p>
                Expériences
            </p>
        </li>
        <li id="contractButton">
            <img src="./public/assets/place.svg" alt="Poste">
            <p>
                Poste au studio
            </p>
        </li>
        <li id="timeBankButton">
            <img src="./public/assets/time.svg" alt="Time Bank">
            <p>
                Compte de temps
            </p>
        </li>
        <li>
            <button type="button" href="" class="btn btn-dark">
                <a class="text-decoration-none text-white p-2" href="index.php?page=logout">Déconnexion</a>
            </button>
        </li>
    </ul>
</nav>

<?php
    if($_SESSION['id'] == 1) {
?>

<!-- Grille administrateur -->
<div class="managerView" id="managerViewGrid">
    <div class="employeesList border rounded p-3 my-3">
        <h2 class="display-6 text-center" id="collabList">Liste des collaborateurs</h2>

        <div id="employeesList">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th class="creationDate">Date d'inscription</th>
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
                            <td class="creationDate"><?= $user['creation_date'] ?></td>
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

        <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAddUser">Ajouter</a>
        </button>
    </div>
</div>

<?php
    }
?>

<!-- Grille générale -->

<!-- Informations personnelles -->
<div id="generalInfos" class="border rounded mt-3 p-3">

    <h2 class="display-6 text-center" id="userInfos">Informations personnelles</h2>
    
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
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyProfilePicture">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Email -->
            <p>Email : <?= $data['email'] ?></p>

            <!-- Prénom -->
            <div class="dashboardItems">
                <p>Prénom : <?= $data['name'] ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyNameInfo">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Nom de famille -->
            <div class="dashboardItems">
                <p>Nom de famille : <?= $data['surname'] ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySurnameInfo">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Date de naissance -->
            <div class="dashboardItems">
                <p>Date de naissance : <?php if(empty($data['birth_date'])) {echo 'A completer';} else { echo $data['birth_date'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyBirthInfo">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Numéro de téléphone -->
            <div class="dashboardItems">
                <p>Numéro de téléphone : <?php if(empty($data['phone_number'])) {echo 'A completer';} else { echo $data['phone_number'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPhoneInfo">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Ville de naissance -->
            <div class="dashboardItems">
                <p>Ville de naissance : <?php if(empty($data['birth_city'])) {echo 'A completer';} else { echo $data['birth_city'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#birthCity">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Pays de naissance -->
            <div class="dashboardItems">
                <p>Pays de naissance : <?php if(empty($data['birth_country'])) {echo 'A completer';} else { echo $data['birth_country'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#birthCountry">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Numéro de rue actuelle -->
            <div class="dashboardItems">
                <p>Numéro de rue actuelle : <?php if(empty($data['current_street_number'])) {echo 'A completer';} else { echo $data['current_street_number'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentStreetNumber">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Nom de rue actuelle -->
            <div class="dashboardItems">
                <p>Nom de rue actuelle : <?php if(empty($data['current_city_street'])) {echo 'A completer';} else { echo $data['current_city_street'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentStreetName">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Ville actuelle -->
            <div class="dashboardItems">
                <p>Ville actuelle : <?php if(empty($data['current_city'])) {echo 'A completer';} else { echo $data['current_city'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentCity">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Code postal -->
            <div class="dashboardItems">
                <p>Code postal : <?php if(empty($data['current_zip_code'])) {echo 'A completer';} else { echo $data['current_zip_code'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyZipCode">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <!-- Pays actuel -->
            <div class="dashboardItems">
                <p>Pays actuel : <?php if(empty($data['current_country'])) {echo 'A completer';} else { echo $data['current_country'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentCountry">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
        </div>

        <div class="2" id="userInfos2">

            <!-- Numéro de sécurité sociale -->
            <div class="dashboardItems">
            <p>Numéro de carte vitale : <?php if(empty($data['social_security_number'])) {echo 'A completer';} else { echo $data['social_security_number'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#socialSecurityNumber">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <div class="userInfosInsuranceCards">
                <!-- Carte vitale de face -->
                <p class="userInfosInsuranceCard">
                    <img 
                        src="<?= './public/assets/insuranceCardFace/'.$data['insurance_card_face'] ?>" 
                        alt="Carte vitale de face à télécharger"
                    >
                    <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyInsuranceCardFace">
                            Modifier
                        </a>
                    </button>
                </p>

                <!-- Carte vitale de dos -->
                <p class="userInfosInsuranceCard">
                    <img 
                        src="<?= './public/assets/insuranceCardBack/'.$data['insurance_card_back'] ?>" 
                        alt="Carte vitale de dos à télécharger"
                    >
                    <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyInsuranceCardBack">
                            Modifier
                        </a>
                    </button>
                </p>
            </div>

            <!-- Numéro de carte d'identité -->
            <div class="dashboardItems">
                <p>Numéro de carte d'identité : <?php if(empty($data['id_number'])) {echo 'A completer';} else { echo $data['id_number'];} ?></p>
                <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#idNumber">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>

            <div class="userInfosIdCards">
                <!-- Carte d'identité de face -->
                <p class="userInfosIdCard">
                    <img 
                        src="<?= './public/assets/idCardFace/'.$data['id_card_face'] ?>" 
                        alt="Carte d'identité de face à télécharger"
                    >
                    <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyIdCardFace">
                            Modifier
                        </a>
                    </button>
                </p>

                <!-- Carte d'identité de dos -->
                <p class="userInfosIdCard">
                    <img 
                        src="<?= './public/assets/idCardBack/'.$data['id_card_back'] ?>" 
                        alt="Carte d'identité de dos à télécharger"
                    >
                    <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyIdCardBack">
                            Modifier
                        </a>
                    </button>
                </p>
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

    <h2 class="display-6 text-center" id="experiences">Diplômes</h2>
    
    <div class="userExpGrid d-flex flex-column flex-md-row">

        <div class="expFirstItem border rounded mt-3 p-3">
            <div class="expItems">
                <p>Ecole : <?php if(empty($data['school_1'])) {echo 'A completer';} else { echo $data['school_1'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['school_1_start'])) {echo 'A completer';} else { echo $data['school_1_start'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1Start">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['school_1_end'])) {echo 'A completer';} else { echo $data['school_1_end'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1End">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
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
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1Doc">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
        </div>

        <?php
            if($data['school_1']) {
        ?>

        <div class="expSecondItem border rounded mt-3 p-3">
            <div class="expItems">
                <p>Seconde école : <?php if(empty($data['school_2'])) {echo 'A completer';} else { echo $data['school_2'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['school_2_start'])) {echo 'A completer';} else { echo $data['school_2_start'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2Start">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['school_2_end'])) {echo 'A completer';} else { echo $data['school_2_end'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2End">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
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
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2Doc">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
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

        <div class="expThirdItem border rounded mt-3 p-3">
            <div class="expItems">
                <p>Troisième école : <?php if(empty($data['school_3'])) {echo 'A completer';} else { echo $data['school_3'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['school_3_start'])) {echo 'A completer';} else { echo $data['school_3_start'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2Start">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['school_3_end'])) {echo 'A completer';} else { echo $data['school_3_end'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2End">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
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
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool3Doc">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
        </div>

        <?php
            }
        ?>

    </div>

    <h2 class="display-6 text-center">Expérience professionelle</h2>

    <div class="userExpGrid d-flex flex-column flex-md-row">

        <div class="expFirstItem border rounded mt-3 p-3">
            <div class="expItems">
                <p>Expérience professionelle : <?php if(empty($data['job_1'])) {echo 'A completer';} else { echo $data['job_1'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['job_1_start'])) {echo 'A completer';} else { echo $data['job_1_start'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1Start">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['job_1_end'])) {echo 'A completer';} else { echo $data['job_1_end'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1End">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Missions : <?php if(empty($data['job_1_exp'])) {echo 'A completer';} else { echo $data['job_1_exp'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1Exp">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
        </div>

        <?php
            if($data['job_1']) {
        ?>

        <div class="expSecondItem border rounded mt-3 p-3">
            <div class="expItems">
                <p>Seconde expérience professionelle : <?php if(empty($data['job_2'])) {echo 'A completer';} else { echo $data['job_2'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['job_2_start'])) {echo 'A completer';} else { echo $data['job_2_start'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2Start">
                        <img src="./public/assets/settings.svg" alt="Modifier"> 
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['job_2_end'])) {echo 'A completer';} else { echo $data['job_2_end'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2End">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Missions : <?php if(empty($data['job_2_exp'])) {echo 'A completer';} else { echo $data['job_2_exp'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2Exp">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
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

        <div class="expThirdItem border rounded mt-3 p-3">
            <div class="expItems">
                <p>Troisième expérience professionelle : <?php if(empty($data['job_3'])) {echo 'A completer';} else { echo $data['job_3'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if(empty($data['job_3_start'])) {echo 'A completer';} else { echo $data['job_3_start'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3Start">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if(empty($data['job_3_end'])) {echo 'A completer';} else { echo $data['job_3_end'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3End">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Missions : <?php if(empty($data['job_3_exp'])) {echo 'A completer';} else { echo $data['job_3_exp'];} ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3Exp">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
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

    <h2 class="display-6 text-center" id="statut">Studio des parfums</h2>

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
</div>


<!-- COMPTE DE TEMPS -->

<div id="timeBank" class="border rounded mt-3 p-3">

    <h2  class="display-6 text-center" id="events">Compte de temps</h2>

    <div class="contract border rounded mt-3 p-3">

    <?php
        require('./model/timeAccountModel.php')
    ?>

    <div class="dashboardItems mt-4 d-flex flex-column flex-md-row">
        <button class="btn btn-md btn-dark p-2 m-3" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDelayInfo">
                Déclarer un retard
            </a>
        </button>
        
        <button class="btn btn-md btn-dark p-2 m-3" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyExtraTimeInfo">
                Déclarer des heures supplémentaires
            </a>
        </button>

        <button class="btn btn-md btn-danger p-2 m-3" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAbsenceInfo">
                Déclarer une absence
            </a>
        </button>
    </div>

</div>


<?php
    if($_SESSION['id'] == 1) {
        ?>
            <script type="text/javascript" src="./src/scriptDashboard.js"></script>
        <?php
    } else {
        ?>
            <script type="text/javascript" src="./src/scriptDashboardUsers.js"></script>
        <?php
    };
?>


<?php 

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>