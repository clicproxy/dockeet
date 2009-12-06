<h2><?php echo __("Users"); ?></h2>

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
        <td><a href="<?php echo url_for('user/edit?username=' . $user->username); ?>"><?php echo $user->username; ?></a></td>
        <td><?php echo $user->email; ?></td>
        <td><a href="<?php echo url_for('user/delete?username=' . $user->username);?>" onclick="return confirm('<?php echo __('Are you sure ?'); ?>');"><?php echo __('delete'); ?></a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('user/edit'); ?>"><?php echo __("Add an user")?></a>