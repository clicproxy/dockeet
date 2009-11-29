<h2><?php echo $title; ?></h2>

<?php if (null !==  $category && $category->getRawValue() instanceof Category): ?>
  <div id="category_control_box">
    <ul>
      <li><a href="<?php echo url_for('category/subscribe?slug=' . $category->slug); ?>"><?php echo __('Subscribe'); ?></a></li>
      <?php if($sf_user->hasCredential('admin')): ?>
        <li><a href="<?php echo url_for('category/edit?slug=' . $category->slug); ?>"><?php echo __('Edit'); ?></a></li>
      <?php endif; ?>
    </ul>
  </div>
<?php endif; ?>

<div id="category_view_box">
  <ul>
    <li><a href="<?php echo url_for('navigation/setDisplay?display=thumbnail'); ?>"><span><?php echo __("Thumbnail"); ?></span></a></li>
    <li><a href="<?php echo url_for('navigation/setDisplay?display=list'); ?>"><span><?php echo __("List"); ?></span></a></li>
    <li><a href="<?php echo url_for('navigation/setDisplay?display=detail'); ?>"><span><?php echo __("Detail"); ?></span></a></li>
  </ul>
</div>

<div id="category_sort_box">
  <select onchange="alert('sort action'); return false;">
    <option value="date"><?php echo __("Date"); ?></option>
    <option value="alpha"><?php echo __("Alpha"); ?></option>
    <option value="size"><?php echo __("Size"); ?></option>
  </select>
</div>

<div id="category_document_box">
  <?php foreach ($pager->getResults() as $document): ?>
    <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>"><?php echo $document->title; ?></a>
  <?php endforeach; ?>
  
  <?php echo $pager->count() . ' ' . ((1 < $pager->count()) ? __('documents') : __('document')) . '.'; ?>
  <?php // TODO: pagination; ?>
</div>