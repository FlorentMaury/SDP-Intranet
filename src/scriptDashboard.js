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

let activeButton;
let inactiveButton;
let employeesList;
let employeesListInactive;

// Boutons.
managerViewGridButton = document.querySelector('#managerViewGridButton');
generalInfosButton    = document.querySelector('#generalInfosButton');
experiencesButton     = document.querySelector('#experiencesButton');
contractButton        = document.querySelector('#contractButton');
timeBankButton        = document.querySelector('#timeBankButton');

activeButton   = document.querySelector('.activeButton');
inactiveButton = document.querySelector('.inactiveButton');

// Conteneurs.
managerViewGrid = document.querySelector('#managerViewGrid');
generalInfos    = document.querySelector('#generalInfos');
experiences     = document.querySelector('#experiences');
contract        = document.querySelector('#contract');
timeBank        = document.querySelector('#timeBank');

employeesList         = document.querySelector('#employeesList');
employeesListInactive = document.querySelector('#employeesListInactive');

// Affichage par défaut.
managerViewGrid.style.display = 'block';
generalInfos.style.display    = 'none';
experiences.style.display     = 'none';
contract.style.display        = 'none';
timeBank.style.display        = 'none';

employeesList.style.display         = 'block';
employeesListInactive.style.display = 'none';

// Apparence.
managerViewGridButton.style.cursor = 'pointer';
generalInfosButton.style.cursor    = 'pointer';
experiencesButton.style.cursor     = 'pointer';
contractButton.style.cursor        = 'pointer';
timeBankButton.style.cursor        = 'pointer';

activeButton.style.cursor   = 'pointer';
inactiveButton.style.cursor = 'pointer';

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

activeButton.addEventListener('click', () => {
    employeesList.style.display         = 'block';
    employeesListInactive.style.display = 'none';

    activeButton.style.backgroundColor   = '#f5f5f5';
    inactiveButton.style.backgroundColor = '#ffffff';
});

inactiveButton.addEventListener('click', () => {
    employeesList.style.display         = 'none';
    employeesListInactive.style.display = 'block';

    activeButton.style.backgroundColor   = '#ffffff';
    inactiveButton.style.backgroundColor = '#f5f5f5';
});