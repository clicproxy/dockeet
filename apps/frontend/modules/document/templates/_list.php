<div id="document_box">
	<span class="pager_count"><?php echo $pager->count() . ' ' . ((1 < $pager->count()) ? __('documents') : __('document')) . '.'; ?></span>
	<div class="clear"></div>
  <?php foreach ($pager->getResults() as $document): ?>
    <?php include_partial('document/view_' . $sf_user->getAttribute('display', 'thumbnail', 'frontend'), array('document' => $document)); ?>
  <?php endforeach; ?>

  <?php if ($pager->haveToPaginate()): ?>
  	<div class="clear"></div>
    <ul class="pager">

      <li class="pager_first"><a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=1'); ?>"><span><?php echo __('First'); ?></span></a></li>
      <li class="pager_previous">&laquo; <a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getPreviousPage()); ?>"><span><?php echo __('Previous'); ?></span></a></li>
      <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
	        <li class="pager_active">
	          <span><?php echo $page; ?></span>
	        </li>
        <?php else: ?>
	        <li>
	          <a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $page); ?>"><span><?php echo $page; ?></span></a>
	        </li>
        <?php endif; ?>
      <?php endforeach; ?>
      <li class="pager_next"><a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getNextPage()); ?>">        <span><?php echo __('Next'); ?></span></a> &raquo;</li>
      <li class="pager_last"><a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getLastPage()); ?>"><span><?php echo __('Last'); ?></span></a></li>
    </ul>
  <?php endif; ?>
</div>