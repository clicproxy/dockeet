<h3><?php echo __('In categories'); ?></h3>

<?php include_partial('navigation/notice'); ?>


<?php if (0 < count($form->getObject()->Categories)): ?>
  <ul>
    <?php foreach($form->getObject()->Categories as $category):?>
      <li id="category_<?php echo $category->id; ?>">
        <?php echo $category->title; ?>
        <a class="border_stylehover" href="<?php echo url_for('document/removeCategory?slug=' . $form->getObject()->slug . '&category_id=' . $category->id); ?>" onclick="if (confirm('<?php echo __('Are you sure ?'); ?>')) documentCtrl.removeCategory(this); return false;">
          <?php echo __('remove'); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p><?php echo __("No category has this document")?></p>
<?php endif; ?>
<div class="clear"></div>
<em><?php echo __('Add in another category:'); ?></em>
<form action="<?php echo url_for('document/addCategory'); ?>" method="post" onsubmit="documentCtrl.addCategory(this); return false;">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>
  
  <?php echo $form['document_category']['category_id']->renderError(); ?>
  <?php echo $form['document_category']['category_id']->renderLabel(); ?>
  <?php echo $form['document_category']['category_id']; ?>
  <input class="submit" type="submit" value="<?php echo __('Add'); ?>">
</form>