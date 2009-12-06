<div id="title_box">
  <div id="title_left"></div>
  <div id="title_content">
    <h2><?php echo __('New document'); ?></h2>
  </div>
  <div id="title_right"></div>
</div>



<form method="post" enctype="multipart/form-data">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>
  
  <?php echo $form['file']->renderError(); ?>
  <?php echo $form['file']->renderLabel(); ?>
  <?php echo $form['file']; ?>
  <?php echo $form['document_category']['category_id']->renderError(); ?>
  <?php echo $form['document_category']['category_id']->renderLabel(); ?>
  <?php echo $form['document_category']['category_id']; ?>
  <input class="submit" type="submit" value="<?php echo __('Save'); ?>" />
</form>