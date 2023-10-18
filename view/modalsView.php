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
                    <select type="text" name="birthCountry" class="form-control" id="birthCountry" placeholder="<?= $_SESSION['birth_country'] ?>">
                    <label for="birthCountry">Pays de naissance</label>
                    <label for="currentCountry">Pays</label>
                    <option value="Afghanistan">Afghanistan </option>
                    <option value="Afrique_Centrale">Afrique_Centrale </option>
                    <option value="Afrique_du_sud">Afrique_du_Sud </option>
                    <option value="Albanie">Albanie </option>
                    <option value="Algerie">Algerie </option>
                    <option value="Allemagne">Allemagne </option>
                    <option value="Andorre">Andorre </option>
                    <option value="Angola">Angola </option>
                    <option value="Anguilla">Anguilla </option>
                    <option value="Arabie_Saoudite">Arabie_Saoudite </option>
                    <option value="Argentine">Argentine </option>
                    <option value="Armenie">Armenie </option>
                    <option value="Australie">Australie </option>
                    <option value="Autriche">Autriche </option>
                    <option value="Azerbaidjan">Azerbaidjan </option>

                    <option value="Bahamas">Bahamas </option>
                    <option value="Bangladesh">Bangladesh </option>
                    <option value="Barbade">Barbade </option>
                    <option value="Bahrein">Bahrein </option>
                    <option value="Belgique">Belgique </option>
                    <option value="Belize">Belize </option>
                    <option value="Benin">Benin </option>
                    <option value="Bermudes">Bermudes </option>
                    <option value="Bielorussie">Bielorussie </option>
                    <option value="Bolivie">Bolivie </option>
                    <option value="Botswana">Botswana </option>
                    <option value="Bhoutan">Bhoutan </option>
                    <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
                    <option value="Bresil">Bresil </option>
                    <option value="Brunei">Brunei </option>
                    <option value="Bulgarie">Bulgarie </option>
                    <option value="Burkina_Faso">Burkina_Faso </option>
                    <option value="Burundi">Burundi </option>

                    <option value="Caiman">Caiman </option>
                    <option value="Cambodge">Cambodge </option>
                    <option value="Cameroun">Cameroun </option>
                    <option value="Canada">Canada </option>
                    <option value="Canaries">Canaries </option>
                    <option value="Cap_vert">Cap_Vert </option>
                    <option value="Chili">Chili </option>
                    <option value="Chine">Chine </option>
                    <option value="Chypre">Chypre </option>
                    <option value="Colombie">Colombie </option>
                    <option value="Comores">Colombie </option>
                    <option value="Congo">Congo </option>
                    <option value="Congo_democratique">Congo_democratique </option>
                    <option value="Cook">Cook </option>
                    <option value="Coree_du_Nord">Coree_du_Nord </option>
                    <option value="Coree_du_Sud">Coree_du_Sud </option>
                    <option value="Costa_Rica">Costa_Rica </option>
                    <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
                    <option value="Croatie">Croatie </option>
                    <option value="Cuba">Cuba </option>

                    <option value="Danemark">Danemark </option>
                    <option value="Djibouti">Djibouti </option>
                    <option value="Dominique">Dominique </option>

                    <option value="Egypte">Egypte </option>
                    <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                    <option value="Equateur">Equateur </option>
                    <option value="Erythree">Erythree </option>
                    <option value="Espagne">Espagne </option>
                    <option value="Estonie">Estonie </option>
                    <option value="Etats_Unis">Etats_Unis </option>
                    <option value="Ethiopie">Ethiopie </option>

                    <option value="Falkland">Falkland </option>
                    <option value="Feroe">Feroe </option>
                    <option value="Fidji">Fidji </option>
                    <option value="Finlande">Finlande </option>
                    <option value="France" selected="selected">France </option>

                    <option value="Gabon">Gabon </option>
                    <option value="Gambie">Gambie </option>
                    <option value="Georgie">Georgie </option>
                    <option value="Ghana">Ghana </option>
                    <option value="Gibraltar">Gibraltar </option>
                    <option value="Grece">Grece </option>
                    <option value="Grenade">Grenade </option>
                    <option value="Groenland">Groenland </option>
                    <option value="Guadeloupe">Guadeloupe </option>
                    <option value="Guam">Guam </option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernesey">Guernesey </option>
                    <option value="Guinee">Guinee </option>
                    <option value="Guinee_Bissau">Guinee_Bissau </option>
                    <option value="Guinee equatoriale">Guinee_Equatoriale </option>
                    <option value="Guyana">Guyana </option>
                    <option value="Guyane_Francaise ">Guyane_Francaise </option>

                    <option value="Haiti">Haiti </option>
                    <option value="Hawaii">Hawaii </option>
                    <option value="Honduras">Honduras </option>
                    <option value="Hong_Kong">Hong_Kong </option>
                    <option value="Hongrie">Hongrie </option>

                    <option value="Inde">Inde </option>
                    <option value="Indonesie">Indonesie </option>
                    <option value="Iran">Iran </option>
                    <option value="Iraq">Iraq </option>
                    <option value="Irlande">Irlande </option>
                    <option value="Islande">Islande </option>
                    <option value="Israel">Israel </option>
                    <option value="Italie">italie </option>

                    <option value="Jamaique">Jamaique </option>
                    <option value="Jan Mayen">Jan Mayen </option>
                    <option value="Japon">Japon </option>
                    <option value="Jersey">Jersey </option>
                    <option value="Jordanie">Jordanie </option>

                    <option value="Kazakhstan">Kazakhstan </option>
                    <option value="Kenya">Kenya </option>
                    <option value="Kirghizstan">Kirghizistan </option>
                    <option value="Kiribati">Kiribati </option>
                    <option value="Koweit">Koweit </option>

                    <option value="Laos">Laos </option>
                    <option value="Lesotho">Lesotho </option>
                    <option value="Lettonie">Lettonie </option>
                    <option value="Liban">Liban </option>
                    <option value="Liberia">Liberia </option>
                    <option value="Liechtenstein">Liechtenstein </option>
                    <option value="Lituanie">Lituanie </option>
                    <option value="Luxembourg">Luxembourg </option>
                    <option value="Lybie">Lybie </option>

                    <option value="Macao">Macao </option>
                    <option value="Macedoine">Macedoine </option>
                    <option value="Madagascar">Madagascar </option>
                    <option value="Madère">Madère </option>
                    <option value="Malaisie">Malaisie </option>
                    <option value="Malawi">Malawi </option>
                    <option value="Maldives">Maldives </option>
                    <option value="Mali">Mali </option>
                    <option value="Malte">Malte </option>
                    <option value="Man">Man </option>
                    <option value="Mariannes du Nord">Mariannes du Nord </option>
                    <option value="Maroc">Maroc </option>
                    <option value="Marshall">Marshall </option>
                    <option value="Martinique">Martinique </option>
                    <option value="Maurice">Maurice </option>
                    <option value="Mauritanie">Mauritanie </option>
                    <option value="Mayotte">Mayotte </option>
                    <option value="Mexique">Mexique </option>
                    <option value="Micronesie">Micronesie </option>
                    <option value="Midway">Midway </option>
                    <option value="Moldavie">Moldavie </option>
                    <option value="Monaco">Monaco </option>
                    <option value="Mongolie">Mongolie </option>
                    <option value="Montserrat">Montserrat </option>
                    <option value="Mozambique">Mozambique </option>

                    <option value="Namibie">Namibie </option>
                    <option value="Nauru">Nauru </option>
                    <option value="Nepal">Nepal </option>
                    <option value="Nicaragua">Nicaragua </option>
                    <option value="Niger">Niger </option>
                    <option value="Nigeria">Nigeria </option>
                    <option value="Niue">Niue </option>
                    <option value="Norfolk">Norfolk </option>
                    <option value="Norvege">Norvege </option>
                    <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
                    <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>

                    <option value="Oman">Oman </option>
                    <option value="Ouganda">Ouganda </option>
                    <option value="Ouzbekistan">Ouzbekistan </option>

                    <option value="Pakistan">Pakistan </option>
                    <option value="Palau">Palau </option>
                    <option value="Palestine">Palestine </option>
                    <option value="Panama">Panama </option>
                    <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
                    <option value="Paraguay">Paraguay </option>
                    <option value="Pays_Bas">Pays_Bas </option>
                    <option value="Perou">Perou </option>
                    <option value="Philippines">Philippines </option>
                    <option value="Pologne">Pologne </option>
                    <option value="Polynesie">Polynesie </option>
                    <option value="Porto_Rico">Porto_Rico </option>
                    <option value="Portugal">Portugal </option>

                    <option value="Qatar">Qatar </option>

                    <option value="Republique_Dominicaine">Republique_Dominicaine </option>
                    <option value="Republique_Tcheque">Republique_Tcheque </option>
                    <option value="Reunion">Reunion </option>
                    <option value="Roumanie">Roumanie </option>
                    <option value="Royaume_Uni">Royaume_Uni </option>
                    <option value="Russie">Russie </option>
                    <option value="Rwanda">Rwanda </option>

                    <option value="Sahara Occidental">Sahara Occidental </option>
                    <option value="Sainte_Lucie">Sainte_Lucie </option>
                    <option value="Saint_Marin">Saint_Marin </option>
                    <option value="Salomon">Salomon </option>
                    <option value="Salvador">Salvador </option>
                    <option value="Samoa_Occidentales">Samoa_Occidentales</option>
                    <option value="Samoa_Americaine">Samoa_Americaine </option>
                    <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
                    <option value="Senegal">Senegal </option>
                    <option value="Seychelles">Seychelles </option>
                    <option value="Sierra Leone">Sierra Leone </option>
                    <option value="Singapour">Singapour </option>
                    <option value="Slovaquie">Slovaquie </option>
                    <option value="Slovenie">Slovenie</option>
                    <option value="Somalie">Somalie </option>
                    <option value="Soudan">Soudan </option>
                    <option value="Sri_Lanka">Sri_Lanka </option>
                    <option value="Suede">Suede </option>
                    <option value="Suisse">Suisse </option>
                    <option value="Surinam">Surinam </option>
                    <option value="Swaziland">Swaziland </option>
                    <option value="Syrie">Syrie </option>

                    <option value="Tadjikistan">Tadjikistan </option>
                    <option value="Taiwan">Taiwan </option>
                    <option value="Tonga">Tonga </option>
                    <option value="Tanzanie">Tanzanie </option>
                    <option value="Tchad">Tchad </option>
                    <option value="Thailande">Thailande </option>
                    <option value="Tibet">Tibet </option>
                    <option value="Timor_Oriental">Timor_Oriental </option>
                    <option value="Togo">Togo </option>
                    <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
                    <option value="Tristan da cunha">Tristan de cuncha </option>
                    <option value="Tunisie">Tunisie </option>
                    <option value="Turkmenistan">Turmenistan </option>
                    <option value="Turquie">Turquie </option>

                    <option value="Ukraine">Ukraine </option>
                    <option value="Uruguay">Uruguay </option>

                    <option value="Vanuatu">Vanuatu </option>
                    <option value="Vatican">Vatican </option>
                    <option value="Venezuela">Venezuela </option>
                    <option value="Vierges_Americaines">Vierges_Americaines </option>
                    <option value="Vierges_Britanniques">Vierges_Britanniques </option>
                    <option value="Vietnam">Vietnam </option>

                    <option value="Wake">Wake </option>
                    <option value="Wallis et Futuma">Wallis et Futuma </option>

                    <option value="Yemen">Yemen </option>
                    <option value="Yougoslavie">Yougoslavie </option>

                    <option value="Zambie">Zambie </option>
                    <option value="Zimbabwe">Zimbabwe </option>
                    </select>
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
                    <select type="text" name="currentCountry" class="form-control" id="currentCountry">
                    <label for="currentCountry">Pays</label>
                    <option value="Afghanistan">Afghanistan </option>
                    <option value="Afrique_Centrale">Afrique_Centrale </option>
                    <option value="Afrique_du_sud">Afrique_du_Sud </option>
                    <option value="Albanie">Albanie </option>
                    <option value="Algerie">Algerie </option>
                    <option value="Allemagne">Allemagne </option>
                    <option value="Andorre">Andorre </option>
                    <option value="Angola">Angola </option>
                    <option value="Anguilla">Anguilla </option>
                    <option value="Arabie_Saoudite">Arabie_Saoudite </option>
                    <option value="Argentine">Argentine </option>
                    <option value="Armenie">Armenie </option>
                    <option value="Australie">Australie </option>
                    <option value="Autriche">Autriche </option>
                    <option value="Azerbaidjan">Azerbaidjan </option>

                    <option value="Bahamas">Bahamas </option>
                    <option value="Bangladesh">Bangladesh </option>
                    <option value="Barbade">Barbade </option>
                    <option value="Bahrein">Bahrein </option>
                    <option value="Belgique">Belgique </option>
                    <option value="Belize">Belize </option>
                    <option value="Benin">Benin </option>
                    <option value="Bermudes">Bermudes </option>
                    <option value="Bielorussie">Bielorussie </option>
                    <option value="Bolivie">Bolivie </option>
                    <option value="Botswana">Botswana </option>
                    <option value="Bhoutan">Bhoutan </option>
                    <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
                    <option value="Bresil">Bresil </option>
                    <option value="Brunei">Brunei </option>
                    <option value="Bulgarie">Bulgarie </option>
                    <option value="Burkina_Faso">Burkina_Faso </option>
                    <option value="Burundi">Burundi </option>

                    <option value="Caiman">Caiman </option>
                    <option value="Cambodge">Cambodge </option>
                    <option value="Cameroun">Cameroun </option>
                    <option value="Canada">Canada </option>
                    <option value="Canaries">Canaries </option>
                    <option value="Cap_vert">Cap_Vert </option>
                    <option value="Chili">Chili </option>
                    <option value="Chine">Chine </option>
                    <option value="Chypre">Chypre </option>
                    <option value="Colombie">Colombie </option>
                    <option value="Comores">Colombie </option>
                    <option value="Congo">Congo </option>
                    <option value="Congo_democratique">Congo_democratique </option>
                    <option value="Cook">Cook </option>
                    <option value="Coree_du_Nord">Coree_du_Nord </option>
                    <option value="Coree_du_Sud">Coree_du_Sud </option>
                    <option value="Costa_Rica">Costa_Rica </option>
                    <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
                    <option value="Croatie">Croatie </option>
                    <option value="Cuba">Cuba </option>

                    <option value="Danemark">Danemark </option>
                    <option value="Djibouti">Djibouti </option>
                    <option value="Dominique">Dominique </option>

                    <option value="Egypte">Egypte </option>
                    <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                    <option value="Equateur">Equateur </option>
                    <option value="Erythree">Erythree </option>
                    <option value="Espagne">Espagne </option>
                    <option value="Estonie">Estonie </option>
                    <option value="Etats_Unis">Etats_Unis </option>
                    <option value="Ethiopie">Ethiopie </option>

                    <option value="Falkland">Falkland </option>
                    <option value="Feroe">Feroe </option>
                    <option value="Fidji">Fidji </option>
                    <option value="Finlande">Finlande </option>
                    <option value="France" selected="selected">France </option>

                    <option value="Gabon">Gabon </option>
                    <option value="Gambie">Gambie </option>
                    <option value="Georgie">Georgie </option>
                    <option value="Ghana">Ghana </option>
                    <option value="Gibraltar">Gibraltar </option>
                    <option value="Grece">Grece </option>
                    <option value="Grenade">Grenade </option>
                    <option value="Groenland">Groenland </option>
                    <option value="Guadeloupe">Guadeloupe </option>
                    <option value="Guam">Guam </option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernesey">Guernesey </option>
                    <option value="Guinee">Guinee </option>
                    <option value="Guinee_Bissau">Guinee_Bissau </option>
                    <option value="Guinee equatoriale">Guinee_Equatoriale </option>
                    <option value="Guyana">Guyana </option>
                    <option value="Guyane_Francaise ">Guyane_Francaise </option>

                    <option value="Haiti">Haiti </option>
                    <option value="Hawaii">Hawaii </option>
                    <option value="Honduras">Honduras </option>
                    <option value="Hong_Kong">Hong_Kong </option>
                    <option value="Hongrie">Hongrie </option>

                    <option value="Inde">Inde </option>
                    <option value="Indonesie">Indonesie </option>
                    <option value="Iran">Iran </option>
                    <option value="Iraq">Iraq </option>
                    <option value="Irlande">Irlande </option>
                    <option value="Islande">Islande </option>
                    <option value="Israel">Israel </option>
                    <option value="Italie">italie </option>

                    <option value="Jamaique">Jamaique </option>
                    <option value="Jan Mayen">Jan Mayen </option>
                    <option value="Japon">Japon </option>
                    <option value="Jersey">Jersey </option>
                    <option value="Jordanie">Jordanie </option>

                    <option value="Kazakhstan">Kazakhstan </option>
                    <option value="Kenya">Kenya </option>
                    <option value="Kirghizstan">Kirghizistan </option>
                    <option value="Kiribati">Kiribati </option>
                    <option value="Koweit">Koweit </option>

                    <option value="Laos">Laos </option>
                    <option value="Lesotho">Lesotho </option>
                    <option value="Lettonie">Lettonie </option>
                    <option value="Liban">Liban </option>
                    <option value="Liberia">Liberia </option>
                    <option value="Liechtenstein">Liechtenstein </option>
                    <option value="Lituanie">Lituanie </option>
                    <option value="Luxembourg">Luxembourg </option>
                    <option value="Lybie">Lybie </option>

                    <option value="Macao">Macao </option>
                    <option value="Macedoine">Macedoine </option>
                    <option value="Madagascar">Madagascar </option>
                    <option value="Madère">Madère </option>
                    <option value="Malaisie">Malaisie </option>
                    <option value="Malawi">Malawi </option>
                    <option value="Maldives">Maldives </option>
                    <option value="Mali">Mali </option>
                    <option value="Malte">Malte </option>
                    <option value="Man">Man </option>
                    <option value="Mariannes du Nord">Mariannes du Nord </option>
                    <option value="Maroc">Maroc </option>
                    <option value="Marshall">Marshall </option>
                    <option value="Martinique">Martinique </option>
                    <option value="Maurice">Maurice </option>
                    <option value="Mauritanie">Mauritanie </option>
                    <option value="Mayotte">Mayotte </option>
                    <option value="Mexique">Mexique </option>
                    <option value="Micronesie">Micronesie </option>
                    <option value="Midway">Midway </option>
                    <option value="Moldavie">Moldavie </option>
                    <option value="Monaco">Monaco </option>
                    <option value="Mongolie">Mongolie </option>
                    <option value="Montserrat">Montserrat </option>
                    <option value="Mozambique">Mozambique </option>

                    <option value="Namibie">Namibie </option>
                    <option value="Nauru">Nauru </option>
                    <option value="Nepal">Nepal </option>
                    <option value="Nicaragua">Nicaragua </option>
                    <option value="Niger">Niger </option>
                    <option value="Nigeria">Nigeria </option>
                    <option value="Niue">Niue </option>
                    <option value="Norfolk">Norfolk </option>
                    <option value="Norvege">Norvege </option>
                    <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
                    <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>

                    <option value="Oman">Oman </option>
                    <option value="Ouganda">Ouganda </option>
                    <option value="Ouzbekistan">Ouzbekistan </option>

                    <option value="Pakistan">Pakistan </option>
                    <option value="Palau">Palau </option>
                    <option value="Palestine">Palestine </option>
                    <option value="Panama">Panama </option>
                    <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
                    <option value="Paraguay">Paraguay </option>
                    <option value="Pays_Bas">Pays_Bas </option>
                    <option value="Perou">Perou </option>
                    <option value="Philippines">Philippines </option>
                    <option value="Pologne">Pologne </option>
                    <option value="Polynesie">Polynesie </option>
                    <option value="Porto_Rico">Porto_Rico </option>
                    <option value="Portugal">Portugal </option>

                    <option value="Qatar">Qatar </option>

                    <option value="Republique_Dominicaine">Republique_Dominicaine </option>
                    <option value="Republique_Tcheque">Republique_Tcheque </option>
                    <option value="Reunion">Reunion </option>
                    <option value="Roumanie">Roumanie </option>
                    <option value="Royaume_Uni">Royaume_Uni </option>
                    <option value="Russie">Russie </option>
                    <option value="Rwanda">Rwanda </option>

                    <option value="Sahara Occidental">Sahara Occidental </option>
                    <option value="Sainte_Lucie">Sainte_Lucie </option>
                    <option value="Saint_Marin">Saint_Marin </option>
                    <option value="Salomon">Salomon </option>
                    <option value="Salvador">Salvador </option>
                    <option value="Samoa_Occidentales">Samoa_Occidentales</option>
                    <option value="Samoa_Americaine">Samoa_Americaine </option>
                    <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
                    <option value="Senegal">Senegal </option>
                    <option value="Seychelles">Seychelles </option>
                    <option value="Sierra Leone">Sierra Leone </option>
                    <option value="Singapour">Singapour </option>
                    <option value="Slovaquie">Slovaquie </option>
                    <option value="Slovenie">Slovenie</option>
                    <option value="Somalie">Somalie </option>
                    <option value="Soudan">Soudan </option>
                    <option value="Sri_Lanka">Sri_Lanka </option>
                    <option value="Suede">Suede </option>
                    <option value="Suisse">Suisse </option>
                    <option value="Surinam">Surinam </option>
                    <option value="Swaziland">Swaziland </option>
                    <option value="Syrie">Syrie </option>

                    <option value="Tadjikistan">Tadjikistan </option>
                    <option value="Taiwan">Taiwan </option>
                    <option value="Tonga">Tonga </option>
                    <option value="Tanzanie">Tanzanie </option>
                    <option value="Tchad">Tchad </option>
                    <option value="Thailande">Thailande </option>
                    <option value="Tibet">Tibet </option>
                    <option value="Timor_Oriental">Timor_Oriental </option>
                    <option value="Togo">Togo </option>
                    <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
                    <option value="Tristan da cunha">Tristan de cuncha </option>
                    <option value="Tunisie">Tunisie </option>
                    <option value="Turkmenistan">Turmenistan </option>
                    <option value="Turquie">Turquie </option>

                    <option value="Ukraine">Ukraine </option>
                    <option value="Uruguay">Uruguay </option>

                    <option value="Vanuatu">Vanuatu </option>
                    <option value="Vatican">Vatican </option>
                    <option value="Venezuela">Venezuela </option>
                    <option value="Vierges_Americaines">Vierges_Americaines </option>
                    <option value="Vierges_Britanniques">Vierges_Britanniques </option>
                    <option value="Vietnam">Vietnam </option>

                    <option value="Wake">Wake </option>
                    <option value="Wallis et Futuma">Wallis et Futuma </option>

                    <option value="Yemen">Yemen </option>
                    <option value="Yougoslavie">Yougoslavie </option>

                    <option value="Zambie">Zambie </option>
                    <option value="Zimbabwe">Zimbabwe </option>

                </select>

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

            <!-- MODALES DIPLOMES OBTENUS -->

