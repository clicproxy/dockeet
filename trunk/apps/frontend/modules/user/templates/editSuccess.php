<h2><?php echo ($form->getObject()->isNew()) ? __('New user') : __('User') . ' ' . $form->getObject()->username; ?></h2>

<form method="post">
  <?php echo $form; ?>
  <input type="submit" value="<?php echo __('Save'); ?>" />
</form>