<div id="title_box">
  <div id="title_top"></div>
  <div id="title_content">
    <h2><?php echo __("Users"); ?></h2>
  </div>
  <div id="title_bottom"></div>
</div>

<div id="user_edit">
	<table>
	  <thead>
	    <tr>
	      <th><?php echo __("Username"); ?></tH>
	      <th><?php echo __("Email"); ?></th>
	    </tr>
	  </thead>
	  <tbody>
	    <?php foreach($pager->getResults() as $user): ?>
	      <tr>
	        <th><a class="border_stylehover" href="<?php echo url_for('user/edit?username=' . $user->username); ?>"><?php echo $user->username; ?></a></th>
	        <td><?php echo $user->email; ?></td>
	        <td><a class="border_stylehover" href="<?php echo url_for('user/delete?username=' . $user->username);?>" onclick="return confirm('<?php echo __('Are you sure ?'); ?>');"><?php echo __('delete'); ?></a></td>
	      </tr>
	    <?php endforeach; ?>
	  </tbody>
	</table>
  <a href="<?php echo url_for('user/edit'); ?>">New</a>
</div>