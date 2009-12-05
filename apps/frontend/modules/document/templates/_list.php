<div id="sort_box">
  <select onchange="alert('sort action'); return false;">
    <option value="date"><?php echo __("Date"); ?></option>
    <option value="alpha"><?php echo __("Alpha"); ?></option>
    <option value="size"><?php echo __("Size"); ?></option>
  </select>
</div>

<div id="document_box">
  <?php foreach ($pager->getResults() as $document): ?>
    <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>"><?php echo $document->title; ?></a>
  <?php endforeach; ?>
  
  <span><?php echo $pager->count() . ' ' . ((1 < $pager->count()) ? __('documents') : __('document')) . '.'; ?></span>
  
  <?php if ($pager->haveToPaginate()): ?>
  <ul>
  
    <li>
      <a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=1'); ?>">
        <span><?php echo __('First'); ?></span>
      </a>
    </li>

    <li>
      <a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getPreviousPage()); ?>">
        <span><?php echo __('Previous'); ?></span>
      </a>
    </li>

    <?php foreach ($pager->getLinks() as $page): ?>
    <li>
      <?php if ($page == $pager->getPage()): ?>
        <span><?php echo $page; ?></span>
      <?php else: ?>
        <a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $page); ?>">
          <span><?php echo $page; ?></span>
        </a>
      <?php endif; ?>
    </li>
    <?php endforeach; ?>

    <li>
      <a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getNextPage()); ?>">
        <span><?php echo __('Next'); ?></span>
      </a>
    </li>

    <li>
      <a href="<?php echo url_for('category/index?' . (is_null($category) ?  '' : 'slug=' . $category->slug . '&') . 'page=' . $pager->getLastPage()); ?>">
        <span><?php echo __('Last'); ?></span>
      </a>
    </li>

  </ul>
  <?php endif; ?>
  
</div>