<?php
require_once 'db.php';
require_once 'middleware.php';
adminOnly();
#query per la visualizzazione del cibo
$sql = "SELECT * FROM food_table";
$result = mysqli_query($conn, $sql);
$name_page = 'Cibi';
include('includes/header.php'); ?>
<div class="container-fluid">
	<div class="row">
		<!--sidebar-->
		<?php include('includes/sidebar.php'); ?>
		<!--fine sidebar-->
		<div class="col min-vh-100 ">
			<h1 class="text-center mt-2"><?php echo $name_page ?></h1>
			<div class="col-auto ms-3 me-3">
				<div class="row mt-1 d-flex justify-content-center">
					<?php if (mysqli_num_rows($result) > 0) { #se sono presenti cibi?>
						<?php while ($row = mysqli_fetch_array($result)) { #per ogni  cibo?>
							<?php
							$search = $row['category'];
							$sql = "SELECT name FROM category_table WHERE id = " . "\"$search\"";
							$result2 = mysqli_query($conn, $sql);
							$category_name = mysqli_fetch_array($result2);
							?>
							<!--carta del cibo-->
							<div class="col-xxl-3 col-xl-4 col-lg-8 col-md-8 d-flex justify-content-center align-items-center mt-3 ms-1 me-1 p-3 white shadow" style="border-radius:15px;">
								<div class="col">
									<div class="row">
										<h4><?php echo $row['name']; ?></h4>
									</div>
									<div class="row">
										<span>ID: <?php echo $row['id']; ?></span>
									</div>
									<div class="row">
										<?php $time = date("H:i:s", strtotime($row['create_at'])); ?>
										<span>Data: <?php echo $time; ?></span>
									</div>
									<div class="row">
										<span>
											<?php 
											if ($result2) {
												echo $category_name['name']; 
											} else {
												echo "Categoria: ". $row['category'];
											}
											?>
										</span>
									</div>
								</div>
								<!--sezione pulsanti-->
								<div class="col">
									<div class="mb-1">
										<a href="food-edit.php?id=<?php echo $row['id']; ?>" class="w-100 btn btn-primary">Modifca</a>
									</div>
									<div class="mb-1">
										<div data-bs-toggle="modal" data-bs-target="#popup_elimina_<?php echo $row['id']; ?>" class="w-100 btn btn-primary">Elimina</div>
									</div>
									<div class="mb-1">
										<?php if ($row['status']) { ?>
											<a href="food-edit.php?status_id=<?php echo $row['id']; ?>" class="w-100 btn btn-primary">Disattiva</a>
										<?php } else { ?>
											<a href="food-edit.php?status_id=<?php echo $row['id']; ?>" class="w-100 btn btn-outline-primary">Attiva</a>
										<?php } ?>
									</div>
								</div>
								<!--fine sezione pulsanti-->
							</div>
							<!--fine carta del cibo-->
							<!--popup a schermo della conferma di eliminazione-->
							<div class="modal fade" id="popup_elimina_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="popupLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="popupLabel">Sei sicuro?</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body"> Sei sicuro di voler eliminare <?php echo $row['name'] ?>? </div>
										<div class="modal-footer">
											<a href="food-edit.php?delete_id=<?php echo $row['id']; ?>" class="text-decoration-none">
												<button type="button" class="btn btn-danger">Delete</button>
											</a>
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
							<!--fine popup a schermo della conferma di eliminazione-->
						<?php } ?>
					<?php } else if (mysqli_num_rows($result) == 0) { #se non sono presenti cibi?>
						<div class="alert alert-warning" role="alert">
							Nessun cibo da visulizzare
						</div>
					<?php } else { #se c'è stato un problema con il DB?>
						<div class="alert alert-danger" role="alert">
							Errore di connessione al Database
						</div>
					<?php } ?>
					<div style="height:100px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--pulsante in basso a destra per aggiungere il cibo-->
<a href="food-add.php">
	<img src="assets/images/site/plus-square.svg" id="add-food-btn" alt="img" width="48" height="48">
</a>
<!--fine pulsante in basso a destra per aggiungere il cibo-->
<?php include('includes/footer.php'); ?>