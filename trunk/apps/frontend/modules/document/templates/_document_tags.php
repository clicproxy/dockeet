<h3><?php echo __('Has tags'); ?></h3>

<?php include_partial('navigation/notice'); ?>


<?php if (0 < count($document->Tags)): ?>
  <p id="document_tags_list">
    <?php foreach($document->Tags as $tag):?>
      <span class="border_style">
        <?php echo $tag->title; ?>
        <a href="<?php echo url_for('document/removeTag?slug=' . $document->slug . '&tag_id=' . $tag->id); ?>" onclick="if (confirm('<?php echo __('Are you sure ?'); ?>')) documentCtrl.removeTag(this); return false;">
          <span>×<?php //echo __('remove'); ?></span>
        </a>
      </span>
    <?php endforeach; ?>
  </p>
<?php else: ?>
  <p><?php echo __("This document has no tag")?></p>
<?php endif; ?>

<?php $other_tags = $document->getOtherTags(); ?>
<?php if (0 < count($other_tags)): ?>
	<p>
		<em><?php echo __('Add exisiting tag'); ?></em> : 
		<?php foreach ($other_tags as $i => $other_tag): ?>
		  <?php if (0 != $i): ?>, <?php endif;?>
		  <a href="<?php echo url_for('document/addTag?slug=' . $document->slug . '&tag_id=' . $other_tag->id); ?>" onclick="documentCtrl.addTag(this); return false;" class="border_style">
		   <span><?php echo $other_tag->title; ?></span>
		  </a>
		<?php endforeach;?>
	</p>
<?php endif; ?>
<p>
	<em><?php echo __('Add a new tag'); ?></em> :<br/>
	<form action="<?php echo url_for('document/addTag?slug=' . $document->slug); ?>" onsubmit="documentCtrl.addNewTag(this); return false;">
	  <input type="text" id="new-tag" name="new-tag" />
	  <input type="submit"/>
	</form>
</p>