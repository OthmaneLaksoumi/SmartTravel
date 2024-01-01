<?php
$title = "Affiche All Buses";

ob_start();
?>

<section>
    <div class="container mt-5">
        <div class="d-flex p-2 bg-secondary-subtle mb-3">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=company" class="btn bg-orange text-white">Les entreprises</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=bus" class="btn text-white active-in">Les bus</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=horaire" class="btn bg-orange text-white">Les horaires</a>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=route" class="btn bg-orange text-white">Les routes</a>

            </div>
        </div>
        <table class="table table-striped company-table">
            <tr>
                <th>Matricule</th>
                <th>Number Of Bus</th>
                <th>Capacity</th>
                <th>Company Name</th>
                <th>Update & Delete</th>
            </tr>
            <?php foreach ($buses as $bus) : ?>
                <tr>
                    <td><?= $bus->getMatricule(); ?></td>
                    <td><?= $bus->getNumber_of_bus() ?></td>
                    <td><?= $bus->getCapacity() ?></td>
                    <td><?= $bus->getCompany() ?></td>
                    <td>
                        <div class="my-2">
                            <a href="index.php?action=update_bus&matricule=<?= $bus->getMatricule() ?>" class="btn bg-success text-white">Update</a>
                        </div>
                        <div>
                            <a href="index.php?action=delete_bus&matricule=<?= $bus->getMatricule() ?>" class="btn btn-danger">Delete</a>
                            
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
        <div class="row">
            <a href="index.php?action=add_bus" class="btn btn-success">Add</a>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php include("view\layout.php");
