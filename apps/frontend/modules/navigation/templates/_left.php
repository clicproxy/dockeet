<div id="left">
  <div id="category_box">
    <strong><?php echo __('Category'); ?></strong>
    <ul>
      <?php $max_i = count($sf_user->getCategories(true)) -1; ?>
  	  <?php foreach ($sf_user->getCategories(true) as $i => $category): ?>
        <?php if (0 === $category->countDocument(true) && !$sf_user->hasCredential('admin')) continue;?>
  	    <li class="root">
  	      <a href="<?php echo url_for('category/index?slug=' . $category->slug); ?>" <?php if (0 === $i): ?>class="first"<?php endif;?><?php if ($max_i === $i): ?>class="last"<?php endif;?>>
    	      <?php echo $category->getPublicTitle(); ?>
            <span><?php echo $category->countDocument(true); ?></span>
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
                  <a class="border_stylehover" href="<?php echo url_for("category/index?slug=" . $sub_category->slug); ?>">&raquo; <?php echo $sub_category->getPublicTitle(); ?> <span><?php echo $sub_category->count_documents; ?></span></a>
                </li>
		          <?php endforeach;?>
              <li class="foot_sub_category"></li>
            </ul>
          <?php endif; ?>
        </li>
  	  <?php endforeach; ?>
    </ul>
    <div class="left_box_foot"></div>
  </div>

  <!--
  <div id="tag_box">
    <strong><?php echo __('Tags'); ?></strong>
  </div>
   -->
</div>

<script type="text/javascript">
$('div#category_box ul:first').nmcDropDown();
</script>