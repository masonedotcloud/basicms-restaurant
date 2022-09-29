<?php
include("controller-user.php");
superadminOnly();
$name_page = "Modifica utente " . $username;
include('includes/header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <!--sidebar-->
        <?php include('includes/sidebar.php'); ?>
        <!--fine sidebar-->
        <div class="col-sm min-vh-100 mt-3">
            <div class="container d-flex justify-content-center">
                <div class="col col-sm-10 col-md-6 col-lg-4 d-flex justify-content-center flex-column mt-4">
                    <h1 class="text-center"><?php echo $name_page ?></h1>
                    <!--visualizza errori-->
                    <?php include("formErrors.php"); ?>
                    <!--fine visualizza errori-->
                    <!--form di inserimento dei dati-->
                    <form action="user-edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" id="username" name="username" value="<?php echo $username ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="admin_type" class="form-label">Tipo account</label>
                            <select id="admin_type" class="form-select" name="admin_type">
                                <?php if ($admin_type == 1) { #per avere preselezionata l'opzione attuale dell'utente?>
                                    <option selected value="1">Admin</option>
                                    <option value="0">Superadmin</option>
                                <?php } else { ?>
                                    <option value="1">Admin</option>
                                    <option selected value="0">Superadmin</option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" name="update-user" class="btn btn-primary">Applica</button>
                    </form>
                    <!--fine form di inserimento dei dati-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>