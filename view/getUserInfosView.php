<?php

require('./model/connectionDBModel.php');

// Demande d'informations d'un compte employé.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Récupération des identifiants de l'utilisateur séléctionné.
    $req = $bdd->prepare('
        SELECT *
        FROM user 
        INNER JOIN user_exp ON user.id = user_exp.user_exp_id
        INNER JOIN user_role ON user.id = user_role.user_role_id
        INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
        LEFT JOIN user_holiday ON user.id = user_holiday.user_holiday_id
        WHERE user.id = ?
        ');
    $req->execute([$id]);
    $data = $req->fetch();

    // Modification du titre de la page.
    $title = 'Informations sur ' . $data['name'] . ' ' . $data['surname'] . '';
    // Début d'enregistrement du HTML.
    ob_start();
}

?>

<!-- Titre dynamique. -->
<h1 class="mb-3 display-4 text-center mt-3">Profil de <?= $data['name'] ?> <?= strtoupper($data['surname']) ?></h1>

<!-- Navigation des utilisateurs. -->
<nav class="m-3 my-5">
    <ul class="d-flex justify-content-center align-items-center flex-wrap flex-sm-row">
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
                Contrat
            </p>
        </li>
        <li id="userTimeBankButton">
            <img src="./public/assets/time.svg" alt="Poste">
            <p>
                Banque de temps
            </p>
        </li>
        <li>
            <button type="button" href="" class="btn btn-dark me-2">
                <a class="text-decoration-none text-white" href="index.php?page=dashboard&action=generalInfosButton">Retour au tableau de bord</a>
            </button>
        </li>
    </ul>
</nav>

