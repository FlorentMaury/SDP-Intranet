<!-- Modale de modification du Prénom. -->
<div class="modal fade" id="modifyNameInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le prénom</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="modifyName" class="form-control" id="modifyName" placeholder="<?= $_SESSION['name'] ?>">
                    <label for="modifyName">Prénom</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du Nom. -->
<div class="modal fade" id="modifySurnameInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le nom</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="modifySurname" class="form-control" id="modifySurname" placeholder="<?= $_SESSION['surname'] ?>">
                    <label for="modifySurname">Nom</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la date de naissance. -->
<div class="modal fade" id="modifyBirthInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier la date de naissance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="modifyBirth" class="form-control" id="modifyBirth" placeholder="<?= $_SESSION['birth_date'] ?>">
                    <label for="modifyBirth">Date de naissance</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du numéro de téléphone. -->
<div class="modal fade" id="modifyPhoneInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le numéro de téléphone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="number" name="modifyPhone" class="form-control" id="modifyPhone" placeholder="<?= $_SESSION['phone_number'] ?>">
                    <label for="modifyPhone">Numéro de téléphone</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du numéro de carte vitale. -->
<div class="modal fade" id="socialSecurityNumber" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le numéro de carte vitale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="number" name="socialSecurityNumber" class="form-control" id="socialSecurityNumber" placeholder="<?= $_SESSION['social_security_number'] ?>">
                    <label for="socialSecurityNumber">Numéro de carte vitale</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du numéro de carte d'identité. -->
<div class="modal fade" id="idNumber" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le numéro de carte d'identité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="number" name="idNumber" class="form-control" id="idNumber" placeholder="<?php $_SESSION['id_number'] ?>">
                    <label for="idNumber">Numéro de carte d'identité</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la ville de naissance. -->
<div class="modal fade" id="birthCity" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier la ville de naissance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="birthCity" class="form-control" id="birthCity" placeholder="<?= $_SESSION['birth_city'] ?>">
                    <label for="birthCity">Ville de naissance</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du pays de naissance. -->
<div class="modal fade" id="birthCountry" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le pays de naissance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="birthCountry" class="form-control" id="birthCountry" placeholder="<?= $_SESSION['birth_country'] ?>">
                    <label for="birthCountry">Pays de naissance</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du numéro de rue actuelle. -->
<div class="modal fade" id="modifyCurrentStreetNumber" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le numéro de rue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="currentStreetNumber" class="form-control" id="currentStreetNumber" placeholder="<?= $_data['current_street_number'] ?>">
                    <label for="currentStreetNumber">Numéro de rue</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de l'image de profil. -->
<div class="modal fade" id="modifyProfilePicture" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier l'image de profil'</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <input type="file" name="profilePicture" class="form-control" id="profilePicture">
                    <label for="profilePicture">Image de profil</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du nom de rue actuelle. -->
<div class="modal fade" id="modifyCurrentStreetName" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le nom de la rue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="currentStreetName" class="form-control" id="currentStreetName">
                    <label for="currentStreetName">Nom de rue</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la ville actuelle. -->
<div class="modal fade" id="modifyCurrentCity" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier la ville</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="currentCity" class="form-control" id="currentCity">
                    <label for="currentCity">Ville</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la ville actuelle. -->
<div class="modal fade" id="modifyZipCode" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le code postal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="number" name="currentZipCode" class="form-control" id="currentZipCode">
                    <label for="currentZipCode">Code postal</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du pays actuel. -->
<div class="modal fade" id="modifyCurrentCountry" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le pays</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="currentCountry" class="form-control" id="currentCountry">
                    <label for="currentCountry">Pays</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la carte vitale de face. -->
<div class="modal fade" id="modifyInsuranceCardFace" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Carte vitale de face</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <input type="file" name="insuranceCardFace" class="form-control" id="insuranceCardFace">
                    <label for="insuranceCardFace">Carte vitale de face</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la carte vitale de dos. -->
<div class="modal fade" id="modifyInsuranceCardBack" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Carte vitale de dos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <input type="file" name="insuranceCardBack" class="form-control" id="insuranceCardBack">
                    <label for="insuranceCardBack">Carte vitale de dos</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la carte d'identité de face. -->
<div class="modal fade" id="modifyIdCardFace" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Carte d'identité de face</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <input type="file" name="idCardFace" class="form-control" id="idCardFace">
                    <label for="idCardFace">Carte d'identité de face</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la carte d'identité de dos. -->
<div class="modal fade" id="modifyIdCardBack" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Carte d'identité de dos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <input type="file" name="idCardBack" class="form-control" id="idCardBack">
                    <label for="idCardBack">Carte d'identité de dos</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>