<!-- Modale de modification deu premier champ études. -->
<div class="modal fade" id="modifySchool1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un diplôme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="school1" class="form-control" id="school1">
                    <label for="school1">Nom de l'école</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du premier champ études (date de début). -->
<div class="modal fade" id="modifySchool1Start" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="school1Start" class="form-control" id="school1Start">
                    <label for="school1Start">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du premier champ études (date de fin). -->
<div class="modal fade" id="modifySchool1End" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="school1End" class="form-control" id="school1End">
                    <label for="school1End">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du premier champ études (document). -->
<div class="modal fade" id="modifySchool1Doc" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <input type="file" name="school1Doc" class="form-control" id="school1Doc">
                    <label for="school1Doc">Diplôme obtenu</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>


<!-- Modale de modification du second champ études. -->
<div class="modal fade" id="modifySchool2" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un diplôme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="school2" class="form-control" id="school2">
                    <label for="school2">Nom de l'école</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du second champ études (date de début). -->
<div class="modal fade" id="modifySchool2Start" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="school2Start" class="form-control" id="school2Start">
                    <label for="school1Start">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du second champ études (date de fin). -->
<div class="modal fade" id="modifySchool2End" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="school2End" class="form-control" id="school2End">
                    <label for="school2End">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du second champ études (document). -->
