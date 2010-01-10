<div id="title_box">
  <div id="title_left"></div>
  <div id="title_content">
    <h2><?php echo ($form->getObject()->isNew()) ? __('New user') : __('User') . ' ' . $form->getObject()->username; ?></h2>
  </div>
  <div id="title_right"></div>
</div>

<form action="<?php echo url_for('user/edit'); ?>" method="post">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>
  
  <?php echo $form['username']->renderError(); ?>
  <?php echo $form['username']->renderLabel(); ?>
  <?php echo $form['username']; ?>
  
  <?php echo $form['password']->renderError(); ?>
  <?php echo $form['password']->renderLabel(); ?>
  <?php echo $form['password']; ?>
  
  <?php echo $form['password_confirm']->renderError(); ?>
  <?php echo $form['password_confirm']->renderLabel(); ?>
  <?php echo $form['password_confirm']; ?>
  
  <?php echo $form['email']->renderError(); ?>
  <?php echo $form['email']->renderLabel(); ?>
  <?php echo $form['email']; ?>
  
  <?php echo $form['culture']->renderError(); ?>
  <?php echo $form['culture']->renderLabel(); ?>
  <?php echo $form['culture']; ?>
  
  <?php echo $form['admin']->renderError(); ?>
  <?php echo $form['admin']->renderLabel(); ?>
  <?php echo $form['admin']; ?>
  
  <input class="submit" type="submit" value="<?php echo __('Save'); ?>" />
</form>