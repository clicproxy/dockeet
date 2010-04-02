<div id="breadcrumb">
	<ul>
	  <li class="border_stylehover"><a href="<?php echo url_for("@homepage"); ?>"><?php echo __('Home')?></a></li>
    <?php if (null !== $category && $category->getRawValue() instanceof Category): ?>
		  <?php foreach ($category->getBreadcrumb() as $slug => $title): ?>
		    <li class="border_stylehover"><a href="<?php echo url_for('category/index?slug=' . $slug); ?>">&raquo; <?php echo $title; ?></a></li>
		  <?php endforeach; ?>
      <li class="breadcrumb_last">  <?php echo $category->getPublicTitle(); ?></li>
    <?php endif; ?>
	</ul>
</div>