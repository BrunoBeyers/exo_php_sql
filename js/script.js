//Déclaration des variables pour cibler des éléments HTML
const table_hackers = document.querySelector('.table_hackers');
const table_stolen_data = document.querySelector('.table_stolen_data');
const rowsHackers = table_hackers.getElementsByTagName('tr');
const rowsStolenData = table_stolen_data.getElementsByTagName('tr');
const noDataTitle = document.querySelector('.noDataTitle');
const noDataTr = document.querySelector('.noDataTr');
const teest = document.querySelector('.teest');
noDataTitle.classList.add('hidden');


// Ajouter d'un écouteur d'événement de clic sur chaque ligne du tableau
for (let i = 1; i < rowsHackers.length; i++) {
    rowsHackers[i].addEventListener('click', function() {
        console.log("click" + i);
        const hackerId = this.getAttribute('data-id');
        const hackerName = this.getAttribute('data-name');
        console.log(hackerName);
        filterStolenData(hackerId);
        teest.textContent = `Hacks by: ${hackerName}`;
    });
}

// Fonction pour afficher seulement les données volées par un hacker selectionné
function filterStolenData(hackerId) {
    let nbElements = 0;
    for (let i = 1; i < rowsStolenData.length; i++) {
        const row = rowsStolenData[i];
        if (row.getAttribute('data-hacker-id') === hackerId) {
            row.classList.remove('hidden'); 
            nbElements++;
        } else {
            row.classList.add('hidden'); 
        }
    }

//permet d'afficher ou pas les titres du tableau s'il n'y a pas de données
    if (nbElements == 0) {
        noDataTitle.classList.remove('hidden');
      
        noDataTr.classList.add('hidden');
    }else{
        noDataTitle.classList.add('hidden');
        noDataTr.classList.remove('hidden');
        
    }
}


//https://dbdiagram.io/d/67daacaa75d75cc844ac0762

