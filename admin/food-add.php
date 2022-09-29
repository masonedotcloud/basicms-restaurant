<?php
include("controller-food.php");
adminOnly();
$sql = "SELECT * FROM category_table";
$result = mysqli_query($conn, $sql);
$name_page = 'Aggiungi cibo';
include('includes/header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <?php include('includes/sidebar.php'); ?>
        <div class="col-sm min-vh-100 mt-3">
            <h1 class="text-center"><?php echo $name_page ?></h1>
            <?php if (mysqli_num_rows($result) > 0) { #se sono presenti delle categorie ?>
                <div class="container d-flex justify-content-center">
                    <div class="col col-sm-10 col-md-6 col-lg-4 d-flex justify-content-center flex-column mt-4">
                        <!--visualizza errori-->
                        <?php include("formErrors.php"); ?>
                        <!--fine visualizza errori-->
                        <!--form di inserimento dei dati-->
                        <form action="food-add.php" method="POST" enctype="multipart/form-data">
                            <!--sezione nome-->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="name" class="form-control" id="name" name="name">
                            </div>
                            <!--fine sezione nome-->
                            <!--sezione scelta della categoria-->
                            <div class="mb-3">
                                <label for="category">Categoria</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" id="category" name="category">
                                        <option selected>Scegli...</option>
                                        <?php if (mysqli_num_rows($result) > 0) { ?>
                                            <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--fine sezione scelta della categoria-->
                            <!--sezione del prezzo-->
                            <div class="mb-3">
                                <label for="price" class="form-label">Prezzo</label>
                                <input type="number" min="0.00" class="form-control" max="9999999999.00" id="price basic-addon1" step="0.01" name="price">
                            </div>
                            <!--fine sezione del prezzo-->
                            <!--sezione descrizione-->
                            <div class="mb-3">
                                <label for="description">Descrizione</label>
                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                            </div>
                            <!--fine sezione descrizione-->
                            <!--sezione immagine-->
                            <div class="mb-3">
                                <label for="image" class="form-label">Immagine (.png, .jpg, .jpeg)</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <!--fine sezione immagine-->
                            <!--sezione stato-->
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" id="status" name="status">
                                <label class="form-check-label" for="status">Attivo</label>
                            </div>
                            <!--fine sezione stato-->
                            <button type="submit" name="add-food" class="btn btn-primary mt-3">Aggiungi</button>
                        </form>
                        <!--fine form di inserimento dei dati-->
                    </div>
                <?php } else { #se non presenti delle categorie?>
                    <div class="alert alert-warning" role="alert">
                        Non sono presenti categorie a cui associare i cibi
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>