<div class="modal fade" id="modifySchool2Doc" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <input type="file" name="school2Doc" class="form-control" id="school2Doc">
                    <label for="school2Doc">Diplôme obtenu</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du troisième champ études. -->
<div class="modal fade" id="modifySchool3" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un diplôme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="school3" class="form-control" id="school3">
                    <label for="school3">Nom de l'école</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du troisième champ études (date de début). -->
<div class="modal fade" id="modifySchool3Start" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="school3Start" class="form-control" id="school3Start">
                    <label for="school3Start">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du troisième champ études (date de fin). -->
<div class="modal fade" id="modifySchool3End" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="school3End" class="form-control" id="school3End">
                    <label for="school3End">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du troisième champ études (document). -->
<div class="modal fade" id="modifySchool3Doc" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <input type="file" name="school3Doc" class="form-control" id="school3Doc">
                    <label for="school3Doc">Diplôme obtenu</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

            <!-- MODALES EXPERIENCE PROFESSIONELLE -->

<!-- Modale de modification du premier champ expérience professionelle. -->
<div class="modal fade" id="modifyJob1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une expérience professionelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="job1" class="form-control" id="job1">
                    <label for="job1">Nom de l'entreprise</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du premier champ expérience professionelle (date de début). -->
<div class="modal fade" id="modifyJob1Start" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="job1Start" class="form-control" id="job1Start">
                    <label for="job1Start">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du premier champ expérience professionelle (date de fin). -->
