<?php
include("controller-user.php");
adminOnly();
$name_page = "Modifica profilo";
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
                    <form action="edit-profile.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id_admin'] ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username_admin'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password_old" class="form-label">Vecchia password</label>
                            <input type="password" class="form-control" id="password_old" name="oldpassword">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nuova Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" name="update-profile" class="btn btn-primary">Applica</button>
                    </form>
                    <!--fine form di inserimento dei dati-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>