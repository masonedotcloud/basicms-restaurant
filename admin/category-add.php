<?php
include("controller-category.php");
adminOnly();
$name_page = "Aggiungi categoria";
include('includes/header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <?php include('includes/sidebar.php'); ?>
        <div class="col-sm min-vh-100 mt-3">
            <div class="container d-flex justify-content-center">
                <div class="col col-sm-10 col-md-6 col-lg-4 d-flex justify-content-center flex-column mt-4">
                    <h1 class="text-center"><?php echo $name_page ?></h1>
                    <!--visualizza errori-->
                    <?php include("formErrors.php"); ?>
                    <!--fine visualizza errori-->
                    <!--Form input dei dati-->
                    <form action="category-add.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="name" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status">
                            <label class="form-check-label" for="status">Attivo</label>
                        </div>
                        <button type="submit" name="add-category" class="btn btn-primary mt-3">Aggiungi</button>
                    </form>
                    <!--Fine form input dei dati-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>