<div class="modal fade" id="modifyJob1End" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de fin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="job1End" class="form-control" id="job1End">
                    <label for="job1End">Date de fin</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du premier champ expérience professionelle (missions). -->
<div class="modal fade" id="modifyJob1Exp" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une expérience professionelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="job1Exp" class="form-control" id="job1Exp">
                    <label for="job1Exp">Nom de l'école</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du second champ expérience professionelle. -->
<div class="modal fade" id="modifyJob2" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une expérience professionelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="job2" class="form-control" id="job2">
                    <label for="job2">Nom de l'entreprise</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du second champ expérience professionelle (date de début). -->
<div class="modal fade" id="modifyJob2Start" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="job2Start" class="form-control" id="job2Start">
                    <label for="job2Start">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du second champ expérience professionelle (date de fin). -->
<div class="modal fade" id="modifyJob2End" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de fin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="job2End" class="form-control" id="job2End">
                    <label for="job2End">Date de fin</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du second champ expérience professionelle (missions). -->
<div class="modal fade" id="modifyJob2Exp" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une expérience professionelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="job2Exp" class="form-control" id="job2Exp">
                    <label for="job2Exp">Nom de l'école</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du trosième champ expérience professionelle. -->
<div class="modal fade" id="modifyJob3" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une expérience professionelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="job3" class="form-control" id="job3">
                    <label for="job3">Nom de l'entreprise</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du trosième champ expérience professionelle (date de début). -->
