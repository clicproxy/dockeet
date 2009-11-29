<div id="title_box">
  <h1><span><?php echo __('Ressources management'); ?></span></h1>
</div>

<div id="menu_box">
  <ul>
    <li><a href="<?php echo url_for('@homepage'); ?>"><?php echo __('Homepage'); ?></a></li>
    <?php if($sf_user->hasCredential('admin')): ?>
      <li><a href="<?php echo url_for('user/index'); ?>"><?php echo __('Users'); ?></a></li>
    <?php endif; ?>
  </ul>
</div>

<div id="search_box">
  <?php $search_form = new DocumentSearchForm(array('q' => $sf_user->getFlash('q', ''))); ?>
  <form action="<?php echo url_for('document/search'); ?>" method="get">
    <?php echo $search_form->renderHiddenFields(); ?>
    <?php echo $search_form['q']; ?>
    <input type="submit" value="<?php echo __('search'); ?>">
  </form>
</div>

<div id="user_box">
  <?php if($sf_user->isAuthenticated()): ?>
    <?php echo $sf_user->getUser()->username . ' ' . __('is connected'); ?>
    <div id="user_info">
      <a href="<?php echo url_for('navigation/logout'); ?>"><?php echo __('Logout'); ?></a>
    </div>
  <?php else: ?>
    <a href="#"><?php echo __('login')?></a>
    <?php $user_authentication_form = new UserLoginForm(array('login' => $sf_user->getFlash('login', '')));?>
    <form action="<?php echo url_for("navigation/login"); ?>" method="post">
      <?php echo $user_authentication_form->renderHiddenFields(); ?>
      <ul>
        <li>
          <?php echo $user_authentication_form['login']->renderLabel(); ?>
          <?php echo $user_authentication_form['login']; ?>
        </li>
        <li>
          <?php echo $user_authentication_form['password']->renderLabel(); ?>
          <?php echo $user_authentication_form['password']; ?>
        </li>
      </ul>
      <input type="submit" value="<?php echo __('Submit'); ?>">
    </form>
  <?php endif;?>
</div>
<?php if($sf_user->hasCredential('admin')): ?>
  <div id="admin_box">
    <ul>
      <li><a href="<?php echo url_for('category/edit');?>"><span><?php echo __('Add a category')?></span></a></li>
      <li><a href="<?php echo url_for('document/add');?>"><span><?php echo __('Add a document')?></span></a></li>
      <li><a href="<?php echo url_for('user/edit');?>"><span><?php echo __('Add an user')?></span></a></li>
    </ul>
  </div>
<?php endif; ?>