<!-- Informations générales du profil. -->
<div id="generalUserInfos" class="generalUserInfos border rounded m-2 p-3 text-center">
    <h2 class="display-6">Informations générales</h2>

    <div class="userInfosGrid">
        <div class="dashboardItems">
            <p>
                <img src="<?= './public/assets/usersImg/' . $data['profile_picture'] ?>" alt="Photo de profil à télécharger" class="w-25">
            </p>
        </div>
        <div class="dashboardItems">
            <p>Email : <?= $data['email'] ?></p>
        </div>
        <div class="dashboardItems">
            <p>Prénom : <?= $data['name'] ?></p>
        </div>
        <div class="dashboardItems">
            <p>Nom de famille : <?= $data['surname'] ?></p>
        </div>
        <div class="dashboardItems">
            <p>Date de naissance : <?php if (empty($data['birth_date'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['birth_date'];
                                    } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Numéro de téléphone : <?php if (empty($data['phone_number'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['phone_number'];
                                        } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Ville de naissance : <?php if (empty($data['birth_city'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['birth_city'];
                                    } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Pays de naissance : <?php if (empty($data['birth_country'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['birth_country'];
                                    } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Numéro de rue actuelle : <?php if (empty($data['current_street_number'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['current_street_number'];
                                        } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Nom de rue actuelle : <?php if (empty($data['current_city_street'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['current_city_street'];
                                        } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Ville actuelle : <?php if (empty($data['current_city'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['current_city'];
                                } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Code postal : <?php if (empty($data['current_zip_code'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['current_zip_code'];
                                } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Pays actuel : <?php if (empty($data['current_country'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['current_country'];
                                } ?>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Numéro de carte vitale : <?php if (empty($data['social_security_number'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['social_security_number'];
                                        } ?>
            </p>
        </div>
        <div class="userInfosInsuranceCards d-flex flex-column flex-sm-row">
            <p class="userInfosInsuranceCard">
                <img src="<?= './public/assets/insuranceCardFace/' . $data['insurance_card_face'] ?>" alt="Carte vitale recto à télécharger">
                <a class="text-decoration-none text-white p-2" href="<?= './public/assets/insuranceCardFace/' . $data['insurance_card_face'] ?>" download="<?= 'CarteVitaleRecto-' . $data['name'] . $data['surname'] ?>">
                    <button type="button" href="" class="btn btn-dark me-2">
                        Télécharger
                    </button>
                </a>
            </p>
            <p class="userInfosInsuranceCard">
                <img src="<?= './public/assets/insuranceCardBack/' . $data['insurance_card_back'] ?>" alt="Carte vitale verso à télécharger">
                <a class="text-decoration-none text-white p-2" href="<?= './public/assets/insuranceCardBack/' . $data['insurance_card_back'] ?>" download="<?= 'CarteVitaleVerso-' . $data['name'] . $data['surname'] ?>">
                    <button type="button" href="" class="btn btn-dark me-2">
                        Télécharger
                    </button>
                </a>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Numéro de carte d'identité : <?php if (empty($data['id_number'])) {
                                                echo 'A completer';
                                            } else {
                                                echo $data['id_number'];
                                            } ?>
            </p>
        </div>
        <div class="userInfosIdCards d-flex flex-column flex-sm-row">
            <p class="userInfosIdCard">
                <img src="<?= './public/assets/idCardFace/' . $data['id_card_face'] ?>" alt="Carte d'identité recto à télécharger">
                <a class="text-decoration-none text-white p-2" href="<?= './public/assets/idCardFace/' . $data['id_card_face'] ?>" download="<?= 'CarteIdentitéRecto-' . $data['name'] . $data['surname'] ?>">
                    <button type="button" href="" class="btn btn-dark me-2">
                        Télécharger
                    </button>
                </a>
            </p>
            <p class="userInfosIdCard">
                <img src="<?= './public/assets/idCardBack/' . $data['id_card_back'] ?>" alt="Carte d'identité verso à télécharger">
                <a class="text-decoration-none text-white p-2" href="<?= './public/assets/idCardBack/' . $data['id_card_back'] ?>" download="<?= 'CarteIdentitéVerso-' . $data['name'] . $data['surname'] ?>">
                    <button type="button" href="" class="btn btn-dark me-2">
                        Télécharger
                    </button>
                </a>
            </p>
        </div>
        <div class="dashboardItems">
            <p>Date d'inscription : <?= $data['creation_date'] ?></p>
        </div>
        <div>
            <a href='./model/deleteUserModel.php?id=<?= $data["id"] ?>' type="button" class="m-3">
                <button class="btn btn-danger text-align-center">
                    Supprimer
                </button>
            </a>
            <a href='./model/modifyActiveUserModel.php?id=<?= $data["id"] ?>' type="button" class="m-3">
                <button class="btn btn-dark text-align-center">
                    Rendre inactif / actif
                </button>
            </a>
            <a href='./model/modifyCanAccessDBModel.php?id=<?= $data["id"] ?>' type="button" class="m-3">
                <button class="btn btn-dark text-align-center">
                    Autoriser / Révoquer l'accès à la base de données
                </button>
            </a>
        </div>
    </div>
</div>

<!-- Etudes du profil. -->
<div id="userSchool" class="border rounded m-2 p-3 text-center">

    <h2 class="display-6">Niveau scolaire</h2>

    <div class="userExpGrid d-flex flex-column flex-md-row">
        <div class="expFirstItem border rounded m-1 p-3">
            <p>Première école : <?php if (empty($data['school_1'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['school_1'];
                                } ?>
            </p>
            <p>Date de début : <?php if (empty($data['school_1_start'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['school_1_start'];
                                } ?>
            </p>
            <p>Date de fin : <?php if (empty($data['school_1_end'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['school_1_end'];
                                } ?>
            </p>
            <div class="userInfosDiplomaCards">
                <p class="userInfosDiplomaCard">
                    Diplôme obtenu :
                    <img src="<?= './public/assets/school1Doc/' . $data['school_1_doc'] ?>" alt="Diplôme à completer">
                    <?php
                    if (!empty($data['school_1_doc'])) {
                    ?>
                        <a class="text-decoration-none text-white p-2" href="<?= './public/assets/school1Doc/' . $data['school_1_doc'] ?>" download="<?= 'Diplome1-' . $data['name'] . $data['surname'] ?>">
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
        if (!empty($data['school_2'])) {
        ?>

            <div class="expSecondItem border rounded m-1 p-3">
                <p>Seconde école : <?php if (empty($data['school_2'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['school_2'];
                                    } ?>
                </p>
                <p>Date de début : <?php if (empty($data['school_2_start'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['school_2_start'];
                                    } ?>
                </p>
                <p>Date de fin : <?php if (empty($data['school_2_end'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['school_2_end'];
                                    } ?>
                </p>
                <div class="userInfosDiplomaCards">
                    <p class="userInfosDiplomaCard">
                        Diplôme obtenu :
                        <img src="<?= './public/assets/school2Doc/' . $data['school_2_doc'] ?>" alt="Diplôme à completer">

                        <?php
                        if (!empty($data['school_2_doc'])) {
                        ?>

                            <a class="text-decoration-none text-white p-2" href="<?= './public/assets/school2Doc/' . $data['school_2_doc'] ?>" download="<?= 'Diplome2-' . $data['name'] . $data['surname'] ?>">
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
        if (!empty($data['school_3'])) {
        ?>

            <div class="expThirdItem border rounded m-1 p-3">
                <p>Troisième école : <?php if (empty($data['school_3'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['school_3'];
                                        } ?>
                </p>
                <p>Date de début : <?php if (empty($data['school_3_start'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['school_3_start'];
                                    } ?>
                </p>
                <p>Date de fin : <?php if (empty($data['school_3_end'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['school_3_end'];
                                    } ?>
                </p>
                <div class="userInfosDiplomaCards">
                    <p class="userInfosDiplomaCard">
                        Diplôme obtenu :
                        <img src="<?= './public/assets/school3Doc/' . $data['school_3_doc'] ?>" alt="Diplôme à completer">

                        <?php
                        if (!empty($data['school_3_doc'])) {
                        ?>

                            <a class="text-decoration-none text-white p-2" href="<?= './public/assets/school3Doc/' . $data['school_3_doc'] ?>" download="<?= 'Diplome2-' . $data['name'] . $data['surname'] ?>">
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

<!-- Expériences professionelles. -->
<div id="userExp" class="border rounded m-2 p-3 text-center">

    <h2 class="display-6">Expérience professionelle</h2>

    <div class="userExpGrid d-flex flex-column flex-md-row">
        <div class="expFirstItem border rounded m-1 p-3">
            <p>Première expérience : <?php if (empty($data['job_1'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['job_1'];
                                        } ?>
            </p>
            <p>Date de début : <?php if (empty($data['job_1_start'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['job_1_start'];
                                } ?>
            </p>
            <p>Date de fin : <?php if (empty($data['job_1_end'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['job_1_end'];
                                } ?>
            </p>
            <p>Missions : <?php if (empty($data['job_1_exp'])) {
                                echo 'A completer';
                            } else {
                                echo $data['job_1_exp'];
                            } ?></p>
        </div>

        <?php
        if (!empty($data['job_2'])) {
        ?>

            <div class="expSecondItem border rounded m-1 p-3">
                <p>Seconde expérience : <?php if (empty($data['job_2'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['job_2'];
                                        } ?>
                </p>
                <p>Date de début : <?php if (empty($data['job_2_start'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['job_2_start'];
                                    } ?>
                </p>
                <p>Date de fin : <?php if (empty($data['job_2_end'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['job_2_end'];
                                    } ?>
                </p>
                <p>Missions : <?php if (empty($data['job_2_exp'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['job_2_exp'];
                                } ?></p>
            </div>

        <?php
        }
        ?>

        <?php
        if (!empty($data['job_3'])) {
        ?>

            <div class="expThirdItem border rounded m-1 p-3">
                <p>Troisième expérience : <?php if (empty($data['job_3'])) {
                                                echo 'A completer';
                                            } else {
                                                echo $data['job_3'];
                                            } ?>
                </p>
                <p>Date de début : <?php if (empty($data['job_3_start'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['job_3_start'];
                                    } ?>
                </p>
                <p>Date de fin : <?php if (empty($data['job_3_end'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['job_3_end'];
                                    } ?>
                </p>
                <p>Missions : <?php if (empty($data['job_3_exp'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['job_3_exp'];
                                } ?></p>
            </div>

        <?php
        }
        ?>
    </div>
</div>

<!-- Contrat au studio des parfums. -->
<div id="userContract" class="border rounded m-2 p-3 text-center">

    <h2 class="display-6" id="experiences">Poste au Studio des Parfums</h2>

    <!-- Type de contrat -->
    <div class="expItems">
        <p>Type de contrat : <?php if (empty($data['contract_type'])) {
                                    echo 'En attente';
                                } else {
                                    echo $data['contract_type'];
                                } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a href="index.php?page=user" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContract">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Date de début -->
    <div class="expItems">
        <p>Date de début du contrat : <?php if (empty($data['contract_start'])) {
                                            echo 'En attente';
                                        } else {
                                            echo $data['contract_start'];
                                        } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractStart">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Date de fin -->
    <div class="expItems">
        <p>Date de fin du contrat : <?php if (empty($data['contract_end'])) {
                                        echo 'En attente';
                                    } else {
                                        echo $data['contract_end'];
                                    } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractEnd">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Niveau -->
    <div class="expItems">
        <p>Niveau : <?php if (empty($data['contract_level'])) {
                        echo 'En attente';
                    } else {
                        echo $data['contract_level'];
                    } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractLevel">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Coef -->
    <div class="expItems">
        <p>Coef : <?php if (empty($data['contract_coef'])) {
                        echo 'En attente';
                    } else {
                        echo $data['contract_coef'];
                    } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractCoef">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Rémunération -->
    <div class="expItems">
        <p>Rémunération à l'heure : <?php if (empty($data['contract_remuneration'])) {
                                        echo 'En attente';
                                    } else {
                                        echo $data['contract_remuneration'] . '€ / Heure';
                                    } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractRemuneration">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Mutuelle -->
    <div class="expItems">
        <p>Mutuelle : <?php if (empty($data['contract_insurance'])) {
                            echo "Aucune mutuelle n'est renseignée";
                        } else {
                            echo $data['contract_insurance'];
                        } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractInsurance">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Numéro de mutuelle -->
    <div class="expItems">
        <p>Numéro de mutuelle : <?php if (empty($data['contract_insurance_number'])) {
                                    echo 'En attente';
                                } else {
                                    echo $data['contract_insurance_number'];
                                } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractInsuranceNumber">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Heures hebdomadaires -->
    <div class="expItems">
        <p>Heures hebdomadaires : <?php if (empty($data['contract_weekly'])) {
                                        echo 'En attente';
                                    } else {
                                        echo $data['contract_weekly'] . 'h / semaines';
                                    } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractWeekly">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>

    <!-- Médecine du travail -->
    <div class="expItems">
        <p>Date de la visite médicale : <?php if (empty($data['work_medicine'])) {
                                        echo 'En attente';
                                    } else {
                                        echo $data['work_medicine'];
                                    } ?></p>
        <button class="btn btn-md btn-light p-2" type="submit">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyWorkMedicine">
                <img src="./public/assets/settings.svg" alt="Modifier">
            </a>
        </button>
    </div>
</div>

<!-- Compte de temps. -->
<div id="userTimeBank" class="border rounded m-2 p-3">

    <h2 class="display-6 text-center" id="experiences">Compte temps</h2>

    <?php
    require('./model/timeAccountModel.php')
    ?>

    <!-- Navigo -->
    <div class="userExpGrid border rounded mt-3 p-3">
        <h4>Navigo : </h4>
        <div class="expFirstItem border rounded m-1 p-3">
            <p>Numéro Navigo : <?php if (empty($data['contract_transports'])) {
                            echo 'En attente';
                        } else {
                            echo $data['contract_transports'];
                        } ?></p>
            <button class="btn btn-md btn-light p-2" type="submit">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyContractTransport">
                    <img src="./public/assets/settings.svg" alt="Modifier">
                </a>
            </button>
            <p>Scan du Navigo : <?php if (empty($data['transport_scan'])) {
                            echo 'En attente';
                        } else {
                            echo $data['transport_scan'];
                        } ?></p>
            <button class="btn btn-md btn-light p-2" type="submit">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyTransportScan">
                    <img src="./public/assets/settings.svg" alt="Modifier">
                </a>
            </button>
        </div>
    </div>

    <!-- Absences. -->
    <div class="contract border rounded mt-3 p-3">

        <h4 class="my-3">Absences</h4>

        <!-- Arrêt -->
        <div class="userExpGrid d-flex flex-column flex-md-row">

            <?php
            if (!$data['user_absence']) {
            ?>
                <p>Aucun arrêt de travail</p>
            <?php
            }
            if ($data['user_absence']) {
            ?>
                <div class="expFirstItem border rounded m-1 p-3">
                    <p>Arrêt de travail : <?= $data['user_absence'] ?> jours</p>
                    <p class="userInfosDiplomaCard">
                        <img src="<?= './public/assets/illnessJustif/' . $data['illness_justif'] ?>" alt="Arrêt de travail">
                        <a class="text-decoration-none text-white p-2" href="<?= './public/assets/illnessJustif/' . $data['illness_justif'] ?>" download="<?= 'ArrêtDeTravail-' . $data['name'] . $data['surname'] ?>">
                            <button type="button" href="" class="btn btn-dark me-2">
                                Télécharger
                            </button>
                        </a>
                    </p>
                    <p>Date de l'arrêt de travail : <?= $data['illness_date'] ?></p>
                </div>

            <?php
            }
            if ($data['user_absence2']) {
            ?>

                <div class="expFirstItem border rounded m-1 p-3">
                    <p>Arrêt de travail : <?= $data['user_absence2'] ?> jours</p>
                    <p class="userInfosDiplomaCard">
                        <img src="<?= './public/assets/illnessJustif2/' . $data['illness_justif2'] ?>" alt="Arrêt de travail">
                        <a class="text-decoration-none text-white p-2" href="<?= './public/assets/illnessJustif2/' . $data['illness_justif2'] ?>" download="<?= 'ArrêtDeTravail-' . $data['name'] . $data['surname'] ?>">
                            <button type="button" href="" class="btn btn-dark me-2">
                                Télécharger
                            </button>
                        </a>
                    </p>
                    <p>Date de l'arrêt de travail : <?= $data['illness_date2'] ?></p>
                </div>

            <?php
            }
            if ($data['user_absence3']) {
            ?>

                <div class="expFirstItem border rounded m-1 p-3">
                    <p>Arrêt de travail : <?= $data['user_absence3'] ?> jours</p>
                    <p class="userInfosDiplomaCard">
                        <img src="<?= './public/assets/illnessJustif3/' . $data['illness_justif3'] ?>" alt="Arrêt de travail">
                        <a class="text-decoration-none text-white p-2" href="<?= './public/assets/illnessJustif3/' . $data['illness_justif3'] ?>" download="<?= 'ArrêtDeTravail-' . $data['name'] . $data['surname'] ?>">
                            <button type="button" href="" class="btn btn-dark me-2">
                                Télécharger
                            </button>
                        </a>
                    </p>
                    <p>Date de l'arrêt de travail : <?= $data['illness_date3'] ?></p>
                </div>

            <?php
            }
            ?>
        </div>

        <?php
        if (!$data['user_absence']) {
        ?>
            <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAbsenceInfo">
                    Déclarer une absence
                </a>
            </button>

        <?php
        }
        if ($data['user_absence']) {
        ?>

            <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAbsenceInfo2">
                    Déclarer une absence
                </a>
            </button>

        <?php
        }
        if ($data['user_absence2']) {
        ?>

            <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAbsenceInfo3">
                    Déclarer une absence
                </a>
            </button>

        <?php
        }
        ?>
    </div>
    <div class="contract border rounded mt-3 p-3">
        <h4 class="my-3">Journées supplémentaires</h4>

        <p>Jours supplémentaire effectués: <?= $data['day_off_bank'] ?> jours</p>

        <!-- Récapitulatif des demandes de RTT. -->
        <div class="userExpGrid d-flex flex-column flex-md-row">

            <?php
            // Exécution de la requête SQL
            $usersDayOff = $bdd->prepare('
                            SELECT *
                            FROM user 
                            INNER JOIN user_exp ON user.id = user_exp.user_exp_id
                            INNER JOIN user_role ON user.id = user_role.user_role_id
                            INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
                            INNER JOIN user_day_off ON user.id = user_day_off.user_day_off_id
                            WHERE user_day_off.user_day_off_id = ?
                        ');
            $usersDayOff->execute([$data['id']]);

            // Récupération des résultats
            $dataDayOff = $usersDayOff->fetchAll();

            // Affichage des résultats
            if (empty($dataDayOff)) {
                echo ('<p>Aucune demande de journée à rattraper</p>');
            }
            foreach ($dataDayOff as $dayOff) {
            ?>

                <div class="expSecondItem border rounded m-1 p-3">
                    <p>Dates de la demande : du <?= $dayOff['day_off'] ?></p>
                    <p>Raison : <?= $dayOff['day_off_desc'] ?></p>
                    <p>
                        <?php
                        if ($dayOff['day_off_response'] == 0) {
                            echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                        } else if ($dayOff['day_off_response'] == 1) {
                            echo '<p class="text-center text-white p-1 border rounded bg-success">Date validée !</p>';
                        } else if ($dayOff['day_off_response'] == 2) {
                            echo '<p class="text-center text-white p-1 border rounded bg-danger">Date refusée.</p>';
                        }
                        ?>
                    </p>
                </div>

            <?php
            }
            ?>
        </div>
        <button class="btn btn-md btn-danger p-2 m-3" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDayOffRequest">
                Faire une demande de repos
            </a>
        </button>

        <button class="btn btn-md btn-dark p-2 m-3" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDayOffBank">
                Déclarer un jour supplémentaire
            </a>
        </button>
    </div>

    <!-- Vacances. -->
    <div class="border rounded mt-3 p-3">
        <h4 class="my-3">Congés</h4>

        <!-- Vacances. -->
                            <!-- Vacances. -->

                            <p>
                                <?php $data['holidays_total'];

                                require('./model/holidaysMathModel.php');

                                ?>
                            </p>
                            <?php
                            // Exécution de la requête SQL
                            $usersHoliday = $bdd->prepare('
                            SELECT *
                            FROM user 
                            INNER JOIN user_exp ON user.id = user_exp.user_exp_id
                            INNER JOIN user_role ON user.id = user_role.user_role_id
                            INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
                            INNER JOIN user_holiday ON user.id = user_holiday.user_holiday_id
                            WHERE user_holiday.user_holiday_id = ?
                        ');
                            $usersHoliday->execute([$data['id']]);

                            // Récupération des résultats
                            $data = $usersHoliday->fetchAll();

                            // Affichage des résultats
                            if (empty($data)) {
                                echo ('<p>Aucune demande de vacances</p>');
                            }
                            foreach ($data as $holiday) {
                            ?>

                                <div class="userExpGrid d-flex flex-column flex-md-row">

                                    <div class="expFirstItem border rounded m-1 p-3">
                                        <!-- <button class="btn btn-md btn-light mb-4">
                                        <a href='./model/deleteHolidayRequest.php?id=
                                        <?= $holiday["user_holiday_id"] ?>
                                        &holiday=<?= $holiday['holiday_start'] ?>' type="button" class="btn btn-infos">
                                            Supprimer la demande
                                        </a>
                                    </button> -->
                                        <p>Dates de la demande : du <?= $holiday['holiday_start'] ?> au <?= $holiday['holiday_end'] ?></p>
                                        <p>Motif : <?= $holiday['holiday_request_text'] ?></p>
                                        <p>
                                            <?php
                                            if ($holiday['holiday_response'] == '0') {
                                                echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                                            } else if ($holiday['holiday_response'] == '1') {
                                                echo '<p class="text-center text-white p-1 border rounded bg-success">Dates validées !</p>';
                                            } else if ($holiday['holiday_response'] == '2') {
                                                echo '<p class="text-center text-white p-1 border rounded bg-danger">Dates refusées.</p>';
                                            }
                                            ?>
                                        </p>
                                    </div>

                                </div>

                            <?php
                            }
                            ?>

            <!-- Temps supplémentaire. -->
            <div class="border rounded mt-3 p-3">
                <h4 class="my-3">Temps supplémentaire</h4>
                <?php
                if ($data['day_off1']) {
                ?>

                    <div class="userExpGrid d-flex flex-column flex-md-row">

                        <div class="expFirstItem border rounded m-1 p-3">
                            <p>Dates de la demande : <?= $data['day_off1'] ?></p>
                            <p>Raison : <?= $data['day_off1_desc'] ?></p>
                            <p>
                                <?php
                                if ($data['day_off_response1'] == 0) {
                                    echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                                } else if ($data['day_off_response1'] == 1) {
                                    echo '<p class="text-center text-white p-1 border rounded bg-success">Dates validées !</p>';
                                } else if ($data['day_off_response1'] == 2) {
                                    echo '<p class="text-center text-white p-1 border rounded bg-danger">Dates refusées.</p>';
                                }
                                ?>
                            </p>
                        </div>

                        <?php
                        if ($data['day_off2']) {
                        ?>

                            <div class="expFirstItem border rounded m-1 p-3">
                                <p>Dates de la demande : <?= $data['day_off2'] ?></p>
                                <p>Raison : <?= $data['day_off2_desc'] ?></p>
                                <p>
                                    <?php
                                    if ($data['day_off_response2'] == 0) {
                                        echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                                    } else if ($data['day_off_response2'] == 1) {
                                        echo '<p class="text-center text-white p-1 border rounded bg-success">Dates validées !</p>';
                                    } else if ($data['day_off_response2'] == 2) {
                                        echo '<p class="text-center text-white p-1 border rounded bg-danger">Dates refusées.</p>';
                                    }
                                    ?>
                                </p>
                            </div>

                        <?php
                        }
                        if ($data['day_off3']) {
                        ?>

                            <div class="expFirstItem border rounded m-1 p-3">
                                <p>Dates de la demande : <?= $data['day_off3'] ?></p>
                                <p>Raison : <?= $data['day_off3_desc'] ?></p>
                                <p>
                                    <?php
                                    if ($data['day_off_response3'] == 0) {
                                        echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                                    } else if ($data['day_off_response3'] == 1) {
                                        echo '<p class="text-center text-white p-1 border rounded bg-success">Dates validées !</p>';
                                    } else if ($data['day_off_response3'] == 2) {
                                        echo '<p class="text-center text-white p-1 border rounded bg-danger">Dates refusées.</p>';
                                    }
                                    ?>
                                </p>
                            </div>

                    <?php
                        }
                    } else {
                        echo ('<p>Aucune demande de repos</p>');
                    }
                    ?>
                    </div>
            </div>
    </div>
</div>
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