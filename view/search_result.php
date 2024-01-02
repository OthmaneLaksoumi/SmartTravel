<?php
$title = "Affiche All Buses";
$horaire = new horaireDAO();

ob_start();
?>


<section>
    <div class="mt-5 d-flex col-12">
        <div class="d-flex flex-column p-3 border rounded-3 col-3 side-bar">
            <div>
                <p class="h5">Société</p>
                <ul class="d-flex flex-column" id="company_filter" name="company_filter">
                    <?php foreach ($names as $key => $name) : ?>
                        <li class="mt-3">
                            <input type="checkbox" class="form-check-input company-name" data-company="<?= $name ?>" id="<?= "company-" . ($key + 1) ?>">
                            <label class="form-check-label" for="<?= "company-" . ($key + 1) ?>"><?= $name ?></label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="mt-5">
                <p class="h5">Prix par personne</p>
                <input type="range" class="form-range" min="0" max="50" value="0" name="" id="prixRangeMin">
                <span id="rangeValueMin">Min: 0.00DH</span>
                <input type="range" class="form-range" min="0" max="50" value="50" name="" id="prixRangeMax">
                <span id="rangeValueMax">Max: 50.00DH</span>
            </div>
            <div class="mt-5">
                <p class="h5">Heure de départ</p>
                <ul class="d-flex flex-column" id="company_filter" name="company_filter">
                    <li class="mt-3">
                        <input type="checkbox" class="form-check-input time" name="" id="matin">
                        <label class="form-check-label" for="matin">Matin (0h - 12h)</label>
                    </li>
                    <li class="mt-3">
                        <input type="checkbox" class="form-check-input time" name="" id="midi">
                        <label class="form-check-label" for="midi">Après-midi (12h - 17h)</label>
                    </li>
                    <li class="mt-3">
                        <input type="checkbox" class="form-check-input time" name="" id="soir">
                        <label class="form-check-label" for="soir">Soir (17h - 0h)</label>
                    </li>
                </ul>
            </div>
        </div>
        <?php if ($horaires) { ?>
            <div class="col-9 container horaires-companies">
                <h4><?= $depart . " vers " . $arrive . " le " . $date . ": " . count($horaires) . " résultats" ?> </h4>
                <input type="text" id="depart" value="<?= $depart ?>" hidden>
                <input type="text" id="arrive" value="<?= $arrive ?>" hidden>
                <input type="text" id="date" value="<?= $date ?>" hidden>
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Société</th>
                            <th>Heure de départ</th>
                            <th>Heure d'arrivée</th>
                            <th>Durée</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody class="company-table">

                    </tbody>
                </table>

            </div>
    </div>
<?php } else { ?>
    <div class="col-9 container">
        <h4><?= $depart . " vers " . $arrive . " le " . $date  ?> </h4>
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Aucun voyage trouvé</h5>
                <p class="text-warning fw-bold text-xl">Aucun départ disponible de <?= $depart ?> à <?= $arrive ?> pour le <?= $date ?> !</p>
                <a href="index.php" class="btn bg-orange text-white">Go Back</a>
            </div>
        </div>

    </div>
    </div>


<?php } ?>
</section>


<?php $content = ob_get_clean(); ?>
<?php include("view\layout.php"); ?>

<script>
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

    /* END FILTER BY TIME */

    /* FILTER BY PRICE */

    let range_of_prix_min = document.getElementById('prixRangeMin');
    let range_value_min = document.getElementById('rangeValueMin');

    let range_of_prix_max = document.getElementById('prixRangeMax');
    let range_value_max = document.getElementById('rangeValueMax');
    // range_of_prix_max.addEventListener('input', function() {
    //     range_value_max.textContent = "Max: " + range_of_prix_max.value + ".00DH";
    // });

    let prices = [];
    all_horaires_action.forEach(function(horaire) {
        prices.push(getPriceOfHoraire(horaire));
    });
    minOfPrices = Math.min(...prices);
    maxOfPrices = Math.max(...prices);

    range_of_prix_min.setAttribute('min', minOfPrices);
    range_of_prix_min.setAttribute('max', maxOfPrices);
    range_of_prix_min.value = minOfPrices;
    range_value_min.textContent = "Min: " + minOfPrices + ".00DH";

    range_of_prix_max.setAttribute('min', minOfPrices);
    range_of_prix_max.setAttribute('max', maxOfPrices);
    range_of_prix_max.value = maxOfPrices;
    range_value_max.textContent = "Min: " + maxOfPrices + ".00DH";

    range_of_prix_min.addEventListener('input', function() {
        companies_table.innerHTML = '';
        range_value_min.textContent = "Min: " + this.value + ".00DH";
        all_horaires.forEach(function(horaire) {
            if (getPriceOfHoraire(horaire) >= range_of_prix_min.value && getPriceOfHoraire(horaire) <= range_of_prix_max.value) displayHoraire(horaire);
        });
    });

    range_of_prix_max.addEventListener('input', function() {
        companies_table.innerHTML = '';
        range_value_max.textContent = "Max: " + this.value + ".00DH";
        all_horaires.forEach(function(horaire) {
            if (getPriceOfHoraire(horaire) >= range_of_prix_min.value && getPriceOfHoraire(horaire) <= range_of_prix_max.value) displayHoraire(horaire);
        });
    });
</script>