<?php
// Modification du titre de la page.
$title = 'Tableau De Bord';
// Début d'enregistrement du HTML.
ob_start();

$req = $bdd->prepare('
    SELECT *
    FROM user 
    INNER JOIN user_exp ON user.id = user_exp.user_exp_id
    INNER JOIN user_role ON user.id = user_role.user_role_id
    INNER JOIN user_time_bank ON user.id = user_time_bank.user_time_bank_id
    WHERE user.id = ?
');
$req->execute([$_SESSION['id']]);
$data = $req->fetch();
?>

<!-- Titre dynamique. -->
<h1 class="text-center display-4 mt-3">
    Bienvenue <?= $data['name'] ?>
</h1>

<!-- Navigation dynamique. -->
<nav class="m-3 my-5 text-center">
    <ul class="d-flex justify-content-center align-items-center flex-wrap flex-sm-row">
        <?php
        if ($_SESSION['id'] == 1) {
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
                Banque de temps
            </p>
        </li>
        <li>
            <button type="button" href="" class="btn btn-danger">
                <a class="text-decoration-none text-white p-2" href="index.php?page=logout">Déconnexion</a>
            </button>
        </li>
    </ul>
</nav>

<!-- Grille administrateur. -->
<?php
if ($data['id'] == 1) {
?>

    <!-- Compte administrateur. -->
    <div class="managerView" id="managerViewGrid">
        <!-- Modération collaborateurs. -->
        <div class="employeesList border rounded p-3 my-3">

            <!-- Boutons d'affichage des collaborateurs actifs et inactif. -->
            <div class="text-end mb-3">
                <button class="activeButton btn btn-md btn-light mt-1 p-2">Collaborateurs actifs</button>
                <button class="inactiveButton btn btn-md btn-light mt-1 p-2">Collaborateurs inactifs</button>
            </div>

            <!-- Liste des collaborateurs actifs. -->
            <div id="employeesList">
                <h2 class="display-6 text-center" id="collabList">Liste des collaborateurs actifs</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th class="creationDate">Compte de temps</th>
                            <th>Infos</th>
                        </thead>
                        <tbody>
                            <?php
                            require('./model/connectionDBModel.php');
                            while ($user = $usersValid->fetch()) {
                            ?>
                                <tr>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['surname'] ?></td>
                                    <td class="creationDate">
                                        <?php
                                        if ((floatval($user['user_extra_time'] * 60) - floatval($user['user_delay'] * 60)) >= 0) {
                                            echo '<p class="text-success">' . (floatval($user['user_extra_time'] * 60) - floatval($user['user_delay'] * 60)) . ' minutes</p>';
                                        } else {
                                            echo '<p class="text-danger">' . (floatval($user['user_extra_time'] * 60) - floatval($user['user_delay'] * 60)) . ' minutes</p>';
                                        };
                                        ?>
                                    </td>
                                    <td>
                                        <a href='index.php?page=user&id=<?= $user["id"] ?>&action=generalUserInfosButton' type="button" class="btn btn-info m-1">
                                            <img style="width: 15px" src="./public/assets/infos.svg" alt="Informations">
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

            <!-- Liste des collaborateurs inactifs. -->
            <div id="employeesListInactive">
                <h2 class="display-6 text-center" id="collabList">Liste des collaborateurs inactifs</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th class="creationDate">Date de sortie</th>
                            <th>Plus d'infos</th>
                            <th>Supprimer</th>
                        </thead>
                        <tbody>
                            <?php
                            require('./model/connectionDBModel.php');
                            while ($user = $usersInvalid->fetch()) {
                            ?>
                                <tr>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['surname'] ?></td>
                                    <td class="creationDate"><?= $user['contract_end'] ?></td>
                                    <td>
                                        <a href='index.php?page=user&id=<?= $user["id"] ?>' type="button" class="btn btn-info">
                                            <img style="width: 15px" src="./public/assets/infos.svg" alt="Informations">
                                        </a>
                                    </td>
                                    <td>
                                        <a href='./model/deleteUserModel.php?id=<?= $user["id"] ?>' type="button" class="btn btn-danger">
                                            <img style="width: 15px" src="./public/assets/cross.svg" alt="Image de suppression">
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

            <!-- Ajout d'un nouveau collaborateur. -->
            <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAddUser">Ajouter</a>
            </button>
        </div>

        <!-- Modération vacances. -->
        <div class="employeesList border rounded p-3 my-3">
            <h2 class="display-6 text-center" id="collabList">Vacances à modérer</h2>

            <!-- Première tranche. -->
            <?php
            foreach ($usersHoliday1 as $usersHoliday1) {
                if ($usersHoliday1['holiday1_start'] != NULL) {
            ?>
                    <div class="dashboardItems">
                        <?= $usersHoliday1['name'] . ' ' . $usersHoliday1['surname'] ?>
                        souhaite des vacances du
                        <?= $usersHoliday1['holiday1_start'] ?> au <?= $usersHoliday1['holiday1_end'] ?>
                        <form method="POST" action="index.php?page=dashboard&id=<?= $usersHoliday1['id'] ?>">
                            <p class="d-flex flex-column flex-sm-row form-floating m-2">
                                <!-- Select option 1 ou 0 -->
                                <select type="text" name="holiday1Request" class="form-control" id="holiday1Request">
                                    <label for="holiday1Request">Réponse</label>
                                    <option value="1">Accepter</option>
                                    <option value="2">Refuser</option>
                                </select>
                                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Confirmer</button>
                            </p>
                        </form>
                    </div>

            <?php
                }
            }
            ?>

            <!-- Seconde tranche. -->
            <?php
            foreach ($usersHoliday2 as $usersHoliday2) {
                if ($usersHoliday2['holiday2_start'] != NULL) {
            ?>
                    <div class="dashboardItems">
                        <?= $usersHoliday2['name'] . ' ' . $usersHoliday2['surname'] ?>
                        souhaite des vacances du
                        <?= $usersHoliday2['holiday2_start'] ?> au <?= $usersHoliday2['holiday2_end'] ?>
                        <form method="POST" action="index.php?page=dashboard&id=<?= $usersHoliday2['id'] ?>">
                            <p class="d-flex flex-column flex-sm-row form-floating m-2">
                                <!-- Select option 1 ou 0 -->
                                <select type="text" name="holiday2Request" class="form-control" id="holiday2Request">
                                    <label for="holiday2Request">Réponse</label>
                                    <option value="1">Accepter</option>
                                    <option value="2">Refuser</option>
                                </select>
                                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Confirmer</button>
                            </p>
                        </form>
                    </div>

            <?php
                }
            }
            ?>

            <!-- Troisième tranche. -->
            <?php
            foreach ($usersHoliday3 as $usersHoliday3) {
                if ($usersHoliday3['holiday3_start'] != NULL) {
            ?>
                    <div class="dashboardItems">
                        <?= $usersHoliday3['name'] . ' ' . $usersHoliday3['surname'] ?>
                        souhaite des vacances du
                        <?= $usersHoliday3['holiday3_start'] ?> au <?= $usersHoliday3['holiday3_end'] ?>
                        <form method="POST" action="index.php?page=dashboard&id=<?= $usersHoliday3['id'] ?>">
                            <p class="d-flex flex-column flex-sm-row form-floating m-2">
                                <!-- Select option 1 ou 0 -->
                                <select type="text" name="holiday3Request" class="form-control" id="holiday3Request">
                                    <label for="holiday3Request">Réponse</label>
                                    <option value="1">Accepter</option>
                                    <option value="2">Refuser</option>
                                </select>
                                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Confirmer</button>
                            </p>
                        </form>
                    </div>

            <?php
                }
            }
            ?>

        </div>

        <!-- Modération jours de repos. -->
        <div class="employeesList border rounded p-3 my-3">
            <h2 class="display-6 text-center" id="collabList">Demandes de repos à modérer</h2>

            <!-- Première tranche. -->
            <?php
            foreach ($usersDayOff1 as $usersDayOff1) {
                if ($usersDayOff1['day_off1'] != NULL) {
            ?>
                    <div class="dashboardItems">
                        <p>
                            <?= $usersDayOff1['name'] . ' ' . $usersDayOff1['surname'] ?>
                            souhaite un repos à la date du
                            <?= $usersDayOff1['day_off1'] ?>
                            </br>
                            Pour la raison suivante : <?= $usersDayOff1['day_off1_desc'] ?>
                        </p>
                        <form method="POST" action="index.php?page=dashboard&id=<?= $usersDayOff1['id'] ?>">
                            <p class="d-flex flex-column flex-sm-row form-floating m-2">
                                <!-- Selectionner option 1 ou 0 -->
                                <select type="text" name="dayOff1Request" class="form-control" id="dayOff1Request">
                                    <label for="dayOff1Request">Réponse</label>
                                    <option value="1">Accepter</option>
                                    <option value="2">Refuser</option>
                                </select>
                                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Confirmer</button>
                            </p>
                        </form>
                    </div>

            <?php
                }
            }
            ?>

            <!-- Seconde tranche. -->
            <?php
            foreach ($usersDayOff2 as $usersDayOff2) {
                if ($usersDayOff2['day_off2'] != NULL) {
            ?>
                    <div class="dashboardItems">
                        <?= $usersDayOff2['name'] . ' ' . $usersDayOff2['surname'] ?>
                        souhaite un repos à la date du
                        <?= $usersDayOff2['day_off2'] ?>
                        <form method="POST" action="index.php?page=dashboard&id=<?= $usersDayOff2['id'] ?>">
                            <p class="d-flex flex-column flex-sm-row form-floating m-2">
                                <!-- Selectionner option 1 ou 0 -->
                                <select type="text" name="dayOff2Request" class="form-control" id="dayOff2Request">
                                    <label for="dayOff2Request">Réponse</label>
                                    <option value="1">Accepter</option>
                                    <option value="2">Refuser</option>
                                </select>
                                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Confirmer</button>
                            </p>
                        </form>
                    </div>

            <?php
                }
            }
            ?>

            <!-- Troisième tranche. -->
            <?php
            foreach ($usersDayOff3 as $usersDayOff3) {
                if ($usersDayOff3['day_off3'] != NULL) {
            ?>
                    <div class="dashboardItems">
                        <?= $usersDayOff3['name'] . ' ' . $usersDayOff3['surname'] ?>
                        souhaite un repos à la date du
                        <?= $usersDayOff3['day_off3'] ?>
                        <form method="POST" action="index.php?page=dashboard&id=<?= $usersDayOff3['id'] ?>">
                            <p class="d-flex flex-column flex-sm-row form-floating m-2">
                                <!-- Selectionner option 1 ou 0 -->
                                <select type="text" name="dayOff3Request" class="form-control" id="dayOff3Request">
                                    <label for="dayOff3Request">Réponse</label>
                                    <option value="1">Accepter</option>
                                    <option value="2">Refuser</option>
                                </select>
                                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Confirmer</button>
                            </p>
                        </form>
                    </div>

            <?php
                }
            }
            ?>
        </div>
    </div>

<?php
}
?>

<!-- Informations personnelles. -->
<div id="generalInfos" class="border rounded mt-3 p-3">

    <h2 class="display-6 text-center" id="userInfos">Informations personnelles</h2>

    <div class="userInfosGrid">
        <div class="1" id="userInfos1">
            <div class="border rounded mt-3 p-3">
                <h4 class="display-6">Informations générales</h4>
                <!-- Image de profil -->
                <div class="dashboardItems">
                    <p>
                        <?php
                        if (empty($data['profile_picture'])) {
                        ?>
                            <img src="./public/assets/usersImg/userBlankImg/user_blank.webp" alt="Photo de profil à modifier" class="w-25">
                            <?php
                        }
                            else {
                            ?>
                            <img src="<?= './public/assets/usersImg/' . $data['profile_picture'] ?>" alt="Photo de profil à télécharger" class="w-25">
                        <?php
                        }
                        ?>
                    </p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyProfilePicture">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <!-- Email -->
                <div class="dashboardItems">
                    <p>Email : <?= $data['email'] ?></p>
                </div>

                <!-- Email -->
                <div class="dashboardItems">
                    <p>Modifier mot de passe</p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPasswordInfo">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

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
                    <p>Date de naissance : <?php if (empty($data['birth_date'])) {
                                                echo 'A completer';
                                            } else {
                                                echo $data['birth_date'];
                                            } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyBirthInfo">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <!-- Numéro de téléphone -->
                <div class="dashboardItems">
                    <p>Numéro de téléphone : <?php if (empty($data['phone_number'])) {
                                                    echo 'A completer';
                                                } else {
                                                    echo $data['phone_number'];
                                                } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPhoneInfo">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <!-- Ville de naissance -->
                <div class="dashboardItems">
                    <p>Ville de naissance : <?php if (empty($data['birth_city'])) {
                                                echo 'A completer';
                                            } else {
                                                echo $data['birth_city'];
                                            } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#birthCity">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <!-- Pays de naissance -->
                <div class="dashboardItems">
                    <p>Pays de naissance : <?php if (empty($data['birth_country'])) {
                                                echo 'A completer';
                                            } else {
                                                echo $data['birth_country'];
                                            } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#birthCountry">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
            </div>

            <div class="border rounded mt-3 p-3">
                <h4 class="display-6">Coordonnées</h4>
                <!-- Numéro de rue actuelle -->
                <div class="dashboardItems">
                    <p>Numéro de rue actuelle : <?php if (empty($data['current_street_number'])) {
                                                    echo 'A completer';
                                                } else {
                                                    echo $data['current_street_number'];
                                                } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentStreetNumber">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <!-- Nom de rue actuelle -->
                <div class="dashboardItems">
                    <p>Nom de rue actuelle : <?php if (empty($data['current_city_street'])) {
                                                    echo 'A completer';
                                                } else {
                                                    echo $data['current_city_street'];
                                                } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentStreetName">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <!-- Ville actuelle -->
                <div class="dashboardItems">
                    <p>Ville actuelle : <?php if (empty($data['current_city'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['current_city'];
                                        } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentCity">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <!-- Code postal -->
                <div class="dashboardItems">
                    <p>Code postal : <?php if (empty($data['current_zip_code'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['current_zip_code'];
                                        } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyZipCode">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <!-- Pays actuel -->
                <div class="dashboardItems">
                    <p>Pays actuel : <?php if (empty($data['current_country'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['current_country'];
                                        } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurrentCountry">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
            </div>

        </div>
        <div class="2" id="userInfos2">

            <div class="border rounded mt-3 p-3">
                <h4 class="display-6">Documents</h4>

                <!-- Curriculum vitæ -->
                <div class="userInfosInsuranceCard">
                    <p class="text-center"> CV:
                        <img src="<?= './public/assets/curriculumVitae/' . $data['curriculum_vitae'] ?>" alt="Curriculum vitæ à télécharger">
                        <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyCurriculumVitae">
                                Modifier
                            </a>
                        </button>
                    </p>
                </div>

                <!-- Numéro de sécurité sociale -->
                <div class="dashboardItems">
                    <p>Numéro de carte vitale : <?php if (empty($data['social_security_number'])) {
                                                    echo 'A completer';
                                                } else {
                                                    echo $data['social_security_number'];
                                                } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#socialSecurityNumber">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <div class="userInfosInsuranceCards d-flex flex-column flex-sm-row">
                    <!-- Carte vitale de face -->
                    <p class="userInfosInsuranceCard">
                        <img src="<?= './public/assets/insuranceCardFace/' . $data['insurance_card_face'] ?>" alt="Carte vitale de face à télécharger">
                        <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyInsuranceCardFace">
                                Modifier
                            </a>
                        </button>
                    </p>

                    <!-- Carte vitale de dos -->
                    <p class="userInfosInsuranceCard">
                        <img src="<?= './public/assets/insuranceCardBack/' . $data['insurance_card_back'] ?>" alt="Carte vitale de dos à télécharger">
                        <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyInsuranceCardBack">
                                Modifier
                            </a>
                        </button>
                    </p>
                </div>

                <!-- Numéro de carte d'identité -->
                <div class="dashboardItems">
                    <p>Numéro de carte d'identité : <?php if (empty($data['id_number'])) {
                                                        echo 'A completer';
                                                    } else {
                                                        echo $data['id_number'];
                                                    } ?></p>
                    <button class="btn btn-md btn-light mt-1 p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#idNumber">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>

                <div class="userInfosIdCards d-flex flex-column flex-sm-row">
                    <!-- Carte d'identité de face -->
                    <p class="userInfosIdCard">
                        <img src="<?= './public/assets/idCardFace/' . $data['id_card_face'] ?>" alt="Carte d'identité de face à télécharger">
                        <button class="btn btn-md btn-dark mt-1 p-2" type="submit">
                            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyIdCardFace">
                                Modifier
                            </a>
                        </button>
                    </p>

                    <!-- Carte d'identité de dos -->
                    <p class="userInfosIdCard">
                        <img src="<?= './public/assets/idCardBack/' . $data['id_card_back'] ?>" alt="Carte d'identité de dos à télécharger">
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
</div>

<!-- Expériences. -->
<div id="experiences" class="border rounded mt-3 p-3">

    <h2 class="display-6 text-center" id="experiences">Diplômes</h2>

    <div class="userExpGrid d-flex flex-column flex-md-row">

        <div class="expFirstItem border rounded mt-3 p-3">
            <div class="expItems">
                <p>Ecole : <?php if (empty($data['school_1'])) {
                                echo 'A completer';
                            } else {
                                echo $data['school_1'];
                            } ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if (empty($data['school_1_start'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['school_1_start'];
                                    } ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1Start">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if (empty($data['school_1_end'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['school_1_end'];
                                    } ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool1End">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>
                    <?php
                    if (empty($data['school_1_doc'])) {
                        echo 'Diplôme obtenu à télécharger';
                    } else {
                    ?>
                        <img src="<?= './public/assets/school1Doc/' . $data['school_1_doc'] ?>" alt="Diplôme obtenu à télécharger">
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
        if ($data['school_1']) {
        ?>

            <div class="expSecondItem border rounded mt-3 p-3">
                <div class="expItems">
                    <p>Seconde école : <?php if (empty($data['school_2'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['school_2'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Date de début : <?php if (empty($data['school_2_start'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['school_2_start'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2Start">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Date de fin : <?php if (empty($data['school_2_end'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['school_2_end'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2End">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>
                        <?php
                        if (empty($data['school_2_doc'])) {
                            echo 'Diplôme obtenu à télécharger';
                        } else {
                        ?>
                            <img src="<?= './public/assets/school2Doc/' . $data['school_2_doc'] ?>" alt="Second diplôme obtenu à télécharger" class="w-25">
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
        if ($data['school_2']) {
        ?>

            <div class="expThirdItem border rounded mt-3 p-3">
                <div class="expItems">
                    <p>Troisième école : <?php if (empty($data['school_3'])) {
                                                echo 'A completer';
                                            } else {
                                                echo $data['school_3'];
                                            } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Date de début : <?php if (empty($data['school_3_start'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['school_3_start'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2Start">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Date de fin : <?php if (empty($data['school_3_end'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['school_3_end'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifySchool2End">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>
                        <?php
                        if (empty($data['school_3_doc'])) {
                            echo 'Diplôme obtenu à télécharger';
                        } else {
                        ?>
                            <img src="<?= './public/assets/school3Doc/' . $data['school_3_doc'] ?>" alt="Second diplôme obtenu à télécharger" class="w-25">
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

    <h2 class="display-6 text-center my-3">Expérience professionelle</h2>

    <div class="userExpGrid d-flex flex-column flex-md-row">

        <div class="expFirstItem border rounded mt-3 p-3">
            <div class="expItems">
                <p>Expérience professionelle : <?php if (empty($data['job_1'])) {
                                                    echo 'A completer';
                                                } else {
                                                    echo $data['job_1'];
                                                } ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de début : <?php if (empty($data['job_1_start'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['job_1_start'];
                                    } ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1Start">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Date de fin : <?php if (empty($data['job_1_end'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['job_1_end'];
                                    } ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1End">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
            <div class="expItems">
                <p>Missions : <?php if (empty($data['job_1_exp'])) {
                                    echo 'A completer';
                                } else {
                                    echo $data['job_1_exp'];
                                } ?></p>
                <button class="btn btn-md btn-light p-2" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob1Exp">
                        <img src="./public/assets/settings.svg" alt="Modifier">
                    </a>
                </button>
            </div>
        </div>

        <?php
        if ($data['job_1']) {
        ?>

            <div class="expSecondItem border rounded mt-3 p-3">
                <div class="expItems">
                    <p>Seconde expérience professionelle : <?php if (empty($data['job_2'])) {
                                                                echo 'A completer';
                                                            } else {
                                                                echo $data['job_2'];
                                                            } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Date de début : <?php if (empty($data['job_2_start'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['job_2_start'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2Start">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Date de fin : <?php if (empty($data['job_2_end'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['job_2_end'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob2End">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Missions : <?php if (empty($data['job_2_exp'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['job_2_exp'];
                                    } ?></p>
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
        if ($data['job_2']) {
        ?>

            <div class="expThirdItem border rounded mt-3 p-3">
                <div class="expItems">
                    <p>Troisième expérience professionelle : <?php if (empty($data['job_3'])) {
                                                                    echo 'A completer';
                                                                } else {
                                                                    echo $data['job_3'];
                                                                } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Date de début : <?php if (empty($data['job_3_start'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['job_3_start'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3Start">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Date de fin : <?php if (empty($data['job_3_end'])) {
                                            echo 'A completer';
                                        } else {
                                            echo $data['job_3_end'];
                                        } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3End">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
                <div class="expItems">
                    <p>Missions : <?php if (empty($data['job_3_exp'])) {
                                        echo 'A completer';
                                    } else {
                                        echo $data['job_3_exp'];
                                    } ?></p>
                    <button class="btn btn-md btn-light p-2" type="submit">
                        <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyJob3Exp">
                            <img src="./public/assets/settings.svg" alt="Modifier">
                        </a>
                    </button>
                </div>
            </div>


        <?php
        }
        ?>

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

</div>

<!-- Contrat dans l'entreprise. -->
<div id="contract" class="border rounded mt-3 p-3">

    <h2 class="display-6 text-center" id="statut">Poste au Studio des Parfums</h2>

    <div class="contract border rounded mt-3 p-3">

        <!-- Type de contrat. -->
        <div>
            <p>Type de contrat : <?php if (empty($data['contract_type'])) {
                                        echo 'En attente';
                                    } else {
                                        echo $data['contract_type'];
                                    } ?></p>
        </div>

        <!-- Date de début. -->
        <div>
            <p>Date de début du contrat : <?php if (empty($data['contract_start'])) {
                                                echo 'En attente';
                                            } else {
                                                echo $data['contract_end'];
                                            } ?></p>
        </div>

        <!-- Date de fin. -->
        <div>
            <p>Date de fin du contrat : <?php if (empty($data['contract_end'])) {
                                            echo 'En attente';
                                        } else {
                                            echo $data['contract_end'];
                                        } ?></p>
        </div>

        <!-- Niveau. -->
        <div>
            <p>Niveau : <?php if (empty($data['contract_level'])) {
                            echo 'En attente';
                        } else {
                            echo $data['contract_level'];
                        } ?></p>
        </div>

        <!-- Coef. -->
        <div>
            <p>Coef : <?php if (empty($data['contract_coef'])) {
                            echo 'En attente';
                        } else {
                            echo $data['contract_coef'];
                        } ?></p>
        </div>

        <!-- Rémunération. -->
        <div>
            <p>Rémunération : <?php if (empty($data['contract_remuneration'])) {
                                    echo 'En attente';
                                } else {
                                    echo $data['contract_remuneration'];
                                } ?></p>
        </div>

        <!-- Mutuelle. -->
        <div>
            <p>Mutuelle : <?php if (empty($data['contract_insurance'])) {
                                echo 'Aucune mutuelle n\est renseignée';
                            } else {
                                echo $data['contract_insurance'];
                            } ?></p>
        </div>

        <!-- Numéro de mutuelle. -->
        <div>
            <p>Numéro de mutuelle : <?php if (empty($data['contract_insurance_number'])) {
                                        echo 'En attente';
                                    } else {
                                        echo $data['contract_insurance_number'];
                                    } ?></p>
        </div>

        <!-- Heures hebdomadaires. -->
        <div>
            <p>Heures hebdomadaires : <?php if (empty($data['contract_weekly'])) {
                                            echo 'En attente';
                                        } else {
                                            echo $data['contract_weekly'];
                                        } ?></p>
        </div>

        <!-- Navigo. -->
        <div>
            <p>Navigo : <?php if (empty($data['contract_transports'])) {
                            echo 'En attente';
                        } else {
                            echo $data['contract_transports'];
                        } ?></p>
        </div>
    </div>
</div>

<!-- Compte de temps. -->
<div id="timeBank" class="border rounded mt-3 p-3">

    <h2 class="display-6 text-center" id="events">Compte de temps</h2>

    <?php
    require('./model/timeAccountModel.php')
    ?>

    <!-- Banque de temps (RTT). -->
    <div class="contract border rounded mt-3 p-3">
        <h4 class="my-3">Journées supplémentaires</h4>

        <p>Jours supplémentaire effectué: <?= $data['day_off_bank'] ?> jours</p>

        <!-- Récapitulatif des demandes de RTT. -->
        <div class="userExpGrid d-flex flex-column flex-md-row">

            <?php
            if ($data['day_off1']) {
            ?>

                <div class="expFirstItem border rounded m-1 p-3">
                    <button class="btn btn-md btn-light mb-4">
                        <a href='./model/deleteDayOffRequest.php?id=<?= $data["id"] ?>&dayOff1=<?= $data['day_off1'] ?>' type="button" class="btn btn-infos">
                            Supprimer la demande
                        </a>
                    </button>
                    <p>Dates de la demande : du <?= $data['day_off1'] ?></p>
                    <p>Raison : <?= $data['day_off1_desc'] ?></p>
                    <p>
                        <?php
                        if ($data['day_off_response1'] == 0) {
                            echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                        } else if ($data['day_off_response1'] == 1) {
                            echo '<p class="text-center text-white p-1 border rounded bg-success">Date validée !</p>';
                        } else if ($data['day_off_response1'] == 2) {
                            echo '<p class="text-center text-white p-1 border rounded bg-danger">Date refusée.</p>';
                        }
                        ?>
                    </p>
                </div>

            <?php
            }
            if ($data['day_off2']) {
            ?>

                <div class="expSecondItem border rounded m-1 p-3">
                    <button class="btn btn-md btn-light mb-4">
                        <a href='./model/deleteDayOffRequest.php?id=<?= $data["id"] ?>&dayOff2=<?= $data['day_off2'] ?>' type="button" class="btn btn-infos">
                            Supprimer la demande
                        </a>
                    </button>
                    <p>Dates de la demande : du <?= $data['day_off2'] ?></p>
                    <p>Raison : <?= $data['day_off2_desc'] ?></p>
                    <p>
                        <?php
                        if ($data['day_off_response2'] == 0) {
                            echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                        } else if ($data['day_off_response2'] == 1) {
                            echo '<p class="text-center text-white p-1 border rounded bg-success">Date validée !</p>';
                        } else if ($data['day_off_response2'] == 2) {
                            echo '<p class="text-center text-white p-1 border rounded bg-danger">Date refusée.</p>';
                        }
                        ?>
                    </p>
                </div>

            <?php
            }
            if ($data['day_off3']) {
            ?>

                <div class="expThirdItem border rounded m-1 p-3">
                    <button class="btn btn-md btn-light mb-4">
                        <a href='./model/deleteDayOffRequest.php?id=<?= $data["id"] ?>&dayOff3=<?= $data['day_off3'] ?>' type="button" class="btn btn-infos">
                            Supprimer la demande
                        </a>
                    </button>
                    <p>Dates de la demande : du <?= $data['day_off3'] ?></p>
                    <p>Raison : <?= $data['day_off3_desc'] ?></p>
                    <p>
                        <?php
                        if ($data['day_off_response3'] == 0) {
                            echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                        } else if ($data['day_off_response3'] == 1) {
                            echo '<p class="text-center text-white p-1 border rounded bg-success">Date validée !</p>';
                        } else if ($data['day_off_response3'] == 2) {
                            echo '<p class="text-center text-white p-1 border rounded bg-danger">Date refusée.</p>';
                        }
                        ?>
                    </p>
                </div>

            <?php
            } else if (!$data['day_off1'] && !$data['day_off2'] && !$data['day_off3']) {
                echo ('<p>Aucune demande de repos</p>');
            }
            ?>
        </div>

        <?php
        if (!$data['day_off1'] && $data['day_off_bank'] >= 1) {
        ?>
            <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDayOffRequest1">
                    Faire une demande de repos
                </a>
            </button>
        <?php
        } else if ($data['day_off1'] && !$data['day_off2'] && $data['day_off_bank'] >= 1) {
        ?>
            <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDayOffRequest2">
                    Faire une demande de repos
                </a>
            </button>

        <?php
        } else if ($data['day_off2'] && $data['day_off_bank'] >= 1) {
        ?>
            <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDayOffRequest3">
                    Faire une demande de repos
                </a>
            </button>
        <?php
        }
        ?>

        <button class="btn btn-md btn-dark p-2 m-3" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyDayOffBank">
                Déclarer un jour supplémentaire
            </a>
        </button>
    </div>

    <!-- Absences. -->
    <div class="contract border rounded mt-3 p-3">
        <h4 class="my-3">Absences</h4>

        <!-- Arrêt. -->
        <?php
        if (!$data['user_absence']) {
        ?>

            <p>Aucun arrêt de travail</p>

        <?php
        }
        if ($data['user_absence']) {
        ?>

            <div class="userExpGrid d-flex flex-column flex-md-row">

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

            <!-- <button class="btn btn-md btn-danger p-2 m-3" type="submit">
            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAddAbsence">
                Ajouter une absence
            </a>
        </button> -->
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
            } else if ($data['user_absence']) {
            ?>
                <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAbsenceInfo2">
                        Déclarer une absence
                    </a>
                </button>
            <?php
            } else if ($data['user_absence2']) {
            ?>
                <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAbsenceInfo3">
                        Déclarer une absence
                    </a>
                </button>
            <?php
            } else if ($data['user_absence3']) {
            ?>
                <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyAbsenceInfo4">
                        Déclarer une absence
                    </a>
                </button>
            <?php
            }
            ?>


            <!-- Absences plannifiées. -->
            <div class="contract border rounded mt-3 p-3">
                <h4 class="my-3">Absences plannifiée</h4>

                <!-- Arrêt. -->
                <?php
                if (!$data['planned_illness_1']) {
                ?>

                    <p>Aucune absence n'est plannifiée</p>

                <?php
                }
                if ($data['planned_illness_1']) {
                ?>

                    <div class="userExpGrid d-flex flex-column flex-md-row">

                        <div class="expFirstItem border rounded m-1 p-3">
                            <p>Absence prévue : <?= $data['planned_illness_1'] ?> jours</p>
                            <p class="userInfosDiplomaCard">
                                <img src="<?= './public/assets/plannedIllnessJustif1/' . $data['planned_illness_1_justif'] ?>" alt="Absence prévue">
                                <a class="text-decoration-none text-white p-2" href="<?= './public/assets/plannedIllnessJustif1/' . $data['planned_illness_1_justif'] ?>" download="<?= 'AbsencePrevue-' . $data['name'] . $data['surname'] ?>">
                                    <button type="button" href="" class="btn btn-dark me-2">
                                        Télécharger
                                    </button>
                                </a>
                            </p>
                            <p>Date de l'absence prévue : <?= $data['planned_illness_1_date'] ?></p>
                        </div>

                    <?php
                }
                if ($data['planned_illness_2']) {
                    ?>

                        <div class="expFirstItem border rounded m-1 p-3">
                            <p>Absence prévue : <?= $data['planned_illness_2'] ?> jours</p>
                            <p class="userInfosDiplomaCard">
                                <img src="<?= './public/assets/plannedIllnessJustif2/' . $data['planned_illness_2_justif'] ?>" alt="Absence prévue">
                                <a class="text-decoration-none text-white p-2" href="<?= './public/assets/plannedIllnessJustif2/' . $data['planned_illness_2_justif'] ?>" download="<?= 'AbsencePrevue-' . $data['name'] . $data['surname'] ?>">
                                    <button type="button" href="" class="btn btn-dark me-2">
                                        Télécharger
                                    </button>
                                </a>
                            </p>
                            <p>Date de l'absence prévue : <?= $data['planned_illness_2_date'] ?></p>
                        </div>

                    <?php
                }
                if ($data['planned_illness_3']) {
                    ?>

                        <div class="expFirstItem border rounded m-1 p-3">
                            <p>Absence prévue : <?= $data['planned_illness_3'] ?> jours</p>
                            <p class="userInfosDiplomaCard">
                                <img src="<?= './public/assets/plannedIllnessJustif3/' . $data['planned_illness_3_justif'] ?>" alt="Absence prévue">
                                <a class="text-decoration-none text-white p-2" href="<?= './public/assets/plannedIllnessJustif3/' . $data['planned_illness_3_justif'] ?>" download="<?= 'AbsencePrevue-' . $data['name'] . $data['surname'] ?>">
                                    <button type="button" href="" class="btn btn-dark me-2">
                                        Télécharger
                                    </button>
                                </a>
                            </p>
                            <p>Date de l'absence prévue : <?= $data['planned_illness_3_date'] ?></p>
                        </div>

                    <?php
                }
                    ?>

                    </div>

                    <?php
                    if (!$data['planned_illness_1']) {
                    ?>
                        <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPlannedAbsenceInfo">
                                Plannifier une absence
                            </a>
                        </button>
                    <?php
                    } else if ($data['planned_illness_1']) {
                    ?>
                        <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPlannedAbsenceInfo2">
                                Plannifier une absence
                            </a>
                        </button>
                    <?php
                    } else if ($data['planned_illness_2']) {
                    ?>
                        <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPlannedAbsenceInfo3">
                                Plannifier une absence
                            </a>
                        </button>
                    <?php
                    } else if ($data['planned_illness_3']) {
                    ?>
                        <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                            <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyPlannedAbsenceInfo4">
                                Plannifier une absence
                            </a>
                        </button>
                    <?php
                    }
                    ?>

                    <!-- Vacances. -->
                    <div class="contract border rounded mt-3 p-3">
                        <h4 class="my-3">Congés</h4>

                        <!-- Vacances. -->

                        <p>
                            <?php $data['holidays_total'];

                            require('./model/holidaysMathModel.php');

                            ?>
                        </p>

                        <?php
                        if ($data['holiday1_start']) {
                        ?>

                            <div class="userExpGrid d-flex flex-column flex-md-row">

                                <div class="expFirstItem border rounded m-1 p-3">
                                    <button class="btn btn-md btn-light mb-4">
                                        <a href='./model/deleteHolidayRequest.php?id=<?= $data["id"] ?>&holiday1=<?= $data['holiday1_start'] ?>' type="button" class="btn btn-infos">
                                            Supprimer la demande
                                        </a>
                                    </button>
                                    <p>Dates de la demande : du <?= $data['holiday1_start'] ?> au <?= $data['holiday1_end'] ?></p>
                                    <p>
                                        <?php
                                        if ($data['holiday1_response'] == 0) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                                        } else if ($data['holiday1_response'] == 1) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-success">Dates validées !</p>';
                                        } else if ($data['holiday1_response'] == 2) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-danger">Dates refusées.</p>';
                                        }
                                        ?>
                                    </p>
                                </div>

                            <?php
                        }
                        if ($data['holiday2_start']) {
                            ?>

                                <div class="expSecondItem border rounded m-1 p-3">
                                    <button class="btn btn-md btn-light mb-4">
                                        <a href='./model/deleteHolidayRequest.php?id=<?= $data["id"] ?>&holiday2=<?= $data['holiday2_start'] ?>' type="button" class="btn btn-infos">
                                            Supprimer la demande
                                        </a>
                                    </button>
                                    <p>Dates de la demande : du <?= $data['holiday2_start'] ?> au <?= $data['holiday2_end'] ?></p>
                                    <p>
                                        <?php
                                        if ($data['holiday2_response'] == 0) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                                        } else if ($data['holiday2_response'] == 1) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-success">Dates validées !</p>';
                                        } else if ($data['holiday2_response'] == 2) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-danger">Dates refusées.</p>';
                                        }
                                        ?>
                                    </p>
                                </div>

                            <?php
                        }
                        if ($data['holiday3_start']) {
                            ?>

                                <div class="expThirdItem border rounded m-1 p-3">
                                    <button class="btn btn-md btn-light mb-4">
                                        <a href='./model/deleteHolidayRequest.php?id=<?= $data["id"] ?>&holiday3=<?= $data['holiday3_start'] ?>' type="button" class="btn btn-infos">
                                            Supprimer la demande
                                        </a>
                                    </button>
                                    <p>Dates de la demande : du <?= $data['holiday3_start'] ?> au <?= $data['holiday3_end'] ?></p>
                                    <p>
                                        <?php
                                        if ($data['holiday3_response'] == 0) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-info">En attente de validation.</p>';
                                        } else if ($data['holiday3_response'] == 1) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-success">Dates validées !</p>';
                                        } else if ($data['holiday3_response'] == 2) {
                                            echo '<p class="text-center text-white p-1 border rounded bg-danger">Dates refusées.</p>';
                                        }
                                        ?>
                                    </p>
                                </div>

                            <?php
                        } else if (!$data['holiday1_start'] && !$data['holiday2_start'] && !$data['holiday3_start']) {
                            echo ('<p>Aucune demande de congés</p>');
                        }
                            ?>

                            </div>

                            <?php
                            if (!$data['holiday1_start']) {
                            ?>
                                <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyHolidayRequest1">
                                        Faire une demande de vacances
                                    </a>
                                </button>
                            <?php
                            } else if ($data['holiday1_start'] && !$data['holiday2_start']) {
                            ?>
                                <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyHolidayRequest2">
                                        Faire une demande de vacances
                                    </a>
                                </button>

                            <?php
                            } else if ($data['holiday2_start']) {
                            ?>
                                <button class="btn btn-md btn-danger p-2 m-3" type="submit">
                                    <a href="#connect" class="nav-link" data-bs-toggle="modal" data-bs-target="#modifyHolidayRequest3">
                                        Faire une demande de vacances
                                    </a>
                                </button>
                            <?php
                            }
                            ?>

                    </div>
            </div>
    </div>
</div>
</div>

<!-- Javascript dynamique. -->
<?php
    if ($data['id'] == 1) {
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