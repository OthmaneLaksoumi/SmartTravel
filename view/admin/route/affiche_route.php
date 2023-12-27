<?php
$title = "Affiche All Routes";

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
                <a href="index.php?action=horaire" class="btn bg-orange text-white">Les entreprises</a>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=route" class="btn active-in text-white">Les routes</a>

            </div>
        </div>
        <table class="table table-striped company-table">
            <tr>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Distance</th>
                <th>Durée</th>
                <th>Update & Delete</th>
            </tr>
            <?php foreach ($routes as $route) : ?>
                <tr>
                    <td><?= $route->getDepartue_city(); ?></td>
                    <td><?= $route->getDestination_city() ?></td>
                    <td><?= $route->getDistance() ?></td>
                    <td><?= $route->getDuration() ?></td>

                    <td>
                        <div class="my-2">
                            <a href="index.php?action=update_route" class="btn bg-success text-white">Update</a>

                            <a href="index.php?action=delete_route" class="btn btn-danger w-25">Delete</a>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
        <div class="row">
            <a href="index.php?action=add_route" class="btn btn-success">Add</a>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php include("view\layout.php");
