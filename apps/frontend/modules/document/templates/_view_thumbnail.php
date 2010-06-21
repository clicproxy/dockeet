<div class="document_thumbnail" style="background-image: url(<?php echo $document->getThumbnailUrl(125); ?>);">
  <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
    <span class="updated_at"><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></span>
    <span class="title"><?php echo $document->title; ?></span>
  </a>
</div>