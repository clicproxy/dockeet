<h2><?php echo __("Page not found"); ?></h2>
<em><?php echo __("The server returned a 404 response");?></em>

<ul>
  <li><a href="javascript:history.go(-1)"><?php echo __('Back to previous page'); ?></a></li>
  <li><a href="<?php echo url_for('@homepage'); ?>"><?php echo __('Go to homepage')?></a></li>
</ul>