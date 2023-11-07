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

const buttons = [generalUserInfosButton, userSchoolButton, userExpButton, userContractButton, userTimeBankButton];

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
    buttons.forEach(btn => btn.classList.remove('active'));
    generalUserInfosButton.classList.add('active');
});

userSchoolButton.addEventListener('click', () => {
    userSchool.style.display = 'block';
    generalUserInfos.style.display = 'none';
    userExp.style.display          = 'none';
    userContract.style.display     = 'none';
    userTimeBank.style.display     = 'none';
    buttons.forEach(btn => btn.classList.remove('active'));
    userSchoolButton.classList.add('active');
});

userExpButton.addEventListener('click', () => {
    userExp.style.display    = 'block';
    generalUserInfos.style.display = 'none';
    userSchool.style.display       = 'none';
    userContract.style.display     = 'none';
    userTimeBank.style.display     = 'none';
    buttons.forEach(btn => btn.classList.remove('active'));
    userExpButton.classList.add('active');
});

userContractButton.addEventListener('click', () => {
    userContract.style.display = 'block';
    generalUserInfos.style.display = 'none';
    userSchool.style.display       = 'none';
    userExp.style.display          = 'none';
    userTimeBank.style.display     = 'none';
    buttons.forEach(btn => btn.classList.remove('active'));
    userContractButton.classList.add('active');
});

userTimeBankButton.addEventListener('click', () => {
    userTimeBank.style.display = 'block';
    generalUserInfos.style.display = 'none';
    userSchool.style.display       = 'none';
    userExp.style.display          = 'none';
    userContract.style.display     = 'none';
    buttons.forEach(btn => btn.classList.remove('active'));
    userTimeBankButton.classList.add('active');
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