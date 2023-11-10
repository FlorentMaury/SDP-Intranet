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

const buttons = [managerViewGridButton, generalInfosButton, experiencesButton, contractButton, timeBankButton];

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

    buttons.forEach(btn => btn.classList.remove('active'));
    managerViewGridButton.classList.add('active');
});

generalInfosButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'block';
    experiences.style.display     = 'none';
    contract.style.display        = 'none';
    timeBank.style.display        = 'none';

    buttons.forEach(btn => btn.classList.remove('active'));
    generalInfosButton.classList.add('active');
});

experiencesButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'block';
    contract.style.display        = 'none';
    timeBank.style.display        = 'none';

    buttons.forEach(btn => btn.classList.remove('active'));
    experiencesButton.classList.add('active');
});

contractButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'none';
    contract.style.display        = 'block';
    timeBank.style.display        = 'none';

    buttons.forEach(btn => btn.classList.remove('active'));
    contractButton.classList.add('active');
});

timeBankButton.addEventListener('click', () => {
    managerViewGrid.style.display = 'none';
    generalInfos.style.display    = 'none';
    experiences.style.display     = 'none';
    contract.style.display        = 'none';
    timeBank.style.display        = 'block';

    buttons.forEach(btn => btn.classList.remove('active'));
    timeBankButton.classList.add('active');
});

activeButton.addEventListener('click', () => {
    employeesList.style.display         = 'block';
    employeesListInactive.style.display = 'none';

    let isDarkMode = document.body.classList.contains('dark-mode');

    activeButton.style.backgroundColor   = isDarkMode ? '#8e8d8d34' : '#f5f5f5';
    inactiveButton.style.backgroundColor = isDarkMode ? '#212529' : '#ffffff';
});

inactiveButton.addEventListener('click', () => {
    employeesList.style.display         = 'none';
    employeesListInactive.style.display = 'block';

    let isDarkMode = document.body.classList.contains('dark-mode');

    activeButton.style.backgroundColor   = isDarkMode ? '#212529' : '#ffffff';
    inactiveButton.style.backgroundColor = isDarkMode ? '#8e8d8d34' : '#f5f5f5';
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
    let tables = document.querySelectorAll('.table');
    const navItems = document.querySelectorAll('nav ul li');
    const svgImages = document.querySelectorAll('img'); // Sélectionnez toutes les images

    // Appliquer le mode sombre au chargement de la page si l'état enregistré est 'dark'
    if (localStorage.getItem('mode') === 'dark') {
        document.body.classList.add('dark-mode');
        darkModeSwitch.checked = true;
        tables.forEach(table => table.classList.add('table-dark'));
        navItems.forEach(item => item.classList.add('dark-mode')); // Ajouter la classe dark-mode aux éléments li
        svgImages.forEach(img => img.classList.add('dark-mode')); // Ajouter la classe dark-mode aux images SVG
    }

    // Lorsque l'utilisateur change le mode
    darkModeSwitch.addEventListener('change', () => {
        if (darkModeSwitch.checked) {
            // Activer le mode sombre et enregistrer l'état
            document.body.classList.add('dark-mode');
            localStorage.setItem('mode', 'dark');
            tables.forEach(table => table.classList.add('table-dark'));
            navItems.forEach(item => item.classList.add('dark-mode')); // Ajouter la classe dark-mode aux éléments li
            svgImages.forEach(img => img.classList.add('dark-mode')); // Ajouter la classe dark-mode aux images SVG
        } else {
            // Désactiver le mode sombre et enregistrer l'état
            document.body.classList.remove('dark-mode');
            localStorage.setItem('mode', 'light');
            tables.forEach(table => table.classList.remove('table-dark'));
            navItems.forEach(item => item.classList.remove('dark-mode')); // Supprimer la classe dark-mode des éléments li
            svgImages.forEach(img => img.classList.remove('dark-mode')); // Supprimer la classe dark-mode des images SVG
        }
    });
});
