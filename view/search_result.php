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
   <?php include("public/js/filter.js") ?>
</script>