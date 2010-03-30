<div id="title_box">
  <div id="title_left"></div>
  <div id="title_content">
    <h2><?php echo __('Document'); ?></h2>
  </div>
  <div id="title_right"></div>
</div>


<a href="<?php echo url_for('document/index?slug=' . $form->getObject()->slug); ?>">&larr; <?php echo __('Back to the document'); ?></a>

<form method="post" enctype="multipart/form-data">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>
  
  <?php echo $form['title']->renderError(); ?>
  <?php echo $form['title']->renderLabel(); ?>
  <?php echo $form['title']; ?>
  
  <?php echo $form['description']->renderError(); ?>
  <?php echo $form['description']->renderLabel(); ?>
  <?php echo $form['description']; ?>
  
  <?php echo $form['public']->renderError(); ?>
  <?php echo $form['public']->renderLabel(); ?>
  <?php echo $form['public']; ?>
  
  <?php echo $form['file']->renderError(); ?>
  <?php echo $form['file']->renderLabel(); ?>
  <?php echo $form['file']; ?>
  
  <input class="submit" type="submit" value="<?php echo __('Save'); ?>" />
</form>


<div id="document_categories">
  <?php include_partial('document_categories', array('form' => new DocumentCategoryAddForm($form->getObject()))); ?>
</div>
<!-- 
<div id="document_tags">
  <?php include_partial('document_tags', array('document' => $form->getObject())); ?>
</div>
 -->