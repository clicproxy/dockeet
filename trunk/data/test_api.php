<?php
  require_once '/home/david/public_html/_symfonys/1.4/lib/yaml/sfYaml.php';

  $hostname = 'http://dockeet/';
  $api_key = 'e497f543d04e40cd2cd6fceb';
  $api_secret = '228fffee';

  /**
   * *********************************** How to list *************************************
   */

  $api_sig = md5($api_secret . 'api_key' . $api_key);

  $curl_handle = curl_init();
  $options = array
  (
    CURLOPT_URL=> $hostname . 'api/list?api_key=' . $api_key . '&api_sig=' . $api_sig,
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
  <?php foreach (sfYaml::load($server_output) as $document_info): ?>
    <li><a href="<?php echo $hostname . $document_info['download']; ?>"><img src="<?php echo $hostname . $document_info['thumbnail']; ?>"><?php echo $document_info['title']; ?></a></li>
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