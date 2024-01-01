<?php
$title = "Update une horaire";

ob_start();
?>


<div class="container ">

    <div class="container mt-5">
        <div class="d-flex p-2 bg-secondary-subtle">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=company" class="btn bg-orange text-white">Les entreprises</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=bus" class="btn bg-orange text-white">Les bus</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=horaire" class="btn active-in text-white">Les horaires</a>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=route" class="btn bg-orange text-white">Les routes</a>

            </div>
        </div>
        <form class="main-form border border-dark-subtle" action="index.php?action=update_horaire_action" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <input type="text" hidden name="old_matricule" value="<?= $horaire->getMatricule() ?>">
                            <input type="text" hidden name="old_depart_time" value="<?= $horaire->getDeparture_time() ?>">
                            <input type="text" hidden name="old_arrive_time" value="<?= $horaire->getDestination_time() ?>">
                            <label>Départ et Arrivée</label>
                            <select class="form-control" id="depart_arrive" name="depart_arrive">
                                <option disabled selected>Départ et Arrivée</option>
                                <?php foreach ($routes as $route) : ?>
                                    <?php if ($route->getDepartue_city() == $horaire->getDeparture_city() && $route->getDestination_city() == $horaire->getDestination_city()) { ?>
                                        <option selected><?= $route->getDepartue_city() . " - " . $route->getDestination_city(); ?></option>
                                    <?php } else { ?>
                                        <option><?= $route->getDepartue_city() . " - " . $route->getDestination_city(); ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?= $horaire->getDate() ?>" required>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Heure de départ</label>
                            <input type="time" class="form-control" id="depart_time" name="depart_time" value="<?= $horaire->getDeparture_time() ?>" required>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Heure d'arrivée</label>
                            <input type="time" class="form-control" id="arrive_time" name="arrive_time" value="<?= $horaire->getDestination_time() ?>" required>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Available Seats</label>
                            <input type="number" class="form-control" name="nbr_seats" value="<?= $horaire->getAvailable_seats() ?>" required>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <label>Matricule Of Bus</label>
                            <select class="form-control" name="matricule">
                                <option disabled selected>Matricule Of Bus</option>
                                <?php foreach ($buses as $bus) : ?>
                                    <?php if ($bus->getMatricule() == $horaire->getMatricule()) { ?>
                                        <option selected><?= $bus->getMatricule() ?></option>
                                    <?php } else { ?>
                                        <option><?= $bus->getMatricule() ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-4 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <input type="submit" class="btn btn-success" value="Update">
            </div>
        </form>
    </div>
</div>



<?php $content = ob_get_clean(); ?>
<?php include("view\layout.php"); ?>


<script>
    // let duration = document.querySelector("#duration");
    // let form_add = document.querySelector("form");
    // let regEx = /^\d{2}:\d{2}:\d{2}$/;
    // duration.addEventListener('keyup', function() {
    //     console.log(regEx.test(duration.value));
    //     if (!regEx.test(duration.value)) {
    //         duration.classList = "form-control false-regEX";
    //         // form_add.addEventListener("submit", event.preventDefault());
    //     } else {
    //         duration.classList = "form-control";
    //     }
    // });

    let depart_time = document.getElementById("depart_time");
    let arrive_time = document.getElementById("arrive_time");


    let date_enter = document.getElementById("date");

    const test_date = new Date();
    let x = test_date.toISOString().split("T")[0];
    date_enter.setAttribute('min', x);

    arrive_time.addEventListener('keyup', function() {
        if (depart_time.value >= arrive_time.value) {
            arrive_time.classList = "form-control false-regEX";
        } else {
            arrive_time.classList = "form-control";
        }
    });

    document.getElementById("date").addEventListener('change', function() {
        let cuurent_date = Date.parse(new Date());
        let date_selected = Date.parse(document.getElementById("date").value);
        console.log(cuurent_date, date_selected);
        console.log(date_selected >= cuurent_date);
    });
</script>