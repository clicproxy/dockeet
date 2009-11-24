<div id="title_box">
  <h1><span><?php echo __('Dockeet'); ?></span></h1>
</div>

<div id="menu_box">
  <ul>
    <li><a href="<?php echo url_for('@homepage'); ?>"><?php echo __('Homepage'); ?></a></li>
    <li><a href="<?php echo url_for('document/index'); ?>"><?php echo __('Documents'); ?></a></li>
    <li><a href="<?php echo url_for('user/index'); ?>"><?php echo __('Users'); ?></a></li>
  </ul>
</div>

<div id="search_box">
  <?php $form = new DocumentSearchForm(array('q' => $sf_user->getFlash('q', ''))); ?>
  <form action="<?php echo url_for('document/search'); ?>" method="get">
    <?php echo $form->renderHiddenFields(); ?>
    <?php echo $form['q']; ?>
    <input type="submit" value="<?php echo __('search'); ?>">
  </form>
</div>

<div id="user_box">
  <?php if($sf_user->isAuthenticated()): ?>
    <?php echo $sf_user->getUser()->username . ' ' . __('is connected'); ?>
  <?php else: ?>
    <a href="#"><?php echo __('login')?></a>
    <div>
    </div>
  <?php endif;?>
</div>

<div id="admin_box">
  <ul>
    <li><a href="<?php echo url_for('category/edit');?>"><span><?php echo __('Add a category')?></span></a></li>
    <li><a href="<?php echo url_for('document/add');?>"><span><?php echo __('Add a document')?></span></a></li>
    <li><a href="<?php echo url_for('user/edit');?>"><span><?php echo __('Add an user')?></span></a></li>
  </ul>
</div>