<div class="modal fade" id="modifyJob3Start" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="job3Start" class="form-control" id="job3Start">
                    <label for="job3Start">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du trosième champ expérience professionelle (date de fin). -->
<div class="modal fade" id="modifyJob3End" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="job3End" class="form-control" id="job3End">
                    <label for="job3End">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du trosième champ expérience professionelle (missions). -->
<div class="modal fade" id="modifyJob3Exp" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une expérience professionelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="text" name="job3Exp" class="form-control" id="job3Exp">
                    <label for="job3Exp">Nom de l'école</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>


    <!-- MODALES DE MODIFICATIONS DES CONTRATS EMPLOYES -->


<!-- Modale de modification du champ des types de contrats. -->
<div class="modal fade" id="modifyContract" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modifier le type de contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <select name="userContract" class="form-select" id="userContract" class="form-select" aria-label="Select contract">
                        <option selected value="CDI">CDI</option>
                        <option value="CDD">CDD</option>
                        <option value="Stage">Stage</option>
                        <option value="Alternance">Alternance</option>
                    </select>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de date de début du contrat. -->
<div class="modal fade" id="modifyContractStart" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de début du contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="date" name="userContractStart" class="form-control" id="userContractStart">
                    <label for="userContractStart">Date de début</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de date de fin du contrat. -->
