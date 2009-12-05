<div class="document_detail">
  <a href="<?php echo url_for('document/index?slug=' . $document->slug); ?>">
    <?php echo $document->title; ?>
  </a>
  <span><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></span>
</div>