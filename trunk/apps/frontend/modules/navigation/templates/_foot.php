<div id="foot" class="column">
  <hr/>
  <ul>
    <?php if ($sf_user->hasCredential('admin')):?>
      <li><a href="<?php echo url_for('services/index'); ?>"><?php echo __("Services")?></a></li>
    <?php endif; ?>
    <li><a href="#"><?php echo __("Legals mentions")?></a></li>
    <li>&copy; 2009</li>
  </ul>
</div>
