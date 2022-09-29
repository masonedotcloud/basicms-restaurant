<?php
include("controller-food.php");
adminOnly();
#query per le categorie
$sql = "SELECT * FROM category_table";
$result = mysqli_query($conn, $sql);
$name_page = "Modifica cibo: " . $name;
?>
<?php include('includes/header.php'); ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include('includes/sidebar.php'); ?>
            <div class="col-sm min-vh-100 mt-3">
                <div class="container d-flex justify-content-center">
                    <div class="col col-sm-10 col-md-6 col-lg-4 d-flex justify-content-center flex-column mt-4">
                        <h1 class="text-center"><?php echo $name_page ?></h1>
                        <?php include("formErrors.php"); ?>
                        <form action="food-edit.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="mb-3">
                                <label for="exampleDropdownFormEmail1" class="form-label">Name</label>
                                <input type="name" class="form-control" id="exampleDropdownFormEmail1" name="name" value="<?php echo $name ?>">
                            </div>
                            <div class="mb-3">
                                <label for="inputState">Category</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" id="inputGroupSelect01" name="category">
                                        <?php if (mysqli_num_rows($result) > 0) { #se sono presenti categorie?>
                                            <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                <option <?php if($row['id'] == $category) echo "selected" ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        <?php } else if (mysqli_num_rows($result) == 0) { #se non sono presenti categorie?>
                                            <div class="alert alert-warning" role="alert">
                                                No user to display
                                            </div>
                                        <?php } else { #errori di connessione al DB?>
                                            <div class="alert alert-danger" role="alert">
                                                Error to DB
                                            </div>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleDropdownFormEmail2" class="form-label">Price</label>
                                <input type="number" min="0.00" class="form-control" max="10000.00" id="exampleDropdownFormEmail2 basic-addon1" step="0.01" name="price" value="<?php echo $price ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" ><?php echo $description ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Immagine</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>
                            <button type="submit" name="edit-food" class="btn btn-primary mt-3">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>