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

<?php include_partial('document/list', array('pager' => $pager)); ?>