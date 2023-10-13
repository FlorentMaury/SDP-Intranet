<?php

require ('./model/connectionDBModel.php');

// Demande d'informations d'un compte employé.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Récupération des identifiants de l'utilisateur séléctionné.
    $req = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $req->execute([$id]);
    $data = $req->fetch();

    // Modification du titre de la page.
    $title = 'Informations sur ' . $data['name'] . ' ' . $data['surname'] . '';
    // Début d'enregistrement du HTML.
    ob_start();
}

?>

<h1 class="mb-3 display-4 text-center mt-3">Profil de <?= $data['name'] ?> <?= $data['surname'] ?></h1>

<nav class="m-3 my-5">
    <ul class="d-flex justify-content-between flex-column flex-md-row">
        <li id="generalUserInfosButton">
            <img src="./public/assets/infosUser.svg" alt="Informations">
            <p>
                Informations
            </p>
        </li>
        <li id="userSchoolButton">
            <img src="./public/assets/school.svg" alt="Ecoles">
            <p>Niveau scolaire</p>
        </li>
        <li id="userExpButton">
            <img src="./public/assets/work.svg" alt="Expériences">
            <p>
                Expérience professionelle
            </p>
        </li>
        <li id="userContractButton">
            <img src="./public/assets/place.svg" alt="Poste">
            <p>
                Poste au studio
            </p>
        </li>
        <li id="userTimeBankButton">
            <img src="./public/assets/time.svg" alt="Poste">
            <p>
                Compte de temps
            </p>
        </li>
        <li>
        <button type="button" href="" class="btn btn-dark me-2">
        <a class="text-decoration-none text-white" href="index.php?page=dashboard">Retour au tableau de bord</a>
    </button>
        </li>
    </ul>
</nav>

