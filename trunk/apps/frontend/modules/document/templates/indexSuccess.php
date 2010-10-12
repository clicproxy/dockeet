<div id="title_box">
  <div id="title_top"></div>
  <div id="title_content">
    <h2><?php echo $document->title; ?></h2>
  </div>
  <div id="title_bottom"></div>
</div>
<div id="document_control_box" class="control_box_doc">
  <ul>
    <?php if($sf_user->hasCredential('admin')): ?>
      <li class="edit"><a href="<?php echo url_for('document/edit?slug=' . $document->slug); ?>"><?php echo __('Edit'); ?></a></li>
      <li class="delete"><a href="<?php echo url_for('document/delete?slug=' . $document->slug); ?>" onclick="return confirm('<?php echo __('Are you sure ?'); ?>')"><?php echo __('Delete'); ?></a></li>
    <?php endif; ?>
    <?php if ($sf_user->isAuthenticated()): ?>
      <?php if ($sf_user->hasSubscribed($document)): ?>
        <li class="unsubscribe"><a href="<?php echo url_for('document/unsubscribe?slug=' . $document->slug); ?>"><?php echo __('Unsubscribe'); ?></a></li>
      <?php else: ?>
        <li class="subscribe"><a href="<?php echo url_for('document/subscribe?slug=' . $document->slug); ?>"><?php echo __('Subscribe'); ?></a></li>
      <?php endif; ?>
    <?php endif; ?>
    <li class="download"><a href="<?php echo url_for('document/download?slug=' . $document->slug); ?>"><?php echo __('Download'); ?></a></li>
  </ul>
</div>

<div id="document_info">
  <a id="document_thumbnail" class="border_style" href="<?php echo url_for('document/download?slug=' . $document->slug); ?>"><?php echo __('Download'); ?>
    <img src="<?php echo $document->getThumbnailUrl(125); ?>" alt="<?php echo $document->title; ?>" />
    <em class="border_stylehover"><?php echo $document->mime_type; ?> | <strong><?php echo number_format($document->size / 1024, 2) . ' ' . __('Ko'); ?></strong></em>
  </a>
  <ul>
    <li><label><?php echo __("Last update"); ?></label><strong><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></strong></li>
    <li><label><?php echo __("First upload"); ?></label><strong><?php echo date('d/m/Y', strtotime($document->created_at)); ?></strong></li>
  </ul>
  <h3><?php echo __('Description'); ?></h3>
  <p id="document_description"><?php echo $document->description; ?></p>
</div>

<div id="document_versions">
  <h3><?php echo __('Previous versions')?> (<?php echo count($document->Versions) -1; ?>)</h3>
  <ul>
    <?php $compteur = 0; ?>
    <?php foreach($document->Versions as $version): ?>
      <?php if ($document->file === $version->file) continue; ?>
      <li <?php if (5 < $compteur):?>style="display: none"<?php endif; ?>>
        <a href="<?php echo url_for('document/download?slug=' . $document->slug . '&version=' . $version->id); ?>"><?php echo date('d/m/Y', strtotime($version->created_at)); ?></a>
      </li>
      <?php if (5 === $compteur):?>
      <li>
        <a href="#" onclick="document.showAllVersion(); return false;"><?php echo __('Show all')?></a>
      </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</div>