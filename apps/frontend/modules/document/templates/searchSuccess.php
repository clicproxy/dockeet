<h2><?php echo __('Search results'); ?></h2>

<form action="<?php echo url_for('document/search'); ?>" method="get">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>
  
  <?php echo $form['q']->renderError(); ?>
  <?php echo $form['q']; ?>
  <input type="submit" value="<?php echo __('search'); ?>">
</form>
<pre>
<?php var_export($documents->getRawValue()); ?>
</pre>
<em><?php echo 'X' . ' ' . __('documents founds')?>.</em>