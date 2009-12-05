<h2><?php echo ($form->getObject() instanceof Category) ? __('Category') . ' ' . $form->getObject()->title :  __('Add a category'); ?></h2>

<form method="post">
	<?php echo $form; ?>
	<input type="submit" value="<?php echo __('Save'); ?>">
</form>

<?php if($sf_user->hasCredential('admin')): ?>
  <div id="category_users">
    <?php include_partial('category_users', array('form' => new UserCategoryAddForm($form->getObject()))); ?>
  </div>
<?php endif; ?>