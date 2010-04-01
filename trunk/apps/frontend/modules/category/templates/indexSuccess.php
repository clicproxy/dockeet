<div id="title_box">
  <div id="title_top"></div>
  <div id="title_content">
    <h2><?php echo (!is_null($category) && $category->getRawValue() instanceof Category) ? __('Category') . ' ' . $category->getPublicTitle() : __('Homepage'); ?></h2>

    <ul id="document_view_box">
      <li>
        <a id="display_thumbnail" href="<?php echo url_for('navigation/setDisplay?display=thumbnail'); ?>" <?php if ('thumbnail' === $sf_user->getAttribute('display', 'thumbnail', 'frontend')): ?>class="current"<?php endif;?>>
          <span><?php echo __("Thumbnail"); ?></span>
        </a>
      </li>
      <li>
        <a id="display_mixed" href="<?php echo url_for('navigation/setDisplay?display=mixed'); ?>" <?php if ('mixed' === $sf_user->getAttribute('display', 'thumbnail', 'frontend')): ?>class="current"<?php endif;?>>
          <span><?php echo __("Mixed"); ?></span>
        </a>
      </li>
      <li>
        <a id="display_detail" href="<?php echo url_for('navigation/setDisplay?display=detail'); ?>" <?php if ('detail' === $sf_user->getAttribute('display', 'thumbnail', 'frontend')): ?>class="current"<?php endif;?>>
          <span><?php echo __("Detail"); ?></span>
        </a>
      </li>
    </ul>

    <div id="sort_box">
      <?php echo __('Sort by'); ?>
      <form action="<?php echo url_for('navigation/setOrder'); ?>" method="get">
        <select onchange="jQuery(jQuery(this).parent()).submit(); return false;" name="order_by">
          <option value="updated_at" <?php echo 0 === strpos($sf_user->getAttribute('order_by', 'updated_at DESC', 'frontend'), 'updated_at') ? 'selected="selected"' : ''; ?>>
            <?php echo __("Date"); ?>
          </option>
          <option value="title" <?php echo 0 === strpos($sf_user->getAttribute('order_by', 'updated_at DESC', 'frontend'), 'title') ? 'selected="selected"' : ''; ?>>
          <?php echo __("Alpha"); ?>
          </option>
          <option value="size" <?php echo 0 === strpos($sf_user->getAttribute('order_by', 'updated_at DESC', 'frontend'), 'size') ? 'selected="selected"' : ''; ?>>
          <?php echo __("Size"); ?>
          </option>
        </select>
      </form>
    </div>
  </div>
  <div id="title_bottom"></div>
</div>

<?php if ($sf_user->isAuthenticated() && null !==  $category && $category->getRawValue() instanceof Category): ?>
  <div id="category_control_box" class="control_box">
    <ul>
      <?php if ($sf_user->hasSubscribed($category->getRawValue())): ?>
        <li><a href="<?php echo url_for('category/unsubscribe?slug=' . $category->slug); ?>"><?php echo __('Unsubscribe'); ?></a></li>
      <?php else: ?>
        <li><a href="<?php echo url_for('category/subscribe?slug=' . $category->slug); ?>"><?php echo __('Subscribe'); ?></a></li>
      <?php endif; ?>
      <?php if($sf_user->hasCredential('admin')): ?>
        <li><a href="<?php echo url_for('category/edit?slug=' . $category->slug); ?>"><?php echo __('Edit'); ?></a></li>
        <li><a href="<?php echo url_for('document/add?category_slug=' . $category->slug); ?>"><?php echo __('Upload'); ?></a></li>
        <li><a href="<?php echo url_for('category/edit?parent_slug=' . $category->slug); ?>"><?php echo __('Add child category'); ?></a></li>
      <?php endif; ?>
    </ul>
  </div>
<?php endif; ?>

<?php include_partial('document/list', array('pager' => $pager)); ?>