<h3><?php echo __('Has tags'); ?></h3>

<?php include_partial('navigation/notice'); ?>


<?php if (0 < count($document->Tags)): ?>
  <p id="document_tags_list">
    <?php foreach($document->Tags as $tag):?>
      <span>
        <?php echo $tag->title; ?>
        (<a href="<?php echo url_for('document/removeTag?slug=' . $document->slug . '&tag_id=' . $tag->id); ?>" onclick="if (confirm('<?php echo __('Are you sure ?'); ?>')) documentCtrl.removeTag(this); return false;">
          <?php echo __('remove'); ?>
        </a>)
      </span>
    <?php endforeach; ?>
  </p>
<?php else: ?>
  <p><?php echo __("This document has no tag")?></p>
<?php endif; ?>

<em><?php echo __('Add another Tag'); ?></em>
<?php foreach ($document->getOtherTags() as $other_tag): ?>
  <a href="<?php echo url_for('document/addTag?slug=' . $document->slug . '&tag_id=' . $other_tag->id); ?>" onclick="documentCtrl.addTag(this); return false;"><?php echo $other_tag->title; ?></a>
<?php endforeach;?>
<form action="<?php echo url_for('document/addTag?slug=' . $document->slug); ?>">
  <input type="submit"/>
</form>