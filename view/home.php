<?php
$title = "Home";

ob_start();
?>
<!-- Search travel -->
<section>
    <div class="banner-main">
        <img src="public/images/banner.jpg" alt="#" />
        <div class="container">
            <div class="text-bg">
                <div class="container">
                    <form class="main-form">
                        <h3>Find Your Tour</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <label>DÉPART</label>
                                        <select class="form-control" name="depart">

                                            <option>Ville de départ</option>
                                            <?php foreach($cities as $city): ?>
                                                <option><?= $city->getName(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <label>ARRIVÉE</label>
                                        <select class="form-control" name="arrive">
                                            <option>Ville d'arrivée</option>
                                            <?php foreach($cities as $city): ?>
                                                <option><?= $city->getName(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <label>Date</label>
                                        <input class="form-control" placeholder="Any" type="date" name="Any">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <label>VOYAGEURS</label>
                                        <input type="number" class="form-control" name="nbrOfPerssone" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <a href="#">search</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Search travel -->

<!-- about -->
<div id="about" class="about">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="titlepage">
                    <h2>About our travel agency</h2>
                    <span> fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</span>
                </div>
            </div>
        </div>
    </div>
    <div class="bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="about-box">
                        <p> <span>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure thereThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there</span></p>
                        <div class="palne-img-area">
                            <img src="public/images/plane-img.png" alt="images">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end about -->



<?php $content = ob_get_clean(); ?>
<?php include("view/layout.php"); ?>