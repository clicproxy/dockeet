<h3><?php echo __('In categories'); ?></h3>

<?php include_partial('navigation/notice'); ?>


<?php if (0 < count($form->getObject()->Categories)): ?>
  <ul>
    <?php foreach($form->getObject()->Categories as $category):?>
      <li id="category_<?php echo $category->id; ?>">
        <?php echo $category->title; ?>
        <a class="border_stylehover" href="<?php echo url_for('document/removeCategory?slug=' . $form->getObject()->slug . '&category_id=' . $category->id); ?>" onclick="if (confirm('<?php echo __('Are you sure ?'); ?>')) documentCtrl.removeCategory(this); return false;">
          <?php echo __('remove'); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p><?php echo __("No category has this document")?></p>
<?php endif; ?>
<div class="clear"></div>
<form action="<?php echo url_for('document/addCategory'); ?>" method="post" onsubmit="documentCtrl.addCategory(this); return false;" id="form_add_category">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>

  <?php echo $form['document_category']['category_id']->renderError(); ?>
  <?php echo $form['document_category']['category_id']; ?>

  <a class="addcat" onclick="jQuery('ul#add_category').toggle(); $('ul#add_category').nmcDropDown(); return false;" href="#"><span><?php echo __("Add a category") ?></span></a>
  	<div id="popupaddcat">
	    <ul id="add_category" style="display: none;">
	      <?php $max_i = count($sf_user->getCategories(true)) -1; ?>
	      <?php foreach ($sf_user->getCategories(true) as $i => $category): ?>
	        <?php if ('0' === $category->countDocument(true) && !$sf_user->hasCredential('admin')) continue;?>
	        <li class="root">
	          <a href="#" onclick="documentCtrl.addCategory(<?php echo $category->id; ?>); return false;" <?php if (0 === $i): ?>class="first"<?php endif;?><?php if ($max_i === $i): ?>class="last"<?php endif;?>>
	            <?php echo $category->getPublicTitle(); ?>
	          </a>

	          <?php $sub_categories = $sf_user->getCategories(false, $category->title); ?>
	          <?php if (0 < count($sub_categories)): ?>
	            <ul>
	              <li class="title">
	                <a href="<?php echo url_for("category/index?slug=" . $category->slug); ?>"><?php echo $category->getPublicTitle(); ?></a>
	                <span class="cat_count"><?php echo $category->countDocument(true); ?></span>
	              </li>

	              <?php foreach ($sub_categories as $sub_category): ?>
	                <?php if (0 === $sub_category->count_documents && !$sf_user->hasCredential('admin')) continue;?>
	                <li class="sub_category subcat_level_<?php echo substr_count($sub_category->title, '|'); ?>">
	                  <a class="border_stylehover" href="#" onclick="documentCtrl.addCategory(<?php echo $sub_category->id; ?>); return false">&raquo; <?php echo $sub_category->getPublicTitle(); ?> <span><?php echo $sub_category->count_documents; ?></span></a>
	                </li>
	              <?php endforeach;?>
	              <li class="foot_sub_category"></li>
	            </ul>
	          <?php endif; ?>
	        </li>
	      <?php endforeach; ?>
	    </ul>
		</div>
</form>