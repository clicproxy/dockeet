<h2><?php echo __("Document updates"); ?></h2>
<em><?php echo __('Date'); ?> : <?php echo date('d/m/Y');?></em>

<?php if (0 < $user->getDocumentsUpdatesQuery()->count()):?>
  <h3><?php echo __('Document subscriptions'); ?>  </h3>
  <ul>
    <?php foreach ($user->getDocumentsUpdatesQuery()->execute() as $document):?>
      <li>
        <a href="<?php echo url_for('document/index?slug=' . $document->slug, true);?>">
          <?php echo $document->title; ?>
        </a>
        <span>(<?php echo date('d/m/Y', strtotime($document->updated_at)); ?>)</span>
      </li>
    <?php endforeach;;?>
  </ul>
<?php endif;?>

<?php foreach ($user->Categories as $category):?>
  <?php if (0 < $user->getDocumentsUpdatesQuery($category->getRawValue())->count()):?>
    <h3><?php echo __('Category') . ' ' . $category->title; ?></h3>
    <ul>
      <?php foreach ($user->getDocumentsUpdatesQuery($category->getRawValue())->execute() as $document):?>
        <li>
          <a href="<?php echo url_for('document/index?slug=' . $document->slug, true);?>">
            <?php echo $document->title; ?>
          </a>
          <span>(<?php echo date('d/m/Y', strtotime($document->updated_at)); ?>)</span>
        </li>
      <?php endforeach;;?>
    </ul>
  <?php endif;?>
<?php endforeach;?>

<em><?php echo __('See you on next updates.')?></em>
<a href="<?php echo url_for('@homepage', true); ?>"><?php echo __('Ressources management'); ?></a>