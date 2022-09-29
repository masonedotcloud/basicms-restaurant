<?php
require_once 'db.php';
require_once 'middleware.php';
adminOnly(); #controllo se ha i permessi per vedere questa pagine
$name_page = 'Dashboard'; #nome della pagina
include('includes/header.php'); ?>
<!--Sezione main della pagina-->
<div class="container">
    <div class="row mt-1 mb-4">
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="<?php echo "https://" . $_SERVER['SERVER_NAME'] ?>" class="d-flex justify-content-center align-items-center btn flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;" target="_blank">
                <img src="assets/images/site/globe2.svg" alt="globe2" width="32" height="32">
                <h3>Vai al sito</h3>
                <?php echo "https://" . $_SERVER['SERVER_NAME'] ?>
            </a>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <div class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;">
                <img src="assets/images/site/clock.svg" alt="clock" width="32" height="32">
                <h4 class="p-3">
                    <div class="digital-clock text-center"></div>
                </h4>
            </div>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="edit-profile.php" class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;">
                <img src="assets/images/site/person-lines-fill.svg" alt="person-lines-fill" width="32" height="32">
                <h3>Modifica profilo</h3>
            </a>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="category-index.php" class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;">
                <img src="assets/images/site/cart-plus.svg" alt="cart-plus" width="32" height="32">
                <h3>Categorie</h3>
            </a>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="food-index.php" class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;">
                <img src="assets/images/site/egg-fried.svg" alt="egg-fried" width="32" height="32">
                <h3>Cibo</h3>
            </a>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="site-edit.php" class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;">
                <img src="assets/images/site/gear.svg" alt="gear" width="32" height="32">
                <h3>Impostazioni sito</h3>
            </a>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="newsletter-index.php" class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;">
                <img src="assets/images/site/send.svg" alt="send" width="32" height="32">
                <h3>Newsletter</h3>
            </a>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="stats-index.php" class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;">
                <img src="assets/images/site/bar-chart-line.svg" alt="bar-chart-line" width="32" height="32">
                <h3>Stats</h3>
            </a>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="" class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <img src="assets/images/site/question-square.svg" alt="question-square" width="32" height="32">
                <h3>Help</h3>
            </a>
        </div>
        <!--Fine pulsante nella home-->
        <!--Pulsante nella home-->
        <div class="col-lg-4 col-md-6 d-flex justify-content-center align-items-center pt-3">
            <a href="logout.php" class="d-flex justify-content-center align-items-center btn btn-light flex-column white shadow " style="height: 260px; width: 100%; border-radius:25px;">
                <img src="assets/images/site/door-open.svg" alt="door-open" width="32" height="32">
                <h3>Logout</h3>
            </a>
        </div>
        <!--Fine pulsante nella home-->
    </div>
</div>
<!-- Sezione di script -->
<script type="module" src="statics/js/clock.js"></script>
<?php include('includes/footer.php'); ?>