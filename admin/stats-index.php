<?php
require_once 'db.php';
require_once 'middleware.php';
adminOnly();
$name_page = 'Statistiche';
include('includes/header.php');
?>
<div class="container-fluid">
  <div class="row">
    <!--sidebar-->
    <?php include('includes/sidebar.php'); ?>
    <!--fine sidebar-->
    <div class="col w-75 min-vh-100 ">
      <h1 class="text-center"><?php echo $name_page ?></h1>
      <canvas id="myChart" class="pb-5"></canvas>
    </div>
    <script>
      //variabili per il tempo degli ultimi sette giorni
      var xValues = [
        <?php for ($i = 7; $i >= 0; $i--) {
          $value = date("Y-m-d", strtotime("-$i days"));
          echo "\"$value\", ";
        } ?>
      ];
      //variabili per i dati degli ultimi sette giorni
      var yValues = [
        <?php for ($i = 7; $i >= 0; $i--) {
          $value = date("Y-m-d", strtotime("-$i days"));
          $sql_ip = "SELECT * FROM access_table WHERE date= " . "\"$value\"";
          $result_ip = mysqli_query($conn, $sql_ip);
          if ($result_ip) {
            $number_row = mysqli_num_rows($result_ip);
            echo "\"$number_row\", ";
          }
        } ?>
      ];
      new Chart("myChart", {
        type: "line",
        data: {
          labels: xValues,
          datasets: [{
            data: yValues
          }]
        },
        options: {
          legend: {
            display: false
          },
          title: {
            display: false,
            text: "World Wine Production 2018"
          }
        }
      });
    </script>
<?php include('includes/footer.php'); ?>