<div class="modal fade" id="modifyContractEnd" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Date de fin du contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="date" name="userContractEnd" class="form-control" id="userContractEnd">
                    <label for="userContractEnd">Date de fin</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de niveau du contrat. -->
<div class="modal fade" id="modifyContractLevel" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Niveau du contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="text" name="userContractLevel" class="form-control" id="userContractLevel">
                    <label for="userContractLevel">Niveau du contrat</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de coefficient du contrat. -->
<div class="modal fade" id="modifyContractCoef" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Coefficient du contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="text" name="userContractCoef" class="form-control" id="userContractCoef">
                    <label for="userContractCoef">Coefficient du contrat</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de rémunération du contrat. -->
<div class="modal fade" id="modifyContractRemuneration" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Rémunération du contrat (à l'heure)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="number" name="userContractRemuneration" class="form-control" id="userContractRemuneration">
                    <label for="userContractRemuneration">Rémunération du contrat (à l'heure)</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la mutuelle du contrat. -->
<div class="modal fade" id="modifyContractInsurance" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Mutuelle du contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="text" name="userContractInsurance" class="form-control" id="userContractInsurance">
                    <label for="userContractInsurance">Mutuelle du contrat</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification du numéro de la mutuelle du contrat. -->
<div class="modal fade" id="modifyContractInsuranceNumber" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Numéro de mutuelle du contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="number" name="userContractInsuranceNumber" class="form-control" id="userContractInsuranceNumber">
                    <label for="userContractInsuranceNumber">Numéro de mutuelle du contrat</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification des heures hebdomadaires du contrat. -->
<div class="modal fade" id="modifyContractWeekly" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Heures hebdomadaires du contrat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="number" name="userContractWeekly" class="form-control" id="userContractWeekly">
                    <label for="userContractWeekly">Heures hebdomadaires du contrat</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de la carte Navigo. -->
<div class="modal fade" id="modifyContractTransport" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Carte Navigo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=user&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <input type="number" name="userContractTransports" class="form-control" id="userContractTransports">
                    <label for="userContractTransports">Carte Navigo</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de décalartion de retard. -->
<div class="modal fade" id="modifyDelayInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Déclarer un retard (en minutes)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <select type="number" name="userDelayInfo" class="form-control" id="userDelayInfo">
                    <label for="userDelayInfo">Déclarer un retard</label>
                    <option value="0.25">15 minutes </option>
                    <option value="0.50">30 minutes </option>
                    <option value="0.75">45 minutes </option>
                    <option value="1">1 heure </option>
                    <option value="1.25">1 heure 15 minutes </option>
                    <option value="1.50">1 heure 30 minutes </option>
                    <option value="1.75">1 heure 45 minutes </option>
                    <option value="2">2 heures </option>
                    <option value="2.25">2 heures 15 minutes </option>
                    <option value="2.50">2 heures 30 minutes </option>
                    <option value="2.75">2 heures 45 minutes </option>
                    <option value="3">3 heures </option>
                    </select>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de décalartion d'absence. -->
<div class="modal fade" id="modifyAbsenceInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Déclarer une absence (en jours)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <select type="number" name="userAbsenceInfo" class="form-control" id="userAbsenceInfo">
                    <label for="userAbsenceInfo">Déclarer une absence</label>
                    <option value="1">1 jour</option>
                    <option value="2">2 jours</option>
                    <option value="3">3 jours</option>
                    <option value="4">4 jours</option>
                    <option value="5">5 jours</option>
                    <option value="6">6 jours</option>
                    <option value="7">Une semaine</option>
                    </select>
                </p>
                <p>
                    <label for="medicalJustification">Arrêt de travail</label>
                    <input type="file" name="medicalJustification" class="form-control" id="medicalJustification">
                </p>
                <p class="form-floating m-2">
                    <input type="date" name="userAbsenceDate" class="form-control" id="userAbsenceDate">
                    <label for="userAbsenceDate">Date du début de l'arrêt</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de décalartion d'une seconde absence. -->
<div class="modal fade" id="modifyAbsenceInfo2" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Déclarer une absence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <select type="number" name="userAbsenceInfo2" class="form-control" id="userAbsenceInfo2">
                    <label for="userAbsenceInfo2">Déclarer une absence</label>
                    <option value="1">1 jour</option>
                    <option value="2">2 jours</option>
                    <option value="3">3 jours</option>
                    <option value="4">4 jours</option>
                    <option value="5">5 jours</option>
                    <option value="6">6 jours</option>
                    <option value="7">Une semaine</option>
                    </select>
                </p>
                <p>
                    <label for="medicalJustification">Arrêt de travail</label>
                    <input type="file" name="medicalJustification2" class="form-control" id="medicalJustification2">
                </p>
                <p class="form-floating m-2">
                    <input type="date" name="userAbsenceDate2" class="form-control" id="userAbsenceDate2">
                    <label for="userAbsenceDate2">Date du début de l'arrêt</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de décalartion d'une troisième absence. -->
<div class="modal fade" id="modifyAbsenceInfo3" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Déclarer une absence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard" enctype="multipart/form-data">
                <p class="form-floating m-2">
                    <select type="number" name="userAbsenceInfo3" class="form-control" id="userAbsenceInfo3">
                    <label for="userAbsenceInfo3">Déclarer une absence</label>
                    <option value="1">1 jour</option>
                    <option value="2">2 jours</option>
                    <option value="3">3 jours</option>
                    <option value="4">4 jours</option>
                    <option value="5">5 jours</option>
                    <option value="6">6 jours</option>
                    <option value="7">Une semaine</option>
                    </select>
                </p>
                <p>
                    <label for="medicalJustification">Arrêt de travail</label>
                    <input type="file" name="medicalJustification3" class="form-control" id="medicalJustification3">
                </p>
                <p class="form-floating m-2">
                    <input type="date" name="userAbsenceDate3" class="form-control" id="userAbsenceDate3">
                    <label for="userAbsenceDate3">Date du début de l'arrêt</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de décalartion d'heures supplémentaires. -->
<div class="modal fade" id="modifyExtraTimeInfo" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Déclarer du temps supplémentaires</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <!-- <input type="number" name="userExtraTimeInfo" class="form-control" id="userExtraTimeInfo">
                    <label for="userExtraTimeInfo">Déclarer des heures supplémentaires</label> -->
                    <select type="number" name="userExtraTimeInfo" class="form-control" id="userExtraTimeInfo">
                    <label for="userExtraTimeInfo">Nombre de minutes</label>
                    <option value="0.25">15 minutes </option>
                    <option value="0.50">30 minutes </option>
                    <option value="0.75">45 minutes </option>
                    <option value="1">1 heure </option>
                    <option value="1.25">1 heure 15 minutes </option>
                    <option value="1.50">1 heure 30 minutes </option>
                    <option value="1.75">1 heure 45 minutes </option>
                    <option value="2">2 heures </option>
                    <option value="2.25">2 heures 15 minutes </option>
                    <option value="2.50">2 heures 30 minutes </option>
                    <option value="2.75">2 heures 45 minutes </option>
                    <option value="3">3 heures </option>
                </select>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale d'ajout d'un nouvel employé. -->
<div class="modal fade" id="modifyAddUser" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Ajout d'un collaborateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <p>
                        <label for="name">Prénom</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </p>
                    <p>
                        <label for="surname">Nom</label>
                        <input type="text" name="surname" class="form-control" id="surname">
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </p>
                    <p>
                        <label for="password">Mot de passe</label>
                        <input type="text" name="password" class="form-control" id="password">
                    </p>
                    <p>
                        <label for="passwordTwo">Confirmation du mot de passe</label>
                        <input type="text" name="passwordTwo" class="form-control" id="passwordTwo">
                    </p>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale de modification de demande de vacances. -->
<div class="modal fade" id="modifyHolidayRequest1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Modification de demande de vacances</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard">
                <p class="form-floating m-2">
                    <input type="date" name="holidayRequest1Start" class="form-control" id="holidayRequest1Start">
                    <label for="holidayRequest1Start">Début des vacances</label>
                </p>
                <p class="form-floating m-2">
                    <input type="date" name="holidayRequest1End" class="form-control" id="holidayRequest1End">
                    <label for="holidayRequest1End">Fin des vacances</label>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>

<!-- Modale acceptation de la demande de vacances -->
<div class="modal fade" id="modifyHoliday1Response" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3 mt-0">
            <!-- Titre de la modale. -->
            <div class="modal-header">
                <h5 class="modal-title">Réponse à la demande de vacances</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <!-- Corps de la modale. -->
            <form method="POST" action="index.php?page=dashboard&id=<?=$data['id']?>">
                <p class="form-floating m-2">
                    <!-- Select option 1 ou 0 -->
                    <select type="number" name="holiday1Request" class="form-control" id="holiday1Request">
                        <label for="holiday1Request">Réponse</label>
                        <option value="1">Accepter</option>
                        <option value="2">Refuser</option>
                    </select>
                </p>
                <button class="btn btn-md btn-dark mt-4 p-2" type="submit">Confirmer</button>
            </form>
        </div>
    </div>
</div>