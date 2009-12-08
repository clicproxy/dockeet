<div id="title_box">
  <div id="title_left"></div>
  <div id="title_content">
    <h2><?php echo __("Access API"); ?> - <?php echo $form->getObject()->api_key ?></h2>
  </div>
  <div id="title_right"></div>
</div>

<form action="<?php echo url_for('services/editApiAccess?api_key=' . $form->getObject()->api_key); ?>" method="post">
  <?php echo $form; ?>
  <input class="submit" type="submit" value="<?php echo __('save'); ?>">
</form>