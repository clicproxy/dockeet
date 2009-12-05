<h3><?php echo __('Users'); ?></h3>

<?php include_partial('navigation/notice'); ?>


<?php if (0 < count($form->getObject()->Users)): ?>
  <ul id="category_users">
    <?php foreach($form->getObject()->Users as $user):?>
      <li id="category_<?php echo $user->id; ?>">
        <?php echo $user->username; ?>
        <a href="<?php echo url_for('document/removeUser?slug=' . $form->getObject()->slug . '&user_id=' . $user->id); ?>" onclick="if (confirm('<?php echo __('Are you sure ?'); ?>')) categoryCtrl.removeUser(this); return false;">
          <?php echo __('remove'); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<em><?php echo __('Add another user'); ?></em>
<form action="<?php echo url_for('document/addUser'); ?>" method="post" onsubmit="categoryCtrl.addUser(this); return false;">
  <?php echo $form; ?>
  <input type="submit" value="<?php echo __('Add'); ?>">
</form>