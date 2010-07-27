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

  <a id="addcat"><span><?php echo __("Add a category") ?></span></a>
  <div id="cat-add-menu" class="hidden">
		<?php $sub_categories = $sf_user->getCategories(false); ?>
		<?php if (0 < count($sub_categories)): ?>
		  <ul>
	      <?php $prev_level = 0; ?>
	      <?php foreach ($sub_categories as $sub_category): ?>
	        <?php if (0 === $sub_category->count_documents && !$sf_user->hasCredential('admin')) continue;?>
	        <?php $current_level = substr_count($sub_category->title, '|'); ?>
	        <?php if ($current_level >  $prev_level): ?><ul><?php endif; ?>
	        <?php if ($current_level <=  $prev_level): ?></li><?php endif; ?>
	        <?php for($i = 0; $i < $prev_level-$current_level; $i++):?></ul></li><?php endfor; ?>
	        <li class="sub_category subcat_level_<?php echo $current_level; ?>">
	          <a href="#" onclick="documentCtrl.addCategory(<?php echo $sub_category->id; ?>); return false"><?php echo $sub_category->getPublicTitle(); ?></a>
	        <?php $prev_level = substr_count($sub_category->title, '|'); ?>
	      <?php endforeach;?>
	      <?php for($i = 0; $i < $prev_level; $i++):?></ul></li><?php endfor; ?>
	      </ul>
		  </ul>
	  <?php endif; ?>
  </div>

	<script type="text/javascript">
	$(document).ready(function(){
	    $('#addcat').menu({
	      content: $('#cat-add-menu').html(),
	      flyOut: true,
	      width: 230
	    });
	  });
	</script>


</form>