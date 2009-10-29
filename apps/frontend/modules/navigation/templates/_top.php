<div id="title_box">
  <h1><span><?php echo __('Dockeet'); ?></span></h1>
</div>

<div id="menu_box">
	<ul>
	  <li><a href="<?php echo url_for('@homepage'); ?>"><?php echo __('Homepage'); ?></a></li>
	  <li><a href="<?php echo url_for('document/index'); ?>"><?php echo __('Documents'); ?></a></li>
	  <li><a href="<?php echo url_for('contact/index'); ?>"><?php echo __('Contacts'); ?></a></li>
	</ul>
</div>

<div id="search_box">
</div>

<div id="user_box">
</div>

<div id="admin_box">
  <ul>
    <li><a href="<?php echo url_for('category/edit');?>"><span><?php echo __('Add a category')?></span></a></li>
    <li><a href="<?php echo url_for('document/edit');?>"><span><?php echo __('Add a document')?></span></a></li>
    <li><a href="<?php echo url_for('contact/edit');?>"><span><?php echo __('Add a contact')?></span></a></li>
  </ul>
</div>