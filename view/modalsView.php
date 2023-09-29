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
                    <input type="number" name="idNumber" class="form-control" id="idNumber" placeholder="<?= $_SESSION['id_number'] ?>">
                    <label for="idNumber">Numéro de carte d'identité</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>
