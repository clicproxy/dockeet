<div id="left">
  <div id="category_box">
    <strong><?php echo __('Category'); ?></strong>
    <ul>
      <?php $max_i = count($sf_user->getCategories()) -1; ?>
  	  <?php foreach ($sf_user->getCategories() as $i => $category): ?>
        <?php if ('0' === $category->count_documents && !$sf_user->hasCredential('admin')) continue;?>
  	    <li>
  	      <a href="<?php echo url_for('category/index?slug=' . $category->slug); ?>" <?php if (0 === $i): ?>class="first"<?php endif;?><?php if ($max_i === $i): ?>class="last"<?php endif;?>>
            <span><?php echo $category->count_documents; ?></span>
    	      <?php echo $category->title; ?>
          </a>
  	      
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