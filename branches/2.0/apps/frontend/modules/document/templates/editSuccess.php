<div id="title_box">
  <div id="title_top"></div>
  <div id="title_content">
    <h2><?php echo $form->getObject()->title; ?></h2>
  </div>
  <div id="title_bottom"></div>
</div>

<div id="doc_edit">
<a class="border_stylehover backdoc" href="<?php echo url_for('document/index?slug=' . $form->getObject()->slug); ?>">&laquo; <?php echo __('Back to the document'); ?></a>

	<form method="post" enctype="multipart/form-data">
	  <?php echo $form->renderHiddenFields(); ?>
	  <?php echo $form->renderGlobalErrors(); ?>
	  
	  <?php echo $form['title']->renderError(); ?>
	  <?php echo $form['title']->renderLabel(); ?>
	  <?php echo $form['title']; ?>
	  
	  <?php echo $form['description']->renderError(); ?>
	  <?php echo $form['description']->renderLabel(); ?>
	  <?php echo $form['description']; ?>
	  
	  <div class="clear"></div>
	  
	  <div class="checkbox_public">
	  <?php echo $form['public']->renderError(); ?>
	  <?php echo $form['public']->renderLabel(); ?>
	  <?php echo $form['public']; ?>
	  </div>
	  
	  <div class="filechange_public">
	  <?php echo $form['file']->renderError(); ?>
	  <?php echo $form['file']->renderLabel(); ?>
	  <?php echo $form['file']; ?>
	  </div>
	  
	  <div class="clear"></div>
	  
	  <input class="submit" type="submit" value="<?php echo __('Save'); ?>" />
	</form>
</div>

<div id="document_categories">
  <?php include_partial('document_categories', array('form' => new DocumentCategoryAddForm($form->getObject()))); ?>
</div>

<div id="document_tags">
  <?php include_partial('document_tags', array('document' => $form->getObject())); ?>
</div>