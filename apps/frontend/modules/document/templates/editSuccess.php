<h2><?php echo __('Document'); ?></h2>
<a href="<?php echo url_for('document/index?slug=' . $form->getObject()->slug); ?>"><?php echo __('Back to the document'); ?></a>
<form method="post">
  <?php echo $form; ?>
  <input type="submit" value="<?php echo __('Save'); ?>" />
</form>