<div id="breadcrumb">
	<ul>
	  <li><a href="<?php echo url_for("@homepage"); ?>"><?php echo __('Home')?></a></li>
    <?php if ($category->getRawValue() instanceof Category): ?>
		  <?php foreach ($category->getBreadcrumb() as $slug => $title): ?>
		    <li><a href="<?php echo url_for('category/index?slug=' . $slug); ?>"><?php echo $title; ?></a></li>
		  <?php endforeach; ?>
      <li class="breadcrumb_last"><?php echo $category->getPublicTitle(); ?></li>
    <?php endif; ?>
	</ul>
</div>