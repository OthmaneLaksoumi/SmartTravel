<?php
$title = "Update une entrprise";

ob_start();
?>


<div class="container ">

    <div class="container mt-5">
        <div class="d-flex p-2 bg-secondary-subtle">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=company" class="btn active-in text-white">Les entreprises</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <a href="index.php?action=bus" class="btn bg-orange text-white">Les bus</a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <button class="btn bg-orange text-white">Les horaires</button>

            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                <button class="btn bg-orange text-white">Les routes</button>

            </div>
        </div>
        <form class="main-form" action="index.php?action=update_company_action" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <!-- <label>Name</label> -->
                            <input type="text" class="form-control" name="oldName" hidden value="<?= $company->getName() ?>">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $company->getName() ?>">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>L'image de l'entreprise</label>
                            <img src="<?= $company->getImg() ?>">
                            <input type="file" class="form-control" name="img">

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
