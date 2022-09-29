<?php
require_once 'db.php';
require_once 'middleware.php';
adminOnly();
include("controller-newsletter.php");
#query per la visualizzazione della lista di utenti iscritti alla newsletter
$sql = "SELECT * FROM newsletter_table";
$result = mysqli_query($conn, $sql);
$name_page = 'Newsletter';
include('includes/header.php'); ?>
<div class="container-fluid">
    <div class="row">
        <!--sidebar-->
        <?php include('includes/sidebar.php'); ?>
        <!--fine sidebar-->
        <div class="col min-vh-100 ">
            <h1 class="text-center mt-2 mb-4"><?php echo $name_page ?></h1>
            <div class="col-auto ms-3 me-3">
                <div class="row mt-1 d-flex justify-content-center">
                    <?php if (mysqli_num_rows($result) > 0) { #se sono presenti utenti nel DB?>
                        <?php while ($row = mysqli_fetch_array($result)) { #per ogni utente?>
                            <div class="row d-flex justify-content-center mb-4">
                                <div class="col d-flex justify-content-end align-items-center"><?php echo $row['email'] ?></div>
                                <div class="col d-flex justify-content-start align-items-center"><div data-bs-toggle="modal" data-bs-target="#popup_elimina_<?php echo $row['id']; ?>" class=" btn btn-danger">Elimina</div></div>
                            </div>
                            <!-- roba da mettere -->
                            <!--popup a schermo della conferma di eliminazione-->
							<div class="modal fade" id="popup_elimina_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="popupLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="popupLabel">Sei sicuro?</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body"> Sei sicuro di rimuovere <?php echo $row['email'] ?>? </div>
										<div class="modal-footer">
											<a href="newsletter-index.php?delete_id=<?php echo $row['id']; ?>" class="text-decoration-none">
												<button type="button" class="btn btn-danger">Elimina</button>
											</a>
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
							<!--fine popup a schermo della conferma di eliminazione-->
                        <?php } ?>
                    <?php } else if (mysqli_num_rows($result) == 0) { #se non sono presenti utenti?>
                        <div class="alert alert-warning" role="alert">
                            Nessun utente da visualizzare
                        </div>
                    <?php } else { #se è presente un errore con il DB?>
                        <div class="alert alert-danger" role="alert">
                            Errore di connessione al Database
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>