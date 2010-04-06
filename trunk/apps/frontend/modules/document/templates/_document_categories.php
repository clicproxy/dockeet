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
<form action="<?php echo url_for('document/addCategory'); ?>" method="post" onsubmit="documentCtrl.addCategory(this); return false;" id="form_add_category">
  <?php echo $form->renderHiddenFields(); ?>
  <?php echo $form->renderGlobalErrors(); ?>

  <?php echo $form['document_category']['category_id']->renderError(); ?>
  <?php echo $form['document_category']['category_id']; ?>

  <a class="addcat" onclick="jQuery('ul#add_category').toggle(); $('ul#add_category').nmcDropDown(); return false;" href="#"><span><?php echo __("Add a category") ?></span></a>

    <ul id="add_category" style="display: none;">
      <?php $max_i = count($sf_user->getCategories(true)) -1; ?>
      <?php foreach ($sf_user->getCategories(true) as $i => $category): ?>
        <?php if ('0' === $category->count_documents && !$sf_user->hasCredential('admin')) continue;?>
        <li class="root">
          <a href="#" onclick="documentCtrl.addCategory(<?php echo $category->id; ?>); return false;" <?php if (0 === $i): ?>class="first"<?php endif;?><?php if ($max_i === $i): ?>class="last"<?php endif;?>>
            <?php echo $category->getPublicTitle(); ?>
          </a>
          <?php if (0 < Doctrine::getTable('Category')->createQuery('c')->where('c.title LIKE ?', $category->title . '|%')->count()): ?>
            <ul>
              <?php foreach (Doctrine::getTable('Category')->createQuery('c')->where('c.title LIKE ?', $category->title . '|%')->execute() as $sub_category): ?>
                <li class="sub_category subcat_level_<?php echo substr_count($sub_category->title, '|'); ?>">
                  <a href="#" onclick="documentCtrl.addCategory(<?php echo $sub_category->id; ?>); return false;" ><?php echo $sub_category->getPublicTitle(); ?></a>
                </li>
              <?php endforeach;?>
              <li class="foot_sub_category"></li>
            </ul>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>

</form>