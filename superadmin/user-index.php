<?php
require_once 'db.php';
require_once 'middleware.php';
superadminOnly();
#query per la visualizzazione di tutti gli account
$sql = "SELECT * FROM admin_table";
$result = mysqli_query($conn, $sql);
$name_page = 'Lista utenti';
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
					<?php if (mysqli_num_rows($result) > 0) { #controlla se ci sono risultati all'interno dell'interrogazione del database?>
						<?php while ($row = mysqli_fetch_array($result)) { #fino a quando non rilascia tutte le righe?>
							<!--carta dell'utente registrato-->
							<div class="col-xxl-3 col-xl-4 col-lg-8 col-md-8 d-flex justify-content-center align-items-center mt-3 ms-1 me-1 p-3 white shadow" style="border-radius:15px;">
								<div class="col">
									<div class="row">
										<h4><?php echo $row['username']; #username?></h4>
									</div>
									<div class="row">
										<span>ID: <?php echo $row['id']; #identificativo univoco?></span>
									</div>
									<div class="row">
										<?php $time = date("H:i:s", strtotime($row['create_at'])); #data di creazione?>
										<span>Data: <?php echo $time; ?></span>
									</div>
									<div class="row">
										<?php if ($row['admin_type'] == 0) { #tipologia di amministrazione?>
											<span>Superadmin</span>
										<?php } else { ?>
											<span>Admin</span>
										<?php } ?>
									</div>
								</div>
								<!--sezione pulsanti-->
								<div class="col">
									<div class="mb-1">
										<a href="user-edit.php?id=<?php echo $row['id']; #pagina per la modifca?>" class="w-100 btn btn-primary">Modifica</a>
									</div>
									<div class="mb-1">
										<div data-bs-toggle="modal" data-bs-target="#popup_elimina_<?php echo $row['id']; #pagina eliminazione dell'account?>" class="w-100 btn btn-primary <?php if ($_SESSION['id_superadmin'] == $row['id']) echo "disabled"; ?>" <?php if ($_SESSION['id_superadmin'] == $row['id']) echo "role=\"button\" aria-disabled=\"true\""; ?>>Elimina</div>
									</div>
									<div class="mb-1">
										<?php if ($row['status']) { ?>
											<a href="user-edit.php?status_id=<?php echo $row['id']; #attiva/disattiva account?>" class="w-100 btn btn-primary <?php if ($_SESSION['id_superadmin'] == $row['id']) echo "disabled"; else echo "active"; ?>">Disattiva</a>
										<?php } else { ?>
											<a href="user-edit.php?status_id=<?php echo $row['id']; #attiva/disattiva account?>" class="w-100 btn btn-outline-primary <?php if ($_SESSION['id_superadmin'] == $row['id']) echo "disabled"; ?>">Attiva</a>
										<?php } ?>
									</div>
								</div>
								<!--fine sezione pulsanti-->
							</div>
							<!--fine carta dell'utente registrato-->
							<!--popup a schermo della conferma di eliminazione-->
							<div class="modal fade" id="popup_elimina_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="popupLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="popupLabel">Sei sicuro?</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body"> Sei sicuro di eliminare <?php echo $row['username'] ?>?</div>
										<div class="modal-footer">
											<a href="user-edit.php?delete_id=<?php echo $row['id']; ?>" class="text-decoration-none">
												<button type="button" class="btn btn-danger">Elimina</button>
											</a>
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
										</div>
									</div>
								</div>
							</div>
							<!--fine popup a schermo della conferma di eliminazione-->
						<?php } ?>
					<?php } else if (mysqli_num_rows($result) == 0) { #se non sono presenti utenti?>
						<div class="alert alert-warning" role="alert">
							Nessun utente registrato
						</div>
					<?php } else { #se c'è stato un errore con il database?>
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
<!--pulsante in basso a destra per aggiungere degli utenti-->
<a href="user-add.php">
	<img src="assets/images/site/plus-square.svg" id="add-user-btn" alt="plus-square" width="48" height="48">
</a>
<!--fine pulsante in basso a destra per aggiungere degli utenti-->
<?php include('includes/footer.php'); ?>