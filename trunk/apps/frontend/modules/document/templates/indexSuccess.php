<div id="title_box">
  <div id="title_left"></div>
  <div id="title_content">
    <h2><?php echo $document->title; ?></h2>
  </div>
  <div id="title_right"></div>
</div>

<div id="document_control_box" class="control_box">
  <ul>
    <?php if($sf_user->hasCredential('admin')): ?>
      <li><a href="<?php echo url_for('document/edit?slug=' . $document->slug); ?>"><?php echo __('Edit'); ?></a></li>
      <li><a href="<?php echo url_for('document/delete?slug=' . $document->slug); ?>" onclick="return confirm('<?php echo __('Are you sure ?'); ?>')"><?php echo __('Delete'); ?></a></li>
    <?php endif; ?>
    <?php if ($sf_user->isAuthenticated()): ?>
      <?php if ($sf_user->hasSubscribed($document)): ?>
        <li><a href="<?php echo url_for('document/unsubscribe?slug=' . $document->slug); ?>"><?php echo __('Unsubscribe'); ?></a></li>
      <?php else: ?>
        <li><a href="<?php echo url_for('document/subscribe?slug=' . $document->slug); ?>"><?php echo __('Subscribe'); ?></a></li>
      <?php endif; ?>
    <?php endif; ?>
    <li><a href="<?php echo url_for('document/download?slug=' . $document->slug); ?>"><?php echo __('Download'); ?></a></li>
  </ul>
</div>

<div id="document_info">
  <p id="document_thumbnail">
    <img src="<?php echo $document->getThumbnailUrl(125); ?>" alt="<?php echo $document->title; ?>" />
    <em><?php echo $document->mime_type; ?> / <?php echo number_format($document->size / 1024, 2) . ' ' . __('Ko'); ?></em>
  </p>
  <ul>
    <li><label><?php echo __("Last update"); ?></label><?php echo date('d/m/Y', strtotime($document->updated_at)); ?></li>
    <li><label><?php echo __("First upload"); ?></label><?php echo date('d/m/Y', strtotime($document->created_at)); ?></li>
  </ul>
  <h3><?php echo __('Description'); ?></h3>
  <p id="document_description"><?php echo $document->description; ?></p>
</div>

<div id="document_versions">
  <h3><?php echo __('Previous versions')?> (<?php echo count($document->Versions) -1; ?>)</h3>
  <ul>
    <?php foreach($document->Versions as $version): ?>
      <?php if (date('d/m/Y', strtotime($version->created_at)) === date('d/m/Y', strtotime($document->updated_at))) continue;?>
      <li>
        <a href="<?php echo url_for('document/download?slug=' . $document->slug . '&version=' . $version->id); ?>"><?php echo date('d/m/Y', strtotime($version->created_at)); ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>