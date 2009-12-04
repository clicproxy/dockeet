<h3><?php echo __('In categories'); ?></h3>

<?php include_partial('navigation/notice'); ?>


<?php if (0 < count($form->getObject()->Categories)): ?>
  <ul id="document_categories">
    <?php foreach($form->getObject()->Categories as $category):?>
      <li id="category_<?php echo $category->id; ?>">
        <?php echo $category->title; ?>
        <a href="<?php echo url_for('document/deleteCategory?slug=' . $form->getObject()->slug . '&category_id=' . $category->id); ?>" onclick="if (confirm('<?php echo __('Are you sure ?'); ?>')) documentCtrl.removeCategory(this); return false;">
          <?php echo __('remove'); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<em><?php echo __('Add in another category'); ?></em>
<form action="<?php echo url_for('document/addCategory'); ?>" method="post" onsubmit="documentCtrl.addCategory(this); return false;">
  <?php echo $form; ?>
  <input type="submit" value="<?php echo __('Add'); ?>">
</form>