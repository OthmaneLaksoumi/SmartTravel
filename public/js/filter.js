function getAllHoraire() {
    let result;
    let myRequest = new XMLHttpRequest();
    myRequest.open("GET", "model/ajax/companyAjax.php?allHoraire", false);
    myRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            result = JSON.parse(this.responseText);
        }
    }
    myRequest.send();
    return result;
}

function getAllHoraireForRoute(depart, arrive, date) {
    let result = [];
    getAllHoraire().forEach(function(horaire) {
        if (horaire['departure_city'] == depart && horaire['destination_city'] == arrive && horaire['date'] == date) {
            result.push(horaire);
        }
    });
    return result;
}

function getImgForBus(matricule) {
    let result;
    let myRequest = new XMLHttpRequest();
    myRequest.open("GET", "model/ajax/companyAjax.php?matricule=" + matricule, false);
    myRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            result = this.responseText;
        }
    }
    myRequest.send();
    return result;
}

function getCompanyForHoraire(horaire) {
    let result;
    let myRequest = new XMLHttpRequest();
    myRequest.open("GET", "model/ajax/companyAjax.php?company=" + horaire['matricule'], false);
    myRequest.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            result = this.responseText.trim();
        }
    }
    myRequest.send();
    return result;

}


function getDurationOfHoraire(horaire) {
    let departTime = horaire['departure_time'];
    let arriveTime = horaire['destination_time'];
    let t1 = departTime.split(':');
    let t2 = arriveTime.split(':');
    let duration = ((t2[0] - t1[0]) * 60 + (t2[1] - t1[1])); //Duration in minutes
    let numberOfHours = Math.trunc(duration / 60);
    let numberOfMinutes = Math.trunc((duration - numberOfHours * 60));
    return numberOfMinutes != 0 ? numberOfHours + "h " + numberOfMinutes + "min" : numberOfHours + "h ";
}

function getPriceOfHoraire(horaire) {
    let departTime = horaire['departure_time'];
    let arriveTime = horaire['destination_time'];
    let t1 = departTime.split(':');
    let t2 = arriveTime.split(':');
    let duration = ((t2[0] - t1[0]) * 60 + (t2[1] - t1[1])); //Duration in minutes
    return duration * 0.4; // Chaque minute est de prix 0.4DH
}

let companies_table = document.querySelector('.company-table');

function displayHoraire(horaire) {
    companies_table.innerHTML += `
<tr>
<td><img src="${getImgForBus(horaire['matricule'])}"/></td>
<td> ${horaire['departure_time']}</td>
<td> ${horaire['destination_time']}</td>
<td> ${getDurationOfHoraire(horaire)} </td>
<td> ${getPriceOfHoraire(horaire)}.00DH</td>
</tr>
`;
}

let depart = document.getElementById('depart').value;
let arrive = document.getElementById('arrive').value;
let date = document.getElementById('date').value;

/* FILTER BY COMPANY */

let company_filter = document.getElementById('company_filter');
let company_name = document.querySelectorAll('.company-name');


let all_horaires = getAllHoraireForRoute(depart, arrive, date);
let all_horaires_action = all_horaires;

function displayHoraireOfCompany(company) {
    all_horaires_action.forEach(function(horaire) {
        if (getCompanyForHoraire(horaire) == company) displayHoraire(horaire);
    });
}

function displayHoraireAllHoraire() {
    all_horaires_action.forEach(function(horaire) {
        displayHoraire(horaire);
    });
}

displayHoraireAllHoraire();

let arrayFilterCompany = {};
company_name.forEach(function(list) {
    arrayFilterCompany[list.getAttribute('data-company')] = false;
});

function allAreFalse() {
    for (let i = 0; i < company_name.length; i++) {
        if (arrayFilterCompany[company_name[i].getAttribute('data-company')]) {
            return false;
        }
    }
    return true;
}

company_name.forEach(function(list) {
    list.addEventListener('change', function() {
        arrayFilterCompany[list.getAttribute('data-company')] = list.checked;
        if (allAreFalse()) {
            companies_table.innerHTML = '';
            all_horaires_action = all_horaires;
            displayHoraireAllHoraire();
        } else {
            companies_table.innerHTML = '';
            all_horaires_action = [];
            all_horaires.forEach(function(horaire) {
                if (arrayFilterCompany[getCompanyForHoraire(horaire)]) all_horaires_action.push(horaire);
            });
            displayHoraireAllHoraire();
        }
    });
});

/* END FILTER BY COMPANY */

/* FILTER BY TIME */

let matin = [];
let midi = [];
let soir = [];

let times = document.querySelectorAll('.time');

times.forEach(function(t) {
    t.addEventListener('change', function() {
        companies_table.innerHTML = '';

        if (!times[0].checked && !times[1].checked && !times[2].checked) {
            all_horaires_action.forEach(function(horaire) {
                displayHoraire(horaire);
            });
        } else {
            matin = [];
            midi = [];
            soir = [];
            all_horaires_action.forEach(function(horaire, i) {
                let h = horaire['departure_time'].split(':')[0] * 60;
                let m = Number(horaire['departure_time'].split(':')[1]);
                if (h + m <= 12 * 60) matin.push(i);
                else if (h + m > 12 * 60 && h + m <= 17 * 60) midi.push(i);
                else soir.push(i);
            });

            if (times[0].checked) {
                matin.forEach(function(index) {
                    displayHoraire(all_horaires_action[index]);
                });
            }
            if (times[1].checked) {
                midi.forEach(function(index) {
                    displayHoraire(all_horaires_action[index]);
                });
            }
            if (times[2].checked) {
                soir.forEach(function(index) {
                    displayHoraire(all_horaires_action[index]);
                });
            }
        }
    });
});

let range_of_prix_min = document.getElementById('prixRangeMin');
let range_value_min = document.getElementById('rangeValueMin');
range_of_prix_min.addEventListener('input', function() {
    range_value_min.textContent = "Min: " + range_of_prix_min.value + ".00DH";
});
let range_of_prix_max = document.getElementById('prixRangeMax');
let range_value_max = document.getElementById('rangeValueMax');
range_of_prix_max.addEventListener('input', function() {
    range_value_max.textContent = "Max: " + range_of_prix_max.value + ".00DH";
});