<?php

require ('./model/connectionDBModel.php');

// Demande d'informations d'un compte employé'.
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Suppression des informations du véhicule de la base de donnée.
    $req = $bdd->prepare('SELECT * FROM marital_status WHERE id = ?');
    $req->execute([$id]);
    $data = $req->fetch();

    // Modification du titre de la page.
    $title = 'Informations sur ' . $data['name'] . ' ' . $data['surname'] . '';
    // Début d'enregistrement du HTML.
    ob_start();
}

?>

<div class="container my-4 d-flex">
    <button type="button" href="" class="btn btn-dark me-2">
        <a class="text-decoration-none text-white p-2" href="index.php?page=dashboard">Retour au tableau de bord</a>
    </button>
</div>

<h1>Profil de <?= $data['surname'] ?> <?= $data['name'] ?></h1>

<div class="border rounded m-2 p-3 text-center">
    <h2>Informations générales</h2>

    <p>
        <img 
            src="<?= './public/assets/usersImg/'.$data['profile_picture'] ?>" 
            alt="Photo de profil à télécharger"
            class="w-25"
        >
    </p>
    <p>Email : <?= $data['email'] ?></p>
    <p>Prénom : <?= $data['name'] ?>
    </p>
    <p>Nom de famille : <?= $data['surname'] ?>
    </p>
    <p>Date de naissance : <?php if(empty($data['birth_date'])) {echo 'A completer';} else { echo $data['birth_date'];} ?>
    </p>
    <p>Numéro de téléphone : <?php if(empty($data['phone_number'])) {echo 'A completer';} else { echo $data['phone_number'];} ?>
    </p>
    <p>Ville de naissance : <?php if(empty($data['birth_city'])) {echo 'A completer';} else { echo $data['birth_city'];} ?>
    </p>
    <p>Pays de naissance : <?php if(empty($data['birth_country'])) {echo 'A completer';} else { echo $data['birth_country'];} ?>
    </p>
    <p>Numéro de rue actuelle : <?php if(empty($data['current_street_number'])) {echo 'A completer';} else { echo $data['current_street_number'];} ?>
    </p>
    <p>Nom de rue actuelle : <?php if(empty($data['current_city_street'])) {echo 'A completer';} else { echo $data['current_city_street'];} ?>
    </p>
    <p>Ville actuelle : <?php if(empty($data['current_city'])) {echo 'A completer';} else { echo $data['current_city'];} ?>
    </p>
    <p>Code postal : <?php if(empty($data['current_zip_code'])) {echo 'A completer';} else { echo $data['current_zip_code'];} ?>
    </p>
    <p>Pays actuel : <?php if(empty($data['current_country'])) {echo 'A completer';} else { echo $data['current_country'];} ?>
    </p>
    <p>Numéro de carte vitale : <?php if(empty($data['social_security_number'])) {echo 'A completer';} else { echo $data['social_security_number'];} ?>
    </p>
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
    <p>Numéro de carte d'identité : <?php if(empty($data['id_number'])) {echo 'A completer';} else { echo $data['id_number'];} ?>
    </p>
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


<div class="border rounded m-2 p-3 text-center">

    <h2>Niveau scolaire</h2>

    <div class="schoolsGrid">
        <div class="border rounded userInfosSchool1">
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
                        alt="Diplôme à télécharger"
                    >
                    <a 
                        class="text-decoration-none text-white p-2" 
                        href="<?= './public/assets/school1Doc/'.$data['school_1_doc'] ?>" 
                        download="<?= 'Diplome1-'.$data['name'].$data['surname'] ?>"
                    >
                        <button type="button" href="" class="btn btn-dark me-2">
                            Télécharger                   
                        </button>
                    </a>
                </p>
            </div> 
        </div>

        <div class="border rounded userInfosSchool2">
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
                        alt="Diplôme à télécharger"
                    >
                    <a 
                        class="text-decoration-none text-white p-2" 
                        href="<?= './public/assets/school2Doc/'.$data['school_2_doc'] ?>" 
                        download="<?= 'Diplome2-'.$data['name'].$data['surname'] ?>"
                    >
                        <button type="button" href="" class="btn btn-dark me-2">
                            Télécharger                   
                        </button>
                    </a>
                </p>
            </div> 
        </div>
    </div>

</div>

<div class="container my-4 d-flex">
    <button type="button" href="" class="btn btn-dark me-2">
        <a class="text-decoration-none text-white p-2" href="index.php?page=dashboard">Retour au tableau de bord</a>
    </button>
</div>



<?php 

    // Fin de l'enregistrement du HTML.
    $content = ob_get_clean();

    // Intégration à base.php.
    require('base.php');

?>