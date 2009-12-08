<ul>
  <?php foreach ($document_query->execute() as $document):?>
    <li>
      <a href="<?php echo url_for('api/download?api_key=XXXX&slug=XXXX&api_sig=XXXX'); ?>">
        <?php echo $document->title?>
      </a>
      <span><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></span>
    </li>
  <?php endforeach;?>
</ul>