<?php
  require_once '/home/david/public_html/symfony-1.4/lib/yaml/sfYaml.php';

  $hostname = 'http://dockeet/';
  $api_key = '6eda50050f1ae10c38071954';
  $api_secret = '03c8aaf8';

  /**
   * *********************************** How to list *************************************
   */

  $params_url = array(
    'api_key' => $api_key,
    'updated_after' => '2010-07-04',
    'public' => false
  );
  ksort($params_url);

  $api_sig_plain = $api_secret;
  $url = '';
  foreach($params_url as $key => $param_url)
  {
    $api_sig_plain .= $key . $param_url;
    $url .= '&' . $key . '=' . $param_url;
  }
  $url = $hostname . 'frontend_dev.php/api/list?api_sig=' . md5($api_sig_plain) . $url;

  $curl_handle = curl_init();
  $options = array
  (
    CURLOPT_URL=> $url,
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_FOLLOWLOCATION=>true,
    CURLOPT_USERAGENT=>$defined_vars['HTTP_USER_AGENT']
  );
  curl_setopt_array($curl_handle,$options);
  $server_output = curl_exec($curl_handle);
  curl_close($curl_handle);
?>
<pre><?php echo $server_output; ?></pre>
<ul>
  <?php foreach (sfYaml::load($server_output) as $slug => $document_info): ?>
    <li>
      <a href="<?php echo $hostname . $document_info['download']; ?>"><img src="<?php echo $hostname . $document_info['thumbnail']; ?>"><?php echo $document_info['title']; ?></a>
      <?php $api_sig = md5($api_secret . 'api_key' . $api_key . 'emaildavid@willou.net' . 'slug' . $slug); ?>
      <a href="<?php echo $hostname . 'api/subscribe?api_key=' . $api_key . '&email=david@willou.net' . '&slug=' . $slug . '&api_sig=' . $api_sig ?>">Subscribe</a>
      <a href="<?php echo $hostname . 'api/unsubscribe?api_key=' . $api_key . '&email=david@willou.net' . '&slug=' . $slug . '&api_sig=' . $api_sig ?>">Unsubscribe</a>
    </li>
  <?php endforeach; ?>
</ul>
<?php
  /**
   * ************************************* How to Download *********************************
   * */

  $params_url = array(
    'api_key' => $api_key,
    'slug' => 'gestion-ressources-v3-1-png'
  );
  ksort($params_url);

  $api_sig_plain = $api_secret;
  $url = '';
  foreach($params_url as $key => $param_url)
  {
    $api_sig_plain .= $key . $param_url;
    $url .= '&' . $key . '=' . $param_url;
  }
  $url = $hostname . 'api/download?api_sig=' . md5($api_sig_plain) . $url;
?>

<a href="<?php echo $url; ?>">Télécharge</a>
  /**
   * ************************************* How to Download *********************************
   * */

  $params_url = array(
    'api_key' => $api_key,
    'slug' => 'gestion-ressources-v3-1-png'
  );
  ksort($params_url);

  $api_sig_plain = $api_secret;
  $url = '';
  foreach($params_url as $key => $param_url)
  {
    $api_sig_plain .= $key . $param_url;
    $url .= '&' . $key . '=' . $param_url;
  }
  $url = $hostname . 'api/download?api_sig=' . md5($api_sig_plain) . $url;
?>

<a href="<?php echo $url; ?>">Télécharge</a>