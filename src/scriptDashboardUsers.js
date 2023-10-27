    // Menu Dynamique du Tableau de Bord.

// Variables.
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
generalInfosButton = document.querySelector('#generalInfosButton');
experiencesButton  = document.querySelector('#experiencesButton');
contractButton     = document.querySelector('#contractButton');
timeBankButton     = document.querySelector('#timeBankButton');

// Conteneurs.
generalInfos = document.querySelector('#generalInfos');
experiences  = document.querySelector('#experiences');
contract     = document.querySelector('#contract');
timeBank     = document.querySelector('#timeBank');

// Affichage par défaut.
generalInfos.style.display = 'block';
experiences.style.display  = 'none';
contract.style.display     = 'none';
timeBank.style.display     = 'none';

// Apparence.
generalInfosButton.style.cursor = 'pointer';
experiencesButton.style.cursor  = 'pointer';
contractButton.style.cursor     = 'pointer';
timeBankButton.style.cursor     = 'pointer';

// Gestion des boutons.

generalInfosButton.addEventListener('click', () => {
    generalInfos.style.display = 'block';
    experiences.style.display  = 'none';
    contract.style.display     = 'none';
    timeBank.style.display     = 'none';

    generalInfosButton.style.backgroundColor = '#f5f5f5';
    experiencesButton.style.backgroundColor  = '#ffffff';
    contractButton.style.backgroundColor     = '#ffffff';
    timeBankButton.style.backgroundColor     = '#ffffff';
});

experiencesButton.addEventListener('click', () => {
    generalInfos.style.display = 'none';
    experiences.style.display  = 'block';
    contract.style.display     = 'none';
    timeBank.style.display     = 'none';

    generalInfosButton.style.backgroundColor = '#ffffff';
    experiencesButton.style.backgroundColor  = '#f5f5f5';
    contractButton.style.backgroundColor     = '#ffffff';
    timeBankButton.style.backgroundColor     = '#ffffff';
});

contractButton.addEventListener('click', () => {
    generalInfos.style.display = 'none';
    experiences.style.display  = 'none';
    contract.style.display     = 'block';
    timeBank.style.display     = 'none';

    generalInfosButton.style.backgroundColor = '#ffffff';
    experiencesButton.style.backgroundColor  = '#ffffff';
    contractButton.style.backgroundColor     = '#f5f5f5';
    timeBankButton.style.backgroundColor     = '#ffffff';
});

timeBankButton.addEventListener('click', () => {
    generalInfos.style.display = 'none';
    experiences.style.display  = 'none';
    contract.style.display     = 'none';
    timeBank.style.display     = 'block';

    generalInfosButton.style.backgroundColor = '#ffffff';
    experiencesButton.style.backgroundColor  = '#ffffff';
    contractButton.style.backgroundColor     = '#ffffff';
    timeBankButton.style.backgroundColor     = '#f5f5f5';
});