<?php if (count($errors) > 0) { #se sono presenti degli errori?>
     <div class="alert alert-danger" role="alert">
          <?php foreach ($errors as $error) { #per ogni errore?>
               <?php echo $error; ?>
               <br>
          <?php } ?>
     </div>
<?php } ?>