    // Menu Dynamique de l'Affichage des Utilisateurs.

// Variables.
let generalUserInfosButton;
let userSchoolButton;
let userExpButton;
let userContractButton;
let userTimeBankButton;

let generalUserInfos;
let userSchool;
let userExp;
let userContract;
let userTimeBank;

// Boutons.
generalUserInfosButton = document.querySelector('#generalUserInfosButton');
userSchoolButton       = document.querySelector('#userSchoolButton');
userExpButton          = document.querySelector('#userExpButton');
userContractButton     = document.querySelector('#userContractButton');
userTimeBankButton     = document.querySelector('#userTimeBankButton');

// Conteneurs.
generalUserInfos = document.querySelector('#generalUserInfos');
userSchool       = document.querySelector('#userSchool');
userExp          = document.querySelector('#userExp');
userContract     = document.querySelector('#userContract');
userTimeBank     = document.querySelector('#userTimeBank');

// Affichage par défaut.
generalUserInfos.style.display = 'block';
userSchool.style.display       = 'none';
userExp.style.display          = 'none';
userContract.style.display     = 'none';
userTimeBank.style.display     = 'none';

// Apparence.
generalUserInfosButton.style.cursor = 'pointer';
userSchoolButton.style.cursor       = 'pointer';
userExpButton.style.cursor          = 'pointer';
userContractButton.style.cursor     = 'pointer';
userTimeBankButton.style.cursor     = 'pointer';

// Gestion des boutons.
generalUserInfosButton.addEventListener('click', () => {
    generalUserInfos.style.display = 'block';
    userSchool.style.display       = 'none';
    userExp.style.display          = 'none';
    userContract.style.display     = 'none';
    userTimeBank.style.display     = 'none';

    generalUserInfosButton.style.backgroundColor = '#f5f5f5';
    userSchoolButton.style.backgroundColor       = '#ffffff';
    userExpButton.style.backgroundColor          = '#ffffff';
    userContractButton.style.backgroundColor     = '#ffffff';
    userTimeBankButton.style.backgroundColor     = '#ffffff';
});

userSchoolButton.addEventListener('click', () => {
    generalUserInfos.style.display = 'none';
    userSchool.style.display       = 'block';
    userExp.style.display          = 'none';
    userContract.style.display     = 'none';
    userTimeBank.style.display     = 'none';

    generalUserInfosButton.style.backgroundColor = '#ffffff';
    userSchoolButton.style.backgroundColor       = '#f5f5f5';
    userExpButton.style.backgroundColor          = '#ffffff';
    userContractButton.style.backgroundColor     = '#ffffff';
    userTimeBankButton.style.backgroundColor     = '#ffffff';
});

userExpButton.addEventListener('click', () => {
    generalUserInfos.style.display = 'none';
    userSchool.style.display       = 'none';
    userExp.style.display          = 'block';
    userContract.style.display     = 'none';
    userTimeBank.style.display     = 'none';

    generalUserInfosButton.style.backgroundColor = '#ffffff';
    userSchoolButton.style.backgroundColor       = '#ffffff';
    userExpButton.style.backgroundColor          = '#f5f5f5';
    userContractButton.style.backgroundColor     = '#ffffff';
    userTimeBankButton.style.backgroundColor     = '#ffffff';
});

userContractButton.addEventListener('click', () => {
    generalUserInfos.style.display = 'none';
    userSchool.style.display       = 'none';
    userExp.style.display          = 'none';
    userContract.style.display     = 'block';
    userTimeBank.style.display     = 'none';

    generalUserInfosButton.style.backgroundColor = '#ffffff';
    userSchoolButton.style.backgroundColor       = '#ffffff';
    userExpButton.style.backgroundColor          = '#ffffff';
    userContractButton.style.backgroundColor     = '#f5f5f5';
    userTimeBankButton.style.backgroundColor     = '#ffffff';
});

userTimeBankButton.addEventListener('click', () => {
    generalUserInfos.style.display = 'none';
    userSchool.style.display       = 'none';
    userExp.style.display          = 'none';
    userContract.style.display     = 'none';
    userTimeBank.style.display     = 'block';

    generalUserInfosButton.style.backgroundColor = '#ffffff';
    userSchoolButton.style.backgroundColor       = '#ffffff';
    userExpButton.style.backgroundColor          = '#ffffff';
    userContractButton.style.backgroundColor     = '#ffffff';
    userTimeBankButton.style.backgroundColor     = '#f5f5f5';
});


// Obtenez les paramètres de l'URL afin de générer les onClick.
let params = new URLSearchParams(window.location.search);

// Vérifiez si le paramètre 'action' est égal à 'managerViewGridButton'.
if(params.get('action') === 'generalUserInfosButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    generalUserInfosButton.click();
}

// Vérifiez si le paramètre 'action' est égal à 'generalInfosButton'.
if(params.get('action') === 'userSchoolButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    userSchoolButton.click();
}

// Vérifiez si le paramètre 'action' est égal à 'experiencesButton'.
if(params.get('action') === 'userExpButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    userExpButton.click();
}

// Vérifiez si le paramètre 'action' est égal à 'contractButton'.
if(params.get('action') === 'userContractButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    userContractButton.click();
}

// Vérifiez si le paramètre 'action' est égal à 'timeBankButton'.
if(params.get('action') === 'userContractButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    userContractButton.click();
}

// Vérifiez si le paramètre 'action' est égal à 'timeBankButton'.
if(params.get('action') === 'userTimeBankButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    userTimeBankButton.click();
}