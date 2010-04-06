<a class="document_mixed border_style" href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
  <img src="<?php echo $document->getThumbnailUrl(125); ?>" alt="<?php echo $document->title; ?>" />
  <strong class="mixed_title border_stylemixed"><?php echo $document->title; ?></strong>
	<span class="updated_at"><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></span>
	<span><?php echo $document->description; ?></span>
</a>
<div class="clear"></div>