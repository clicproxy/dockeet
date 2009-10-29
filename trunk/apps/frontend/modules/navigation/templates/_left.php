<div id="category_box">
  <strong><?php echo __('Category'); ?></strong>
  <ul>
	  <?php foreach (Doctrine::getTable('Category')->findAll() as $category): ?>
	    <li>
	      <a href="<?php echo url_for('category/index?slug=' . $category->slug); ?>"><?php echo $category->title; ?></a>
	      <span><?php echo count($category->Documents); ?></span>
      </li>
	  <?php endforeach; ?>
  </ul>
</div>

<div id="tag_box">
  <strong><?php echo __('Tags'); ?></strong>
</div>