<div id="top">
  <?php if ($sf_user->isAuthenticated()): ?>
    <ul>
      <li><a href="<?php echo url_for('library/index'); ?>"><?php echo __('Libraries'); ?></a></li>
      <li><a href="<?php echo url_for('admin/index'); ?>"><?php echo __('Admins'); ?></a></li>
      <li><a href="<?php echo url_for('navigation/logout'); ?>"><?php echo __('Logout'); ?></a></li>
    </ul>
  <?php endif;?>
</div>