<?php
$title = "Affiche All companies";

ob_start();
?>

<section>
    <div class="container mt-5">
        <div class="d-flex p-2 bg-secondary-subtle">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=company" class="btn bg-orange text-white active-in">Les entreprises</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=bus" class="btn bg-orange text-white">Les bus</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <button class="btn bg-orange text-white">Les horaires</button>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=route" class="btn bg-orange text-white">Les routes</a>

            </div>
        </div>
        <table class="table table-striped company-table">
            <tr>
                <th>Nom de l'entreprise</th>
                <th>Image de l'entreprise</th>
                <th>Update & Delete</th>
            </tr>
            <?php foreach ($companies as $company) : ?>
                <tr>
                    <td><?= $company->getName(); ?></td>
                    <td><img src="<?= $company->getImg(); ?>"></td>
                    <td>
                        <div class="my-2">
                            <a href="index.php?action=update_company&name=<?= $company->getName(); ?>" class="btn bg-success text-white">Update</a>
                        </div>
                        <div>
                            <a href="index.php?action=delete_company&name=<?= $company->getName(); ?>" class="btn btn-danger w-25">Delete</a>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
        <div class="row">
            <a href="index.php?action=add_company" class="btn btn-success">Add</a>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php include("view\layout.php");
