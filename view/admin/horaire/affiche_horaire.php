<?php
$title = "Affiche All Horaires";

ob_start();
?>

<section>
    <div class="container mt-5">
        <div class="d-flex p-2 bg-secondary-subtle mb-3">
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
        <table class="table table-striped company-table">
            <tr>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Heure de départ</th>
                <th>Heure d'arrivée</th>
                <th>Date</th>
                <th>Available Seats</th>
                <th>Matricule</th>
                <th>Update & Delete</th>
            </tr>
            <?php foreach ($horaires as $horaire) : ?>
                <tr>
                    <td><?= $horaire->getDeparture_city(); ?></td>
                    <td><?= $horaire->getDestination_city() ?></td>
                    <td><?= $horaire->getDeparture_time() ?></td>
                    <td><?= $horaire->getDestination_time() ?></td>
                    <td><?= $horaire->getDate() ?></td>
                    <td><?= $horaire->getAvailable_seats() ?></td>
                    <td><?= $horaire->getMatricule() ?></td>
                    
                    <td>
                        <div class="my-2">
                            <a href="index.php?action=update_horaire&matricule=<?= $horaire->getMatricule() ?>&departure_time=<?= $horaire->getDeparture_time() ?>&destination_time=<?= $horaire->getDestination_time() ?>" class="btn bg-success text-white">Update</a>
                        
                            <a href="index.php?action=delete_horaire&matricule=<?= $horaire->getMatricule() ?>&departure_time=<?= $horaire->getDeparture_time() ?>&destination_time=<?= $horaire->getDestination_time() ?>" class="btn bg-danger text-white">Delete</a>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
        <div class="row">
            <a href="index.php?action=add_horaire" class="btn btn-success">Add</a>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php include("view\layout.php");
