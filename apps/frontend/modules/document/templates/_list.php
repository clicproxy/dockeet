<div id="document_box">
	<span class="pager_count"><?php echo $pager->count() . ' ' . ((1 < $pager->count()) ? __('documents') : __('document')) . '.'; ?></span>
	<div class="clear"></div>
  <?php foreach ($pager->getResults() as $document): ?>
    <?php include_partial('document/view_' . $sf_user->getAttribute('display', 'thumbnail', 'frontend'), array('document' => $document)); ?>
  <?php endforeach; ?>
  
  <?php if ($pager->haveToPaginate()): ?>
    <ul class="pager">
    
      <li><a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=1'); ?>"><span><?php echo __('First'); ?></span></a></li>
      <li><a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getPreviousPage()); ?>"><span><?php echo __('Previous'); ?></span></a></li>
      <?php foreach ($pager->getLinks() as $page): ?>
      <li>
        <?php if ($page == $pager->getPage()): ?>
          <span><?php echo $page; ?></span>
        <?php else: ?>
          <a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $page); ?>"><span><?php echo $page; ?></span></a>
        <?php endif; ?>
      </li>
      <?php endforeach; ?>
      <li><a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getNextPage()); ?>">        <span><?php echo __('Next'); ?></span></a></li>
      <li><a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getLastPage()); ?>"><span><?php echo __('Last'); ?></span></a></li>
    </ul>
  <?php endif; ?>
</div>