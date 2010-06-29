<div>
  <h1><span>Dockeet <?php echo __('Backend')?></span></h1>
  <form action="<?php echo url_for('navigation/login'); ?>" method="post">
    <?php echo $form->renderGlobalErrors(); ?>
    <?php echo $form->renderHiddenFields(); ?>
    <?php echo $form['login']->renderError(); ?>
    <p>
      <?php echo $form['login']->renderLabel(); ?>
      <?php echo $form['login']; ?>
    </p>
    <?php echo $form['password']->renderError(); ?>
    <p>
      <?php echo $form['password']->renderLabel(); ?>
      <?php echo $form['password']; ?>
    </p>
    <input type="submit" value="<?php echo __('Login'); ?>">
  </form>
</div>