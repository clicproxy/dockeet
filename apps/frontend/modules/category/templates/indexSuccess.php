<h2><?php echo (!is_null($category) && $category->getRawValue() instanceof Category) ? __('Category') . ' ' . $category->title : __('Homepage'); ?></h2>

<?php if ($sf_user->isAuthenticated() && null !==  $category && $category->getRawValue() instanceof Category): ?>
  <div id="category_control_box">
    <ul>
      <?php if ($sf_user->hasSubscribed($category->getRawValue())): ?>
        <li><a href="<?php echo url_for('category/unsubscribe?slug=' . $category->slug); ?>"><?php echo __('Unsubscribe'); ?></a></li>
      <?php else: ?>
        <li><a href="<?php echo url_for('category/subscribe?slug=' . $category->slug); ?>"><?php echo __('Subscribe'); ?></a></li>
      <?php endif; ?>
      <?php if($sf_user->hasCredential('admin')): ?>
        <li><a href="<?php echo url_for('category/edit?slug=' . $category->slug); ?>"><?php echo __('Edit'); ?></a></li>
      <?php endif; ?>
    </ul>
  </div>
<?php endif; ?>

<div id="document_view_box">
  <ul>
    <li><a href="<?php echo url_for('navigation/setDisplay?display=thumbnail'); ?>"><span><?php echo __("Thumbnail"); ?></span></a></li>
    <li><a href="<?php echo url_for('navigation/setDisplay?display=mixed'); ?>"><span><?php echo __("Mixed"); ?></span></a></li>
    <li><a href="<?php echo url_for('navigation/setDisplay?display=detail'); ?>"><span><?php echo __("Detail"); ?></span></a></li>
  </ul>
</div>

<div id="sort_box">
  <select onchange="alert('sort action'); return false;">
    <option value="date"><?php echo __("Date"); ?></option>
    <option value="alpha"><?php echo __("Alpha"); ?></option>
    <option value="size"><?php echo __("Size"); ?></option>
  </select>
</div>

<div id="document_box">
  <?php foreach ($pager->getResults() as $document): ?>
    <?php include_partial('document/view_' . $sf_user->getAttribute('display', 'thumbnail', 'frontend'), array('document' => $document)); ?>
  <?php endforeach; ?>
  
  <span><?php echo $pager->count() . ' ' . ((1 < $pager->count()) ? __('documents') : __('document')) . '.'; ?></span>
  
  <?php if ($pager->haveToPaginate()): ?>
    <ul>
    
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