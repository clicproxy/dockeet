<div id="title_box">
  <div id="title_top"></div>
  <div id="title_content">
    <h2><?php echo __('Login'); ?></h2>
  </div>
  <div id="title_bottom"></div>
</div>
<div id="loginstart">
<form action="<?php echo url_for('navigation/login'); ?>" method="post">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>
  
  
  <?php $form['login']->renderError(); ?>
  <?php $form['login']->renderLabel();?>
  <?php $form['login']?>
  
  <?php $form['password']->renderError(); ?>
  <?php $form['password']->renderLabel();?>
  <?php $form['password']?>

  <?php echo $form; ?>
  
  <input class="submit" type="submit" value="<?php echo __('Submit'); ?>">
</form>
</div>