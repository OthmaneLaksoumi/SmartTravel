<?php
$title = "Ajouter une route";

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
                <button class="btn bg-orange text-white">Les horaires</button>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=route" class="btn active-in text-white">Les routes</a>

            </div>
        </div>
        <form class="main-form" action="index.php?action=add_route_action" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>DÉPART</label>
                            <select class="form-control" id="depart" name="depart">

                                <option disabled selected>Ville de départ</option>
                                <?php foreach ($cities as $city) : ?>
                                    <option><?= $city->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>ARRIVÉE</label>
                            <select class="form-control" id="arrive" name="arrive">
                                <option disabled selected>Ville d'arrivée</option>
                                <?php foreach ($cities as $city) : ?>
                                    <option><?= $city->getName(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Distance</label>
                            <input type="number" class="form-control" name="distance" required placeholder="Distance">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Durée</label>
                            <input type="text" class="form-control" name="duration" id="duration" required placeholder="Entrée un durée sous forme hh:mm:ss">
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-4 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <input type="submit" class="btn btn-success" value="Add">
            </div>
        </form>
    </div>
</div>



<?php $content = ob_get_clean(); ?>
<?php include("view\layout.php"); ?>


<script>
    let duration = document.querySelector("#duration");
    let form_add = document.querySelector("form");
    let regEx = /^\d{2}:\d{2}:\d{2}$/;
    duration.addEventListener('keyup', function() {
        console.log(regEx.test(duration.value));
        if (!regEx.test(duration.value)) {
            duration.classList = "form-control false-regEX";
            // form_add.addEventListener("submit", event.preventDefault());
        } else {
            duration.classList = "form-control";
        }
    });
    let depart = document.querySelector("#depart");
    let depart_options = depart.querySelectorAll('option');
    let arrive = document.querySelector("#arrive");
    let arrive_options = document.querySelector("#arrive").querySelectorAll('option');
    depart.addEventListener('change', function() {
        arrive_options.forEach(function(ele) {
            if (depart.value === ele.textContent) {
                ele.setAttribute('disabled', '');
            } else {
                ele.removeAttribute('disabled');
            }
        })
    })
</script>