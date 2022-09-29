<!--sidebar-->
<div class="col-sm-auto sticky-top white shadow">
    <div class="d-flex flex-sm-column flex-row flex-nowrap align-items-center sticky-top ">
        <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-wrap mb-auto mx-auto text-center justify-content-between w-100 align-items-center">
            <!--elemento sidebar-->
            <li class="nav-item">
                <a href="<?php echo "https://" . $_SERVER['SERVER_NAME'] ?>" class="nav-link pt-3 pb-3 p-1">
                    <img src="assets/images/site/globe2.svg" alt="globe2" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Vai al sito">
                </a>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li class="nav-item">
                <a href="index.php" class="nav-link pt-3 pb-3 p-1">
                    <img src="assets/images/site/speedometer2.svg" alt="" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Dashboard">
                </a>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li>
                <a href="edit-profile.php" class="nav-link pt-3 pb-3 p-1">
                    <img src="assets/images/site/person-lines-fill.svg" alt="" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Modifica profilo">
                </a>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li>
                <a href="" class="d-flex align-items-center justify-content-center link-dark text-decoration-none dropdown-toggle pt-3 pb-3 p-1" id="dropdowncategorie" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/images/site/cart-plus.svg" alt="mdo" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Categoria">
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdowncategorie">
                    <li>
                        <a class="dropdown-item" href="category-add.php">Aggiungi categoria</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="category-index.php">Visualizza categorie</a>
                    </li>
                </ul>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li>
                <a href="users.php" class="d-flex align-items-center justify-content-center link-dark text-decoration-none dropdown-toggle pt-3 pb-3 p-1" id="dropdowncibo" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/images/site/egg-fried.svg" alt="mdo" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Cibo">
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdowncibo">
                    <li>
                        <a class="dropdown-item" href="food-add.php">Aggiungi cibo</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="food-index.php">Visualizza cibo</a>
                    </li>
                </ul>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li>
                <a href="site-edit.php" class="nav-link pt-3 pb-3 p-1">
                    <img src="assets/images/site/gear.svg" alt="gear" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Impostazioni">
                </a>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li>
                <a href="newsletter-index.php" class="nav-link pt-3 pb-3 p-1">
                    <img src="assets/images/site/send.svg" alt="send" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Newsletter">
                </a>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li>
                <a href="stats-index.php" class="nav-link pt-3 pb-3 p-1">
                    <img src="assets/images/site/bar-chart-line.svg" alt="bar-chart-line" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Newsletter">
                </a>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li>
                <a href="" class="nav-link pt-3 pb-3 p-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="assets/images/site/question-square.svg" alt="" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Help">
                </a>
            </li>
            <!--fine elemento sidebar-->
            <!--elemento sidebar-->
            <li>
                <a href="logout.php" class="nav-link pt-3 pb-3 p-1">
                    <img src="assets/images/site/door-open.svg" alt="" width="24" height="24" data-toggle="tooltip" data-placement="top" title="Logout">
                </a>
            </li>
        </ul>
    </div>
</div>
<!--fine sidebar-->