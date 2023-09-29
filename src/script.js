arrow1 = document.querySelector('#arrow1');
arrow2 = document.querySelector('#arrow2');
arrow3 = document.querySelector('#arrow3');

employeesList = document.querySelector('#employeesList');

arrow1.addEventListener('click', () => {
    employeesList.textContent = null;
});  

arrow2.addEventListener('click', () => {});  
arrow3.addEventListener('click', () => {});  