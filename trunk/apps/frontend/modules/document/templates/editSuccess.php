<h2><?php echo __('Document'); ?></h2>

<a href="<?php echo url_for('document/index?slug=' . $form->getObject()->slug); ?>"><?php echo __('Back to the document'); ?></a>

<form method="post">
  <?php echo $form; ?>
  <input type="submit" value="<?php echo __('Save'); ?>" />
</form>

<h3><?php echo __('In categories'); ?></h3>

<?php if (0 > count($form->getObject()->Categories)): ?>
  <ul id="document_categories">
    <?php foreach($form->getObject()->Categories as $category):?>
      <li id="category_<?php echo $category->id; ?>">
        <?php echo $category->nom; ?>
        <a href="<?php echo url_for('document/deleteCategory?category_id=' . $category->id); ?>" onclick="documentCtrl.deleteCategory(this), return false;"><?php echo __('delete'); ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>