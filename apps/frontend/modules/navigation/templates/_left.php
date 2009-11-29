<div id="category_box">
  <strong><?php echo __('Category'); ?></strong>
  <ul>
	  <?php foreach ($sf_user->getCategories() as $category): ?>
      <?php if (0 === $category->count_documents) continue;?>
	    <li>
	      <a href="<?php echo url_for('category/index?slug=' . $category->slug); ?>"><?php echo $category->title; ?></a>
	      <span><?php echo $category->count_documents; ?></span>
      </li>
	  <?php endforeach; ?>
  </ul>
</div>

<div id="tag_box">
  <strong><?php echo __('Tags'); ?></strong>
</div>