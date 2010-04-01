<div id="title_box">
  <div id="title_top"></div>
  <div id="title_content">
    <h2><?php echo __("API Access"); ?></h2>
  </div>
  <div id="title_bottom"></div>
</div>

<table>
  <thead>
    <tr>
      <th><?php echo __("Key"); ?></tH>
      <th><?php echo __("User"); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($pager->getResults() as $api_access): ?>
      <tr>
        <th><a href="<?php echo url_for('services/editApiAccess?api_key=' . $api_access->api_key); ?>"><?php echo $api_access->api_key; ?></a></th>
        <td><?php echo (!$api_access->User->isNew()) ? $api_access->User->username : __('None'); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for1('services/editApiAccess'); ?>"><?php echo __('Add an API access'); ?></a>