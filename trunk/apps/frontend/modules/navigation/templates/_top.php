<div id="top" class="column">
  <div id="title_box">
    <h1><span><?php echo __('Ressources management'); ?></span></h1>
  </div>
  <div id="menu_box">
    <ul>
      <li>
        <a href="<?php echo url_for('@homepage'); ?>" <?php if(in_array($sf_request->getParameter('module'), array('document', 'category'))): ?>class="current"<?php endif;?>>
          <?php echo __('Documents'); ?>
        </a>
      </li>
      <?php if($sf_user->hasCredential('admin')): ?>
        <li>
          <a href="<?php echo url_for('user/index'); ?>" <?php if(in_array($sf_request->getParameter('module'), array('user'))): ?>class="current"<?php endif;?>>
            <?php echo __('Users'); ?>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
  
  <div id="search_box">
    <?php $search_form = new DocumentSearchForm(array('q' => $sf_user->getFlash('q', ''))); ?>
    <form action="<?php echo url_for('document/search'); ?>" method="get">
      <?php echo $search_form->renderHiddenFields(); ?>
      <?php echo $search_form['q']; ?>
      <a href="#" onclick="jQuery(jQuery(this).parent()).submit();"><span><?php echo __('Search'); ?></span></a>
    </form>
  </div>
  
  <div id="user_box">
    <?php if($sf_user->isAuthenticated()): ?>
      <div id="user_tab">
        <div id="user_tab_left"></div>
        <div id="user_tab_content">
          <a href="<?php echo url_for("user/edit?username=" . $sf_user->getUser()->username); ?>">
            <strong><?php echo $sf_user->getUser()->username; ?></strong>
          </a> <?php echo __('<span class="user_tab_connected">is connected</span>'); ?>
          <span class="user_tab_separ"></span>
          <a href="<?php echo url_for('navigation/logout');?>"><?php echo __('<span>Logout</span>'); ?></a>
        </div>
        <div id="user_tab_right"></div>
      </div>
      
      <div id="user_panel">
        <ul>
          <li><a href="<?php echo url_for('user/edit?id=' . $sf_user->getUser()->id); ?>"><?php echo __('Profile'); ?></a></li>
          <li><a href="<?php echo url_for('navigation/logout'); ?>"><?php echo __('Logout'); ?></a></li>
        </ul>
      </div>
    <?php else: ?>
    
      <div id="user_tab">
        <div id="user_tab_left"></div>
        <div id="user_tab_content">
          <a href="<?php echo url_for('navigation/login'); ?>"><?php echo __('login')?></a>
        </div>
        <div id="user_tab_right"></div>
      </div>
      
      <?php $user_authentication_form = new UserLoginForm(array('login' => $sf_user->getFlash('login', '')));?>
      <div id="user_panel">
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
      </div>
    <?php endif;?>
  </div>
  
  <?php include_partial('navigation/notice'); ?>
</div>