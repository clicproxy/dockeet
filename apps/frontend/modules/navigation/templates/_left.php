<div id="left">
  <div id="category_box">
    <strong><?php echo __('Categories'); ?></strong>
      <?php $max_i = count($sf_user->getCategories(true)) -1; ?>
      <div id="list-category-box">
	  	  <?php foreach ($sf_user->getCategories(true) as $i => $category): ?>
	        <?php if (0 === $category->countDocument(true) && !$sf_user->hasCredential('admin')) continue;?>
	  	      <a href="<?php echo url_for('category/index?slug=' . $category->slug); ?>" class="category-root <?php if (0 === $i): ?>first<?php endif;?> <?php if ($max_i === $i):?>last<?php endif; ?>" id="menu-<?php echo $category->slug; ?>" >
	    	      <?php echo $category->getPublicTitle(); ?>
	          </a>
	          <?php $sub_categories = $sf_user->getCategories(false, $category->title); ?>
	          <?php if (0 < count($sub_categories)): ?>
		          <div class="hidden" id="content-<?php echo $category->slug; ?>">
		              <?php $prev_level = 0; ?>
				          <?php foreach ($sub_categories as $sub_category): ?>
		                <?php if (0 === $sub_category->count_documents && !$sf_user->hasCredential('admin')) continue;?>
		                <?php $current_level = substr_count($sub_category->title, '|'); ?>
		                <?php if ($current_level >  $prev_level): ?><ul><?php endif; ?>
		                <?php if ($current_level <=  $prev_level): ?></li><?php endif; ?>
		                <?php for($i = 0; $i < $prev_level-$current_level; $i++):?></ul></li><?php endfor; ?>
		                <li class="sub_category subcat_level_<?php echo $current_level; ?>">
		                  <a href="<?php echo url_for("category/index?slug=" . $sub_category->slug); ?>"><?php echo $sub_category->getPublicTitle(); ?></a>
		                <?php $prev_level = substr_count($sub_category->title, '|'); ?>
				          <?php endforeach;?>
				          <?php for($i = 0; $i < $prev_level; $i++):?></ul></li><?php endfor; ?>
	            </div>
	            <script type="text/javascript">
	            $(document).ready(function(){
	                $('#menu-<?php echo $category->slug; ?>').menu({
	                  content: $('#content-<?php echo $category->slug; ?>').html(),
	                  flyOut: true,
	                  width: 230
	                });
	              });
	            </script>
	          <?php endif; ?>
	  	  <?php endforeach; ?>
  	  </div>
    <div class="left_box_foot"></div>
  </div>

  <!--
  <div id="tag_box">
    <strong><?php echo __('Tags'); ?></strong>
  </div>
   -->
</div>
