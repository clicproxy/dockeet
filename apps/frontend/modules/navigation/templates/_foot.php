<div id="foot" class="column">
  <ul>
    <?php if ($sf_user->hasCredential('admin')):?>
      <li><a href="<?php echo url_for('services/index'); ?>"><?php echo __("Services")?></a></li>
    <?php endif; ?>
    <li><a href="#"><?php echo __("Legals mentions")?></a></li>
    <li><span>&copy; 2010</span></li>
  </ul>
</div>
