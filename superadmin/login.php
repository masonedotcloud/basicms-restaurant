<?php
require_once 'controllerUserData.php';
$redirect = 'index.php';
$name_page = "Login";
#se sono presenti i cookie con il salvataggio dei dati privati dell'utente
if ((isset($_COOKIE["username_superadmin"]) && isset($_COOKIE["password_superadmin"]))) {
  $_SESSION['username_superadmin'] = $_COOKIE["username_superadmin"];
  $_SESSION['password_superadmin'] = $_COOKIE["password_superadmin"];
  $_SESSION['id_superadmin'] = $_COOKIE["id_superadmin"];
  $_SESSION['admin_type_superadmin'] = $_COOKIE["admin_type_superadmin"];
}
#se è presente la tipologia di admin superadmin
if (isset($_SESSION['admin_type_superadmin']) && $_SESSION['admin_type_superadmin'] == 0) {
  header('Location: ' . $redirect);
  exit(0);
}
include('includes/header.php'); ?>
<main>
  <div class="container d-flex justify-content-center">
    <div class="col col-sm-10 col-md-6 col-lg-4 d-flex justify-content-center flex-column mt-4">
      <h1 class="text-center"><?php echo $name_page ?></h1>
      <!--visualizza errori-->
      <?php include("formErrors.php"); ?>
      <!--fine visualizza errori-->
      <!--form di inserimento dei dati-->
      <form action="login.php" method="POST">
        <div class="mb-3">
          <label for="exampleDropdownFormEmail1" class="form-label">Username</label>
          <input type="username" class="form-control" id="exampleDropdownFormEmail1" name="username" value="<?php if (isset($_COOKIE["username_superadmin"])) { echo $_COOKIE["username_superadmin"]; } ?>">
        </div>
        <div class="mb-3">
          <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleDropdownFormPassword1" name="password">
        </div>
        <div class="mb-3">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="dropdownCheck" name="remember_me">
            <label class="form-check-label" for="dropdownCheck">Ricordami</label>
          </div>
        </div>
        <button name="login" type="submit" class="btn btn-primary">Login</button>
      </form>
      <!--fine form di inserimento dei dati-->
    </div>
  </div>
</main>
<?php include('includes/header.php'); ?>