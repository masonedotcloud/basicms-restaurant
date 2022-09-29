<?php
include("controller-site.php");
adminOnly();
#query per visionare i dati del sito e successivamente modificarli
$sql = "SELECT * FROM setting_table LIMIT 1";
$result = mysqli_query($conn, $sql);
$site = mysqli_fetch_array($result);
$name_page = "Modifica sito";
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
                    <form action="site-edit.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="name" class="form-control" id="name" name="name" value="<?php echo $site['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $site['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="13" name="description"><?php echo $site['description'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Logo sito (.png, .jpg, .jpeg, .svg, .icon)</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        </div>
                        <button type="submit" name="update-site" class="btn btn-primary mt-3">Modifica</button>
                    </form>
                    <!--Fine form input dei dati-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>