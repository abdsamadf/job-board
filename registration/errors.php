<?php if (count($errors) > 0) : ?>
  <div class="notification is-danger">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>