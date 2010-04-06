<div class="document_detail border_style">
  <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
    <?php echo $document->title; ?>
	  <ul>
	    <li class="updated"><?php echo __("Last update"). ' : '; ?> <strong><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></strong></li>
	    <li class="updated"><?php echo __("First upload"). ' : '; ?> <strong><?php echo date('d/m/Y', strtotime($document->created_at)); ?></strong></li>
	    <li class="updated"><?php echo __('Size') . ' : '; ?> <strong><?php echo number_format($document->size /1024 , 2) . ' ' . __("Ko"); ?></strong></li>
	  </ul>
  </a>
</div>