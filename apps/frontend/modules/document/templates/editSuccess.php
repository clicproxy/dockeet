<h2><?php echo __('Document'); ?></h2>

<a href="<?php echo url_for('document/index?slug=' . $form->getObject()->slug); ?>"><?php echo __('Back to the document'); ?></a>

<form method="post" enctype="multipart/form-data">
  <?php echo $form; ?>
  <input type="submit" value="<?php echo __('Save'); ?>" />
</form>


<div id="document_categories">
  <?php include_partial('document_categories', array('form' => new DocumentCategoryAddForm($form->getObject()))); ?>
</div>