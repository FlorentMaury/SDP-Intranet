arrowUp1   = document.querySelector('#arrowUp1');
arrowDown1 = document.querySelector('#arrowDown1');
arrowUp2   = document.querySelector('#arrowUp2');
arrowDown2 = document.querySelector('#arrowDown2');
arrowUp3   = document.querySelector('#arrowUp3');
arrowDown3 = document.querySelector('#arrowDown3');
arrowUp4   = document.querySelector('#arrowUp4');
arrowDown4 = document.querySelector('#arrowDown4');

employeesList = document.querySelector('#employeesList');
newUser       = document.querySelector('#newUser');
userInfos1    = document.querySelector('#userInfos1');
userInfos2    = document.querySelector('#userInfos2');
userExp       = document.querySelector('#userExp');

arrowUp1.style.cursor = 'pointer';
arrowUp2.style.cursor = 'pointer';
arrowUp3.style.cursor = 'pointer';
arrowUp4.style.cursor = 'pointer';
arrowDown1.style.cursor = 'pointer';
arrowDown2.style.cursor = 'pointer';
arrowDown3.style.cursor = 'pointer';
arrowDown4.style.cursor = 'pointer';

arrowDown1.style.display = 'none';
arrowDown2.style.display = 'none';
arrowDown3.style.display = 'none';
arrowDown4.style.display = 'none';

arrowUp1.addEventListener('click', () => {
    employeesList.style.display = 'none';
    arrowUp1.style.display = 'none';
    arrowDown1.style.display = 'block';
});  

arrowDown1.addEventListener('click', () => {
    employeesList.style.display = 'block';
    arrowUp1.style.display = 'block';
    arrowDown1.style.display = 'none';
});

arrowUp2.addEventListener('click', () => {
    newUser.style.display = 'none';
    arrowUp2.style.display = 'none';
    arrowDown2.style.display = 'block';
});  

arrowDown2.addEventListener('click', () => {
    newUser.style.display = 'block';
    arrowUp2.style.display = 'block';
    arrowDown2.style.display = 'none';
});

arrowUp3.addEventListener('click', () => {
    userInfos1.style.display = 'none';
    userInfos2.style.display = 'none';
    arrowUp3.style.display = 'none';
    arrowDown3.style.display = 'block';
});  

arrowDown3.addEventListener('click', () => {
    userInfos1.style.display = 'block';
    userInfos2.style.display = 'block';
    arrowUp3.style.display = 'block';
    arrowDown3.style.display = 'none';
});

arrowUp4.addEventListener('click', () => {
    userExp.style.display = 'none';
    arrowUp4.style.display = 'none';
    arrowDown4.style.display = 'block';
});  

arrowDown4.addEventListener('click', () => {
    userExp.style.display = 'block';
    arrowUp4.style.display = 'block';
    arrowDown4.style.display = 'none';
});

// Ajouter une expérience scolaire

addSchool = document.querySelector('#addSchool');
school2   = document.querySelector('#school2');
cancel    = document.querySelector('#cancel');

addSchool.style.cursor = 'pointer';
cancel.style.cursor = 'pointer';
cancel.style.display = 'none';
school2.display = 'none';

addSchool.addEventListener('click', () => {
    school2.style.display = 'block';
    cancel.style.display = 'block';
    addSchool.style.display = 'none';
});

cancel.addEventListener('click', () => {
    school2.style.display = 'none';
    cancel.style.display = 'none';
    addSchool.style.display = 'block';
});