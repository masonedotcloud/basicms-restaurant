<!--sidebar-->
<div class="col-sm-auto sticky-top white shadow">
	<div class="d-flex flex-sm-column flex-row flex-nowrap align-items-center sticky-top">
		<ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-wrap mb-auto mx-auto text-center justify-content-between w-100 align-items-center">
			<!--elemento sidebar-->
			<li class="nav-item">
				<a href="<?php echo "https://" . $_SERVER['SERVER_NAME'] ?>" class="nav-link py-3 px-2" target="_blank">
					<img src="assets/images/site/globe2.svg" alt="globe2" width="32" height="32" data-toggle="tooltip" data-placement="top" title="Vai al sito">
				</a>
			</li>
			<!--fine elemento sidebar-->
			<!--elemento sidebar-->
			<li class="nav-item">
				<a href="index.php" class="nav-link py-3 px-2">
					<img src="assets/images/site/speedometer2.svg" alt="speedometer2" width="32" height="32" data-toggle="tooltip" data-placement="top" title="Dashboard">
				</a>
			</li>
			<!--fine elemento sidebar-->
			<!--elemento sidebar-->
			<li class="nav-item">
				<a href="" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownutenti" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="assets/images/site/people.svg" alt="people" width="32" height="32">
				</a>
				<ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownutenti">
					<li>
						<a class="dropdown-item" href="user-add.php">Aggiungi utente</a>
					</li>
					<li>
						<a class="dropdown-item" href="user-index.php">Visualizza utenti</a>
					</li>
				</ul>
			</li>
			<!--fine elemento sidebar-->
			<!--elemento sidebar-->
			<li class="nav-item">
				<a href="edit-profile.php" class="nav-link py-3 px-2">
					<img src="assets/images/site/person-lines-fill.svg" alt="person-lines-fill" width="32" height="32" data-toggle="tooltip" data-placement="top" title="Modifica profilo">
				</a>
			</li>
			<!--fine elemento sidebar-->
			<!--elemento sidebar-->
			<li class="nav-item">
				<a href="" class="nav-link py-3 px-2">
					<img src="assets/images/site/question-square.svg" alt="question-square" width="32" height="32" data-toggle="tooltip" data-placement="top" title="Help" data-bs-toggle="modal" data-bs-target="#exampleModal">
				</a>
			</li>
			<!--fine elemento sidebar-->
			<!--elemento sidebar-->
			<li class="nav-item">
				<a href="logout.php" class="nav-link py-3 px-2">
					<img src="assets/images/site/door-open.svg" alt="door-open" width="32" height="32" data-toggle="tooltip" data-placement="top" title="Logout">
				</a>
			</li>
		</ul>
	</div>
</div>
<!--fine sidebar-->