<div class="document_mixed">
  <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
    <img src="<?php echo $document->getThumbnailUrl(125); ?>" alt="<?php echo $document->title; ?>" />
  </a>
  <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
    <?php echo $document->title; ?>
  </a>
  <span><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></span>
  <p><?php echo $document->description; ?></p>
</div>