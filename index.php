<?php
require_once 'connect.php';
include("controller-newsletter.php");
include("controller-access.php");
#query per le caratteristiche basi del sito
$sql = "SELECT * FROM setting_table LIMIT 1";
$result = mysqli_query($conn, $sql);
$site = mysqli_fetch_array($result);
#query per le categorie
$sql = "SELECT * FROM category_table WHERE status = \"1\"";
$result = mysqli_query($conn, $sql);
$name_page =  $site['name']; #nome della pagine
include('includes/header.php'); ?>
<div id="home"></div>
<header class="d-flex justify-content-center flex-column flex-md-row  py-3 mb-4 sticky-top white shadow">
    <a href="./" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none justify-content-center">
        <img src="../admin/assets/images/site/<?php echo $site['image']; ?>" alt="" width="50px" height="50px" class="ms-3 me-3">
        <span class="fs-4"><?php echo $site['name'] ?></span>
    </a>
    <ul class="nav nav-pills d-flex justify-content-center align-items-center ">
        <li class="nav-item"><a href="#home" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#newsletter_id" class="nav-link">Newsletter</a></li>
        <li><a href="#translate"><img src="/assets/images/site/translate.svg" alt="translate" width="24px" height="24px" class="me-3"></a></li>
    </ul>
</header>
<div class="container">
    <div class="m-5">
        <h1 class="text-center"><?php echo $site['name'] ?></h1>
        <p class="text-center"><?php echo $site['description'] ?></p>
    </div>
    <h1 class="text-center mb-4">Pietanze</h1>
    <?php if (mysqli_num_rows($result) > 0) { #se sono presenti categorie ?>
        <?php while ($row = mysqli_fetch_array($result)) { #stampa fin quando non stampa tutte le categorie ?>
            <?php $search = $row['id']; #query per i cibi della categoria attuale ?>
            <?php $sql = "SELECT * FROM food_table WHERE category = " . "\"$search\"" . " AND status = \"1\""; ?>
            <?php $result3 = mysqli_query($conn, $sql); ?>
            <p>
                <button class="btn btn-primary w-100 d-flex justify-content-center mb-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $row['id']; ?>">
                    <h4><?php echo $row['name'] . " (" . mysqli_num_rows($result3) . ")" ?></h4>
                </button>
            </p>
            <div class="collapse mb-5 ms-3 me-3" id="collapse<?php echo $row['id']; ?>">
                <div class="d-flex flex-column">
                    <?php if (mysqli_num_rows($result3) > 0) { #se sono prsenti cibi ?>
                        <?php while ($row2 = mysqli_fetch_array($result3)) { #ripete fin quando non stampa tutti i cibi ?>
                            <?php if ($row2['category'] == $row['id']) { ?>
                                <div class="d-flex flex-row mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="admin/assets/images/food/cover/<?php echo $row2['image'] ?>" alt="immagine cibo" width="75" height="50" class="border border-5">
                                    </div>
                                    <ul class="w-100 align-middle mb-0">
                                        <li class=" mb-2 list-group-item">
                                            <p class="mb-0 mb-n1 "><?php echo $row2['name'] ?></p>
                                            <p class="mb-0 mb-n1"><?php echo $row2['description'] ?></p>
                                        </li>
                                        <li class="border-bottom mb-2 list-group-item d-flex justify-content-between">
                                            <h6 class=" mb-n1">Prezzo</h6>
                                            <p class=" mb-n1"><?php echo number_format($row2['price'], 2); ?> €</p>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } else if (mysqli_num_rows($result) == 0) { #se non sono presenti utenti ?>
                        <div class="alert alert-warning" role="alert">
                            Nessuna cibo caricato
                        </div>
                    <?php } else { #se c'è stato un errore con il database ?>
                        <div class="alert alert-danger" role="alert">
                            Errore di connessione al Database
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <div style="height: 500px;"></div>
</div>
<footer class="white pt-5 border-top" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px;">
    <div class=" d-flex justify-content-center">
        <div class="col-lg-4">
            <!--visualizza stato risultato-->
            <?php include("formStatus.php"); ?>
            <!--fine visualizza visualizza stato risultato-->
            <div id="newsletter_id"></div>
            <form action="#newsletter_id" method="POST">
                <h5>Sottoscriviti</h5>
                <p><?php echo $site['name'] ?> vuole tenerti aggiornato!</p>
                <div class="d-flex w-100 gap-2">
                    <label for="newsletter1" class="visually-hidden">Email</label>
                    <input id="newsletter1" type="text" class="form-control" placeholder="Email" name="email">
                    <button class="btn btn-primary" type="submit" name="add-newsletter">Sottoscriviti</button>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center pt-5 pb-5 pb-0 text-center">
        <p>© 2022 Company, Inc. All rights reserved.<br><?php echo $site['email'] ?></p>
    </div>
    <div id="translate"></div>
    <div id="google_translate_element" class="me-3 google_translate_element"></div>
</footer>
<?php include('includes/footer.php'); ?>