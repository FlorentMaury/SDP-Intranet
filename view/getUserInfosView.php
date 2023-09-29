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

<div class="border rounded p-3 text-center">
    <h1>Profil de <?= $data['surname'] ?> <?= $data['name'] ?></h1>

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
        <p>Pays de naissance : <?php if(empty($data['birth_country'])) {echo 'A completer';} else { echo $data['birth_country'];} ?>
        </p>
        <p>Pays de naissance : <?php if(empty($data['birth_country'])) {echo 'A completer';} else { echo $data['birth_country'];} ?>
        </p>
        <p>Numéro de carte vitale : <?php if(empty($data['social_security_number'])) {echo 'A completer';} else { echo $data['social_security_number'];} ?>
        </p>
        <p>Numéro de carte d'identité : <?php if(empty($data['id_number'])) {echo 'A completer';} else { echo $data['id_number'];} ?>
        </p>
        <p>Date d'inscription : <?= $_SESSION['creation_date'] ?></p>
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