    // Menu Dynamique du Tableau de Bord.

// Variables.
let managerViewGridButton;
let generalInfosButton;
let experiencesButton;
let contractButton;
let timeBankButton;

let managerViewGrid;
let generalInfos;
let experiences;
let contract;
let timeBank;

// Boutons.
managerViewGridButton = document.querySelector('#managerViewGridButton');
generalInfosButton    = document.querySelector('#generalInfosButton');
experiencesButton     = document.querySelector('#experiencesButton');
contractButton        = document.querySelector('#contractButton');
timeBankButton        = document.querySelector('#timeBankButton');

// Conteneurs.
managerViewGrid = document.querySelector('#managerViewGrid');
generalInfos    = document.querySelector('#generalInfos');
experiences     = document.querySelector('#experiences');
contract        = document.querySelector('#contract');
timeBank        = document.querySelector('#timeBank');

// Affichage par défaut.
managerViewGrid.style.display = 'block';
generalInfos.style.display    = 'none';
experiences.style.display     = 'none';
contract.style.display        = 'none';
timeBank.style.display        = 'none';

// Apparence.
managerViewGridButton.style.cursor = 'pointer';
generalInfosButton.style.cursor    = 'pointer';
experiencesButton.style.cursor     = 'pointer';
contractButton.style.cursor        = 'pointer';
timeBankButton.style.cursor        = 'pointer';

// Gestion des boutons.
managerViewGridButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'block';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'none';
    contract.style.display        = 'none';
    timeBank.style.display        = 'none';

    managerViewGridButton.style.backgroundColor = '#f5f5f5';
    generalInfosButton.style.backgroundColor    = '#ffffff';
    experiencesButton.style.backgroundColor     = '#ffffff';
    contractButton.style.backgroundColor        = '#ffffff';
    timeBankButton.style.backgroundColor        = '#ffffff';
});

generalInfosButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'block';
    experiences.style.display     = 'none';
    contract.style.display        = 'none';
    timeBank.style.display        = 'none';

    managerViewGridButton.style.backgroundColor = '#ffffff';
    generalInfosButton.style.backgroundColor    = '#f5f5f5';
    experiencesButton.style.backgroundColor     = '#ffffff';
    contractButton.style.backgroundColor        = '#ffffff';
    timeBankButton.style.backgroundColor        = '#ffffff';
});

experiencesButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'block';
    contract.style.display        = 'none';
    timeBank.style.display        = 'none';

    managerViewGridButton.style.backgroundColor = '#ffffff';
    generalInfosButton.style.backgroundColor    = '#ffffff';
    experiencesButton.style.backgroundColor     = '#f5f5f5';
    contractButton.style.backgroundColor        = '#ffffff';
    timeBankButton.style.backgroundColor        = '#ffffff';
});

contractButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'none';
    contract.style.display        = 'block';
    timeBank.style.display        = 'none';

    managerViewGridButton.style.backgroundColor = '#ffffff';
    generalInfosButton.style.backgroundColor    = '#ffffff';
    experiencesButton.style.backgroundColor     = '#ffffff';
    contractButton.style.backgroundColor        = '#f5f5f5';
    timeBankButton.style.backgroundColor        = '#ffffff';
});

timeBankButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'none';
    contract.style.display        = 'none';
    timeBank.style.display        = 'block';

    managerViewGridButton.style.backgroundColor = '#ffffff';
    generalInfosButton.style.backgroundColor    = '#ffffff';
    experiencesButton.style.backgroundColor     = '#ffffff';
    contractButton.style.backgroundColor        = '#ffffff';
    timeBankButton.style.backgroundColor        = '#f5f5f5';
});



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