<?php if (count($errors) > 0) { #se sono presenti degli errori?>
     <div class="alert alert-danger" role="alert">
          <?php foreach ($errors as $error) { #per ogni errore?>
               <?php echo $error; ?>
               <br>
          <?php } ?>
     </div>
<?php } ?>
<?php if (count($success) > 0) { #se sono presenti degli avvisi di successo?>
     <div class="alert alert-success" role="alert">
          <?php foreach ($success as $succ) { #per ogni avviso di successo?>
               <?php echo $succ; ?>
               <br>
          <?php } ?>
     </div>
<?php } ?>