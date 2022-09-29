<?php
include("controller-category.php");
adminOnly();
$name_page = "Modifica categoria: " . $name;
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
                    <form action="category-edit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="name" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                        </div>
                        <div class="form-check form-switch">
                            <?php if ($status) { ?>
                                <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                            <?php } else { ?>
                                <input class="form-check-input" type="checkbox" id="status" name="status">
                            <?php } ?>
                            <label class="form-check-label" for="status">Attivo</label>
                        </div>
                        <button type="submit" name="update-category" class="btn btn-primary mt-3">Modifica</button>
                    </form>
                    <!--Fine form input dei dati-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>