<div id="generalUserInfos" class="generalUserInfos border rounded m-2 p-3 text-center">
    <h2 class="display-6">Informations générales</h2>

    <div class="userInfosGrid">
        <div class="dashboardItems">
            <p>
                <img 
                    src="<?= './public/assets/usersImg/'.$data['profile_picture'] ?>" 
                    alt="Photo de profil à télécharger"
                    class="w-25"
                >
            </p>
        </div>
        <div class="dashboardItems">
            <p>Email : <?= $data['email'] ?></p>
        </div>
        <div class="dashboardItems">
            <p>Prénom : <?= $data['name'] ?></p>
        </div>
        <div class="dashboardItems">
            <p>Adresse mail : <?= $data['email'] ?></p>
        </div>
        <div class="dashboardItems">
            <p>Adresse mail : <?= $data['email'] ?></p>
        </div>
        <div class="dashboardItems">
            <p>Nom de famille : <?= $data['surname'] ?></p>
        </div>
        <div class="dashboardItems">
            <p>Date de naissance : <?php if(empty($data['birth_date'])) {echo 'A completer';} else { echo $data['birth_date'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Numéro de téléphone : <?php if(empty($data['phone_number'])) {echo 'A completer';} else { echo $data['phone_number'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Ville de naissance : <?php if(empty($data['birth_city'])) {echo 'A completer';} else { echo $data['birth_city'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Pays de naissance : <?php if(empty($data['birth_country'])) {echo 'A completer';} else { echo $data['birth_country'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Numéro de rue actuelle : <?php if(empty($data['current_street_number'])) {echo 'A completer';} else { echo $data['current_street_number'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Nom de rue actuelle : <?php if(empty($data['current_city_street'])) {echo 'A completer';} else { echo $data['current_city_street'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Ville actuelle : <?php if(empty($data['current_city'])) {echo 'A completer';} else { echo $data['current_city'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Code postal : <?php if(empty($data['current_zip_code'])) {echo 'A completer';} else { echo $data['current_zip_code'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Pays actuel : <?php if(empty($data['current_country'])) {echo 'A completer';} else { echo $data['current_country'];} ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Numéro de carte vitale : <?php if(empty($data['social_security_number'])) {echo 'A completer';} else { echo $data['social_security_number'];} ?>
            </p>
        </div>
        <div class="userInfosInsuranceCards">
            <p class="userInfosInsuranceCard">
                <img 
                    src="<?= './public/assets/insuranceCardFace/'.$data['insurance_card_face'] ?>" 
                    alt="Carte vitale recto à télécharger"
                >
                <a 
                    class="text-decoration-none text-white p-2" 
                    href="<?= './public/assets/insuranceCardFace/'.$data['insurance_card_face'] ?>" 
                    download="<?= 'CarteVitaleRecto-'.$data['name'].$data['surname'] ?>"
                >
                    <button type="button" href="" class="btn btn-dark me-2">
                        Télécharger                   
                    </button>
                </a>   
            </p>
            <p class="userInfosInsuranceCard">
                <img 
                    src="<?= './public/assets/insuranceCardBack/'.$data['insurance_card_back'] ?>" 
                    alt="Carte vitale verso à télécharger"
                >
                <a class="text-decoration-none text-white p-2" 
                    href="<?= './public/assets/insuranceCardBack/'.$data['insurance_card_back'] ?>" 
                    download="<?= 'CarteVitaleVerso-'.$data['name'].$data['surname'] ?>"
                >
                    <button type="button" href="" class="btn btn-dark me-2">
                        Télécharger         
                    </button>
                </a>  
            </p>
        </div>
        <div class="dashboardItems">
            <p>Numéro de carte d'identité : <?php if(empty($data['id_number'])) {echo 'A completer';} else { echo $data['id_number'];} ?>
            </p>
        </div>
        <div class="userInfosIdCards">
            <p class="userInfosIdCard">
                <img 
                    src="<?= './public/assets/idCardFace/'.$data['id_card_face'] ?>" 
                    alt="Carte d'identité recto à télécharger"
                >
                <a 
                    class="text-decoration-none text-white p-2" 
                    href="<?= './public/assets/idCardFace/'.$data['id_card_face'] ?>" 
                    download="<?= 'CarteIdentitéRecto-'.$data['name'].$data['surname'] ?>"
                >
                    <button type="button" href="" class="btn btn-dark me-2">
                        Télécharger                  
                    </button>
                </a>
            </p>
            <p class="userInfosIdCard">
                <img 
                    src="<?= './public/assets/idCardBack/'.$data['id_card_back'] ?>" 
                    alt="Carte d'identité verso à télécharger"
                >
                <a 
                    class="text-decoration-none text-white p-2" 
                    href="<?= './public/assets/idCardBack/'.$data['id_card_back'] ?>" 
                    download="<?= 'CarteIdentitéVerso-'.$data['name'].$data['surname'] ?>"
                >
                    <button type="button" href="" class="btn btn-dark me-2">
                        Télécharger                   
                    </button>
                </a>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Date d'inscription : <?= $_SESSION['creation_date'] ?></p>
            <a 
                href='./model/deleteUserModel.php?id=<?=$user["id"]?>' 
                type="button" 
                class="m-3"
                >
                <button class="btn btn-danger text-align-center">
                    Supprimer
                </button>
            </a>
        </div>
    </div>
</div>


<div id="userSchool" class="border rounded m-2 p-3 text-center">

    <h2 class="display-6">Niveau scolaire</h2>

    <div class="userExpGrid">
        <div class="expFirstItem border rounded m-1 p-3">
            <p>Première école : <?php if(empty($data['school_1'])) {echo 'A completer';} else { echo $data['school_1'];} ?>
            </p>
            <p>Date de début : <?php if(empty($data['school_1_start'])) {echo 'A completer';} else { echo $data['school_1_start'];} ?>
            </p>
            <p>Date de fin : <?php if(empty($data['school_1_end'])) {echo 'A completer';} else { echo $data['school_1_end'];} ?>
            </p>
            <div class="userInfosDiplomaCards">
                <p class="userInfosDiplomaCard">
                    Diplôme obtenu :
                    <img 
                        src="<?= './public/assets/school1Doc/'.$data['school_1_doc'] ?>" 
                        alt="Diplôme à completer"
                    >
                    <?php
                        if(!empty($data['school_1_doc'])) {
                    ?>
                    <a
                        class="text-decoration-none text-white p-2" 
                        href="<?= './public/assets/school1Doc/'.$data['school_1_doc'] ?>" 
                        download="<?= 'Diplome1-'.$data['name'].$data['surname'] ?>"
                    >
                        <button type="button" href="" class="btn btn-dark me-2">
                            Télécharger                   
                        </button>
                    </a>
                    <?php
                        }
                    ?>
                </p>
            </div> 
        </div>

        <?php 
            if(!empty($data['school_2'])) {
        ?>

        <div class="expSecondItem border rounded m-1 p-3">
            <p>Seconde école : <?php if(empty($data['school_2'])) {echo 'A completer';} else { echo $data['school_2'];} ?>
            </p>
            <p>Date de début : <?php if(empty($data['school_2_start'])) {echo 'A completer';} else { echo $data['school_2_start'];} ?>
            </p>
            <p>Date de fin : <?php if(empty($data['school_2_end'])) {echo 'A completer';} else { echo $data['school_2_end'];} ?>
            </p>
            <div class="userInfosDiplomaCards">
                <p class="userInfosDiplomaCard">
                    Diplôme obtenu :
                    <img 
                        src="<?= './public/assets/school2Doc/'.$data['school_2_doc'] ?>" 
                        alt="Diplôme à completer"
                    >

                    <?php 
                        if(!empty($data['school_2_doc'])) {
                    ?>

                    <a 
                        class="text-decoration-none text-white p-2" 
                        href="<?= './public/assets/school2Doc/'.$data['school_2_doc'] ?>" 
                        download="<?= 'Diplome2-'.$data['name'].$data['surname'] ?>"
                    >
                        <button type="button" href="" class="btn btn-dark me-2">
                            Télécharger                   
                        </button>
                    </a>

                    <?php 
                        }
                    ?>
                </p>
            </div> 
        </div>

        <?php 
            }  
        ?>

<?php 
            if(!empty($data['school_3'])) {
        ?>

        <div class="expThirdItem border rounded m-1 p-3">
            <p>Troisième école : <?php if(empty($data['school_3'])) {echo 'A completer';} else { echo $data['school_3'];} ?>
            </p>
            <p>Date de début : <?php if(empty($data['school_3_start'])) {echo 'A completer';} else { echo $data['school_3_start'];} ?>
            </p>
            <p>Date de fin : <?php if(empty($data['school_3_end'])) {echo 'A completer';} else { echo $data['school_3_end'];} ?>
            </p>
            <div class="userInfosDiplomaCards">
                <p class="userInfosDiplomaCard">
                    Diplôme obtenu :
                    <img 
                        src="<?= './public/assets/school3Doc/'.$data['school_3_doc'] ?>" 
                        alt="Diplôme à completer"
                    >

                    <?php 
                        if(!empty($data['school_3_doc'])) {
                    ?>

                    <a 
                        class="text-decoration-none text-white p-2" 
                        href="<?= './public/assets/school3Doc/'.$data['school_3_doc'] ?>" 
                        download="<?= 'Diplome2-'.$data['name'].$data['surname'] ?>"
                    >
                        <button type="button" href="" class="btn btn-dark me-2">
                            Télécharger                   
                        </button>
                    </a>

                    <?php 
                        }
                    ?>
                </p>
            </div> 
        </div>

        <?php 
            }  
        ?>
    </div>
</div>

<div id="userExp" class="border rounded m-2 p-3 text-center">

    <h2 class="display-6">Expérience professionelle</h2>

<div class="userExpGrid">
    <div class="expFirstItem border rounded m-1 p-3">
        <p>Première expérience : <?php if(empty($data['job_1'])) {echo 'A completer';} else { echo $data['job_1'];} ?>
        </p>
        <p>Date de début : <?php if(empty($data['job_1_start'])) {echo 'A completer';} else { echo $data['job_1_start'];} ?>
        </p>
        <p>Date de fin : <?php if(empty($data['job_1_end'])) {echo 'A completer';} else { echo $data['job_1_end'];} ?>
        </p>
        <p>Missions : <?php if(empty($data['job_1_exp'])) {echo 'A completer';} else { echo $data['job_1_exp'];} ?></p>
    </div>

    <?php 
        if(!empty($data['job_2'])) {
    ?>

    <div class="expSecondItem border rounded m-1 p-3">
        <p>Seconde expérience : <?php if(empty($data['job_2'])) {echo 'A completer';} else { echo $data['job_2'];} ?>
        </p>
        <p>Date de début : <?php if(empty($data['job_2_start'])) {echo 'A completer';} else { echo $data['job_2_start'];} ?>
        </p>
        <p>Date de fin : <?php if(empty($data['job_2_end'])) {echo 'A completer';} else { echo $data['job_2_end'];} ?>
        </p>
        <p>Missions : <?php if(empty($data['job_2_exp'])) {echo 'A completer';} else { echo $data['job_2_exp'];} ?></p>
    </div>

    <?php 
        }  
    ?>

    <?php 
        if(!empty($data['job_3'])) {
    ?>

    <div class="expThirdItem border rounded m-1 p-3">
        <p>Troisième expérience : <?php if(empty($data['job_3'])) {echo 'A completer';} else { echo $data['job_3'];} ?>
        </p>
        <p>Date de début : <?php if(empty($data['job_3_start'])) {echo 'A completer';} else { echo $data['job_3_start'];} ?>
        </p>
        <p>Date de fin : <?php if(empty($data['job_3_end'])) {echo 'A completer';} else { echo $data['job_3_end'];} ?>
        </p>
        <p>Missions : <?php if(empty($data['job_3_exp'])) {echo 'A completer';} else { echo $data['job_3_exp'];} ?></p>
    </div>

    <?php 
        }  
    ?>
    </div>
</div>

<!-- CONTRAT CHEZ STUDIO DES PARFUMS -->

<div id="userContract" class="border rounded m-2 p-3 text-center">

    <h2 class="display-6" id="experiences">Studio des parfums</h2>

    <!-- Type de contrat -->
    <div class="expItems">
        <p>Type de contrat : <?php if(empty($data['contract_type'])) {echo 'En attente';} else { echo $data['contract_type'];} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a href="index.php?page=user" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContract">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Date de début -->
    <div class="expItems">
        <p>Date de début du contrat : <?php if(empty($data['contract_start'])) {echo 'En attente';} else { echo $data['contract_start'];} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractStart">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Date de fin -->
    <div class="expItems">
        <p>Date de fin du contrat : <?php if(empty($data['contract_end'])) {echo 'En attente';} else { echo $data['contract_end'];} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractEnd">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Niveau -->
    <div class="expItems">
        <p>Niveau : <?php if(empty($data['contract_level'])) {echo 'En attente';} else { echo $data['contract_level'];} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractLevel">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Coef -->
    <div class="expItems">
        <p>Coef : <?php if(empty($data['contract_coef'])) {echo 'En attente';} else { echo $data['contract_coef'];} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractCoef">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Rémunération -->
    <div class="expItems">
        <p>Rémunération à l'heure : <?php if(empty($data['contract_remuneration'])) {echo 'En attente';} else { echo $data['contract_remuneration'].'€ / Heure';} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractRemuneration">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Mutuelle -->
    <div class="expItems">
        <p>Mutuelle : <?php if(empty($data['contract_insurance'])) {echo 'En attente';} else { echo $data['contract_insurance'];} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractInsurance">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Numéro de mutuelle -->
    <div class="expItems">
        <p>Numéro de mutuelle : <?php if(empty($data['contract_insurance_number'])) {echo 'En attente';} else { echo $data['contract_insurance_number'];} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractInsuranceNumber">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Heures hebdomadaires -->
    <div class="expItems">
        <p>Heures hebdomadaires : <?php if(empty($data['contract_weekly'])) {echo 'En attente';} else { echo $data['contract_weekly']. 'h / semaines';} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractWeekly">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Navigo -->
    <div class="expItems">
        <p>Navigo : <?php if(empty($data['contract_transports'])) {echo 'En attente';} else { echo $data['contract_transports'];} ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractTransport">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>
</div>

<!-- COMPTE DE TEMPS -->

<div id="userTimeBank" class="border rounded m-2 p-3">

    <h2 class="display-6 text-center" id="experiences">Compte temps</h2>

    <?php
            require('./model/timeAccountModel.php')
        ?>
</div>

<button type="button" href="" class="btn btn-dark m-2">
    <a class="text-decoration-none text-white p-2" href="index.php?page=dashboard">Retour au tableau de bord</a>
</button>

<script type="text/javascript" src="./src/scriptUserInfos.js"></script>

<?php 

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>