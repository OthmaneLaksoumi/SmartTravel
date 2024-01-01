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
                    <form class="main-form" method="post" action="index.php?action=search">
                        <h3>Find Your Tour</h3>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label>DÉPART</label>
                                    <select class="form-control" name="depart" id="depart" required>

                                        <option selected disabled>Ville de départ</option>
                                        <?php foreach ($cities as $city) : ?>
                                            <option><?= $city->getName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label>ARRIVÉE</label>
                                    <select class="form-control" name="arrive" id="arrive" required>
                                        <option selected disabled>Ville d'arrivée</option>
                                        <?php foreach ($cities as $city) : ?>
                                            <option><?= $city->getName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label>Date</label>
                                    <input class="form-control" type="date" id="date" name="date" required>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label>VOYAGEURS</label>
                                    <input type="number" class="form-control" name="nbrOfPerssone" value="1" required>
                                </div>
                            </div>
                            <div class="row col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <input type="submit" class="btn bg-orange text-white mt-4" value="search">
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


<script>
    /* Set the min date is current date */

    let date_enter = document.getElementById("date");
    const date = new Date();
    let x = date.toISOString().split("T")[0];
    date_enter.setAttribute('min', x);

    /* End Set the min date is current date */

    /* depart and arrive city are differents */
    let depart_city = document.getElementById("depart");
    let arrive_city_options = document.getElementById("arrive").querySelectorAll('option');

    depart_city.addEventListener('change', function() {
        arrive_city_options.forEach(function(opt) {
            if (depart_city.value == opt.value) {
                opt.setAttribute('disabled', '');
            } else {
                opt.removeAttribute('disabled')
            }
        });
    });
    /* End depart and arrive city are differents */

    /* */
    let request = new XMLHttpRequest();





    /* */
</script>