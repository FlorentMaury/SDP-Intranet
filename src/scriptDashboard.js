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

    let isDarkMode = document.body.classList.contains('dark-mode');

    managerViewGridButton.style.backgroundColor = isDarkMode ? '#555' : '#f5f5f5';
    generalInfosButton.style.backgroundColor    = isDarkMode ? '#333' : '#ffffff';
    experiencesButton.style.backgroundColor     = isDarkMode ? '#333' : '#ffffff';
    contractButton.style.backgroundColor        = isDarkMode ? '#333' : '#ffffff';
    timeBankButton.style.backgroundColor        = isDarkMode ? '#333' : '#ffffff';
});

generalInfosButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'block';
    experiences.style.display     = 'none';
    contract.style.display        = 'none';
    timeBank.style.display        = 'none';

    let isDarkMode = document.body.classList.contains('dark-mode');

    managerViewGridButton.style.backgroundColor = isDarkMode ? '#333' : '#ffffff';
    generalInfosButton.style.backgroundColor    = isDarkMode ? '#555' : '#f5f5f5';
    experiencesButton.style.backgroundColor     = isDarkMode ? '#333' : '#ffffff';
    contractButton.style.backgroundColor        = isDarkMode ? '#333' : '#ffffff';
    timeBankButton.style.backgroundColor        = isDarkMode ? '#333' : '#ffffff';
});

experiencesButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'block';
    contract.style.display        = 'none';
    timeBank.style.display        = 'none';

    let isDarkMode = document.body.classList.contains('dark-mode');

    managerViewGridButton.style.backgroundColor = isDarkMode ? '#333' : '#ffffff';
    generalInfosButton.style.backgroundColor    = isDarkMode ? '#333' : '#ffffff';
    experiencesButton.style.backgroundColor     = isDarkMode ? '#555' : '#f5f5f5';
    contractButton.style.backgroundColor        = isDarkMode ? '#333' : '#ffffff';
    timeBankButton.style.backgroundColor        = isDarkMode ? '#333' : '#ffffff';
});

contractButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'none';
    contract.style.display        = 'block';
    timeBank.style.display        = 'none';

    let isDarkMode = document.body.classList.contains('dark-mode');

    managerViewGridButton.style.backgroundColor = isDarkMode ? '#333' : '#ffffff';
    generalInfosButton.style.backgroundColor    = isDarkMode ? '#333' : '#ffffff';
    experiencesButton.style.backgroundColor     = isDarkMode ? '#333' : '#ffffff';
    contractButton.style.backgroundColor        = isDarkMode ? '#555' : '#f5f5f5';
    timeBankButton.style.backgroundColor        = isDarkMode ? '#333' : '#ffffff';
});

timeBankButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'none';
    contract.style.display        = 'none';
    timeBank.style.display        = 'block';

    let isDarkMode = document.body.classList.contains('dark-mode');

    managerViewGridButton.style.backgroundColor = isDarkMode ? '#333' : '#ffffff';
    generalInfosButton.style.backgroundColor    = isDarkMode ? '#333' : '#ffffff';
    experiencesButton.style.backgroundColor     = isDarkMode ? '#333' : '#ffffff';
    contractButton.style.backgroundColor        = isDarkMode ? '#333' : '#ffffff';
    timeBankButton.style.backgroundColor        = isDarkMode ? '#555' : '#f5f5f5';
});

activeButton.addEventListener('click', () => {
    employeesList.style.display         = 'block';
    employeesListInactive.style.display = 'none';

    let isDarkMode = document.body.classList.contains('dark-mode');

    activeButton.style.backgroundColor   = isDarkMode ? '#555' : '#f5f5f5';
    inactiveButton.style.backgroundColor = isDarkMode ? '#333' : '#ffffff';
});

inactiveButton.addEventListener('click', () => {
    employeesList.style.display         = 'none';
    employeesListInactive.style.display = 'block';

    let isDarkMode = document.body.classList.contains('dark-mode');

    activeButton.style.backgroundColor   = isDarkMode ? '#333' : '#ffffff';
    inactiveButton.style.backgroundColor = isDarkMode ? '#555' : '#f5f5f5';
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

// Vérifiez si le paramètre 'action' est égal à 'contractButton'.
if(params.get('action') === 'contractButton') {
    // Déclenchez l'événement 'click' sur le bouton souhaité.
    contractButton.click();
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

    // Appliquer le mode sombre au chargement de la page si l'état enregistré est 'dark'
    if (localStorage.getItem('mode') === 'dark') {
        document.body.classList.add('dark-mode');
        darkModeSwitch.checked = true;
    }

    // Lorsque l'utilisateur change le mode
    darkModeSwitch.addEventListener('change', () => {
        if (darkModeSwitch.checked) {
            // Activer le mode sombre et enregistrer l'état
            document.body.classList.add('dark-mode');
            localStorage.setItem('mode', 'dark');
        } else {
            // Désactiver le mode sombre et enregistrer l'état
            document.body.classList.remove('dark-mode');
            localStorage.setItem('mode', 'light');
        }
    });
});
