<h3><?php echo __('Users granted acces'); ?></h3>

<?php include_partial('navigation/notice'); ?>


<?php if (0 < count($form->getObject()->Users)): ?>
  <ul>
    <?php foreach($form->getObject()->Users as $user):?>
      <li id="category_<?php echo $user->id; ?>">
        <?php echo $user->username; ?>
        <a href="<?php echo url_for('category/removeUser?slug=' . $form->getObject()->slug . '&user_id=' . $user->id); ?>" onclick="if (confirm('<?php echo __('Are you sure ?'); ?>')) categoryCtrl.removeUser(this); return false;">
          <?php echo __('remove'); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p><?php echo __("No user has access to this category")?></p>
<?php endif; ?>
<br/>
<em><?php echo __('Add another user'); ?></em>
<form action="<?php echo url_for('category/addUser'); ?>" method="post" onsubmit="categoryCtrl.addUser(this); return false;">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>

  <?php echo $form['user_category']['user_id']->renderError(); ?>
  <?php echo $form['user_category']['user_id']->renderLabel(); ?>
  <?php echo $form['user_category']['user_id']; ?>
  <input class="submit" type="submit" value="<?php echo __('Add'); ?>">
</form>
