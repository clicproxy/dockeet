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
  
  <?php echo $pager->count() . ' ' . ((1 < $pager->count()) ? __('documents') : __('document')) . '.'; ?>
  <?php // TODO: pagination; ?>
</div>