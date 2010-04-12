<div id="title_box">
  <div id="title_top"></div>
  <div id="title_content">
    <h2><?php echo (!is_null($category) && $category->getRawValue() instanceof Category) ? $category->getPublicTitle() : __('Homepage'); ?></h2>

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

<?php include_partial('category/breadcrumb', array('category' => $category)); ?>
<div class="clear"></div>

<?php if ($sf_user->isAuthenticated() && null !==  $category && $category->getRawValue() instanceof Category): ?>
  <div id="category_control_box" class="control_box">
    <ul class="listdoc">
      <?php if ($sf_user->hasSubscribed($category->getRawValue())): ?>
        <li class="unsubscribe"><a href="<?php echo url_for('category/unsubscribe?slug=' . $category->slug); ?>"><?php echo __('Unsubscribe'); ?></a></li>
      <?php else: ?>
        <li class="subscribe"><a href="<?php echo url_for('category/subscribe?slug=' . $category->slug); ?>"><?php echo __('Subscribe'); ?></a></li>
      <?php endif; ?>
      <?php if($sf_user->hasCredential('admin')): ?>
        <li class="edit"><a href="<?php echo url_for('category/edit?slug=' . $category->slug); ?>"><?php echo __('Edit'); ?></a></li>
        <li class="upload"><a href="<?php echo url_for('document/add?category_slug=' . $category->slug); ?>"><?php echo __('Upload'); ?></a></li>
        <li class="plus"><a href="<?php echo url_for('category/edit?parent_slug=' . $category->slug); ?>"><?php echo __('Add child category'); ?></a></li>
      <?php endif; ?>
    </ul>
  </div>
<?php endif; ?>

<div id="list_category">
	<ul>
		<?php foreach (Doctrine::getTable('Category')->createQuery('c')->where('c.title LIKE ?', $category->title . '|%')->execute() as $sub_category): ?>
		  <?php if (0 === $sub_category->countDocument(true, $sf_user->getUser()->getRawValue()) && !$sf_user->hasCredential('admin')) continue;?>
		  <li class="sub_category subcat_level_<?php echo substr_count($sub_category->title, '|'); ?>">
		    <a class="border_stylehover" href="<?php echo url_for("category/index?slug=" . $sub_category->slug); ?>">&raquo; <?php echo $sub_category->getPublicTitle(); ?> <span><?php echo $sub_category->countDocument(); ?></span></a>
		  </li>
		<?php endforeach;?>
	</ul>
</div>
<div class="clear"></div>

<?php include_partial('document/list', array('pager' => $pager, 'category' => $category)); ?>