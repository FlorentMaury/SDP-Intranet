arrowUp1   = document.querySelector('#arrowUp1');
arrowDown1 = document.querySelector('#arrowDown1');
arrowUp2   = document.querySelector('#arrowUp2');
arrowDown2 = document.querySelector('#arrowDown2');
arrowUp3   = document.querySelector('#arrowUp3');
arrowDown3 = document.querySelector('#arrowDown3');

employeesList = document.querySelector('#employeesList');
newUser       = document.querySelector('#newUser');
userInfos     = document.querySelector('#userInfos');

arrowUp1.style.cursor = 'pointer';
arrowUp2.style.cursor = 'pointer';
arrowUp3.style.cursor = 'pointer';
arrowDown1.style.cursor = 'pointer';
arrowDown2.style.cursor = 'pointer';
arrowDown3.style.cursor = 'pointer';

arrowDown1.style.display = 'none';
arrowDown2.style.display = 'none';
arrowDown3.style.display = 'none';

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
    userInfos.style.display = 'none';
    arrowUp3.style.display = 'none';
    arrowDown3.style.display = 'block';
});  

arrowDown3.addEventListener('click', () => {
    userInfos.style.display = 'block';
    arrowUp3.style.display = 'block';
    arrowDown3.style.display = 'none';
});