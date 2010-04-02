<div class="document_mixed border_style">
  <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
    <img src="<?php echo $document->getThumbnailUrl(125); ?>" alt="<?php echo $document->title; ?>" />
  </a>
  <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
    <?php echo $document->title; ?>
  </a>
  <p class="updated_at"><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></p>
  <p><?php echo $document->description; ?></p>
  <div class="clear"></div>
</div>