<?php
$title = "Update une entrprise";

ob_start();
?>


<div class="container ">

    <div class="container mt-5">
        <div class="d-flex p-2 bg-secondary-subtle">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=company" class="btn bg-orange text-white">Les entreprises</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=bus" class="btn active-in text-white">Les bus</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=horaire" class="btn bg-orange text-white">Les horaires</a>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
            <a href="index.php?action=route" class="btn bg-orange text-white">Les routes</a>

            </div>
        </div>
        <form class="main-form" action="index.php?action=update_bus_action" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <input type="text" class="form-control" hidden name="old_matricule" value="<?= $bus->getMatricule() ?>" placeholder="Matricule">

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Matricule</label>
                            <input type="text" class="form-control" name="matricule" value="<?= $bus->getMatricule() ?>" placeholder="Matricule">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Number of the bus</label>
                            <input type="number" class="form-control" name="number_of_bus" value="<?= $bus->getNumber_of_bus() ?>" placeholder="Number of the bus">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Capacity</label>
                            <input type="number" class="form-control" name="capacity" value="<?= $bus->getCapacity() ?>" placeholder="Capacity">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Company Name</label>
                            <select class="form-control" name="company_name">
                                <?php foreach ($companies as $company) : ?>

                                    <?php if ($company->getName() === $bus->getCompany()) { ?>
                                        <option selected><?= $company->getName() ?></option>
                                    <?php } else { ?>
                                        <option><?= $company->getName() ?></option>
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
<?php include("view\layout.php");
