<div class="document_detail">
  <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
    <?php echo $document->title; ?>
  </a>
  <ul>
    <li><?php echo __("Last update"). ' : ' . date('d/m/Y', strtotime($document->updated_at)); ?></li>
    <li><?php echo __("First upload"). ' : ' . date('d/m/Y', strtotime($document->created_at)); ?></li>
    <li><?php echo __('Size') . ' : ' . number_format($document->size /1024 , 2) . ' ' . __("Ko"); ?></li>
  </ul>
</div>