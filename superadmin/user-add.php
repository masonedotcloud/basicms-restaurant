<?php
include("controller-user.php");
superadminOnly();
$name_page = "Aggiungi utente";
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
					<form action="user-add.php" method="POST" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="username" class="form-control" id="username" name="username">
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password">
						</div>
						<div class="mb-3">
							<label for="stato" class="form-label">State</label>
							<select id="stato" class="form-control" name="admin_type">
								<option selected value="1">Admin</option>
								<option value="0">Superadmin</option>
							</select>
						</div>
						<button type="submit" name="add-user" class="btn btn-primary">Aggiungi</button>
					</form>
					<!--fine form di inserimento dei dati-->
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('includes/footer.php'); ?>