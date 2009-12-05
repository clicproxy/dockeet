<div class="document_thumbnail">
<a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
  <span><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></span>
  <img src="<?php echo $document->getThumbnailUrl(125); ?>" alt="<?php echo $document->title; ?>" />
  <span><?php echo $document->title; ?></span>
</a>
</div>