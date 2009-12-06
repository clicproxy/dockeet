<div id="title_box">
  <div id="title_left"></div>
  <div id="title_content">
    <h2><?php echo __('Search results'); ?></h2>
    
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
  <div id="title_right"></div>
</div>

<form action="<?php echo url_for('document/search'); ?>" method="get">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>
  
  <?php echo $form['q']->renderError(); ?>
  <?php echo $form['q']; ?>
  <input type="submit" value="<?php echo __('search'); ?>">
</form>

<?php include_partial('document/list', array('pager' => $pager)); ?>