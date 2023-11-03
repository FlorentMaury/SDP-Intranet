    // Menu Dynamique du Tableau de Bord.

// Variables.
let generalInfosButton;
let experiencesButton;
let contractButtonUser;
let timeBankButton;

let managerViewGrid;
let generalInfos;
let experiences;
let contract;
let timeBank;

// Boutons.
generalInfosButton = document.querySelector('#generalInfosButton');
experiencesButton  = document.querySelector('#experiencesButton');
contractButtonUser = document.querySelector('#contractButton');
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
contractButtonUser.style.cursor     = 'pointer';
timeBankButton.style.cursor     = 'pointer';

// Gestion des boutons.
generalInfosButton.addEventListener('click', () => {
    generalInfos.style.display = 'block';
    experiences.style.display  = 'none';
    contract.style.display     = 'none';
    timeBank.style.display     = 'none';

    generalInfosButton.style.backgroundColor = '#f5f5f5';
    experiencesButton.style.backgroundColor  = '#ffffff';
    contractButtonUser.style.backgroundColor     = '#ffffff';
    timeBankButton.style.backgroundColor     = '#ffffff';
});

experiencesButton.addEventListener('click', () => {
    generalInfos.style.display = 'none';
    experiences.style.display  = 'block';
    contract.style.display     = 'none';
    timeBank.style.display     = 'none';

    generalInfosButton.style.backgroundColor = '#ffffff';
    experiencesButton.style.backgroundColor  = '#f5f5f5';
    contractButtonUser.style.backgroundColor     = '#ffffff';
    timeBankButton.style.backgroundColor     = '#ffffff';
});

contractButtonUserUser.addEventListener('click', () => {
    generalInfos.style.display = 'none';
    experiences.style.display  = 'none';
    contract.style.display     = 'block';
    timeBank.style.display     = 'none';

    generalInfosButton.style.backgroundColor = '#ffffff';
    experiencesButton.style.backgroundColor  = '#ffffff';
    contractButtonUser.style.backgroundColor     = '#f5f5f5';
    timeBankButton.style.backgroundColor     = '#ffffff';
});

timeBankButton.addEventListener('click', () => {
    generalInfos.style.display = 'none';
    experiences.style.display  = 'none';
    contract.style.display     = 'none';
    timeBank.style.display     = 'block';

    generalInfosButton.style.backgroundColor = '#ffffff';
    experiencesButton.style.backgroundColor  = '#ffffff';
    contractButtonUser.style.backgroundColor     = '#ffffff';
    timeBankButton.style.backgroundColor     = '#f5f5f5';
});


// Obtenez les paramètres de l'URL afin de générer les onClick.
let params = new URLSearchParams(window.location.search);

// Vérifiez si le paramètre 'action' est égal à 'managerViewGridButton'.
if(params.get('action') === 'managerViewGridButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    generalInfosButton.click();
}

// Vérifiez si le paramètre 'action' est égal à 'generalInfosButton'.
if(params.get('action') === 'generalInfosButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    generalInfosButton.click();
}

// Vérifiez si le paramètre 'action' est égal à 'experiencesButton'.
if(params.get('action') === 'experiencesButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    experiencesButton.click();
}

// Vérifiez si le paramètre 'action' est égal à 'contractButtonUser'.
if(params.get('action') === 'contractButtonUserUser') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    contractButtonUserUser.click();
}

// Vérifiez si le paramètre 'action' est égal à 'timeBankButton'.
if(params.get('action') === 'timeBankButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    timeBankButton.click();
}