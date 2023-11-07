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

const buttons = [generalInfosButton, experiencesButton, contractButton, timeBankButton];

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
    buttons.forEach(btn => btn.classList.remove('active'));
    generalInfosButton.classList.add('active');
});

experiencesButton.addEventListener('click', () => {
    experiences.style.display = 'block';
    generalInfos.style.display = 'none';
    contract.style.display     = 'none';
    timeBank.style.display     = 'none';
    buttons.forEach(btn => btn.classList.remove('active'));
    experiencesButton.classList.add('active');
});

contractButtonUser.addEventListener('click', () => {
    contract.style.display = 'block';
    generalInfos.style.display = 'none';
    experiences.style.display  = 'none';
    timeBank.style.display     = 'none';
    buttons.forEach(btn => btn.classList.remove('active'));
    contractButtonUser.classList.add('active');
});

timeBankButton.addEventListener('click', () => {
    timeBank.style.display = 'block';
    generalInfos.style.display = 'none';
    experiences.style.display  = 'none';
    contract.style.display     = 'none';
    buttons.forEach(btn => btn.classList.remove('active'));
    timeBankButton.classList.add('active');
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
if(params.get('action') === 'contractButtonUser') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    contractButtonUser.click();
}

// Vérifiez si le paramètre 'action' est égal à 'timeBankButton'.
if(params.get('action') === 'timeBankButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    timeBankButton.click();
}


// MODE SOMBRE.
// Lorsque le DOM est chargé
document.addEventListener('DOMContentLoaded', (event) => {
    let darkModeSwitch = document.querySelector('#darkModeSwitch');
    const navItems = document.querySelectorAll('nav ul li');

    // Appliquer le mode sombre au chargement de la page si l'état enregistré est 'dark'
    if (localStorage.getItem('mode') === 'dark') {
        document.body.classList.add('dark-mode');
        darkModeSwitch.checked = true;
        navItems.forEach(item => item.classList.add('dark-mode')); // Ajouter la classe dark-mode aux éléments li
    }

    // Lorsque l'utilisateur change le mode
    darkModeSwitch.addEventListener('change', () => {
        if (darkModeSwitch.checked) {
            // Activer le mode sombre et enregistrer l'état
            document.body.classList.add('dark-mode');
            localStorage.setItem('mode', 'dark');
            navItems.forEach(item => item.classList.add('dark-mode')); // Ajouter la classe dark-mode aux éléments li
        } else {
            // Désactiver le mode sombre et enregistrer l'état
            document.body.classList.remove('dark-mode');
            localStorage.setItem('mode', 'light');
            navItems.forEach(item => item.classList.remove('dark-mode')); // Supprimer la classe dark-mode des éléments li
        }
    });
});